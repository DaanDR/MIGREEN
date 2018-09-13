<?php
class EncryptDecrypt
{
    private $password = '3sc3RLrpd17';
    private $method = 'aes-256-cbc';
    private $iv;


    public function __construct()
    {
        // IV must be exact 16 chars (128 bit)
        $this->iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
        // Must be exact 32 chars (256 bit)
        $this->password = substr(hash('sha256', $this->password, true), 0, 32);
    }

    public function encrypt($strPassw)
    {
        return base64_encode(openssl_encrypt($strPassw, $this->method, $this->password, OPENSSL_RAW_DATA, $this->iv));
    }

    public function decrypt($strPasswEncrypt)
    {
        return openssl_decrypt(base64_decode($strPasswEncrypt), $this->method, $this->password, OPENSSL_RAW_DATA, $this->iv);
    }
}
?>