<?php
use app\models\Groups;
?>
<a href="<?= URL_BASE;?>/groups">Groups</a>

<form id="form" method="POST" class="formMargin groupForm">
	<div class="modal-content">
		<div class="modal-header">
			<span id="message"></span>
            <h4 class="modal-title" id="addTaskLabel">Add New Group</h4>
        </div>
		<div class="modal-body">
			<div class="col-md-12">
				<label>Groups Title</label>
			 	<input type="text" name="title" id ="title" class="required title" 
		    	<?php if(!empty($datas)){ echo 'value="'.$datas[0]['title'].'"';}?>>
		        <span class="error errorTitle"></span>
		    </div>
		                   
		     <div class="col-md-12">
		     		<label>Invite List</label>
					<input type="text" name="inviteBox" id="inviteBox" class="inviteBox" >
		        <?php
					if(!empty($datas)){
						$emails = "";
						foreach ($datas as $key => $data) 
						{
							if((sizeof($datas)-1) == $key)
							{
								$emails .= $data['memberID'];
							}else{
								$emails .= $data['memberID'].',';
							}	
						}
						echo "<input type='hidden' name='groupID' value='".$data['groupID']."''>";
						echo '
						<input type="text" name="members" id="members" class="required" style="display:none" value='.$emails.' >
						';
					}else{
						echo '<input type="text" name="members" id="members" class="required" style="display:none"; >';
					}

				?>		
		        <span class="error errorList"></span>
		    </div>
		     <div class="modal-footer">
				<?php
				if(!empty($datas)){

					echo '<button class="btn btn-primary waves-effect waves-light"  type="submit" id="update">Update</button>';
				}else{
					echo '<button class="btn btn-primary waves-effect waves-light"  type="submit" id="create">Create</button>';
				}
				?>
			</div>
		</div>
	</div>
</form>
 <div class="modal-content specialMargin groupMemberF">
 	  <div class="modal-header">
                <h4 class="modal-title" id="addTaskLabel">Member List</h4>
            </div>
	    <div class="modal-body">
	        <div class="row">
			<?php
			if(!empty($datas)){
				
				echo '<ul class="nameList" id="nameList" style="display: block;">';
				foreach ($datas as $key => $data) 
				{	
					echo "<li><span class ='emailTitle'>".$data['memberID']."</span><button class='deleteButton fa fa-times js__card_remove' onclick=removeList();></button></li>";	
				}

				echo "</ul>";
			}else{
				echo '<ul class="nameList" id="nameList" style="display: none;"></ul>';
			}
			?>
			</div>
		</div>
</div>


<script type="text/javascript">
	function packArray()
	{
		var ar = [];
		var listItems = $("#nameList > li > span");
		
		listItems.each(function(li) {
		    ar.push($(this).text());
		});

		$("#members").val(ar);
		
	}
	function removeList()
	{
		
		var ulNameList = document.querySelectorAll("#nameList");
		var liChoose = document.querySelectorAll("#nameList > li");
		var members = document.querySelectorAll("#members");

		function removeLi()
		{
			var liChoose = document.querySelectorAll("#nameList > li.removeMe");
			if(liChoose)
			{
				liChoose[0].remove();	
				packArray();
			}
		}

		function seletedTitle(index){
			return function( e ) {	
				e.preventDefault();
				liChoose[index].classList.add('removeMe');
				removeLi();
			}
		}
		for (var i = liChoose.length - 1; i >= 0; i--) {
	      	liChoose[i].addEventListener( 'click', seletedTitle( i ) )
	  	}

	}

	$(document).ready(function(){
		var $form = $('#form');
		var $inviteBox = $('#inviteBox');
		var $nameListLi = $('ul#nameList > li');
		var $nameList = $('ul#nameList');
		var nameList = $('.nameList');
		var $message = $('#message');
		var testPhone = /^[\+]?[0-9]{2,4}[-]?[0-9]{7,10}$/;
		var testEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

		$('#title').on('input',function(e){
		    $('.errorTitle').html('');
		});

		$('#inviteBox').on('input',function(e){
		    $('#message').html('');
		    $('.errorList').html('');
		});

		
		function validate(){
			var respond = 0;
	
			if($('.required').val() .length <= 0)
			{
				$('.error').html('input required');
				respond = 1;
			}

			if($('#members').val() .length <= 0)
			{
				$('.errorList').html('Please key in email');
				
				respond = 1;
			}
			
			if($inviteBox.val().length > 0)
			{
				$('#message').html('Please press enter to confirm add in group');
				respond = 1;
			}


			return respond;
		}

		
		$('#update').on('click', function(e) {
			var data = $('#form').serializeArray();
			if(validate() == 0)
			{
				packArray();
				$.ajax({
					url: '<?=URL_BASE?>/groups/update-group',
					method: 'POST',
					data: data,
					beforeSend: function () {
						$form.find('button').prop("disabled", true);
					},
					success: function (json) {
						console.log(json)
					},
					complete: function () {
						$form.find('button').prop("disabled", false);
						window.location.href = "<?=URL_BASE?>/groups";
					}
				})
			}
			return false;
		});

		$('#create').on('click', function(e) {
			var data = $('#form').serializeArray();
			if(validate() == 0)
			{
				packArray();
				$.ajax({
					url: '<?=URL_BASE?>/groups/create-group',
					method: 'POST',
					data: data,
					beforeSend: function () {
						$form.find('button').prop("disabled", true);
					},
					success: function (json) {
						console.log(json)
					},
					complete: function () {
						window.location.href = "<?=URL_BASE?>/groups";
						$form.find('button').prop("disabled", false);
					}
				})
			}
			return false;
		});

		
		
		$inviteBox.on('keypress', function(e) {
			if (event.key === "Enter") 
			{
				$.ajax({
					url: '<?=URL_BASE?>/groups/check-member',
					method: 'POST',
					data: {email:$('#inviteBox').val()},
					beforeSend: function () {
						$form.find('button').prop("disabled", true);
					},
					success: function (json) {

						if(json == 0){
							  $('#message').html('Email Not Exist');
							  
						}else if(json == 2){
							$('#message').html('User own email cannot added');
						}else{	
						
							$('.nameList').css("display", "block");
							var status = 0;
							for (var i = $(".nameList").children().length - 1; i >= 0; i--) {
								var list = document.querySelectorAll(".nameList > li > span.emailTitle");
								if (list[i].innerText == json)
								{    status = 1;
									$('#message').html('Email has repeat');
								}
							}
							if(status == 0){

								$('#inviteBox').val("");
								$( ".nameList" ).append( "<li><span class ='emailTitle'>"+json+"</span><button class='deleteButton fa fa-times js__card_remove' onclick=removeList();></button></li> ");
								packArray();
							}
						}
					},
					complete: function () {
						$form.find('button').prop("disabled", false);
					}
				})
		    	
		    }
			
		});

		


	});

	
	
	
</script>

