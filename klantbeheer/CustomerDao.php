<?php

interface CustomerDao
{

    public function insertCustomer($customername);

    public function updateCustomer($customername, $newname);

    public function deleteCustomer($customername);

    public function selectCustomer($customername);

    public function selectAllCustomers();
}
?>