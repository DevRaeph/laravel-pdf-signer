<?php

namespace DevRaeph\PdfSigner;

use DevRaeph\PdfSigner\Classes\PdfBuilder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Exception;
use setasign\Fpdi\Tcpdf\Fpdi;

class PdfSigner
{
    protected PdfBuilder $pdf;
    protected int $pages;

    protected string $cert;
    protected string $key;
    protected string $password;

    protected string $fileName;
    protected string $savePath;

    public function __construct()
    {
        $this->savePath = "signed-pdf";
        try {
            $this->cert = Storage::get(config("pdf-signer.cert"));
            $this->key = Storage::get(config("pdf-signer.key"));
            $this->password = config("pdf-signer.password");
        }catch (Exception $e){
            throw new Exception("Certificate or Key not found! - ".$e->getMessage(),"404");
        }
        $this->pdf = new PdfBuilder('P', 'mm', 'A4'); //FPDI extends TCPDF
    }

    /**
     * PDF Signer by DevRaeph
     * @param string $savePath set optional Storage path, default "signed-pdf"
     * @return $this
     */
    public function setSavePath(string $savePath = "signed-pdf"):PdfSigner{
        $this->savePath = $savePath;
        return $this;
    }

    /**
     * PDF Signer by DevRaeph
     * @param string $storagePath set the Filepath used from the Storage Facade. e.g. (app/)public/example.pdf
     * @return $this
     * @throws \setasign\Fpdi\PdfParser\PdfParserException
     */
    public function loadFile(string $storagePath):PdfSigner{
        $path = Storage::path($storagePath);
        $this->fileName = basename($path);
        $this->pages = $this->pdf->setSourceFile($path);
        if($this->pages == 0){
            throw new Exception("Imported PDF File has no pages!","404");
        }
        for ($i = 1; $i <= $this->pages; $i++)
        {
            $this->pdf->AddPage();
            try {
                $page = $this->pdf->importPage($i);
            }catch (Exception $e){
                throw new Exception("Error while importing pages! - ".$e->getMessage(),"404");
            }
            $this->pdf->useTemplate($page, 0, 0);
        }
        return $this;
    }

    /**
     * PDF Signer by DevRaeph
     * Sign the PDF request
     * @return string returns Storage path of signed file
     * @throws Exception
     */
    public function sign():string{
        $info = array();

        (config("pdf-signer.business") != "") ? $info["Name"]=config("pdf-signer.business"):"";
        (config("pdf-signer.reason") != "") ? $info["Reason"]=config("pdf-signer.reason"):"";
        (config("pdf-signer.url") != "") ? $info["ContactInfo"]=config("pdf-signer.url"):"";

        $this->pdf->setSignature($this->cert, $this->key, $this->password, '', 2, $info);

        try {
            $saveString = $this->pdf->Output("","S");
        }catch (Exception $e){
            throw new Exception("Failed to sign PDF. Maybe the key password is missing or is wrong.");
        }
        Storage::put($this->savePath."/".$this->fileName,$saveString);
        return $this->savePath."/".$this->fileName;
    }
}
