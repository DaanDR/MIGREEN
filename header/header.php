 <?php
//  Voor de title bar
    $title = "";

    if ( isset($_SESSION["title"]) )
    {
        $title = $_SESSION["title"];
    }
    else
    {
        $title = "MyBit MyInsight";
    }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link type="text/css" rel="stylesheet" href="../css/header.css">
<link rel="stylesheet"
	href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
	integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
	crossorigin="anonymous">
<script src="../js/header.js"></script>

    <?php
function active($currect_page){
  $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
  $url = end($url_array);  
  if($currect_page == $url){
      echo 'active'; //class name in css 
  } 
}
?>
    



<title><?php echo $title ?></title>
</head>
<body >
    <div id="headerbody">
    <div id="compleet">
    <div id="logo">MyInsights</div>
		<ul class="mainmenu">
            <div class="hoofdmenu">
			<li><a id="home-button" href="http://localhost:8080/MIGreen/header/header.php"
				class="fas fa-home"></a></li>
<!--
			<li><a href="../gebruikersbeheer/overzicht.html" class="active">GEBRUIKERS</a></li>
			<li><a href="blabla" >KLANTEN</a></li>
			<li><a href="blabla" >OMGEVINGEN</a></li>
-->
			<li><a id="hover" class="<?php active('overzicht.php');?>" href="../gebruikersbeheer/overzicht.php">GEBRUIKERS</a></li>
			<li><a id="hover" class="<?php active('klantenoverzicht.php');?>" href="../klantbeheer/klantenoverzicht.php">KLANTEN</a></li>
			<li><a id="hover" class="<?php active('omgevingen.php');?>" href="../omgevingbeheer/omgeving.php" class="btn">OMGEVINGEN</a></li>


                                                            </div>
            


            <div id="dropdown-window">
            <li><i class="fas fa-user"></i>
                <ul class="dropdown-content">
                    <li id="dropdown-padding"><a  href="../header/header.php?action=account"> Account </a></li>
                    <li id="dropdown-padding"><a  href="../header/header.php?action=logout" onclick="return deleteask();">Uitloggen</a></li>
                </ul>
                </div>
		</ul>
   
        </div>
    </div>
     <?php
    // Voor de title bar
    session_start();
    if (isset($_SESSION["title"])) {
        $title = $_SESSION["title"];
    } else {
        $title = "MyBit MyInsight";
    }
    
    // $action = $_GET["action"];
    
    if (! isset($_GET["action"])) {
        $action = "Home";
    } else {
        $action = $_GET["action"];
    }
    
    switch ($action) {
        case "account":
            account();
            break;
        case "logout":
            logout();
            break;
    }

    function logout()
    {
        $_SESSION = array();
        // session_destroy();
        header("Location: ../autorisatie/login.php");
        exit();
        // print "Log uit";
    }

    function account()
    {
        print "accountje";
    }
    

    
    

    
    
    
    ?>
    
   
