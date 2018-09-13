<?php
// ini_set('display_errors', 1);
    // Header in de bovenkant
    include ("../header/header.php");

    // Is logged in class
    include_once ("../autorisatie/UserDaoMysql.php");

    // Title van de pagina...
    if(!isset($_SESSION)) 
    {
        $_SESSION["title"] = "Log hier in";
    } 

    // Kijk eerst of alle velden zijn ingevoerd met isset()
    if( isset($_POST['username']) && isset($_POST['password']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['role'])      )    
    {
        // Roep de class UserDaoMysql aan voor sql functionaliteit om user te checken
        $createUser = new UserDaoMysql();
        $createUser = $createUser->insertUser( $_POST['username'], $_POST['password'], $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['role'] );
    }

?>

<<<<<<< HEAD
    <link type="text/css" rel="stylesheet" href="../css/content.css">
>>>>>>> development

<body>
    
    <div class="menu">
        <div id = "title">
            MyInsight <br>
        </div>

        <form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <div class="userinformation">
                <ul>
        Gebruikersnaam  (minimaal: 5 karakters)                         <input type="text" name="username" minlength=5>       <br>
        Wachtwoord (minimaal: 8 karakters, 1 Hoofdletter, 1 Nummer)     <input type="password" name="password">             <br>
        Wachtwoord herhaling  (Moet gelijk zijn aan bovenliggend veld)  <input type="password" name="password">             <br>   Voornaam   (minimaal: 2 karakters)                               <input type="text" name="firstname" minlength=2>     <br>
        Achternaam  (minimaal: 2 karakters)                             <input type="text" name="lastname" minlength=2>       <br>
        Email (moet voldoen aan standaard email eisen - RFC 1035)       <input type="email" name="email">                  <br>
        Rol (verplichte keuze)  <select name="role" >
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