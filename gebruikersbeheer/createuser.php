<?php

// Header in de bovenkant + session_start()
include('../header/header.php');

//init_set('display_errors', 1);

// Check of user is ingelogged en anders terug naar de login pagina
include_once("../autorisatie/UserIsLoggedin.php");
include_once("../gebruiker_klantbeheer/UserCustomerDaoMysql.php");
$userLoggedin = new UserIsLoggedin();
$userLoggedin->backToLoging();
// Check of de admin is ingelogged....
$adminLoggedin = "";
if (!$userLoggedin->isAdmin()) {
    $adminLoggedin = "style='display: none;'";
    echo "<h1 style='margin-top:50px;'>Geen gebruikersrecht als admin.....</h1>";
}

ini_set('display_errors', 1);


// Is logged in class
include_once("../autorisatie/UserDaoMysql.php");
// customerDao voor selecteren van alle klanten
include('../klantbeheer/CustomerDaoMysql.php');
// Roep de class CustomerDaoMysql aan voor sql functionaliteiten om klantenlijst op te halen
$customerdao = new CustomerDaoMysql();
$customers = $customerdao->selectAllCustomers();
// include user_customer class
include_once("../gebruiker_klantbeheer/UserCustomerDaoMysql.php");
include("../autorisatie/HashPassword.php"); // Hash PWD

//    // Title van de pagina...
//    if(!isset($_SESSION))
//    {
//        $_SESSION["title"] = "Log hier in";
//    }

// Kijk eerst of alle velden zijn ingevoerd met isset()
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['role'])) {

    // Controleren of de user al bestaat
    $newUserName = $_POST['username'];
    $oldUserName = null;
    // Roep de class UserDaoMysql aan voor sql functionaliteit om user te checken
    $userDao = new UserDaoMysql();
    $oldUser = $userDao->selectUser($_POST['username']);
    $oldUserName = $oldUser->getUsername();

    //Geef melding als de user al bestaat
    if ($oldUserName !== null && $newUserName == $oldUserName) {
        // echo "<br> <h2>Deze username bestaat al in de database.</h2>";
echo '<script type="text/javascript">','formError2();','</script>';

        // Session leeg maken!!!!
        $_SESSION = array();
    }

    // Wachtwoord checks
    // Controleren op hoofdletters
    if (!preg_match('/[A-Z]/', $_POST['password'])) {
        $_SESSION = array();
        echo "<br> <h2> Je moet minimaal een hoofdletter invoeren! </h2>";
    }

    // Controleren op cijfers
    if (!preg_match('([0-9])', $_POST['password'])) {
        $_SESSION = array();
        echo "<br> <h2> Je moet minimaal een cijfer invoeren! </h2>";
    }

    // Controleren of wachtwoorden gelijk zijn
    if ($_POST['password'] != $_POST['password2']) {
        // Session leeg maken!!!!
        $_SESSION = array();
        // echo "<br> <h2>Helaas... uw wachtwoord is niet gelijk....</h2>";
        echo '<script type="text/javascript">','formError();','</script>';

    } else {
        //Hash het opgegeven password
        $hash = new HashPassword();
        $hash_password = $hash->hashPwd($_POST['password']);

        // Roep de class UserDaoMysql aan voor sql functionaliteit om user in te voeren in database
        $userDao = new UserDaoMysql();
        $userDao->insertUser($_POST['username'], $hash_password, $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['role']);

        // Roep de class CustomerDaoMysql aan voor sql functionaliteiten om klantenlijst op te halen
        $customerdao = new CustomerDaoMysql();
        $customers = $customerdao->selectAllCustomers();

        // Roep de class UserCustomerDaoMysql aan voor sql functionaliteit om user_customer in database te stoppen
        $userCustomerDao = new UserCustomerDaoMysql();

        //clear all userCustomers
        $userCustomerDao->clearUserCustomer($_POST['username']);

        foreach ($_POST['customers'] as $customerName) {
            $userCustomerDao->insertUserCustomer($_POST['username'], $customerName);
        }

//        var_dump($_POST['customers']);
//        die;

        echo "<p>Aanmaken gebruiker gelukt</p>";
        header('Location: ../gebruikersbeheer/overzicht.php');
    }

} else {
    // foutmeldingen als niet alles is ingevuld

}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/content.css">

    <meta charset="utf-8">
    <title>Gebruiker Aanmaken</title>

    <style media="screen">

      .username-errormessage {
        color: #eb1313;
        font-size: 80%;
        position: absolute;
        z-index: 2;
      }

      #username-error {
        border-color: #eb1313;
        border-style: solid;
        border-width: 1px;
      }

    </style>

