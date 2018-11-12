<?php if(isset($_SESSION['user_email'])){ ?>

<div class="content" id="main_div">
<div class="container-fluid">
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="header">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="title">Project Details <a href="?module=project&action=project_view" class="btn btn-info btn-fill pull-right"><< Back To Project</a></h4>
            <!--<p class="category">24 Hours performance</p>--> 
            
          </div>
          <div class="panel-body">
            <div class="content">
              <?php if(isset($_SESSION['ERROR_PROJECT_UPDATE'])){?>
              <div class="alert alert-danger"> <strong>Sorry!</strong> <?php echo $_SESSION['ERROR_PROJECT_UPDATE'];$_SESSION['ERROR_PROJECT_UPDATE']=NULL;?> </div>
              <?php } ?>
              <?php if(isset($_SESSION['TASK_ADD_SUCCESS'])){?>
              <div class="alert alert-success"> <strong>Success!</strong> <?php echo $_SESSION['TASK_ADD_SUCCESS'];$_SESSION['TASK_ADD_SUCCESS']=NULL;?> </div>
              <?php } ?>
              <?php foreach($project_list as $data){ ?>
              <div id="chartHours" class="ct-chart">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Project Name :</label>
                      <?php echo $data->getProjectName(); ?> </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>End Date :</label>
                      <?php $end_date= $data->getProjectEndDate(); 
												echo date('d/m/Y',strtotime($end_date));
												?>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Status :</label>
                      <?php $complete_status=$data->getIsCompleted(); ?>
                      <?php if($complete_status==1){
														echo "In Progress";
													}
													elseif($complete_status==2){
														echo "Complete";
														}
													elseif($complete_status==0){
														echo "No Task Created";
														}	} ?>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Project Description :</label>
                      <br />
                      <?php echo $data->getProjectDescription(); ?> </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Project Remarks :</label>
                      <br />
                      <?php echo $data->getProjectRemark(); ?> </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Project Leader :</label>
                      <br />
                      <?php $leader=$data->getProjectLeader(); ?>
                      <?php 

											$list2=$obj_project_class_dao->get_project_leader_name($leader);?>
                      <?php foreach($list2 as $data2){ echo $data2['fname']." ".$data2['lname']; }?>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Project Members :</label>
                      <br />
                      <?php $owner=$data->getProjectOwner(); 
													$aa=(explode(",",$owner));
													foreach($aa as $bb){
														//echo $bb;
														$owner_result=$obj_user_class_dao->readAll_Byid($bb);
														foreach($owner_result as $data){ ?>
                      <?php echo $data->getFirstName()." ".$data->getLastName(); ?><br />
                      <?php 
														}
											}
																$obj_user_class=new User();
					$obj_user_class_dao=new UserDAO();
					$obj_user_class->setId($owner);
					$list_member=$obj_user_class_dao->get_member_except_these_all_user($obj_user_class);
												


													?>
                    </div>
                  </div>
                </div>
                <?php if($leader ==$_SESSION['user_id'] || $_SESSION['usertype']=="ADMIN"){ ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="button" class="btn btn-info btn-fill pull-right edit" data-toggle="modal" data-target="#delete_member_modal" id="edit_btn2" value="DELETE MEMBER" />
                      <input type="button" class="btn btn-info btn-fill pull-right edit" data-toggle="modal" data-target="#add_member_modal" id="edit_btn3" value="ADD MEMBER" />
                      <input type="button" class="btn btn-info btn-fill pull-right edit" data-toggle="modal" data-target="#myModal" id="edit_btn" value="EDIT PROJECT" />
                    </div>
                  </div>
                </div>
                <?php }?>
              </div>
            </div>
          </div>
          </div>
          <div class="header">
            <h4 class="title">PROJECT RELATED TASKS</h4>
            <hr>
          </div>
          <div class="content">
            <?php if(!empty($list)){ ?>
            <ul class="pagination">
              <?php 
								$project_id2=base64_encode($project_id);
								$complete_status2=base64_encode($complete_status);
								echo "<li><a href='?module=project&action=project_view_task&id&id=$project_id2&status=$complete_status2&page=1'>".'FIRST<<'."</a></li> ";  // Goto 1st page ?>
              <?php for ($i=1; $i<=$number_of_pages; $i++) { ?>
              <li class="<?php if($page==$i){ echo "active";} else {echo""; }?>"> <?php echo " <a href='?module=project&action=project_view_task&id=$project_id2&status=$complete_status2&page=".$i."'>".$i."</a></li> "; 
}; ?>
                <?php 
echo "<li><a href='?module=project&action=project_view_task&id=$project_id2&status=$complete_status2&page=$number_of_pages'>".'>>LAST'."</a><li> "; // Goto last page
?>
            
            </ul>
            <div class="content table-responsive table-full-width">
           
            <table class="table table-hover table-striped">
                <thead>
                <th>SL. NO.</th>
                <th>Project Name</th>
                  <th>Task Name</th>
                  <th>Task Assigned To</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Task Description</th>                  
                  <th>Priority</th>
                  <th>Status</th>
                  <th></th>
                  </thead>
                <tbody>
                <?php 
				foreach($project_list as $data3){
							$projectleader=$data3->getProjectLeader();
						}
				if($_SESSION['usertype']=="USER" && $projectleader!=$_SESSION['user_id']){
					
					$obj_project_details->setUserId($_SESSION['user_id']);
				
				$projectdetaisbyuser=$obj_project_details_dao->getProjectDetailsByUserId($obj_project_details);
					
					foreach($projectdetaisbyuser as $data){ ?>
                    
                    
                                      <tr>
                    <td><?php echo $slno; $task_id=$data->getId();?></td>
                    <td><?php foreach($project_list as $data2){
							echo $data2->getProjectName();
						}?></td>
                    <td><?php $taskname=$data->getTaskName();
												if($taskname!=''){
													echo $taskname;
												}
												else {
													echo "Not Set";
												}
											 ?></td>
                    <td><?php  $owner=$_SESSION['user_id']; ?>
                      <?php 
													if($owner!=0){
											$list=$obj_user_class_dao->readAll_Byid($owner);?>
                      <?php foreach($list as $data2){ echo $data2->getFirstName()." ".$data2->getLastName(); }}else {echo "Not Set";}?></td>
                    <td><?php $timestamp=strtotime($data->getTaskStartDate());
						echo date('d/m/Y', $timestamp);?></td>
                    <td><?php	
														$today=time();
														
														$enddate=strtotime($data->getTaskEndDate());
														
														$datediff = $enddate - $today;

														$daysleft = floor($datediff / (60 * 60 * 24));
														
														
														
														if($daysleft <=5 && $daysleft>=0){
														
														echo '<span class="orange">'.date('d/m/Y', $enddate).'</span>';
														}
														
															elseif($daysleft<0){
														
															echo '<span class="red">'.date('d/m/Y', $enddate).'</span>';
														}
														
														else {
															
															echo '<span class="green">'.date('d/m/Y', $enddate).'</span>';
															
														}
											
											 ?></td>
                    <td><?php echo $data->getTaskDescription(); ?></td>
                     <td><?php $task_priority=$data->getPriority(); 
													if($task_priority==1){
														echo "<span class='green'>Normal</p>";
													}
													elseif($task_priority==2){
														echo "<span class='orange'>Medium</p>";
														}
													elseif($task_priority==3){
														echo "<span class='red'>High</p>";
														}
													else{
														echo "Not Set";
													}		
											?></td>
                    <td><?php $is_complete=$data->getIsCompleted();
													if($is_complete==1){
														echo "In Progress";
													}
													elseif($is_complete==2){
														echo "Complete";
														}
													elseif($is_complete==3){
														echo "Require Assistance";
														}
													elseif($is_complete==4){
														echo "Not Started";
														}
													elseif($is_complete==5){
														echo "Invalid Task";
														}	
													else{
														echo "Not Set";
													}
											 ?></td>
                    <!--<td> <a href="" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                        <i class="fa fa-edit fa-2x"></i>
                                                    </a>
                                                    <a href="<?php echo '?module=project&action=project_delete_task&id='.base64_encode($task_id).''?>" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                        <i class="fa fa-times fa-2x"></i>
                                                    </a></td>
                                             <td><a href="<?php echo '?module=project&action=update_task_completed&id='.base64_encode($task_id).'&status='.base64_encode(2).''?>" class="btn <?php if($is_complete==2){echo "disabled"; } else {echo "btn-info";} ?>">Set<br /> Task Completed</a></td>-->
                    
                    <td><?php $session_project_status=$_SESSION['PROJECT_STATUS']; ?>
                      <a href="<?php echo '?module=remark&action=view_remark&id='.base64_encode($task_id).'&status='.$session_project_status.''?>" class="btn btn-info btn-fill">Details</a></td>
                  </tr>

                    <?php }?>
					
					
					
					 <?php }else{?>
                  <?php foreach($list as $data){ ?>
                  <tr>
                    <td><?php echo $slno; $task_id=$data->getId();?></td>
                    <td><?php foreach($project_list as $data2){
							echo $data2->getProjectName();
						}?></td>
                    <td><?php $taskname=$data->getTaskName();
												if($taskname!=''){
													echo $taskname;
												}
												else {
													echo "Not Set";
												}
											 ?></td>
                    <td><?php  $owner=$data->getUserId(); ?>
                      <?php 
													if($owner!=0){
											$list=$obj_user_class_dao->readAll_Byid($owner);?>
                      <?php foreach($list as $data2){ echo $data2->getFirstName()." ".$data2->getLastName(); }}else {echo "Not Set";}?></td>
                    <td><?php $timestamp=strtotime($data->getTaskStartDate());
						echo date('d/m/Y', $timestamp);?></td>
                    <td><?php	
														$today=time();
														
														$enddate=strtotime($data->getTaskEndDate());
														
														$datediff = $enddate - $today;

														$daysleft = floor($datediff / (60 * 60 * 24));
														
														
														
														if($daysleft <=5 && $daysleft>=0){
														
														echo '<span class="orange">'.date('d/m/Y', $enddate).'</span>';
														}
														
															elseif($daysleft<0){
														
															echo '<span class="red">'.date('d/m/Y', $enddate).'</span>';
														}
														
														else {
															
															echo '<span class="green">'.date('d/m/Y', $enddate).'</span>';
															
														}
											
											 ?></td>
                    <td><?php echo $data->getTaskDescription(); ?></td>
                     <td><?php $task_priority=$data->getPriority(); 
													if($task_priority==1){
														echo "<span class='green'>Normal</p>";
													}
													elseif($task_priority==2){
														echo "<span class='orange'>Medium</p>";
														}
													elseif($task_priority==3){
														echo "<span class='red'>High</p>";
														}
													else{
														echo "Not Set";
													}		
											?></td>
                    <td><?php $is_complete=$data->getIsCompleted();
													if($is_complete==1){
														echo "In Progress";
													}
													elseif($is_complete==2){
														echo "Complete";
														}
													elseif($is_complete==3){
														echo "Require Assistance";
														}
													elseif($is_complete==4){
														echo "Not Started";
														}
													elseif($is_complete==5){
														echo "Invalid Task";
														}	
													else{
														echo "Not Set";
													}
											 ?></td>
                    <!--<td> <a href="" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                        <i class="fa fa-edit fa-2x"></i>
                                                    </a>
                                                    <a href="<?php echo '?module=project&action=project_delete_task&id='.base64_encode($task_id).''?>" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                        <i class="fa fa-times fa-2x"></i>
                                                    </a></td>
                                             <td><a href="<?php echo '?module=project&action=update_task_completed&id='.base64_encode($task_id).'&status='.base64_encode(2).''?>" class="btn <?php if($is_complete==2){echo "disabled"; } else {echo "btn-info";} ?>">Set<br /> Task Completed</a></td>-->
                    
                    <td><?php $session_project_status=$_SESSION['PROJECT_STATUS']; ?>
                      <a href="<?php echo '?module=remark&action=view_remark&id='.base64_encode($task_id).'&status='.$session_project_status.''?>" class="btn btn-info btn-fill">Details</a></td>
                  </tr>
                  <?php $slno++; } }?>
                </tbody>
              </table>
              <?php } else {?>
              <div class="alert alert-warning"> <strong>Sorry!</strong> No Task Created Yet. You Can Start Creating One with The Button Below </div>
              <?php }?>
              <div class="content"> <a href="<?php echo '?module=project&action=project_add_task&id='.base64_encode($project_id).'&status='.base64_encode($complete_status).''?>" class="btn btn-info btn-fill">Add a New Task</a> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div></div></div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">EDIT PROJECT</h4>
      </div>
      <form id="update_project_form" action="" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <?php foreach($project_list as $data){ ?>
          <label>Project Name
            <?php $project_id=$data->getId(); ?>
          </label>
          <input type="text" class="form-control" placeholder="Project Name" name="pr_name" id="pr_name" value="<?php echo $data->getProjectName(); ?>
" pattern="^[a-zA-Z][a-zA-Z0-9-_\. ]{1,30}$" title="Project name should not be greater than 30 characters and should have only numbers and letters with '_' and '.' allowed" required="required">
          <label>Project Start Date</label>
          <input type="text" class="form-control" id="pr_startdate" name="pr_startdate" placeholder="Select Date" value="<?php $pr_start_date= $data->getProjectStartDate(); 
												echo date('d/m/Y',strtotime($pr_start_date));
												?>" required="required" readonly="readonly">
          <label>Project End Date</label>
          <input type="text" class="form-control" id="pr_enddate" name="pr_enddate" placeholder="Select Date" value="<?php $pr_end_date= $data->getProjectEndDate(); 
												echo date('d/m/Y',strtotime($pr_end_date));
												?>" required="required" readonly="readonly">
          <label>Project Description</label>
          <textarea rows="5" class="form-control" placeholder="Describe your project here" id="pr_desc" name="pr_desc" pattern="^[a-zA-Z][a-zA-Z0-9-_\. ]{1,500}$" title="Project Description should not be greater than 500 characters and should have only numbers and letters with '_' and '.' allowed" required="required"><?php echo $data->getProjectDescription(); ?>
</textarea>
          <label>Special Notes (Non Mandatory)</label>
          <textarea rows="5" class="form-control" placeholder="Add Your remarks here" id="pr_remark" pattern="^[a-zA-Z][a-zA-Z0-9-_\. ]{1,500}$" title="Special Notes should not be greater than 500 characters and should have only numbers and letters with '_' and '.' allowed" name="pr_remark"><?php echo $data->getProjectRemark(); ?>
</textarea>
          <label>Project Status</label>
          <select class="form-control leaderclass" id="pr_status2" name="pr_status2" required>
            <option value="<?php echo $data->getIsCompleted(); ?>" <?php if($data->getIsCompleted()=="1"){ echo "selected='selected'";}?>>In Progress</option>
            <option value="<?php echo $data->getIsCompleted(); ?>" <?php if($data->getIsCompleted()=="2"){ echo "selected='selected'";}?>>No Task Created</option>
            <option value="<?php echo $data->getIsCompleted(); ?>" <?php if($data->getIsCompleted()=="0"){ echo "selected='selected'";}?>>Complete</option>
          </select>
           <?php if($_SESSION['usertype']=='ADMIN'){ ?>
          <label>Project Leader</label>
          <select class="form-control leaderclass" id="pr_leader" name="pr_leader" required>
            <option selected="selected" value="">Select Leader</option>
            <?php $leader=base64_encode($data->getProjectLeader()); ?> 
            <option value="<?php echo base64_encode($_SESSION['user_id']); ?>"<?php if($leader==base64_encode($_SESSION['user_id'])){ echo "selected='selected'";}  ?> ><?php echo $_SESSION['first_name']." ". $_SESSION['last_name']."(SELF)"; ?></option>            
            <?php $i=1;
														foreach($user_list as $data){ ?>
            <option value="<?php echo base64_encode($data->getId()); $user_id=base64_encode($data->getId());?>" <?php if($leader==$user_id){ echo "selected='selected'";}  ?> ><?php echo $data->getFirstName()." ". $data->getLastName(); ?></option>
            <?php } ?>
          </select>
          <?php } else { ?>
          
                    <label>Project Leader</label>
          <select class="form-control leaderclass" id="pr_leader" name="pr_leader" required>
            <option selected="selected" value="">Select Leader</option>
             <option value="<?php echo base64_encode($_SESSION['user_id']); ?>"><?php echo $_SESSION['first_name']." ". $_SESSION['last_name']."(SELF)"; ?></option>
          </select>
          
			<?php } ?>
          <?php } ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-info btn-fill" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-default btn-info btn-fill" onclick="update_project()" >Update</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div id="add_member_modal" class="modal fade" role="dialog">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ADD MEMBER</h4>
      </div>
      <form id="update_project_form" action="" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <?php if(!empty($list_member)){ ?>

          <label>Project Members (Select multiple by holding "ctrl")</label>
          <select class="form-control ownerclass" multiple="multiple" name="project_owner" id="project_owner" required>
            <?php
			
			 $i=1;
							foreach($list_member as $data){?>
            <option value="<?php echo base64_encode($data->getId()); ?>"><?php echo $data->getFirstName()." ". $data->getLastName(); ?></option>
            <?php } ?>
          </select>
			<?php } else { echo "All Memnbers are selected"; }?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-info btn-fill" data-dismiss="modal">Close</button>
           <?php if(!empty($list_member)){ ?>
           <button type="button" class="btn btn-default btn-info btn-fill" onclick="add_member()" >Update</button>
           <?php } ?>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal -->
<div id="delete_member_modal" class="modal fade" role="dialog">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">DELETE MEMBER</h4>
      </div>
      <form id="update_project_form" action="" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <label>Delete Members (Select multiple by holding "ctrl")</label>
          <select class="form-control ownerclass" name="project_owner_2" id="project_owner_2" required>
             <option value="">Select a member</option>

            <?php foreach($project_list as $data){ ?>
			 <?php $owner=$data->getProjectOwner(); 
													$aa=(explode(",",$owner));
													foreach($aa as $bb){
														//echo $bb;
														$owner_result=$obj_user_class_dao->readAll_Byid($bb);
														foreach($owner_result as $data){ ?>
            <option value="<?php echo base64_encode($data->getId()); ?>"><?php echo $data->getFirstName()." ". $data->getLastName(); ?></option>
            <?php }}}?>
          </select>
           
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-info btn-fill" data-dismiss="modal">Close</button>
           <button type="button" class="btn btn-default btn-info btn-fill" onclick="delete_member()" >Delete</button>

        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $(document).ready(function () {
$("#pr_startdate").datepicker({
	dateFormat: "dd/mm/yy",
	 changeMonth: true,
     changeYear: true, 	
                numberOfMonths: 1,
                onSelect: function (selected) {
                    var dt = $(this).datepicker('getDate');
                    //dt.setDate(dt.getDate() + 1);
                    $("#pr_enddate").datepicker("option", "minDate", dt);
                }
            });
            $("#pr_enddate").datepicker({
				dateFormat: "dd/mm/yy",
				 changeMonth: true,
     			changeYear: true,
                numberOfMonths: 1,
                onSelect: function (selected) {
                    var dt = $(this).datepicker('getDate');
                    //dt.setDate(dt.getDate()- 1);
                    $("#pr_startdate").datepicker("option", "maxDate", dt);
                }
            });
          });
	</script>

<script>
function update_project(){
	var pr_id_val = '<?php echo $project_id; ?>';
	var pr_name_val = $("#pr_name").val();		
	var pr_startdate_val = $("#pr_startdate").val();
	var pr_enddate_val = $("#pr_enddate").val();		
	var pr_desc_val = $("#pr_desc").val();		

	var pr_remark_val = $("#pr_remark").val();		
	var pr_status_val = $("#pr_status2").val();		
	var pr_leader_val = $("#pr_leader").val();
	//if( $('#project_owner :selected').length > 0){
        //build an array of selected values
      //  var selectednumbers = [];
        //$('#project_owner :selected').each(function(i, selected) {
          //  selectednumbers[i] = $(selected).val();
        //});		
		//}
		//else{
			//alert("Select Members")
			//exit();
		//}
	//var project_owner_val = selectednumbers;
			var formData={pr_id:pr_id_val,pr_name:pr_name_val,pr_startdate:pr_startdate_val,pr_enddate:pr_enddate_val,
			pr_desc:pr_desc_val,pr_remark:pr_remark_val,pr_status:pr_status_val,pr_leader:pr_leader_val};
			//ajax--START
			$.ajax({url: "ajax/update_project.php",
			beforeSend: function(){	
				//$("#container").html('');
				//block_screen();		
				//loading_show()		
			},		 
			type: "POST",		
			complete: function(){			  
				//loading_hide();
			},  
			data : formData, success: function(result){
				if(result=="1"){
					   //alert("Verifcation completed")
					 $("#main_div").load(" #main_div");
					jQuery("#myModal").modal('hide');

				}
				else if(result=="2"){
					alert("Cannot");
				}
				else if(result=="3"){
					alert("You can");
				}
				else{
					alert(result);
				}
			}});	
		//ajax--END	

}

</script>

<script>
function add_member(){
	var pr_id_val = '<?php echo $project_id; ?>';
	if( $('#project_owner :selected').length > 0){
        //build an array of selected values
       var selectednumbers = [];
        $('#project_owner :selected').each(function(i, selected) {
           selectednumbers[i] = $(selected).val();
        });		
		}
		else{
			alert("Select Members")
			exit();
		}
	var project_owner_val = selectednumbers;
			var formData={pr_id:pr_id_val,project_owner:project_owner_val};
			//ajax--START
			$.ajax({url: "ajax/add_member.php",
			beforeSend: function(){	
				//$("#container").html('');
				//block_screen();		
				//loading_show()		
			},		 
			type: "POST",		
			complete: function(){			  
				//loading_hide();
			},  
			data : formData, success: function(result){
				if(result==1){
					alert("Member Added successfully");
				}
				
			}});	
		//ajax--END	

}

</script> 

<script>
function delete_member(){
	var pr_id_val = '<?php echo $project_id; ?>';
	var project_owner_val = $('#project_owner_2').val();
	if(project_owner_val==''){
			alert("Select A Member")
			exit();
		}
	//var project_owner_val = selectednumbers;
			var formData={pr_id:pr_id_val,project_owner:project_owner_val};
			//ajax--START
			$.ajax({url: "ajax/delete_member.php",
			beforeSend: function(){	
				//$("#container").html('');
				//block_screen();		
				//loading_show()		
			},		 
			type: "POST",		
			complete: function(){			  
				//loading_hide();
			},  
			data : formData, success: function(result){
				if(result==1){
					alert("Member Deleted successfully");
				}
				else if(result==0){
					alert("Sorry cannot delete member. He/She has an incomplete Task");
				}
				
			}});	
		//ajax--END	

}

</script>
 
<script>
  $(document).ready(function(){
$('.leaderclass').on('change', function(event ) {
   var prevValue = $(this).data('previous');
$('.ownerclass').not(this).find('option[value="'+prevValue+'"]').show();    
   var value = $(this).val();
  $(this).data('previous',value); $('.ownerclass').not(this).find('option[value="'+value+'"]').hide();
});
  });
  </script>
<?php } else { echo "<script type='text/javascript'>window.location='?';</script>";
					exit();}?>
