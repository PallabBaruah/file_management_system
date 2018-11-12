                         <?php if(isset($_SESSION['user_email'])){ ?>
<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Create New Project</h4><br />
                                <p class="category">You can create a new project here. In this system, a new project is a
                                broad task that will have multiple mini tasks that one needs to track and complete in order to complete the broad task.</p><br />
                                <p class="category"><span class="orange">** All fields in this form are Mandatory Except "Special Notes"</span></p>
                            </div>
                            <hr />
                            <div class="content">
                                <form name="create_project_form" method="post" action="?module=project&action=create_project">
                                  
                                                        <?php if(isset($_SESSION['ERROR_PROJECT_ADD'])){?>
							<div class="alert alert-danger">
							  <strong>Sorry!</strong> <?php echo $_SESSION['ERROR_PROJECT_ADD'];$_SESSION[			'ERROR_PROJECT_ADD']=NULL;?>
                              							</div>

                              <?php } ?>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                            <label>Project Name</label>
                                            <?php $projectname='';
								if(isset($_SESSION['FORM_FIELDS']['project_name'])){
									$projectname=$_SESSION['FORM_FIELDS']['project_name'];
								}
								
								?>
                                                
                                                <input type="text" class="form-control" placeholder="Project Name" name="pr_name" id="pr_name" value="<?php echo $projectname;?>"
                                                 pattern="^[a-zA-Z][a-zA-Z0-9-_\. ]{1,30}$"
                                                 title="Project name should not be greater than 30 characters and should have only numbers and letters with '_' and '.' allowed" required="required">
                                            </div>
                                        </div>
                                        <!--<div class="col-md-4">
                                            <div class="form-group">
                                                <label>Project Code</label>
                                                <input type="text" class="form-control" placeholder="Project Code" name="pr_code" id="pr_code" required="required">
                                            </div>
                                        </div>-->
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Project Start Date</label>
                                                <?php $project_start_date='';
								if(isset($_SESSION['FORM_FIELDS']['project_start_date'])){
									 $project_start_date=$_SESSION['FORM_FIELDS']['project_start_date'];
								}
								?>
                                                <input type="text" class="form-control" id="pr_startdate" name="pr_startdate"
                                                 placeholder="Select Date" value="<?php echo $project_start_date;?>" required="required" readonly="readonly">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Project End Date</label>
                                                <?php $project_end_date='';
								if(isset($_SESSION['FORM_FIELDS']['project_end_date'])){
									 $project_end_date=$_SESSION['FORM_FIELDS']['project_end_date'];
								}
								?>
                                                <input type="text" class="form-control" id="pr_enddate" name="pr_enddate"
                                                 placeholder="Select Date" value="<?php echo $project_end_date;?>" required="required" readonly="readonly">
                                            </div>
                                        </div>
                                     </div>
                                         

                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                            
                                            <label>Project Description</label>
                                            <?php $projectdesc='';
								if(isset($_SESSION['FORM_FIELDS']['project_desc'])){
									 $projectdesc=$_SESSION['FORM_FIELDS']['project_desc'];
								}
								?>
                                                <textarea rows="5" class="form-control" placeholder="Describe your project here"
                                                 id="pr_desc" name="pr_desc" pattern="^[a-zA-Z][a-zA-Z0-9-_\. ]{1,500}$"
                                                  title="Project Description should not be greater than 500 characters and should have only numbers and letters with '_' and '.' allowed"
                                                 required="required"><?php echo $projectdesc;?></textarea>
                                                
                                            </div>
                                        </div>
                                    </div>
                                <?php if($_SESSION['usertype']=='ADMIN'){ ?>
                                    
                                     <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <label>Project Leader</label>
                                                <select class="form-control leaderclass" id="pr_leader" name="pr_leader" required>
                                                	<option selected="selected"  value="">Select Leader</option>
                                                	<option value="<?php echo base64_encode($_SESSION['user_id']); ?>"><?php echo $_SESSION['first_name']." ". $_SESSION['last_name']."(SELF)"; ?></option>
												
                                                 <?php $i=1;
														foreach($admin_list as $data){ ?>    																	
                                                    <option value="<?php echo base64_encode($data->getId()); ?>"><?php echo $data->getFirstName()." ". $data->getLastName()."(ADMIN)"; ?></option>
                                                    <?php } ?>
                                                
                                                 <?php $i=1;
														foreach($user_list as $data){ ?>    																	
                                                    <option value="<?php echo base64_encode($data->getId()); ?>"><?php echo $data->getFirstName()." ". $data->getLastName(); ?></option>
                                                    <?php } ?>
                                                    
                                                   
                                                </select>
                                               
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                 <label>Project Members (Select multiple by holding "ctrl")</label>
                                                <select class="form-control ownerclass" multiple="multiple" name="project_owner[]" id="project_owner[]" required>
  												<option value="<?php echo base64_encode($_SESSION['user_id']); ?>"><?php echo $_SESSION['first_name']." ". $_SESSION['last_name']."(SELF)"; ?></option>

                                                
                                                <?php $i=1;
														foreach($admin_list as $data){ ?>    																	
                                                    <option value="<?php echo base64_encode($data->getId()); ?>"><?php echo $data->getFirstName()." ". $data->getLastName()."(ADMIN)"; ?></option>
                                                    <?php } ?>	
                                                 <?php $i=1;
														foreach($user_list as $data){ ?>    																	
                                                    <option value="<?php echo base64_encode($data->getId()); ?>"><?php echo $data->getFirstName()." ". $data->getLastName(); ?></option>
                                                    <?php } ?>
                                                    
												</select>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } else { ?>
                                                                         <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <label>Project Leader</label>
                                                <select class="form-control leaderclass" id="pr_leader" name="pr_leader" required>
                                                	<option selected="selected"  value="">Select Leader</option>
                                                	<option value="<?php echo base64_encode($_SESSION['user_id']); ?>"><?php echo $_SESSION['first_name']." ". $_SESSION['last_name']."(SELF)"; ?></option>
                                                </select>
                                               
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                 <label>Project Members (Select multiple by holding "ctrl")</label>
                                                <select class="form-control ownerclass" multiple="multiple" name="project_owner[]" id="project_owner[]" required>
  												<option value="<?php echo base64_encode($_SESSION['user_id']); ?>"><?php echo $_SESSION['first_name']." ". $_SESSION['last_name']."(SELF)"; ?></option>
	
                                                 <?php $i=1;
														foreach($user_list as $data){ ?>    																	
                                                    <option value="<?php echo base64_encode($data->getId()); ?>"><?php echo $data->getFirstName()." ". $data->getLastName(); ?></option>
                                                    <?php } ?>
												</select>
                                            </div>
                                        </div>
                                    </div>

								<?php } ?>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Special Notes (Non Mandatory)</label>
                                                <?php $project_remark='';
								if(isset($_SESSION['FORM_FIELDS']['project_remark'])){
									 $project_remark=$_SESSION['FORM_FIELDS']['project_remark'];
								}
								?>
                                                <textarea rows="5" class="form-control" placeholder="Add Your remarks here" id="pr_remark"
                                                 pattern="^[a-zA-Z][a-zA-Z0-9-_\.\@ ]{1,500}$"
                                                  title="Special Notes should not be greater than 500 characters and should have only numbers and letters with '_' and '.' allowed"
                                                   name="pr_remark"><?php echo $project_remark; ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Create Project</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
   
 <!--<script>
$(document).ready(function () {

    $("#pr_startdate1").datepicker({
        dateFormat: "yy/mm/dd",
        minDate: 0,
        onSelect: function (date) {
            var dt2 = $('#pr_enddate1');
            var startDate = $(this).datepicker('getDate');
            var minDate = $(this).datepicker('getDate');
            dt2.datepicker('setDate', minDate);
            startDate.setDate(startDate.getDate() + 180000000);
            dt2.datepicker('option', 'maxDate', startDate);
            dt2.datepicker('option', 'minDate', minDate);
            $(this).datepicker('option', 'minDate', minDate);
			
        }
    });
    $('#pr_enddate1').datepicker({
        dateFormat: "yy/mm/dd"
    });
});
  </script>-->
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