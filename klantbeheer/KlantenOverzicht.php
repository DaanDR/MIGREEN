<?php
include ('../header/header.php');
?>
<?php
$clients = [
    [
        "KLANTNAAM" => "De Eerste Klant"
    ],
    [
        "KLANTNAAM" => "De Tweede Klant"
    ],
    [
        "KLANTNAAM" => "De Derde Klant"
    ],
    [
        "KLANTNAAM" => "De Vierde Klant"
    ]
];
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css"
	href="../css/KlantenOverzicht.css">
</head>
<body>
	<div id="pagestyling">
		<table>
			<thead>
				<tr>
					<th id="tabletitle">Klantoverzicht</th>
					<th></th>
					<th><button class="new-customer-button" type="button" name="button">Nieuwe klant aanmaken</button></th>
				</tr>
			</thead>


			<tbody>
				<tr>
					<td>Klantnaam</td>
					<td></td>
					<td></td>
				</tr>
				<!--   <?php getAllClients(); ?> -->

       <!--    <?php foreach($clients as $client):?>
          <tr>
					<td><?=$client["KLANTNAAM"]?></td>
					<td><img src="../res/edit.svg"></td>
					<td><img src="../res/delete.svg"></td>
				</tr>
        <?php endforeach;?> -->

		</tbody>
		</table>
	</div>
</body>
</html>