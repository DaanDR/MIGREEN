<?php

// Default Connector voor de mysql...
include_once ("../dbconnection/mysqlConnector.php");
include_once ("EnvironmentDao.php");
include_once ("Environment.php");

class EnvironmentDaoMysql implements EnvironmentDao
{
    private $dbConn;
    

    public function __construct()
    {
    }

    
    
    // Create new Environment in database
    public function insertEnvironment($systemName, $customerName)
    {
        try {
            $dbConn = new mysqlConnector();
            
            if($customerName !== null){
                $sql = "INSERT INTO environment(systemName, customerName) VALUES (?, ?)";
  
                $stmt = $dbConn->getConnector()->prepare($sql);
                $stmt->bind_param('ss', $systemName, $customerName);
                $stmt->execute();
            }
            else {
                $sql = "INSERT INTO environment(systemName) VALUES (?)";
  
                $stmt = $dbConn->getConnector()->prepare($sql);
                $stmt->bind_param('s', $systemName);
                $stmt->execute();    
            }
        
            $dbConn->getConnector()->close();
        }        
        catch(Exception $e) {
        return FALSE;
        }
        
        return TRUE;
    }
    
    
    // Functionality: add a customer to an environment, or change the customer allready coupled with an environment
    public function updateEnvironment($systemName, $customerName)
    {
        try {
            $dbConn = new mysqlConnector();
        
            $sql = "UPDATE environment SET customerName = ? WHERE systemName = ?";
        
            $stmt = $dbConn->getConnector()->prepare($sql);
            $stmt->bind_param('ss', $customerName, $systemName);
            $stmt->execute();
        
            $dbConn->getConnector()->close();
        }
        catch(Exception $e) {
        return FALSE;
        }
        return TRUE;
    }
    
    
    // implementation of the delete functionality (a soft delete)
    public function deactivateEnvironment($systemName)
    {
        try {
            $dbConn = new mysqlConnector();
        
            $sql = "UPDATE environment SET status_active = 0 WHERE systemName = ?";
            $stmt = $dbConn->getConnector()->prepare($sql);
            $stmt->bind_param('s', $systemName);
            $stmt->execute();
        
            $dbConn->getConnector()->close();
        }
        catch(Exception $e) {
        return FALSE;
        }
        
        return TRUE;
    }
    
    
    // undo the soft delete for later implementation in the front end
    public function reactivateEnvironment($systemName)
    {  
        try {   
            $dbConn = new mysqlConnector();
        
            $sql = "UPDATE environment SET status_active = 1 WHERE systemName = ?";
            $stmt = $dbConn->getConnector()->prepare($sql);
            $stmt->bind_param('s', $systemName);
            $stmt->execute();
        
            $dbConn->getConnector()->close();
        }
        catch(Exception $e) {
        return FALSE;
        }
    
        return TRUE;    
    }

    
    public function selectEnvironment($systemName)
    {
        try {
            $systemNamedb;
            $customerNamedb;
            $status_activedb;
            $newEnvironment;
            
            $dbConn = new mysqlConnector();

            $sql = "SELECT systemName, customerName, status_active FROM environment WHERE systemName = ?"; 
            $conn = $dbConn->getConnector();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $systemName);
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
        $systemNamedb,
        $customerNamedb,
        $status_activedb
        );
            // Vul de rij met maar 1 record uit de database
            while ($stmt->fetch()) 
            {
                $newEnvironment = new Environment($systemNamedb, $customerNamedb, $status_activedb);
            }
        }else
        {
            //alles op null zetten bij teruggave lege resultset
            $newEnvironment = new Environment($systemName = null, $customerName = null, $status_active = FALSE);
        }
        
        
        return $newEnvironment;
    }
    
    public function selectViewCurrentEnvironments()
    {
        $environments = null;
        $dbConn = new mysqlConnector();

        $systemName;
        $customerName;
        
        
        $sql = "SELECT systemName, customerName FROM environment WHERE status_active = 1 ORDER BY systemName"; 
        $stmt = $dbConn->getConnector()->prepare($sql);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result(
            $systemName,
            $customerName
        );

        while ($stmt->fetch()) 
        {
            $environments[] = array(
                "systemName" => $systemName,
                "customerName" => $customerName
            );
        }

        return $environments;

    }
    
    
    
}

?>