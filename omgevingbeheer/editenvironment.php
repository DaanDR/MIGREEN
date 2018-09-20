<?php
// Header in de bovenkant
include ("../header/header.php");

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

    // Sla de relevante gegevens van de te wijzigen omgeving op in eigen variabele
    $currentEnvironmentSystemID = $currentEnvironment->getSystemID();
    $currentEnvironmentSystemName = $currentEnvironment->getSystemName();
    $currentEnvironmentCustomername = $currentEnvironment->getCustomerName();
    $currentEnvironmentVmURL = $currentEnvironment->getVmURL();

    // customerDao voor selecteren in dropdown menu van klanten
    include ('../klantbeheer/CustomerDaoMysql.php');
    $customerdaomysql = new CustomerDaoMysql();
    $customers = $customerdaomysql-> selectAllCustomers();
        

    // Kijk eerst of alle velden zijn ingevoerd met isset()
    if( isset($_POST['systemName']) && isset($_POST['vmURL']))
    {
        //Check of de systemName minimaal uit 5 karakters bestaat
        $numberOfChars = strlen($_POST['systemName']);
        if ($numberOfChars >= 5){
            $checkNumberOfCharsOK = TRUE;
        } else 
        {
            $checkNumberOfCharsOK = FALSE;
            echo "<br> <h2> Het aantal karakters van de systeemnaam moet minimaal 5 zijn!</h2>";
        }   
                
        //Checken of de keuze "Geen klant koppelen" ofwel none is
        if($_POST['customerName']=="none"){
            $customerToDB = null;
        } else {
            $customerToDB = $_POST['customerName'];
        }
        
        
        if($checkNumberOfCharsOK == TRUE){
            // Roep de class EnvironmentDaoMysql aan voor sql functionaliteit om omgeving in te voeren in database
            $updateEnvironment = new EnvironmentDaoMysql();
            $updateEnvironment = $updateEnvironment->updateEnvironment( $_POST["systemID"], $_POST["systemName"], $customerToDB, $_POST["vmURL"] );
            
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
                        <select name="customerName">
                            <optgroup label="Kies een klant">
                                <option selected hidden default value = "<?php echo $currentEnvironmentCustomername ?>"><?php if($currentEnvironmentCustomername==null){echo "Geen gekoppelde klant";}else{echo $currentEnvironmentCustomername;} ?></option>
                                <option value= "none" >Geen klant koppelen </option>
                                <?php foreach($customers as $customer):?>
                                    <option value="<?php echo $customer['customerName'] ?>"><?=$customer["customerName"]?> </option>
                                    <?php endforeach;?>
                            </optgroup>
                        </select>
            </div>
            <div class="user-form form-field-padding form-field-style">
                VM URL 
                <br><input type="text" name="vmURL" class="input-text-style" value="<?php echo $currentEnvironmentVmURL ?>" required>
            </div>
            <div class="user-form form-field-padding form-field-style">
                 <!-- de onderstaande onzichtbare button zorgt voor de opvang van het systemID voor de sql query -->
                <br><input type="text" name="systemID" class="input-text-style" value="<?php echo $currentEnvironmentSystemID ?>" required hidden>
            </div>
           
            

    </div>

    <!-- end form elements -->

    <div class="footer"></div>
    

    <!-- buttons  -->

    <div class="footer-right">
        <div class="buttons-form">
            <a href="omgevingsoverzicht.php" target="_self">
            <button class="button-form-secondary" type="button">Annuleren</button></a>
            <button class="button-form-primary" type="submit"> Opslaan </button>
            <!-- buttons -->
     
        </div> 
    
    </div>
        
    </form>

</html>


