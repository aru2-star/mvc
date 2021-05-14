<?php
namespace Model\Core;
class Adapter 
{
	public $config = [
		'host'=>'localhost',
		 'user'=> 'root',
		 'password'=>'',
		 'dbName' => 'test'
	];
	private $connect = null;
	public function connection()
	{
		
	$connect = new \mysqli($this->config['host'], $this->config['user'], $this->config['password'], $this->config['dbName']);
		

		$this->setConnect($connect);
		return $this;
	}

	public function getConnect() {

		return $this->connect;
	}

	public function setConnect(\mysqli $connect) {
		$this->connect = $connect;
		return $this;
	}
	
	public function isConnected() {
		if (!$this->getConnect()) {
			return false;
		}
		return true;
	}
	
	public function fetchRow($query) {
	
		if (!$this->isConnected()) {
			$this->connection();
		}
		$result = $this->getConnect()->query($query);
		$row = $result->fetch_assoc();
		if(!$row) {
			return false;
		}
		return $row;
	
	}

	public function fetchAll($query) {
		
		if (!$this->isConnected()) {
			$this->connection();
		}
		
		$result = $this->getConnect()->query($query);
		$rows = $result->fetch_all(MYSQLI_ASSOC);
		if (!$rows) {
			return false;
		}
		
		return $rows;
	
	}
	
	public function insert($query) {
	    if (!$this->isConnected()) {
            $this->connection();
        } 
		$result = $this->getConnect()->query($query);
		
		if (!$result) {
			return false;
		}
		return $this->getConnect()->insert_id;
		
        
	}

	
	public function update($query) {
	    if (!$this->isConnected()) {
	    	$this->connection();
        } 
		$result = $this->getConnect()->query($query);
		if (!$result) {
			return false;
		}
        return true;

	}

	public function alterTable($query) {
	    if (!$this->isConnected()) {
	    	$this->connection();
        } 
		$result = $this->getConnect()->query($query);
		if (!$result) {
			return $this->getConnect()->error;
		}
        return true;

	}
	
	public function delete($query) {
		if (!$this->isConnected()) {
            $this->connection();
        } 
		$result = $this->getConnect()->query($query);
        return true;
    }

    public function fetchOne($query)
    {
    	if (!$this->isConnected()) {
    		$this->connection();
    	}
    	$result = $this->getConnect()->query($query);
    	$rows = $result->num_rows;
		return $rows;
    }

    public function fetchPairs($query)
    {
    	if (!$this->isConnected()) {
    		$this->connection();
    	}
    	$result = $this->getConnect()->query($query);
    	$rows = $result->fetch_all();
    	if (!$rows) {
    		return $rows;
    	}

    	$column = array_column($rows,'0');
    	$value = array_column($rows,'1');
    	return array_combine($column, $value);
    }	
}





?>