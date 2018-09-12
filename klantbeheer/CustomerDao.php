<?php

interface CustomerDao
{

    public function insertCustomer($customername);

    public function updateCustomer($customerid);

    public function deleteCustomer($customerid);

    public function selectCustomer($customername);

    public function selectAllCustomers();
}
?>