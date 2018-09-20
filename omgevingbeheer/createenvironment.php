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
    

    // Title van de pagina...
    if(!isset($_SESSION))
    {
        $_SESSION["title"] = "Nieuwe Omgeving Aanmaken";
    }

     // customerDao voor het ophalen van alle klanten
    include ('../klantbeheer/CustomerDaoMysql.php');

    $customerdaomysql = new CustomerDaoMysql();
    $customers = $customerdaomysql-> selectAllCustomers();
    

    // Kijk eerst of alle velden zijn ingevoerd met isset()
    if( isset($_POST['systemName']) && isset($_POST['vmURL']))
    {
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
            $checkSystemNameIsNew = FALSE;
            echo "<br> <h2>Deze omgeving bestaat al in de database.</h2>";
        } else
        {
            $checkSystemNameIsNew = TRUE;
        }
        
        
        //Check of de systemName minimaal uit 5 karakters bestaat
        $numberOfChars = strlen($_POST['systemName']);
        if ($numberOfChars >= 5){
            $checkNumberOfCharsOK = TRUE;
        } else 
        {
            $checkNumberOfCharsOK = FALSE;
            echo "<br> <h2> Het aantal karakters van de systeemnaam moet minimaal 5 zijn!</h2>";
        }
        
        
        // Als alles ok is, nieuwe omgeving wegschrijven naar de database
        if($checkSystemNameIsNew == TRUE && $checkNumberOfCharsOK == TRUE){
            // Roep de class EnvironmentDaoMysql aan voor sql functionaliteit om omgeving in te voeren in database
            $createEnvironment = new EnvironmentDaoMysql();
            $createEnvironment = $createEnvironment->insertEnvironment( $_POST['systemName'], $_POST["customerName"], $_POST['vmURL'] );
            echo "<p>Aanmaken nieuwe Omgeving gelukt</p>";
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
    <title>Omgeving Aanmaken</title>
</head>
<body>
<div class="grid-container" <?php echo $adminLoggedin ?> >

    <div class="header-left">
        <p class="breadcrumb">Home <i id="triangle-breadcrumb" class="fas fa-caret-right"></i> Omgevingsoverzicht</p>
        <h2>Omgeving aanmaken</h2>
    </div>


    <div class="header"></div>

    <!-- form elements -->

    <div class="content">

        <form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'];?>">

            <div class="user-form form-field-padding form-field-style">
                Systeemnaam 
                <br><input type="text" name="systemName" minlength=5 class="input-text-style" required>
            </div>
            
            <div class="customer-form form-field-padding form-field-style">
                        Beschikbare klanten
                        <br>
                        <select name="customerName">
                            <optgroup label="Kies een klant">
                                <option selected hidden>Kies een klant (optioneel)</option>
                                <?php foreach($customers as $customer):?>
                                    <option value="<?php echo $customer['customerName'] ?>"><?=$customer["customerName"]?> </option>
                                <?php endforeach;?>
                            </optgroup>
                        </select>
            </div>
            <div class="user-form form-field-padding form-field-style">
                VM URL 
                <br><input type="text" name="vmURL" class="input-text-style" required>
            </div>
            
         
    </div>

    <!-- end form elements -->

    <div class="footer"></div>

    <!-- buttons   -->

    <div class="footer-right">
        <div class="buttons-form">
            <a href="omgevingsoverzicht.php" target="_self">
            <button class="button-form-secondary" type="button">Annuleren</button></a>
            <button class="button-form-primary" type="submit" value="Aanmaken"> Omgeving aanmaken </button>
            <!-- buttons -->
            <div>
                </form>
            </div>
     </body>
</html>