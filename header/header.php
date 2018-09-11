 <?php
//  Voor de title bar
    if(!isset($_SESSION)) 
    {
        //  Voor de title bar
        session_start();
        if ( isset($_SESSION["title"]) )
        {
            $title = $_SESSION["title"];
        }
        else
        {
            $title = "MyBit MyInsight";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

    <link type="text/css" rel="stylesheet" href="../css/core.css">
    <link type="text/css" rel="stylesheet" href="../css/header.css">
    <link type="text/css" rel="stylesheet" href="../css/navmenu.css">
    <link type="text/css" rel="stylesheet" href="../css/formulier.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">


    <title><?php echo $title ?></title>
</head>
<body>

  <nav id="navmenu">
        <ul>
            <li> <i class="fas fa-home"></i></li>
            <li><a href="blabla" class="active">Gebruikers</a></li>
            <li><a href="blabla">Klanten</a></li>
            <li><a href="blabla">Omgevingen</a></li>
        </ul>
    </nav>
         
    <div id="usericon" class="dropdown">
        <div id="usericonbar"></div>
        <div id="usericonbar"></div>
        <div id="usericonbar"></div>
        <div class="dropdown-content">
        <a href="account.html"> Account </a>
        <a href="uitloggen.html"> Uitloggen </a>
        </div>
    </div>
