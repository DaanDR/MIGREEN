<?php

interface UserCustomerDao
{
    
    public function insertUserCustomer($username, $customername);
    public function clearUserCustomerLink($username, $customername);
    public function clearUserCustomer($username);
    public function getCustomersByUsername($username);

}
?>