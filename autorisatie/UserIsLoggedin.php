<?php
ob_start();
include_once ("../config/configure.php");

class UserIsLoggedin
{
    private $urlLogin;

    // Is de gebruiker ingelogged???
    public function isUserLoggedIn()
    {
        $userLogged = false;
        if( isset($_SESSION['id']) && isset($_SESSION['username']) )
        {
            $userLogged = true;
        }

        return $userLogged;
    }

    // Is de gebruiker een admin????
    public function isAdmin()
    {
        $userLogged = false;
        if( $this->isUserLoggedIn() )
        {
            if( $_SESSION['role'] == 'admin')
            {
                $userLogged = true;
            }
        }

        return $userLogged;
    }

    // Redirect naar Loggin pagina
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