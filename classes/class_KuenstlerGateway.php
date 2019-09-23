<?php 
class KuenstlerGateway
{
	const FINDALL_SQL = "SELECT * FROM kuenstler";
	public function findALL()
	{
		$db = DB::getInstance();
		$result = $db->executeQuery(self::FINDALL_SQL);
		$kuenstlerListe = array();
		foreach($result as $row)
		{
			$kuenstlerListe[] = self::load($row);
		}
		return $kuenstlerListe;
	}
	
	
	const FINDBYID_SQL = "SELECT * FROM kuenstler WHERE k_id=:id";
	public function findById($id)
	{
		$params = array(array(':id',$id, PDO::PARAM_INT));
		$db = DB::getInstance();
		$result = $db->executePreparedStatement(self::FINDBYID_SQL, $params);
		$kuenstler = null;
		if(count($result) > 0)
		{
			$kuenstler = self::load($result[0]);
		}
		return $kuenstler;
	}
	
	const FINDBYNAME_SQL = "SELECT * FROM kuenstler WHERE k_name = :name";
	public function findByName($name)
	{
		$params = array( array(':name',$name, PDO::PARAM_STR));
		$db = DB::getInstance();
		$result = executePreparedStatement(self::FINDBYNAME_SQL, $params);
		$kuenstler = null;
		if(count($kuenstler) > 0) 
		{
			$kuenstler = self::load($result[0]);
		}
		return $kuenstler;
	}
	
	
	const INSERT_SQL = "INSERT INTO kuenstler (k_id, k_name)
	                    VALUES (:id, :name)";
	public function insert($name)
	{
		$db = DB::getInstance();
		$id = $db->findNextId("k_id", "kuenstler");
		$params = array( array(':id', $id, PDO::PARAM_INT),
		                 array(':name', $name, PDO::PARAM_STR)
									 );
		$db->executePreparedStatement(self::INSERT_SQL, $params);
	}
	
	
	const UPDATE_SQL = "UPDATE kuenstler
	                    SET 
												k_name = :name
											WHERE 
												k_id = :id";
	public function update($id, $name)
	{
		$db = DB::getInstance();
		$params = array( array(':id', $id, PDO::PARAM_INT),
		                 array(':name', $name, PDO::PARAM_STR)
										);
		$db->executePreparedStatement(self::UPDATE_SQL, $params);
	}
	
	
	const DELET_SQL = "DELETE FROM kuenstler WHERE k_id = :id";
	public function delete($id)
	{
		$db = DB::getInstance();
		$params = array( array(':id', $id, PDO::PARAM_INT));
		
		$db->executePreparedStatement(self::DELET_SQL, $params);
	}
	
	
	public static function load($row)
	{
		if(!is_null($row) && is_array($row))
		{
			$id = $row['k_id'];
			$name = $row['k_name'];
			$result = new Kuenstler($id, $name);
			return $result;
		}
		else
		{
			return null;
		}
	}
	
	
	public function size()
	{
		return DB::getInstance()->sizeOf("kuenstler");
	}
	
	public function findRange($from = 0, $numberRows = 15)
	{
		$sql = "SELECT * FROM kuenstler LIMIT :from,:interval";
		if(is_numeric($from) && is_numeric($numberRows))
		{
			$from = (integer)$from;
			$numberRows = (integer)$numberRows;
		}
		else
		{
			return array();
		}
		$params = array( array(":from", $from, PDO::PARAM_INT),
		                 array(":interval", $numberRows, PDO::PARAM_INT)
										);
		$db = DB::getInstance();
		$kuenstler = $db->executePreparedStatement($sql,$params);
		$liste = array();
		foreach($kuenstler as $row)
		{
			$liste[] = self::load($row);
		}
		return $liste;
	}
	
	private function kuenstlerObj($kuenstler)
	{
		$liste = array();
		foreach($kuenstler as $row)
		{
			$liste[] = self::load($row);
		}
		return $liste;
	}
	
	public function findBuchstabeOrderById($buchstabe, $from = 0, $interval = 15)
	{
		$sql=  "SELECT * FROM kuenstler 
						WHERE k_name LIKE 
							:suche
						ORDER BY
							k_id
						LIMIT
							:start,:interval";
		$buchstabe = $buchstabe."%";
		$params = array( array (":suche", $buchstabe, PDO::PARAM_STR),
		                 array (":start", $from, PDO::PARAM_INT),
										 array (":interval", $interval, PDO::PARAM_INT)
										);
		$db = DB::getInstance();
		$kuenstler = $db->executePreparedStatement($sql, $params);
		return $this->kuenstlerObj($kuenstler);
	}
	
	public function findBuchstabeOrderByName($buchstabe, $from = 0, $interval = 15)
	{
		$sql = "SELECT k_name, k_id FROM kuenstler
		        WHERE k_name LIKE
							:suche
						ORDER BY
							k_name
						LIMIT
							:start,:interval";
		$buchstabe = $buchstabe."%";
		$params = array( array(":suche", $buchstabe, PDO::PARAM_STR),
		                 array(":start", $from, PDO::PARAM_INT),
										 array(":interval", $interval, PDO::PARAM_INT)
										);
		$db = DB::getInstance();
		$kuenstler = $db->executePreparedStatement($sql, $params);
		return $this->kuenstlerObj($kuenstler);
	}
	
	public function findAllOrderByName($from = 0, $interval = 15)
	{
		$sql = "SELECT k_name, k_id FROM kuenstler
		        ORDER BY
							k_name
						LIMIT
							:start,:interval";
		$params = array( array(":start", $from, PDO::PARAM_INT),
										 array(":interval", $interval, PDO::PARAM_INT)
										);
		$db = DB::getInstance();
		$kuenstler = $db->executePreparedStatement($sql, $params);
		return $this->kuenstlerObj($kuenstler);
	}
	
	public function findAllOrderById($from = 0, $interval = 15)
	{
		$sql = "SELECT k_name, k_id FROM kuenstler
		        ORDER BY
							k_id
						LIMIT
							:start,:interval";
		$params = array( array(":start", $from, PDO::PARAM_INT),
										 array(":interval", $interval, PDO::PARAM_INT)
										);
		$db = DB::getInstance();
		$kuenstler = $db->executePreparedStatement($sql, $params);
		return $this->kuenstlerObj($kuenstler);
	}

}

?>