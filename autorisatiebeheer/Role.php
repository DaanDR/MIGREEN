<?php

public class Role {
    
    private $role;
    private $maxSessionDuration;
    private $dashboardLink;
    
    public function __construct($r, $msd, $dl) {
        $this->role = $r;
        $this->maxSessionDuration = $msd;
        $this->dashboardLink = $dl;
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
    public function getMaxSessionDuration()
    {
        return $this->maxSessionDuration;
    }
    
    /**
     * @return mixed
     */
    public function getDashboardLink()
    {
        return $this->dashboardLink;
    }
}

?>