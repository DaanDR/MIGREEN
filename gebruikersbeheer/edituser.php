<?php
// Header in de bovenkant
include ("../header/header.php");

// Check of user is ingelogged en anders terug naar de login pagina
include_once ("../autorisatie/UserIsLoggedin.php");
include ("../autorisatie/HashPassword.php");

$userLoggedin = new UserIsLoggedin();
$userLoggedin->backToLoging();

// Check of de admin is ingelogged....
$adminLoggedin = "";
if( ! $userLoggedin->isAdmin() ) {
    $adminLoggedin = "style='display: none;'";
    echo "<br><br><br><br><h1>Geen gerbuikersrecht als admin.....</h1>";
}

// Is logged in class
include_once ("../autorisatie/UserDaoMysql.php");
include_once ("../gebruiker_klantbeheer/UserCustomerDaoMysql.php");
include_once ("../klantbeheer/CustomerDaoMysql.php");

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

    // Haal de gekoppelde klanten uit de koppeltabel in de database
    $userCustomerDao = new userCustomerDaoMysql();
    $customersByUser = $userCustomerDao->getCustomersByUsername($userName);

//    var_dump($customers);
//    die;

    // Roep de class CustomerDaoMysql aan voor sql functionaliteiten om klantenlijst op te halen
    $customerdao = new CustomerDaoMysql();
    $customers = $customerdao->selectAllCustomers();


    // Eerste formulier voor edit user

    // Kijk eerst of alle velden zijn ingevoerd met isset()
    if( isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['role']) ) {
        
        if ( !empty($_POST['password']) ){
            
            // Password Checks
            
            // Controleren op hoofdletters
            if( !preg_match('/[A-Z]/', $_POST['password']) ){
                echo "<br> <h2> Je moet minimaal een hoofdletter invoeren! </h2>";
                $checkHoofdletter = FALSE;
            } else {
                $checkHoofdletter = TRUE;
            }

            // Controleren op cijfers
            if ( !preg_match('([0-9])', $_POST['password']) ){
                echo "<br> <h2> Je moet minimaal een cijfer invoeren! </h2>";
                $checkGetal = FALSE;
            } else {
                $checkGetal = TRUE;
            }

            // Controleren of wachtwoorden gelijk zijn
            if( $_POST['password'] != $_POST['password2'] ){
                echo "<br> <h2>Helaas... uw wachtwoord is niet gelijk....</h2>";
                $checkGelijk = FALSE;
            } else {
                $checkGelijk = TRUE;
            }
            
            if ($checkHoofdletter == TRUE && $checkGetal == TRUE && $checkGelijk == TRUE){
            
                //Hash het opgegeven password
                $hash = new HashPassword();
                $hash_password = $hash->hashPwd($_POST['password']);
                
                // Roep de class UserDaoMysql aan voor sql functionaliteit om user in te voeren in database
                $userDao = new UserDaoMysql();
                $userDao->updateUser( $userName, $hash_password, $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['role'] );
                
                // Roep de class UserCustomerDaoMysql aan voor sql functionaliteit om user_customer in database te stoppen
                $userCustomerDao = new UserCustomerDaoMysql();

            // Clear all userCustomers om met schone lei te beginnen
            $userCustomerDao->clearUserCustomer($userName);
        
            // Voer de nieuw geselecteerde customers in in de koppeltabel
            foreach ($_POST['customers'] as $customerName) {
                $userCustomerDao-> insertUserCustomer($userName, $customerName);
            }
                
                header('Location: http://' . APP_PATH . 'gebruikersbeheer/overzicht.php');
            }
                
        } else {
            
            // Roep de class UserDaoMysql aan voor sql functionaliteit om user in te voeren in database
            $userDao2 = new UserDaoMysql();
            $passwordleeg = "0000";
            $userDao2->updateUser( $userName, $passwordleeg, $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['role'] );
            
            // Roep de class UserCustomerDaoMysql aan voor sql functionaliteit om user_customer in database te stoppen
            $userCustomerDao = new UserCustomerDaoMysql();

            // Clear all userCustomers om met schone lei te beginnen
            $userCustomerDao->clearUserCustomer($userName);
        
            // Voer de nieuw geselecteerde customers in in de koppeltabel
            foreach ($_POST['customers'] as $customerName) {
                $userCustomerDao-> insertUserCustomer($userName, $customerName);
            }

            header('Location: http://' . APP_PATH . 'gebruikersbeheer/overzicht.php');
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

    <!-- form elements pattern="(?=.*\d)(?=.*[A-Z]).{8,}" -->

    <div class="content">

        <form method="post" enctype="multipart/form-data" action="edituser.php?username=<?php echo $userName ?>">

            <div class="password-form form-field-padding form-field-style">

                <div class="password-form-initial">
                    Wachtwoord <span class="info-symbol password-info"><i class="fas fa-info-circle"></i><span class="password-infotext">Je wachtwoord moet minimaal bestaan uit:<p> 8 karakter met 1 hoofdletter en 1 nummer</p></span></span>
                    <br><input type="password" name="password" title="minimaal: 8 karakters, 1 Hoofdletter, 1 Nummer">
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
            
            <div class="customer-form form-field-padding form-field-style">
                Gekoppelde klant(en)
                <br>
                <select id="user-customer" name="customers[]" required multiple="multiple">
                    <optgroup label="Kies een klant">
                        <option value="0" selected hidden>Kies een klant</option>
                        <option value= "none" >Geen klant koppelen </option>
                        <?php foreach ($customers as $customer): ?>
                            <option <?php if(in_array($customer["customerName"], $customersByUser)) { echo "selected";}?> value="<?= $customer["customerName"] ?>"><?= $customer["customerName"] ?></option>
                        <?php endforeach; ?>
                    </optgroup>
                </select>
            </div>
            
             
    <!-- end form elements>-->

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
        
        
    </div>
    </div>
    
</html>