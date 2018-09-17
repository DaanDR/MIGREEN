<?php
class HashPassword
{
    public function __construct()
    {

    }

    // Hash pwd in db
    public function hashPwd($strPwd)
    {
        return password_hash($strPwd, PASSWORD_BCRYPT); // PASSWORD_DEFAULT);
    }

    // "password" > "$@$#^$&$&$"
    public function verifyPwd($strPwd, $strHash)
    {
        if( password_verify($strPwd, $strHash) )
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}

?>