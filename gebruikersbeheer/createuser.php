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
            echo "<p>Aanmaken gebruiker gelukt</p>";
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
    <title>Gebruiker Aanmaken</title>
</head>

<div class="grid-container">

    <div class="header-left">
        <p class="breadcrumb">Home <i id="triangle-breadcrumb" class="fas fa-caret-right"></i> Gebruikersoverzicht</p>
        <h2>Gebruiker aanmaken</h2>
    </div>


    <div class="header"></div>

    <!-- form elements -->

    <div class="content">

        <form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'];?>">

            <div class="user-form form-field-padding form-field-style">
                Gebruikersnaam
                </br><input type="text" name="username" minlength=5 class="input-text-style">
            </div>


            <div class="password-form form-field-padding form-field-style">

                <div class="password-form-initial">
                    Wachtwoord <span class="info-symbol password-info"><i class="fas fa-info-circle"></i><span class="password-infotext">Je wachtwoord moet minimaal bestaan uit:<p> 8 karakter met 1 hoofdletter en 1 nummer</p></span></span>
                    <br><input type="password" name="password" pattern="(?=.*\d)(?=.*[A-Z]).{8,}" title="minimaal: 8 karakters, 1 Hoofdletter, 1 Nummer" required>
                </div>
                <div class="password-form-confirm">
                    Herhaal wachtwoord <br><input type="password" name="password2" class="input-text-style">
                </div>
            </div>

            <div class="form-field-padding form-field-padding form-field-style">
                <div class="fullname-form-fn">
                    Voornaam
                    <br><input type="text" name="firstname" minlength="2" class="input-text-style">
                </div>
                <div class="fullname-form-ln">
                    Achternaam
                    <br><input type="text" name="lastname" minlength="2" class="input-text-style">
                </div>
            </div>

            <div class="form-field-padding form-field-style email-form">
                E-mailadres
                <br><input type="email" name="email" class="input-text-style"><br>
            </div>

            <div class="role-form form-field-padding form-field-style">
                Rol
                <br>
                <select name="role" required>
                    <optgroup label="Kies een rol">
                    <option selected hidden>Kies een rol</option>
                    <option value="user">gebruiker</option>
                    <option value="admin">admin</option>
                    </optgroup>
                </select>
            </div>

    </div>

    <!-- end form elements -->

    <div class="footer"></div>

    <!-- buttons   -->

    <div class="footer-right">
        <div class="buttons-form">
            <button class="button-form-secondary" type="button">Annuleren</button><button class="button-form-primary" type="submit" value="Inloggen"> Gebruiker aanmaken </button>
            <!-- buttons -->
            <div>
                </form>
            </div>

            <body>

            </body>

</html>

</body>
