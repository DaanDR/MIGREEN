<?php
class UserIsLoggedin
{
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
        if( !isUserLoggedIn() )
        {
            header('Location: ../dashboards/admin_dashboard.php');
        }
    }
}
?>