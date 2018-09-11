<?php
// ini_set('display_errors', 1);
    // Header in de bovenkant
    include ("../header/header.php");

    // Is logged in class
    include_once ("UserDaoMysql.php");

    // Title van de pagina...
    if(!isset($_SESSION)) 
    {
        $_SESSION["title"] = "Log hier in";
    } 

    // Login the page > kijk eerst of beide velden zijn ingevoerd met isset()
    if( isset($_POST['username']) && isset($_POST['password']) )
    {
        // Roep de class UserDaoMysql aan
        $loginUser = new UserDaoMysql();
        $loginUser = $loginUser->selectUser( $_POST['username'], $_POST['password'] );

        if( $loginUser !== null )
        {
            echo "<br> <h2>Ingelogged!!!!!!! </h2>";

            // Haal de user info uit de User array/object $loginUser
            // en maak session vars aan.
            $_SESSION['id'] =  $loginUser->getId();
            $_SESSION['username'] =  $loginUser->getUsername();
            $_SESSION['firstname'] =  $loginUser->getFirstname();
            $_SESSION['lastname'] =  $loginUser->getLastname();
            $_SESSION['role'] =  $loginUser->getRole();
        }
        else
        {
            // Session leeg maken!!!!
            $_SESSION = array();
            echo "<br> <h2>Helaas... niet ingelogged. Probeer het nog een keer.</h2>";
        }
    }

?>

    <link type="text/css" rel="stylesheet" href="../css/login.css">

<body>
    
    <div class="menu">
        <div id = "title">
            MyInsight <br>
        </div>

        <form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <div class="userinformation">
                    <ul>
                    Gebruikersnaam:  <input type="text" name="username">  <br> <br>
                    Wachtwoord:     <input type="password" name="password">  <br>
                    </ul> 
                </div>
            </div>        
            
            <div class="menu_login">
                <div id = "login_button">
                    <ul>
                        <input type="submit" value="Inloggen">
                    </ul> 
                </div>
            </div>
        </form>

<?php include ("../footer/footer.php"); ?>
</body>

