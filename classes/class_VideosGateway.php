<?php 
class VideosGateway
{
	
	private static function loadListe($sql, $params = array())
	{
		$db = DB::getInstance();
		$viedos = $db->executePreparedStatement($sql, $params);
		$liste = array();
		foreach($viedos as $row)
		{
			$id = $row['v_id'];
			$titel = $row['titel'];
			$dateigroesse = $row['dateigroesse'];
			$qualitaet = $row['qualitaet'];
			$anmerkung = $row['anmerkung'];
			$benotung = $row['benotung'];
			$erscheinungsjahr = $row['erscheinungsjahr'];
			$album = $row['album'];
			$kuenstler = KuenstlerGateway::load($row);
			$genre = KategorieGateway::load($row);
			$liste[] = new Videos($id, $titel, $dateigroesse, $qualitaet, 
													 $anmerkung, $benotung, $erscheinungsjahr, 
													 $album, $kuenstler, $genre);
		}
		return $liste;
	}
	
	public static function load($row)
	{
		if(!is_null($row) && is_array($row))
		{
			$id = $row['v_id'];
			$titel = $row['titel'];
			$dateigroesse = $row['dateigroesse'];
			$qualitaet = $row['qualitaet'];
			$anmerkung = $row['anmerkung'];
			$benotung = $row['benotung'];
			$erscheinungsjahr = $row['erscheinungsjahr'];
			$album = $row['album'];
			$kuenstler = KuenstlerGateway::load($row);
			$genre = KategorieGateway::load($row);
			$result = new Videos($id, $titel, $dateigroesse, $qualitaet, 
													 $anmerkung, $benotung, $erscheinungsjahr, 
													 $album, $kuenstler, $genre);
			return $result;
		}
		else
		{
			return null;
		}
	}
	
	public function size()
	{
		return DB::getInstance()->sizeOf("videos");
	}
	
	public function findAll($limit = 15, $start = 0)
	{
		$sql = "SELECT 
							v_id,
							titel,
							dateigroesse,
							qualitaet,
							anmerkung,
							benotung,
							erscheinungsjahr,
							album,
							a_id,
							a_name,
							k_id,
							k_name
					  FROM 
							videos
						INNER JOIN 
							kuenstler
							ON kuenstler.k_id = videos.fk_k_id
						INNER JOIN
							kategorien
							ON kategorien.a_id = videos.fk_a_id
						ORDER BY v_id
						LIMIT :start,:limit";
		$params = array( array(":start", $start, PDO::PARAM_INT),
		                 array(":limit", $limit, PDO::PARAM_INT));
		return self::loadListe($sql, $params);
	}
	
	public function findInTitel($limit = 15, $start = 0, $search, $howSearch = null)
	{
		if(empty($search))
		{
			return array();
		}
		
		if($howSearch === "checked")
		{	
			$searchStr = $search."%";
		}
		else
		{
			$searchStr = "%".$search."%";
		}
		$sql = "SELECT 
							v_id,
							titel,
							dateigroesse,
							qualitaet,
							anmerkung,
							benotung,
							erscheinungsjahr,
							album,
							a_id,
							a_name,
							k_id,
							k_name
					  FROM 
							videos
						INNER JOIN 
							kuenstler
							ON kuenstler.k_id = videos.fk_k_id
						INNER JOIN
							kategorien
							ON kategorien.a_id = videos.fk_a_id
						WHERE titel LIKE :search
						ORDER BY titel
						LIMIT :start,:limit";
		$params = array( array(":start", $start, PDO::PARAM_INT),
		                 array(":limit", $limit, PDO::PARAM_INT),
										 array(":search", $searchStr, PDO::PARAM_STR));
		return self::loadListe($sql, $params);
	}
	
	public function affectedRowsCount($search, $howSearch = null)
	{
		if(empty($search))
		{
			return array();
		}
		
		if($howSearch === "checked")
		{	
			$searchStr = $search."%";
		}
		else
		{
			$searchStr = "%".$search."%";
		}
		$sql = "SELECT 
							v_id,
							titel,
							dateigroesse,
							qualitaet,
							anmerkung,
							benotung,
							erscheinungsjahr,
							album,
							a_id,
							a_name,
							k_id,
							k_name
					  FROM 
							videos
						INNER JOIN 
							kuenstler
							ON kuenstler.k_id = videos.fk_k_id
						INNER JOIN
							kategorien
							ON kategorien.a_id = videos.fk_a_id
						WHERE titel LIKE :search";
		$params = array( array(":search", $searchStr, PDO::PARAM_STR));
		$db = DB::getInstance();
		$db->executePreparedStatement($sql, $params);
		return $db->affectedRowsCount();
	}
}
?>