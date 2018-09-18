<?php

interface EnvironmentDao 
{ 
    public function insertEnvironment($systemName, $customerName);
    public function updateEnvironment($systemNameOld, $systemNameNew, $customerName);
    public function deactivateEnvironment($systemName);
    public function selectEnvironment($systemName);
    public function selectViewCurrentEnvironments();
}

?>