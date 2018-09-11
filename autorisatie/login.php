<?php
// ini_set('display_errors', 1);
    // Header in de bovenkant
    include ("../header/header.php");

    // Is logged in class
    include_once ("UserDaoMysql.php");

    // Title van de pagina...
    if(!isset($_SESSION)) 
    {
        $_SESSION["title"] = "Log in hier";
    } 

    // Login the page
    if( isset($_POST['username']) && isset($_POST['password']) )
    {
        $loginUser = new UserDaoMysql();
        $loginUser = $loginUser->selectUser( $_POST['username'], $_POST['password'] );

        // var_dump($loginUser);

        if( $loginUser !== null )
        {
            echo "Ingelogged";
        }
        else
        {
            $_SESSION['name'] = $_POST['username'];
            // $_SESSION = array();

            // echo "Niet ingelogged" . $_SESSION['name'];
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

