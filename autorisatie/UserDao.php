<?php

interface UserDao 
{ 
    public function insertUser($userName, $password, $firstname, $lastname, $email, $role);
    public function updateUser($id);
    public function deleteUser($id);
    public function selectUser($username);
    public function selectAllUsers();
}

?>