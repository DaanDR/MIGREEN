<?php
  include('../header/header.php'); 
  include('../omgevingbeheer/EnvironmentDaoMysql.php');
  
  // Check of user is ingelogged en anders terug naar de login pagina
  include_once ("../autorisatie/UserIsLoggedin.php");
  $userLoggedin = new UserIsLoggedin();
  $userLoggedin->backToLoging();

  //Check of de admin is ingelogged....
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
  <link rel="stylesheet" type="text/css" href="../css/overzicht.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <script type="text/javascript" src="../js/overzichtFunctions.js"></script>

  <meta charset="utf-8">
  <title>Omgevingsoverzicht</title>
</head>

<body id="overzicht-container">
<div class="grid-container" <?php echo $adminLoggedin ?> >
    <div class="header-left">
      <h1>Home</h1>
      <h2>Omgevingsoverzicht</h2>
    </div>
    <div class="header-mid"></div>
    <div class="header-right">
        
        <a href="createomgeving.php" target="_self">
        <button class="new-user-button" type="button" name="button">Nieuwe omgeving aanmaken</button>
        </a>
      </div>
    <div class="content">

    <table>
        <thead>
          <tr>
           <th>SYSTEEMNAAM</th>
           <th>KLANT</th>
           <th></th>
         </tr>
       </thead>
       <tbody>

      <?php 
        $environmentDao = new EnvironmentDaoMysql();
        $environments = $environmentDao-> selectViewCurrentEnvironments(); 
      ?>

        <?php foreach($environments as $environment):
           $systemName = $environment["systemName"];?>
          <tr>
            <td><?=$environment["systemName"] ?></td>
            <td><?=$environment["customerName"] ?></td>
            <td class="icon-cell">
                <a href="../omgevingbeheer/omgevingsoverzicht.php?action=edit&systemName=<?php echo $systemName; ?>"><i class="fas fa-pencil-alt glyph-icon"></i></a>
                <a href="../omgevingbeheer/omgevingsoverzicht.php?action=delete&systemName=<?php echo $systemName; ?>"><i class="fas fa-trash-alt glyph-icon" onclick="return confirmDelete('<?php echo $systemName ?>');"></i></a>
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
    
   if (! isset($_GET["systemName"])) {
         $systemName = null;
     } else {
         $systemName = $_GET["systemName"];
     }

    switch ($action) {
        case "Home":
            break;
        case "edit":
            header("Location: editenvironment.php");
            break;
        case "delete":
            delete($systemName, $environmentDao);
            break;
    }

      
    function delete($systemName, $dao) {
            $succes = $dao->deactivateEnvironment($systemName);
            header("Location: omgevingsoverzicht.php");
            if (!$succes) {
                echo "Omgeving kon niet worden verwijderd.";
            }
        
    }


?>

</body>

</html>

