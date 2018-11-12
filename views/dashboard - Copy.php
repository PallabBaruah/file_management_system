         
		 
		 <?php if(isset($_SESSION['user_email'])){ ?>
        <div class="content dashboard">
            <div class="container-fluid">
<div class="col-lg-4 col-sm-4 col-xs-12">
<div class="card">
 
  <div class="card-content">  
  <div class="row">
                            <div class="col-xs-3">
                                <div class="icon-big icon-warning text-center">
                                   <i class="pe-7s-graph"></i>
                                </div>
                            </div>
                            <div class="col-xs-9">
                                <div class="numbers">
            	 <?php foreach($count_active_projects as $row) { 

                                	echo "<span>Total Active Project:</span>{$row['total_projects']}<br/>";
                  } ?>

                  <?php foreach($count_overdue_projects as $row) { 
                      
                                	echo "<span>Total Over Due Projects:</span>{$row['overdue_projects']}</br>";
                  } ?>


                  <?php foreach($count_active_projects_member as $row) { 

                                  echo "<span>Total Active Project(as Member):</span>{$row['total_member_projects']}<br/>";
                  } ?>
                  </div></div>
                  </div></div>
<div class="card-footer">
                        <hr>
                        <div class="stats">
                           <span class="pe-7s-angle-right-circle" ></span> Projects Details
                        </div>
                    </div>
</div></div>



<div class="clearfix"></div>

            
<!--<div class="col-lg-12 col-sm-6 col-xs-12">
	<div class="card">
		<div class="card-header">
			<div class="numbers pull-left">
           			Today's Task<br />
			</div>
        </div>
  				<div class="card-content">  
              
                		<table class="table">
                			<?php if($todays_task == 0){?>

                  			<tr>
                            	<td>No Task for today</td>
                           	</tr>

                 <?php } foreach($todays_task as $row) { ?>

                			<thead>
                				<tr><th>Project Name</th>
                					<th>Task Name</th>
                					<th>Task Description</th>
              
                				</tr>
                			</thead>
                			<tbody>
                            <?php foreach($todays_task as $row) { 



                       
                  					$project_id= $row['project_id'];

									$obj_project_class->setId($project_id);

				
									$project_name=$obj_project_class_dao->getProjectById($obj_project_class);
									
									
                  						} ?>
                				<tr>
                					<td><?php foreach ($project_name as $data) {
					
									echo $data->getProjectName();
									} ?> </td>
                					<td><?php echo "{$row['task_name']} ";?></td>
                					<td><?php echo "{$row['task_description']}";?></td>
                
                				</tr>
				 			<?php } ?> 

                			</tbody>
               		</table>
				</div>
	</div>
</div>-->

<div class="col-lg-12 col-sm-6 col-xs-12">
	<div class="card">
		<div class="card-header">
			<div class="numbers pull-left">
           			Pending Tasks of Projects<br />
			</div>
        </div>
        <div class="card-content">
        			<div class="row">
                      	<div class="col-md-6">
            <form action="?module=dashboard&action=show_pending" method="post">
            	<select  class="form-control" id="project_name" name="project_name" required="required">
						<option selected="selected" value="">Select Project</option>
                        <?php if($_SESSION['usertype']=="USER"){ ?>
                        <?php foreach ($user_task_result as $row){?>
                        <option value="<?php echo $row->getId(); ?>"><?php echo $row->getProjectName(); ?></option>
							
						<?php } ?>
                        
                        <?php foreach ($projects_by_leader as $row){?>
                        <option value="<?php echo $row->getId(); ?>"><?php echo $row->getProjectName(); ?></option>
							
						<?php } ?>
						<?php }?>
                        
                        <?php if($_SESSION['usertype']=="ADMIN"){ ?>
                        <?php foreach ($projects_by_admin as $row){?>
                        <option value="<?php echo $row->getId(); ?>"><?php echo $row->getProjectName(); ?></option>
							
						<?php } ?>
						<?php }?>
				</select>  
            	
                <input name="" class="btn btn-info btn-fill pull-left" type="Submit" value="Search" />
            </form>
            	</div>
            </div>
		</div><br />
        <!--<ul class="pagination">
                                <?php 
								//echo "<li><a href='?module=dashboard&action=list&page=1'>".'FIRST<<'."</a></li> ";  // Goto 1st page ?>   
<?php //for ($i=1; $i<=$number_of_pages; $i++) { ?>
            <li class="<?php //if($page==$i){ echo "active";} else {echo""; }?>"> <?php echo " <a href='?module=dashboard&action=list&page=".$i."'>".$i."</a></li> "; 
//}; ?>
<?php 
//echo "<li><a href='?module=dashboard&action=list&page=$number_of_pages'>".'>>LAST'."</a><li> "; // Goto last page
?>
</ul>-->
  				<div class="card-content">  
             	 <?php
				 
				 if($action == "list"){?>
					 <table class="table">
                    <tr>
                            	<td>No Project Selected</td>
                           	</tr>
                    </table>
				<?php  } else{
			  if(empty($result)){
				  
				  echo "No Pending Task for this Project";
				}
				else{ ?>
                		<table class="table">
                			
                			<thead>
                				<tr><th>Project Name</th>
                					<th>Task owner</th>
                					<th>Task Name</th>
                                    <th>Task Start Date</th>
									<th>Task End Date </th>

              
                				</tr>
                			</thead>
                			<tbody>
                            <?php 
							
				
				//$obj_task_details->setUserId($_SESSION['user_id']);
				
							foreach($result as $data){
							$owner= $data->getProjectOwner();
							$aa=(explode(",",$owner));
								foreach($aa as $bb){
								
								$obj_task_details->setUserId($bb);
								$pending_task_details=$obj_task_details_dao->read_pending_task_by_user_id($obj_task_details);
								
								foreach($pending_task_details as $data){?>
                                <tr>

									
								<td><?php  $project_id2=$data->getProjectId();
                                $obj_project_class->setId($project_id2);
				
									$project_name=$obj_project_class_dao->getProjectById($obj_project_class);
									
									foreach ($project_name as $row) {
					
									echo $row->getProjectName();
									}?>
                                 </td>
									
									
									<td><?php $leader=$data->getUserId(); ?>
                                    
                                    <?php 

											$list2=$obj_project_class_dao->get_project_leader_name($leader);?>
											<?php foreach($list2 as $data2){ echo $data2['fname']." ".$data2['lname']; }?>
                                    </td>
									 <td><?php echo $data->getTaskName(); ?></td>
                                     
                                     <td><?php echo $data->getTaskStartDate(); ?></td>
                                     
                                     <td><?php echo $data->getTaskEndDate(); ?></td>
                
                				</tr>
				 			
							
							<?php } }}?>
				
							
                			</tbody>
               		</table>
                    <?php } }?>
				</div>
	</div>
</div>



            
<div class="col-lg-12 col-sm-6 col-xs-12">
	<div class="card">
		<div class="card-header">
			<div class="numbers pull-left">
           			Projects Over Due<br />
			</div>
        </div>
        
  				<div class="card-content">  
              
                		<table class="table">
                			<?php if($overdue_project_details == 0){?>

                  			<tr>
                            	<td>No Projects Overdue</td>
                           	</tr>

                 <?php } foreach($overdue_project_details as $row) { ?>

                			<thead>
                				<tr><th>Project Name</th>
                					<th>Project Start Date</th>
                					<th>Project End Date</th>
                					<th>Project Overdue in Days</th>
              
                				</tr>
                			</thead>
                			<tbody> 
                				<tr>
                					<td><?php echo "{$row['project_name']}";?> </td>
                					<td><?php echo "{$row['project_start_date']} ";?></td>
                					<td><?php echo "{$row['project_end_date']}";?></td>
                					<td><?php echo "{$row['overdue']}";?></td>
                
                				</tr>
				 			<?php } ?> 

                			</tbody>
               		</table>
				</div>
	</div>
</div>

<div class="col-lg-12 col-sm-6 col-xs-12">
	<div class="card">
		<div class="card-header">
			<div class="numbers pull-left">
           			Task Over Due<br />
			</div>
        </div>
        
        <div class="card-content">
        			<div class="row">
                      	<div class="col-md-6">
            <form action="?module=dashboard&action=task_overdue" method="post">
            	<select  class="form-control" id="project_name" name="project_name" required="required">
						<option selected="selected" value="">Select Project</option>
                        <?php if($_SESSION['usertype']=="USER"){ ?>
                        <?php foreach ($user_task_result as $row){?>
                        <option value="<?php echo $row->getId(); ?>"><?php echo $row->getProjectName(); ?></option>
							
						<?php } ?>
                        
                        <?php foreach ($projects_by_leader as $row){?>
                        <option value="<?php echo $row->getId(); ?>"><?php echo $row->getProjectName(); ?></option>
							
						<?php } ?>
						<?php }?>
                        
                        <?php if($_SESSION['usertype']=="ADMIN"){ ?>
                        <?php foreach ($projects_by_admin as $row){?>
                        <option value="<?php echo $row->getId(); ?>"><?php echo $row->getProjectName(); ?></option>
							
						<?php } ?>
						<?php }?>
				</select>  
            	
                <input name="" class="btn btn-info btn-fill pull-left" type="Submit" value="Search" />
            </form>
            	</div>
            </div>
		</div>
  				<div class="card-content">  
               <?php
				 
				 if($action == "list"){?>
					<table class="table">
                    <tr>
                            	<td>No Project Selected</td>
                           	</tr>
                    </table>
				<?php } else{ ?>
                		<table class="table">
                        
                       
                			<?php if($overdue_task_details == 0){?>

                  			<tr>
                            	<td>No Tasks Overdue</td>
                           	</tr>

                 <?php } foreach($overdue_task_details as $row) { ?>

                			<thead>
                				<tr>
                                	<th>Project Name</th>
                                	<th>Task Name</th>
                					<th>Task Description</th>
                					<th>Task Start Date</th>
                					<th>Task End Date</th>
                					<th>Task Overdue in days</th>              
                				</tr>
                			</thead>
                			<tbody> 
                				<tr>
                					<td><?php $project_id = $row['project_id'];

                                	$obj_project_class->setId($project_id);
				
									$project_name=$obj_project_class_dao->getProjectById($obj_project_class);
									
									foreach ($project_name as $data) {
					
									echo $data->getProjectName();
									}?> </td>
                					<td><?php echo "{$row['task_name']} ";?></td>
                					<td><?php echo "{$row['task_description']}";?></td>
                					<td><?php echo "{$row['task_start_date']}";?></td>
                                    <td><?php echo "{$row['task_end_date']}";?></td>
                                    <td><?php echo "{$row['overdue_task']}";?></td>
                
                				</tr>
				 			<?php } ?> 

                			</tbody>
               		</table>
                    <?php } ?> 
				</div>
	</div>
</div>

<div class="col-lg-12 col-sm-6 col-xs-12">
	<div class="card">
		<div class="card-header">
			<div class="numbers pull-left">
           			High Priority tasks<br />
			</div>
        </div>
  				<div class="card-content">  
              
                		<table class="table">
                			<?php if(empty($high_priority_task)){?>

                  			<tr>
                            	<td>No High Priority Tasks</td>
                           	</tr>

                 <?php } else{?>

                			<thead>
                				<tr>
                                	<th>Project Name</th>
                                	<th>Task Name</th>
                					<th>Task Description</th>
                					<th>Task Start Date</th>
                					<th>Task End Date</th>
                                    <th>Status</th>
                				</tr>
                			</thead>
                			<tbody>
                            <?php  foreach($high_priority_task as $row) { ?> 
                				<tr>
                					<td><?php $project_id = $row->getProjectId();

                                	$obj_project_class->setId($project_id);
				
									$project_name=$obj_project_class_dao->getProjectById($obj_project_class);
									
									foreach ($project_name as $data) {
					
									echo $data->getProjectName();
									}?> </td>
                					<td><?php echo "{$row->getTaskName()} ";?></td>
                					<td><?php echo "{$row->getTaskDescription()}";?></td>
                					<td><?php echo "{$row->getTaskStartDate()}";?></td>
                                    <td><?php echo "{$row->getTaskEndDate()}";?></td>
                					<td><?php $is_complete=$row->getIsCompleted();
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
                				</tr>
				 			<?php } }?> 

                			</tbody>
               		</table>
                   
				</div>
	</div>
</div>


                    
                
                  	

                  <!--  <div class="col-md-12">
                        <div class="card">
                         <?php if($_SESSION['usertype']=="USER") {?>
                            <div class="header">
                                <h4 class="title">Projects Lead By Me</h4>
                                <p class="category"></p>
                            </div>
                            <div class="content">
                               
                               <?php if(!empty($result)){ ?>
								<div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>Project Name</th>
                                    	<th>Project Leader</th>
                                    	<th>Start Date</th>
                                    	<th>End Date</th>
                                        <th>View Details</th>
                                    </thead>
                                    <tbody>
                                
									 <?php foreach($result as $data){ ?>
                                        <tr>
                                        	<td><?php echo $data->getProjectName(); ?></td>
                                        	<td><?php $leader=$data->getProjectLeader(); ?>
											<?php 

											$list2=$obj_project_class_dao->get_project_leader_name($leader);?>
											<?php foreach($list2 as $data2){ echo $data2['fname']." ".$data2['lname']; }?>
                                            
                                            </td>
                                        	<td><?php echo $data->getProjectStartDate(); ?></td>
                                        	<td><?php
											 			 $today=time();
														 $enddate=strtotime($data->getProjectEndDate());
														
														$datediff = $enddate - $today;

														$daysleft = floor($datediff / (60 * 60 * 24));
														
														
														
														if($daysleft <=5 && $daysleft>=0){
														
														echo '<span class="orange">'.$data->getProjectEndDate().'</span>';
														}
														
															elseif($daysleft<0){
														
															echo '<span class="red">'.$data->getProjectEndDate().'</span>';
														}
														
														else {
															
															echo '<span class="green">'.$data->getProjectEndDate().'</span>';
															
														}
											  ?></td>
                                            
                                            <td>
                                            <?php $project_id=$data->getId(); ?>
                                            <a href="<?php echo '?module=project&action=project_view_task&id='.base64_encode($project_id).'&status='.base64_encode(1).''?>" class="btn btn-fill btn-info">Details</a></td>
                                            
                                        </tr>
                                        
                                        <?php } ?>
										 </tbody>
                                </table>
 
										<a href="<?php echo '?module=project&action=project_view'?>" class="btn btn-fill btn-info">VIEW ALL PROJECTS </a> 
										
										
                                  
                                <?php } else {?>
									
							<div class="alert alert-warning">
							  <strong>Sorry!</strong> You Don't Lead Any Project.
                              							</div>
									
								<?php }?>
                                </div> 
								
								<?php } else{?>
                                <div class="header">
                                <h4 class="title">Last 5 Ongoing Projects</h4>
                                <p class="category"></p>
                            </div>
                            <div class="content">
                              <?php if(!empty($result2)){ ?>
                                	<div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>Project Name</th>
                                    	<th>Project Leader</th>
                                    	<th>Start Date</th>
                                    	<th>End Date</th>
                                        <th>View Details</th>
                                    </thead>
                                    <tbody>
                                
									 <?php foreach($result2 as $data){ ?>
                                        <tr>
                                        	<td><?php echo $data->getProjectName(); ?></td>
                                        	<td><?php $leader=$data->getProjectLeader(); ?>
											<?php 

											$list2=$obj_project_class_dao->get_project_leader_name($leader);?>
											<?php foreach($list2 as $data2){ echo $data2['fname']." ".$data2['lname']; }?>
                                            
                                            </td>
                                        	<td><?php echo $data->getProjectStartDate(); ?></td>
                                        	<td><?php
											 			 $today=time();
														 $enddate=strtotime($data->getProjectEndDate());
														
														$datediff = $enddate - $today;

														$daysleft = floor($datediff / (60 * 60 * 24));
														
														
														
														if($daysleft <=5 && $daysleft>=0){
														
														echo '<span class="orange">'.$data->getProjectEndDate().'</span>';
														}
														
															elseif($daysleft<0){
														
															echo '<span class="red">'.$data->getProjectEndDate().'</span>';
														}
														
														else {
															
															echo '<span class="green">'.$data->getProjectEndDate().'</span>';
															
														}
											  ?></td>
                                            
                                            <td>
                                            <?php $project_id=$data->getId(); ?>
                                            <a href="<?php echo '?module=project&action=project_view_task&id='.base64_encode($project_id).'&status='.base64_encode(1).''?>" class="btn btn-fill btn-info">Details</a></td>
                                            
                                        </tr>
                                        
                                        <?php } ?>
										 </tbody>
                                </table>
 
										<a href="<?php echo '?module=project&action=project_view'?>" class="btn btn-fill btn-info">VIEW ALL PROJECTS </a> 
										
										<?php } else {?>
									
							<div class="alert alert-warning">
							  <strong>Sorry!</strong> No Projects Created Yet.
                              							</div>
									
								<?php } }?>
                                  
                                
                                </div>
                                
                			</div>
						</div>
                                            <div class="col-md-12">
                        <div class="card">
                         <?php if($_SESSION['usertype']=="USER") {?>
                            <div class="header">
                                <h4 class="title">Projects I am a Member</h4>
                                <p class="category"></p>
                            </div>
                            <div class="content">
                                <?php if(!empty($user_task_result)){ ?>
                               
								<div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>Project Name</th>
                                    	<th>Project Leader</th>
                                    	<th>Start Date</th>
                                    	<th>End Date</th>
                                        <th>View Details</th>
                                    </thead>
                                    <tbody>
                                
									 <?php foreach($user_task_result as $data){ ?>
                                        <tr>
                                        	<td><?php echo $data->getProjectName(); ?></td>
                                        	<td><?php $leader=$data->getProjectLeader(); ?>
											<?php 

											$list2=$obj_project_class_dao->get_project_leader_name($leader);?>
											<?php foreach($list2 as $data2){ echo $data2['fname']." ".$data2['lname']; }?>
                                            
                                            </td>
                                        	<td><?php echo $data->getProjectStartDate(); ?></td>
                                        	<td><?php
											 			 $today=time();
														 $enddate=strtotime($data->getProjectEndDate());
														
														$datediff = $enddate - $today;

														$daysleft = floor($datediff / (60 * 60 * 24));
														
														
														
														if($daysleft <=5 && $daysleft>=0){
														
														echo '<span class="orange">'.$data->getProjectEndDate().'</span>';
														}
														
															elseif($daysleft<0){
														
															echo '<span class="red">'.$data->getProjectEndDate().'</span>';
														}
														
														else {
															
															echo '<span class="green">'.$data->getProjectEndDate().'</span>';
															
														}
											  ?></td>
                                            
                                            <td>
                                            <?php $project_id=$data->getId(); ?>
                                            <a href="<?php echo '?module=project&action=project_view_task&id='.base64_encode($project_id).'&status='.base64_encode(1).''?>" class="btn btn-fill btn-info">Details</a></td>
                                            
                                        </tr>
                                        
                                        <?php } ?>
										 </tbody>
                                </table>
 
										<a href="<?php echo '?module=project&action=project_view'?>" class="btn btn-fill btn-info">VIEW ALL PROJECTS </a> 
										
										
                                  
                                
                                </div> 
								
								<?php } else {?>
									
							<div class="alert alert-warning">
							  <strong>Sorry!</strong> No Project Created Yet.
                              							</div>
									
								<?php } }?>
                                  
                                
                                </div>
                                
                			</div>
						</div>
                      </div>
                    </div>
                  </div>
                </div>  
                <?php } else { echo "<script type='text/javascript'>window.location='?';</script>";
					exit();}?>