<div class="bts-popup" role="alert">
    <div class="bts-popup-container">
    	<p class="popupTitle"><strong>Daily Status : </strong></p>
      	<p id="change-value"></p>
        <a href="#0" class="bts-popup-close img-replace"></a>
    </div>
</div>

<div id="wrapper">
	<div class="main-content dashboard">
		<!-- /.row -->
		<div class="row small-spacing">
			<div class="col-lg-3 col-md-6 col-xs-12">
				<div class="box-content bg-success text-white">
					<div class="statistics-box with-icon">
						<i class="ico small fa fa-diamond"></i>
						<p class="text text-white">TASK</p>
						<h2 class="counter"><?= $taskAmount?></h2>
					</div>
				</div>
				<!-- /.box-content -->
			</div>
			<!-- /.col-lg-3 col-md-6 col-xs-12 -->
			<div class="col-lg-3 col-md-6 col-xs-12">
				<div class="box-content bg-info text-white">
					<div class="statistics-box with-icon">
						<i class="ico small fa fa-download"></i>
						<p class="text text-white">APPOINTMENT</p>
						<h2 class="counter"><?= $appointmentAmount?></h2>
					</div>
				</div>
				<!-- /.box-content -->
			</div>
			<!-- /.col-lg-3 col-md-6 col-xs-12 -->
			<div class="col-lg-3 col-md-6 col-xs-12">
				<div class="box-content bg-danger text-white">
					<div class="statistics-box with-icon">
						<i class="ico small fa fa-bug"></i>
						<p class="text text-white">EVENT</p>
						<h2 class="counter"><?= $eventAmount?></h2>
					</div>
				</div>
				<!-- /.box-content -->
			</div>
			<!-- /.col-lg-3 col-md-6 col-xs-12 -->
			<div class="col-lg-3 col-md-6 col-xs-12">
				<div class="box-content bg-warning text-white">
					<div class="statistics-box with-icon">
						<i class="ico small fa fa-usd"></i>
						<p class="text text-white">ACTIVITIES</p>
						<h2 class="counter"><?= $activitiesAmount?></h2>
					</div>
				</div>
				<!-- /.box-content -->
			</div>
			<!-- /.col-lg-3 col-md-6 col-xs-12 -->
		</div>
		<!-- .row -->

		<div class="row small-spacing">
			<div class="col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Activity</h4>
					<!-- /.box-title -->

					<!-- /.dropdown js__dropdown -->
					<canvas id="line-chart" width="800" height="450" style="height:250px!important"></canvas>
					<!-- /#flot-chart-1.flot-chart -->
				</div>
				<!-- /.box-content -->
			</div>
			<!-- /.col-xs-12 -->

			<div class="col-lg-4 col-xs-12">
				<div class="box-content">
					<h4 class="box-title text-info">Daily Stress Level</h4>
					<!-- /.box-title -->

					<!-- /.dropdown js__dropdown -->
					<div class="content widget-stat">
						<div id="traffic-sparkline-chart-1" class="left-content margin-top-15"></div>
						<!-- /#traffic-sparkline-chart-1 -->
						<div class="right-content">
							<h2 class="counter text-info"><?= $dailyLevel?></h2>
							<!-- /.counter -->
							<p class="text text-info">Street Level</p>
							<!-- /.text -->
						</div>
						<!-- .right-content -->
					</div>
					<!-- /.content widget-stat -->
				</div>
				<!-- /.box-content -->
			</div>
			<!-- /.col-lg-4 col-xs-12 -->

			<div class="col-lg-4 col-xs-12">
				<div class="box-content">
					<h4 class="box-title text-success">Montly Stress Level</h4>
					<!-- /.box-title -->

					<!-- /.dropdown js__dropdown -->
					<div class="content widget-stat">
						<div id="traffic-sparkline-chart-2" class="left-content margin-top-10"></div>
						<!-- /#traffic-sparkline-chart-2 -->
						<div class="right-content">
							<h2 class="counter text-success"><?= $montlyLevel?></h2>
							<!-- /.counter -->
							<p class="text text-success">Street Level</p>
							<!-- /.text -->
						</div>
						<!-- .right-content -->
					</div>
					<!-- /.content widget-stat -->
				</div>
				<!-- /.box-content -->
			</div>
			<!-- /.col-lg-4 col-xs-12 -->

			<div class="col-lg-4 col-xs-12">
				<div class="box-content">
					<h4 class="box-title text-danger">Happies Level</h4>
					<!-- /.box-title -->

					<!-- /.dropdown js__dropdown -->
					<div class="content widget-stat">
						<div id="traffic-sparkline-chart-3" class="left-content"></div>
						<!-- /#traffic-sparkline-chart-3 -->
						<div class="right-content">
							<h2 class="counter text-danger" id="feeling-level"><?= $happyLevel?></h2>
							<!-- /.counter -->
							<p class="text text-danger">Happies Level</p>
							<!-- /.text -->
						</div>
						<!-- .right-content -->
					</div>
					<!-- /.content widget-stat -->
				</div>
				<!-- /.box-content -->
			</div>
			<!-- /.col-lg-4 col-xs-12 -->
		</div>

