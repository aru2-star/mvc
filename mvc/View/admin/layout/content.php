<?php
$childrens = $this->getChildren();

foreach ($childrens as $child){
    $child->toHtml();
}
?>