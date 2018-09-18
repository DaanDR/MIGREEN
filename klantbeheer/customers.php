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

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/overzicht.css">
</head>

<?php
include ('../klantbeheer/CustomerDaoMysql.php');
include ('../header/header.php');




$customerdaomysql = new CustomerDaoMysql();
$customers = $customerdaomysql->selectAllCustomers();

?>
<body>
	<div id="pageheader"><?php
include ('../header/header.php');
		
		// Check of user is ingelogged en anders terug naar de login pagina
  include_once ("../autorisatie/UserIsLoggedin.php");
  $userLoggedin = new UserIsLoggedin();
  $userLoggedin->backToLoging();

  // Check of de admin is ingelogged....
  $adminLoggedin = "";
  if( ! $userLoggedin->isAdmin() )
  {
      $adminLoggedin = "style='display: none;'";
      echo "<br><br><br><br><h1>Geen gebruikersrecht als admin.....</h1>";
  }
?></div>
	<div id="pagestyling" <?php echo $adminLoggedin ?>>
		<!-- Div voor de tabel met klantnamen -->
		<div id="customerTable" >
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
						<td class='editbutton'><a
							href="../klantbeheer/editcustomer.php?customer=<?php echo $client["customerName"]; ?>"><img
							src='../res/edit.svg'><img src='../res/edit-hover.svg'></a></td>
						<td class='deletebutton'><a onclick="return confirm('Wilt u klant <?php echo $client["customerName"] ?> echt verwijderen?');" 
							href="../klantbeheer/customers.php?action=delete&customer=<?php echo $client["customerName"]; ?>"><img src='../res/delete.svg'><img
							src='../res/delete-hover.svg'></a></td>
					</tr>
					</tr>
    <?php endforeach;?>
			</tbody>
			</table>
		</div>
	</div>
	<script src="../js/customers.js"></script>
	<?php 
	
	if (! isset($_GET["action"])) {
	    $action = "Home";
	} else {
	    $action = $_GET["action"];
	}
	
	switch ($action) {
	    case "Home":
	        break;
	    case "delete":
	        if(isset($_GET['customer'])){
	            
	            $deleteCustomer = $customerdaomysql->deleteCustomer($_GET['customer']);
	            echo '<script type="text/javascript"> customerDeleted(<?=$client["customerName"]?>); </script>';
	            header("Location: ../klantbeheer/customers.php");
	        }
	        break;
	}
	?>
</body>
</html>
