<?php

include_once ("../dbconnection/mysqlConnector.php");
include_once ("RoleDao.php");

class RoleDaoMysql implements RoleDao
{
    // private $usr = new User();
    private $dbConn;

    public function __construct()
    {
    }

    // Insert new Role
    public function insertRole($role, $maxSessionDuration, $dashboardLink)
    {
        $dbConn = new mysqlConnector();

        $sql = "INSERT INTO role(role,sessionDuration_hour,dashboard_link) VALUES (?, ?, ?)";
  
        $stmt = $dbConn->getConnector()->prepare($sql);
        $stmt->bind_param('sis', $role, $maxSessionDuration, $dashboardLink);
        $stmt->execute();
        
        $dbConn->getConnector()->close();
    }

    public function updateRole($role)
    {

    }
    
    public function deleteRole($role)
    {

    }
    
    public function selectRole($role)
    {
        $newRole = null;
        $dbConn = new mysqlConnector();

        $role;
        $maxSessionDuration;
        $dashboardLink;
        
        $sql = "SELECT role, maxsessionduration, dashboardlink FROM role WHERE role = ? LIMIT 1"; 
        $stmt = $dbConn->getConnector()->prepare($sql);
        $stmt->bind_param('s', $role);
        $stmt->execute();
        $stmt->store_result();
		$stmt->bind_result(
            $role,
            $maxSessionDuration;
            $dashboardLink;
        );
        
        // Vul de rij met maar 1 record uit de database
        while ($stmt->fetch()) 
        {
            $newRole = new Role($role, $maxSessionDuration, $dashboardLink);
        }
        return $newRole;
    }
    
    public function selectAllRoles()
    {
        
    }
}

?>