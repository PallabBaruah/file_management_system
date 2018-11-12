                                 <?php if(isset($_SESSION['user_email'])){ ?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Project Details <a href="?module=project&action=project_view" class="btn btn-info btn-fill pull-right"><< Back To Project</a></h4>
                                <!--<p class="category">24 Hours performance</p>-->
                            </div>
                            
                            
                             <div class="content">
                             
                             <?php if(isset($_SESSION['TASK_ADD_SUCCESS'])){?>
							<div class="alert alert-success">
							  <strong>Success!</strong> <?php echo $_SESSION['TASK_ADD_SUCCESS'];$_SESSION['TASK_ADD_SUCCESS']=NULL;?>
                              							</div>

                              <?php } ?>
                                    <?php foreach($project_list as $data){ ?>
                                            <div id="chartHours" class="ct-chart"> 
                                            <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Project Code :</label>
                                                <?php echo $data->getProjectCode(); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Project Name :</label>
                                                <?php echo $data->getProjectName(); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>End Date :</label>
                                                <?php echo $data->getProjectEndDate(); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Status :</label>
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
                                                <?php echo $data->getProjectDescription(); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Project Remarks :</label>
                                                <?php echo $data->getProjectRemark(); ?>
                                            </div>
                                        </div>
                                     </div>
                                     
                                     <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Project Leader :</label>
                                                <?php $leader=$data->getProjectLeader(); ?>
											<?php 

											$list2=$obj_project_class_dao->get_project_leader_name($leader);?>
											<?php foreach($list2 as $data2){ echo $data2['fname']." ".$data2['lname']; }?>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Project Members :</label>
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
                                    	<th>Task Name</th>
                                    	<th>Task Assigned To</th>
                                    	<th>Start Date</th>
                                    	<th>End Date</th>
                                        <th>Priority</th>
                                        <th>Status</th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                     <?php foreach($list as $data){ ?>
                                        <tr>
                                        	<td><?php echo $slno; $task_id=$data->getId();?></td>
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
											<?php foreach($list as $data2){ echo $data2->getFirstName()." ".$data2->getLastName(); }}else {echo "Not Set";}?>
                                            </td>
                                            <td><?php echo $data->getTaskStartDate(); ?></td>
                                            <td><?php	
														$today=time();
														
														$enddate=strtotime($data->getTaskEndDate());
														
														$datediff = $enddate - $today;

														$daysleft = floor($datediff / (60 * 60 * 24));
														
														
														
														if($daysleft <=5 && $daysleft>=0){
														
														echo '<span class="orange">'.$data->getTaskEndDate().'</span>';
														}
														
															elseif($daysleft<0){
														
															echo '<span class="red">'.$data->getTaskEndDate().'</span>';
														}
														
														else {
															
															echo '<span class="green">'.$data->getTaskEndDate().'</span>';
															
														}
											
											 ?></td>
                                            <td><?php  $task_priority=$data->getPriority(); 
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
 
                                            <td>
                                            
                                            <?php $session_project_status=$_SESSION['PROJECT_STATUS']; ?>
                                            <a href="<?php echo '?module=remark&action=view_remark&id='.base64_encode($task_id).'&status='.$session_project_status.''?>" class="btn btn-info btn-fill">Update<br />Task</a></td>        
                                        </tr>
                                        	<?php $slno++; } ?>
                                    </tbody>
                                </table>
                                <?php } else {?>
									
							<div class="alert alert-warning">
							  <strong>Sorry!</strong> No Task Created Yet. You Can Start Creating One with The Button Below
                              							</div>
									
								<?php }?>
                                <div class="content">        
							<a href="<?php echo '?module=project&action=project_add_task&id='.base64_encode($project_id).'&status='.base64_encode($complete_status).''?>" class="btn btn-info btn-fill">Add a New Task</a>
                            </div>
                            </div>
                       
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  <?php } else { echo "<script type='text/javascript'>window.location='?';</script>";
					exit();}?>
