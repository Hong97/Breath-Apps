<?php
namespace app\controllers;

use app\base\Controller;
use app\models\EventDetail;

class EventDetailController extends Controller
{
	public function actionIndex()
	{
		$model = new EventDetail;
		$testings = $model->dailyStressLevel(1,'2019-03-05');
		//$testings = $model->todayUserActivities(1,'2019-03-05');
		return $this->render('index',[
			'testings' => $testings
		]);
	}

	public function actionLogin()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$model = new Example;
			$lastId = $model->insert(['name' => $_POST['name']]);
			$user = $model->getOne($lastId);
			header('Content-Type: application/json');
			echo json_encode($user);
		}
	}
	

}



?>