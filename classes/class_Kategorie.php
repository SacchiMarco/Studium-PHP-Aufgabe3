<?php 
class Kategorie
{
	private $name;
	private $id;
	
	public function __construct($id, $name = "")
	{
		$this->setName($name);
		$this->setId($id);
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setId($id)
	{
		$this->id = $id;
	}
	
	public function getId()
	{
		return $this->id;
	}
}
?>