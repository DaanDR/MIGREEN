<?php

include_once ("../dbconnection/mysqlConnector.php");
include_once ("UserDao.php");

class UserDaoMysql implements UserDao
{
    // private $usr = new User();
    private $dbConn;

    public function __construct()
    {
    }

    // Insert new User
    public function insertUser($userName, $name, $company, $role)
    {
        $dbConn = new mysqlConnector();

        $sql = "INSERT INTO user(userName, name, company, role) VALUES (?, ?, ?, ?)";
  
        $stmt = $dbConn->getConnector()->prepare($sql);
        $stmt->bind_param('ssss', $userName, $name, $company, $role);
        $stmt->execute();
        
        $dbConn->getConnector()->close();
    }

    public function updateUser($id)
    {

    }
    public function deleteUser($id)
    {

    }
    public function selectUser($username, $password)
    {
        $dbConn = new mysqlConnector();
        
        $newUser = null;
        
        $sql = "SELECT * FROM user WHERE userName='$username' AND password='$password' LIMIT 1";
        $results = mysqli_query($dbConn, $sql);
        $dbConn->getConnector()->close();
        
        $row = $result->fetch_assoc();
        
        // public function __construct($id, $username, $password, $firstname, $lastname, $role)
        $newUser = new user($row["userID"], $row["userName"], $row["password"], $row["firstname"], $row["lastname"], $row["role"]);
        
        return $newUser;
        
    }
}

?>