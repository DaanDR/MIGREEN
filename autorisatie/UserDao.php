<?php

interface UserDao 
{ 
    public function insertUser($userName, $name, $company, $role);
    public function updateUser($id);
    public function deleteUser($id);
    public function selectUser($id);
}

?>