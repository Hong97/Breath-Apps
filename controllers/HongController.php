<?php
namespace app\controllers;

use app\base\Controller;
use app\models\Hong;

class HongController extends Controller
{
	public function actionIndex()
	{
		$model = new Hong;
		$forget = $model->forget('william@kd.com');
		return $this->render('index' , [
			'forget' =>  $forget
		]);
		
		
	}

	

}



?>