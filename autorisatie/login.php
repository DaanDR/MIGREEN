<?php
    include ("../header/header.php");
?>

<body>
    
        <div class="linkermenu">
        <div class "linkermenu_color">
            MyInsight <br>
        </div>
        <div class="linkermenu_in">
            <ul>
            Gebruikersnaam:  <input type="text" name="waarde">  <br>
            Wachtwoord:     <input type="password" name="waarde">  <br>
            </ul> 
        </div>
    </div>
    

<?php include ("../footer/footer.php"); ?>
</body>




    body {background-color: #F2F5FA;}

    .linkermenu_color{
        color: red;
    }
    .linkermenu {
        background-color: white; /* kleur */
        display: inline-block;
        font-size: 16px;        /* lettergrote */
        font-family: Ariel;	    /* lettertype - Tekst kleur is gekoppeld aan de hyperlinks, zie a*/
        left: 30%;
        top: 30%;
        position: fixed;       /* Vastzetten */
        height: 30%;          /* de hoogte */
        width: 30%;           /* breedte*/      
    }
    .linkermenu_in {
        width: 50%;             /* breedte v/d tekst */
        margin-left: 10px;
        margin-top: 18px;       /* hoogte v/d tekst */
    }