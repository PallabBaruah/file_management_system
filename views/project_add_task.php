                         <?php if(isset($_SESSION['user_email'])){ ?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Create Task <a href="?module=project&action=project_view_task&id=<?php echo base64_encode($project_id); ?>&status=<?php echo base64_encode($project_status);?>" class="btn btn-info btn-fill pull-right"><< Back to Project Details</a></h4>
                            </div>
                            <div class="content">
                                <form name="create_task_form" method="post" action="?module=project&action=project_create_task">
                                                  
                                                        <?php if(isset($_SESSION['ERROR_TASK_ADD'])){?>
							<div class="alert alert-danger">
							  <strong>Sorry!</strong> <?php echo $_SESSION['ERROR_TASK_ADD'];$_SESSION['ERROR_TASK_ADD']=NULL;?>
                              							</div>

                              <?php }?>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                            <input type="hidden" value="<?php echo base64_encode($project_id) ?>" name="project_id" id="project_id"  />
                                            <input type="hidden" value="<?php echo base64_encode($project_status) ?>" name="project_status" id="project_status"  />
                                            
                                             <?php foreach($date as $row){?>
	   
	<input type="hidden" value="<?php  echo  date('d/m/Y', strtotime($row->getProjectStartDate()));?>" name="project_start_date" id="project_start_date"  />
	<input type="hidden" value="<?php  echo  date('d/m/Y', strtotime($row->getProjectEndDate()));?>" name="project_end_date" id="project_end_date"  />
	<?php }?>					
                                             <?php $task_name='';
								if(isset($_SESSION['FORM_FIELDS']['task_name'])){
									 $task_name=$_SESSION['FORM_FIELDS']['task_name'];
								}
								?>
                                                <label>Task Name</label>
                                                <input type="text" class="form-control" placeholder="Task Name" id="task_name" name="task_name" value="<?php echo $task_name; ?>" pattern="^[a-zA-Z][a-zA-Z0-9-_\. ]{1,100}$" title="Task name should not be greater than 100 characters and should have only numbers and letters with '_' and '.' allowed" required="required">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Task Assign To</label>
                                                <select class="form-control" id="task_owner" name="task_owner" required="required">
                                                	<option selected="selected"  value="">Select</option>                                                <?php foreach($list as $data2){
														if($_SESSION['user_id']==$data2['project_leader']){?>
													<?php $owner=$data2['project_owner_id'];
													
													$leader_id=$obj_user_class_dao->readAll_Byid($data2['project_leader']);
														foreach($leader_id as $data){ ?> 
                                                        <option value="<?php echo $data->getId(); ?>"><?php echo $data->getFirstName()." ".$data->getLastName()."(SELF)"; ?></option><?php  }
													$aa=(explode(",",$owner)); ?>
                                                    
													<?php 
													foreach($aa as $bb){
														//echo $bb;
														$list=$obj_user_class_dao->readAll_Byid($bb);
														foreach($list as $data){ ?> 
                                                        <option value="<?php echo $data->getId(); ?>"><?php echo $data->getFirstName()." ".$data->getLastName(); ?></option> 
														<?php 
														}
													} }
													
													else if($_SESSION['usertype']=="ADMIN"){
														$owner=$data2['project_owner_id'];
													
													$leader_id=$obj_user_class_dao->readAll_Byid($data2['project_leader']);
														foreach($leader_id as $data){ ?> 
                                                        <option value="<?php echo $data->getId(); ?>"><?php echo $data->getFirstName()." ".$data->getLastName()."(LEADER)"; ?></option><?php  }
													$aa=(explode(",",$owner)); ?>
                                                    
													<?php 
													foreach($aa as $bb){
														//echo $bb;
														$list=$obj_user_class_dao->readAll_Byid($bb);
														foreach($list as $data){ ?> 
                                                        <option value="<?php echo $data->getId(); ?>"><?php echo $data->getFirstName()." ".$data->getLastName(); ?></option> 
														<?php 
														}
													}
														
													}
													
													else{
														
														 $owner=$_SESSION['user_id'];
													$aa=(explode(",",$owner));
													foreach($aa as $bb){
														//echo $bb;
														$list=$obj_user_class_dao->readAll_Byid($bb);
														foreach($list as $data){ ?> 
                                                        <option value="<?php echo $data->getId(); ?>"><?php echo $data->getFirstName()." ".$data->getLastName()."(SELF)" ?></option> 
														<?php 
														}
													} 
														
														
													}}
													?>
						
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        
                                         <div class="col-md-3">
                                            <div class="form-group">
                                             <?php $task_name='';
								if(isset($_SESSION['FORM_FIELDS']['task_priority'])){
									 $task_priority=$_SESSION['FORM_FIELDS']['task_priority'];
								}
								?>
                                                <label>Task Priority</label>
                                                <select class="form-control" id="task_priority" name="task_priority" required="required">
                                                	<option selected="selected" value="">Select</option>
                                                    <option value="1" <?php if($task_priority=="1"){ echo "selected='selected'";}?>>Normal</option>
                                                    <option value="2" <?php if($task_priority=="2"){ echo "selected='selected'";}?>>Medium</option>
                                                    <option value="3" <?php if($task_priority=="3"){ echo "selected='selected'";}?>>High</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                            <?php $task_start_date='';
								if(isset($_SESSION['FORM_FIELDS']['task_start_date'])){
									 $task_start_date=$_SESSION['FORM_FIELDS']['task_start_date'];
								}
								?>
                                                <label>Task Start Date</label>
                                                <input type="text" class="form-control" placeholder="Select Start Date" id="task_start_date" name="task_start_date" value="<?php echo $task_start_date; ?>" readonly="readonly"  required="required">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                            <?php $task_end_date1='';
								if(isset($_SESSION['FORM_FIELDS']['task_end_date'])){
									 $task_end_date=$_SESSION['FORM_FIELDS']['task_end_date'];
								}
								?>
                                                <label>Task End Date</label>
                                                <input type="text" class="form-control" placeholder="Select End Date" id="task_end_date" name="task_end_date"  value="<?php echo $task_end_date; ?>" readonly="readonly" required="required">
                                            </div>
                                        </div>
                                     </div>
                                         
                                     <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                             <?php $task_desc='';
								if(isset($_SESSION['FORM_FIELDS']['task_desc'])){
									 $task_desc=$_SESSION['FORM_FIELDS']['task_desc'];
								}
								?>
                                                <label>Task Description</label>
                                                <textarea rows="5" class="form-control" placeholder="Describe your project here" id="tas_desc" name="task_desc" pattern="^[a-zA-Z][a-zA-Z0-9-_\. ]{1,500}$" title="Project Description should not be greater than 500 characters and should have only numbers and letters with '_' and '.' allowed" required="required"><?php echo $task_desc; ?></textarea>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                            <?php $task_remark='';
								if(isset($_SESSION['FORM_FIELDS']['task_remark'])){
									 $task_remark=$_SESSION['FORM_FIELDS']['task_remark'];
								}
								?>
                                                <label>Remarks</label>
                                                <textarea rows="5" class="form-control" placeholder="Add Your remarks here" id="task_remark" name="task_remark" pattern="^[a-zA-Z][a-zA-Z0-9-_\. ]{1,500}$" title="Remarks should not be greater than 500 characters and should have only numbers and letters with '_' and '.' allowed" required="required"><?php echo $task_remark; ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Create Task</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    

                </div>
            </div>
        </div>

 
  <script>
  $(document).ready(function () {
	   <?php foreach($date as $row){?>
	   
	var p_st_date = "<?php  echo  date('d/m/Y', strtotime($row->getProjectStartDate())); ?>";

	var p_en_date = "<?php  echo  date('d/m/Y', strtotime($row->getProjectEndDate())); ?>";
	<?php }?>					

$("#task_start_date").datepicker({
	dateFormat: "dd/mm/yy",
	 changeMonth: true,
     changeYear: true,
	  minDate: p_st_date,
      maxDate: p_en_date, 	
                numberOfMonths: 1,
                onSelect: function (selected) {
                    //$("#task_start_date").datepicker("option", "minDate", p_st_date);
                    //$("#task_start_date").datepicker("option", "maxDate", p_en_date);
                    var dt = $(this).datepicker('getDate');										
                    $("#task_end_date").datepicker("option", "minDate", dt);
                }
            });
            $("#task_end_date").datepicker({
				dateFormat: "dd/mm/yy",
				 changeMonth: true,
     			changeYear: true,
                numberOfMonths: 1,
	  			minDate: p_st_date,
      			maxDate: p_en_date, 	
                onSelect: function (selected) {
                    var dt = $(this).datepicker('getDate');
                    //dt.setDate(dt.getDate()- 1);
                    $("#task_start_date").datepicker("option", "maxDate", dt);
                }
            });
          });
	</script>

    <?php } else { echo "<script type='text/javascript'>window.location='?';</script>";
					exit();}?>