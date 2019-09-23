<?php 
class DB{
	private static $db = null;
	private $connection;
	private $affectedRows;
	
	private function __construct($connectionString, $user, $password)
	{
		try{
			$this->connection = new PDO($connectionString, $user, $password);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e){
			$this->printExceptionTrace($e);
			exit();
		}
	}
	
	public static function getInstance(){
		if(is_null(self::$db)){
			$connectionString = "mysql:dbname=".DB_NAME.
			                    ";host=". HOST;
			self::$db = new DB($connectionString, USER, PASSWORD);
		}
		return self::$db;
	}
	
	private function __clone(){}
	
	public function executeQuery($sql)
	{
		try 
		{
			$statement = $this->connection->query($sql);
			if( $statement->rowCount() == 0) 
			{
				$result = array();
			}
			else
			{
				$result = $statement->fetchAll(PDO::FETCH_ASSOC);
			}
			$statement->closeCursor();
			return $result;
		}
		catch(PDOException $e)
		{
			$this->printExceptionTrace($e);
			die();
		}
		
	}
	
	public function executePreparedStatement($statement, $params = array())
	{
		$preparedStatement = $this->connection->prepare($statement);
		try
		{
			foreach ($params as $paramArray)
			{
				$preparedStatement->bindParam( $paramArray[0], $paramArray[1], 
				                               $paramArray[2]); // Platzhalter, Wert, Typ
			}
			$preparedStatement->execute();
			if ($preparedStatement->columnCount() == 0)
			{
				return array();
			}
			else
			{
				$this->affectedRows = $preparedStatement->rowCount();
				return $preparedStatement->fetchALL(PDO::FETCH_ASSOC);
			}
		}
		catch(PDOException $e)
		{
			$this->printExceptionTrace($e);
			die();
		}
	}
	
	public function findNextId($idColumnName, $tableName)
	{
		$sql = "SELECT MAX($idColumnName) FROM $tableName";
		try
		{
			$statement = $this->connection->query($sql);
			$row = $statement->fetch();
			$statement->closeCursor();
			return $row["MAX($idColumnName)"] + 1;
		}
		catch(PDOException $e)
		{
			$this->printExceptionTrace($e);
			die();
		}
	}
	
	public function sizeOf($tableName)
	{
		try
		{
			$sql = "SELECT COUNT(*) FROM $tableName";
			$statement = $this->connection->query($sql);
			$row = $statement->fetch();
			$statement->closeCursor();
			return $row["COUNT(*)"];
		}
		catch(PDOException $e)
		{
			$this->printExceptionTrace($e);
			die();
		}
	}
	
	public function affectedRowsCount()
	{
		return $this->affectedRows;
	}
	
	private function printExceptionTrace($exception){
		print '<div style="color:red;">'. $exception->getMessage() .'</div>';
		print '<div style="color:red; font-weight:bold">Errortrace:</div>';
		foreach($exception->getTrace() as $messageArray){
			$errorString = '<div style="color:red">'.
			               'Datei: <b>'. $messageArray["file"].'</b>'.
										 ' Zeile: <b>'. $messageArray["line"].'</b>'.
										 '  Funktion: <b>'. $messageArray["function"].'</b>'.
										 ' Klasse: <b>'. $messageArray["class"].'</b>'.
										 '</div>';
			print $errorString;
		}
	}
}


?>