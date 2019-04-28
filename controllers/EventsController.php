<?php
namespace app\controllers;

use app\base\Controller;
use app\models\Events;
use app\models\EventDetail;
use app\models\Groups;


class EventsController extends Controller
{
	public function actionIndex()
	{

		$model = new EventDetail;
		$lists = $model->todayGoingStatusUserActivities($_SESSION['userID'],date("Y-m-d"));
		$priorityList = $model->todayUserPriorityList($_SESSION['userID'],date("Y-m-d"));
		if(!empty($_GET['eventID']))
		{

			$status = $model->updateEventDetail($_GET['eventID'],$_GET['memberID'],[
				'priority' => $_GET['priority'],
				'member_confirm' => $_GET['member_confirm']
			]);	
			$lists = $model->todayGoingStatusUserActivities($_SESSION['userID'],date("Y-m-d"));
			return $this->render('index',[
				'lists' => $lists,
				'priorityList' => $priorityList
			]);

		}
		
		return $this->render('index',[
			'lists' => $lists,
			'priorityList' => $priorityList,

		]);

	}

	public function actionPriorityList()
	{

		$model = new EventDetail;
		$lists = $model->todayGoingStatusUserActivities($_SESSION['userID'],date("Y-m-d"));
		$priorityList = $model->todayUserPriorityList($_SESSION['userID'],date("Y-m-d"));
		if(!empty($_GET['eventID']))
		{

			$status = $model->updateEventDetail($_GET['eventID'],$_GET['memberID'],[
				'priority' => $_GET['priority'],
				'member_confirm' => $_GET['member_confirm']
			]);	
			$lists = $model->todayGoingStatusUserActivities($_SESSION['userID'],date("Y-m-d"));
			return $this->render('priority',[
				'lists' => $lists,
				'priorityList' => $priorityList
			]);

		}
		
		return $this->render('priority',[
			'lists' => $lists,
			'priorityList' => $priorityList,

		]);

	}

	public function actionEventForm()
	{
		$groups = new Groups;
		$nameLists =$groups->optiongroupList();
		if(isset($_GET['eventID']))
		{
			$model = new EventDetail;
			$eventID = $_GET['eventID'];
			$memeberID = $_GET['memberID'];
			$tdate = $model->extrKendoDate($_GET['tdate']);
			$lists = $model->todaySelectedEvent($eventID,$memeberID,$tdate);
			return $this->render('form',[
				'lists' => $lists,
				'nameLists' => $nameLists
			]);

		}
		
		return $this->render('form',['nameLists'=>$nameLists]);
	}

	public function actionCreateEvent()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			
			$model = new Events;
			$data = $model->createEvent(
			[
				'title' => $_POST['title'],
				'description' => $_POST['description'],
				'activities_type' => $_POST['types'],
				'activities_start_date' => $_POST['start'],
				'activities_end_date' => $_POST['end'],
				'remark' => $_POST['remark'],
				'organise_by' => $_SESSION['userID']
			],$_POST['groupsInput'],$_POST['feeling']);
			header('Content-Type: application/json');
			echo json_encode($data);	
		}
	}

	public function actionUpdateBasicEventDetail()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$model = new Events;
			$test = $model->updateGroup($_POST['eventID'],$_POST['memberID'],[
				'title' => $_POST['title'],
				'description' => $_POST['description'],
				'activities_start_date' => $_POST['start'],
				'activities_end_date' => $_POST['end'],
				'remark' => $_POST['remark'],
			],$_POST['feeling']/10);
			header('Content-Type: application/json');
			echo json_encode($data);		
		}
		
	}


	public function actionUpdateFeeling()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$model = new EventDetail;
			$test = $model->updateUserFeelingPoint($_POST['feeelingEventID'],$_SESSION['userID'],$_POST['feeling']/10);
			header('Content-Type: application/json');
			echo json_encode($data);		
		}
		
	}
	
	

}



?>