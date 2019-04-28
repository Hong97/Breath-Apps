<a href="<?= URL_BASE;?>/users">Index</a>
<form id="form" method="POST">
	<div>
		<label>Email</label>
		<input type="email" name="email" class="required email"/>
		<span class="error errorEmail"></span>
	</div>
	<div>
		<label>Password</label>
		<input type="password" name="password" class="required password"/>
		<span class="error errorPassword"></span>
	</div>
	<button type="submit">Submit</button>
	<span id="message"></span>
</form>
<script type="text/javascript">
	$(document).ready(function(){
		var $form = $('#form');
		var $message = $('#message');
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
			return respond;
		}

		$form.on('submit', function(e) {
			var data = $(this).serializeArray();
			if(validate() == 0)
			{
				$.ajax({
					url: '<?=URL_BASE?>/users/login',
					method: 'POST',
					data: data,
					beforeSend: function () {
						$form.find('button').prop("disabled", true);
					},
					success: function (json) {
						console.log(json);	
					},
					complete: function () {
						$form.find('button').prop("disabled", false);
					}
				})
			}
			return false;
		});
	});
</script>