<form method="post" id="todayDate "style="display: none">
	<?php
	foreach ($monthlyStressGrapth as $key => $details) {
		echo "<input type='text' class='dates' name='date[".$key."]' value=".$details['date'].">";
	}
	?>
</form>
<form method="post" id="todayDateLevel "style="display: none">
	<?php
	foreach ($monthlyStressGrapth as $key => $details) {
		echo "<input type='text' class='level' name='level[".$key."]' value=".$details['level'].">";
	}
	?>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script type="text/javascript">
	var element = document.getElementById('feeling-level').innerHTML;
	var dates = document.querySelectorAll(".dates");
	var level = document.querySelectorAll(".level");
	var today = new Date();

	var dateArray = [];
	var levelArray = [];
	var count = 0;
	for (var i =0; i < dates.length; i++) {
		var systemDate = new Date([dates[i].value]);
		if(systemDate <= today)
		{
			dateArray.push([dates[i].value]);
			count++;
		}
		
	}

	for (var i =0; i <= count; i++) {
		levelArray.push(parseFloat([level[i].value]));
	}
	
	
new Chart(document.getElementById("line-chart"), {
  type: 'line',
  data: {
    labels: dateArray,
    datasets: [{ 
        data: levelArray,
        label: "Stress Level",
        borderColor: "#3e95cd",
        fill: false,
      }
    ]
  },
  options: {
    title: {
      display: true,
      text: 'Daily Stress Level Graph'
    }
  }
});




jQuery(document).ready(function($){
  
  window.onload = function (){
  	$(".bts-popup").delay(1000).addClass('is-visible');
		
		//open popup
		$('.bts-popup-trigger').on('click', function(event){
			event.preventDefault();
			$('.bts-popup').addClass('is-visible');
		});
		
		//close popup
		$('.bts-popup').on('click', function(event){
			if( $(event.target).is('.bts-popup-close') || $(event.target).is('.bts-popup') ) {
				event.preventDefault();
				$(this).removeClass('is-visible');
			}
		});

  		if (element === "Happy"){
			document.getElementById("change-value").innerHTML = '<i class="fa fa-smile-o" style="font-size:160px; margin-bottom:20px;"></i><br> Your current status is HAPPY!!! Well management of your time, Keep it up !!! '; 
		}
		else if (element === "Moderate"){
			document.getElementById("change-value").innerHTML = '<i class="fa fa-meh-o" style="font-size:160px; margin-bottom:20px;"></i><br> Your current status is Moderate, still can handle it. Get some exercise and coffee';
		}
		else if (element === "Stress"){
			document.getElementById("change-value").innerHTML = '<i class="fa fa-frown-o" style="font-size:160px; margin-bottom:20px;"></i><br> Your current status is Stress. Try take more rest and not to take up so much tasks in a day, only take the amount you able to handle.';
		}
		else{
			document.getElementById("change-value").innerHTML = 'Overstress!!! ';
		}
	}
});
</script>