 <?php
 session_start();
 // ini_set('display_errors', 1);

 include_once ("../config/configure.php");
 include_once ("../error/ErrorMessage.php");

//  Voor de title bar
    $title = "";

        if (isset($_SESSION["title"])) 
        {
            $title = $_SESSION["title"];
        } 
        else 
        {
            $title = "MyBit MyInsights";
        }
        
        // Get de headerinfo via een GET request
        if (! isset($_GET["action"])) 
        {
            $action = "Home";
        } 
        else 
        {
            $action = $_GET["action"];
        }
        
        switch ($action) 
        {
            case "account":
                account();
                break;
            case "logout":
                logout();
                break;
        }
    
        // Log out...
        function logout()
        {
            // Instantiate Error class
            $errMessage = new ErrorMessage();
            $strUrl = 'http://' . APP_PATH . 'autorisatie/login.php';
            echo $errMessage->createErrorMessageButton('<h2>Uitloggen</h2>Weet je zeker dat je wilt uitloggen?', $strUrl, 'buttOkLogOut');

            if ( isset($_GET["logoutinfo"]) )
            {
                if( $_GET["logoutinfo"] == 1 )
                {
                    // Session Leeg....
                    $_SESSION = array();
                    echo '
                    <script type="text/javascript">
                        parent.window.location.href = "http://' . APP_PATH . 'autorisatie/login.php";
                    </script>
                    ';
                }
            }
        }
    
        function account()
        {
            $userName = $_SESSION['username'];
//            echo "$userName";
            echo '<script type="text/javascript">
                        parent.window.location.href = "http://' . APP_PATH . 'gebruikersbeheer/edituser.php?username=' . $userName . '";
                    </script>
                    ';
        }

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link type="text/css" rel="stylesheet" href="../css/header.css">
<link type="text/css" rel="stylesheet" href="../css/error.css">
<link type="text/css" rel="stylesheet" href="../css/form.css">
<link rel="stylesheet"
	href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
	integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
	crossorigin="anonymous">

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
			<li><a id="home-button" href="../systeemoverzicht/systeemoverzicht.php"
				class="fas fa-home"></a></li>

					<!--                 als je hier een link wilt toevoegen die active is zodra hij bezocht wordt voeg je in de class de filename toe en in de href de file path, php herkent zelf de pagina waar hij op zit en zet deze op active -->
					<li><a id="hover" class="<?php active('overzicht.php');?>"
						href="../gebruikersbeheer/overzicht.php">GEBRUIKERS</a></li>
					<li><a id="hover" class="<?php active('customers.php');?>"
						href="../klantbeheer/customers.php">KLANTEN</a></li>
					<li><a id="hover" class="<?php active('omgevingsoverzicht.php');?>"
						href="../omgevingbeheer/omgevingsoverzicht.php" class="btn">OMGEVINGEN</a></li>


                                                            </div>
            


            <div id="dropdown-window">
            <li><i class="fas fa-user"></i>
                <ul class="dropdown-content">
                    <li id="dropdown-padding"><a  href="../header/header.php?action=account"> Account </a></li>
                    <li id="dropdown-padding"><a  href="?action=logout">Uitloggen</a></li>
                </ul>
                </div>
		</ul>
   
        </div>
    </div>
    <script src="../js/header.js"></script>
    <script src="../js/error.js"></script>
   
