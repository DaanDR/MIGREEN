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
  <link rel="stylesheet" type="text/css" href="overzicht.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <script type="text/javascript" src="../js/overzichtFunctions.js"></script>

  <meta charset="utf-8">
  <title>Gebruikersoverzicht</title>
</head>

<body>
<div class="grid-container" <?php echo $adminLoggedin ?> >
    <div class="header-left">
      <h1>Home</h1>
      <h2>Gebruikersoverzicht</h2>
    </div>
    <div class="header-mid"></div>
    <div class="header-right">

        <a href="createuser.php" target="_self">
        <button class="new-user-button" type="button" name="button">Nieuwe gebruiker aanmaken</button>
        </a>
      </div>
    <div class="content">

    <table>
        <thead>
          <tr>
           <th>GEBRUIKERSNAAM</th>
           <th>VOORNAAM</th>
           <th>ACHTERNAAM</th>
           <th>ROL</th>
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
          <tr>
            <td><?=$user["userName"] ?></td>
            <td><?=$user["firstname"] ?></td>
            <td><?=$user["lastname"] ?></td>
            <td><?=$user["role"] ?></td>
            <td class="icon-cell">
                <a href="../gebruikersbeheer/overzicht.php?action=edit&userName=<?php echo $username; ?>"><i class="fas fa-pencil-alt glyph-icon"></i></a>
                <a href="../gebruikersbeheer/overzicht.php?action=delete&userName=<?php echo $username; ?>"><i class="fas fa-trash-alt glyph-icon" onclick="return confirmDelete('<?php echo $username ?>');"></i></a>
            </td>
          </tr>
        <?php endforeach;?>

      </tbody>
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
            echo 'Je kunt niet jezelf verwijderen dummy!';
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
