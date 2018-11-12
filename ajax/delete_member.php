<?php
				include_once ('../classes/ProjectMaster.class.php');
				include_once ('../classes/ProjectDetails.class.php');				
				include_once ('../classes/database.class.php'); 
				$obj_project_dao=new ProjectDAO();
				$obj_project=new Project();
				
				$obj_project_details_dao=new ProjectDetailsDAO();
				$obj_project_details=new ProjectDetails();
				
				$project_code='';
				$array_form_fields=array();

				
				if(isset($_POST['project_owner'])){

					$store_owner=base64_decode($_POST['project_owner']);
					
					if($store_owner==''){

					$error_message="Select Project Members ";

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
				
				$obj_project_details->setProjectId($project_id);				
				$obj_project_details->setUserId($store_owner);
				
				$result2=$obj_project_details_dao->check_project_details_status_by_user_id_and_project_id($obj_project_details);
				
				if($result2==false){
				
				
				$obj_project->setId($project_id);				
				$obj_project->setProjectOwner($store_owner);

				
				$result=$obj_project_dao->delete_project_member($obj_project);
				if($result = TRUE){
				echo 1;
				exit();
				}
				else
				{
					echo 0;
					exit();
				}
				}
	?>		