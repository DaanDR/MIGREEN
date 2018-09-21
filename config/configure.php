<?php
// VERANDER DEZE REGEL OP BASIS VAN EIGEN MACHINE
$SERVER_PATH = ":8080/MIGreen/";

// APP_PATH Gebruiken als basis pad > kun je halen uit de adresbar
define( 'APP_PATH', $_SERVER['SERVER_NAME'] . $SERVER_PATH );

// DB Basis > naar eigen machine instellen
define( 'DBHOST', "localhost");
define( 'DBUSER' ,"root");
define( 'DBPWD', "");
define( 'DBNAME', "insights_db");

?>
