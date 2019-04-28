<a href="<?=URL_BASE?>/users/login">Logout</a><br>

<div class="fixed-navbar">
	<div class="pull-left">
		<button type="button" class="menu-mobile-button glyphicon glyphicon-menu-hamburger js__menu_mobile"></button>
		<h1 class="page-title">Profile</h1>
		<!-- /.page-title -->
	</div>
	<!-- /.pull-left -->
	<div class="pull-right">
		<a href="#" class="ico-item pulse"><span class="ico-item mdi mdi-bell notice-alarm js__toggle_open" data-target="#notification-popup"><span id="newActivity"><?= $_SESSION["confrimActivities"]?></span></span></a>
		<a href="#" class="ico-item mdi mdi-logout js__logout"></a>
	</div>
	<!-- /.pull-right -->
</div>
<!-- /.fixed-navbar -->
<script type="text/javascript">
$(document).ready(function () {
   
    setInterval(function(){
    	$.ajax({
			url: '<?=URL_BASE?>/users/count-notification',
			method: 'POST',
			success: function (json) 
			{
				$('#newActivity').html(json);
            }
		})
    }, 100);
  
});
</script>