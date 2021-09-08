<?php
// config for DevRaeph/PdfSigner
return [
    /* Your Company name or Signatur CA */
    "business"      =>      "",
    /* Application name or reason of signing */
    "reason"        =>      "",
    /* Url to your platform or website */
    "url"           =>      "",
    /* Storage path of stored certificate */
    "cert"          =>      env("SIGNER_CERT_PATH","cert/test.crt"),
    /* Storage path of stored key */
    "key"           =>      env("SIGNER_KEY_PATH","cert/key.key"),
    /* Password for key file if one is set */
    "password"      =>      env("SIGNER_KEY_PASSWORD","")
];
