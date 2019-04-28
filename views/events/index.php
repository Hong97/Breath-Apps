<?php
use app\models\EventDetail;
?>
<form id="form" method="POST">

        <div class="row row-inline-block small-spacing eventsDashboard">
            <div class="col-md-12 col-xs-12">
                <div class="box-content">
                    <h4 class="box-title" id="eventDetails">Event</h4>
                    <!-- /.box-title -->
                    <div id="rootwizard">
                        <div class="tab-header">
                            <div class="navbar">
                                <div class="navbar-inner">
                                    <ul class="tabLet">
                                        <li><a href="#tab1" data-toggle="tab">To Do List</a></li>
                                       <!--  <li><a href="#tab4" data-toggle="tab" onclick="redirect()">Priority</a></li> -->
                                        <li><a href="#tab2" data-toggle="tab">Pending</a></li>
                                        <li><a href="#tab3" data-toggle="tab">Not Going</a></li>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">
                                <div class="row row-inline-block small-spacing">      
                                <?php
                                $going = 1;
                                $nGoing = 0;
                                /*  echo "<pre>";
                                print_r($lists);*/
                                if(!empty($lists))
                                {
                                    foreach ($lists as $list) 
                                    {
                                        
                                        if($list['member_confirm'] == 1)
                                        {
                                            
                                            echo '
                                            <div class="col-lg-4 col-md-6 col-xs-12">
                                                <div class="box-content bordered-all">
                                                    <h4 class="box-title">'.$list['title'].'</h4>
                                                    <div class="dropdown js__drop_down">

                                                     <span class="controls">
														<button class="controlls fa"><a class="eventGoingStatus fa-edit js__card_remove" href="'.URL_BASE.'/events/event-form?eventID='.$list['eventID'].'&memberID='.$list['organise_by'].'&tdate='.$list['activities_start_date'].'"></button></a>
													</span>
                                                        
                                                    <span class="controls">
														<button class="controlls fa"><a class="eventGoingStatus fa fa-times js__card_remove" href="'.URL_BASE.'/events/?eventID='.$list['eventID'].'&memberID='.$list['memberID'].'&priority='.$list['priority'].'&member_confirm='.$nGoing.'"></button></a>
													</span>

                                                    </div>
                                                    <h5>Description: '.$list['description'].'</h5>
                                                    <p>Remark: '.$list['remark'].'</p>
                                                    <p>Date:'.$list['activities_start_date'].'</p>';
                                            echo '
												<a class="eventGoingStatus" href="'.URL_BASE.'/events/?eventID='.$list['eventID'].'&memberID='.$list['memberID'].'&priority='.$list['priority'].'&member_confirm='.$nGoing.'"></a>

												<a class="controlls"><a class="updateEvent js__card_remove" href="'.URL_BASE.'/events/event-form?eventID='.$list['eventID'].'&memberID='.$list['organise_by'].'&tdate='.$list['activities_start_date'].'"></button></a>
                                            ';


                                            echo '<div class="checkbox warning">';
                                            if ($list['priority'] == 1)
                                            {
                                                echo ' <a class="eventPriorityStatus" href="'.URL_BASE.'/events/?eventID='.$list['eventID'].'&member_confirm='.$list['member_confirm'].'&memberID='.$list['organise_by'].'&priority=0#tab1"><span>&#x2714;</span><strong>Priority</strong></a>';

                                            }else{
                                                echo ' <a class="eventPriorityStatus" href="'.URL_BASE.'/events/?eventID='.$list['eventID'].'&member_confirm='.$list['member_confirm'].'&memberID='.$list['organise_by'].'&priority=1#tab1"><span></span><strong>Priority</strong></a>';
                                            }
                                            echo'</div></div>
                                            </div>
                                            '; 
                                        }
                                        
                                    }
                                }
                                ?>
                                </div>
                                <!-- /.row row-inline-block small-spacing -->
                            </div>

                            <div class="tab-pane" id="tab2">
                                <div class="row row-inline-block small-spacing">
                                <?php
                                $going = 1;
                                $nGoing = 0;
                                /*  echo "<pre>";
                                print_r($lists);*/
                                if(!empty($lists))
                                {
                                    foreach ($lists as $list) 
                                    {
                                        if($list['member_confirm'] == NULL)
                                        {
                                            echo '
                                            <div class="col-lg-4 col-md-6 col-xs-12">
                                                <div class="box-content bordered-all">
                                                    <h4 class="box-title">'.$list['title'].'</h4>
                                                     <div class="dropdown js__drop_down">

                                                     <span class="controls">
														<button class="controlls fa"><a class="eventGoingStatus fa-times js__card_remove" href="'.URL_BASE.'/events/?eventID='.$list['eventID'].'&memberID='.$list['memberID'].'&priority='.$list['priority'].'&member_confirm='.$nGoing.'"></button></a>
													</span>

                                                    <span class="controls">
														<button class="controlls fa"><a class="eventGoingStatus fa-check js__card_remove" href="'.URL_BASE.'/events/?eventID='.$list['eventID'].'&priority=0&memberID='.$list['memberID'].'&member_confirm='.$going.'"></button></a>
													</span>
                                                    </div>
                                                      	<h5>Description: '.$list['description'].'</h5>
                                                   		<p>Remark: '.$list['remark'].'</p>
                                                    	<p>Date: '.$list['activities_start_date'].'</p>
                                                </div>
                                                <!-- /.box-content -->
                                            </div>';
                                            
                                        }
                                        
                                    }
                                }
                                ?>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab3">
                                    <div class="row row-inline-block small-spacing">
                                    <?php
                                    $going = 1;
                                    $nGoing = 0;
                                    /*  echo "<pre>";
                                    print_r($lists);*/
                                    if(!empty($lists))
                                    {
                                        foreach ($lists as $list) 
                                        {
                                            
                                            if($list['member_confirm'] == 0)
                                            {
                                                
                                                echo '
                                                 <div class="col-lg-4 col-md-6 col-xs-12">
                                                    <div class="box-content bordered-all">
                                                        <h4 class="box-title">'.$list['title'].'</h4>
                                                        <div class="dropdown js__drop_down">
                                                 
                                                    <span class="controls">
														<button class="controlls fa"><a class="eventGoingStatus fa-check js__card_remove" href="'.URL_BASE.'/events/?eventID='.$list['eventID'].'&priority=0&memberID='.$list['memberID'].'&member_confirm='.$going.'"></button></a>
													</span>
                                                    </div>
                                                       	<h5>Description: '.$list['description'].'</h5>
                                                    	<p>Remark: '.$list['remark'].'</p>
                                                    	<p>Date: '.$list['activities_start_date'].'</p>
                                                    </div>
                                                </div>
                                                ';   
                                            }
                                            
                                        }
                                    }
                                    ?>
                                    </div>
                                    <!-- /.row row-inline-block small-spacing -->
                                </div>

                            <div class="tab-pane spClick" id="tab4">
                                 <div class="row row-inline-block small-spacing">

                                <?php
                                    echo '<table class="pList">';
                                    echo '<thead>';
                                    echo '<tr>';
                                    echo '<th>'.'Title'.'</th>';
                                    echo '<th>'.'Date'.'</th>';
                                    echo '<th>'.'View'.'</th>';
                                    echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                    foreach ($priorityList as $key => $pList) {
                                        foreach ($pList as $key2 => $detail) {
                                          
                                          
                                           
                                            echo '<tr>';
                                            echo '<td>'.$detail['title'].'</td>';
                                            echo '<td>'.$detail['activities_start_date'].'</td>';
                                            echo '<td><a class="eventGoingStatus js__card_remove" href="'.URL_BASE.'/events/event-form?eventID='.$detail['eventID'].'&memberID='.$detail['organise_by'].'&tdate='.$detail['activities_start_date'].'"><i class="fa fa-edit"></i></button></a></td>';
                                            echo '</tr>';
                                        }
                                      
                                    }
                                    echo '</tbody>';
                                    echo '</table>';
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-content -->
            </div>
            <!-- /.col-md-6 col-xs-12 -->
        </div>
        <!-- /.row -->

        <div class="text-center"><button type="button" id="addButton" class="btn btn-default waves-effect waves-light addButton" data-toggle="modal" data-target="#addTask">+</button></div>

    <div class="modal fade" id="addTask" tabindex="-1" role="dialog" aria-labelledby="addTaskLabel" style="display: none;">
    <div class="modal-dialog" role="document" style="
