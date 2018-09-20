<?php

interface EnvironmentDao 
{ 
    public function insertEnvironment($systemName, $customerName, $vmURL);
    public function updateEnvironment($systemID, $systemNameNew, $customerName, $vmURL);
    public function deactivateEnvironment($systemName);
    public function selectEnvironment($systemName);
    public function selectViewCurrentEnvironments();
}

?>