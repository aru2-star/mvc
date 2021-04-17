<?php
namespace Controller\Core;

class Pager{
    protected $totalRecords = null;
    protected $recordPerPage = null;
    protected $noOfPages = null;
    protected $start = 1;
    protected $end = null;
    protected $previous = null;
    protected $next = null;
    protected $currentPage = null;

    public function setTotalRecords($record) 
    {
        $this->totalRecords = $record;
        return $this;
    }

    public function getTotalRecords()
    {
        return $this->totalRecords;
    }

    public function setRecordPerPage($record)
    {
        $this->recordPerPage = $record;
        return $this;
    }

    public function getRecordPerPage()
    {
        return $this->recordPerPage;
    }

    
    public function setNoOfPages($page)
    {
        $this->noOfPages = $page;
        return $this;
    }
    
    public function getNoOfPages()
    {
        return $this->noOfPages;
    }


    public function setStart($startRecordNo)
    {
        $this->start = $startRecordNo;
        return $this;
    }
    
    public function getStart()
    {
        return $this->start;
    }

    public function setPrevious($previous)
    {
        $this->previous = $previous;
        return $this;
    }
    
    public function getPrevious()
    {
        return $this->previous;
    }

    public function setNext($next)
    {
        $this->next = $next;
        return $this;
    }
    
    public function getNext()
    {
        return $this->next;
    }

    public function setEnd($endRecordNo)
    {
        $this->end = $endRecordNo;
        return $this;
    }
    
    public function getEnd()
    {
        return $this->end;
    }
    public function setCurrentPage($page)
    {
        $this->currentPage = $page;
        return $this;
    }

    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    public function calculate()
    {
        if($this->getTotalRecords() <= $this->getRecordPerPage()){
            $this->setNoOfPages(1);
            $this->setEnd(null);
            $this->setPrevious(null);
            $this->setNext(null);
            return $this;
        }
        $page = ceil($this->getTotalRecords()/$this->getRecordPerPage());
        $this->setNoOfPages($page);
        $this->setEnd($page);


        if($this->getCurrentPage() == $this->getStart()){
            $this->setPrevious(null);
            $this->setStart(null);
            if($this->getCurrentPage() < $this->getNoOfPages()){
                $this->setNext($this->getCurrentPage() + 1);   
            } 
            return $this;
        }

        if($this->getCurrentPage() == $this->getEnd()){
            $this->setNext(null);
            $this->setEnd(null);
            if($this->getCurrentPage() >= $this->getNoOfPages()){
                $this->setPrevious($this->getCurrentPage() - 1);
            } 
            return $this;
        }

        if($this->getCurrentPage() > $this->getStart() && $this->getCurrentPage() < $this->getEnd()){
            $this->setPrevious($this->getCurrentPage() - 1);
            $this->setNext($this->getCurrentPage() + 1);

        }
        return $this;
    }
        
}
?>