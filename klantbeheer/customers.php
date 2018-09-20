<?php

// Header toevoegen aan pagina
include ('../header/header.php');

// Laden van de php met sql queries
include ('../klantbeheer/CustomerDaoMysql.php');

// Niewe database connectie aanmaken en alle klanten selecteren voor het overzicht
$customerdaomysql = new CustomerDaoMysql();
$customers = $customerdaomysql->selectAllCustomers();

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
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/overzicht.css">
<title>Klantenoverzicht</title>
</head>
<body>


<body id="overzicht-container">
	<div class="grid-container">
		<div class="header-left">
			<h1>Home</h1>
			<h2>Klantoverzicht</h2>
		</div>
		<div class="header-mid"></div>
		<div class="header-right">
			<a href="createcustomer.php" target="_self">
				<button class="new-user-button" type="button" name="button">Nieuwe
					klant aanmaken</button>
			</a>
		</div>
		<div class="content">
			<table>
				<thead>
					<tr>
						<th>KLANTNAAM</th>
						<th></th>
					</tr>
				</thead>
				<tbody>


					<!--                Dit is de foreach van de oude styling, daarom zien de buttons er niet goed uit.(MAAR WERKT) -->

    <?php foreach($customers as $client):?>
    <tr class="withhover">
						<td class='klantnaam'><?=$client["customerName"]?></td>
						<td class='editbutton'><a
							href="../klantbeheer/editcustomer.php?customer=<?php echo $client["customerName"]; ?>"><img
								src='../res/edit.svg'><img src='../res/edit-hover.svg'></a></td>
						<td class='deletebutton'><a
							onclick="return confirm('Wilt u klant <?php echo $client["customerName"] ?> echt verwijderen?');"
							href="../klantbeheer/customers.php?action=delete&customer=<?php echo $client["customerName"]; ?>"><img
								src='../res/delete.svg'><img src='../res/delete-hover.svg'></a></td>
					</tr>
					</tr>
    <?php endforeach;?>

<!--        Onderstaande foreach is correct met styling maar mist de nodige functionaliteit (verwijderen/editen)-->

<?php foreach($customers as $client):?>
    <tr>
						<td><?=$client["customerName"] ?></td>
						<td class="icon-cell" id="klant-icon-cell"><a
							href="../klantbeheer/editcustomer.php?customer=<?php echo $client["customerName"]; ?>">
								<i class="editbutton"><img src='../res/edit.svg'><img
									src='../res/edit-hover.svg'></i></a></td>
						<td class='deletebutton'><a
							onclick="return confirm('Wilt u klant <?php echo $client["customerName"] ?> echt verwijderen?');"
							href="../klantbeheer/customers.php?action=delete&customer=<?php echo $client["customerName"]; ?>">
								<i class="deletebutton"><img src='../res/delete.svg'><img
									src='../res/delete-hover.svg'></i></a></td>
					</tr>
<?php endforeach;?>


			</tbody>
			</table>
		</div>
	</div>
	<!-- Javascript bestand laden voor de aanmaak-knop -->
	<script src="../js/customers.js"></script>
	<?php
// Check of er een 'action' variabele is meegegeven (word gedaan door de aanmaak- en verwijderknop)
if (! isset($_GET["action"])) {
    $action = "Home";
} else {
    $action = $_GET["action"];
}

// Reageer afhankelijk van de meegegeven 'action' variabele
switch ($action) {
    case "Home":
        break;
    case "delete":
        if (isset($_GET['customer'])) {
            // Klant verwijderen uit de database met soft-delete
            $deleteCustomer = $customerdaomysql->deleteCustomer($_GET['customer']);
            header("Location: ../klantbeheer/customers.php");
        }
        break;
}
?>
</body>
</html>