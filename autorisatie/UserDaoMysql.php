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
    public function insertUser($userName, $password, $firstname, $lastname, $email, $role)
    {
        $dbConn = new mysqlConnector();

        $sql = "INSERT INTO user(userName, password, firstname, lastname, email, role) VALUES (?, ?, ?, ?, ?, ?)";
  
        $stmt = $dbConn->getConnector()->prepare($sql);
        $stmt->bind_param('ssssss', $userName, $password, $firstname, $lastname, $email, $role);
        $stmt->execute();
        
        $dbConn->getConnector()->close();
    }

    public function updateUser($id)
    {

    }
    
    public function deleteUser($id)
    {

    }

    public function selectUser($username)
    {
        $newUser = null;
        $dbConn = new mysqlConnector();

        $userid;
        $userName;
        $password;
        $firstname;
        $lastname;
        $email;
        $role;
        
        $sql = "SELECT userID, userName, password, firstname, lastname, email, role FROM user WHERE userName = ?"; 
        $stmt = $dbConn->getConnector()->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        
        //checken of de sql statement een resultset teruggeeft (hij is leeg als de user niet bestaat)
        if (mysqli_stmt_result_metadata() !== null)
        {    
        $stmt->store_result();
		$stmt->bind_result(
            $userid,
            $userName,
            $password,
            $firstname,
            $lastname,
            $email,
            $role
        );
            // Vul de rij met maar 1 record uit de database
            while ($stmt->fetch()) 
            {
                $newUser = new User($userid, $userName, $password, $firstname, $lastname, email, $role);
            }
        }else
        {
            //alles op null zetten bij teruggave lege resultset
            $userid = null;
            $userName = null;
            $password = null;
            $firstname = null;
            $lastname = null;
            $email = null;
            $role = null;
            $newUser = new User($userid, $userName, $password, $firstname, $lastname, email, $role);
        }
        
        
        return $newUser;
    }
    
    public function selectAllUsers()
    {
        
    }
}

?>