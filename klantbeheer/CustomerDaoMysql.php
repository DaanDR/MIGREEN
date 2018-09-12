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
        $stmt->bind_param('s', $name);
        $stmt->execute();
        
        $dbConn->getConnector()->close();
    }

    public function updateCustomer($customerid)
    {}

    public function deleteCustomer($customerid)
    {}

    public function selectCustomer($customername)
    {
        $newCustomer = null;
        $dbConn = new mysqlConnector();
        
        $customername;
        $customerid;
        
        $sql = "SELECT customerName from customer WHERE customerID = ? LIMIT 1";
        $stmt = $dbConn->getConnector()->prepare($sql);
        $stmt->bind_param('s',$customername);
        $stmt->execute();
        $stmt->store_result();
    }

    public function selectAllCustomers()
    {}
}