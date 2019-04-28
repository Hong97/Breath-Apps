<form id="form" method="POST" class="frm-single">

	<div id="single-wrapper">
<!-- 	<form action="#"> -->
		<div class="inside">
			<div class="title"><strong>Breath</strong>App</div>
			<!-- /.title -->
			<div class="frm-title">Register</div>
			<!-- /.frm-title -->
			<div class="frm-input"><input type="type" name="name" placeholder="Name" class="frm-inp required name" <?php if(!empty($users)){echo 'disabled '. "value=".$users[0]['name'];}?>><i class="fa fa-envelope frm-ico"></i>
				<span class="error errorName"></span>
			</div>
			<!-- /.frm-input -->

			<div class="frm-input"><input type="email" name="email" placeholder="Email" class="frm-inp required email" <?php if(!empty($users)){echo 'disabled '. "value=".$users[0]['email'];}?>><i class="fa fa-envelope frm-ico"></i>
				<span class="error errorEmail"></span>
			</div>
			<!-- /.frm-input -->

			<div>
				<label>Gender</label>
				<select class="genderBox">
					<?php
					$index = !empty($users[0]['gender']);
					if($index)
					{
						$gender = '';
						if($index == 0)
						{
							$gender = "Male";
						}
						if($index == 1)
						{
							$gender = "Female";
						}
						if($index == 2)
						{
							$gender = "Others";
						}
						echo "<option selected='true'>$gender</option>";	
						echo "<input type='text' name='gender' class='gender' value = '$index'/>";
					}else{
						echo "
							<option selected='true'>Male</option>
							<option>Female</option>
							<option>Others</option>
							<input type='text' name='gender' class='gender'/>
							<span class='errorGender'></span>
						";
					}
					?>
				</select>
			</div>

			<div class="frm-input"><input type="tel" name="phone" placeholder="Phone" class="frm-inp required phone" <?php if(!empty($users)){echo "value=".$users[0]['phone'];}?>><i class="fa fa-envelope frm-ico"></i>
				<span class="error errorPhone"></span>
			</div>
			<!-- /.frm-input -->

			<?php
				if(!empty($users))
				{
					echo '<input type="checkbox" name="changPassword" id="changPassword"> I want to update profile and password <br>';
					echo '<div class="changPasswordBox " id="changPasswordBox" style="display:none">';
				}else{
					echo '<div class="changPasswordBox updateMe" id="changPasswordBox" style="display:block">';
				}
			?>

			<div class="frm-input">
				<?php
				if(!empty($users))
				{
					echo '<input type="password" name="password" id="password" placeholder="Password" class="frm-inp password" onclick="p();"/><i class="fa fa-user frm-ico"></i>';
				}else{
					echo '<input type="password" name="password" id="password" placeholder="Password" class="frm-inp required password">
						<i class="fa fa-user frm-ico"></i>';
				}
				?>
				<span class="error errorPassword"></span>
			</div>
			<!-- /.frm-input -->

			<div class="frm-input">
			<?php
				if(!empty($users))
				{
					echo '<input type="password" name ="confirmPassword" id="confirmPassword" placeholder="Confirm Password" class="frm-inp confirmPassword" onclick="p();"/><i class="fa fa-lock frm-ico"></i>';
				}else{
					echo '<input type="password" name ="confirmPassword" id="confirmPassword" placeholder="Confirm Password" class="frm-inp required confirmPassword"><i class="fa fa-lock frm-ico"></i>';
				}
			?>
			<span class="error errorConfirmPassword"></span>
			</div>
			<!-- /.frm-input -->

			<?php
				if(empty($users))
				{
					echo '<button type="submit" id="create" class="frm-submit">Register<i class="fa fa-arrow-circle-right"></i></button>';
				}else{
					echo '<button type="submit" id="update" class="frm-submit" style="display:none">Update<i class="fa fa-arrow-circle-right"></i></button>';
				}
			?>
			<a href="<?=URL_BASE?>/users/login" class="a-link"><i class="fa fa-sign-in"></i>Already have account? Login.</a>
		</div>
		<!-- .inside -->
