                         <?php if(isset($_SESSION['user_email'])){ ?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Projects Completed </h4>
                                <p class="category"></p>
                            </div>
                            <hr />
                            <div class="content">
                          <?php if(!empty($list)){ ?>
                                                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        
                                    	<th>Project Name</th>
                                    	<th>Project Leader</th>
                                    	<th>Start Date</th>
                                    	<th>End Date</th>
                                        <th>Status</th>
                                    </thead>
                                    <tbody>
                                                     <?php foreach($list as $data){ ?>
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
                                           
                                            
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
					<?php } else {?>
									
							<div class="alert alert-warning">
							  <strong>Sorry!</strong> No Project Completed Yet
                              							</div>
									
								<?php }?>
                            </div>
                       
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php } else { echo "<script type='text/javascript'>window.location='?';</script>";
					exit();}?>