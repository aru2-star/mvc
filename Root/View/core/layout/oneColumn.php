<?php

// $children = $this->getChildren();

// foreach ($children as $child) {
//     $child->toHtml();
// }


echo $this->getChild('header')->toHtml();
echo $this->createBlock('Block_Core_Layout_Message')->toHtml();
echo $this->getChild('content')->toHtml();
echo $this->getChild('footer')->toHtml();

/*
	<script src = "<?php echo $this->baseUrl('Skin/Admin/Js/jqueryblahblah.js'); ?>"></script>	
	<script src = "<?php echo $this->baseUrl('Skin/Admin/Js/Mage.js'); ?>"></script>	
*/
?>