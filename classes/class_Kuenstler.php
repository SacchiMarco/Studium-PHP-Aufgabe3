<?php 
class Kuenstler extends DomainObject
{
	private $name;
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function __construct($id, $name = "")
	{
		parent::__construct($id);
		$this->setName($name);
	}
	
	public function toHTMLTableColums()
	{
		return '<td>'. $this->getId() .'</td>
		        <td>'. $this->getName() .'</td>
					 ';
	}
	
	public function toHTMLTableRow()
	{
		return '<tr>'. $this->toHTMLTableColums() . '</tr>';
	}
	
	public function __toString()
	{
		return $this->name;
	}
}
?>