<?php 
class Videos
{
	private $id;
	private $titel;
	private $dateigroesse;
	private $kuenstler;
	private $genre;
	
	public function __construct($id, $titel, $dateigroesse, $kuenstler, $genre)
	{
		$this->setId($id);
		$this->setTitel($titel);
		$this->setDateigroesse($dateigroesse);
		$this->setKuenstler($kuenstler);
		$this->setGenre($genre);
	}
	
	#SET ---------------------------
	private function setId($id)
	{
		$this->id = $id;
	}
	
	private function setTitel($titel)
	{
		$this->titel = $titel;
	}
	
	private function setDateigroesse($datg)
	{
		$this->dateigroesse = $datg;
	}
	
	private function setKuenstler($kuenstler)
	{
		$this->kuenstler = $kuenstler;
	}
	
	private function setGenre($genre)
	{
		$this->genre = $genre;
	}
	
	#GET --------------------------
	public function getId()
	{
		return $this->id;
	}
	
	public function getTitel()
	{
		return $this->titel;
	}
	
	public function getDateigroesse()
	{
		return $this->dateigroesse;
	}
	
	public function getKuenstler()
	{
		return $this->kuenstler;
	}
	
	public function getGenre()
	{
		$this->genre;
	}
}
?>