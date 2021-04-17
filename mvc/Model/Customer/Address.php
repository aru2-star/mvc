<?php

namespace Model\Customer;

class Address extends \Model\Core\Table
{
    const ADDRESS_TYPE_BILLING = "billing";
    const ADDRESS_TYPE_SHIPPING = "shipping";
    const STATUS_ENABLED = 1;
    const  STATUS_DISABLED = 0;

    public function __construct()
    {

        $this->tableName = 'customer_address';
        $this->primaryKey = 'addressId';
    }
}
