<?php
// ini_set('display_errors', 1);
    // Header in de bovenkant
    include ("../header/header.php");

    // Is logged in class
    include_once ("../autorisatie/UserDaoMysql.php");
    include ("../autorisatie/EncryptDecrypt.php");

    // Title van de pagina...
    if(!isset($_SESSION)) 
    {
        $_SESSION["title"] = "Log hier in";
    } 

    // Kijk eerst of alle velden zijn ingevoerd met isset()
    if( isset($_POST['username']) && isset($_POST['password']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['role']) )    
    {
        // Controleren of de user al bestaat 
        // Roep de class UserDaoMysql aan voor sql functionaliteit om user te checken
        $newUser = new UserDaoMysql();
        $newUser = $newUser->selectUser( $_POST['username'] );
                
        // Haal de user info uit de User array/object $loginUser
        // en maak session vars aan.
        $_SESSION['username'] =  $newUser->getUsername();
                
        //Geef melding als de user al bestaat 
        if( $_POST['username'] == $_SESSION['username'])
        {
            // Session leeg maken!!!!
            $_SESSION = array();
            echo "<br> <h2>Deze username bestaat al in de database.</h2>";
        }        
            
        // Controleren op hoofdletters
        if(!preg_match('/[A-Z]/', $_POST['password'] )){
            $_SESSION = array();
            echo "<br> <h2> Je moet minimaal een hoofdletter invoeren! </h2>";
        }
        
        // Controleren op cijfers
        if (!preg_match('([0-9])', $_POST['password'] )){
            $_SESSION = array();
            echo "<br> <h2> Je moet minimaal een cijfer invoeren! </h2>";
        }
        
        // Controleren of wachtwoorden gelijk zijn
        if( $_POST['password'] != $_POST['password2'] )
        {
               // Session leeg maken!!!!
            $_SESSION = array();
            echo "<br> <h2>Helaas... uw wachtwoord is niet gelijk....</h2>";
        }
        
        
        else
        {
            //encrypt het opgegeven password
            $encrypt = new EncryptDecrypt();
            $encrypt_password = $encrypt->encrypt($_POST['password']);
            
            // Roep de class UserDaoMysql aan voor sql functionaliteit om user in te voeren in database
            $createUser = new UserDaoMysql();
            $createUser = $createUser->insertUser( $_POST['username'], $encrypt_password, $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['role'] );
        }
    }
?>

    <link type="text/css" rel="stylesheet" href="../css/content.css">

<body>
    <div class="menu">
        <div id = "title">
            MyInsight <br>
        </div>

        <form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <div class="userinformation">
        <ul>
            
        <!-- INVOER GEBRUIKER  -->
            Gebruikersnaam  (minimaal: 5 karakters)                         
            <input type="text" name="username" minlength=5 value="Jantje"> <br>
            Wachtwoord (minimaal: 8 karakters, 1 Hoofdletter, 1 Nummer)     
            <input type="password" name="password" minlength=8 value="wachtwoordW1"> <br>
            Wachtwoord herhaling  (Moet gelijk zijn aan bovenliggend veld)  
            <input type="password" name="password2" value="wachtwoordW1"> <br>   
            Voornaam   (minimaal: 2 karakters)                              
            <input type="text" name="firstname" minlength=2 value="Jan"> <br>
            Achternaam  (minimaal: 2 karakters)                             
            <input type="text" name="lastname" minlength=2 value="Vries"> <br>
            Email (moet voldoen aan standaard email eisen - RFC 1035)       
            <input type="email" name="email" value="test1234@test.com"> <br>
            Rol (verplichte keuze)  <select name="role">
                <option dropdown="user" >user</option>
                <option dropdown="admin" >admin</option>
            </select>
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