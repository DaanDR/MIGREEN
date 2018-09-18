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

<!--  met nieuwe stijl-->
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


<!--            deel dat aangepast moet worden-->
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
    </div>
</div>
<script src="../js/customers.js"></script>
</body>
</html>
