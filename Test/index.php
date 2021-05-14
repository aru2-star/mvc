<?php
spl_autoload_register(__NAMESPACE__.'\Mage::loadFileByClassName');

class Mage
{
	public static function init() {
		//self::loadFileByClassName('Controller\Core\Front');
		\Controller\Core\Front::init();

	}

	public static function loadFileByClassName($className) {
	
		$className = str_replace("\\"," ",$className);
		$className = ucwords($className);
		$className = str_replace(" ","/",$className);
		$className = $className.".php";
		require_once($className);
	}

	public static function prepareClassName($key,$nameSpace) {
		$className = $key."_".$nameSpace;
		$className = str_replace("_"," ",$className);
		$className = ucwords($className);
		$className = str_replace(" ","\\",$className);
		return $className;
	}

	public static function getController($className)
	{
		//self::loadFileByClassName($className);
		$className = str_replace("\\"," ",$className);
		$className = ucwords($className);
		$className = str_replace(" ","\\",$className);
		return new $className();
	}

	public static function getBlock($className)
	{
		//self::loadFileByClassName($className);
		$className = str_replace("\\"," ",$className);
		$className = ucwords($className);
		$className = str_replace(" ","\\",$className);
		return new $className();
	}
	public static function getModel($className)
	{
		//self::loadFileByClassName($className);
		$className = str_replace("\\"," ",$className);
		$className = ucwords($className);
		$className = str_replace(" ","\\",$className);
		return new $className();
	}

	public static function getCollection($className)
	{
		//self::loadFileByClassName($className);
		$className = str_replace("\\"," ",$className);
		$className = ucwords($className);
		$className = str_replace(" ","\\",$className);
		return new $className();
	}

	public function setRegistry($key,$value)
	{
		$GLOBALS[$key] = $value;
	}

	public function getRegistry($key,$optional = null)
	{
		if(array_key_exists($key, $GLOBALS)){
			return $GLOBALS[$key];
		}
		return $optional;
	}	
}
Mage::init();
?>
