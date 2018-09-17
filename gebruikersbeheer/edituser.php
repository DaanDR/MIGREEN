<?php
session_start();

// Check of user is ingelogged en anders terug naar de login pagina
include_once ("../autorisatie/UserIsLoggedin.php");
$userLoggedin = new UserIsLoggedin();
$userLoggedin->backToLoging();

// Check of de admin is ingelogged....
$adminLoggedin = "";
if( ! $userLoggedin->isAdmin() )
{
    $adminLoggedin = "style='display: none;'";
    echo "<br><br><br><br><h1>Geen gerbuikersrecht als admin.....</h1>";
}

    // ini_set('display_errors', 1);
    // Header in de bovenkant
    include ("../header/header.php");
    
    // Is logged in class
    include_once ("../autorisatie/UserDaoMysql.php");
    include ("../autorisatie/EncryptDecrypt.php");

    // Vang de meegegeven username op
    if (! isset($_GET["username"])) {
        $userName = null;
    } else {
        $userName = $_GET["username"];
    }

    // Haal de user uit de database met de opgegeven username
    $userDao = new UserDaoMysql();
    $currentUser = $userDao->selectUser($userName);
    // Sla de relevante gegevens op in eigen variabelen
    $currentUserFirstname = $currentUser->getFirstname();
    $currentUserLastname = $currentUser->getLastname();
    $currentUserEmail = $currentUser->getEmail();
    $currentUserRole = $currentUser->getRole();

    // Kijk eerst of alle velden zijn ingevoerd met isset()
    if( isset($_POST['password']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['role']) ) {
        // Password Checks
        
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
        if( $_POST['password'] != $_POST['password2'] ){
            // Session leeg maken!!!!
            $_SESSION = array();
            echo "<br> <h2>Helaas... uw wachtwoord is niet gelijk....</h2>";
        } 
        
        else {
            //encrypt het opgegeven password
            $encrypt = new EncryptDecrypt();
            $encrypt_password = $encrypt->encrypt($_POST['password']);
                
            // Roep de class UserDaoMysql aan voor sql functionaliteit om user in te voeren in database
            $editUser = new UserDaoMysql();
            $editUser = $editUser->updateUser( $userName, $encrypt_password, $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['role'] );
            header('Location: ../gebruikersbeheer/overzicht.php');
        }
                   
    }
    
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/content.css">

    <meta charset="utf-8">
    <title>Gebruiker Bewerken</title>
</head>

<div class="grid-container" <?php echo $adminLoggedin ?> >
    

    <div class="header-left">
        <p class="breadcrumb">Home <i id="triangle-breadcrumb" class="fas fa-caret-right"></i> Gebruikersoverzicht</p>
        <h2>Gebruiker bewerken: <?php echo $userName ?></h2>
    </div>


    <div class="header"></div>

    <!-- form elements -->

    <div class="content">

        <form method="post" enctype="multipart/form-data" action="edituser.php?username=<?php echo $userName ?>">

            <div class="password-form form-field-padding form-field-style">

                <div class="password-form-initial">
                    Wachtwoord <span class="info-symbol password-info"><i class="fas fa-info-circle"></i><span class="password-infotext">Je wachtwoord moet minimaal bestaan uit:<p> 8 karakter met 1 hoofdletter en 1 nummer</p></span></span>
                    <br><input type="password" name="password" pattern="(?=.*\d)(?=.*[A-Z]).{8,}" title="minimaal: 8 karakters, 1 Hoofdletter, 1 Nummer">
                </div>
                <div class="password-form-confirm">
                    Herhaal wachtwoord <br><input type="password" name="password2" class="input-text-style">
                </div>
            </div>

            <div class="form-field-padding form-field-padding form-field-style">
                <div class="fullname-form-fn">
                    Voornaam
                    <br><input type="text" name="firstname" minlength="2" class="input-text-style" value="<?php echo $currentUserFirstname ?>" required>
                </div>
                <div class="fullname-form-ln">
                    Achternaam
                    <br><input type="text" name="lastname" minlength="2" class="input-text-style"  value="<?php echo $currentUserLastname ?>" required>
                </div>
            </div>

            <div class="form-field-padding form-field-style email-form">
                E-mailadres
                <br><input type="email" name="email" class="input-text-style" value="<?php echo $currentUserEmail ?>" required><br>
            </div>

            <div class="role-form form-field-padding form-field-style">
                Rol (moet nog check op niet jezelf naar user terugzetten)
                <br>
                <select name="role" required>
                    <optgroup label="Kies een rol">
                    <option value="user" <?php if($currentUserRole=="user") echo "selected" ?>>gebruiker</option>
                    <option value="admin" <?php if($currentUserRole=="admin") echo "selected" ?>>admin</option>
                    </optgroup>
                </select>
            </div>

    </div>

    <!-- end form elements -->

    <div class="footer"></div>
    

    <!-- buttons  -->

    <div class="footer-right">
        <div class="buttons-form">
            <a href="overzicht.php" target="_self">
            <button class="button-form-secondary" type="button">Annuleren</button></a>
            <button class="button-form-primary" type="submit"> Opslaan </button>
            <!-- buttons -->
     
        </div> 
    
    </div>
        
    </form>

</html>


