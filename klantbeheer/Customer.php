<?php

/**
 * Class Klant
 * @package klantbeheer
 */

class Customer{
    private $customername;
    private $customerid;
    
    public function _construct($customerid, $customername){
        $this->customerid = $customerid;
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
    
    public function getCustomerId(){
        return $this->customerid;
    }
}
?>