<?php
				include_once ('../classes/ProjectMaster.class.php');
				include_once ('../classes/ProjectDetails.class.php');				
				include_once ('../classes/database.class.php'); 
				$obj_project_dao=new ProjectDAO();
				$obj_project=new Project();
				
				$obj_project_details=new ProjectDetails();
				$obj_project_details_dao=new ProjectDetailsDAO();

				
				$project_name='';
				$project_leader='';
				$project_start_date='';
				$project_end_date='';
				$project_description='';
				$project_created_by='';
				$project_created_date='';
				$project_modified_by='';
				$project_modified_date='';
				$project_is_completed='';
				$project_code='';
				$array_form_fields=array();

				if(isset($_POST['pr_name'])){			
					$project_name=$_POST['pr_name'];

					if(empty($project_name)){

					$error_message="Project Name Required";
					}
					elseif(!preg_match("/^[a-zA-Z][a-zA-Z0-9-_\. ]*$/", $project_name)){

					$error_message="Project Name should have only numbers and letters with '_' and '.' allowed";

					}elseif (strlen($project_name) > 30) {
					
					$error_message="Project name should not be greater than 30 characters";
					
					}
					//$project_name=$_POST['pr_name'];
					$array_form_fields['project_name']=$project_name;
					if(!empty($error_message))
						{
							echo $error_message;
						exit();		
						}
					
				}

					/*if(isset($_POST['pr_code'])){			
					
					$project_code=$_POST['pr_code'];
					
					if(empty($project_code)){
					$error_message="Project Code Required ";
					}elseif (strlen($project_code) > 10) {
					
					$error_message="Project Code should be less than 10 characters";
					
					}

				}*/
				

					if(isset($_POST['pr_leader'])){			
					
					$project_leader=base64_decode($_POST['pr_leader']);
					

					if($project_leader==''){
					$error_message="Select Project Leader ";
					}
					if(!empty($error_message))
						{
							echo $error_message;
						exit();		
						}
					
				}


					if(isset($_POST['pr_startdate'])){			
					
					$project_start_date=$_POST['pr_startdate'];
				
					if(empty($project_start_date)){
					$error_message="Project Start Date Required ";
					}

					elseif(!preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4}$/",$project_start_date)){

					$error_message="Invalid Date Format";
					}
					$array_form_fields['project_start_date']=$project_start_date;
					if(!empty($error_message))
						{
							echo $error_message;
						exit();		
						}

				}


					if(isset($_POST['pr_enddate'])){			
					
					$project_end_date=$_POST['pr_enddate'];

					if(empty($project_end_date)){
					$error_message="Project End Date Required ";
					}


					elseif(!preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4}$/",$project_end_date)){

					$error_message="Invalid Date Format";
					}

					$array_form_fields['project_end_date']=$project_end_date;
					if(!empty($error_message))
						{
							echo $error_message;
						exit();		
						}

				}



					if(isset($_POST['pr_desc'])){			
					
					
					$project_description=$_POST['pr_desc'];

					if(empty($project_description)){
					$error_message="Project Description Required ";

					}
					elseif(!preg_match("/^[a-zA-Z][a-zA-Z0-9-_\. ]*$/", $project_description)){

					$error_message="Project Description can have only numbers and letters with '_' and '.' allowed";

					}
					elseif (strlen($project_description) > 500) {
					
					$error_message="Project Description should be less than 500 characters";
					
					}
					$array_form_fields['project_desc']=$project_description;
					if(!empty($error_message))
						{
							echo $error_message;
						exit();		
						}

				}
				
				
					/*if(isset($_POST['project_owner'])){

					$store_owner=$_POST['project_owner'];
					
					if($store_owner==''){

					$error_message="Select Project Members ";

					}elseif(!empty($store_owner)){

						$store_owner2='';
						foreach($store_owner as $project_owner1){
    								
    					$store_owner2.= base64_decode($project_owner1) .",";
						}
					}	
					if(!empty($error_message))
						{
						echo $error_message;
						exit();		
						}

				}*/
				if(isset($_POST['pr_remark'])){			
					
					
					$project_remark=$_POST['pr_remark'];

					if(!preg_match("/^[a-zA-Z][a-zA-Z0-9-_\. ]*$/", $project_remark)){

					$error_message="Special Notes can have only numbers and letters with '_' and '.' allowed";

					}
					elseif (strlen($project_remark) > 500) {
					
					$error_message="Special Notes should be less than 500 characters";
					}
					$array_form_fields['project_remark']=$project_remark;
				}
				
				
				if(isset($_POST['pr_status'])){			
					
					$project_is_completed=$_POST['pr_status'];
					

					if(empty($project_is_completed)){
					$error_message="Select Project Status";
					}
					if(!empty($error_message))
						{
							echo $error_message;
						exit();		
						}
				}
				
				if(isset($_POST['pr_id'])){			
					
					$project_id=$_POST['pr_id'];
					

					if(empty($project_id)){
					$error_message="No Project Id";
					}
					
				}
				
				
				
				$_SESSION['FORM_FIELDS']=$array_form_fields;
							if(!empty($error_message))
						{
							echo $error_message;
						exit();		
						}
				$_SESSION['ERROR_PROJECT_UPDATE']=NULL;
				
				$project_modified_by=$_SESSION['first_name']. $_SESSION['last_name'];
				
				
				$date_1 = DateTime::createFromFormat( 'd/m/Y', $project_start_date );
				$project_start_date_1 = $date_1->format( 'Y-m-d' );
				
				$date_2 = DateTime::createFromFormat( 'd/m/Y', $project_end_date );
				$project_end_date_2 = $date_2->format( 'Y-m-d' );
				
				$obj_project->setId($project_id);				
				$obj_project->setProjectName($project_name);
				$obj_project->setProjectLeader($project_leader);
				$obj_project->setProjectStartDate($project_start_date_1);
				$obj_project->setProjectEndDate($project_end_date_2);
				$obj_project->setProjectDescription($project_description);
				$obj_project->setModifiedBy($project_modified_by);
				//$obj_project->setModifiedDate($project_modified_date);
				$obj_project->setIsCompleted($project_is_completed);
				//$obj_project->setProjectOwner($store_owner2);
				$obj_project->setProjectRemark($project_remark);
				
				$result=$obj_project_dao->update_project_master($obj_project);
				if($result = TRUE){
				echo 1;
				exit();
				}
				else
				{
					echo 0;
					exit();
				}
	?>		