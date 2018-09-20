<?php


/** 
 * Class Environment
 * @package omgevingsbeheer
*/

class Environment {
    private $systemID;
    private $systemName;
    private $customerName;
    private $vmURL;
    private $status_active;
    
    public function __construct($systemID, $systemName, $customerName, $vmURL, $status_active) {
        $this->systemID = $systemID;
        $this->systemName = $systemName;
        $this->customerName = $customerName;
        $this->vmURL = $vmURL;
        $this->status_active = $status_active;
    }
    
    
    /**
     * @return mixed
     */
    public function getSystemID()
    {
        return $this->systemID;
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
    public function getVmURL()
    {
        return $this->vmURL;
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
