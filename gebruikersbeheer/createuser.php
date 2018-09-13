<?php
// ini_set('display_errors', 1);
    // Header in de bovenkant
    include ("../header/header.php");

    // Is logged in class
    include_once ("../autorisatie/UserDaoMysql.php");

    // Title van de pagina...
    if(!isset($_SESSION))
    {
        $_SESSION["title"] = "Log hier in";
    }

    // Kijk eerst of alle velden zijn ingevoerd met isset()
    if( isset($_POST['username']) && isset($_POST['password']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['role'])      )
    {
        // Roep de class UserDaoMysql aan voor sql functionaliteit om user te checken
        $createUser = new UserDaoMysql();
        $createUser = $createUser->insertUser( $_POST['username'], $_POST['password'], $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['role'] );
    }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/content.css">

    <meta charset="utf-8">
    <title>Gebruiker Aanmaken</title>
</head>

<div class="grid-container">

    <div class="header-left">
        <p>Home <i id="triangle-breadcrumb" class="fas fa-caret-right"></i> Gebruikersoverzicht</p>
        <h1>Gebruiker aanmaken</h1>
    </div>


    <div class="header"></div>

    <!-- form elements -->

    <div class="content">

        <form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'];?>">

            <div class="user-form input-padding">
                Gebruikersnaam
                <br><input type="text" name="username" minlength=5>
            </div>


            <div class="password-form input-padding">

                <div class="password-form-initial">
                    Wachtwoord <span class="info-symbol password-info"><i class="fas fa-info-circle"></i><span class="password-infotext">Je wachtwoord moet minimaal bestaan uit:<p> 8 karakter met 1 hoofdletter en 1 nummer</p></span></span>
                    <br><input type="password" name="password" pattern="(?=.*\d)(?=.*[A-Z]).{8,}" title="minimaal: 8 karakters, 1 Hoofdletter, 1 Nummer" required>
                </div>
                <div class="password-form-confirm">
                    Herhaal wachtwoord <br><input type="password" name="passwordconfirm">
                </div>
            </div>

            <div class="input-padding fullname-form">
                <div class="fullname-form-fn">
                    Voornaam
                    <br><input type="text" name="firstname" minlength="2">
                </div>
                <div class="fullname-form-ln">
                    Achternaam
                    <br><input type="text" name="lastname" minlength="2">
                </div>
            </div>

            <div class="input-padding email-form">
                E-mailadres
                <br><input type="email" name="email"><br>
            </div>

            <div class="role-form input-padding">
                Rol
                <br>
                <select>
                    <option value="user">gebruiker</option>
                    <option value="admin">admin</option>
                </select>
            </div>

    </div>

    <!-- end form elements -->

    <div class="footer"></div>

    <!-- buttons   -->

    <div class="footer-right">
        <div class="buttons-form">
            <button id="button-size" type="button">Annuleren</button><input id="button-size" type="submit" value="Gebruiker aanmaken">
            <!-- buttons -->
            <div>
                </form>
            </div>

            <body>

            </body>

</html>

<?php include ("../footer/footer.php"); ?>
</body>
