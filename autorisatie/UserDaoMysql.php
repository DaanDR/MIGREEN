<?php

// Default Connector voor de mysql...
include_once ("../dbconnection/mysqlConnector.php");
include_once ("UserDao.php");
include_once ("User.php");

class UserDaoMysql implements UserDao
{
    // private $usr = new User();
    private $dbConn;

    public function __construct()
    {
    }

    // Insert new User
    public function insertUser($userName, $password, $firstname, $lastname, $role)
    {
        $dbConn = new mysqlConnector();

        $sql = "INSERT INTO user(userName, password, firstname, lastname, role) VALUES (?, ?, ?, ?, ?)";
  
        $stmt = $dbConn->getConnector()->prepare($sql);
        $stmt->bind_param('sssss', $userName, $password, $firstname, $lastname, $role);
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
        $newUser = null;
        $dbConn = new mysqlConnector();

        $userid;
        $userName;
        $password;
        $firstname;
        $lastname;
        $role;
        
        $sql = "SELECT userID, userName, password, firstname, lastname, role FROM user WHERE userName = ? AND password = ? LIMIT 1"; 
        $stmt = $dbConn->getConnector()->prepare($sql);
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
        $stmt->store_result();
		$stmt->bind_result(
            $userid,
            $userName,
            $password,
            $firstname,
            $lastname,
            $role
        );
        
        // Vul de rij met maar 1 record uit de database
        while ($stmt->fetch()) 
        {
            $newUser = new User($userid, $userName, $password, $firstname, $lastname, $role);
        }
        return $newUser;
    }
    
    public function selectAllUsers()
    {
        
    }
}

?>