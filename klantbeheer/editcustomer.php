<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/customerforms.css">
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
<body>
	<div id="pageheader">
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
	<div id="pagestyling" <?php echo $adminLoggedin ?>>
		<!-- Div voor het formulier voor bewerken klant -->
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
							<form method="post"
								action="../klantbeheer/editcustomer.php?customer=<?php echo $currentName; ?>"
								name="editForm">
								<div id="formName">
									Klantnaam<br> <br> <input type="text" name="customerName"
										value=<?=$currentName?>>
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
	<script src="../js/customers.js"></script>
	<?php
// Haal de ingevulde klantnaam op (bij geen wijzigingen is dat de bestaande klantnaam)
if (isset($_POST['customerName'])) {
    $newName = $_POST['customerName'];
    
    // Als de klantnaam te kort is: geef foutmelding
    if (strlen($newName) < 2) {
        echo "<script type='text/javascript'>stringTooShort();</script>";
        
    // als de klantnaam spaties bevat: geef foutmelding
    } else if (preg_match('/\s/', $_POST['customerName'])) {
        echo "<script type='text/javascript'>noSpaces();</script>";
        
    // Check doorgekomen: wijzig in database
    } else {
        $editCustomer = $customerdaomysql->updateCustomer($currentName, $newName);
        header('Location: ../klantbeheer/customers.php');
    }
}
?>
</body>
</html>