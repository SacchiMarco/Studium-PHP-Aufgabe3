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
			$kuenstler = KuenstlerGateway::load($row);
			$genre = KategorieGateway::load($row);
			$liste[] = new Videos($id, $titel, $dateigroesse, $kuenstler, $genre);
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
			$kuenstler = KuenstlerGateway::load($row);
			$genre = KategorieGateway::load($row);
			$result = new Videos($id, $titel, $dateigroesse, $kuenstler, $genre);
			return $result;
		}
		else
		{
			return null;
		}
	}
}
?>