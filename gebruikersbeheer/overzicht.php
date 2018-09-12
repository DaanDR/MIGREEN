<?php 
  include('../header/header.php'); 
  include('functions.php');       
?>

<!-- <?php

$users = [
  ["GEBRUIKERSNAAM"=>"TimD","VOORNAAM"=>"Tim", "ACHTERNAAM"=>"Dinh", "ROL"=>"Admin"],
  ["GEBRUIKERSNAAM"=>"MitchellS","VOORNAAM"=>"Mitchell", "ACHTERNAAM"=>"Sitohang", "ROL"=>"Superadmin"],
  ["GEBRUIKERSNAAM"=>"DaanP","VOORNAAM"=>"Daan", "ACHTERNAAM"=>"Pomp", "ROL"=>"Peasant"],
  ["GEBRUIKERSNAAM"=>"AndersonP","VOORNAAM"=>"Anderson", "ACHTERNAAM"=>"Petrus", "ROL"=>"Masseuse"],
];
?> -->

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <link rel="stylesheet" type="text/css" href="overzicht.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

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
        <?php getAllUsers(); ?>

        <!-- <?php foreach($users as $user):?>
          <tr>
            <td><?=$user["GEBRUIKERSNAAM"]?></td>
            <td><?=$user["VOORNAAM"]?></td>
            <td><?=$user["ACHTERNAAM"]?></td>
            <td><?=$user["ROL"]?></td>
            <td class="icon-cell"><i class="fas fa-poo glyph-icon"></i> <i class="fas fa-trash-alt glyph-icon"></i></td>
          </tr>
        <?php endforeach;?> -->

      </tbody>

  </div>
</div>

</body>

</html>

