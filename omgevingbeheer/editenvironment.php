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
    include_once ("EnvironmentDaoMysql.php");
    

    // Vang de meegegeven omgevingsnaam op
    if (! isset($_GET["systemName"])) {
        $systemName = null;
    } else {
        $systemName = $_GET["systemName"];
    }

    // Haal de omgeving uit de database met de opgegeven systemName
    $environmentDao = new EnvironmentDaoMysql();
    $currentEnvironment = $environmentDao->selectEnvironment($systemName);

    // Sla de relevante gegevens op in eigen variabele
    $currentEnvironmentSystemName = $currentEnvironment->getSystemName();
    $currentEnvironmentCustomername = $currentEnvironment->getCustomerName();

    // customerDao voor selecteren van alle klanten
    include ('../klantbeheer/CustomerDaoMysql.php');

    $customerdaomysql = new CustomerDaoMysql();
    $customers = $customerdaomysql-> selectAllCustomers();
    
    
    

    // Kijk eerst of alle velden zijn ingevoerd met isset()
    if( isset($_POST['systemName']) ) {
        
        // Controleren of de omgeving al bestaat
        // Roep de class EnvironmentDaoMysql aan voor sql functionaliteit om omgeving te checken
        $newEnvironment = new EnvironmentDaoMysql();
        $newEnvironment = $newEnvironment->selectEnvironment( $_POST['systemName'] );

        // Haal de environment info uit de Environment array/object 
        // en maak session vars aan.
        $_SESSION['systemName'] =  $newEnvironment->getSystemName();

        //Geef melding als de omgeving al bestaat
        if( $_POST['systemName'] == $_SESSION['systemName'])
        {
            // Session leeg maken!!!!
            $_SESSION = array();
            echo "<br> <h2>Deze omgeving bestaat al in de database.</h2>";
        }

        else
        {
            // Roep de class EnvironmentDaoMysql aan voor sql functionaliteit om omgeving in te voeren in database
            $updateEnvironment = new EnvironmentDaoMysql();
            $updateEnvironment = $updateEnvironment->updateEnvironment($currentEnvironmentSystemName, $_POST['systemName'], $_POST['customerName'] );
            echo "<p>Wijzigen Omgeving gelukt</p>";
            header('Location: http://' . APP_PATH . 'omgevingbeheer/omgevingsoverzicht.php');
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
    <title>Omgeving Bewerken</title>
</head>

<div class="grid-container" <?php echo $adminLoggedin ?> >
    

    <div class="header-left">
        <p class="breadcrumb">Home <i id="triangle-breadcrumb" class="fas fa-caret-right"></i> Omgeving Bewerken</p>
        <h2>Omgeving bewerken: <?php echo $currentEnvironmentSystemName ?></h2>
        
        <p> Deze omgeving in momenteel aan de volgende klant gekoppeld: <?php echo $currentEnvironmentCustomername ?> </p>
    </div>


    <div class="header"></div>

    <!-- form elements -->
    <div class="content">

        <form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'];?>">

            <div class="user-form form-field-padding form-field-style">
                Systeemnaam 
                <br><input type="text" name="systemName" minlength=5 class="input-text-style" value="<?php echo $currentEnvironmentSystemName ?>"required>
            </div>
            
            <div class="customer-form form-field-padding form-field-style">
                        Beschikbare klanten
                        <br>
                        <select name="customers">
                            <optgroup label="Kies een klant">
                                <option selected hidden> "Optioneel" </option>
                                <?php foreach($customers as $customer):?>
                                    <option value="{$customer['customerName']}"><?=$customer["customerName"]?> </option>
                                    <?php endforeach;?>
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


