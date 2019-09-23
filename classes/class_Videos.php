<?php 
class Videos
{
	private $id;
	private $titel;
	private $dateigroesse;
	private $qualitaet;
	private $anmerkung;
	private $benotung;
	private $erscheinungsjahr;
	private $album;
	private $kuenstler;
	private $genre;
	
	public function __construct($id, $titel, $dateigroesse, $qualitaet, $anmerkung,
															$benotung, $erscheinungsjahr,
															$album, $kuenstler, $genre)
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
	
	private function setQualitaet($quali)
	{
		$this->qualitaet = $quali;
	}
	
	private function setAnmerkung($anmerkung)
	{
		$this->anmerkung = $anmerkung;
	}
	
	private function setBenotung($benotung)
	{
		$this->benotung = $benotung;
	}
	
	private function setErscheinungsjahr($ej)
	{
		$this->erscheinungsjahr = $ej;
	}
	
	private function setAlbum($album)
	{
		$this->album = $album;
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
	
	public function getQualitaet()
	{
		return $this->qualitaet;
	}
	
	public function getAnmerkung()
	{
		return $this->anmerkung;
	}
	
	public function getBenotung()
	{
		return $this->benotung;
	}
	
	public function getErscheinungsjahr()
	{
		return $this->erscheinungsjahr;
	}
	
	public function getAlbum()
	{
		return $this->album;
	}
	
	public function getKuenstler()
	{
		return $this->kuenstler;
	}
	
	public function getGenre()
	{
		return $this->genre;
	}
	
}
?>