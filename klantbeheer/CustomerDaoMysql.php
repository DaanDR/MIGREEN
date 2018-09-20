<?php

// Default Connector voor de mysql...
include_once ("../dbconnection/mysqlConnector.php");
include_once ("CustomerDao.php");
include_once ("Customer.php");

class CustomerDaoMysql implements CustomerDao
{

    private $dbConn;

    public function __construct()
    {
        $this->dbConn = new mysqlConnector();

    }

    public function insertCustomer($customername)
    {
        // Aanmaken van sql query
        $sql = "INSERT INTO customer (customerName) values (?)";
        
        // Voeg de aangemaakte query toe aan prepared statement
        $stmt = $this->dbConn->getConnector()->prepare($sql);
        
        // Voeg de benodigde parameters to aan de prepared statement
        $stmt->bind_param('s', $customername);
        
        // Voer de prepared statement uit
        $stmt->execute();
        
        // Sluit de database verbinding tegen resource lekken
        $this->dbConn->getConnector()->close();
    }

    public function updateCustomer($customername, $newname)
    {
        // Aanmaken van sql query
        $sql = "UPDATE customer SET customerName = ? WHERE customerName = ?";
        
        // Voeg de aangemaakte query toe aan prepared statement
        $stmt = $this->dbConn->getConnector()->prepare($sql);
        
        // Voeg de benodigde parameters to aan de prepared statement
        $stmt->bind_param('ss', $newname, $customername);
        
        // Voer de prepared statement uit
        $stmt->execute();
        
        // Sluit de database verbinding tegen resource lekken
        $this->dbConn->getConnector()->close();
    }

    public function deleteCustomer($customername)
    {
        // Aanmaken van sql query
        $sql = "Update customer SET status_active = 0 WHERE customerName = ?";
        
        // Voeg de aangemaakte query toe aan prepared statement
        $stmt = $this->dbConn->getConnector()->prepare($sql);
        
        // Voeg de benodigde parameters to aan de prepared statement
        $stmt->bind_param('s', $customername);
        
        // Voer de prepared statement uit
        $stmt->execute();
        
        // Sluit de database verbinding tegen resource lekken
        $this->dbConn->getConnector()->close();
    }

    public function activateCustomer($customername)
    {
        // Aanmaken van sql query
        $sql = "UPDATE customer SET status_active = 1 WHERE customerName = ?";
        
        // Voeg de aangemaakte query toe aan prepared statement
        $stmt = $this->dbConn->getConnector()->prepare($sql);
        
        // Voeg de benodigde parameters to aan de prepared statement
        $stmt->bind_param('s', $customername);
        
        // Voer de prepared statement uit
        $stmt->execute();
        
        // Sluit de database verbinding tegen resource lekken
        $this->dbConn->getConnector()->close();
    }

    public function selectCustomer($customername)
    {
        // Maak een klant variabele aan en zet die op null
        $newCustomer = null;
        
        // Aanmaken van sql query
        $sql = "SELECT customerName from customer WHERE customerName = ?";
        
        // Voeg de aangemaakte query toe aan prepared statement
        $stmt = $this->dbConn->getConnector()->prepare($sql);
        
        // Voeg de benodigde parameters to aan de prepared statement
        $stmt->bind_param('s', $customername);
        
        // Voer de prepared statement uit
        $stmt->execute();
        
        // Sla het resultaat van de uitgevoerde query op
        $stmt->store_result();
        
        // Checken of er een resultaat uit de database komt
        if ($stmt->num_rows > 0) {
            // Zo ja, maak een klant object aan met de gegevens
            $stmt->bind_result($customername);
            
            // Vul de rij met enkel 1 rij uit database
            while ($stmt->fetch()) {
                $newCustomer = new Customer($customername);
            }
        } else {
            // Zo nee, maak een klant object aan met null waardes
            $newCustomer = new Customer($customername = null);
        }
        
        // Retourneer de aangemaakte klant
        return $newCustomer;
    }

    public function selectAllCustomers()
    {
        // Maak een klant variabele aan en zet die op null
        $customers = null;
        
        // Maak een naam variabele aan om de klantnamen in op te slaan
        $customername;
        
        // Aanmaken van sql query
        $sql = "SELECT customerName from customer Where status_active = 1";
        
        // Voeg de aangemaakte query toe aan prepared statement
        $stmt = $this->dbConn->getConnector()->prepare($sql);
        
        // Voer de prepared statement uit
        $stmt->execute();
        
        // Sla het resultaat van de uitgevoerde query op
        $stmt->store_result();
        
        // Koppel de klantnaam aan de opgeslagen resultaten
        $stmt->bind_result($customername);
        
        // Voor iedere klant in resultaat: voeg toe aan array
        while ($stmt->fetch()) {
            $customers[] = array("customerName" => $customername);
        }
        
        // Retourneer de array met klanten
        return $customers;
    }
}
