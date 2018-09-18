<?php

// Default Connector voor de mysql...
include_once ("../dbconnection/mysqlConnector.php");
include_once ("UserCustomerDao.php");

/**
 * UserCustomerDaoMysql voor de 
 */
class UserCustomerDaoMysql implements UserCustomerDao
{
	
	private $dbConn;

	public function __construct()
	{
			
	}

    public function insertUserCustomer($username, $customername)
    {
        $dbConn = new mysqlConnector();
        
        $sql = "INSERT INTO user_customer(userName, customerName) values (?,?)";
        
        $stmt = $dbConn->getConnector()->prepare($sql);
        $stmt->bind_param('ss', $username, $customername);
        $stmt->execute();
        
        $dbConn->getConnector()->close();
    }
}