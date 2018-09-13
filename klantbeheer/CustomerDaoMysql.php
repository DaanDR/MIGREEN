<?php

// Default Connector voor de mysql...
include_once ("../dbconnection/mysqlConnector.php");
include_once ("CustomerDao.php");
include_once ("Customer.php");

class CustomerDaoMysql implements CustomerDao
{

    private $dbConn;

    public function _construct()
    {}

    public function insertCustomer($customername)
    {
        $dbConn = new mysqlConnector();
        
        $sql = "INSERT INTO customer (customerName) values (?)";
        
        $stmt = $dbConn->getConnector()->prepare($sql);
        $stmt->bind_param('s', $customername);
        $stmt->execute();
        
        $dbConn->getConnector()->close();
    }

    public function updateCustomer($customername, $newname)
    {
        $dbConn = new mysqlConnector();
        
        $sql = "UPDATE customer SET customerName = ? WHERE customerName = ?";
        
        $stmt = $dbConn->getConnector()->prepare($sql);
        $stmt->bind_param('ss', $newname, $customername);
        $stmt->execute();
        
        $dbConn->getConnector()->close();
    }

    public function deleteCustomer($customername)
    {
        $dbConn = new mysqlConnector();
        
        $sql = "DELETE FROM customer WHERE customerName = ?";
        
        $stmt = $dbConn->getConnector()->prepare($sql);
        $stmt->bind_param('s', $customername);
        $stmt->execute();
        
        $dbConn->getConnector()->close();
    }

    public function selectCustomer($customername)
    {
//         $newCustomer = null;
//         $dbConn = new mysqlConnector();
        
//         $customername;
        
//         $sql = "SELECT * from customer WHERE customerName = ? LIMIT 1";
//         $stmt = $dbConn->getConnector()->prepare($sql);
//         $stmt->bind_param('s', $customername);
//         $stmt->execute();
//         $stmt->store_result();
//         $stmt->bind_result($customername);
        
//         // Vul de rij met enkel 1 rij uit database
//         while ($stmt->fetch()) {
//             $newcustomer = new Customer($customername)
//         }
//         return $newCustomer;
    }

    public function selectAllCustomers()
    {
        $customers = null;
        $dbConn = new mysqlConnector();
        
        $customername;
        
        $sql = "SELECT customerName from customer";
        $stmt = $dbConn->getConnector()->prepare($sql);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($customername);
        
        while ($stmt->fetch()) {
            $customers[] = array("customerName" => $customername);
        }
        return $customers;
    }
}