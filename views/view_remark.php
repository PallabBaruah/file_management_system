                                 <?php if(isset($_SESSION['user_email'])){ ?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                            <?php  $project_id=$_SESSION['PROJECT_ID'];
									$project_status=$_SESSION['PROJECT_STATUS']; ?>
                                <h4 class="title">Task Details<a href="?module=project&action=project_view_task&id=<?php echo $project_id; ?>&status=<?php echo $project_status;?>" class="btn btn-info btn-fill pull-right"><< Back to Project Details</a></h4>
                                    <hr>
                                    <div class="content">
                                    <?php $obj_user->setId(base64_decode($project_id));
												$projectdata=$obj_user_dao->getProjectById($obj_user);
												foreach($projectdata as $data){
													$projectname= $data->getProjectName();
													$projectdesc=$data->getProjectDescription();
												}
												?>
                                    <?php foreach($result2 as $data){ 
												$obj_user->setId($data->getProjectId());
												$date=$obj_user_dao->get_project_start_end_date_by_project_id($obj_user);
												
									?>
                                            <div id="chartHours" class="ct-chart"> 
                                            <div class="row">
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Project Name :</label>
                                                <?php echo $projectname ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Project Description :</label>
                                                <?php echo $projectdesc; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Task Name :</label>
                                                <?php echo $data->getTaskName(); ?>
                                                <?php $task_id2=$data->getId(); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Start Date :</label>
                                                <?php echo $data->getTaskStartDate(); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>End Date :</label>
                                                <?php echo $data->getTaskEndDate(); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Priority :</label>
                                                <?php $task_priority=$data->getPriority(); 
												if($task_priority==1){
														echo "<span class='green'>Normal</p>";
													}
													elseif($task_priority==2){
														echo "<span class='orange'>Medium</p>";
														}
													elseif($task_priority==3){
														echo "<span class='red'>High</p>";
														}
													else{ echo "Not Set"; }		
									}?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Task Description :</label>
                                                <?php echo $data->getTaskDescription(); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Task Remarks :</label>
                                                <?php echo $data->getRemarks(); ?>
                                            </div>
                                        </div>
                                     </div>
                                     
                                     <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Task Assigned To :</label>
                                                <?php 
											$leader=$data->getUserId();
											$list2=$obj_user_dao->get_project_leader_name($leader);?>
										<?php foreach($list2 as $data2){ echo $data2['fname']." ".$data2['lname']; }?>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Task Delegated To :</label>
                                                <?php 
											$leader=$data->getDelegatedId();
											$list2=$obj_user_dao->get_project_leader_name($leader);?>
										<?php foreach($list2 as $data2){ echo $data2['fname']." ".$data2['lname']; }?>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Task Status :</label>
                                                <?php $is_complete=$data->getIsCompleted();
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
											 ?>
                                            </div>
                                        </div>
                                     </div>                       
                                    	
                                  	</div>
                                             <div class="footer">
                                    			<hr>
                                			</div>
                                    </div>
                                                                 <div class="header">
                                <h4 class="title">PREVIOUS UPDATES</h4>
                                    			<hr>                                
                            </div>
                            <?php if(!empty($result)){ ?>
                            <ul class="pagination">
                                <?php 
								$is_complete2=base64_encode($is_complete);
								$task_id3=base64_encode($task_id2);
								echo "<li><a href='?module=remark&action=view_remark&id=$task_id3&status=$is_complete2&page=1'>".'FIRST<<'."</a></li> ";  // Goto 1st page ?>   
<?php for ($i=1; $i<=$number_of_pages; $i++) { ?>
            <li class="<?php if($page==$i){ echo "active";} else {echo""; }?>"> <?php echo " <a href='?module=remark&action=view_remark&id=$task_id3&status=$is_complete2&page=".$i."'>".$i."</a></li> "; 
}; ?>
<?php 
echo "<li><a href='?module=remark&action=view_remark&id=$task_id3&status=$is_complete2&page=$number_of_pages'>".'>>LAST'."</a><li> "; // Goto last page
?>
</ul>
                            
                                    <table class="table table-hover table-striped">
                                    <thead>
										<th>SL.No</th>
                                        <th>Project Name</th>
                                        <th>Task Name</th>                                            
                                        <th>Updated By</th>
                                    	<th>Updated On</th>
                                    	<th>Remarks</th>
                                        <th>Delegated To</th>
                                        <th>Priority</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Status</th>
                                        <th>Download File</th>                                        
                                    </thead>
                                    <tbody>
                                                     <?php
													 //$slno=1;
													  foreach($result as $data){
														  $task_id=$data->getTaskId();
														   ?>
                                                      
                                                       
                                        <tr>
                                        	<td><?php echo $slno; ?></td>
                                            <td><?php foreach($projectdata as $projectdata2){
												echo $projectdata2->getProjectName(); } ?></td>
                                            <td><?php foreach($result2 as $data2){
												echo $data2->getTaskName();
												}?></td>    
                                        	<td><?php  $createdby=$data->getCreatedBy();
													if($createdby!='')
													{echo $createdby;}
													else
													{
														echo "Not Set";
													}
											
											?></td>
                                        	<td><?php echo $data->getCreatedDate(); ?></td>
                                            <td><?php echo $data->getRemarks(); ?></td>
                                            <td><?php 
											$leader=$data->getDelegatedId();
											if($leader!=0){
											$list2=$obj_user_dao->get_project_leader_name($leader);?>
										<?php foreach($list2 as $data2){ echo $data2['fname']." ".$data2['lname']; } } else {echo "Not Set";}?></td>
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
													else{ echo "Not Set"; }		
											?></td>
                                            <td><?php echo $data->getChangeStartDate(); ?></td>
                                            <td><?php echo $data->getChangeEndDate(); ?></td>
                                            <td><?php $is_complete=$data->getStatus(); 
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
													else{ echo "Not Set";}	
											
											?></td> 
                                        	<td><?php $abc =  $data->getRemarkLink();
													
													if($abc!=""){
													?>
													 
                                                    
													<?php echo "<a href='uploads/download1.php?nama=".$abc."' target='_blank'>Download File</a>"; ?>
                                                    
                                                    <?php } else {echo "No File added";}?> </td>
                                        </tr>
                                        <?php $slno++; } ?>
                                    </tbody>
                                </table>
                                <?php } else {?>
									
							<div class="alert alert-warning">
							  <strong>Sorry!</strong> No Updates Created Yet.
                              							</div>
									
								<?php }?>
                                	
                                    <div class="header">
                                <h4 class="title">UPDATE TASK</h4>
                                    			<hr>                                
                            </div>
                                    <div class="content">
                                <form name="create_project_form" method="post" action="?module=remark&action=create_remark" enctype="multipart/form-data">
                                <?php if(isset($_SESSION['REMARK_ADD_SUCCESS'])){?>
							<div class="alert alert-success">
							  <strong>Success!</strong> <?php echo $_SESSION['REMARK_ADD_SUCCESS'];$_SESSION['REMARK_ADD_SUCCESS']=NULL;?>
                              							</div>
                                        <?php } ?>                 
                                                        <?php if(isset($_SESSION['ERROR_REMARK_ADD'])){?>
							<div class="alert alert-danger">
							  <strong>Sorry!</strong> <?php echo $_SESSION['ERROR_REMARK_ADD'];$_SESSION['ERROR_REMARK_ADD']=NULL;?>
                              							</div>

                              <?php } ?>
                              <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                             <?php foreach($result2 as $data){ ?>
                                                <label>Write a remark (MANDATORY)</label>
                                                <textarea rows="5" class="form-control" placeholder="Place Your Remark About The Task" id="text_remark" name="text_remark" required="required"></textarea>
                                            </div>
                                        </div>
                               </div>   
                              <div class="row">                                     
                                        <div class="col-md-12">
                                            <div class="form-group col-md-3">
                                                 <label>Add a file (Max Size 300MB)</label>
                                                <input name="file" id="file" type="file" class="form-control"/>
                                            </div>
                                            <div class="file-type col-md-6">
                                            <img src="assets/img/jpg_ico.png" width="20" >
                                             <img src="assets/img/pdf-file.png" width="20" >
                                              <img src="assets/img/word_ico.png" width="20" >
                                               <img src="assets/img/xlsx_ico.png" width="20" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                           
                                            <input name="task_id" id="task_id" type="hidden" value="<?php echo $data->getId(); ?>"/>
                                                <label>Delegate Task To</label>
                                                <select class="form-control" id="delegated_to" name="delegated_to">
                                                	<option selected="selected"  value="">Select</option>                                                	
                                                <?php 
													$list=$obj_user_dao->get_project_owner_from_project_id(base64_decode($project_id));

												foreach($list as $data2){?>
                                                <?php $leader_id=$obj_user_class_dao->readAll_Byid($data2['project_leader']);
														foreach($leader_id as $data){ ?> 
                                                        <option value="<?php echo $data->getId(); ?>"><?php echo $data->getFirstName()." ".$data->getLastName(); ?></option><?php  } ?>
													<?php $owner=$data2['project_owner_id'];
													$aa=(explode(",",$owner));
													foreach($aa as $bb){
														//echo $bb;
														$list=$obj_user_class_dao->readAll_Byid($bb);
														foreach($list as $data){ ?> 
                                                        <option value="<?php echo $data->getId(); ?>"><?php echo $data->getFirstName()." ".$data->getLastName(); ?></option> 
														<?php 
														}
													} } }
													?>
						
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                            <?php  foreach($result2 as $data){ ?>
                                                <label for="exampleInputEmail1">Change Start Date</label>
                                               
                                               <input type="text" class="form-control" id="task_startdate" name="task_startdate" placeholder="Select Date" required="required" readonly="readonly" value="<?php echo $data->getTaskStartDate();  }?>">
                                            </div>
                                        </div>
                                       
                                       
                                       
                                        <div class="col-md-4">
                                            <div class="form-group">
                                            <?php  foreach($result2 as $data){ ?>
                                                <label for="exampleInputEmail1">Change End Date</label>
                                               <input type="text" class="form-control" id="task_enddate" name="task_enddate" placeholder="Select Date" required="required" readonly="readonly" value="<?php echo $data->getTaskEndDate();  }?>">
                                               
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                     	<div class="col-md-4">
                                            <div class="form-group">
                                                <label>Change Priority</label>
                                                <select class="form-control" id="change_task_priority" name="change_task_priority">
                                                	<option selected="selected" value="">Select</option>
                                                    <?php  foreach($result2 as $data){ $task_priority=$data->getPriority(); ?>
												
                                                    <option value="1" <?php if($task_priority==1) {?> selected="selected"<?php }?>>Normal</option>
                                                    <option value="2" <?php if($task_priority==2) {?> selected="selected"<?php }?>>Medium</option>
                                                    <option value="3" <?php if($task_priority==3) {?> selected="selected"<?php }?>>High</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Change Status</label>
                                                <select class="form-control" id="change_task_status" name="change_task_status">
                                                	<option selected="selected" value="">Select</option>
                                                    <?php  foreach($result2 as $data){ $is_complete=$data->getIsCompleted(); ?>
                                                    <option value="1" <?php if($is_complete==1) {?> selected="selected"<?php }?>>In Progress</option>
                                                    <option value="2" <?php if($is_complete==2) {?> selected="selected"<?php }?>>Complete</option>
                                                    <option value="3" <?php if($is_complete==3) {?> selected="selected"<?php }?>>Require Assistance</option>
                                                    <option value="4" <?php if($is_complete==4) {?> selected="selected"<?php }?>>Not Started</option>
                                                    <option value="5" <?php if($is_complete==5) {?> selected="selected"<?php } }?>>Invalid Task</option>
                                                </select>
                                            </div>
                                        </div>
									</div>
                                    
                                    <button type="submit" class="btn btn-info btn-fill pull-right" disabled="" name="update_task" id="update_task">Update Task</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        		</div>
                    		</div>
                        </div>
                    </div>
                </div>



 
            </div>
        </div>
        
<script>
$(document).ready(function () {
	<?php foreach($date as $row){?>
	var p_st_date = "<?php  echo  $row->getProjectStartDate(); ?>";

	var p_en_date = "<?php  echo $row->getProjectEndDate(); ?>";

	<?php }?>
	<?php foreach($result2 as $data){?>
		var task_strt_date = "<?php  echo $data->getTaskStartDate(); ?>";
		<?php }?>
$("#task_startdate").datepicker({
	dateFormat: "yy-mm-dd",
	 changeMonth: true,
     changeYear: true,
	  minDate: p_st_date,
      maxDate: p_en_date,
                numberOfMonths: 1,
                onSelect: function (selected) {
                    //$("#task_start_date").datepicker("option", "minDate", p_st_date);
                    //$("#task_start_date").datepicker("option", "maxDate", p_en_date);
                    var dt = $(this).datepicker('getDate');										
                    $("#task_enddate").datepicker("option", "minDate", dt);
                }
            });
            $("#task_enddate").datepicker({
				dateFormat: "yy-mm-dd",
				 changeMonth: true,
     			changeYear: true,
                numberOfMonths: 1,
	  			minDate: task_strt_date,
      			maxDate: p_en_date, 	
                onSelect: function (selected) {
                    var dt = $(this).datepicker('getDate');
                    //dt.setDate(dt.getDate()- 1);
                    $("#task_startdate").datepicker("option", "maxDate", dt);
                }
            });
          });

  </script>
  
  <!--<script>
  $('form[name=""]')
		.each(function(){
			$(this).data('serialized', $(this).serialize())
		})
        .on('change input', function(){
            $(this)				
                .find('input:submit, button:submit')
                    .attr('disabled', $(this).serialize() == $(this).data('serialized'))
            ;
         })
		.find('input:submit, button:submit')
			.attr('disabled', true)
	;
  </script>-->
  <script>
  $(document).ready(function() {
		$('#update_task').attr('disabled', true);
		$('textarea,#change_task_priority,#change_task_status').on('keyup change',function() {
    		var text_remark = $("#text_remark").val();
    		var change_task_priority = $("#change_task_priority").val();
    		var change_task_status = $("#change_task_status").val();
			var task_enddate = $("#task_enddate").val();			
    		if(text_remark != '' && change_task_priority != '' && change_task_status!='' && task_enddate!='') {
        		$('#update_task').attr('disabled' , false);
    		}else{
        		$('#update_task').attr('disabled' , true);
    			}
			});

		});
  </script>
    <?php } else { echo "<script type='text/javascript'>window.location='?';</script>";
					exit();}?>
