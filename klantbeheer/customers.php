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
    <body id="overzicht-container">


    <div class="grid-container"  >
        <div class="header-left">
            <h1>Home</h1>
            <h2>Klantoverzicht</h2>
        </div>
        <div class="header-mid"></div>
        <div class="header-right">

            <a href="createuser.php" target="_self">
                <button class="new-user-button" type="button" name="button">Nieuwe klant aanmaken</button>
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
						<td class='deletebutton'><a onclick="return confirm('Wilt u klant <?php echo $client["customerName"] ?> echt verwijderen?');"
							href="../klantbeheer/customers.php?action=delete&customer=<?php echo $client["customerName"]; ?>"><img src='../res/delete.svg'><img
							src='../res/delete-hover.svg'></a></td>
					</tr>
					</tr>
    <?php endforeach;?>

<!--        Onderstaande foreach is correct met styling maar mist de nodige functionaliteit (verwijderen/editen)-->

<?php foreach($customers as $client):?>
    <tr>
        <td><?=$client["customerName"] ?></td>
        <td class="icon-cell" id="klant-icon-cell">
            <a href="../gebruikersbeheer/overzicht.php?action=edit&userName=<?php echo $client; ?>">
                <i class="editbutton"><img src='../res/edit.svg'><img
                            src='../res/edit-hover.svg'></i></a>
            <a href="../gebruikersbeheer/overzicht.php?action=delete&userName=<?php echo $client; ?>">
                <i class="deletebutton" onclick="return confirmDelete('<?php echo $client ?>');"><img src='../res/delete.svg'><img
                            src='../res/delete-hover.svg'></i></a>
        </td>
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




