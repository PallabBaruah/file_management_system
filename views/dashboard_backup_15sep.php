         <?php if(isset($_SESSION['user_email'])){ ?>
        <div class="content dashboard">
            <div class="container-fluid">
<div class="col-lg-12 col-sm-6 col-xs-12">
<div class="panel panel-default paneltop">
  <div class="panel-heading">Projects Details</div>
  <div class="panel-body">  
            	 <?php foreach($count_active_projects as $row) { 

                                	echo "Total Active Project:{$row['total_projects']}<br/>";
                  } ?>

                  <?php foreach($count_overdue_projects as $row) { 
                      
                                	echo "Total Over Due Projects:{$row['overdue_projects']}</br>";
                  } ?>


                  <?php foreach($count_active_projects_member as $row) { 

                                  echo "Total Active Project(as Member):{$row['total_member_projects']}<br/>";
                  } ?>

</div></div></div>
<div class="clearfix"></div>

            
                <div class="col-lg-6 col-sm-6 col-xs-12">
<div class="panel panel-default">
  <div class="panel-heading">Projects OverDue</div>
  <div class="panel-body bodysection">  
                  Projects OverDue<br/>
                  <?php if($overdue_project_details == 0){

                  		echo "No Data Available";
                  }

                  foreach($overdue_project_details as $row) { 

                                	echo "Project Name:{$row['project_name']}&nbsp<br />";

                                	echo "Project Start Date:{$row['project_start_date']}&nbsp <br />";
                                	echo "Project End Date:{$row['project_end_date']}&nbsp <br />";
                                	echo "Project Overdue in Days:{$row['overdue']}&nbsp</br>";
                  } ?>

               </div></div></div>
                    
                <div class="col-lg-6 col-sm-6 col-xs-12">
<div class="panel panel-default">
  <div class="panel-heading"> Todays Task</div>
  <div class="panel-body bodysection">    
                  <?php foreach($count_todays_task as $row) { 

                                  echo "Today's Total Task :{$row['total_todays_task']}<br/>";
                  } ?>

                  Todays Task<br/>
                  <?php if($todays_task == 0){

                  		echo "No Data Available";

                  }

                   foreach($todays_task as $row) { 



                  echo "<br/>";
                       
                  $project_id= $row['project_id'];

									$obj_project_class->setId($project_id);

				
									$project_name=$obj_project_class_dao->getProjectById($obj_project_class);
									
									foreach ($project_name as $data) {
					
									echo "Project Name:".$data->getProjectName()." ";
									}

                                	echo "Task Name:".$row['task_name']." ";
                                	echo "Task Description:".$row['task_description']."<br/>";
                  } ?>

</div></div></div>
                  	<div class="col-lg-6 col-sm-6 col-xs-12">
<div class="panel panel-default">
  <div class="panel-heading">Overdue Task Details</div>
  <div class="panel-body bodysection">  
                  	<?php echo "Over Due Task Details<br/>";?>
         				
                   <?php if($overdue_task_details == 0){

									         echo "No Data Available";
   	
					           }

                   foreach($overdue_task_details as $row) { 
                   					
                   					echo "<br/>";
                   				//	echo "task id:{$row['id']}";
                                
                                	 $project_id = $row['project_id'];

                                	$obj_project_class->setId($project_id);
				
									$project_name=$obj_project_class_dao->getProjectById($obj_project_class);
									
									foreach ($project_name as $data) {
					
									echo "Project Name:".$data->getProjectName();
									}

                                	echo "Task Name:{$row['task_name']}"." ";
                                	echo "task_description :{$row['task_description']}"." ";
                                	echo "task_start_date:{$row['task_start_date']}"." ";
                                	echo "task_end_date:{$row['task_end_date']}"." ";
                                	echo "Task Overdue in Days:{$row['overdue_task']}<br/>";

                  } ?>

                  </div></div></div>

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