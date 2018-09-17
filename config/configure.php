<?php
// VERANDER DEZE REGEL OP BASIS VAN EIGEN MACHINE
$SERVER_PATH = "/guido/mybit/migreen/";

// APP_PATH Gebruiken als basis pad > kun je halen uit de adresbar
define( 'APP_PATH', $_SERVER['SERVER_NAME'] . $SERVER_PATH );

// DB Basis > naar eigen machine instellen
define( 'DBHOST', "localhost");
define( 'DBUSER' ,"root");
define( 'DBPWD', "guidoleen");
define( 'DBNAME', "insights_db");

?>