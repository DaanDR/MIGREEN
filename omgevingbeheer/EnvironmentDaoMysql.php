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
    public function insertEnvironment($systemName, $customerName, $vmURL)
    {
        try {
            $dbConn = new mysqlConnector();
            
            if($customerName !== null){
                $sql = "INSERT INTO environment(systemName, customerName, vmURL) VALUES (?, ?, ?)";
  
                $stmt = $dbConn->getConnector()->prepare($sql);
                $stmt->bind_param('ss', $systemName, $customerName, $vmURL);
                $stmt->execute();
            }
            else {
                $sql = "INSERT INTO environment(systemName, vmURL) VALUES (?,?)";
  
                $stmt = $dbConn->getConnector()->prepare($sql);
                $stmt->bind_param('ss', $systemName, $vmURL);
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
    public function updateEnvironment($systemID, $systemNameNew, $customerName, $vmURL)
    {
        try {
            $dbConn = new mysqlConnector();
        
            $sql = "UPDATE environment SET systemName = ?, customerName = ?, vmURL = ? WHERE systemID = ?";
        
            $stmt = $dbConn->getConnector()->prepare($sql);
            $stmt->bind_param('sssi', $systemNameNew, $customerName, $vmURL, $systemID);
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

    //lookup an environment using the systemName and put in in an object
    public function selectEnvironment($systemName)
    {
        try {
            $systemIDdb;
            $systemNamedb;
            $customerNamedb;
            $status_activedb;
            $newEnvironment;
            
            $dbConn = new mysqlConnector();

            $sql = "SELECT systemID, systemName, customerName, vmURL, status_active FROM environment WHERE systemName = ?"; 
            $conn = $dbConn->getConnector();
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $systemName);
            $stmt->execute();
            $stmt->store_result();    
        }
        catch(Exception $e) {
        return FALSE;
        }
        
        //checken of de sql statement een resultset teruggeeft (hij is leeg als de omgeving niet bestaat)
        if ($stmt->num_rows > 0)
        {    
        
		$stmt->bind_result(
        $systemIDdb,
        $systemNamedb,
        $customerNamedb,
        $vmURLdb,
        $status_activedb
        );
            // Vul de rij met maar 1 record uit de database
            while ($stmt->fetch()) 
            {
                $newEnvironment = new Environment($systemIDdb, $systemNamedb, $customerNamedb, $vmURLdb, $status_activedb);
            }
        }else
        {
            //alles op null zetten bij teruggave lege resultset
            $newEnvironment = new Environment($systemIDdb = null, $systemName = null, $customerName = null, $vmURLdb = null, $status_active = FALSE);
        }
        
        
        return $newEnvironment;
    }
    
    //function used to display an overview of all systems in the database
    public function selectViewCurrentEnvironments()
    {
        try {    
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
        }
        catch(Exception $e) {
        
        }

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