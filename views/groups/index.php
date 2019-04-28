
<div class="main-content groupContent">
    <div class="col-md-12">
        <div class="box-content groupRow">
            <h4 class="box-title">Group</h4>
            <!-- /.box-title -->
            <!-- /.dropdown js__dropdown -->
        </div>
        <!-- /.box-content -->
    </div>
    <div class="row row-inline-block small-spacing">
        
            
    	<?php
			foreach ($datas as $data) {
				echo '<div class="col-lg-4 col-md-12">';
				echo '<div class="box-content bordered groupMember">';
				echo "<p>".$data['title']."</p>
                <div class='dropdown js__drop_down'>
                <span class='controls'><button class='controlls fa'><a class='eventGoingStatus fa fa-edit js__card_remove' href='".URL_BASE."/groups/form?gID=".$data['groupID']."'></a> </button></span>
                 <span class='controls'><button class='controlls fa'><a class='eventGoingStatus fa fa-times js__card_remove' href='".URL_BASE."/groups?gID=".$data['groupID']."'></a> </button></span>
                </div><p class='cDATE'>Created Date: ".$data['create_date']."</p>"
                ;   
				echo "</div>";
				echo "</div>";
			}

		?>
        <!-- /.col-lg-4 col-md-6 col-xs-12 -->
    </div>
    <!-- /.row row-inline-block small-spacing -->
</div>

<div class="text-center">
	<button type="button" class="btn btn-default waves-effect waves-light addButton" id="addButton" data-toggle="modal" data-target="#addTask">+</button>
</div>

<script type="text/javascript">
	  $('#addButton').on('click', function(e) {
            window.location.href = "<?=URL_BASE?>/groups/create-form";
        });

</script>
