<?php
ob_start();

  include('../header/header.php'); 
  include('../omgevingbeheer/EnvironmentDaoMysql.php');

  // Error Message
  include_once ("../error/ErrorMessage.php");
  include_once ("../config/configure.php");

  // Instantiate Error class
  $errMessage = new ErrorMessage();
  
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
        
        <a href="createenvironment.php" target="_self">
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
                <a href="../omgevingbeheer/omgevingsoverzicht.php?action=edit&systemName=<?php echo $systemName; ?>">
                  <i class="editbutton"><img src='../res/edit.svg'><img
                  src='../res/edit-hover.svg'></i></a>
                <a href="../omgevingbeheer/omgevingsoverzicht.php?action=delete&systemName=<?php echo $systemName; ?>">
                  <i class="deletebutton"><img src='../res/delete.svg'><img
                  src='../res/delete-hover.svg'></i></a>
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
            header("Location: http://" . APP_PATH . "omgevingbeheer/editenvironment.php?systemName=" . $systemName);
            break;
        case "delete":
            delete($systemName, $environmentDao);
            break;
    }

      
    function delete($systemName, $dao) 
    {
          // Instantiate Error class en set de Error message
          $errMessage = new ErrorMessage();

            $strUrl = 'http://' . APP_PATH . 'omgevingbeheer/omgevingsoverzicht.php?action=delete&systemName=' . $systemName . '&dodelete=1';
            $strUrlCancel = 'http://' . APP_PATH . 'omgevingbeheer/omgevingsoverzicht.php';
            echo $errMessage->createErrorMessageConfirmButton('<h2>Delete Omgeving</h2>Weet je zeker dat je ' . $systemName  . ' wilt verwijderen?', $strUrl, $strUrlCancel, 'buttOkDelete');
            
            if(isset($_GET['dodelete']))
            {
                $succes = $dao->deactivateEnvironment($systemName);
                header("Location: http://" . APP_PATH . "omgevingbeheer/omgevingsoverzicht.php");
                if (!$succes) 
                {
                    echo "Omgeving kon niet worden verwijderd.";
                }
            }
    }


?>

<script src="../js/confirmdelete.js"></script>
<script src="../js/error.js"></script>
</body>
</html>

