<?php
namespace app\controllers;

use app\base\Controller;
use app\models\Users;
use app\models\Login;
use app\models\EventDetail;


class UsersController extends Controller
{
	public function actionIndex()
	{
		if(!empty($_SESSION["userID"]))
		{	
			return $this->render('dashboard');
		}
		return $this->renderOneColumn('login');
		
	}

	public function actionLogin()
	{
	
		$model = new Login;
		$logouts = $model->logout();
		return $this->renderOneColumn('login');
		
	}


	public function actionConfrimForm()
	{
		
		$model = new Login;
		if(isset($_GET['id']))
		{
			$result = $model->activation();
			return $this->renderOneColumn('confirmationForm');
		}
	
	}


	public function actionDashboard()
	{

		if(isset($_SESSION["userID"]))
		{	
			$stressLevel  = new EventDetail;

			$dailyMark = $stressLevel->todayAllActivities("2019-04-11",$_SESSION['userID']);
			//$dailyMarkss = $stressLevel->todayUserActivities($_SESSION['userID'],"2019-04-11");
			$dailyLevel = $stressLevel->dailyStressLevel($_SESSION['userID'],date("Y-m-d"));
			$happyLevel = $stressLevel->happienessLevel($_SESSION['userID'],date("Y-m-d"));
			$confirmlists = $stressLevel->todayUserConfirmActivities($_SESSION['userID'],date("Y-m-d"));
			$newActivity = $stressLevel->todayUserActivitiesCount($_SESSION['userID'],date("Y-m-d"));
			$monthlyStressGrapth = $stressLevel->monthlyStressGrapth($_SESSION['userID'],date("Y-m-d"));
			$montlyLevel = $stressLevel->monthlyStressLevel($_SESSION['userID'],date("Y-m-d"));
			$taskAmount = count($confirmlists[0]);
			$appointmentAmount = count($confirmlists[1]);
			$eventAmount = count($confirmlists[2]);
			$activitiesAmount = count($confirmlists[3]);
			//echo "Welcome".$_SESSION["userID"]." has login. ";	
			return $this->render('dashboard',[
				'dailyLevel' => $dailyLevel,
				'montlyLevel' => $montlyLevel,
				'taskAmount' => $taskAmount,
				'appointmentAmount' => $appointmentAmount,
				'eventAmount' => $eventAmount,
				'activitiesAmount' => $activitiesAmount,
				'happyLevel' => $happyLevel,
				'newActivity' => $newActivity,
				'monthlyStressGrapth' => $monthlyStressGrapth
			]);
		}
		return $this->actionIndex();
	}
	
	
	public function actionMemberLogin()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$model = new Login;
			$users = $model->checkingUser($_POST['email'],$_POST['password']);
			header('Content-Type: application/json');
			echo json_encode($users);			
		}
		
	}

	public function actionRegisterForm()
	{
		if(isset($_GET['userID']))
		{
			$model = new Login;
			$users = $model->userDetail($_GET['userID']);
			return $this->render('../_layouts/form',[
				'users' => $users
			]);	
		}
		return $this->renderOneColumn('form');
	}

	public function actionRegister()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$model = new Login;
			$users = $model->register([
				'name' => $_POST['name'],
				'email' => $_POST['email'] ,
				'password' => $_POST['password'],
				'phone' => $_POST['phone'],
				'gender' => $_POST['gender'],
				'status' => '0',
				'create_date' => date("Y-m-d H:i:s"),
			]);
			header('Content-Type: application/json');
			echo json_encode($users);			
		}
	}

	public function actionResetPasswordForm()
	{
		
		return $this->renderOneColumn('resetPasswordForm');
	}

	public function actionResetPassword()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$model = new Login;
			$users = $model->sendEmail($_POST['email']);
			header('Content-Type: application/json');
			echo json_encode($users);			
		}
		
	}

	public function actionUpdateProfile()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			$model = new Login;
			$users = $model->updateProfile($_SESSION['userID'],[
				'password'=> $_POST['password'],
				'phone'=> $_POST['phone'],
			]);
			header('Content-Type: application/json');
			echo json_encode($users);		

		}
		
	}
	public function actionProfile()
		{
			if(isset($_GET['userID']))
			{
				$model = new Login;
				$users = $model->userDetail($_GET['userID']);
				return $this->render('profile',[
					'users' => $users
				]);	
			}
			return $this->renderOneColumn('profile');
		}

	public function actionCountNotification()
		{
			if($_SERVER['REQUEST_METHOD'] == 'POST')
			{
				$lists  = new EventDetail;
				$newActivity = $lists->todayUserActivitiesCount($_SESSION['userID'],date("Y-m-d"));
				header('Content-Type: application/json');
				echo json_encode($newActivity);			
			}
			
		}
		

	}



?>