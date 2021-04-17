<?php
namespace Model\Brand;
\Mage::loadFileByClassName('Model\Core\Collection');

class Collection extends \Model\Core\Collection
{
   public function __construct()
   {
       \Mage::getModel('Model\Core\Collection');
   }
}

?>
