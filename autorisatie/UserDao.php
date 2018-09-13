<?php

interface UserDao 
{ 
    public function insertUser($userName, $password, $firstname, $lastname, $role);
    public function updateUser($id);
    public function deleteUser($id);
    public function selectUser($username, $password);
    public function selectViewCurrentUsers();
}

?>