<?php
ob_start();
include('../header/header.php'); 

// Check of user is ingelogged en anders terug naar de login pagina
include_once ("../autorisatie/UserIsLoggedin.php");
$userLoggedin = new UserIsLoggedin();
$userLoggedin->backToLoging();

// Title van de pagina...
    if(!isset($_SESSION)) 
    {
        $_SESSION["title"] = "User Dashboard";
    } 
?>


// CSS link moet nog aangepast worden
<link type="text/css" rel="stylesheet" href="../css/xxxxx.css">
<body>
<p>  
Hier moet het dashboard voor een user komen
<?php 
    echo $_SESSION['role'];
    echo $_SESSION['username'];
?>
</p>   
    
    
    
    


</body>




<?php include ("../footer/footer.php"); ?>