<form id="form" method="POST" class="frm-single">

	<div id="single-wrapper" >
	<!-- <form action="#" "> -->
		<div class="inside">
			<div class="title"><strong>Breath</strong>App</div>
			<!-- /.title -->
			<div class="frm-title">Login</div>
			<!-- /.frm-title -->
			<div class="frm-input"><input type="email" name="email" placeholder="Email" class="frm-inp required email"><i class="fa fa-user frm-ico"></i>
			<span class="error errorEmail"></span>
			</div>
			<!-- /.frm-input -->
			<div class="frm-input"><input type="password" name="password" placeholder="Password" class="frm-inp required password"><i class="fa fa-lock frm-ico"></i>
			<span class="error errorPassword"></span>
			</div>
			<!-- /.frm-input -->
			<div class="clearfix margin-bottom-20">
				<!-- /.pull-left -->
				<div class="pull-right"><a href="<?=URL_BASE?>/users/reset-password-form" class="a-link"><i class="fa fa-unlock-alt"></i>Forgot password?</a></div>
				<!-- /.pull-right -->
			</div>
			<!-- /.clearfix -->
			<button type="submit" class="frm-submit">Login<i class="fa fa-arrow-circle-right"></i></button>
			<!-- /.row -->
			<span id="message"></span>
			<a href="<?=URL_BASE?>/users/register-form" class="a-link"><i class="fa fa-key"></i>New to BreathApp? Register.</a>
			<!-- /.footer -->
		</div>
		<!-- .inside -->
<!-- 	</form> -->
	<!-- /.frm-single -->
</div><!--/#single-wrapper -->

	<!-- <div>
		<label>Email</label>
		<input type="email" name="email" class="required email"/>
		<span class="error errorEmail"></span>
	</div>
	<div>
		<label>Password</label>
		<input type="password" name="password" class="required password"/>
		<span class="error errorPassword"></span>
	</div>
	<button type="submit">Login</button>
	<span id="message"></span>
	<a href="<?=URL_BASE?>/users/reset-password-form">Forget Password</a>
	<a href="<?=URL_BASE?>/users/register-form">Register</a> -->

<script type="text/javascript">
	$(document).ready(function(){
		var $form = $('#form');
		var $message = $('#message');
		var testPhone = /^[\+]?[0-9]{2,4}[-]?[0-9]{7,10}$/;
		var testEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

		$('.email').on('input',function(e){
				$('.errorEmail').html('');
			});
		$('.password').on('input',function(e){
			$('.errorPassword').html('');
		});


		function validate(){
			var respond = 0;
			if($('.required').val() == "")
			{
				$('.error').html('input required');
				respond = 1;
			}
			if( !testPhone.test($('.phone').val()) || $('.phone').val() == "")
			{
				$('.errorPhone').html('Phone format wrong');
				respond = 1;
			}

			if( !testEmail.test($('.email').val()) || $('.email').val() == "")
			{
				$('.errorEmail').html('Email format wrong');
				respond = 1;
			}
			return respond;
		}

		$form.on('submit', function(e) {
			var data = $(this).serializeArray();

			$.ajax({
				url: '<?=URL_BASE?>/users/member-login',
				method: 'POST',
				data: data,
				beforeSend: function () {
					$form.find('button').prop("disabled", true);
				},
				success: function (json) {
	                if (json == 1) {
	                    $('span#message').html('Login Success');
	                    window.location.href = "<?=URL_BASE?>/users/dashboard";
	                }
	                else {
	                    $('span.errorEmail').text(json);
	                }		
				},
				complete: function () {
					$form.find('button').prop("disabled", false);
				}
			})
			return false;
		});
	});
</script>
</form>


<!-- <label><?php //echo $login ?></label>

<label><?php //echo $sendEmail ?></lab>
<br/>
<label><?php //echo $logout ?></lab>

<a href="<?=URL_BASE?>/users/create">Form</a> -->
