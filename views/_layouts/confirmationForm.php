Thanks for signing up! Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below

Your will redicte to login page at <span class="timers">5</span> secand;

<script type="text/javascript">
		
	function redirect()
	{
		var x =document.querySelectorAll(".timers");
		var i = 5;
		setInterval(function(){ 
	
		   	x[0].innerText = i;
		    i--;

		    if(i < 0){
		    	window.location.href = "<?=URL_BASE?>/users";
		    	x[0].innerText = 0;
		    }
		   
		   
	    },1000);
		
		
	}

	window.onload=redirect;

</script>