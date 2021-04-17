<?php
namespace Block\Admin\Layout;

\Mage::loadFileByClassName('Block\Core\Template');

class Footer extends \Block\Core\Template
{
    public function __construct() {
        $this->setTemplate('./View/core/layout/footer.php');
    }
}

?>