<?php
namespace app\models;

use app\base\Model;


class Users extends Model
{

	public function __construct()
	{
		parent::__construct();

		$this->tableName = 'user';
	
	}

	public function findMemberID($email)
	{
		$result = 0;
		$users = $this->getOneBy([
			'email' => $email
		]);

		if ($users)
		{
			foreach ($users as $user) {
				$result = $user['id'];
			}
		}
		
		return $result;
	}


	public function findEmail($id)
	{
		$result = 0;
		$users = $this->getOneBy([
			'id' => $id
		]);

		if ($users)
		{
			foreach ($users as $user) {
				$result = $user['email'];
			}
		}
		
		return $result;
	}


	public function findMemberEmailExist($email)
	{
		
		$result = 0;
		if($_SESSION["userEmail"] == $email){
			$result = 2;
		}else{
			$userID = $this->getOneBy([
				'email' => $email,
				'status' => 1,
			]);
			if($userID)
			{
				$result = $email;
			}
		}
		
		return $result;
	}

	public function splitEmail($emailList)
	{
		$result = 0;
		$pieces = explode(",", $emailList);
		if($pieces)
		{
			$result = $pieces;
		}else{
			$result = [$pieces[0]];
		}
		return $result;
	}

	public function testing($id)
	{
		return $this->delete($id);
	}
	
	public function forgotPassword($email,$password)
	{
		$result = 0;
		$users =  $this->getOneBy([
			'email' => $email
		]);

		if( $users )
		{
			foreach ($users as $user ) {
				$this->update( $user['id'],[
					'password' => $password,
					'name' => 'kaisen',
				]);
			}	
			
			$result = 1;
		}
		
		return $result;
	}
	public function register($data)
	{
		
		$result = 0;
		$status =  $this->getOneBy([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => md5($data['password']),
			'phone' => $data['phone']
		]);

		if( !$status )
		{
			$this->insert($data);
			$result = 1;
		}
		
		return $result;
	}
	
}



?>