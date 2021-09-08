<?php
/*
 *      ______        __          _____                __
 *    / ____/__  __ / /_   ___  / ___/ ____   ____   / /_
 *   / /    / / / // __ \ / _ \ \__ \ / __ \ / __ \ / __/
 *  / /___ / /_/ // /_/ //  __/___/ // /_/ // /_/ // /_
 *  \____/ \__,_//_.___/ \___//____// .___/ \____/ \__/
 *                                 /_/
 *  ---------------------------------------------------------
 * | Author:    CubeSpot - DevRaeph
 * | Email:     office@cubespot.me
 * | Project:   test
 * | File:      MYPDF.php
 * | Created:   07.09.2021
 * | Copyright (c) Gassner Wiege- und Messtechnik GmbH.
 * | All Rights Reserved
 * |__________________________________________________________
 */
namespace DevRaeph\PdfSigner\Classes;
use setasign\Fpdi\Tcpdf\Fpdi;
// Extend the TCPDF class to create custom Header and Footer
class PdfBuilder extends Fpdi {

    //Page header
    public function Header() {

    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'R', 8);
        // Page number
        $this->Cell(0, 10, 'Seite '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 10, "Dieses Dokument wurde Digital signiert von ".config("pdf-signer.business"), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}
