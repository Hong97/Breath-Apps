<form id="form" method="POST" class="frm-single">

	<div id="single-wrapper">
<!-- 	<form action="#" > -->
		<div class="inside">
			<div class="title"><strong>Breath</strong>App</div>
			<!-- /.title -->
			<div class="frm-title">Reset Password</div>
			<!-- /.frm-title -->
			<p class="text-center">Enter your email address and we'll send you an email with instructions to reset your password.</p>
			<div class="frm-input"><input type="email" name="email" placeholder="Enter Email" class="frm-inp required email"><i class="fa fa-envelope frm-ico"></i>
			<span class="error errorEmail"></span>
			</div>
			<!-- /.frm-input -->
			<span id="message"></span>
			<button type="submit" class="frm-submit">Send Email<i class="fa fa-arrow-circle-right"></i></button>
			<a href="<?=URL_BASE?>/users/login" class="a-link"><i class="fa fa-sign-in"></i>Already have account? Login.</a>
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
	<span id="message"></span>
	<button type="submit">Reset</button> -->

<script type="text/javascript">
	$(document).ready(function(){
		var $form = $('#form');
		var $message = $('#message');
		var testEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

		$('.email').on('input',function(e){
				$('.errorEmail').html('');
			});
		
		function validate(){
			var respond = 0;
			if($('.required').val() == "")
			{
				$('.error').html('input required');
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
				url: '<?=URL_BASE?>/users/reset-password',
				method: 'POST',
				data: data,
				beforeSend: function () {
					$form.find('button').prop("disabled", true);
				},
				success: function (json) {
	                if (json == 1) {
	                    $('span#message').html('Login Success');
	                    window.location.href = "<?=URL_BASE?>/users";
	                }
	                else {
	                    $('span.errorEmail').html('Email Not Exist');
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
