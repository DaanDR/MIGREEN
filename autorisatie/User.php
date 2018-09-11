<?php

namespace Autorisatie;

// use placeholder

/** 
 * Class User 
 * @package Autorisatie
*/

class User {
    private $id;
    private $username;
    private $password;
    private $firstname;
    private $lastname;
    private $role;
    
    public function __construct($username, $password, $firstname, $lastname, $role) {
        $this->username = $username;
        $this->password = $password;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->role = $role;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
}







/>
