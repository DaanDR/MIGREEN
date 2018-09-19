<?php

interface EnvironmentDao 
{ 
    public function insertEnvironment($systemName, $customerName);
    public function updateEnvironment($systemName, $customerName);
    public function deactivateEnvironment($systemName);
    public function selectEnvironment($systemName);
    public function selectViewCurrentEnvironments();
}

?>