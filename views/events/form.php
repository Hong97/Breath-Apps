<?php
use app\models\EventDetail;
?>
<form id="form" method="POST" class="formMargin">

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addTaskLabel">Add New Event</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <span id="message"></span>
                    <div class="col-md-12">
                        <div class="form-group"><label for="taskName">Title</label>
                             <?php
                                if(!empty($lists)){
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
                                    echo '<textarea id="frm-1" class="description form-control" name="description">'.$desc.'</textarea>';
                                 }else{
                                    echo '<textarea id="frm-1" class="description form-control" name="description" disabled>'.$desc.'</textarea>';
                                }
                                 }else{
                                echo '<textarea id="frm-1" class="description form-control" name="description"></textarea>';
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
                                        echo '<textarea id="frm-2" class="remark form-control" name="remark" >'.$remark.'</textarea>';
                                     }else{
                                        echo '<textarea id="frm-2" class="remark form-control" name="remark" disabled>'.$remark.'</textarea>';
                                    }
                                    }else{
                                        echo '<textarea id="frm-2" class="remark form-control" name="remark" ></textarea>';
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
                            echo '<input type="hidden" name="groupsInput" id="groupsInput"  style="width:100%;">';
                        }
                    ?>      
                    <span class="error" id="errorPeopleBox"></span>

                </div>
            </div>
            <div class="modal-footer">
                <?php
                    if(!empty($lists)){
                        if($lists[0]['organise_by'] == $_SESSION['userID']){
                            echo '<button type="submit" class="btn btn-primary waves-effect waves-light" id="update">Update</button>';    
                        }else{
                             echo '<button type="submit" class="btn btn-primary waves-effect waves-light" id="updateFeeling">Update</button>';   
                        }
                    }else{
                        echo '<button type="submit" class="btn btn-primary waves-effect waves-light" id="create">Add New Event</button>';
                    }
                    ?>
                    
            </div>
        </div>
    </div>
</div>               
</form>


<script>
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

        //start.max(end.value());
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