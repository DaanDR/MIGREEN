<?php

// Default Connector voor de mysql...
include_once("../dbconnection/mysqlConnector.php");
include_once("UserCustomerDao.php");

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

    public function clearUserCustomer($username)
    {
        $dbConn = new mysqlConnector();

        $sql = "DELETE FROM user_customer WHERE userName = ?";

        $stmt = $dbConn->getConnector()->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();

        $dbConn->getConnector()->close();
    }

    public function getCustomersByUsername($username)
    {
        $customers = array();

        $dbConn = new mysqlConnector();

        $sql = "Select customerName FROM user_customer WHERE userName = ?";

        $stmt = $dbConn->getConnector()->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();

        $stmt->store_result();
        $stmt->bind_result(
            $customerName
        );

        while ($stmt->fetch()) {
            $customers[] = $customerName;

        }

        return $customers;

        $dbConn->getConnector()->close();
    }

}