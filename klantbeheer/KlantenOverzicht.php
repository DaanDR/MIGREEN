<?php
include ('../header/header.php');
?>
<?php
$clients = [
    ["KLANTNAAM"=>"De Eerste Klant"],
    ["KLANTNAAM"=>"De Tweede Klant"],
    ["KLANTNAAM"=>"De Derde Klant"],
    ["KLANTNAAM"=>"De Vierde Klant"]];
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css"
	href="../css/KlantenOverzicht.css">
</head>
<body>
	<div id="resulttable">
		<table>
			<thead>
				<tr>
					<th>Klantnaam</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<!--   <?php getAllClients(); ?> -->

         <?php foreach($clients as $client):?>
          <tr>
					<td><?=$client["KLANTNAAM"]?></td>
					<td><img src="../res/edit.svg"></td>
					<td><img src="../res/delete.svg"></td>
					<td class="icon-cell"><i class="fas fa-poo glyph-icon"></i> <i
						class="fas fa-trash-alt glyph-icon"></i></td>
				</tr>
        <?php endforeach;?>

		</tbody>
		</table>
	</div>
</body>
</html>