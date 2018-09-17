
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css"
	href="../css/klantenoverzicht.css">
</head>

<?php
include ('../klantbeheer/CustomerDaoMysql.php');

$customerdaomysql = new CustomerDaoMysql();
$customers = $customerdaomysql->selectAllCustomers();

?>
<body>
	<div id="pageheader"><?php
include ('../header/header.php');
?></div>
	<div id="pagestyling">
		<div id="customerTable">
			<table>
				<thead>
					<tr>
						<th id="tabletitle">Home
							<p>Klantoverzicht</p>
						</th>
						<th></th>
						<th id="new-customer-button"><button class="new-customer-button"
								type="button" name="button">Nieuwe klant aanmaken</button></th>
					</tr>
					<tr>
						<th id="tablehead">KLANTNAAM</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
    <?php foreach($customers as $client):?>
    <tr class="withhover">
						<td class='klantnaam'><?=$client["customerName"]?></td>
						<td class='editbutton'><img src='../res/edit.svg'><img
							src='../res/edit-hover.svg'></td>
						<td class='deletebutton'><img src='../res/delete.svg'><img
							src='../res/delete-hover.svg'></td>
					</tr>
					</tr>
    <?php endforeach;?>
			</tbody>
			</table>
		</div>
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
							<form method="post" action="../klantbeheer/klantenoverzicht.php">
								<div id="formName">
									Klantnaam<br> <br> <input type="text" name="customerName">
								</div>
								<div id="crudbuttons">
									<div id="cancelButton">
										<input type="submit" value="Annuleren" name="cancelButton">
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
	<script src="../js/klantenoverzicht.js"></script>
	<?php
if (isset($_POST['customerName'])) {
    if (strlen($_POST['customerName']) < 2) {
        echo "<script type='text/javascript'>stringTooShort();</script>";
    } else {
        $createCustomer = $customerdaomysql->insertCustomer($_POST['customerName']);
        header('Location: ../klantbeheer/klantenoverzicht.php');
    }
}
?>
</body>
</html>