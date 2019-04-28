<?php
namespace app\models;

use app\base\Model;

class Hong extends Model
{


	public function __construct()
	{
		parent::__construct();

		$this->tableName = 'user';
	}

	public function mailTo($email){
		$result = 0;
		$process = TRUE;
		if($process == TRUE)
		{
			$result = 1;
		}
		return $result;
	}

	public function forget($email){

		if($this->getOneBy(['email' => $email]))
		{
			//email eistt
			$this->mailTo($mail);
			return  1;

		}else{
			return 0;
		}
	}

	public function testing($email,$data)
	{

		$searchResult =  $this->getOneBy([
			'email' => $email 	
		]);

		if($searchResult){

			$result = 0;
			if($this->insert($data))
			{
				$result = 1;
			}
			return $result;

		}else{
			$searchResult = 0;
			return $searchResult;
		}

		
	}
	
	
	
}



?>