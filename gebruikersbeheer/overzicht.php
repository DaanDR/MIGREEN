<?php
  include('../header/header.php'); 
  include('../autorisatie/UserDaoMysql.php');
  
  // Check of user is ingelogged en anders terug naar de login pagina
  include_once ("../autorisatie/UserIsLoggedin.php");
  $userLoggedin = new UserIsLoggedin();
  $userLoggedin->backToLoging();

  // Check of de admin is ingelogged....
  $adminLoggedin = "";
  if( ! $userLoggedin->isAdmin() )
  {
      $adminLoggedin = "style='display: none;'";
      echo "<br><br><br><br><h1>Geen gerbuikersrecht als admin.....</h1>";
  }
?> 

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <link rel="stylesheet" type="text/css" href="../css/customers.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <script type="text/javascript" src="../js/overzichtFunctions.js"></script>

  <meta charset="utf-8">
  <title>Gebruikersoverzicht</title>
</head>

<body>
<div id="pagestyling">


    <div id="customerTable">

        <table>
            <thead>
            <tr>
                <th id="tabletitle">Home
                    <p>Gebruikersoverzicht</p>
                </th>
                <th></th>
                <th id="new-customer-button"><button class="new-customer-button"
                                                     type="button" name="button">Nieuwe gebruiker aanmaken</button></th>
            </tr>
            <tr>
                <th id="tablehead">GEBRUIKERSNAAM</th>
                <th id="tablehead">VOORNAAM</th>
                <th id="tablehead">ACHTERNAAM</th>
                <th id="tablehead">ROL</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

      <?php 
        $userDao = new UserDaoMysql();
        $users = $userDao-> selectViewCurrentUsers(); 
      ?>

        <?php foreach($users as $user):
           $username = $user["userName"];?>


            <tr class="withhover">
                <td id='gebruikerinfo'><?=$user["userName"]?></td>
                <td id='gebruikerinfo'><?=$user["firstname"]?></td>
                <td id='gebruikerinfo'><?=$user["lastname"]?></td>
                <td id='gebruikerinfo'><?=$user["role"]?></td>
                <td class="withhover">


                <td class='editbutton'><img src='../res/edit.svg'><img
                            src='../res/edit-hover.svg'></td>
                <td class='deletebutton'><img src='../res/delete.svg'><img
                            src='../res/delete-hover.svg'></td>
                </td>
            </tr>

        <?php endforeach;?>

      </tbody>
        </table>

  </div>
</div>

<?php

   if (! isset($_GET["action"])) {
        $action = "Home";
    } else {
        $action = $_GET["action"];
    }
    
   if (! isset($_GET["userName"])) {
         $userName = null;
     } else {
         $userName = $_GET["userName"];
     }

    switch ($action) {
        case "Home":
            break;
        case "edit":
            header("Location: edituser.php");
            break;
        case "delete":
            delete($userName, $userDao);
            break;
    }

//    function delete($name, $dao) {
//        if ($_SESSION['username'] == $name) {
//            echo '<script type="text/javascript">notDeleteSelf();</script>';
//        } else {
//            $succes = $dao->deactivateUser($name);
////          var_dump $succes;
//            header("Location: overzicht.php");
//            if (!$succes) {
//                echo "Gebruiker kon niet worden verwijderd.";
//            }
//        }
//    }
    
      
    function delete($name, $dao) {
        if ($_SESSION['username'] == $name) {
            echo '<script type="text/javascript"> notDeleteSelf(); </script>';
        } else {
            $succes = $dao->deactivateUser($name);
            header("Location: overzicht.php");
            if (!$succes) {
                echo "Gebruiker kon niet worden verwijderd.";
            }
        }
    }


?>

</body>

</html>

