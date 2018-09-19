<?php
ob_start();
include_once("../config/configure.php");

// Wijzig onderstaande waarden van de variabelen naar die van je eigen mysql database
// DB credentials
class mysqlConnector
{
    private $dbhost = DBHOST;
    private $dbuser = DBUSER;
    private $dbpassword = DBPWD;
    private $dbname = DBNAME;

    private $connector;

    public function __construct()
    {
        
    }

    // Create connection
    public function getConnector()
    {
        $this->connector = new mysqli($this->dbhost, $this->dbuser, $this->dbpassword, $this->dbname);

        // Check Connection
        if ($this->connector->connect_error) {
            die("DB connection failed: " . $this->connector->connect_error);
        } else {
            //echo "DB connection established";
        }

        return $this->connector;
    }

}





?>