<?php

/**
 * Class Klant
 * @package klantbeheer
 */

class Customer{
    private $customername;
    private $status_active;
    
    public function _construct($customername){
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
     * 
     */
    
    public function getStatus(){
        return $this->status_active;
    }
}
?>