<?php
  include('../header/header.php'); 
  include('../autorisatie/UserDaoMysql.php');       
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
  <div class="grid-container">
    <div class="header-left">
      <h1>Home</h1>
      <h2>Gebruikersoverzicht</h2>
    </div>
    <div class="header-mid"></div>
    <div class="header-right"><button class="new-user-button" type="button" name="button">Nieuwe gebruiker aanmaken</button></div>
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

        <?php foreach($users as $user):?>
          <tr>
            <td><?=$user["userName"] ?></td>
            <td><?=$user["firstname"] ?></td>
            <td><?=$user["lastname"] ?></td>
            <td><?=$user["role"] ?></td>
            <td class="icon-cell">
              <i class="fas fa-pencil-alt glyph-icon" href="../gebruikersbeheer/overzicht.php?action=edit"></i> 
              <i class="fas fa-trash-alt glyph-icon" href="../gebruikersbeheer/overzicht.php?action=delete" onclick="return confirmDelete();"></i>
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
              echo '<script>console.log("Your stuff here")</script>';
        $action = $_GET["action"];
    }
    
  // if (! isset($_GET["userName"])) {
  //       $userName = null;
  //   } else {
  //       $userName = $_GET["userName"];
  //   }

    switch ($action) {
        case "edit":
            edit();
            break;
        case "delete":
            echo "Delete functie oproepen";
            delete();
            break;
    }

    function delete() {
      echo "Delete funcite opgeroepen";
      header("Location: ../gebruikersbeheer/overzicht.php");
    }
    // function delete()
    // {
    //     if ($_SESSION['username'] == $userName) {
    //       echo "Je kunt niet jezelf verwijderen dummy!";
    //     } else {
    //       if ($userDao-> deleteUser($userName)) {
    //         echo "Gebruiker verwijderd";
    //       } else {
    //         echo "Gebruiker kan niet verwijderd worden";
    //       }
    //     }
    //     header("Location: ../gebruikersbeheer/overzicht.php");
    // }

?>

</body>

</html>

