<!DOCTYPE html>
<html>
<head>
<!-- Meegeven van de juiste css file -->
<link rel="stylesheet" type="text/css" href="../css/customerforms.css">
</head>

<?php
include ('../klantbeheer/CustomerDaoMysql.php');

?>
<body>
	<div id="pageheader"><?php
// Header toevoegen aan de pagina
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
	<div id="pagestyling" <?php echo $adminLoggedin ?>>
		<!-- Div voor het formulier voor aanmaken klant -->
		<div id="createCustomer">
			<table>
				<thead>
					<tr class="nohover">
						<th id="tabletitle">Home <img src='../res/kruimelpad-arrow.svg'>
							Klantenoverzicht
							<p>Klant</p>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr class="nohover">
						<td>
							<form method="post" action="../klantbeheer/createcustomer.php">
								<div id="formName">
									Klantnaam<br> <br> <input type="text" name="customerName"
										id="customerName" value="<?= isset($_POST['customerName']) ? $_POST['customerName'] : ''; ?>">
								</div>
								<div id="crudbuttons">
									<div id="cancelButton">
										<input type="button" value="Annuleren"
											onclick="location.href = 'customers.php'">
									</div>
									<div id="createButton">
										<input type="submit" value="Opslaan" name="createButton">
									</div>
								</div>
							</form>
						</td>
				
				</tbody>
			</table>
		</div>
	</div>
	
	<?php
// check of er een klantnaam is ingevuld
if (isset($_POST['customerName'])) {
    
    // Klantnaam variabele voor de nieuw ingevoerde klantnaam
    $newCustomerName = $_POST['customerName'];
    
    // als de klantnaam te kort is: geef foutmelding
    if (strlen($newCustomerName) < 2) {
        echo "<script type='text/javascript'>stringTooShort();</script>";
        
    // als de klantnaam spaties bevat: geef foutmelding
    } else if (preg_match('/\s/', $newCustomerName)) {
        echo "<script type='text/javascript'>noSpaces();</script>";
        
    // geen foutmelding: ga verder met toevoegen
    } else {
        
        // Klantnaam variabele om gegevens uit database in op te slaan
        $oldCustomerName = null;
        
        // sql functionaliteit aanroepen om namen in database te controleren
        $customerdaomysql = new CustomerDaoMysql();
        $oldCustomer = $customerdaomysql->selectCustomer($newCustomerName);
        $oldCustomerName = $oldCustomer->getCustomerName();
        
        // Check of klant al bestaat, zo ja: geef melding
        if ($oldCustomerName !== null && $newCustomerName == $oldCustomerName) {
            echo "<script type='text/javascript'>alert('Deze klant bestaat al in de database');</script>";
            
        // Check doorgekomen: voeg toe aan database    
        } else {
            $createCustomer = $customerdaomysql->insertCustomer($_POST['customerName']);
            header('Location: ../klantbeheer/customers.php');
        }
    }
}
?>
<script src="../js/customers.js"></script>
</body>
</html>