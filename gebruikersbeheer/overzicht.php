<?php include('header.php'); ?>

<?php

$users = [
  ["naam"=>"Tim","leeftijd"=>"oud"],
  ["naam"=>"Huy","leeftijd"=>"jong"],
  ["naam"=>"Mitchell","leeftijd"=>"mwah"]
];
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
      <th>Naam</th>
      <th>Leeftijd</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($users as $user):?>
      <tr><td><?=$user["naam"]?></td><td><?=$user["leeftijd"]?></td></tr>
    <?php endforeach;?>
  </tbody>
</table>






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
        <tr>
          <td>gentstudent42.1</td>
          <td>Student</td>
          <td>Gent</td>
          <td>4k</td>
          <td class="icon-cell"><i class="fab fa-snapchat-square glyph-icon"></i> <i class="fas fa-pills glyph-icon"></i></td>
        </tr>
        <tr>
          <td>M30.OTIS_30</td>
          <td>Mitchell</td>
          <td>Sitohang</td>
          <td>Sous-chef</td>
          <td class="icon-cell"><i class="fas fa-pencil-alt glyph-icon"></i> <i class="fas fa-trash-alt glyph-icon"></i></td>
        </tr>
        <tr>
          <td>ANDY_PIZZA</td>
          <td>Anderson</td>
          <td>Petrus</td>
          <td>Captain</td>
          <td class="icon-cell"><i class="fas fa-pencil-alt glyph-icon"></i> <i class="fas fa-trash-alt glyph-icon"></i></td>
        </tr>
        <tr>
          <td>Daan</td>
          <td>Poep</td>
          <td>Test</td>
          <td>Captain</td>
          <td class="icon-cell"><i class="fas fa-poo glyph-icon"></i> <i class="fas fa-trash-alt glyph-icon"></i></td>
        </tr>
      </tbody>

    </table>
  </div>
</div>

</body>

</html>

