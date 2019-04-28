<?php
namespace app\controllers;

use app\base\Controller;
use app\models\Groups;
use app\models\Users;

class GroupsController extends Controller
{
	public function actionIndex()
	{

		$model = new Groups;
		/*$emailList = 'z@l.com,h@l.com';
		$test= $model->updateGroup(8,['title' => 'zeon3333221SSszeon'],$emailList);
		echo "<pre>";
		print_r($test);die;*/
		$datas = $model->groupList();
		if(isset($_GET['gID']))
		{
			$datas = $model->deleteGroup($_GET['gID']);
			return $this->render('index',['datas' => $datas]);
		}


		return $this->render('index',['datas' => $datas]);
	}

	public function actionForm()
	{
		$model = new Groups;

		if(isset($_GET['gID'])){

			$datas = $model->groupList($_GET['gID']);
			return $this->render('form',['datas' => $datas]);
		}
		
		
		return $this->render('form');
	}

	public function actionCheckMember()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			
			$model = new Users;
			$users = $model->findMemberEmailExist($_POST['email']);
			header('Content-Type: application/json');
			echo json_encode($users);			
		}
	}
	public function actionCreateGroup()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			
			$model = new Groups;
			$data = $model->createGroup(
			[
				'title' => $_POST['title'],
				'userID' => $_SESSION['userID'],
				'create_date' => date("Y-m-d H:i:s"),
			],$_POST['members']);
			header('Content-Type: application/json');
			echo json_encode($data);	
		}
		
	}


	public function actionCreateForm()
	{
		return $this->render('form');

	}

	public function actionUpdateGroup()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			
			$model = new Groups;
			$data = $model->updateGroup(
			$_POST['groupID'],
			[
				'title' => $_POST['title']
			],$_POST['members']);
			header('Content-Type: application/json');
			echo json_encode($data);	
		}
		
	}

	
}



?>