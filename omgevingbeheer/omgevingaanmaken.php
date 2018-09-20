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


// Header in de bovenkant
include ("../header/header.php");

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
if( isset($_POST['username']) && isset($_POST['password']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['role']) )
{
    // Controleren of de user al bestaat
    // Roep de class UserDaoMysql aan voor sql functionaliteit om user te checken
    $newUser = new EnvironmentDaoMysql();
    $newEnvironment = $newEnvironment->selectEnvironment( $_POST['systemName'] );

    // Haal de user info uit de User array/object $loginUser
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
        $createEnvironment = $createEnvironment->insertEnvironment( $_POST['systemName'], $_POST['customerName'], $_POST['vmURL'] );
        echo "<p>Aanmaken nieuwe Omgeving gelukt</p>";
        header('Location: http://' . APP_PATH . 'omgevingbeheer/omgevingsoverzicht.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/form.css">
    <link rel="stylesheet" type="text/css" href="../css/content.css">
    <link rel="stylesheet" type="text/css" href="../css/omgevingaanmaken.css">


    <meta charset="utf-8">
    <title>Omgeving aanmaken</title>
</head>
<body>
<div class="container" <?php echo $adminLoggedin ?> >

    <div class="grid-wrapper" >
        <div class="grid-header-left">
            <p class="breadcrumb">Home &nbsp;<i id="triangle-breadcrumb" class="fas fa-caret-right"></i> &nbsp;Omgevingenoverzicht</p>
            <h2>Omgeving aanmaken</h2>

        </div>

        <div class="grid-header-right"> </div>

        <div class="grid-content-left">

            <div class="progressbar-wrapper">
                <div class="progressbar-col-icons">
                    <div class="progressbar-proto">
                        <div style="text-align:center;margin-top:40px;">
                            <span class="step"><i class="progressbar-icon fas fa-info-circle"></i></span>
                            <div class="progressbar-line"></div>
                            <span class="step"><i class="progressbar-icon fas fa-database"></i></span>
                            <div class="progressbar-line"></div>
                            <span class="step"><i class="progressbar-icon fas fa-exchange-alt"></i></span>
                        </div>
                    </div>
                </div>

                <div class="progressbar-col-titles">
                    <div class="step-title">1. Basisgegevens</div>
                    <div class="step-title">2. Systemen</div>
                    <div class="step-title">3. Relaties</div>
                </div>

            </div>

        </div>

        <div class="grid-content-right">

            <form id="regForm" action="welcome.php" method="post">

                <div class="tab"> <!-- Eerste Tab -->
                    <h3>Basisgegevens</h3>
                    <p>In deze stap kan je het systeem een naam geven en koppelen aan een klant.</p>

                    <ul>
                        <li>Omgeving naam<br><input type="text" name="name" required="required" oninput="this.className = ''"></li>

                        <li>Gekoppelde klant<br>
                            <select id="omgevingaanmaken-select" type="select" name="email" required="required" oninput="this.className = ''">
                                <option value="klant1">klant1</option>
                                <option value="klant2">klant2</option>
                            </select>
                        </li>

                        <li>VM URL<br><input type="text" name="vmurl" required="required" oninput="this.className = ''"></li>

                    </ul>
                    <!--</fieldset>-->

                    <!-- fieldset two -->

                    <!--<fieldset>-->
                </div>
                <div class="tab">       <!--<div class="form-title">-->
                    <h3>Systemen</h3>
                    <p>In deze stap is het mogelijk om systemen te hernoemen en overige informatie aan te passen.</p>
                    <div class="systeem-input-wrapper">

                        <div class="systeem-input-naam">
                            <p>Systeem naam</p>
                            <input type="text" name="systeemnaam" required="required">
                        </div>

                        <div class="systeem-input-hernoemsysteem">
                            <p>Hernoem systeem</p>
                            <input type="text" name="hernoemsyteem" required="required">
                        </div>

                        <div class="system-input-type">
                            <p>Type</p>
                            <select id="systeem-select" type="select" name="systeem-type" required="required">
                                <option value="VM">Virtual Machine</option>
                                <option value="testserver">Testing</option>
                                <option value="database">Database</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="tab">

                    <div class="relaties-information">
                        <h3>Relaties</h3>
                        <p>In deze stap kan voor het systeem relaties aangeven tussen de machines.</p>
                        <p>Kies eerst een machine uit lijst 1, de relatie met de andere machine(enkel- of tweezijdig) en tot slot de andere machine.</p>
                        <p>Optioneel kan je een beschrijving toevoegen aan deze relatie.</p>
                        <br>
                        <p>Bij meerdere relaties zal je meerdere relaties moet opgeven. Dit kan met de + knop.</p>
                    </div>

                    <div class="relaties-wrapper">

                        <div class="relaties-col-one">
                            <p>Machine 1</p>
                            <input type="text" name="" value="">
                            <p>Protocol</p>
                            <input type="text" name="" value="">

                        </div>

                        <div class="relaties-col-two">
                            <p>Relatie</p>
                            <input type="text" name="" value="">
                            <p>Poort</p>
                            <input type="text" name="" value="">
                        </div>

                        <div class="relaties-col-three">
                            <p>Machine 1</p>
                            <input type="text" name="" value="">
                        </div>

                        <div class="relaties-row-two">
                            <p>Beschrijving relatie</p>
                            <textarea class="relaties-textarea"name="Text1"></textarea>
                        </div>


                    </div>

                </div>




                <!--</fieldset>-->
            </form>

        </div>
        <div class="grid-footer-left"> </div>

        <div class="grid-footer-right">
            <div class="gebruikeraanmaken-buttons">
                <button class="button-form-secondary" name="button" id="prevBtn" onclick="nextPrev(-1)">Annuleren</button>
                <button class="button-form-primary" id="nextBtn" onclick="nextPrev(1)">Volgende stap</button>
            </div>

        </div>


    </div>
</div>

</body>
<script src="omgevingaanmaken.js"></script>

</html>

