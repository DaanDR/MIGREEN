<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/customerforms.css">
    <link rel="stylesheet" href="../css/overzicht.css">
</head>

<?php
// Laden van de php met sql queries
include ('../klantbeheer/CustomerDaoMysql.php');

$customerdaomysql = new CustomerDaoMysql();

// Opvragen van de meegegeven klantnaam om te gebruiken in de eigenschappen van het tekstveld
if (isset($_GET['customer'])) {
    $currentName = $_GET['customer'];
    // Geen naam meegegeven: tekstveld is leeg
} else {
    $currentName = "";
}

?>

	<?php
// Header toevoegen aan pagina
include ('../header/header.php');

// Check of user is ingelogged en anders terug naar de login pagina
include_once ("../autorisatie/UserIsLoggedin.php");
$userLoggedin = new UserIsLoggedin();
$userLoggedin->backToLoging();

// Check of de admin is ingelogged....
$adminLoggedin = "";
if (! $userLoggedin->isAdmin()) {
    $adminLoggedin = "style='display: none;'";
    echo "<br><br><br><br><h1>Geen gebruikersrecht als admin.....</h1>";
}
?>
</div>

<body id="overzicht-container">

	<div class="grid-container" <?php echo $adminLoggedin ?>>
		<!-- Div voor het formulier voor bewerken klant -->
            <div class="header-left">
                <p class="breadcrumb">Home <i id="triangle-breadcrumb" class="fas fa-caret-right"></i> Klantenoverzicht</p>
                <h2>Klant aanpassen</h2>
            </div>
			<table>

					<div class="content">
							<form method="post"
								action="../klantbeheer/editcustomer.php?customer=<?php echo $currentName; ?>"
								name="editForm">
								<div id="formName">
									Klantnaam<br> <br> <input type="text" name="customerName"
										value=<?=$currentName?>>
								</div>
                                <div class="footer-right">

                                <div id="crudbuttons">
									<div id="cancelButton">
										<input type="button" value="Annuleren"
											onclick="location.href = 'customers.php'">
									</div>
									<div id="createButton">
										<input type="submit" value="Opslaan" name="createButton">
									</div>
								</div>
                                </div>
							</form>

			</table>


	</div>
	<script src="../js/customers.js"></script>
	<?php
// Haal de ingevulde klantnaam op (bij geen wijzigingen is dat de bestaande klantnaam)
if (isset($_POST['customerName'])) {
    
    // Klantnaam variabele voor de nieuw ingevoerde klantnaam
    $newName = $_POST['customerName'];
        
    // Als de klantnaam te kort is: geef foutmelding
    if (strlen($newName) < 2) {
        echo "<script type='text/javascript'>stringTooShort();</script>";
        
    // als de klantnaam spaties bevat: geef foutmelding
    } else if (preg_match('/\s/', $newName)) {
        echo "<script type='text/javascript'>noSpaces();</script>";
        
    // geen foutmelding: ga verder met wijzigen
    } else {
        
        // Klantnaam variabele om gegevens uit database in op te slaan
        $oldName = null;
        
        // sql functionaliteit aanroepen om namen in database te controleren
        $customerdaomysql = new CustomerDaoMysql();
        $oldCustomer = $customerdaomysql->selectCustomer($newName);
        $oldName = $oldCustomer->getCustomerName();
        
        // Check of klant al bestaat, zo ja: geef melding
        if ($oldName !== null && $newName == $oldName) {
            echo "<script type='text/javascript'>alert('Deze klant bestaat al in de database');</script>";
        
        // Check doorgekomen: wijzig in database
        } else {
            $editCustomer = $customerdaomysql->updateCustomer($currentName, $newName);
            header('Location: ../klantbeheer/customers.php');
        }
    }
}
?>
</body>
</html>