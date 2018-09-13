<?php
ob_start();
// Wijzig onderstaande waarden van de variabelen naar die van je eigen mysql database
// DB credentials
class mysqlConnector
{
    private $dbhost = "localhost";
    private $dbuser = "root";
    private $dbpassword = "Appel-Peer-Framboos1976";
    private $dbname = "insights_db";

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
            echo "DB connection established";
        }

        return $this->connector;
    }

}





?>