                 <?php if(isset($_SESSION['user_email'])){ ?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Your Projects </h4>
                                <p class="category"></p>
                            </div>
                            <hr />
                            <div class="content">
                            <?php if(isset($_SESSION['PROJECT_ADD_SUCCESS'])){?>
							<div class="alert alert-success">
							  <strong>Success!</strong> <?php echo $_SESSION['PROJECT_ADD_SUCCESS'];$_SESSION[			'PROJECT_ADD_SUCCESS']=NULL;?>
                              							</div>
                                        <?php } ?>  
                                        
                             <?php if(isset($_SESSION['PROJECT_DELETE_SUCCESS'])){?>
							<div class="alert alert-success">
							  <strong>Success!</strong> <?php echo $_SESSION['PROJECT_DELETE_SUCCESS'];$_SESSION[			'PROJECT_DELETE_SUCCESS']=NULL;?>
                              							</div>
                                        <?php } ?>   
                             
                             <?php if(isset($_SESSION['PROJECT_DELETE_FAILURE'])){?>
							<div class="alert alert-danger">
							  <strong>Success!</strong> <?php echo $_SESSION['PROJECT_DELETE_FAILURE'];$_SESSION[			'PROJECT_DELETE_FAILURE']=NULL;?>
                              							</div>
                                        <?php } ?>                                      
                           <?php if($_SESSION['usertype']=="ADMIN") {?>
                             <?php if(!empty($list)){ ?>

                                                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <!--<th>Project ID</th>-->
                                    	<th>Project Name</th>
                                    	<th>Project Leader</th>
                                    	<th>Start Date</th>
                                    	<th>End Date</th>
                                        <th>Status</th>
                                        <th>View Details</th>
                                        <th>Delete Project</th>
                                    </thead>
                                    <tbody>
                                                     <?php foreach($list as $data){ ?>
                                        <tr>
                                        	<!--<td><?php echo $data->getProjectCode(); ?></td>-->
                                        	<td><?php echo $data->getProjectName(); ?></td>
                                        	<td><?php $leader=$data->getProjectLeader(); ?>
											<?php 

											$list2=$obj_project_class_dao->get_project_leader_name($leader);?>
											<?php foreach($list2 as $data2){ echo $data2['fname']." ".$data2['lname']; }?>
                                            
                                            </td>
                                        	<td><?php $timestamp=strtotime($data->getProjectStartDate());
													echo date('d/m/Y', $timestamp); ?></td>
                                        	<td><?php
											 			 $today=time();
														 $enddate=strtotime($data->getProjectEndDate());
														
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
                                            <td><?php $project_id=$data->getId();
													$obj_project_details->setProjectId($project_id);
													$result=$obj_project_details_dao->get_is_completed_status_with_id($obj_project_details);		
											 $is_complete=$result;
													if($is_complete==1){
														echo "In Progress";
													}
													elseif($is_complete==2){
														echo "Complete";
														}
													elseif($is_complete==0){
														echo "No Task Created";
														}	
                                            ?>
                                            </td>
                                            <td>
                                            <a href="<?php echo '?module=project&action=project_view_task&id='.base64_encode($project_id).'&status='.base64_encode($is_complete).''?>" class="btn btn-fill btn-info">Details</a></td>
                                             <td><a href="#" data-toggle="modal" data-target="#delete_confirm" class="btn btn-fill btn-info deletebtn" data-id="<?php echo $data->getProjectName();?>" data-href="<?php echo '?module=project&action=project_delete&id='.base64_encode($project_id).''?>">DELETE</a></td>

                                            
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
								<?php } else {?>
									
							<div class="alert alert-warning">
							  <strong>Sorry!</strong> No Projects Created Yet.
                              							</div>
									
								<?php }?>
                            </div>
                       <?php } else { ?>
                       <div class="header">
                                <h4 class="title">Projects Lead By You</h4>
                                <p class="category"></p>
                            </div>
                             <?php if(!empty($result)){ ?>

                        <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <!--<th>Project ID</th>-->
                                    	<th>Project Name</th>
                                    	<th>Project Leader</th>
                                    	<th>Start Date</th>
                                    	<th>End Date</th>
                                        <th>Status</th>
                                        <th>View Details</th>
                                    </thead>
                                    <tbody>
                                                     <?php foreach($result as $data){ ?>
                                        <tr>
                                        	<!--<td><?php echo $data->getProjectCode(); ?></td>-->
                                        	<td><?php echo $data->getProjectName(); ?></td>
                                        	<td><?php $leader=$data->getProjectLeader(); ?>
											<?php 

											$list2=$obj_project_class_dao->get_project_leader_name($leader);?>
											<?php foreach($list2 as $data2){ echo $data2['fname']." ".$data2['lname']; }?>
                                            
                                            </td>
                                        	<td><?php $timestamp=strtotime($data->getProjectStartDate());
													echo date('d/m/Y', $timestamp);?></td>
                                        	<td><?php
											 			 $today=time();
														 $enddate=strtotime($data->getProjectEndDate());
														
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
                                            <td><?php $project_id=$data->getId();
													$obj_project_details->setProjectId($project_id);
													$result=$obj_project_details_dao->get_is_completed_status_with_id($obj_project_details);		
											 $is_complete=$result;
													if($is_complete==1){
														echo "In Progress";
													}
													elseif($is_complete==2){
														echo "Complete";
														}
													elseif($is_complete==0){
														echo "No Task Created";
														}	
                                            ?>
                                            </td>
                                            <td>
                                            <a href="<?php echo '?module=project&action=project_view_task&id='.base64_encode($project_id).'&status='.base64_encode($is_complete).''?>" class="btn btn-fill btn-info">Details</a></td>

                                            </td>
                                            
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                            </div>
                            <?php } else {?>
									
							<div class="alert alert-warning">
							  <strong>Sorry!</strong> You Donot Lead Any Project
                              							</div>
									
								<?php }?>
                            <div class="header">
                                <h4 class="title">Projects You are a Member</h4>
                                <p class="category"></p>
                            </div>
                             <?php if(!empty($user_task_result)){ ?>
                        <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <!--<th>Project ID</th>-->
                                    	<th>Project Name</th>
                                    	<th>Project Leader</th>
                                    	<th>Start Date</th>
                                    	<th>End Date</th>
                                        <th>Status</th>
                                        <th>View Details</th>
                                    </thead>
                                    <tbody>
                                                     <?php foreach($user_task_result as $data){ ?>
                                        <tr>
                                        	<!--<td><?php echo $data->getProjectCode(); ?></td>-->
                                        	<td><?php echo $data->getProjectName(); ?></td>
                                        	<td><?php $leader=$data->getProjectLeader(); ?>
											<?php 

											$list2=$obj_project_class_dao->get_project_leader_name($leader);?>
											<?php foreach($list2 as $data2){ echo $data2['fname']." ".$data2['lname']; }?>
                                            
                                            </td>
                                        	<td><?php $timestamp=strtotime($data->getProjectStartDate());
													echo date('d/m/Y', $timestamp);?></td>
                                        	<td><?php
											 			 $today=time();
														 $enddate=strtotime($data->getProjectEndDate());
														
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
                                            <td><?php $project_id=$data->getId();
													$obj_project_details->setProjectId($project_id);
													$result=$obj_project_details_dao->get_is_completed_status_with_id($obj_project_details);		
											 $is_complete=$result;
													if($is_complete==1){
														echo "In Progress";
													}
													elseif($is_complete==2){
														echo "Complete";
														}
													elseif($is_complete==0){
														echo "No Task Created";
														}	
                                            ?>
                                            </td>
                                            <td>
                                            <a href="<?php echo '?module=project&action=project_view_task&id='.base64_encode($project_id).'&status='.base64_encode($is_complete).''?>" class="btn btn-fill btn-info">Details</a></td>
                                            
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                            </div>
                             <?php } else {?>
									
							<div class="alert alert-warning">
							  <strong>Sorry!</strong> Yor Are Not a Member Yet in Any Project.
                              							</div>
									
								<?php }?>
                            
                            
                            <?php } ?>
                       
                       
                       
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!--DELETE CONFIRMATION MODEL STARTS HERE-->
<div class="modal fade" id="delete_confirm" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title" id="login">Delete Confirmation</h4>
        </div>
        <div class="modal-body">
            Are you sure you want to delete <span id='project-name' style="color:#F00;"></span> ? This is an irreversable change.
        </div>
        <div class="modal-footer">
            <button data-dismiss="modal" type="button" class="btn btn-default" id="cancel">Cancel</button>
            <a class="btn btn-danger btn-ok">Delete</a>
        </div>
    </div>
</div>
<!--DELETE CONFIRMATION MODEL ENDS HERE-->
<script>
$('#delete_confirm').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
</script>
<script>
$(document).ready(function () {             
    $('.deletebtn').click(function(){
        $('#project-name').html($(this).data('id'));

    });
});
</script>
<?php } else { echo "<script type='text/javascript'>window.location='?';</script>";
					exit();}?>