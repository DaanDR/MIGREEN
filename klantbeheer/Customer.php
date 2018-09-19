<?php

/**
 * Class Klant
 * @package klantbeheer
 */

class Customer{
    private $customername;
    private $status_active;
    private $customerId;
    
    public function __construct($customername){
        $this->customername = $customername;
    }
    
    /**
     * @return mixed
     */
    
    public function getCustomerName(){
        return $this->customername;
    }
    
    /**
     * @return mixed 
     */
    
    public function getStatus(){
        return $this->status_active;
    }
    
   /**
    * @return mixed
    */
    
    public function getId(){
        return $this->customerId;
    }
}
?>