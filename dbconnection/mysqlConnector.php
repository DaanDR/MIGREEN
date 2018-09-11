<?php

// Wijzig onderstaande waarden van de variabelen naar die van je eigen mysql database
// DB credentials
$dbhost = "localhost";
$dbuser = "root";
$dbpassword = "Appel-Peer-Framboos1976";
$dbname = "insights_db";

// Create connection
$connector = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);

// Check Connection
if ($connector->connect_error) {
    die("DB connection failed: " . $connector->connect_error);
} else {
    echo "DB connection established";
}





?>