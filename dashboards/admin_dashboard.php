<?php
ob_start();
session_start();
// ini_set('display_errors', 1);
    // Header in de bovenkant
    include ("../header/header.php");

// Title van de pagina...
    if(!isset($_SESSION)) 
    {
        $_SESSION["title"] = "Administrator Dashboard";
    } 


// Check of user is ingelogged en anders terug naar de login pagina
include_once ("../autorisatie/UserIsLoggedin.php");
$userLoggedin = new UserIsLoggedin();
$userLoggedin->backToLoging();

echo $_SERVER['SERVER_NAME'];


?>


// CSS link moet nog aangepast worden
<link type="text/css" rel="stylesheet" href="../css/xxxxx.css">
<body>
<p>  
Hier moet het dashboard voor een admin komen
</p>   
    
    
    
    


</body>




<?php include ("../footer/footer.php"); ?>