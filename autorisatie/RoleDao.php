<?php

interface RoleDao 
{ 
    public function insertRole($role, $maxSessionDuration, $dashboardLink);
    public function updateRole($id);
    public function deleteRole($id);
    public function selectRole($id);
}

?>