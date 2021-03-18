<?php
Mage::loadFileByClassName('Model_Core_Table');


class Model_Product_Group_Price extends Model_Core_Table
{
    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;

    public function __construct()
    {
        parent::__construct();
        $this->setTableName('product_group_price');
        $this->setPrimaryKey('entityId');
    }

    public function getStatusOptions()
    {
        return [
            self::STATUS_ENABLE => "Enable",
            self::STATUS_DISABLE => "Disable"
        ];
    }
}
?>
