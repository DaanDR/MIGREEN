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
    
    public function __construct($id, $username, $password, $firstname, $lastname, $role) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->role = $role;
    }
    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    
}

?>
