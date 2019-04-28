<?php
namespace app\models;

use app\base\Model;

class EventDetail extends Model
{

	/*public $taskWeight = 0;
	public $appointmentWeight = 0.25;
	public $eventWeight = 0.25;
	public $activitieWeight = 0.25;*/
	//public $weight = array($this->taskWeight ,$this->appointmentWeight,$this->eventWeight,$this->activitieWeight);*/ 


	public $weight = [0.25,0.25,0.25,0.25];	// task,appointment,event,activities

	public function __construct()
	{
		parent::__construct();
		
		$this->tableName = 'events_details';
	}

	

	public function extrKendoDate($kendoDate)
	{
		$pieces = explode("~", $kendoDate);
		return $pieces[0];
	}


	public function userFeelingPoint($eventID,$userID)
	{
		$result = $this->getOneBy([
			'eventID' => $eventID,
			'memberID' => $userID
		]);
		return $result;
	}

	public function updateUserFeelingPoint($eventID,$userID,$feeling_point)
	{
		$result = $this->flexi2Update('eventID',$eventID,'memberID',$userID,['feeling_point' => $feeling_point]);
		return $result;
	}

	public function todaySelectedEvent($eventID,$memberID,$date)
	{
		// find user activities by date
		$lists = [];
		$this->tableName = 'events';
		$todayLists = $this->getOneByTodayDateAndEventID($date,$eventID);


		// find activites details
		$this->tableName = 'events_details';
		foreach ($todayLists as $key => $todayList)
		{

			$userActivites = $this->getOneBy([
				'memberID' => $memberID,
				'member_confirm' => 1,
				'eventID' => $eventID
			]);

			if($userActivites)
			{
				$list = [];

				foreach ($userActivites as $userActivite) 
				{
					// merger user and activietie detail	
					$list = array_merge($userActivite,$todayList);	
		
				}
				$lists[] = $list;
			}

		}

		return $lists;
	}
	

	public function todayAllActivities($date,$userID = NULL)
	{	
		
		// find today all user activities
		$eventLists = [];
		$this->tableName = 'events';
		$eventList = $this->getAll();


		// group them to different type activities
		foreach ($eventList as $activities_type )
        {
            $model = $this->getOneByTodayDate($date,$activities_type['activities_type']);
            $eventLists[$activities_type['activities_type']] = $model;
        }
		return $eventLists;

		
	}
	
	public function todayUserActivities($userID,$date)
	{

		// find user activities by date
		$lists = [];
		$this->tableName = 'events';
		$todayLists = $this->getUserByTodayDate($date);

		// find activites details
		$this->tableName = 'events_details';
		foreach ($todayLists as $key => $todayList)
		{

			$userActivites = $this->getOneBy([
				'memberID' => $userID,
				'member_confirm' => 1,
				'eventID' => $todayList['eventID']
			]);

			$list = [];

			foreach ($userActivites as $userActivite) 
			{
				// merger user and activietie detail	
				$list = array_merge($userActivite,$todayList);	
	
			}
			$lists[] = $list;
			
			
		
		}
		return array_filter($lists);
		
	}

	public function todayAllConfirmActivities($userID = NULL,$date)
	{	
		$emptyArray = [];
		$lists = $this->todayUserActivities($userID,$date);
		
		foreach ($lists as $key => $list) 
		{
			array_push($emptyArray[$key], $list);
			/*if($list['activities_type'] == 0){
				array_push($emptyArray[0], $list);
			}
			elseif($list['activities_type'] == 1){
				array_push($emptyArray[$key], $list);
			}
			elseif($list['activities_type'] == 2){
				array_push($emptyArray[2], $list);
			}
			elseif($list['activities_type'] == 3){
				array_push($emptyArray[3], $list);
			}*/
			
			# code...
		}
		echo "<pre>";
		print_r($emptyArray);
		die;
	
	}


	public function todayGoingStatusUserActivities($userID,$date)
	{

		// find user activities by date
		$lists = [];
		$this->tableName = 'events';
		$todayLists = $this->getUserByTodayDate($date);

		// find activites details
		$this->tableName = 'events_details';
		foreach ($todayLists as $key => $todayList)
		{

			$userActivites = $this->getOneBy([
				'memberID' => $userID,
				'eventID' => $todayList['eventID']
			]);

			$list = [];

			foreach ($userActivites as $userActivite) 
			{
				// merger user and activietie detail	
				$list = array_merge($userActivite,$todayList);	
	
			}
			$lists[] = $list;
			
			
		
		}
		return array_filter($lists);
		
	}
	

	public function todayDifferentActivitiesMarkList($userID,$date)
	{

		// find user daily scored 
		$finalList = [];
		$score = 0;
		$models = $this->todayAllActivities($date);
		$this->tableName = 'events_details';
		foreach ($models as $key => $activities_type) 
		{
			foreach ($activities_type as $key2 => $activities)
			{

				$types = $this->getOneBy([
					'memberID'       => $userID,
					'eventID'        => $activities['eventID'],
					'member_confirm' => 1
				]);
				foreach ($types as $type) 
				{
					
					$score = ($score + (1-$type['feeling_point']));	
				}
				
			}
			
			if($score > 0){
				$finalList[] = $score/sizeof($activities_type);	
			}else{
				$finalList[] = 0;
			}
			
			$score = 0;
		}
		

		

		return $finalList;
	}

