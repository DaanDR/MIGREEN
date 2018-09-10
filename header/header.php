 <?php
 Voor de title bar
    session_start();
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
    <title><?php echo $title ?></title>
</head>
<body>
    
    <div id="usericon" class="dropdown">
        <div id="usericonbar"></div>
        <div id="usericonbar"></div>
        <div id="usericonbar"></div>
        <div class="dropdown-content">
        <a href="account.html"> Account </a>
        <a href="uitloggen.html"> Uitloggen </a>
        </div>

    </div>
    
    
    </body>
    
</html>