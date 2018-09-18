<?php


/** 
 * Class Environment
 * @package omgevingsbeheer
*/

class Environment {
    private $systemName;
    private $customerName;
    private $status_active;
    
    public function __construct($systemName, $customerName, $status_active) {
        $this->systemName = $systemName;
        $this->customerName = $customerName;
        $this->status_active = $status_active;
    }
    
    
    /**
     * @return mixed
     */
    public function getSystemName()
    {
        return $this->systemName;
    }

    /**
     * @return mixed
     */
    public function getCustomerName()
    {
        return $this->customerName;
    }

    
    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status_active;
    }
    
    
    
    
}

?>
