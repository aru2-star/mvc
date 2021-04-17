<?php
spl_autoload_register(__NAMESPACE__.'\Mage::loadFileByClassName');
class Mage
    {
        public static function init()
        {
            \Controller\Core\Front::init();
        }
        
        public static function getController($className)
        {
            $className = str_replace('_',' ',$className);  
            $className = ucwords($className);
            $className = str_replace(' ','_',$className);
            return new $className;
        }

        public static function getModel($className)
        {
            $className = str_replace('\\',' ',$className);  
            $className = ucwords($className);
            $className = str_replace(' ','\\',$className);
            return new $className;
        }

        public static function getBlock($className, $ton = false)
        {
            if(!$ton){
                $className = str_replace('\\',' ',$className);  
                $className = ucwords($className);
                $className = str_replace(' ','\\',$className);
                return new $className;
            }
            $value = self::getRegistry($className);
            if($value){
                return $value;
            }
            $className = str_replace('\\',' ',$className);  
            $className = ucwords($className);
            $className = str_replace(' ','\\',$className);
            $value = new $className;
            self::getRegistry($className,$value);
            return $value;            
        }

        public  static function loadFileByClassName($className)
        {  
            $className = str_replace('\\',' ',$className);  
            $className = ucwords($className);
            $className = str_replace(' ','/',$className);
            $className = $className . '.php';
            require_once ($className);
        }

        public static function setRegistry($key, $value)
        {
            $GLOBALS[$key] = $value;
        }

        public static function getRegistry($key, $optional = null)
        {
            if(!array_key_exists($key, $GLOBALS)){
                return $optional;
            }
            return $GLOBALS[$key];
        }        
    }
Mage::init();
?>
