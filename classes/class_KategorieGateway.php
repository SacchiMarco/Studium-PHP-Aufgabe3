<?php 
class KategorieGateway
{
	private static function loadListe($sql, $params)
	{
		$db = DB::getInstance();
		$kategorieen = $db->executePreparedStatement($sql, $params);
		$liste = array();
		foreach($kategorieen as $kategorie)
		{
			$id = $kategorie['a_id'];
			$name = $kategorie['a_name'];
			$liste[] = new Kategorie($id, $name);
		}
		return $liste;
	}
	
	public static function load($row)
	{
		if(!is_null($row) && is_array($row))
		{
			$id = $row['a_id'];
			$name = $row['a_name'];
			$result = new Kategorie($id, $name);
			return $result;
		}
		else
		{
			return null;
		}
	}
	
	private function execute($sql, $params)
	{
		$db = DB::getInstance();
		$db->executePreparedStatement($sql, $params);
	}
	
	public function findAll()
	{
		$sql = "SELECT * FROM kategorien";
		$params = array();
		
		return $liste = self::loadListe($sql, $params);
	}
	
	public function fingById($id)
	{
		$sql = "SELECT * FROM kategorien WHERE a_id = :id";
		$params = array( array(":id", $id, PDO::PARAM_INT));
		return $liste = self::loadListe($sql, $params);
	}
	
	public function update($id, $name)
	{
		$sql = "UPDATE kategorien
		        SET
							a_name = :name
						WHERE
							a_id = :id";
		$params = array( array(":name", $name, PDO::PARAM_STR),
		                 array(":id", $id, PDO::PARAM_INT)
										);
		$this->execute($sql, $params);
	}
	
	public function delete($id)
	{
		$sql = "DELETE FROM
		        	kategorien
						WHERE
							a_id = :id";
		$params = array( array(":id", $id, PDO::PARAM_INT));
		$db = DB::getInstance();
		$db->executePreparedStatement($sql, $params);
	}
	
	public function insert($name)
	{
		$db = DB::getInstance();
		$nextId = $db->findNextId("a_id","kategorien");
		
		$sql = "INSERT INTO kategorien
							(a_id, a_name)
						VALUES
							(:id, :name)";
		$params = array( array(":id", $nextId, PDO::PARAM_INT),
		                 array(":name", $name, PDO::PARAM_STR)
										);
		$db->executePreparedStatement($sql, $params);
	}
}
?>