<?php
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
    private $email;
    private $role;
    private $status_active;
    
    public function __construct($id, $username, $password, $firstname, $lastname, $email, $role, $status_active) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->role = $role;
        $this->status_active = $status_active;
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status_active;
    }
    
    
    public function setId($id)
    {
        $this->id = $id;
    }
    
}

?>
