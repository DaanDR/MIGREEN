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
    
}

?>