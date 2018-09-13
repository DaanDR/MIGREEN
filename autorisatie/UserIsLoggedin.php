<?php
ob_start();
$myPath = "/guido/mybit/migreen/"; // VERANDER DEZE REGEL OP BASIS VAN EIGEN MACHINE
define( 'APP_PATH', $_SERVER['SERVER_NAME'] . $myPath );

class UserIsLoggedin
{
    private $urlLogin;

    public function isUserLoggedIn()
    {
        $userLogged = false;
        if( isset($_SESSION['id']) && isset($_SESSION['username']) )
        {
            $userLogged = true;
        }

        return $userLogged;
    }

    public function backToLoging()
    {
        if( ! $this->isUserLoggedIn() )
        {
            if(!headers_sent())
            {
                header('Location: http://' . APP_PATH . 'autorisatie/login.php');
            }
        }
    }
}
?>