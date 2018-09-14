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

    // Vang de meegegeven username op
       if (! isset($_GET["username"])) {
         $userName = null;
     } else {
         $userName = $_GET["username"];
     }

    // Roep de class UserDaoMysql aan voor sql functionaliteit om user te checken
        $selectUser = new UserDaoMysql();
        $currentUser = $selectUser->selectUser( $userName );
        $currentUserFirstname = $currentUser->getFirstname();
        $currentUserLastname = $currentUser->getLastname();
        $currentUserPassword = $currentUser->getPassword();
        $currentUserEmail = $currentUser->getEmail();
    



    // Kijk eerst of alle velden zijn ingevoerd met isset()
    if( isset($_POST['password']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['role']) )
    {
       //Password Checks
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
            $editUser = new UserDaoMysql();
            $editUser = $editUser->updateUser( $userName, $encrypt_password, $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['role'] );
            echo "<p>Bewerken gebruiker " . $userName . " gelukt</p>";
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

    
    
<div class="grid-container">

    <div class="header-left">
        <p class="breadcrumb">Home <i id="triangle-breadcrumb" class="fas fa-caret-right"></i> Gebruikersoverzicht</p>
        <h2>Gebruiker bewerken: <?php echo $currentUserLastname ?></h2>
    </div>


    <div class="header"></div>

    <!-- form elements -->

    <div class="content">

        <form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'];?>">

            <div class="password-form form-field-padding form-field-style">

                <div class="password-form-initial">
                    Wachtwoord <span class="info-symbol password-info"><i class="fas fa-info-circle"></i><span class="password-infotext">Je wachtwoord moet minimaal bestaan uit:<p> 8 karakter met 1 hoofdletter en 1 nummer</p></span></span>
                    <br><input type="password" name="password" pattern="(?=.*\d)(?=.*[A-Z]).{8,}" title="minimaal: 8 karakters, 1 Hoofdletter, 1 Nummer" required  value="<?php echo $currentUserPassword ?>">
                </div>
                <div class="password-form-confirm">
                    Herhaal wachtwoord <br><input type="password" name="password2" class="input-text-style" value="<?php echo $currentUserPassword ?>">
                </div>
            </div>

            <div class="form-field-padding form-field-padding form-field-style">
                <div class="fullname-form-fn">
                    Voornaam
                    <br><input type="text" name="firstname" minlength="2" class="input-text-style" value="<?php echo $currentUserFirstname ?>">
                </div>
                <div class="fullname-form-ln">
                    Achternaam
                    <br><input type="text" name="lastname" minlength="2" class="input-text-style"  value="<?php echo $currentUserLastname ?>">
                </div>
            </div>

            <div class="form-field-padding form-field-style email-form">
                E-mailadres
                <br><input type="email" name="email" class="input-text-style" value="<?php echo $currentUserEmail ?>"><br>
            </div>

            <div class="role-form form-field-padding form-field-style">
                Rol (moet nog check op niet jezelf naar user terugzetten)
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
    

    <!-- buttons  -->

    <div class="footer-right">
        <div class="buttons-form">
            <a href="overzicht.php" target="_self">
            <button class="button-form-secondary" type="button">Annuleren</button></a>
            <button class="button-form-primary" type="submit" value="Inloggen"> Bewerking opslaan </button>
            <!-- buttons -->
     
            <div>
                </form>
            </div>

            <body>

            </body> 

</html>

</body>
