<?php
namespace app\models;
use app\base\Model;

use app\models\EventDetail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class Login extends Model
{

	public function __construct()
	{
		parent::__construct();
		$this->tableName = 'user';
	}

	public function userDetail($userID)
	{

		$users = $this->getOneBy([
			'id' => $userID
		]);

		return $users;
	}


	public function checkingUserStatus($email){
		$result = 'User has not activated';
		$check =  $this->getOneBy([
			'email' => $email,
		]);
		if( $check[0]['status'])
		{
			$result = 1;
		}

		return $result;
	}
	public function checkingUserEmail($email){
		$result = "User email not exist";
		$check =  $this->getOneBy([
			'email' => $email,
		]);

		if($check){
			$result = 1;
		}

		return $result;
	}
	public function register($data)
	{
		$result = 0;
		$emailValidate = $this->checkingUserEmail($data['email']);
		if($emailValidate == 1){
			$result = "User email exits";
		}else{
			$data['password'] = md5($data['password']);
			$this->insert($data);
			$this->activationEmail($data['email']);
			$result = 1;	
		}
		
		return $result;
	}

	public function checkingUser($email,$password)
	{
		

		$result = "User password wrong";
		$emailValidate = $this->checkingUserEmail($email);
		if($emailValidate == 1)
		{
			$statusValidate = $this->checkingUserStatus($email);	
			if($statusValidate == 1)
			{
				$generatedPass = md5($password);
				$check =  $this->getOneBy([
					'email' => $email,
					'password' => $generatedPass,
					'status' => 1,
				]);

				if($check){
						foreach ($check as $user) {
							$_SESSION["userID"] = $user['id'];
							$list = new EventDetail;
							$newActivity = $list->todayUserActivitiesCount($_SESSION['userID'],date("Y-m-d"));
							$_SESSION["confrimActivities"] = $newActivity;
							$_SESSION["userName"] = $user['name'];
							$_SESSION["userEmail"] = $user['email'];
							//$result = $_SESSION["userName"].' has sucessful login';
							$result = 1;
						}
					$_SESSION["loggedin"] = true;

				}
			}else{
				$result = $statusValidate;
			}
			
		}else{
			$result = $emailValidate;
		}
		return $result;
	}
	
	public function randomPassword() {
		$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
		$n = rand(0, $alphaLength);
		$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}

	public function sendEmail($email)
	{
		$result = 0;
		$randomPass = $this -> randomPassword();
		$mail = new PHPMailer;
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->CharSet="UTF-8";
		$mail->Host = "smtp.gmail.com";
		$mail->SMTPDebug = 0;
		$mail->Port = 587 ; //465 or 587
		$mail->SMTPSecure = 'tls';
		$mail->SMTPAuth = true;
		$mail->IsHTML(true);
		$mail->Username = "xihong6912@gmail.com"; // GMAIL username
		$mail->Password = "hong691012"; // GMAIL password
		$mail->SMTPOptions = array(
		'ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => true
		)
		);
		
		//Typical mail data
		$mail->AddAddress($email);
		$mail->SetFrom("xihong6912@gmail.com");
		$mail->Subject = "Reset Password";
		$mail->Body ="Your password is: " .$randomPass;

		if($this->updatePass($email,$randomPass)){
			$mail->Send();
			$result = 1;
		}
		
		return $result;
	}

	public function updatePass($email,$password){
		$result=0;
		$check =  $this->getOneBy([
			'email' => $email
		]);
		  
		if ($check){
			foreach ($check as $user) {
				$this->update( $user['id'],[
					'password' => md5($password)
				]);
			}
			$result = 1;
		}

		return $result;
	}

	public function logout(){
		$result = 0;
		if(session_destroy()){
			$result = 1;
		}
		return $result;
	}

	public function activationEmail($email){
		$result = 0;

		$check =  $this->getOneBy([
			'email' => $email
		]);

		if($check){
				foreach ($check as $user) {
		$id = $user['id'];
				
		$mail = new PHPMailer;
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->CharSet="UTF-8";
		$mail->Host = "smtp.gmail.com";
		$mail->SMTPDebug = 0;
		$mail->Port = 587 ; //465 or 587
		$mail->SMTPSecure = 'tls';
		$mail->SMTPAuth = true;
		$mail->IsHTML(true);
		$mail->Username = "xihong6912@gmail.com"; // GMAIL username
		$mail->Password = "hong691012"; // GMAIL password
		$mail->SMTPOptions = array(
			'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
			)
		);
		

		//Typical mail data
		$mail->AddAddress($email);
		$mail->SetFrom("xihong6912@gmail.com");
		$mail->Subject = "Activation Account";
		$mail->Body = "Thanks for signing up!
					Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
					Please click this link to activate your account:
					http://localhost/breath-apps/users/confrim-form/?id=$id" ;
		

					if(!$mail->Send()) {
					echo "Mailer Error: " . $mail->ErrorInfo;
					} else {
						$result = 1;
					//echo "Message has been sent";
				}
			}
		}

		return $result ;
	}


	public function activation(){
		 $result = 0;
		if(isset($_GET['id'])){
			 $check =  $this->getOneBy([
			 	'id' => $_GET['id']
			 ]);

			 if ($check){ 	
			 	foreach ($check as $user) {
					$this->update($user['id'],[
			 			'status' => 1
			 		]);
			 	}
			 	$result = 1;
			 }
		}
		return $result;
	}

	public function updateProfile($userID,$data)
	{
		$result = 0;
		$data['password'] = md5($data['password']);
		$update = $this->flexiUpdate('id',$userID,$data);
		if($update)
		{
			$result = 1;
		}
		return $result;
	}
	


}
?>