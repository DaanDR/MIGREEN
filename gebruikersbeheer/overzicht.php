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
           <th>WACHTWOORD</th>
           <th>VOORNAAM</th>
           <th>ACHTERNAAM</th>
           <th>ROL</th>
           <th></th>
         </tr>
       </thead>
       <tbody>

      <?php 
        $userdaomysql = new UserDaoMysql();
        $users = $userdaomysql-> selectViewCurrentUsers(); 
      ?>

        <?php foreach($users as $user):?>
          <tr>
            <td><?=$user["userName"] ?></td>
            <td><?=$user["firstname"] ?></td>
            <td><?=$user["lastname"] ?></td>
            <td><?=$user["role"] ?></td>
            <td class="icon-cell"><i class="fas fa-pencil-alt glyph-icon"></i> <i class="fas fa-trash-alt glyph-icon"></i></td>
          </tr>
        <?php endforeach;?>

      </tbody>

  </div>
</div>

</body>

</html>