</head>
<div class="grid-container" <?php echo $adminLoggedin ?> >

    <div class="header-left">
        <p class="breadcrumb">Home <i id="triangle-breadcrumb" class="fas fa-caret-right"></i> Gebruikersoverzicht</p>
        <h2>Nieuwe gebruiker aanmaken</h2>
    </div>

    <!-- form elements -->

    <div class="content">

        <form method="post" enctype="multipart/form-data" action="createuser.php">

            <div class="user-form form-field-padding form-field-style">
                Gebruikersnaam
                <br><input id="" type="text" name="username" minlength=5 class="input-text-style" required>
                <i class="username-errormessage"></i>
            </div>


            <div class="password-form form-field-padding form-field-style">

                <div class="password-form-initial">
                    Wachtwoord <span class="info-symbol password-info"><i class="fas fa-info-circle"></i>
                            <span class="password-infotext">Je wachtwoord moet minimaal bestaan uit:<p> 8 karakter met 1 hoofdletter en 1 nummer</p>
                            </span>
                        </span>
                    <br><input type="password" name="password" pattern="(?=.*\d)(?=.*[A-Z]).{8,}"
                               title="minimaal: 8 karakters, 1 Hoofdletter, 1 Nummer" required>
                    <i class="password-errormessage"></i>
                </div>
                <div class="password-form-confirm">
                    Herhaal wachtwoord <br><input type="password" name="password2" class="input-text-style" required>
                    <i class="password-errormessage"></i>
                </div>
            </div>

            <div class="form-field-padding form-field-padding form-field-style">
                <div class="fullname-form-fn">
                    Voornaam
                    <br><input type="text" name="firstname" minlength="2" class="input-text-style" required>
                </div>
                <div class="fullname-form-ln">
                    Achternaam
                    <br><input type="text" name="lastname" minlength="2" class="input-text-style" required>
                </div>
            </div>

            <div class="form-field-padding form-field-style email-form">
                E-mailadres
                <br><input type="email" name="email" class="input-text-style" required><br>
            </div>

            <div class="role-form form-field-padding form-field-style">
                Rol
                <br>
                <select id="roles" name="role" required>
                    <optgroup label="Kies een rol">
                        <!--<option selected disabled>Kies een rol</option>-->
                        <option value="user" selected>gebruiker</option>
                        <option value="admin">admin</option>
                    </optgroup>
                </select>
            </div>

            <div class="customer-form form-field-padding form-field-style">
                Gekoppelde klant(en)
                <br>
                <select id="user-customer" name="customers[]" required multiple="multiple">
                    <optgroup label="Kies een klant">
                        <option value="0" selected hidden>Kies een klant</option>
                        <?php foreach ($customers as $customer): ?>
                            <option value="<?= $customer["customerName"] ?>"><?= $customer["customerName"] ?></option>
                        <?php endforeach; ?>
                    </optgroup>
                </select>
            </div>

            <!-- end form elements -->

            <div class="footer"></div>

            <!-- buttons  -->

            <div class="footer-right">
                <div class="buttons-form">
                    <a href="overzicht.php" target="_self">
                        <button class="button-form-secondary" type="button">Annuleren</button>
                    </a>
                    <button class="button-form-primary" type="submit"> Opslaan</button>
                    <!-- buttons -->
                </div>
            </div>
        </form>
    </div>
</div>
</html>
