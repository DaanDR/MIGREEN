<?php

interface UserDao 
{ 
    public function insertUser($userName, $password, $firstname, $lastname, $email, $role);
    public function updateUser($username, $password, $firstname, $lastname, $email, $role);
    public function deactivateUser($username);
    public function selectUser($username);
    public function selectViewCurrentUsers();
}

?>