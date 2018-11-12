<?php
				include_once ('../classes/ProjectMaster.class.php');
				include_once ('../classes/database.class.php'); 
				$obj_project_dao=new ProjectDAO();
				$obj_project=new Project();
				
				$project_code='';
				$array_form_fields=array();

				
				if(isset($_POST['project_owner'])){

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
				
				
				$obj_project->setId($project_id);				
				$obj_project->setProjectOwner($store_owner2);

				
				$result=$obj_project_dao->add_project_member($obj_project);
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