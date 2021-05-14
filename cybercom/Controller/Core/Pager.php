<?php 

namespace Controller\Core;

class Pager
{
	protected $totalRecords = null;
	protected $noOfPages = null;
	protected $recordsPerPage = null;
	protected $startOffset = 1;
	protected $previous = null;
	protected $next = null;
	protected $end = null;
	protected $current = null;

	public function setTotalRecords($totalRecords)
	{
		$this->totalRecords = $totalRecords;
		return $this;
	}

	public function setNoOfPages($noOfPages)
	{
		$this->noOfPages = $noOfPages;
		return $this;
	}

	public function setRecordsPerPage($recordsPerPage)
	{
		$this->recordsPerPage = $recordsPerPage;
		return $this;
	}
	public function setStartOffset($startOffset)
	{
		$this->startOffset = $startOffset;
		return $this;
	}

	public function setPrevious($previous)
	{
		$this->previous = $previous;
		return $this;
	}

	public function setEnd($end)
	{
		$this->end = $end;
		return $this;
	}

	public function setNext($next)
	{
		$this->next = $next;
		return $this;
	}

	public function setCurrentPage($current)
	{
		$this->current = $current;
		return $this;
	}

	public function getCurrentPage()
	{
		return $this->current;
	}

	public function getNext()
	{
		return $this->next;
	}
	public function getTotalRecords()
	{
		return $this->totalRecords;
	}

	public function getNoOfPages()
	{
		return $this->noOfPages;
	}

	public function getRecordsPerPage()
	{
		return $this->recordsPerPage;
	}

	public function getStartOffset()
	{
		return $this->startOffset;
	}

	public function getPrevious()
	{
		return $this->previous;
	}

	public function getEnd()
	{
		return $this->end;
	}

	public function calculate()
	{
		if ($this->getTotalRecords() <= $this->getNoOfPages()) {
			 $this->setNoOfPages(1);
			 $this->setStartOffset(1);
			 $this->setPrevious(null);
			 $this->setEnd(null);
			 $this->setNext(null);
			 return $this;
		}
		$page  = ceil($this->getTotalRecords()/$this->getRecordsPerPage());
		$this->setNoOfPages($page);
		$this->setEnd($page);

		if ($this->getCurrentPage() > $this->getNoOfPages()) {
			$this->setCurrentPage($this->getNoOfPages());
		}

		if ($this->getCurrentPage() < $this->getStartOffset()) {
			$this->setCurrentPage($this->getStartOffset());
		}
		if ($this->getCurrentPage() == $this->getStartOffset()) {
			$this->setPrevious(null);
			$this->setEnd(null);
			if ($this->getCurrentPage() < $this->getNoOfPages()) {
				$this->setNext($this->getCurrentPage() + 1);
			}
			$this->setNext(null);
		}

		if ($this->getCurrentPage() == $this->getEnd()) {
			$this->setNext(null);
			$this->setEnd(null);
			if ($this->getCurrentPage() >= $this->getNoOfPages()) {
				$this->setPrevious($this->getCurrentPage() - 1);
				$this->setNext(null);
			}
			return $this;
			
		}

		if ($this->getCurrentPage() > $this->getStartOffset() && $this->getCurrentPage() < $this->getEnd()) {
				$this->setNext($this->getCurrentPage() + 1);
		}
		return $this;
	}
}



?>