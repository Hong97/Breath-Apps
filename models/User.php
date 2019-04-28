<?php
namespace app\models;

use app\base\Model;

class User extends Model
{
	// public $t;

	// public function __construct()
	// {
	// 	parent::__construct();

	// 	$this->t = 'William';
	// }

	public function insert($data)
	{
		$conn = $this->conn;
		$stmt = $conn->prepare("
			INSERT INTO `user` SET
				name = :name
		");
		return $stmt->execute($data) ? $conn->lastInsertId() : false;
	}

	public function update($id, $data)
	{
		$conn = $this->conn;
		$stmt = $conn->prepare("
			UPDATE `user` SET
				name = :name
			WHERE id = :id
		");
		return $stmt->execute(array_merge(['id' => $id], $data)) ? $conn->lastInsertId() : false;
	}

	public function getOne($id)
	{
		$conn = $this->conn;
		$stmt = $conn->prepare("
			SELECT * 
			FROM `user` 
			WHERE id = :id
		");
		$stmt->execute(['id' => $id]);
		return $stmt->fetch();
	}

	public function getOneBy($data)
	{
		$conn = $this->conn;
		$sql = "
			SELECT * 
			FROM `user` 
			WHERE 1
		";
		foreach ($data as $key => $value) $sql .= "AND `$key` = :$key";
		$stmt = $conn->prepare($sql);
		$stmt->execute($data);
		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}

	public function getAll()
	{
		$conn = $this->conn;
		$sql = "
			SELECT * 
			FROM `user` 
		";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$rows = [];
		while ($row = $stmt->fetch(\PDO::FETCH_ASSOC))
		{
			$rows[] = $row;
		}
		return $rows;
	}

	public function getAllBy($data)
	{
		$conn = $this->conn;
		$sql = "
			SELECT * 
			FROM `user`
			WHERE 1 
		";
		foreach ($data as $key => $value) $sql .= "AND `$key` = :$key";
		$stmt = $conn->prepare($sql);
		$stmt->execute($data);
		$rows = [];
		while ($row = $stmt->fetchAll(\PDO::FETCH_ASSOC))
		{
			$rows[] = $row;
		}
		return $rows;
	}

	public function delete($id)
	{
		$conn = $this->conn;
		$stmt = $conn->prepare("
			DELETE FROM `user` 
			WHERE id = :id
		");
		$stmt->execute(['id' => $id]);
	}


	public $id;
	public $email;
	public $password;

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setPassword($password)
	{
		$this->password = $password;
	}

	public function getPassword()
	{
		return $this->password;
	}


	
}


?>