<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/customerforms.css">
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
										id="customerName" value="">
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
if (isset($_POST['customerName'])) {
    if (strlen($_POST['customerName']) < 2) {
        echo "<script type='text/javascript'>stringTooShort();</script>";
    } else if(preg_match('/\s/', $_POST['customerName'])){
        echo "<script type='text/javascript'>noSpaces();</script>";
} else {
    $createCustomer = $customerdaomysql->insertCustomer($_POST['customerName']);
    header('Location: ../klantbeheer/customers.php');
}
}
?>
</body>
</html>