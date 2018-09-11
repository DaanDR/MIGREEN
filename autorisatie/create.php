<?php
    include ("../header/header.php");
?>

    <link type="text/css" rel="stylesheet" href="../css/create.css">

<body>
    
    <div class="menu">
        <div id = "title">
            MyInsight <br>
        </div>
        
        <div id = "paragraaf">
        <p> Voor hier een nieuwe gebruiker in: </p>
        </div>
        
        <div class="user_input">
            <form method="post">
            <ul>
            Klantnaam (minimaal: 2 karakters):  <br>
            <input type="text" name="waarde" minlength=2>  <br> <br>
                
            Wachtwoord: <br>
            <input type="password" name="waarde">  <br>
                
            <div class = "submit_button">
                <input type="submit" value="aanmaken nieuwe klant">
            </div>
            </ul> 
            </form>
            
        </div>
    </div>        
    

<?php include ("../footer/footer.php"); ?>
</body>