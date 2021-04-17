<?php
    namespace Model\Core;
    \Mage::loadFileByClassName('Model\Core\Adapter');

    class Table{
        protected $adapter = NULL;
        protected $primaryKey = NULL;
        protected $tableName = NULL;
        protected $originalData = [];
        protected $data = [];

        
        public function setOriginalData($originalData)
        {
            $this->originalData = $originalData;
            return $this;
        } 
        
        public function getOriginalData()
        {
            return $this->originalData;
        }

        public function resetData()
        {
            $this->data = [];
            return $this;
        }
        public function setAdapter(\Model\Core\Adapter $adapter=null){
            if (!$adapter){
                $adapter = \Mage::getModel('Model\Core\Adapter');
            }
            $this->adapter = $adapter;
            return $this;
        }
        public function getAdapter(){
            if(!$this->adapter){
                $this->setAdapter();
            }
            return $this->adapter;
        }
        public function setPrimaryKey($primaryKey){
            $this->primaryKey = $primaryKey;
            return $this;
        }
        public function getPrimaryKey(){
            return $this->primaryKey;
        }
        public function setData(array $data){
            $this->data = array_merge($this->data,$data);
            return $this;
        }
        public function getData(){
            return $this->data;
        }
        public function setTableName($tableName){
            $this->tableName = $tableName;
            return $this;
        }
        public function getTableName(){
            return $this->tableName;
        }
        public function __set($key,$value)
        {
            $this->data[$key] = $value;
            return $this;
        }
        public function __get($key)
        {
            if(array_key_exists($key,$this->data)){
                return $this->data[$key];
            }
            if(array_key_exists($key,$this->originalData)){
                return $this->originalData[$key];
            }
            return null;;
        }
        
        public function load($value){
            $value = (int)$value;
            $query = "SELECT * FROM `{$this->getTableName()}` WHERE `{$this->getPrimaryKey()}`='{$value}'";
            return $this->fetchRow($query);
            
        }

        public function fetchRow($query){
            $row = $this->getAdapter()->fetchRow($query);
            if(!$row){
                return false;
            }
            $this->setOriginalData($row);
            $this->resetData();
            return $this;
        }
        
        public function fetchAll($query = NULL) {
            if(!$query){
                $query = "SELECT * FROM `{$this->getTableName()}`";
            }
            $rows = $this->getAdapter()->fetchAll($query);
            
            if(!$rows) {
                return false;
            }
            foreach ($rows as $key => $value) {
                $rows = new $this;
                //$rows->setData($value);
                $rows->setOriginalData($value);
                $rowArray[] = $rows;
            }
            $collectionClassName = get_class($this).'\Collection';
            $collection = \Mage::getModel($collectionClassName);
            $collection->setData($rowArray);
            unset($rows);
            return $collection;
        }
        public function save($query = null)
        {      
            if(!$query){
                if(array_key_exists($this->getPrimaryKey(),$this->data)){     
                    unset($this->data[$this->getPrimaryKey()]);
                }    
                if(!$this->data){
                    return false;
                }
                if(!array_key_exists($this->getPrimaryKey(),$this->getOriginalData())){  
                    $keys = "`" . implode("`,`",array_keys($this->data)) . "`";
                    $values = "'" . implode("','",$this->data) . "'";
                    $query = "INSERT INTO `". $this->getTableName() ."` (". $keys . ") VALUES (". $values . ")";
                    return $this->getAdapter()->insert($query);  
                }
                $args = [];
                foreach ($this->getData() as $key => $value) {
                    $args[] = "`$key` = '$value'";
                }
                $id = $this->originalData[$this->getPrimaryKey()];
                $query = "UPDATE `{$this->getTableName()}`  SET ".implode(",",$args) . " WHERE  `{$this->getPrimaryKey()}` = '{$id}'";
            return $this->getAdapter()->update($query);
        }

        function addressSave1(){   
            $data = $this->getData();
            if(array_key_exists($this->getPrimaryKey(), $data)){             
                $query = "UPDATE `{$this->getTableName()}` SET ";            
                foreach ($data as $key => $value) {
                    if($key == $this->getPrimaryKey()){                                  
                        continue;
                    } 
                    $query.= $key.'='."'$value'" .',';   
                }
                $query = substr($query, 0, -1); 
                $query .= " WHERE `{$this->getPrimaryKey()}` = '{$data[$this->getPrimaryKey()]}'";    
                $query .= "&& `addressType` = '{$data['addressType']}'";
            }
            $rows = $this->getAdapter()->fetchAll("SELECT `customerId` FROM `customer_address`");  
            $arr = [];
            foreach($rows as $key=>$value){
                $arr[] = $value[$this->getPrimaryKey()];  
            }
            if(count(array_keys($arr,$data[$this->getPrimaryKey()])) != 2 || !$arr){
                echo $query = "INSERT INTO `{$this->getTableName()}` (".implode(",", array_keys($data)) . ") VALUES ('" . implode("','", array_values($data)) . "')"; 
            }
            return $this->getAdapter()->insert($query);
        }
    
        function delete($query = null){
            if(!$query){
                $id = $_GET['id'];                 
                $query="Delete FROM `{$this->getTableName()}` WHERE  `{$this->getPrimaryKey()}` = '{$id}'";
            }
            return $this->getAdapter()->delete($query);  
        }
    }
}
?>