<?php
				include_once ('../classes/ProjectMaster.class.php');
				include_once ('../classes/ProjectDetails.class.php');				
				include_once ('../classes/database.class.php'); 
				$obj_project_dao=new ProjectDAO();
				$obj_project=new Project();
				
				$obj_project_details=new ProjectDetails();
				$obj_project_details_dao=new ProjectDetailsDAO();
				
				
				$new_task_owner='';
				$old_task_owner='';

?>