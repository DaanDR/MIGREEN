<?php

interface CustomerDao
{

    public function insertCustomer($customername);

<<<<<<< HEAD
    public function updateCustomer($customername, $newname);
=======
    public function updateCustomer($customername);
>>>>>>> 65b45025b47cd6f5974e41353d05710b7583fbe2

    public function deleteCustomer($customername);

    public function selectCustomer($customername);

    public function selectAllCustomers();
}
?>