	public function dailyMarks($userID,$date)
	{
		// after get the daily score then * differect type activities weightage
		$dailyScore = 0;
		$models = $this->todayDifferentActivitiesMarkList($userID,$date);
		foreach ($models as $key => $model) 
		{

			$score = $model*$this->weight[$key];
			$dailyScore = $dailyScore + $score;

		}
		return $dailyScore;
	}

	public function dailyStressLevel($userID,$date)
	{
		// different stress level perfrom different output	
		$message = "";
		$level = $this->dailyMarks($userID,$date)*100;
		if($level >= 0 && $level <= 30){
			$message = "Keep Going";
		}
		elseif ($level >= 31 && $level <= 50){
			$message = "Fighting";
		}
		elseif ($level >= 51 && $level <= 70){
			$message = "Slowly your life";
		}
		elseif ($level >= 71){
			$message = "Rest for a day";
		}
		elseif($level < 0  || $level == NULL){
			$level = 0.00;
			$message = "Rest for a day";
		}
		return round($level,2);
	}


	public function monthlyStressLevel($userID,$startdate)
	{
		
		// calculate total montly stress level
		$monthlyStressScore = 0;
		$monthlyStressLevel = 0;
		// add 1 to every day
		$stringDate = date("Y",strtotime($startdate)).'-'.date("m",strtotime($startdate))."-01";
		$firstDate = $stringDate;	
		$date1 = str_replace('-', '/', $firstDate);
		$nextDay = date('Y-m-d',strtotime($date1 . "+1 days"));
		$currentMonth = date("m",strtotime($startdate));
		$currentYear = date("Y",strtotime($startdate));
		$numberOfDay = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear); 
		for ($i=0; $i< $numberOfDay ; $i++) 
		{ 

			$date1 = str_replace('-', '/', $firstDate);	
			$nextDay = date('Y-m-d',strtotime($date1 . "+$i days"));
			$nextDay." Stress Level: ".$this->dailyStressLevel($userID,$nextDay)."<br>";
			$monthlyStressLevel = $monthlyStressLevel + $this->dailyStressLevel($userID,$nextDay);
		}
		$monthlyStressScore = ($monthlyStressLevel / ($numberOfDay*100)) *100;
		return round($monthlyStressScore,2)."%";
	}


	public function updateEventDetail($eventID,$memberID,$data)
	{
		$result = 0;
		$statusGoing = $this->flexi2Update('eventID',$eventID,'memberID',$memberID,$data);
		if($statusGoing)
		{
			$results = 1;
			
		}
		return $result;
	}

	public function happienessLevel($userID,$date)
	{
		$level = 100 - $this->dailyStressLevel($userID,$date);
		$message = "";
		if($level >= 0 && $level <= 33){
			$message = "Stress";
		}
		elseif ($level >= 34 && $level <= 70){
			$message = "Moderate";
		}
		elseif ($level >= 71 && $level <= 100){
			$message = "Happy";
		}
		elseif($level < 0  || $level == NULL){
			$level = 0.00;
			$message = "Overstress";
		}
		return $message;

	}
	public function todayUserActivitiesCount($userID,$date)
	{
		$results = $this->todayUserActivities($userID,$date);
		return count($results) ? count($results) : '';	
	}

	public function todayUserPriorityList($userID,$date)
	{
		$priority_lists = [];
		$results = $this->todayUserActivities($userID,$date);
		foreach ($results as $key => $result) {
			if($result['priority'] == 1)
			{
				array_push($priority_lists,$result);
			}
		}
		$lists = [$priority_lists];
		return $lists;	
	}


	public function todayUserConfirmActivities($userID,$date)
	{
		
		$task_lists = [];
		$appoinment_lists = [];
		$event_lists = [];
		$activities_lists = [];
		$results = $this->todayUserActivities($userID,$date);
		foreach ($results as $key => $result) {
			if($result['activities_type'] == 0)
			{
				array_push($task_lists,$result);
			}
			if($result['activities_type'] == 1)
			{
				array_push($appoinment_lists,$result);
			}
			if($result['activities_type'] == 2)
			{
				array_push($event_lists,$result);
			}
			if($result['activities_type'] == 3)
			{
				array_push($activities_lists,$result);
			}
		}

		$lists = [$task_lists,$appoinment_lists,$event_lists,$activities_lists];
		return $lists;		
	}
	public function monthlyStressGrapth($userID,$startdate)
	{
		 
		 // calculate total montly stress level
		 $lists = [];
		 $monthlyStressScore = 0;
		 $monthlyStressLevel = 0;
		 // add 1 to every day
		 $stringDate = date("Y",strtotime($startdate)).'-'.date("m",strtotime($startdate))."-01";
		 $firstDate = $stringDate; 
		 $date1 = str_replace('-', '/', $firstDate);
		 $nextDay = date('Y-m-d',strtotime($date1 . "+1 days"));
		 $currentMonth = date("m",strtotime($startdate));
		 $currentYear = date("Y",strtotime($startdate));
		 $numberOfDay = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear); 
		 for ($i=0; $i< $numberOfDay ; $i++) 
		 { 

		  $date1 = str_replace('-', '/', $firstDate); 
		  $nextDay = date('Y-m-d',strtotime($date1 . "+$i days"));
		  $nextDay." Stress Level: ".$this->dailyStressLevel($userID,$nextDay)."<br>";
		  $level = $this->dailyMarks($userID,$nextDay)*100;
		  $list =[
		   'date' => $nextDay,
		   'level' => $level
		  ];
		  array_push($lists, $list);

		 }

		 return $lists;
	}

}
?>