<?php

// Default Connector voor de mysql...
include_once ("../dbconnection/mysqlConnector.php");
include_once ("UserDao.php");
include_once ("User.php");

class UserDaoMysql implements UserDao
{
    private $dbConn;
    

    public function __construct()
    {
    }

    
    // Insert new User
    public function insertUser($username, $password, $firstname, $lastname, $email, $role)
    {
        try {
            $dbConn = new mysqlConnector();
        
            $sql = "INSERT INTO user(userName, password, firstname, lastname, email, role) VALUES (?, ?, ?, ?, ?, ?)";
  
            $stmt = $dbConn->getConnector()->prepare($sql);
            $stmt->bind_param('ssssss', $username, $password, $firstname, $lastname, $email, $role);
            $stmt->execute();
        
            $dbConn->getConnector()->close();
        }        
        catch(Exception $e) {
        return FALSE;
        }
        
        return TRUE;
    }
    
    
    // In front end: make sure you have complete record in your fields of the form, use the selectUser function for this
    public function updateUser($username, $password, $firstname, $lastname, $email, $role)
    {
        try {
            $dbConn = new mysqlConnector();
        
            $sql = "UPDATE user SET password = ?, firstname = ?, lastname = ?, email = ?, role = ? WHERE userName = ?";
        
            $stmt = $dbConn->getConnector()->prepare($sql);
            $stmt->bind_param('ssssss', $password, $firstname, $lastname, $email, $role, $username);
            $stmt->execute();
        
            $dbConn->getConnector()->close();
        }
        catch(Exception $e) {
        return FALSE;
        }
        return TRUE;
    }
    
    
    // implementation of the delete functionality (a soft delete)
    public function deactivateUser($username)
    {
        try {
            $dbConn = new mysqlConnector();
        
            $sql = "UPDATE user SET status_active = 0 WHERE userName = ?";
            $stmt = $dbConn->getConnector()->prepare($sql);
            $stmt->bind_param('s', $username);
            $stmt->execute();
        
            $dbConn->getConnector()->close();
        }
        catch(Exception $e) {
        return FALSE;
        }
        
        return TRUE;
    }
    
    
    // undo the soft delete for later implementation in the front end
    public function reactivateUser($username)
    {  
        try {   
            $dbConn = new mysqlConnector();
        
            $sql = "UPDATE user SET status_active = 1 WHERE userName = ?";
            $stmt = $dbConn->getConnector()->prepare($sql);
            $stmt->bind_param('s', $username);
            $stmt->execute();
        
            $dbConn->getConnector()->close();
        }
        catch(Exception $e) {
        return FALSE;
        }
    
        return TRUE;    
    }

    
    public function selectUser($username)
    {
        try {
            $newUser = null;
            $dbConn = new mysqlConnector();

            $userid;
            $userName;
            $password;
            $firstname;
            $lastname;
            $email;
            $role;
        
            $sql = "SELECT userID, userName, password, firstname, lastname, email, role, status_active FROM user WHERE userName = ?"; 
            $conn = $dbConn->getConnector();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $stmt->store_result();    
        }
        catch(Exception $e) {
        return FALSE;
        }
        
        //checken of de sql statement een resultset teruggeeft (hij is leeg als de user niet bestaat)
        if ($stmt->num_rows > 0)
        {    
        
		$stmt->bind_result(
            $userid,
            $userName,
            $password,
            $firstname,
            $lastname,
            $email,
            $role,
            $status_active
        );
            // Vul de rij met maar 1 record uit de database
            while ($stmt->fetch()) 
            {
                $newUser = new User($userid, $userName, $password, $firstname, $lastname, $email, $role, $status_active);
            }
        }else
        {
            //alles op null zetten bij teruggave lege resultset
            $newUser = new User($userid = null, $userName = null, $password = null, $firstname = null, $lastname = null, $email = null, $role = null, $status_active = FALSE);
        }
        
        
        return $newUser;
    }
    
    public function selectViewCurrentUsers()
    {
        $users = null;
        $dbConn = new mysqlConnector();

        $userName;
        $firstname;
        $lastname;
        $role;
        
        $sql = "SELECT userName, firstname, lastname, role FROM user WHERE status_active = 1 ORDER BY userName"; 
        $stmt = $dbConn->getConnector()->prepare($sql);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result(
            $userName,
            $firstname,
            $lastname,
            $role
        );

        while ($stmt->fetch()) 
        {
            $users[] = array(
                "userName" => $userName,
                "firstname" => $firstname,
                "lastname" => $lastname,
                "role" => $role
            );
        }

        return $users;

    }
    
    
    
}

?>