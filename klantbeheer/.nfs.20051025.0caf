
<?php
include ('../klantbeheer/CustomerDaoMysql.php');

$customerdaomysql = new CustomerDaoMysql();
$clients = $customerdaomysql->selectAllCustomers();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css"
	href="../css/klantenoverzicht.css">
</head>
<body>
	<div id="pageheader"><?php
include ('../header/header.php');
?></div>
	<div id="pagestyling">
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
    <?php foreach($clients as $client):?>
    <tr>
    <td class='klantnaam'><?=$client["customerName"]?></td>
    <td class='editbutton'><img src='../res/edit.svg'><img
     src='../res/edit-hover.svg'></td>
     <td class='deletebutton'><img src='../res/delete.svg'><img
     src='../res/delete-hover.svg'></td></tr>
    </tr>
    <?php endforeach;?>
			</tbody>
		</table>

	</div>
	<script src="../js/klantenoverzicht.js"></script>
</body>
</html>