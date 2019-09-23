<?php 
abstract class DomainObject
{
	protected $id;
	public function getId()
	{
		return $this->id;
	}
	
	protected function __construct($id)
	{
		$this->id = $id;
	}
}
?>