<?php
namespace app\base;

class Model
{
	public $conn;

	public $host = 'localhost';
	public $user = 'root';
	public $pass = '';
	public $name = 'breath_apps';
	public $tableName = "";

	public function __construct()
	{ 
		
		try {
			$this->conn = new \PDO(
				"mysql:host=" . $this->host . ";dbname=" . $this->name . "", 
				$this->user, 
				$this->pass
			);
			$this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}
	}


	public function getAll()
	{
		try {

			$sql = "SELECT * FROM $this->tableName";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			$rows = [];
			while ($row = $stmt->fetch(\PDO::FETCH_ASSOC))
			{

				$rows[] = $row;
			}
			return $rows;
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}
	}

	public function getOne($id)
	{
		try {

			$sql  = "SELECT * FROM user WHERE id = :id";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['id' => $id]);
			$rows = [];
			while ($row = $stmt->fetch(\PDO::FETCH_ASSOC))
			{
				$rows[] = $row;
			}
			return $rows;
			
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}
	}


	public function getOneBy($data)
	{
		try {
			$conn = $this->conn;
			$sql  = "SELECT * FROM $this->tableName WHERE 1";
			foreach ($data as $key => $value) {
				$sql.= " AND `$key` = :$key";
			}
			$stmt = $this->conn->prepare($sql);
			$stmt->execute($data);
			$rows = [];
			while ($row = $stmt->fetch(\PDO::FETCH_ASSOC))
			{
				$rows[] = $row;
			}
			return $rows;	
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}
	}	


	public function getOneByTodayDate($date,$type)
	{
		//SELECT * FROM `events` WHERE DATE_FORMAT(`activities_start_date`, '%Y-%m-%d') = '2019-03-17';
		try {
			$conn = $this->conn;
			$sql  = "SELECT * FROM events WHERE DATE_FORMAT(`activities_start_date`, '%Y-%m-%d') = '$date' AND `activities_type` = $type ";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['activities_start_date' => $date, 'activities_type' => $type]);
			$rows = [];
			while ($row = $stmt->fetch(\PDO::FETCH_ASSOC))
			{
				$rows[] = $row;
			}
			return $rows;	
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}
	}	

	public function getOneByTodayDateAndEventID($date,$eventID)
	{
		//SELECT * FROM `events` WHERE DATE_FORMAT(`activities_start_date`, '%Y-%m-%d') = '2019-03-17';
		try {
			$conn = $this->conn;
			$sql  = "SELECT * FROM events WHERE DATE_FORMAT(`activities_start_date`, '%Y-%m-%d') = '$date' AND `eventID` = $eventID ";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['activities_start_date' => $date, 'eventID' => $eventID]);
			$rows = [];
			while ($row = $stmt->fetch(\PDO::FETCH_ASSOC))
			{
				$rows[] = $row;
			}
			return $rows;	
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}
	}	


	public function getUserByTodayDate($date)
	{
		//SELECT * FROM `events` WHERE DATE_FORMAT(`activities_start_date`, '%Y-%m-%d') = '2019-03-17';
		try {
			$conn = $this->conn;
			$sql  = "SELECT * FROM events WHERE DATE_FORMAT(`activities_start_date`, '%Y-%m-%d') = '$date'";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute(['activities_start_date' => $date]);
			$rows = [];
			while ($row = $stmt->fetch(\PDO::FETCH_ASSOC))
			{
				$rows[] = $row;
			}
			return $rows;	
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}
	}	

	public function insert($data)
	{
		try {

			$sql  = "INSERT INTO $this->tableName (";
			foreach ($data as $key => $value) {
				$sql .= " `$key` ,";
			}
			$sql = rtrim($sql,',');
			$sql .= ") VALUES (";
			foreach ($data as $key => $value) {
				
				$sql .= " :$key ,";
			}

			$sql = rtrim($sql,',');
			$sql .= ")";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute($data);
			return $this->conn->lastInsertId();

		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}
	}	

	public function update($id,$data)
	{
		try {

			$sql = "UPDATE $this->tableName SET";
			foreach ($data as $key => $value) {
				$sql.= " $key = '$value',";
			}
			
			$sql = rtrim($sql,',');
			$sql .= " WHERE id=$id";
			$stmt = $this->conn->prepare($sql);
			$data = array_merge(['id' => $id], $data);
			return $stmt->execute($data);
			
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}
	}	

	public function flexiUpdate($IDcolumnName,$id,$data)
	{
		try {

			$sql = "UPDATE $this->tableName SET";
			foreach ($data as $key => $value) {
				$sql.= " $key = '$value',";
			}
			
			$sql = rtrim($sql,',');
			$sql .= " WHERE $IDcolumnName=$id";
			$stmt = $this->conn->prepare($sql);
			$data = array_merge([$IDcolumnName => $id], $data);
			return $stmt->execute($data);
			
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}
	}	

	public function flexi2Update($IDcolumnName,$id,$IDcolumnName2,$type,$data)
	{
		try {

			$sql = "UPDATE $this->tableName SET";
			foreach ($data as $key => $value) {
				$sql.= " $key = '$value',";
			}
			
			$sql = rtrim($sql,',');
			$sql .= " WHERE $IDcolumnName=$id AND $IDcolumnName2=$type";
			$stmt = $this->conn->prepare($sql);
			$data = array_merge([$IDcolumnName => $id], $data);
			return $stmt->execute($data);
			
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}
	}	

	public function delete($data)
	{
		try {

			$sql = "DELETE FROM  $this->tableName WHERE 1";
			foreach ($data as $key => $value) {
				$sql.= " AND `$key` = :$key";
			}
			
			$sql = rtrim($sql,',');
			$stmt = $this->conn->prepare($sql);
			return $stmt->execute($data);
			
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}
	}	

	public function deletebyID($id)
	{
		try {

			$sql = "DELETE FROM $this->tableName WHERE id = :id";
			$stmt = $this->conn->prepare($sql);
			return $stmt->execute(['id' => $id]);
			
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}
	}	

	
}