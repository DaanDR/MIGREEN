<?php

/**
 * Class Klant
 * @package klantbeheer
 */

class Customer{
    private $customername;
    
    public function _construct($customername){
        $this->customername = $customername;
    }
    
    /**
     * @return mixed
     */
    
    public function getCustomerName(){
        return $this->customername;
    }
}
?>