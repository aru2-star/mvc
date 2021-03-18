<?php
class Mage
{

    public static function init()
    {
        self::loadFileByClassName('Controller_Core_Front');
        Front::init();
    }

    public static function loadFileByClassName($className)
    {
        $className = str_replace('_', ' ', $className);
        $className = ucwords($className);
        $className = str_replace(' ', '/', $className);
        $className = $className . '.php';
        require_once('./' . $className);
    }

    public static function getController($className)
    {
        self::loadFileByClassName($className);
        $className = str_replace('_', ' ', $className);
        $className = ucwords($className);
        $className = str_replace(' ', '_', $className);
        return new $className;
    }

    public static function getBlock($className)
    {
        self::loadFileByClassName($className);
        $className = str_replace('_', ' ', $className);
        $className = ucwords($className);
        $className = str_replace(' ', '_', $className);
        return new $className;
    }

    public static function getModel($className)
    {
        self::loadFileByClassName($className);
        $className = str_replace('_', ' ', $className);
        $className = ucwords($className);
        $className = str_replace(' ', '_', $className);
        return new $className;
    }

    public static function getBaseDir($subPath = null) {
        if ($subPath) {
            # code...
            return getcwd().DIRECTORY_SEPARATOR.$subPath;
        }
        return getcwd();
    }
}

$mage = new Mage();
Mage::init();
?>
