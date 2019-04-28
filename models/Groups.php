<?php
namespace app\models;

use app\base\Model;
use app\models\Users;

class Groups extends Model
{

	public function __construct()
	{
		parent::__construct();
		$this->tableName = 'groups';
	}

	public function groupList($groupID = NULL)
	{
		$model = new Users;
		if($groupID == NULL){
			$lists = $this->getOneBy(['userID' => $_SESSION['userID']]);
		}else{
			$groups = $this->getOneBy([ 'groupID' => $groupID]);
			$this->tableName = 'groups_details';
			$lists = [];
			$groups_details_lists = $this->getOneBy([ 'groupID' => $groupID]);

			foreach ($groups_details_lists as $groups_details_list) {
				$email = $model->findEmail($groups_details_list['memberID']);
				$groups_details_list['memberID'] = $email;
				
				$data = array_merge($groups[0],$groups_details_list);
				$list = $data;
				$lists[] = $list;
				$data = [];
			}

		}
		
		return $lists;
	}

	public function optiongroupList()
	{	

		$model = new Users;
		$data = [];
		$lists=[];
		$resultlists = $this->getOneBy(['userID' => $_SESSION['userID']]);	
		foreach ($resultlists as $key => $resultlist) 
		{
			$memberDetail = [];
			$this->tableName = 'groups_details';
			$groups_details_lists = $this->getOneBy([ 'groupID' => $resultlist['groupID']]);
			foreach ($groups_details_lists as $key2 =>$groups_details_list) 
			{
				$email = $model->findEmail($groups_details_list['memberID']);
				$extraField = ['email' => $email, 'title' => $resultlist['title'] ];
				$memberDetail = array_merge($groups_details_list,$extraField);
				$data[$resultlist['title']][$key2] = $memberDetail;
				
			}	
		}
		$lists = $data;
		return $lists;
	}


	public function deleteGroup($groupID)
	{

		$result = 0;
		$result = $this->delete([
			'groupID' => $groupID
		]);

		if($result)
		{
			$this->tableName = 'groups_details';
			$result = $this->delete([
				'groupID' => $groupID
			]);

			$this->tableName = 'groups';
			$result = $this->getOneBy(['userID' => $_SESSION['userID']]);
		}

		return $result;

	}



	public function createGroup($groupInfo,$emailList)
	{	

		$model = new Users;
		$result = 0;
		$lastID = $this->insert($groupInfo);
		if($lastID)
		{
			$groupDetils = $model->splitEmail($emailList);
			for ($i=0; $i <sizeof($groupDetils) ; $i++) 
			{ 

				$userID =$model->findMemberID($groupDetils[$i]);
				if($userID != 0)
				{
					$data1 = ['groupID' => $lastID];
					$data2 = ['memberID' => $userID];
					$data = array_merge($data1,$data2);	

					$this->tableName = 'groups_details';
					$this->insert($data);
					
					$data = [];
					$data2 = [];	
					
				}
				$results = 1;
			}	
		}
		return $result;
	}

	public function updateGroup($groupID,$groupInfo,$emailList)
	{
		$model = new Users;
		$result = 0;
		$groups = $this->flexiUpdate('groupID',$groupID,$groupInfo);
		if($groups)
		{
			$this->tableName = 'groups_details';
			$delete = $this->delete(['groupID' => $groupID]);


			$groupDetils = $model->splitEmail($emailList);
			for ($i=0; $i <sizeof($groupDetils) ; $i++) 
			{ 

				$userID =$model->findMemberID($groupDetils[$i]);
				if($userID != 0)
				{
					$data1 = ['groupID' => $groupID];
					$data2 = ['memberID' => $userID];
					$data = array_merge($data1,$data2);	

					$this->tableName = 'groups_details';
					$this->insert($data);
					
					$data = [];
					$data2 = [];	
					
				}
				$results = 1;
			}	
		}
		return $result;
	}

	
}



?>