<?php
session_start();
ini_set('display_errors', 1);
include_once ("../config/configure.php");
include_once ("../error/ErrorMessage.php");

    // Is gebruikt in class
    include_once ("UserDaoMysql.php");
    include ("HashPassword.php"); // PWD hash...

    // Title van de pagina...
    if(!isset($_SESSION))
    {
        $_SESSION["title"] = "Log hier in";
    }

    // Login the page > kijk eerst of beide velden zijn ingevoerd met isset()
    if( isset($_POST['username']) && isset($_POST['password']) )
    {
        // Instantiate Error class
        $errMessage = new ErrorMessage();

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

        // Hash het password
        $hash = new HashPassword();
        $hash_password = $hash->hashPwd($_SESSION['password']);

        //Geef melding als de user niet bestaat of user niet actief is
        if( $_POST['username'] !== $_SESSION['username'] OR $_SESSION['status_active'] == FALSE)
        {
            // Session leeg maken!!!!
            $_SESSION = array();

            echo $errMessage->createErrorMessage('<h2>Login mislukt: </h2>Combinatie van gebruikersnaam en wachtwoord onbekend.');
        }
        else
        {
            // Password checken (vergelijkt invoer met het password in de database)
            if( $hash->verifyPwd( $_POST['password'], $loginUser->getPassword() ) AND $_SESSION['status_active'] == TRUE)
            {
                //echo "<br> <h2>Ingelogged!!!!!!! </h2>";
                $_SESSION['password'] = "";

                // redirect naar dashboard op basis van role:
                if($_SESSION['role'] == 'admin' )
                {
                    header('Location: http://' . APP_PATH . 'gebruikersbeheer/overzicht.php');
                } 
                else if($_SESSION['role'] == 'user')
                {
                    header('Location: http://' . APP_PATH . 'dashboards/user_dashboard.php');   
                }
            }
            else
            {
                // Session leeg maken!!!!
                $_SESSION = array();
                echo "";
                echo $errMessage->createErrorMessage('<h2>Login mislukt: </h2>Combinatie van gebruikersnaam en wachtwoord onbekend.');
            }
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link type="text/css" rel="stylesheet" href="../css/header.css">

    <link type="text/css" rel="stylesheet" href="../css/content.css">
    <link type="text/css" rel="stylesheet" href="../css/header.css">
    <link type="text/css" rel="stylesheet" href="../css/error.css">
</head>

<body>
  <div class="inlog-container">
    <div class="menu-login">
        <div class="inlog-container-logo">
          <div id = "inlog-logo">MyInsights</div>
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

<script src="../js/error.js"></script>
</body>
</html>
