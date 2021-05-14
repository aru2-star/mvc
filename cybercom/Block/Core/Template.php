<?php
namespace Block\Core;

class Template
{
	protected $children = [];
	protected $template = null;
	protected $message = null;
	protected $url = null;
	function __construct() {
		$this->setUrl();
	}
	
	public function setTemplate($template) {

		$this->template = $template;
		return $this;
	}

	function getAdminMessage() {
		return \Mage::getModel('Model\Admin\Message');
	}


	public function getTemplate() {

		return $this->template;
	}
	public function toHtml() {
		ob_start();
		require_once $this->getTemplate();
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}

	public function getRequest()
    {
        return \Mage::getModel('Model\Core\Request');
    }

	public function setChildren(array $children = [])
	{
		$this->children = $children;
		return $this;
	}	

	public function getChildren()
	{
		return $this->children;
	}
	public function addChild(\Block\Core\Template $child,$key=null)
	{
		if (!$key) {
			$key = get_class($child);
		}
		$this->children[$key] = $child;
		return $this;
	}

	public function getChild($key)
	{
		if (!array_key_exists($key,$this->children)) {
			return null;
		}
		return $this->children[$key];
	}

	public function removeChild($key)
	{
		if (array_key_exists($key,$this->children)) {
			unset($this->children[$key]);
		}
		return $this;
	}

	public function getBlock($className){
		return \Mage::getBlock($className);
	}

	public function setUrl()
	{
		$this->url = \Mage::getModel('Model\Core\Url');
		return $this;
	}

	public function getUrl()
	{
		if (!$this->url) {
			$this->setUrl();
		}
		return $this->url;
	}

	public function baseUrl($subPath=null)		
	{	
		if ($subPath) {
			return $this->getUrl()->baseUrl($subPath);	
		}
		
	}
	
}

?>