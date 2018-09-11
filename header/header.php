<?php 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

    <link type="text/css" rel="stylesheet" href="../css/core.css">
    <link type="text/css" rel="stylesheet" href="../css/header.css">
    <link type="text/css" rel="stylesheet" href="../css/formulier.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <script src="../js/header.js"></script>
    


    <title><?php echo $title ?></title>
</head>
<body>

   <h1>MyInsights</h1>
    <nav id="navmenu">
        <ul>
            <li><a href="http://localhost:8080/MIGreen/header/header.php" ></a><i class="fas fa-home"></i></li>
            <li><a href="blabla" class="active">Gebruikers</a></li>
            <li><a href="blabla">Klanten</a></li>
            <li><a href="blabla">Omgevingen</a></li>
        </ul>
    </nav>
         
    <div id="usericon" class="dropdown">
        <div id="usericonbar"><i class="fas fa-user"></i></div>
        <div class="dropdown-content"><a href="../header/header.php?action=account"> Account </a>
<!--        <a href="header.php?action=logout"> Uitloggen </a>-->
        <a href="../header/header.php?action=logout" onclick="return deleteask();">Logout</a></div>

    </div>
    
     <?php
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
        
//        $action = $_GET["action"];
        
    if (!isset($_GET["action"])){
        $action = "Home";
    }
    else {
        $action = $_GET["action"];
    }

    switch($action){
            case"account": 
            account();
            break; 
            case"logout":
            logout();
            break;
    }
    function logout(){
        session_destroy();
        header("Location: ../autorisatie/login.php");
        exit();
//       print "Log uit";
    }
        
        function account(){
            print "accountje";
        }
?>
    
    </body>
    
</html>
