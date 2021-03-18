<?php
// echo "<pre>";
class Model_Core_Adapter
{
    private $hostname = 'localhost';
    private $user = 'root';//root
    private $password = "";//""
    private $database = 'Project2';//project1
    protected $connect = null;

    public function setConnect()
    {
        $this->connect = $this->connection();
    }

    public function getConnect()
    {
        return $this->connect;
    }

    private function connection()
    {
        $connect = new mysqli($this->hostname, $this->user, $this->password, $this->database);
        return $connect;
    }

    public function isConnected()
    {
        if (!$this->connect) {
            return false;
        }
        return true;
    }

    public function insert($query)
    {

        if (!$this->connect) {
            $this->setConnect();
        }

        try {
            if ($this->getConnect()->query($query)) {
                return $this->getConnect()->insert_id;
            }
            return false;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function update($query)
    {
        if (!$this->connect) {
            $this->setConnect();
        }

        try {
            if ($this->getConnect()->query($query)) {
                return true;
            }

            return false;
        } catch (Exception $e) {

            echo $e->getMessage();
        }
    }

    public function delete($query)
    {
        if (!$this->connect) {
            $this->setConnect();
        }

        try {
            if ($this->getConnect()->query($query)) {

                return true;
            }


            return false;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function fetchRow($query)
    {

        if (!$this->connect) {
            $this->setConnect();
        }

        try {
            if ($this->getConnect()->query($query)) {
                $result = $this->getConnect()->query($query)->fetch_assoc();
                return $result;
            }

            return false;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function fetchAll($query)
    {

        if (!$this->connect) {
            $this->setConnect();
        }

        try {
            if ($this->getConnect()->query($query)->num_rows > 0) {
                $result = $this->getConnect()->query($query)->fetch_all(MYSQLI_ASSOC);
                return $result;
            }

            throw new Exception("No rows to display");

            return false;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
?>