<!-- 	</form> -->
	<!-- /.frm-single -->
</div><!--/#single-wrapper -->
	<span id="message"></span>
</form>
<script type="text/javascript">
	 //checkbox
	 function p()
	{
		$('.updateMe .password').on('input',function(e){
		    $('.errorPassword').html('');
		});

		$('.updateMe .confirmPassword').on('input',function(e){
		    $('.errorConfirmPassword').html('');
		});
		
	}p();

    $('#changPassword').change(
         function(){
        if ($(this).is(':checked')) {
           $('#changPasswordBox').css('display','block');
           $('#update').css('display','block');
             $('#changPasswordBox').addClass( "updateMe" );
             $('#password').addClass( "required" );
            $('#confirmPassword').addClass( "required" );
        }else{
            $('#changPasswordBox').css('display','none');
            $('#update').css('display','none');
             $('#changPasswordBox').removeClass( "updateMe" );
            $('#password').removeClass( "required" )
            $('#confirmPassword').removeClass( "required" );

        }
    });

	$(document).ready(function(){
		var $form = $('#form');
		var $message = $('#message');
		var testPhone = /^[\+]?[0-9]{2,4}[-]?[0-9]{7,10}$/;
		var testEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

		$('.name').on('input',function(e){
		    $('.errorName').html('');
		});

		$('.email').on('input',function(e){
		    $('.errorEmail').html('');
		});

		$('.phone').on('input',function(e){
		    $('.errorPhone').html('');
		});

		
		


		function validate(){
			var respond = 0;
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
			if($('.updateMe .password').val().length < 7)
			{
				$('.errorPassword').html('Password length must be greater than 7');
				respond = 1;
			}

			if($('.updateMe .password').val() !== $('.updateMe .confirmPassword').val())
			{
				$('.errorConfirmPassword').html('Password does not match');
				respond = 1;
			}

			if($('.required').val() .length <= 0)
			{
				$('.error').html('input required');
				respond = 1;
			}
			
			return respond;
		}

		$('#create').on('click', function(e) {
			var data = $('#form').serializeArray();
			if(validate() == 0)
			{

				$.ajax({
					url: '<?=URL_BASE?>/users/register',
					method: 'POST',
					data: data,
					beforeSend: function () {
						$form.find('button').prop("disabled", true);
					},
					success: function (json) {
		                if (json == 1) {
		                    $('span#message').html('Create Success');
		                     window.location.href = "<?=URL_BASE?>/users";
		                }
		                else {
		                    $('span.errorEmail').text(json);
		                }		
					},
					complete: function () {
						$form.find('button').prop("disabled", false);
					}
				})
			}
			return false;
		});


		$('#update').on('click', function(e) {
			var data = $('#form').serializeArray();

			if(validate() == 0)
			{
				$.ajax({
					url: '<?=URL_BASE?>/users/update-profile',
					method: 'POST',
					data: data,
					beforeSend: function () {
						$form.find('button').prop("disabled", true);
					},
					success: function (json) {
		                if (json == 1) {
		                    $('span#message').html('Update Success');
		                    // window.location.href = "<?=URL_BASE?>/users";
		                }
		                else {
		                    $('span.errorEmail').text(json);
		                }		
					},
					complete: function () {
						$form.find('button').prop("disabled", false);
					}
				})
			}
			return false;
		});
	});

	function genderDropDown(){

		var genderDropDown = document.querySelectorAll("select.genderBox");
		var genderInput = document.querySelectorAll(".gender");
		genderInput[0].value = genderDropDown[0].value;
		genderInput[0].style.display="none";
		genderDropDown[0].onchange = function() {
		  var index = this.selectedIndex;
		  var inputText = this.children[index].innerHTML.trim();
		  genderInput[0].value=index;
		}
	}window.onload = genderDropDown;

	
</script>
