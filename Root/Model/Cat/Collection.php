<?php

// Mage::loadFileByClassName('Model_Core_Table_Collection');
// class Model_Cat_Collection extends Model_Core_Table_Collection {

// 	protected $data = [];

// 	//public function
// }

class Model_Cat_Collection
{
    protected $data = [];

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }
}


?>
