
![Logo](https://i.ibb.co/cD4Vst1/Pdf-Signer.png)

# PDF Signer by DevRaeph

[![Latest Version on Packagist](https://img.shields.io/packagist/v/devraeph/laravel-pdf-signer.svg?style=flat-square)](https://packagist.org/packages/devraeph/laravel-pdf-signer)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/devraeph/laravel-pdf-signer/run-tests?label=tests)](https://github.com/devraeph/laravel-pdf-signer/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/devraeph/laravel-pdf-signer/Check%20&%20fix%20styling?label=code%20style)](https://github.com/devraeph/laravel-pdf-signer/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/devraeph/laravel-pdf-signer.svg?style=flat-square)](https://packagist.org/packages/devraeph/laravel-pdf-signer)

---

With this packages you can digitally sign pdf files with a certificate.



## Installation

You can install the package via composer:

```bash
composer require devraeph/laravel-pdf-signer
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="DevRaeph\PdfSigner\PdfSignerServiceProvider" --tag="pdf-signer-config"
```

This is the contents of the published config file:

```php
return [
    "business"      =>      "",
    "reason"        =>      "",
    "url"           =>      "",
    "cert"          =>      env("SIGNER_CERT_PATH","cert/test.crt"),
    "key"           =>      env("SIGNER_KEY_PATH","cert/key.key"),
    "password"      =>      env("SIGNER_KEY_PASSWORD","")
];
```

### Create self signed Certificate

Generate Key file withour password:

```bash
openssl genrsa -out example.key 4096
```

Generate Key file with password set:

```bash
openssl genrsa -aes128 -passout pass:MyStrongPwd -out example.key 4096
```

Generate self signed Certificate:

```bash
openssl openssl req -x509 -nodes -days 365000 -key example.key -out example.crt
```

## Environment Variables

Following vars have to be set in .env file:

`SIGNER_CERT_PATH` Storage path of created certificate

`SIGNER_KEY_PATH` Storage path of created key file

`SIGNER_KEY_PASSWORD` optional password for key file

## Usage

Only use Facade to interact with the PDF Signer.

```php
use DevRaeph\PdfSigner\Facades\PdfSigner;

/* Load file from Storage path */

PDFSigner::loadFile("example.pdf")
        ->setSavePath() //Optional save Path
        ->sign();
```
## Credits

- [DevRaeph](https://github.com/devraeph)
- [All Contributors](../../contributors)
## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
