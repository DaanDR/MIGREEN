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

    public function updateRole($id)
    {

    }
    public function deleteRole($id)
    {

    }
    public function selectRole($id)
    {

    }
}

?>