<?php
session_start();
    // Is gebruikt in class
    include_once ("UserDaoMysql.php");
    include ("EncryptDecrypt.php");

    // Title van de pagina...
    if(!isset($_SESSION))
    {
        $_SESSION["title"] = "Log hier in";
    }

    // Login the page > kijk eerst of beide velden zijn ingevoerd met isset()
    if( isset($_POST['username']) && isset($_POST['password']) )
    {
        // Roep de class UserDaoMysql aan voor sql functionaliteit om user te checken
        $loginUser = new UserDaoMysql();
        $loginUser = $loginUser->selectUser( $_POST['username'] );

        // Haal de user info uit de User array/object $loginUser
        // en maak session vars aan.
        $_SESSION['id'] =  $loginUser->getId();
        $_SESSION['username'] =  $loginUser->getUsername();
        $_SESSION['password'] =  $loginUser->getPassword();
        $_SESSION['firstname'] =  $loginUser->getFirstname();
        $_SESSION['lastname'] =  $loginUser->getLastname();
        $_SESSION['email'] = $loginUser->getEmail();
        $_SESSION['role'] =  $loginUser->getRole();
        $_SESSION['status_active'] = $loginUser->getStatus();

        // Decrypt het password
        $decrypt = new EncryptDecrypt();
        $decrypt_password = $decrypt->decrypt($_SESSION['password']);

        //Geef melding als de user niet bestaat of user niet actief is
        if( $_POST['username'] !== $_SESSION['username'] OR $_SESSION['status_active'] == FALSE)
        {
            // Session leeg maken!!!!
            $_SESSION = array();
            echo "<br> <h2>Helaas... niet ingelogged. Probeer het nog eens.</h2>";
        }

        // Password checken (vergelijkt invoer met het password in de database)
        if( $_POST['password'] == $decrypt_password AND $_SESSION['status_active'] == TRUE)
        {
            //echo "<br> <h2>Ingelogged!!!!!!! </h2>";
            $_SESSION['password'] = "";

            // redirect naar dashboard op basis van role:
            if($_SESSION['role'] == 'admin' )
            {
            header('Location: ../dashboards/admin_dashboard.php');
            }
            else if($_SESSION['role'] == 'user')
            {
            header('Location: ../dashboards/user_dashboard.php');
            }
        }
        else
        {
            // Session leeg maken!!!!
            $_SESSION = array();
            echo "<br> <h2>Helaas... niet ingelogged. Password onjuist.</h2>";

        }
    }

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link type="text/css" rel="stylesheet" href="../css/content.css">
    <link type="text/css" rel="stylesheet" href="../css/header.css">


<body>
  <div class="inlog-container">
    <div class="menu-login">
        <div class="inlog-container-logo">
          <div id = "inlog-logo">MyInsight</div>
        </div>

        <div class="inlog-container-input">
          <form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <div class="userinformation">
                  <div>Gebruikersnaam</div><div><input class="login-input-field" type="text" name="username"></div>

                  <div>Wachtwoord</div><div><input class="login-input-field" type="password" name="password"></div>
                </div>
        </div>
                  <div class="inlog-container-button">
                <div>
                        <input id="login_button"type="submit" value="Inloggen">
                </div>
        </form>
                    </div>
        </div>
                </div>


</body>
