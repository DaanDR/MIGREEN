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
        
        $sql = "INSERT INTO customer (customerName) values (?)";
        $stmt = $this->dbConn->getConnector()->prepare($sql);
        $stmt->bind_param('s', $customername);
        $stmt->execute();
        
        $this->dbConn->getConnector()->close();
    }

    public function updateCustomer($customername, $newname)
    {
        
        $sql = "UPDATE customer SET customerName = ? WHERE customerName = ?";
        
        $stmt = $this->dbConn->getConnector()->prepare($sql);
        $stmt->bind_param('ss', $newname, $customername);
        $stmt->execute();
        
        $this->dbConn->getConnector()->close();
    }

    public function deleteCustomer($customername)
    {
        
        $sql = "Update customer SET status_active = 0 WHERE customerName = ?";
        
        $stmt = $this->dbConn->getConnector()->prepare($sql);
        $stmt->bind_param('s', $customername);
        $stmt->execute();
        
        $this->dbConn->getConnector()->close();
    }

    public function selectCustomer($customername)
    {
        $newCustomer = null;
        
        $customername;
        
        $sql = "SELECT * from customer WHERE customerName = ? LIMIT 1";
        $stmt = $this->dbConn->getConnector()->prepare($sql);
        $stmt->bind_param('s', $customername);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($customername);
        
        // Vul de rij met enkel 1 rij uit database
        while ($stmt->fetch()) {
            $newCustomer = new Customer($customername);
        }
        return $newCustomer;
    }

    public function selectAllCustomers()
    {
        $customers = null;
        
        //$this->dbConn = new mysqlConnector();
        $customername;
        
        $sql = "SELECT customerName from customer Where status_active = 1";
        $stmt = $this->dbConn->getConnector()->prepare($sql);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($customername);
        
        while ($stmt->fetch()) {
            $customers[] = array(
                "customerName" => $customername
            );
        }
        return $customers;
    }
}