">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="addTaskLabel">Add New Event</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group"><label for="taskName">Title</label>
                             <?php

                                if(!empty($lists)){
                                	echo "<pre>";
                                	print_r($lists);

                                    echo "<input type='hidden' name='eventID' value='".$lists[0]['eventID']."''>";
                                    echo "<input type='hidden' name='memberID' value='".$lists[0]['memberID']."''>";
                                    $title = $lists[0]['title'];
                                    if($lists[0]['organise_by'] == $_SESSION['userID'])
                                    {
                                        echo '<input type="text" name="title" id="taskName" value="'.$title.'" class="form-control required title" >';
                                     }else{
                                        echo '<input type="text" name="title" id="taskName" value="'.$title.'" class="form-control required title" disabled>';
                                    }
                                    }else{
                                        echo '<input type="text" name="title" id="taskName" class="form-control required title">';
                                    }

                            ?>
                            <span class="error errorTitle"></span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group"><label for="taskName">Description</label>
                             <?php
                            if(!empty($lists)){
                                $desc = $lists[0]['description'];
                                if($lists[0]['organise_by'] == $_SESSION['userID'])
                                {
                                    echo '<input type="textarea" id="frm-1" class="description form-control" name="description">'.$desc.'</textarea>';
                                 }else{
                                    echo '<input type="textarea" id="frm-1" class="description form-control" name="description" disabled>'.$desc.'</textarea>';
                                }
                                 }else{
                                echo '<input type="textarea" id="frm-1" class="description form-control" name="description"></textarea>';
                                }
                            ?>
                             <span class="error errorDescription"></span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group"><label for="frm-2">Remark</label>
                            <?php
                                if(!empty($lists)){
                                    $remark = $lists[0]['remark'];
                                    if($lists[0]['organise_by'] == $_SESSION['userID'])
                                    {
                                        echo '<input type="textarea" id="frm-2" class="remark form-control" name="remark" >'.$remark.'</textarea>';
                                     }else{
                                        echo '<input type="textarea" id="frm-2" class="remark form-control" name="remark" disabled>'.$remark.'</textarea>';
                                    }
                                    }else{
                                        echo '<input type="textarea" id="frm-2" class="remark form-control" name="remark" ></textarea>';
                                    }
                            ?>
                            <span class="error errorRemark"></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group"><label for="frm-3">Activities Type</label>

                            <select class="optiontype form-control" id="optiontype">
                                <?php
                                    if(!empty($lists)){
                                     
                                       $activities_type=$lists[0]['activities_type'];
                                       echo ($activities_type == 0 ? '<option value ="0" selected>Task</option>' : '');
                                       echo ($activities_type == 1 ? '<option value ="1" selected>Appointment</option>' : '');
                                       echo ($activities_type == 2 ? '<option value ="2" selected>Event</option>' : '');
                                       echo ($activities_type == 3 ? '<option value ="3" selected>Activities</option>' : '');
                                       //echo "<input type='text' name='typesDigit' id='typesDigit' value='".$activities_type."'>";
                                    }else{
                                        echo "
                                            <option value ='0' selected>Task</option>
                                            <option value ='1'>Appointment</option>
                                            <option value ='2'>Event</option>
                                            <option value ='3'>Activities</option>
                                            <input type='hidden' name='types' id='types'>
                                        ";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group demo-section k-content"><label for="frm-3">Feeling Point</label>
                            <?php
                                if(!empty($lists)){
                                    $results = '';
                                    if($_SESSION['userID'] != $lists[0]['memberID'])
                                    {
                                        $model = new EventDetail;
                                        $results = $model->userFeelingPoint($lists[0]['eventID'],$_SESSION['userID']);
                                        $feeling_point = $results[0]['feeling_point']*10;
                                        echo "<input type='hidden' name='feeelingEventID' class='form-control' value='".$lists[0]['eventID']."'>";
                                    }else{
                                         $feeling_point = $lists[0]['feeling_point']*10;
                                    }
                                    echo '<input type="text" id="feeling" class="balSlider required form-control" title="feeling" name="feeling"  value="'.$feeling_point.'" >';
                                
                                }else{
                                    echo '<input type="text" id="feeling" class="balSlider required form-control" value="5" title="feeling" name="feeling">';
                                }

                            ?>
                            <span class="error errorFeeling"></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="demo-section k-content"><label for="strat">Start Date</label>
                             <?php
                                if(!empty($lists)){
                                    $start=$lists[0]['activities_start_date'];
                                    if($lists[0]['organise_by'] == $_SESSION['userID'])
                                    {   
                                        echo '<input id="start" name="start" value="'.$start.'" class="required start form-control">';
                                     }else{
                                        echo '<input type="text" id="start" type="text" name="title" value="'.$start.'" class="required title form-control" disabled>';
                                    }
                                }else{
                                    echo '
                                        <input type="text" id="start" name="start" class="form-control" />
                                    ';
                                }
                            ?> 
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="demo-section k-content"><label for="end">End Date</label>
                            <?php
                                if(!empty($lists)){
                                    $end=$lists[0]['activities_end_date'];
                                    if($lists[0]['organise_by'] == $_SESSION['userID'])
                                    {   
                                        echo '<input type="text" id="end" name="end" value="'.$end.'" class="required end form-control">';
                                     }else{
                                        echo '<input type="text" id="end" name="end" value="'.$end.'" class="required end form-control" disabled>';
                                    }
                                }else{
                                    echo '
                                        <input type="text" id="end" name="end" class="form-control" />
                                    ';
                                }
                            ?>
                        </div>
                    </div>

                    <?php
                        if(empty($lists)){ 
                            echo "<label>Groups</label>";
                            echo '<input type="checkbox" name="groups" id="groups"> I want invite people<br>';
                            echo '<div class="peopleBox" id="peopleBox" style="display:none;">';
                            echo '<select class="groupList" id="groupList">';

                            $i = 1;
                            $email='';
                            foreach ($nameLists as $key => $list) 
                            {
                                foreach ($list as $key2 => $detail) 
                                {
                                    if((sizeof($list)-1) == $key2){
                                        $email .= $detail['email'];
                                    }else{
                                        $email .= $detail['email'].',';
                                    }
                                }
                                echo "<option value ='".$email."'>$key</option>";
                                
                                $i++;
                                $email='';
                            }
                                
                            echo '</select>';
                            echo '<ul class="nameList" id="nameList1"></ul>';
                            echo '<label>Invite List</label>';
                            echo '<input type="text" name="inviteBox" id="inviteBox" class="inviteBox" >';
                            echo '<ul class="nameList" id="nameList2"></ul>';
                            echo '<input type="text" name="groupsInput" id="groupsInput"  style="width:100%;">';
                        }
                    ?>      
                    <span class="error" id="errorPeopleBox"></span>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect waves-light" data-dismiss="modal">Close</button>
                <?php
                    if(!empty($lists)){
                        if($lists[0]['organise_by'] == $_SESSION['userID']){
                            echo '<button type="submit" class="btn btn-primary waves-effect waves-light id="update">Update</button>';    
                        }else{
                             echo '<button type="submit" class="btn btn-primary waves-effect waves-light id="updateFeeling">Update</button>';   
                        }
                    }else{
                        echo '<button type="submit" class="btn btn-primary waves-effect waves-light" id="create">Add New Event</button>';
                    }
                    ?>
                    <span id="message"></span>
            </div>
        </div>
    </div>
</div>               
</form>


<script>
    function link(){
       window.location.href = '<?=URL_BASE?>/events#tab4';
    }
    function redirect() {
        console.log('ASd');
       var Hash = window.location.hash;
         var URLBase_and_QS = window.location.href.split('#')[0];
         var newParams = (URLBase_and_QS.indexOf('?')==-1) ? '?' : '&';
         newParams += "[QueryParameterGoesHere]=[QueryParamValue]";
         return URLBase_and_QS + newParams + Hash;
    }
   
    function removeList()
        {
            var liNameList = document.querySelectorAll(".nameList > li ");
            function removeLi()
            {
                var liChoose = document.querySelectorAll(".nameList > li.removeMe");
                if(liChoose)
                {
                    liChoose[0].remove();   
                    
                }
            }

            function seletedTitle(index){
                return function( e ) {  
                    e.preventDefault();
                    liNameList[index].classList.add('removeMe');
                    removeLi();
                    packArray();
                }
            }
            for (var i = liNameList.length - 1; i >= 0; i--) {
               
                liNameList[i].addEventListener( 'click', seletedTitle( i ) )
            }

    }    

    function packArray()
    {
         $("#groupsInput").val("");
        var nameList1 = [];
        var listItems1 = $("#nameList1 > li > span");
        
        listItems1.each(function(li) {
            nameList1.push($(this).text());
        });


        var nameList2 = [];
        var listItems2 = $("#nameList2 > li > span");
        
        listItems2.each(function(li) {
            nameList2.push($(this).text());
        });


        var memberList = nameList1.concat(nameList2);
        console.log(memberList);
        $("#groupsInput").val(memberList);
        return memberList;
    }

    // tpye option
    $('#types').val(0);
    $('#optiontype').change(function(){
        $('#types').val(this.value);
    }); 

    //group option
    $('#groupList').val(0);
    $('#groupList').change(function(){
        $('#groupsInput').val(this.value);
         $( "#nameList1" ).html("");
        var email = this.value.split(",");
        $( "#nameList1" ).html();

        var nameList2 = [];
        var listItems = $("#nameList2 > li > span");
        
        listItems.each(function(li) {
            nameList2.push($(this).text());
        });

        var diff = [];
        diff = $(email).not(nameList2).get();
        for (var i = diff.length - 1; i >= 0; i--) {
           $( "#nameList1" ).append( "<li><span class ='emailTitle'>"+diff[i]+"</span><button class='deleteButton' onclick=removeList();>X</button></li> ");    
        }
       
    }); 


    //checkbox
    $('#groups').change(
         function(){
        if ($(this).is(':checked')) {
           $('#peopleBox').css('display','block');
        }else{
            $('#peopleBox').css('display','none');
        }
    });
   

    //date time picker

    $(document).ready(function() {

        function startChange() {
            var startDate = start.value();
            endDate = end.value();

            if (startDate) {
                startDate = new Date(startDate);
                startDate.setDate(startDate.getDate());
                end.min(startDate);
            } else if (endDate) {
                start.max(new Date(endDate));
            } else {
                endDate = new Date();
                start.max(endDate);
                end.min(endDate);
            }
        }

        function endChange() {
            var endDate = end.value(),
            startDate = start.value();

            if (endDate) {
                endDate = new Date(endDate);
                endDate.setDate(endDate.getDate());
                start.max(endDate);
            } else if (startDate) {
                end.min(new Date(startDate));
            } else {
                endDate = new Date();
                start.max(endDate);
                end.min(endDate);
            }
        }

        var today = kendo.date.today();

        var start = $("#start").kendoDateTimePicker({
            //value: today,
            change: startChange,
            format: "yyyy-MM-dd ~ hh:mm tt",
            parseFormats: ["yyyy-MM-dd"]
        }).data("kendoDateTimePicker");

        var end = $("#end").kendoDateTimePicker({
            //value: today,
            format: "yyyy-MM-dd ~ hh:mm tt",
            change: endChange,
            parseFormats: ["yyyy-MM-dd"]
        }).data("kendoDateTimePicker");

        start.max(end.value());
        end.min(start.value());
    });

    // feeling point
    $(document).ready(function() {
        var slider = $("#feeling").kendoSlider({
            increaseButtonTitle: "Right",
            decreaseButtonTitle: "Left",
            min: 0,
            max: 10,
            smallStep: 1,
            largeStep: 1
        }).data("kendoSlider");

    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        
        var $form = $('#form');
        var $message = $('#message');
       
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

       $('#create').on('click', function(e) {
            var data = $('#form').serializeArray();
            if(validate() == 0)
            {
                packArray();
                $.ajax({
                    url: '<?=URL_BASE?>/events/create-event',
                    method: 'POST',
                    data: data,
                    beforeSend: function () {
                        $form.find('button').prop("disabled", true);
                    },
                    success: function (json) {
                        console.log(json);
                    },
                    complete: function () {
                        window.location.href = "<?=URL_BASE?>/events";
                        $form.find('button').prop("disabled", false);
                    }
                })
            }
            return false;
        });


         $('#addButton').on('click', function(e) {
            window.location.href = "<?=URL_BASE?>/events/event-form";
        });

       $('#update').on('click', function(e) {
            var data = $('#form').serializeArray();
            if(validate() == 0)
            {
                packArray();
                $.ajax({
                    url: '<?=URL_BASE?>/events/update-basic-event-detail',
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
                        window.location.href = "<?=URL_BASE?>/events";
                    }
                })
            }
            return false;
        });

       $('#updateFeeling').on('click', function(e) {
            var data = $('#form').serializeArray();
           $.ajax({
                url: '<?=URL_BASE?>/events/update-feeling',
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
                    window.location.href = "<?=URL_BASE?>/events";
                }
            })
            return false;
        });

    
       $('#inviteBox').on('keypress', function(e) {
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
                            for (var i = $("#nameList1").children().length - 1; i >= 0; i--) {
                                var list = document.querySelectorAll("#nameList1 > li > span.emailTitle");
                                if (list[i].innerText == json)
                                {    status = 1;
                                    $('#errorPeopleBox').html('Email has repeat');
                                }
                            }
                            for (var i = $("#nameList2").children().length - 1; i >= 0; i--) {
                                var list = document.querySelectorAll("#nameList2 > li > span.emailTitle");
                                if (list[i].innerText == json)
                                {    status = 1;
                                    $('#errorPeopleBox').html('Email has repeat');
                                }
                            }
                            if(status == 0){

                                $('#inviteBox').val("");
                                $( "#nameList2" ).append( "<li><span class ='emailTitle'>"+json+"</span><button class='deleteButton' onclick=removeList();>X</button></li> ");
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



