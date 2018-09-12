<?php

interface RoleDao 
{ 
    public function insertRole($role, $maxSessionDuration, $dashboardLink);
    public function updateRole($role, $maxSessionDuration, $dashboardLink);
    public function deleteRole($role);
    public function selectRole($role);
    public function selectAllRoles();
}

?>