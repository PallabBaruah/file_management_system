<?php
ob_start();
error_reporting(E_ALL); ini_set('display_errors', 'On');
class Controller {  
     public function __construct()    
     {    
     	
     }   
 public function invoke()  
     {  
		if (isset($_GET['module']) && isset($_GET['action'])) {
			$module 	= $_GET['module'];
			$action     = $_GET['action'];
		} else {
			$module 	= 	'user';
			$action     = 	'sign_in';
		}
		
		if($module == "dashboard"){
			if($action == "list"){
				
				include './classes/ProjectMaster.class.php';

				include './classes/ProjectDetails.class.php';
				
				include './classes/User.php';

				if(!isset($_SESSION)) {session_start();}

				$obj_project_class=new Project();
				$obj_project_class_dao=new ProjectDAO();

				$obj_task_details=new ProjectDetails();
				$obj_task_details_dao=new ProjectDetailsDAO();
					
				//$obj_project_class->$_SESSION['user_id'];

				$user_task_result = $obj_project_class_dao->get_projects_by_member($_SESSION['user_id']);
				
				$obj_project_class->setProjectLeader($_SESSION['user_id']);

				$projects_by_leader=$obj_project_class_dao->get_projects_by_leader($obj_project_class);
				
				$projects_by_admin=$obj_project_class_dao->get_all_projects_for_admin();

				
				//count active projects 
				$count_active_projects = $obj_project_class_dao->getTotalProjectUnderLeader($obj_project_class);
				
				$count_active_projects_all = $obj_project_class_dao->getTotalProject();
				
				//count overdue projects,project data  
				$count_overdue_projects = $obj_project_class_dao->getTotalOverDueProjectsUnderLeader($obj_project_class);
				
				$count_overdue_projects_all = $obj_project_class_dao->getTotalOverDueProjects();

				$overdue_project_details = $obj_project_class_dao->getTotalOverDueProjectsDetails($obj_project_class);	
				
				$overdue_project_details_all = $obj_project_class_dao->getTotalOverDueProjectsDetailsAll();

						
				//Task details--todays task,task overdue by user id;

				$obj_task_details->setUserId($_SESSION['user_id']);

				$count_todays_task = $obj_task_details_dao->getTotalTodayTasksById($obj_task_details);

				$todays_task = $obj_task_details_dao->getTodayTasksById($obj_task_details);



				$overdue_task_details = $obj_task_details_dao->getTotalOverDueTaskDetails($obj_task_details);
				
				
								
				$obj_task_details->setUserId($_SESSION['user_id']);
				
				$high_priority_task = $obj_task_details_dao->get_task_by_priority($obj_task_details);
				
				$page='';
				$num_rec_per_page=5;
							if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
				$start_from = ($page-1) * $num_rec_per_page;
				$slno = $start_from + 1;
				
				$totalrow=$obj_task_details_dao->count_pending_task_by_user_id($obj_task_details);
				
				$number_of_pages = ceil($totalrow/$num_rec_per_page);
				 
				$_SESSION['FORM_FIELDS']=NULL;
				
				include 'views/dashboard.php';
			
			}
			
			
				if($action == "show_pending"){
					
					if(isset($_POST['project_name'])){			
					
					$project_id=$_POST['project_name'];
					if(empty($project_id)){
					$error_message="No Project Id ";
					echo "<script type='text/javascript'>window.location='?module=dashboard&action=list';</script>";
					exit();	

					
					}
					$array_form_fields['projectid']=$project_id;
					}
					
					if(isset($_POST['project_member_pending'])){			
					
					$project_member_pending=$_POST['project_member_pending'];
					if(empty($project_member_pending)){
					$project_member_pending='';
					
					}
					$array_form_fields['project_member_pending']=$project_member_pending;
					}
					if(isset($_POST['project_priority_pending'])){			
					
					$project_priority_pending=$_POST['project_priority_pending'];
					if(empty($project_priority_pending)){
					$project_priority_pending='';					
					}
					$array_form_fields['project_priority_pending']=$project_priority_pending;
					}
					
					if(isset($_POST['overdue_check'])){			
					
					$overdue_check=$_POST['overdue_check'];
					if(empty($overdue_check)){
					$overdue_check='';					
					}
					$array_form_fields['overdue_check']=$overdue_check;

					}
				$_SESSION['FORM_FIELDS']=$array_form_fields;
				include './classes/ProjectMaster.class.php';

				include './classes/ProjectDetails.class.php';
				
				include './classes/User.php';

				if(!isset($_SESSION)) {session_start();}

				$obj_project_class=new Project();
				$obj_project_class_dao=new ProjectDAO();

				$obj_task_details=new ProjectDetails();
				$obj_task_details_dao=new ProjectDetailsDAO();
					
				//$obj_project_class->$_SESSION['user_id'];

				$user_task_result = $obj_project_class_dao->get_projects_by_member($_SESSION['user_id']);
				
				$obj_project_class->setProjectLeader($_SESSION['user_id']);

				$projects_by_leader=$obj_project_class_dao->get_projects_by_leader($obj_project_class);
				
				$projects_by_admin=$obj_project_class_dao->get_all_projects_for_admin();

				$usertype=$_SESSION['usertype'];
				
				if($usertype=="USER"){
				$obj_project_class->SetId($project_id);
				$result=$obj_project_class_dao->get_projects_by_leader_and_project_id($obj_project_class);
				}
				else if($usertype=="ADMIN"){
				$obj_project_class->SetId($project_id);
				$result=$obj_project_class_dao->get_all_projects_for_admin_by_project_id($obj_project_class);
				}
				
				
				$obj_project_class->SetId($project_id);
				$project_status_id=$obj_project_class_dao->getProjectById($obj_project_class);
				foreach($project_status_id as $data){
					$_SESSION['PROJECT_ID']=base64_encode($data->getId());
				$session_project_status=$_SESSION['PROJECT_STATUS']=base64_encode($data->getIsCompleted()); 
				}
				
				$obj_task_details->setProjectId($project_id);
				$obj_task_details->setUserId($project_member_pending);
				$obj_task_details->setPriority($project_priority_pending);
				$obj_task_details->setOverdue($overdue_check);
				$pending_task_details=$obj_task_details_dao->read_pending_task_by_user_id($obj_task_details);
				
				
				
				//count active projects 
				$count_active_projects = $obj_project_class_dao->getTotalProjectUnderLeader($obj_project_class);
				
				//count overdue projects,project data  
				$count_overdue_projects = $obj_project_class_dao->getTotalOverDueProjectsUnderLeader($obj_project_class);

				$overdue_project_details = $obj_project_class_dao->getTotalOverDueProjectsDetails($obj_project_class);	

						
				//Task details--todays task,task overdue by user id;

				$obj_task_details->setUserId($_SESSION['user_id']);

				$count_todays_task = $obj_task_details_dao->getTotalTodayTasksById($obj_task_details);

				$todays_task = $obj_task_details_dao->getTodayTasksById($obj_task_details);



				$overdue_task_details = $obj_task_details_dao->getTotalOverDueTaskDetails($obj_task_details);
				
				
								
				$obj_task_details->setUserId($_SESSION['user_id']);
				
				$high_priority_task = $obj_task_details_dao->get_task_by_priority($obj_task_details);
				
				$page='';
				$num_rec_per_page=5;
							if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
				$start_from = ($page-1) * $num_rec_per_page;
				$slno = $start_from + 1;
				
				$totalrow=$obj_task_details_dao->count_pending_task_by_user_id($obj_task_details);
				
				$number_of_pages = ceil($totalrow/$num_rec_per_page);
				 
				
				
				include 'views/dashboard.php';
			
			}
			
			
			
			if($action == "task_overdue"){
					
					if(isset($_POST['project_name'])){			
					
					$project_id=$_POST['project_name'];
					if(empty($project_id)){
					$error_message="No Project Id ";
					echo "<script type='text/javascript'>window.location='?module=dashboard&action=list';</script>";
					exit();	

					
					}
					}
				
				include './classes/ProjectMaster.class.php';

				include './classes/ProjectDetails.class.php';
				
				include './classes/User.php';

				if(!isset($_SESSION)) {session_start();}

				$obj_project_class=new Project();
				$obj_project_class_dao=new ProjectDAO();

				$obj_task_details=new ProjectDetails();
				$obj_task_details_dao=new ProjectDetailsDAO();
					
				//$obj_project_class->$_SESSION['user_id'];

				$user_task_result = $obj_project_class_dao->get_projects_by_member($_SESSION['user_id']);
				
				$obj_project_class->setProjectLeader($_SESSION['user_id']);

				$projects_by_leader=$obj_project_class_dao->get_projects_by_leader($obj_project_class);
				
				$projects_by_admin=$obj_project_class_dao->get_all_projects_for_admin();

				$usertype=$_SESSION['usertype'];
				
				//count active projects 
				$count_active_projects = $obj_project_class_dao->getTotalProjectUnderLeader($obj_project_class);
				
				//count overdue projects,project data  
				$count_overdue_projects = $obj_project_class_dao->getTotalOverDueProjectsUnderLeader($obj_project_class);

				$overdue_project_details = $obj_project_class_dao->getTotalOverDueProjectsDetails($obj_project_class);	

						
				//Task details--todays task,task overdue by user id;

				$obj_task_details->setUserId($_SESSION['user_id']);

				$count_todays_task = $obj_task_details_dao->getTotalTodayTasksById($obj_task_details);

				$todays_task = $obj_task_details_dao->getTodayTasksById($obj_task_details);


				
				if($usertype=="USER"){
				$obj_task_details->setProjectId($project_id);
				$overdue_task_details = $obj_task_details_dao->getTotalOverDueTaskDetailsByProjectIdAndUserId($obj_task_details);
				}
				else if($usertype=="ADMIN"){
				$obj_task_details->setProjectId($project_id);
				$overdue_task_details = $obj_task_details_dao->getTotalOverDueTaskDetailsByProjectId($obj_task_details);
				}
				
								
				$obj_task_details->setUserId($_SESSION['user_id']);
				
				$high_priority_task = $obj_task_details_dao->get_task_by_priority($obj_task_details);
				
				$page='';
				$num_rec_per_page=5;
							if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
				$start_from = ($page-1) * $num_rec_per_page;
				$slno = $start_from + 1;
				
				$totalrow=$obj_task_details_dao->count_pending_task_by_user_id($obj_task_details);
				
				$number_of_pages = ceil($totalrow/$num_rec_per_page);
				 
				
				
				include 'views/dashboard.php';
			
			}


			
			//change password action
			
			if($action == "change_password"){


				include 'views/change_password.php';


			}
			
			if($action == "change_password_action"){

				include './classes/User.php';
				$obj_user_login=new User();
				$obj_user_login_dao=new UserDAO();
				$old_password_2='';
				$old_password='';
				$new_password='';
				$new_password_2='';
				$confirm_password='';
				$get_old_password='';
				$get_old_password_2='';
				
				if(isset($_POST['old_password'])){
					
					$old_password_2=$_POST['old_password'];
					
					$old_password=base64_encode($old_password_2);


					if (empty($old_password_2)) {

					$error_message="Old Password Required";
					$_SESSION['ERROR_MESSAGE_PW_CHANGE']=$error_message;
					echo "<script type='text/javascript'>window.location='?module=dashboard&action=change_password';</script>";
					exit();
	
					}

					elseif(strlen($old_password_2) < 6 ){

					$error_message="Old Password should be minimun  of 6 and maximun of 15 characters";
					$_SESSION['ERROR_MESSAGE_PW_CHANGE']=$error_message;
					echo "<script type='text/javascript'>window.location='?module=dashboard&action=change_password';</script>";
					exit();

					}
					
					elseif(strlen($old_password_2) > 15 ){

					$error_message="Old Password should be less than 15 characters";
					$_SESSION['ERROR_MESSAGE_PW_CHANGE']=$error_message;
					echo "<script type='text/javascript'>window.location='?module=dashboard&action=change_password';</script>";
					exit();

					}
					
				}

				if(isset($_POST['new_password'])){
					$new_password=$_POST['new_password'];

					if (empty($new_password)) {
					$error_message="New Password Required";
					$_SESSION['ERROR_MESSAGE_PW_CHANGE']=$error_message;
					echo "<script type='text/javascript'>window.location='?module=dashboard&action=change_password';</script>";
					exit();
	
					}

					elseif(strlen($new_password) < 6 ){

					$error_message="New Password should be minimun  of 6 and maximun of 15 characters";
					$_SESSION['ERROR_MESSAGE_PW_CHANGE']=$error_message;
					echo "<script type='text/javascript'>window.location='?module=dashboard&action=change_password';</script>";
					exit();

					}
					
										
					elseif(!preg_match("/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%])/",$new_password)){

					$error_message="Password must be 6 to 15 characters long that must contain atleast one number, one special Character, one uppercase and one lowercase letter.";
					$_SESSION['ERROR_MESSAGE_PW_CHANGE']=$error_message;
					echo "<script type='text/javascript'>window.location='?module=dashboard&action=change_password';</script>";
					exit();

					}


					elseif(strlen($new_password) > 15 ){

					$error_message="New Password should be less than 15 characters";
					$_SESSION['ERROR_MESSAGE_PW_CHANGE']=$error_message;
					echo "<script type='text/javascript'>window.location='?module=dashboard&action=change_password';</script>";
					exit();

					}

				}
				
				if(isset($_POST['confirm_password'])){
					
					$confirm_password=$_POST['confirm_password'];

					if (empty($confirm_password)) {
					$error_message="New Password Required";
					$_SESSION['ERROR_MESSAGE_PW_CHANGE']=$error_message;
					echo "<script type='text/javascript'>window.location='?module=dashboard&action=change_password';</script>";
					exit();
	
					}

					elseif(strlen($confirm_password) < 6 ){

					$error_message="New Password should be minimun  of 6 and maximun of 15 characters";
					$_SESSION['ERROR_MESSAGE_PW_CHANGE']=$error_message;
					echo "<script type='text/javascript'>window.location='?module=dashboard&action=change_password';</script>";
					exit();

					}

					elseif(strlen($confirm_password) > 15 ){

					$error_message="New Password should be less than 15 characters";
					$_SESSION['ERROR_MESSAGE_PW_CHANGE']=$error_message;
					echo "<script type='text/javascript'>window.location='?module=dashboard&action=change_password';</script>";
					exit();

					}


				}
					
					if($new_password!=$confirm_password){
					$error_message="New Password and Confirm Password Didn't Match.Please Try Again";
					$_SESSION['ERROR_MESSAGE_PW_CHANGE']=$error_message;
					echo "<script type='text/javascript'>window.location='?module=dashboard&action=change_password';</script>"; 
					exit();
					}
					else{
					
					$new_password_2=base64_encode($new_password);
					
					$user_id=$_SESSION['user_id'];
					
					$obj_user_login->setId($user_id);

					$result = $obj_user_login_dao->getpassword_Byid($obj_user_login);
					
					foreach($result as $data){
						
						 $get_old_password=$data->getPassword();
						
						}
						
						if($old_password==$get_old_password){
							
							$obj_user_login->setId($user_id);
							$obj_user_login->setPassword($new_password_2);

							$updatepass = $obj_user_login_dao->change_password($obj_user_login);
							
							
							if($updatepass==1){
								$success_message="Password Updated Successfully";
								$_SESSION['PW_CHANGE_SUCCESS']=$success_message;
								echo "<script type='text/javascript'>window.location='?module=dashboard&action=change_password';</script>"; 
								exit();
							}
							else{
								$error_message="Old Password and New Password Cannot Be same";
								$_SESSION['ERROR_MESSAGE_PW_CHANGE']=$error_message;
								echo "<script type='text/javascript'>window.location='?module=dashboard&action=change_password';</script>"; 
								exit();
								
							}
							
						}
						else
						{
							$error_message="Sorry Couldn't Change. Please try again later";
							$_SESSION['ERROR_MESSAGE_FIRST_PW_CHANGE']=$error_message;
							echo "<script type='text/javascript'>window.location='?module=dashboard&action=first_time_password';</script>"; 
							exit();
						}
				
					}
			}
		}
			
			if($action == "first_time_password"){
				

				include 'views/first_time_password.php';


			}
			
			
			if($action == "first_time_password_action"){
				
				include './classes/User.php';
				$obj_user_login=new User();
				$obj_user_login_dao=new UserDAO();
				$old_password_2='';
				$old_password='';
				$new_password='';
				$new_password_2='';
				$confirm_password='';
				$get_old_password='';
				$get_old_password_2='';
				
				if(isset($_POST['old_password'])){
					
					$old_password_2=$_POST['old_password'];
					$old_password=base64_encode($old_password_2);

					if (empty($old_password_2)) {
					$error_message="OTP Required";
					$_SESSION['ERROR_MESSAGE_FIRST_PW_CHANGE']=$error_message;
					echo "<script type='text/javascript'>window.location='?module=dashboard&action=first_time_password';</script>";
					exit();
	
					}

					elseif(strlen($old_password_2) < 6 ){

					$error_message="OTP should be of 6 digits";
					$_SESSION['ERROR_MESSAGE_FIRST_PW_CHANGE']=$error_message;
					echo "<script type='text/javascript'>window.location='?module=dashboard&action=first_time_password';</script>";
					exit();

					}

					elseif(strlen($old_password_2) > 6 ){

					$error_message="OTP should be less than 6 digits";
					$_SESSION['ERROR_MESSAGE_FIRST_PW_CHANGE']=$error_message;
					echo "<script type='text/javascript'>window.location='?module=dashboard&action=first_time_password';</script>";
					exit();

					}

				}

				if(isset($_POST['new_password'])){
					$new_password=$_POST['new_password'];

					if (empty($new_password)) {
					$error_message="New Password Required";
					$_SESSION['ERROR_MESSAGE_FIRST_PW_CHANGE']=$error_message;
					echo "<script type='text/javascript'>window.location='?module=dashboard&action=first_time_password';</script>";
					exit();
	
					}

					elseif(strlen($new_password) < 6 ){

					$error_message="New Password should be minimun of 6 and maximun of 15 characters";
					$_SESSION['ERROR_MESSAGE_FIRST_PW_CHANGE']=$error_message;
					echo "<script type='text/javascript'>window.location='?module=dashboard&action=first_time_password';</script>";
					exit();

					}

					elseif(strlen($new_password) > 15 ){

					$error_message="New Password should be less than 15 characters";
					$_SESSION['ERROR_MESSAGE_FIRST_PW_CHANGE']=$error_message;
					echo "<script type='text/javascript'>window.location='?module=dashboard&action=first_time_password';</script>";
					exit();

					}

				}
				
				if(isset($_POST['confirm_password'])){
					$confirm_password=$_POST['confirm_password'];


					if (empty($confirm_password)) {
					$error_message="Confirm Password Required";
					$_SESSION['ERROR_MESSAGE_FIRST_PW_CHANGE']=$error_message;
					echo "<script type='text/javascript'>window.location='?module=dashboard&action=first_time_password';</script>";
					exit();
	
					}

					elseif(strlen($confirm_password) < 6 ){

					$error_message="Confirm Password should be minimun of 6 and maximun of 15 characters";
					$_SESSION['ERROR_MESSAGE_FIRST_PW_CHANGE']=$error_message;
					echo "<script type='text/javascript'>window.location='?module=dashboard&action=first_time_password';</script>";
					exit();

					}

					elseif(strlen($confirm_password) > 15 ){

					$error_message="Confirm Password should be less than 15 characters";
					$_SESSION['ERROR_MESSAGE_FIRST_PW_CHANGE']=$error_message;
					echo "<script type='text/javascript'>window.location='?module=dashboard&action=first_time_password';</script>";
					exit();

			

				}
					
					if($new_password!=$confirm_password){
					$error_message="New Password and Confirm Password Didn't Match.Please Try Again";
					$_SESSION['ERROR_MESSAGE_FIRST_PW_CHANGE']=$error_message;
					echo "<script type='text/javascript'>window.location='?module=dashboard&action=first_time_password';</script>"; 
					exit();
					}
					else{
					
					$new_password_2=base64_encode($new_password);
					
					$user_id=$_SESSION['user_id'];
					
					$obj_user_login->setId($user_id);

					$result = $obj_user_login_dao->getpassword_Byid($obj_user_login);
					
					foreach($result as $data){
						
						 $get_old_password=$data->getPassword();
						
						}
						
						if($old_password==$get_old_password){
							
							$obj_user_login->setId($user_id);
							$obj_user_login->setPassword($new_password_2);

							$updatepass = $obj_user_login_dao->first_time_password($obj_user_login);
							
							
							if($updatepass==1){
								$success_message="Password Updated Successfully";
								$_SESSION['FIRST_PW_CHANGE_SUCCESS']=$success_message;
								$_SESSION['password_created']=2;
								echo "<script type='text/javascript'>window.location='?module=dashboard&action=list';</script>"; 
								exit();
							}
							else{
								$error_message="Passwords Update Error";
								$_SESSION['ERROR_MESSAGE_FIRST_PW_CHANGE']=$error_message;
								echo "<script type='text/javascript'>window.location='?module=dashboard&action=first_time_password';</script>"; 
								exit();
											
							}
							
						}
						else
						{
							$error_message="Sorry Couldn't Change. Please try again later";
							$_SESSION['ERROR_MESSAGE_FIRST_PW_CHANGE']=$error_message;
							echo "<script type='text/javascript'>window.location='?module=dashboard&action=first_time_password';</script>"; 
							exit();
						}
				
					}
		

			}

			if($action == "user"){
				include 'views/user.php';
			}
			if($action == "project"){
				include 'views/project.php';
			}	
		}
		
		elseif($module == "user"){
			if($action == "create_user"){
				
					$string = file_get_contents("./data/states.json");
					$jsonRS = json_decode ($string,true);
					$state='';
					$district='';
					$array_states=array();
					$i=0;
					foreach ($jsonRS as $rs) {						
					  $array_states[$i]['state']=stripslashes($rs["state"]);
					  $i++;
					}
	
				include 'views/create_user.php';
				$_SESSION['FORM_FIELDS']=NULL;

			}
			if($action == "sign_in"){

				include 'views/'.$action.'.php';	


			}




			if($action == "view_user"){
				
				$string = file_get_contents("./data/states.json");
					$jsonRS = json_decode ($string,true);
					$state='';
					$district='';
					$array_states=array();
					$i=0;
					foreach ($jsonRS as $rs) {						
					  $array_states[$i]['state']=stripslashes($rs["state"]);
					  $i++;
					}
				
					include './classes/User.php';
					

					$obj_user_class_dao=new UserDAO();	

					$result = $obj_user_class_dao->viewUsersByAdmin();		

					include 'views/'.$action.'.php';		
				} 

			if($action == "profile"){
					
					$user_id='';
					
					$user_id=$_SESSION['user_id'];
					
					include './classes/User.php';
					
					$obj_user_class=new User();
					$obj_user_class_dao=new UserDAO();
					
					//$obj_user_class->setId($user_id);

					$result = $obj_user_class_dao->readAll_Byid($user_id);		

					include 'views/'.$action.'.php';		
				} 


			if($action=="login_screen"){
				include './classes/User.php';
				$obj_user_login=new User();
				$obj_user_login_dao=new UserDAO();
				$email='';
				$password='';
				$password_encode='';
				if(isset($_POST['email'])){
					$email=$_POST['email'];

					if(empty($email)){

						$error_message="Email Required ";
						$_SESSION['ERROR_MESSAGE_SIGN_IN']=$error_message;
						echo "<script type='text/javascript'>window.location='?';</script>"; 
						exit();

					}elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)){

						$error_message="Email Invalid Format";
						$_SESSION['ERROR_MESSAGE_SIGN_IN']=$error_message;
						echo "<script type='text/javascript'>window.location='?';</script>"; 
						exit();
			
					}elseif(strlen($email) > 30){

						$error_message="Email should be less then 30 characters";
						$_SESSION['ERROR_MESSAGE_SIGN_IN']=$error_message;
						echo "<script type='text/javascript'>window.location='?';</script>"; 
						exit();
			

					}


				}
				if(isset($_POST['password'])){
					$password=$_POST['password'];

					if (empty($password)) {
						# code...
					$error_message="Password Required";
					$_SESSION['ERROR_MESSAGE_SIGN_IN']=$error_message;
					echo "<script type='text/javascript'>window.location='?';</script>";
					exit();
	
					}

					elseif(strlen($password) < 6 ){

					$error_message="Invalid Email or Password.Please Try Again";
					$_SESSION['ERROR_MESSAGE_SIGN_IN']=$error_message;
					echo "<script type='text/javascript'>window.location='?';</script>";
					exit();

					}

					elseif(strlen($password) > 15 ){

					$error_message="Invalid Email or Password.Please Try Again";
					$_SESSION['ERROR_MESSAGE_SIGN_IN']=$error_message;
					echo "<script type='text/javascript'>window.location='?';</script>";
					exit();

					}

				}
				

				$password_encode=base64_encode($password);
				$obj_user_login->setEmail($email);
				$obj_user_login->setPassword($password_encode);
				//$obj_user_login->setUserType($user_type);
				$result=$obj_user_login_dao->userLogin($obj_user_login);

				//echo $result;
				if($result == 1){
				$obj_user_login2=new User();
				$obj_user_login_dao2=new UserDAO();						
				$obj_user_login2->setEmail($email);
				$obj_user_login2->setPassword($password_encode);
				$result2=$obj_user_login_dao2->setSessionforUser($obj_user_login2);
						foreach($result2 as $data){
							if(!isset($_SESSION)){session_start();}		
								$_SESSION['first_name']=$data->getFirstName();
								$_SESSION['salutation']=$data->getSalutation();
								$_SESSION['last_name']=$data->getLastName();	
								$_SESSION['user_id']=$data->getId();
								$_SESSION['user_email']=$data->getEmail();
								$_SESSION['usertype']=$data->getUserType();
								$_SESSION['password_created']=$data->getPasswordCreated();		
						}
						
						if($_SESSION['password_created']==1){
							
							echo "<script type='text/javascript'>window.location='?module=dashboard&action=first_time_password';</script>"; 
						}
						
						echo "<script type='text/javascript'>window.location='?module=dashboard&action=list';</script>"; 
						exit();
				}
				elseif($result == 2)
				{

					$error_message="Invalid Email or Password.Please Try Again";
					$_SESSION['ERROR_MESSAGE_SIGN_IN']=$error_message;
					echo "<script type='text/javascript'>window.location='?';</script>"; 
						exit();
				}

				else{

					$error_message="Invalid Email or Password.Please Try Again";
					$_SESSION['ERROR_MESSAGE_SIGN_IN']=$error_message;
					echo "<script type='text/javascript'>window.location='?';</script>"; 
						exit();

				}


			}

			if($action == "save_user"){
				if(!isset($_SESSION)){session_start();}

				include './classes/User.php';

				$obj_save_user=new User();
				$obj_save_user_dao=new UserDAO();


				$email='';
				$password='';
				$user_type='';
				$fname='';
				$lname='';
				$contact_no='';
				$state='';
				$city='';
				$pin='';
				$ipaddress='';
				$password_created='1';
				$salutation='';
				$org_name='';
				$desig='';
				
				$_SESSION['FORM_FIELDS']=NULL;
				$array_form_fields='';
				
				if(isset($_POST['salutation'])){			
					
					$salutation=$_POST['salutation'];
				
					if($salutation==''){
					$error_message="Select Salutation ";
					
					}

					$array_form_fields['salutation']=$salutation;
				}


				if(isset($_POST['fname']))
				{

					$fname=$_POST['fname'];

					if(empty($fname)){
					$error_message="First Name Required";
					
					}

					elseif(!preg_match("/^[a-zA-Z ]*$/",$fname)){

					$error_message="First Name: Number are not allowed";
					
							
					}elseif(strlen($fname) >=30){

					$error_message="First Name should be less then 30 characters";
					
									
					}
					$array_form_fields['fname']=$fname;
				
					
					
				}
			
				if(isset($_POST['lname']))

				{			
					$lname=$_POST['lname'];
				
					if(empty($lname)){

					$error_message="Last Name Required";
					
	
					}					
					elseif(!preg_match("/^[a-zA-Z ]*$/", $lname)){


					$error_message="Last Name: Number are not allowed";
					
					
					}
					elseif(strlen($lname) >=30){

					$error_message="Last Name should be less then 30 characters";
					
					
				}
					$array_form_fields['lname']=$lname;
				
			}


				if(isset($_POST['email'])){			
					
					$email=$_POST['email'];
				
					if (empty($email)) {
						# code...
					$error_message="Email Required";
					
				
					}elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
						# code...

					$error_message="Email Invalid Format";
					
				
					}elseif(strlen($email) >50){

					$error_message="Email should be less then 50 characters";
					
					}
					$array_form_fields['email']=$email;					
				
				}
				
				/*if(isset($_POST['password'])){			
					$password=$_POST['password'];	

					if (empty($password)) {
						# code...
					$error_message="Password Required";
					
	
					}

					elseif(strlen($password) < 6 ){

					$error_message="Password should be minimun  of 6 and maximun of 15 characters";
					

					}

					elseif(strlen($password) > 15 ){

					$error_message="Password should be less than 15 characters";
					

					}
					
					

				}*/
				
				$password=substr(number_format(time() * rand(),0,'',''),0,6);
				


				if(isset($_POST['contact_no'])){			
					
					$contact_no=$_POST['contact_no'];
			
					if(empty($contact_no)){

						$error_message="Contact Number Required ";
					}
					
					elseif(!is_numeric($contact_no)) {
						
					$error_message="Contact Number: Only Numbers are allowed ";
					

					}

					elseif(strlen($contact_no) > 10){

					$error_message="Contact Number cannot be more then 10 numbers";
					
					}

					elseif(strlen($contact_no) < 10){

					$error_message="Contact Number cannot be less than 10 numbers";
					
					}

					$array_form_fields['contact_no']=$contact_no;					

				}

				if(isset($_POST['city'])){			
					$city=strtoupper($_POST['city']);

					if($city=='')
					{
						$error_message="City Required";
					}

					elseif(!preg_match("/^[a-zA-Z ]*$/",$city)){
						
					$error_message="City:Number are Not allowed";
					

					}
					elseif(strlen($city) > 30){

					$error_message="City should be less then 30 characters";
					
					}
					$array_form_fields['city']=$city;					
					
				}
				
				if(isset($_POST['state'])){			
					
					$state=strtoupper($_POST['state']);

					if($state=='')
					{

						$error_message="State Required ";
					}

					elseif(!preg_match("/^[a-zA-Z ]*$/",$state)){
					$error_message="State:Number are not allowed";
					

					}elseif(strlen($state) > 30){

					$error_message="State should be less then 30 characters";
					
					}
					$array_form_fields['state']=$state;					
					

				}

				if(isset($_POST['zipcode'])){			
				
					$pin=$_POST['zipcode'];
					
					if(empty($pin)){

					$error_message="Zipcode Required";
					

					}

					else if(!is_numeric($pin)) {
						
					$error_message="ZipCode:Only Numbers are allowed";
					

					}elseif(strlen($pin) > 6){

					$error_message="ZipCode cannot be more than 6 number";
					
					}

					$array_form_fields['pin']=$pin;								

				}
				
				if(isset($_POST['org_name'])){			
					
					$org_name=$_POST['org_name'];
				
					if(empty($org_name)){
					$error_message="Organisation Name Required";
					
					}
					elseif(!preg_match("/^[a-zA-Z ]*$/", $org_name)){
						
					$error_message="Organisation Name: Only Alphabets Allowed";
					

					}elseif(strlen($org_name) > 100){

					$error_message="Organisation Name should not be larger than  100 characters";
					
					}

					$array_form_fields['org_name']=$org_name;								
		
				}
				
				if(isset($_POST['desig'])){			
					
					$desig=$_POST['desig'];
				
					if(empty($desig)){
					$error_message="Designation Required";
					
					}elseif(!preg_match("/^[a-zA-Z ]*$/", $desig)){
						
					$error_message="Designation Name: Only Alphabets Allowed";
					

					}elseif(strlen($desig) > 50){

					$error_message="Designation should not be larger than 50 characters";
					
					}
					$array_form_fields['desig']=$desig;								
					
				}

					if(isset($_POST['user_type'])){			
					
					$user_type=$_POST['user_type'];
				
					if($user_type==''){
					$error_message="Select User Type ";
					
					}
					$array_form_fields['user_type']=$user_type;								
		
				}

		
				
				$_SESSION['FORM_FIELDS']=$array_form_fields;
							if(!empty($error_message))
						{
				$_SESSION['ERROR_USER_ADD']=$error_message;
					echo "<script type='text/javascript'>window.location='?module=user&action=create_user';</script>";
					exit();
						}
				
				
				$ipaddress = '';
    					if ($_SERVER['HTTP_CLIENT_IP'])
        			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
   					 	else if($_SERVER['HTTP_X_FORWARDED_FOR'])
        			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    					else if($_SERVER['HTTP_X_FORWARDED'])
        			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    					else if($_SERVER['HTTP_FORWARDED_FOR'])
        			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    					else if($_SERVER['HTTP_FORWARDED'])
        			$ipaddress = $_SERVER['HTTP_FORWARDED'];
    					else if($_SERVER['REMOTE_ADDR'])
        			$ipaddress = $_SERVER['REMOTE_ADDR'];
    					else
        			$ipaddress = 'UNKNOWN';
 				
				$obj_save_user->setEmail($email);
				$result = $obj_save_user_dao->read_by_email($obj_save_user);
				#check Contact No Exists

				$obj_save_user->setContactNo($contact_no);

				$chk_contact_exist = $obj_save_user_dao->checkContactExist($obj_save_user);

				
				if($result==0){

					if($chk_contact_exist == false){

				//SEND EMAIL--START
						require("./PHPMailer_5.2.0/class.phpmailer.php");
						$mail = new PHPMailer();
						$mail->IsSMTP();                                      // set mailer to use SMTP
						$mail->Host = "mail.kuhipaat.in";  // specify main and backup server
						$mail->SMTPAuth = true;     // turn on SMTP authentication
						$mail->Username = "vikas.dimri@openskiez.com";  // SMTP username
						$mail->Password = "Vikas@123"; // SMTP password

						$mail->From = "info@shapingtomorrow.in";
						$mail->FromName = "Support Shapping Tomorrow";
						$mail->AddAddress($email, "Shapping Tomorrow");
						$mail->AddAddress($email);                  // name is optional
						$mail->AddReplyTo($email, "Information");
						$mail->WordWrap = 50;                                 // set word wrap to 50 characters						
						$mail->IsHTML(true);                                  // set email format to HTML
						
						$mail->Subject = "Password Reset Code";									
						
						$mail->Body    = "Your Account has been created in ST File Management System. Please use the below code to reset your password.<br/>
										Your OTP ".$password.". Your user name is ".$email." <br/>
										<br/>
										Please use this OTP for first login and to set up your Password";
						
						$send_email_status=1;
						$mail->AltBody = "This is the body in plain text for non-HTML mail clients";

						if(!$mail->Send() ){

						$send_email_status=0;
						 }

						//SEND EMAIL--END

				if($send_email_status==1){
				
				$password_encode = base64_encode($password);

				$obj_save_user->setEmail($email);
				$obj_save_user->setPassword($password_encode);
				$obj_save_user->setUserType($user_type);
				$obj_save_user->setSalutation($salutation);
				$obj_save_user->setFirstName($fname);
				$obj_save_user->setLastName($lname);
				$obj_save_user->setContactNo($contact_no);
				$obj_save_user->setState($state);
				$obj_save_user->setCity($city);
				$obj_save_user->setPin($pin);
				$obj_save_user->setPasswordCreated($password_created);
				$obj_save_user->setIpAddress($ipaddress);
				$obj_save_user->setOrgName($org_name);
				$obj_save_user->setDesignation($desig);

				

					$result2 = $obj_save_user_dao->insert_users($obj_save_user);
		
						
					$message="User Successfully created";
					$_SESSION['USER_ADD_SUCCESS']=$message;
					$_SESSION['FORM_FIELDS']='';
					echo "<script type='text/javascript'>window.location='?module=user&action=view_user';</script>";
					exit();
					}
				}

					else{

					$error_message="Contact Number Already Exists";
					$_SESSION['ERROR_USER_ADD']=$error_message;
					echo "<script type='text/javascript'>window.location='?module=user&action=create_user';</script>";
					exit();

				}

			}

				
				else
				{
					$error_message="Email already Registered";
					$_SESSION['ERROR_USER_ADD']=$error_message;
					echo "<script type='text/javascript'>window.location='?module=user&action=create_user';</script>";
					exit();
				}

			}
			
				if($action == "log_out"){
					
					include './classes/User.php';

						$obj_log_out = new User();
						$obj_log_out_dao = new UserDAO();
						
						$result = $obj_log_out_dao->logout($obj_log_out);
						if($result=1){
						echo "<script type='text/javascript'>window.location='?';</script>";
						exit();	
						}
						

				}
				
					if($action == "delete_user"){
					
					include './classes/ProjectMaster.class.php';
					$obj_project_dao=new ProjectDAO();
					$obj_project=new Project();
					
					include './classes/ProjectDetails.class.php';
					$obj_project_details=new ProjectDetails();
					$obj_project_details_dao=new ProjectDetailsDAO();
					
					include './classes/User.php';
					$obj_user=new User();
					$obj_user_dao=new UserDAO();

					
					
					if(isset($_GET['id'])){			
					
					$user_id=base64_decode($_GET['id']);
					if(empty($user_id)){
					$error_message="No User Id ";
					echo "<script type='text/javascript'>window.location='?module=user&action=view_user';</script>";
					exit();	

					
					}

				}
						$obj_project->setProjectLeader($user_id);
						$result = $obj_project_dao->check_project_status_by_id($obj_project);
						if($result==true){
						$error_message="User has an incomplete Project. Can't Delete User";
						$_SESSION['USER_DELETE_FAILURE']=$error_message;
						echo "<script type='text/javascript'>window.location='?module=user&action=view_user';</script>";
						exit();	
						}
						else{
						$obj_project_details->setUserId($user_id);
						$result = $obj_project_details_dao->check_project_details_status_by_user_id($obj_project_details);
						if($result==true){
						$error_message="User has an incomplete Task. Can't Delete User";
						$_SESSION['USER_DELETE_FAILURE']=$error_message;
						echo "<script type='text/javascript'>window.location='?module=user&action=view_user';</script>";
						exit();	
						}
						else{
						$obj_user->setId($user_id);
						$result = $obj_user_dao->deleteUser($obj_user);
							if($result==true){
						$message="User Deleted Successfully";
						$_SESSION['USER_DELETE_SUCCESS']=$message;
						echo "<script type='text/javascript'>window.location='?module=user&action=view_user';</script>";
						exit();	
							}else{
								$error_message="Couldn't be deleted";
								$_SESSION['USER_DELETE_FAILURE']=$error_message;
							echo "<script type='text/javascript'>window.location='?module=user&action=view_user';</script>";
							exit();
							}
						}
						}
						

				}

				
				
		}
		
		elseif($module == "project"){
			if($action == "project_add"){
				
				if(!isset($_SESSION)){session_start();}
				include './classes/User.php';
				$obj_user_class=new User();
				$obj_user_class_dao=new UserDAO();	

				$list=$obj_user_class_dao->readAll();
				
				$obj_user_class->setEmail($_SESSION['user_email']);
				$user_list=$obj_user_class_dao->read_all_users_by_usertype($obj_user_class);
				
				$admin_list=$obj_user_class_dao->read_all_users_by_usertype_admin($obj_user_class);
				
				
				include 'views/'.$action.'.php';
								if(!isset($_SESSION)){session_start();}

				$_SESSION['FORM_FIELDS']=NULL;
			}
			
			if($action == "create_project"){
				if(!isset($_SESSION)){session_start();}
				$_SESSION['FORM_FIELDS']=NULL;
				include './classes/ProjectMaster.class.php';
				$obj_project_dao=new ProjectDAO();
				$obj_project=new Project();
				
				$project_name='';
				$project_leader='';
				$project_start_date='';
				$project_end_date='';
				$project_description='';
				$project_created_by='';
				$project_created_date='';
				$project_modified_by='';
				$project_modified_date='';
				$project_is_completed='1';
				$project_code='';
				$array_form_fields=array();

				if(isset($_POST['pr_name'])){			
					$project_name=$_POST['pr_name'];

					if(empty($project_name)){

					$error_message="Project Name Required";
					}
					elseif(!preg_match("/^[a-zA-Z][a-zA-Z0-9-_\.\@ ]*$/", $project_name)){

					$error_message="Project Name should have only numbers and letters with '_', '@' and '.' allowed";

					}elseif (strlen($project_name) > 30) {
					
					$error_message="Project name should not be greater than 30 characters";
					
					}
					//$project_name=$_POST['pr_name'];
					$array_form_fields['project_name']=$project_name;
					
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

				}



					if(isset($_POST['pr_desc'])){			
					
					
					$project_description=$_POST['pr_desc'];

					if(empty($project_description)){
					$error_message="Project Description Required ";

					}
					elseif(!preg_match("/^[a-zA-Z][a-zA-Z0-9-_\.\@ ]*$/", $project_description)){

					$error_message="Project Description can have only numbers and letters with '_', '@' and '.' allowed";

					}
					elseif (strlen($project_description) > 500) {
					
					$error_message="Project Description should be less than 500 characters";
					
					}
					$array_form_fields['project_desc']=$project_description;

				}
				
				
					if(isset($_POST['project_owner'])){

					$store_owner=$_POST['project_owner'];
					
					if(count($store_owner)==0){

					$error_message="Select Project Members ";

					}elseif(!empty($store_owner)){

						$store_owner2='';
						foreach($store_owner as $project_owner1){
    								
    					$store_owner2.= base64_decode($project_owner1) .",";
						}
					}	

				}
				if(isset($_POST['pr_remark'])){			
					
					
					$project_remark=$_POST['pr_remark'];
				if(!empty($project_remark)){
					if(!preg_match("/^[a-zA-Z][a-zA-Z0-9-_\.\@ ]*$/", $project_remark)){

					$error_message="Special Notes can have only numbers and letters with '_', '@' and '.' allowed";

					}
					elseif (strlen($project_remark) > 500) {
					
					$error_message="Special Notes should be less than 500 characters";
					}
				}
					$array_form_fields['project_remark']=$project_remark;
				}
				
				$_SESSION['FORM_FIELDS']=$array_form_fields;
							if(!empty($error_message))
						{
				$_SESSION['ERROR_PROJECT_ADD']=$error_message;						
				echo "<script type='text/javascript'>window.location='?module=project&action=project_add';</script>";
						exit();		
						}
				$_SESSION['ERROR_PROJECT_ADD']=NULL;
						
				$project_created_by=$_SESSION['first_name']. $_SESSION['last_name'];
				
				
				$date_1 = DateTime::createFromFormat( 'd/m/Y', $project_start_date );
				$project_start_date_1 = $date_1->format( 'Y-m-d' );
				
				$date_2 = DateTime::createFromFormat( 'd/m/Y', $project_end_date );
				$project_end_date_2 = $date_2->format( 'Y-m-d' );
				
				$obj_project->setProjectName($project_name);
				$obj_project->setProjectLeader($project_leader);
				$obj_project->setProjectStartDate($project_start_date_1);
				$obj_project->setProjectEndDate($project_end_date_2);
				$obj_project->setProjectDescription($project_description);
				$obj_project->setCreatedBy($project_created_by);
				$obj_project->setCreatedDate($project_created_date);
				$obj_project->setModifiedBy($project_modified_by);
				$obj_project->setModifiedDate($project_modified_date);
				$obj_project->setIsCompleted($project_is_completed);
				//$obj_project->setProjectCode($project_code);
				$obj_project->setProjectOwner($store_owner2);
				$obj_project->setProjectRemark($project_remark);
				
				$result=$obj_project_dao->insert_project_master($obj_project);
				if($result = TRUE){
				$message="Project Successfully created";
				$_SESSION['PROJECT_ADD_SUCCESS']=$message;
				echo "<script type='text/javascript'>window.location='?module=project&action=project_view';</script>";
				$_SESSION['FORM_FIELDS']=NULL;
				exit();
				}
				else
				{
					$error_message="Project Couldn't be created";
					$_SESSION['ERROR_PROJECT_ADD']=$error_message;
					echo "<script type='text/javascript'>window.location='?module=project&action=project_add';</script>";
					exit();
				}
			}
			
			
			
			if($action == "project_view"){
				
				include './classes/ProjectMaster.class.php';
				$obj_project_class=new Project();
				$obj_project_class_dao=new ProjectDAO();	

				$list=$obj_project_class_dao->getAllProjects();
				
				
				$user_task_result = $obj_project_class_dao->get_projects_by_member($_SESSION['user_id']);
				
				
				
				$obj_project_class->setProjectLeader($_SESSION['user_id']);
				
				$result=$obj_project_class_dao->get_projects_by_leader($obj_project_class);
				
				
				
				include './classes/ProjectDetails.class.php';
				$obj_project_details=new ProjectDetails();
				$obj_project_details_dao=new ProjectDetailsDAO();


								
				include 'views/'.$action.'.php';
			}
			
			if($action == "project_view_complete"){
				
				include './classes/ProjectMaster.class.php';
				$obj_project_class=new Project();
				$obj_project_class_dao=new ProjectDAO();	

				$list=$obj_project_class_dao->get_all_completed_projects();
				
				
				include './classes/ProjectDetails.class.php';
				$obj_project_details=new ProjectDetails();
				$obj_project_details_dao=new ProjectDetailsDAO();


								
				include 'views/'.$action.'.php';
			}
			
			if($action == "project_view_task"){
				
				$page='';
				$num_rec_per_page=5;
				
				
				$project_id=base64_decode($_GET['id']);
				$complete_status=base64_decode($_GET['status']);
				$_SESSION['PROJECT_ID']=$_GET['id'];
				$_SESSION['PROJECT_STATUS']=$_GET['status'];
				
				
				include './classes/ProjectMaster.class.php';
				$obj_project_class=new Project();
				$obj_project_class_dao=new ProjectDAO();
				
				
				$obj_project_class->setId($project_id);	

				$project_list=$obj_project_class_dao->getProjectById($obj_project_class);
				foreach($project_list as $data){$owner=$data->getProjectOwner();} 
				
				
				include './classes/ProjectDetails.class.php';
				$obj_project_details_dao=new ProjectDetailsDAO();
				$obj_project_details=new ProjectDetails();
				
				
				if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
				$start_from = ($page-1) * $num_rec_per_page;
				$slno = $start_from + 1; 
				
				
				$obj_project_details->setProjectId($project_id);
				
				$totalrow=$obj_project_details_dao->countProjectDetailsByProjectId($obj_project_details);
				
				$number_of_pages = ceil($totalrow/$num_rec_per_page);
				
				$obj_project_details->setProjectId($project_id);
				$obj_project_details->setStartForm($start_from);
				$obj_project_details->setNumRecPerPage($num_rec_per_page);
				
				
				//$obj_project_details->setProjectId($project_id);

				$list=$obj_project_details_dao->getProjectDetailsByProjectId($obj_project_details);
				
				include './classes/User.php';
				$obj_user_class=new User();
				$obj_user_class_dao=new UserDAO();
				
				$all_user_list=$obj_user_class_dao->readAll();
				
				$obj_user_class->setEmail($_SESSION['user_email']);
				$user_list=$obj_user_class_dao->read_all_users_by_usertype($obj_user_class);

								
				include 'views/project_view_task.php';
			}
			if($action == "project_edit_task"){
				include 'views/project_edit_task.php';
			}
			if($action == "project_add_task"){
				
				$project_id=base64_decode($_GET['id']);
				$project_status=base64_decode($_GET['status']);
				include './classes/ProjectMaster.class.php';
				$obj_project_class=new Project();
				$obj_project_class_dao=new ProjectDAO();	

				$list=$obj_project_class_dao->get_project_owner_from_project_id($project_id);
				
				$obj_project_class->setId($project_id);
				$date=$obj_project_class_dao->get_project_start_end_date_by_project_id($obj_project_class);

				
				include './classes/User.php';
				$obj_user_class=new User();
				$obj_user_class_dao=new UserDAO();	

				include 'views/project_add_task.php';
				$_SESSION['FORM_FIELDS']=NULL;
			}
			
			if($action == "project_create_task"){
				if(!isset($_SESSION)){session_start();}
				$_SESSION['FORM_FIELDS']=NULL;
				$array_form_fields='';
				//$project_id=base64_decode($_GET['id']);
				include './classes/ProjectDetails.class.php';
				$obj_project_details_dao=new ProjectDetailsDAO();
				$obj_project_details=new ProjectDetails();
				
					 $project_id='';
					 $project_status='';
					 $task_name='';
					 $task_description='';
					 $task_start_date='';
					 $task_end_date='';
					 $task_owner='';
					 $priority='';
					 $remarks='';
					 $task_created_by='';
					 $task_created_date='';
					 $task_modified_by='';
					 $task_modified_date='';
					 $task_is_completed='1';
					 $task_delegated_id='';
					 
				if(isset($_POST['project_id']) && $_POST['project_id']!=''){			
					$project_id=base64_decode($_POST['project_id']);
					$project_id2=$_POST['project_id'];
				}
				if(isset($_POST['project_status']) && $_POST['project_status']!=''){			
					$project_status=$_POST['project_status'];
				}
				

				if(isset($_POST['task_name'])){

					$task_name=$_POST['task_name'];

					if(empty($task_name)){

					$error_message="Task Name Required";
					

					}elseif (!preg_match("/^[a-zA-Z][a-zA-Z0-9-_\.\@ ]*$/", $task_name)){
						
					$error_message="Task name should have only numbers and letters with '_', '@' and '.' allowed";
					
					
					}elseif (strlen($task_name) > 100){
			
					$error_message="Task Name should be less than 100 characters";
					

					}
					$array_form_fields['task_name']=$task_name;

					
				}

				if(isset($_POST['task_owner'])){			
					$task_owner=$_POST['task_owner'];

					if($task_owner==''){

					$error_message="Select Task Assign To";
					
					}
					$array_form_fields['task_owner']=$task_owner;

				}

				if(isset($_POST['task_priority'])){			
					$priority=$_POST['task_priority'];

					if($priority==''){

					$error_message="Select Task Priority";
					
					}
					$array_form_fields['task_priority']=$priority;					

				}



				if(isset($_POST['project_start_date'])){			
					
					$project_start_date=$_POST['project_start_date'];

					if(empty($project_start_date)){

					$error_message="Project Strat Dat Cannot Be empty";
					
					}

					elseif(!preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4}$/",$project_start_date)){

					$error_message="Invalid Project Start Date Format";
					
					}
					$array_form_fields['project_start_date']=$project_start_date;					

				}
				
					if(isset($_POST['project_end_date'])){			
					
					$project_end_date=$_POST['project_end_date'];

					if(empty($project_end_date)){

					$error_message="Project End Date Found Empty";
					
					}

					elseif(!preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4}$/",$project_end_date)){

					$error_message="Invalid Project end Date Format";
					
					}
					$array_form_fields['project_end_date']=$project_end_date;					

				}

				
				
				if(isset($_POST['task_start_date'])){			
					
					$task_start_date=$_POST['task_start_date'];

					if(empty($task_start_date)){

					$error_message="Select Task Start Date";
					
					}

					elseif(!preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4}$/",$task_start_date)){

					$error_message="Invalid Date Format";
					
					}
					$array_form_fields['task_start_date']=$task_start_date;					
				}


				if(isset($_POST['task_end_date'])){			
					
					$task_end_date=$_POST['task_end_date'];

					if(empty($task_end_date)){

					$error_message="Select Task End Date";
					
					}

					elseif(!preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4}$/",$task_end_date)){

					$error_message="Invalid Date Format";
					
					}
					$array_form_fields['task_end_date']=$task_end_date;					

				}
				
				
				$date_1 = DateTime::createFromFormat( 'd/m/Y', $task_start_date );
				$task_start_date_1 = $date_1->format( 'Y-m-d' );
				
				$date_2 = DateTime::createFromFormat( 'd/m/Y', $task_end_date );
				$task_end_date_2 = $date_2->format( 'Y-m-d' );
				
				$date_3 = DateTime::createFromFormat( 'd/m/Y', $project_start_date );
				$project_start_date_2 = $date_3->format( 'Y-m-d' );
				
				$date_4 = DateTime::createFromFormat( 'd/m/Y', $project_end_date );
				$project_end_date_2 = $date_4->format( 'Y-m-d' );


				if($task_start_date_1<$project_start_date_2 || $task_start_date_1>$project_end_date_2)
				{
					$error_message="Task Start Date Should Be Between Project Start Date And End Date";
					
				}
					elseif($task_end_date_2<$project_start_date_2 || $task_end_date_2>$project_end_date_2)
				{
					$error_message="Task End Date Should Be Between Project Start Date And End Date";
					
				}
				
				elseif($task_start_date_1>$task_end_date_2)
				{
					$error_message="Task Start Date Cannot be after Task End Date";
					
				}
				
				elseif($task_end_date_2<$task_start_date_1)
				{
					$error_message="Task End Date Cannot be before Task Start Date";
					
				}
				else{
					$error_message='';
				}
					
				
				if(isset($_POST['task_desc'])){			
					$task_desc=$_POST['task_desc'];

					if(empty($task_desc)){

					$error_message="Task Description Required";
					
					
					}elseif(strlen($task_desc) > 500 ){

					$error_message="Task Description should be less than 500 characters";
					
					}
					elseif(!preg_match("/^[a-zA-Z][a-zA-Z0-9-_\.\@\, ]*$/", $task_desc)){

					$error_message="Task Description can have only numbers and letters with '_', '@', ',' and '.' allowed";
					

					}

					$array_form_fields['task_desc']=$task_desc;					

				}
				
				if(isset($_POST['task_remark'])){			
					$task_remark=$_POST['task_remark'];

					if(strlen($task_remark) > 500 ){

					$error_message="Task Remark should be less than 500 characters";
					
					}
					elseif(!preg_match("/^[a-zA-Z][a-zA-Z0-9-_\.\@ ]*$/", $task_remark)){

					$error_message="Task Remark can have only numbers and letters with '_', '@' and '.' allowed";
					

					}
					$array_form_fields['task_remark']=$task_remark;					


				}
				$_SESSION['FORM_FIELDS']=$array_form_fields;
							if(!empty($error_message))
						{
				$_SESSION['ERROR_TASK_ADD']=$error_message;
					echo "<script type='text/javascript'>window.location='?module=project&action=project_add_task&id=$project_id2&status=$project_status';</script>";
					exit();	
						}
				
					$task_created_by=$_SESSION['first_name']. $_SESSION['last_name'];
				$_SESSION['FORM_FIELDS']=NULL;
				
				
				$obj_project_details->setProjectId($project_id);
				$obj_project_details->setTaskName($task_name);
				$obj_project_details->setTaskDescription($task_desc);
				$obj_project_details->setTaskStartDate($task_start_date_1);
				$obj_project_details->setTaskEndDate($task_end_date_2);
				$obj_project_details->setRemarks($task_remark);
				$obj_project_details->setUserId($task_owner);
				$obj_project_details->setPriority($priority);
				$obj_project_details->setCreatedBy($task_created_by);
				$obj_project_details->setCreatedDate($task_created_date);
				$obj_project_details->setModifiedBy($task_modified_by);
				$obj_project_details->setModifiedDate($task_modified_date);
				$obj_project_details->setIsCompleted($task_is_completed);
				
				$result=$obj_project_details_dao->insert_project_details($obj_project_details);
				if($result=1){
				$message="Task Successfully created";
				$_SESSION['TASK_ADD_SUCCESS']=$message;
							
				echo "<script type='text/javascript'>window.location='?module=project&action=project_view_task&id=$project_id2&status=$project_status';</script>";
				exit();
				}

			}
			
			if($action == "project_delete_task"){
				
				$task_id=base64_decode($_GET['id']);
				
				include './classes/ProjectDetails.class.php';
				$obj_project_details_dao=new ProjectDetailsDAO();
				$obj_project_details=new ProjectDetails();	
				
				$obj_project_details->setId($task_id);
				
				$obj_project_details_dao->delete_task($obj_project_details);
				
			}
			if($action == "project_delete"){
				
				$project_id=base64_decode($_GET['id']);
				
				include './classes/ProjectMaster.class.php';
				$obj_project_dao=new ProjectDAO();
				$obj_project=new Project();	
				
				$obj_project->setId($project_id);
				
				$result=$obj_project_dao->delete_project($obj_project);
				
				include './classes/ProjectDetails.class.php';
				$obj_project_details_dao=new ProjectDetailsDAO();
				$obj_project_details=new ProjectDetails();	
				
				$obj_project_details->setProjectId($project_id);
				
				$obj_project_details_dao->delete_task_by_project_id($obj_project_details);

				if($result==true){
					$error_message="Project Deleted successfully";
									$_SESSION['PROJECT_DELETE_SUCCESS']=$error_message;
									echo "<script type='text/javascript'>window.location='?module=project&action=project_view';</script>";
									exit();
				}
				else{
					$error_message="Project Couldn't Be Deleted";
									$_SESSION['PROJECT_DELETE_FAILURE']=$error_message;
									echo "<script type='text/javascript'>window.location='?module=project&action=project_view';</script>";
									exit();
				}
				
				
				}
			
			if($action == "update_task_completed"){
				
				$task_id=base64_decode($_GET['id']);
				$isComplete=base64_decode($_GET['status']);
				
				include './classes/ProjectDetails.class.php';
				$obj_project_details_dao=new ProjectDetailsDAO();
				$obj_project_details=new ProjectDetails();	
				
				$obj_project_details->setId($task_id);
				$obj_project_details->setIsCompleted($isComplete);
				
				$obj_project_details_dao->update_task_completed($obj_project_details);
				
			}
			
				if($action == "update_project_completed"){
				
				$project_id=base64_decode($_GET['id']);
				$isComplete=base64_decode($_GET['status']);
				
				include './classes/ProjectMaster.class.php';
				$obj_project_dao=new ProjectDAO();
				$obj_project=new Project();	
				
				$obj_project->setId($project_id);
				$obj_project->setIsCompleted($isComplete);
				
				$obj_project_dao->update_project_completed($obj_project);
				
			}

			
		}
		
		elseif($module == "remark"){
			if($action == "view_add_remark"){
				$task_id=base64_decode($_GET['id']);
				$task_id_link=$_GET['id'];
				$_SESSION['PROJECT_STATUS']=$_GET['status'];
				include 'views/view_add_remark.php';
			}
			if($action == "create_remark"){
				
				 $task_id='';
				 $remarks='';
				 $user_id='';
				 $created_by='';
				 $created_date='';
				 $remark_link='';
				 $project_status=$_SESSION['PROJECT_STATUS'];
				 $task_enddate='';
				 $task_startdate='';
				 $change_task_priority='';
				 $change_task_status='';
				 $delegated_to='';
				 $first_name='';
				 $last_name='';
				 
				

					//$task_id=base64_decode($_GET['id']);
				
				include './classes/Remarks.class.php';
				$obj_remark_dao=new RemarksDAO();
				$obj_remark=new Remarks();	
				
				include './classes/ProjectDetails.class.php';
				$obj_project_details_dao=new ProjectDetailsDAO();
				$obj_project_details=new ProjectDetails();	
				
			
	
								if(isset($_POST['task_id']) && $_POST['task_id']!=''){			
									$task_id=($_POST['task_id']);
									$task_id2=base64_encode($_POST['task_id']);
								}
								
								if(isset($_SESSION['first_name'])){			
									$first_name=$_SESSION['first_name'];
									}
									
								if(isset($_SESSION['last_name'])){			
									$last_name=$_SESSION['last_name'];
									}
								
								$created_by=$first_name." ".$last_name;		

								if(isset($_POST['delegated_to']) ){			
									$delegated_to=($_POST['delegated_to']);

								}

								if(isset($_POST['task_enddate'])) {			
									$task_enddate=($_POST['task_enddate']);


									if(empty($task_enddate)){
									$error_message="Task End Date Required ";
									$_SESSION['ERROR_REMARK_ADD']=$error_message;
									echo "<script type='text/javascript'>window.location='?module=remark&action=view_remark&id=$task_id2&status=$project_status';</script>";
									exit();
									}

									elseif(!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$task_enddate)){

									$error_message="Invalid Date Format";
									$_SESSION['ERROR_REMARK_ADD']=$error_message;
									echo "<script type='text/javascript'>window.location='?module=remark&action=view_remark&id=$task_id2&status=$project_status';</script>";
									exit();
							
									}


								}
								
								if(isset($_POST['task_startdate'])) {			
									$task_startdate=($_POST['task_startdate']);


									if(empty($task_startdate)){
									$error_message="Task End Date Required ";
									$_SESSION['ERROR_REMARK_ADD']=$error_message;
									echo "<script type='text/javascript'>window.location='?module=remark&action=view_remark&id=$task_id2&status=$project_status';</script>";
									exit();
									}

									elseif(!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$task_startdate)){

									$error_message="Invalid Date Format";
									$_SESSION['ERROR_REMARK_ADD']=$error_message;
									echo "<script type='text/javascript'>window.location='?module=remark&action=view_remark&id=$task_id2&status=$project_status';</script>";
									exit();
							
									}


								}
								
								if(isset($_POST['change_task_priority'])){			
									$change_task_priority=($_POST['change_task_priority']);

									if($change_task_priority==''){
									
									$message="Select Change priority ";
									$_SESSION['ERROR_REMARK_ADD']=$message;
									echo "<script type='text/javascript'>window.location='?module=remark&action=view_remark&id=$task_id2&status=$project_status';</script>";
									exit();

									}

								}
								
								if(isset($_POST['change_task_status'])){			
									$change_task_status=($_POST['change_task_status']);


									if($change_task_status==''){
									
									$message="Select Change Status ";
									$_SESSION['ERROR_REMARK_ADD']=$message;
									echo "<script type='text/javascript'>window.location='?module=remark&action=view_remark&id=$task_id2&status=$project_status';</script>";
									exit();

									}


								}

								if(isset($_POST['text_remark'])){			
									$remarks=($_POST['text_remark']);

								if(empty($remarks)){
								$error_message="Remark Required ";
								$_SESSION['ERROR_REMARK_ADD']=$error_message;
								echo "<script type='text/javascript'>window.location='?module=remark&action=view_remark&id=$task_id2&status=$project_status';</script>";
									exit();

								}elseif (strlen($remarks) > 250) {
								
								$error_message="Remark should be less than 250 characters";
								$_SESSION['ERROR_REMARK_ADD']=$error_message;
								echo "<script type='text/javascript'>window.location='?module=remark&action=view_remark&id=$task_id2&status=$project_status';</script>";
									exit();
					
									}

								}
								
								if($_FILES['file']['name']==''){
									
									$obj_remark->setTaskId($task_id);
										
											$obj_remark->setUserId($user_id);
											$obj_remark->setCreatedBy($created_by);
											$obj_remark->setCreatedDate($created_date);
											$obj_remark->setRemarks($remarks);
											$obj_remark->setRemarkLink($remark_link);											
											$obj_remark->setDelegatedId($delegated_to);
											$obj_remark->setPriority($change_task_priority);
											$obj_remark->setChangeEndDate($task_enddate);
											$obj_remark->setChangeStartDate($task_startdate);
											$obj_remark->setStatus($change_task_status);
											$result=$obj_remark_dao->insert_remarks($obj_remark);
											
											
											$obj_project_details->setId($task_id);
											$obj_project_details->setIsCompleted($change_task_status);
											$obj_project_details->setTaskEndDate($task_enddate);
											$obj_project_details->setTaskStartDate($task_startdate);													
											$obj_project_details->setPriority($change_task_priority);	
											$obj_project_details->setDelegatedId($delegated_to);	
											$obj_project_details->setModifiedBy($created_by);										
											
				
											$obj_project_details_dao->updateProjectDetailsWhenDelicated($obj_project_details);


                    			//echo" File uploaded !";

                			
                    			$message="Task Successfully Updated";
								$_SESSION['REMARK_ADD_SUCCESS']=$message;
								echo "<script type='text/javascript'>window.location='?module=remark&action=view_remark&id=$task_id2&status=$project_status';</script>";
								exit();

									
									
									
								}
								else{
								$file_max_weight = 300000000; //limit the maximum size of file allowed (300Mb)

								$ok_ext = array('jpg','JPG','png','jpeg','txt','ppt','xlsx','ppx','csv','xls','pdf','doc'); // allow only these types of files

								$destination = 'uploads/'; // where our files will be stored


								$file = $_FILES['file'];


								$filename = explode(".", $file["name"]); 


								$file_name = $file['name']; // file original name

								$file_name_no_ext = isset($filename[0]) ? $filename[0] : null; // File name without the extension

								$file_extension = $filename[count($filename)-1];

								$file_weight = $file['size'];
								
								

								$file_type = $file['type'];



								// If there is no error
								if( $file['error'] == 0 )
									{
    							// check if the extension is accepted
    							if( in_array($file_extension, $ok_ext)):

        						// check if the size is not beyond expected size
        						if( $file_weight <= $file_max_weight ):
								
								$fileNamewithpath=$destination.$file_name;
								
								if (!file_exists($fileNamewithpath)):

                				// rename the file
                				//$fileNewName = md5( $file_name_no_ext[0].microtime() ).'.'.$file_extension ;
								$fileNewName=$file['name'];
								
                				// and move it to the destination folder
                				if( move_uploaded_file($file['tmp_name'], $destination.$fileNewName) ):
				
										$remark_link=$fileNewName;
	
											$obj_remark->setTaskId($task_id);
										
											$obj_remark->setUserId($user_id);
											$obj_remark->setCreatedBy($created_by);
											$obj_remark->setCreatedDate($created_date);
											$obj_remark->setRemarks($remarks);
											$obj_remark->setRemarkLink($remark_link);											
											$obj_remark->setDelegatedId($delegated_to);
											$obj_remark->setPriority($change_task_priority);
											$obj_remark->setChangeEndDate($task_enddate);
											$obj_remark->setChangeStartDate($task_startdate);											
											$obj_remark->setStatus($change_task_status);
											$result=$obj_remark_dao->insert_remarks($obj_remark);
											
											
											$obj_project_details->setId($task_id);
											$obj_project_details->setIsCompleted($change_task_status);
											$obj_project_details->setTaskEndDate($task_enddate);
											$obj_project_details->setTaskStartDate($task_startdate);																									
											$obj_project_details->setPriority($change_task_priority);	
											$obj_project_details->setDelegatedId($delegated_to);	
											$obj_project_details->setModifiedBy($created_by);										
											
				
											$obj_project_details_dao->updateProjectDetailsWhenDelicated($obj_project_details);


                    			//echo" File uploaded !";

                			
                    			$message="Task Successfully Updated";
								$_SESSION['REMARK_ADD_SUCCESS']=$message;
								echo "<script type='text/javascript'>window.location='?module=remark&action=view_remark&id=$task_id2&status=$project_status';</script>";
								exit();

                				endif;

							else:
								
								echo '<script language="javascript">';
								echo 'alert("This filename already exist. Please change your File name")';
								echo '</script>';
								$message="This filename already exist. Please change your File name";
								$_SESSION['ERROR_REMARK_ADD']=$message;
								echo "<script type='text/javascript'>window.location='?module=remark&action=view_remark&id=$task_id2&status=$project_status';</script>";
								exit();


        						endif;
        					else:

           						$message="File size is too large.";
								$_SESSION['ERROR_REMARK_ADD']=$message;
								echo "<script type='text/javascript'>window.location='?module=remark&action=view_remark&id=$task_id2&status=$project_status';</script>";
								exit();


        						endif;


    						else:

								$message="File type is not supported.";
								$_SESSION['ERROR_REMARK_ADD']=$message;
								echo "<script type='text/javascript'>window.location='?module=remark&action=view_remark&id=$task_id2&status=$project_status';</script>";
								exit();

    							endif;
							}
							
							if($result=1){
								$message="Remark Successfully Added";
								$_SESSION['REMARK_ADD_SUCCESS']=$message;
								echo "<script type='text/javascript'>window.location='?module=remark&action=view_remark&id=$task_id2&status=$project_status';</script>";
								exit();
				}
								}

			}
			if($action == "view_remark"){
				$task_id='';
				$project_id='';
				$page='';
				$num_rec_per_page=5;
				
				
				$task_id=base64_decode($_GET['id']);
				$task_status=$_GET['status'];
				
				$_SESSION['TASK_ID']=$task_id;
				$_SESSION['TASK_STATUS']=$task_status;
				
				include './classes/Remarks.class.php';
				$obj_remarks_dao=new RemarksDAO();
				$obj_remarks=new Remarks();	
				
				
				if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
				$start_from = ($page-1) * $num_rec_per_page;
				$slno = $start_from + 1; 
				
				
				$obj_remarks->setTaskId($task_id);
				
				$totalrow=$obj_remarks_dao->count_remark_task_id($obj_remarks);
				
				$number_of_pages = ceil($totalrow/$num_rec_per_page);
				
				
				
				$obj_remarks->setTaskId($task_id);
				$obj_remarks->setStartForm($start_from);
				$obj_remarks->setNumRecPerPage($num_rec_per_page);
				
				
				$result=$obj_remarks_dao->read_remark_by_task_id($obj_remarks);
				
				include './classes/ProjectDetails.class.php';
				$obj_project_details_dao=new ProjectDetailsDAO();
				$obj_project_details=new ProjectDetails();
				
				$obj_project_details->setId($task_id);	
				
				$result2=$obj_project_details_dao->getProjectDetailsBy_Id($obj_project_details);
				
				include './classes/ProjectMaster.class.php';
				$obj_user=new Project();
				$obj_user_dao=new ProjectDAO();
				
				
				
				include './classes/User.php';
				$obj_user_class=new User();
				$obj_user_class_dao=new UserDAO();
				include 'views/view_remark.php';
			}	

		}
		
			elseif($module == "password"){
					if($action == "forgot_pass_email"){
				include 'views/'.$action.'.php';
			}
			
			
			if($action == "forgot_pass_action"){
				
				include './classes/User.php';
				$obj_user_login=new User();
				$obj_user_login_dao=new UserDAO();
				$email='';
				$password='';
				$key='';
				$token='';
				if(isset($_POST['email'])){
					$email=$_POST['email'];

					if(empty($email)){
			
				$message="Email Required";
					$_SESSION['EMAIL_EXIST_ERROR']=$message;
				echo "<script type='text/javascript'>window.location='?module=password&action=forgot_pass_email';</script>";
				exit();

					}

				}
				
				$obj_user_login->setEmail($email);
				$result=$obj_user_login_dao->check_email_exist($obj_user_login);
				
				if($result==1)
				{
					
					$key = uniqid(mt_rand(), true);
					$token = md5($_POST['email'].$key);
					//echo "Email Exist";
					
					require("./PHPMailer_5.2.0/class.phpmailer.php");
														$mail = new PHPMailer();
														$mail->IsSMTP();    // set mailer to use SMTP
														$mail->Host = "mail.kuhipaat.in";  // specify main and backup server
														$mail->SMTPAuth = true;     // turn on SMTP authentication
														$mail->Username = "vikas.dimri@openskiez.com";  // SMTP username
														$mail->Password = "Vikas@123"; // SMTP password

														$mail->From = "info@shapingtomorrow.in";
														$mail->FromName = "Support Shapping Tomorrow";
														$mail->AddAddress($email, "Shapping Tomorrow");
														$mail->AddAddress($email);                  // name is optional
														$mail->AddReplyTo($email, "Information");
														$mail->WordWrap = 50;                                 // set word wrap to 50 characters						
														$mail->IsHTML(true);                                  // set email format to HTML
														$mail->Subject = "Forgot Password Reset";									
														$mail->Body    = "This link is valid only for 24hrs. <br/> Please click on the below link to reset your password 
														<br/>
														
														http://shapingtomorrow.in/admin/?module=password&action=token&token=".$token."";
														$send_email_status=1;
									$mail->AltBody = "This is the body in plain text for non-HTML mail clients";

									if(!$mail->Send())
									{
										$send_email_status=0;
									}
					
					if($send_email_status==1){
						$obj_user_login->setEmail($email);
						$obj_user_login->setToken($token);
					$result=$obj_user_login_dao->insert_token($obj_user_login);
					
					$message="A Password Reset link has been sent to your Email. Please click on that link to reset your password";
					$_SESSION['EMAIL_EXIST_SUCCESS']=$message;
				echo "<script type='text/javascript'>window.location='?module=password&action=forgot_pass_email';</script>";
				exit();
					}
					
				}
					else
					{
						$message="Email Doesn't Exist";
					$_SESSION['EMAIL_EXIST_ERROR']=$message;
					echo "<script type='text/javascript'>window.location='?module=password&action=forgot_pass_email';</script>";
				exit();
					}
				
				include 'views/'.$action.'.php';
			}

		}
		if($action == "token"){
			
			$token='';
			
			$token=$_GET['token'];
			$_SESSION['token']=$token;
			
			include './classes/User.php';
				$obj_user_login=new User();
				$obj_user_login_dao=new UserDAO();
				
				$obj_user_login->setToken($token);
				$result=$obj_user_login_dao->check_token_exist($obj_user_login);
				
				if($result==1)
				{
					include 'views/forgot_pass_reset.php';
				}
				else
				{
					$message="Password Reset Link Failed";
					$_SESSION['ERROR_PASSWORD_TOKEN']=$message;
				echo "<script type='text/javascript'>window.location='?module=password&action=forgot_pass_email';</script>";
				exit();
				}
			

		}
		if($action == "forgot_pass_reset_action"){
			
			$new_pass='';
			$conf_pass='';
			$token=$_SESSION['token'];
			
			if(isset($_POST['new_pass'])){
					
					$new_pass2=$_POST['new_pass'];
					$new_pass=base64_encode($new_pass2);

					if (empty($new_pass2)) {
					
					$error_message="Password Required";
					$_SESSION['ERROR_FORGOT_PASSWORD_RESET']=$error_message;
					echo "<script type='text/javascript'>window.location='?module=password&action=token&token=".$token."';</script>";
					exit();
	
					}

					elseif(strlen($new_pass2) < 6 ){

					$error_message="Password should be minimun  of 6 and maximun of 15 characters";																			
					$_SESSION['ERROR_FORGOT_PASSWORD_RESET']=$error_message;
					echo "<script type='text/javascript'>window.location='?module=password&action=token&token=".$token."';</script>";
					exit();

					}

					elseif(strlen($new_pass2) > 15 ){

					$error_message="Password should be less than 15 characters";
					$_SESSION['ERROR_FORGOT_PASSWORD_RESET']=$error_message;
					echo "<script type='text/javascript'>window.location='?module=password&action=token&token=".$token."';</script>";
					exit();

					}

				}

			if(isset($_POST['conf_pass'])){
					
					$conf_pass=base64_encode($_POST['conf_pass']);

					if (empty($conf_pass)) {
					
					$error_message="Confirm Password Required";
					$_SESSION['ERROR_FORGOT_PASSWORD_RESET']=$error_message;
					echo "<script type='text/javascript'>window.location='?module=password&action=token&token=".$token."';</script>";
					exit();
	
					}


				}
			
			if($new_pass==$conf_pass)
			{
				include './classes/User.php';
				$obj_user_login=new User();
				$obj_user_login_dao=new UserDAO();
				
				$obj_user_login->setToken($token);
				$obj_user_login->setPassword($new_pass);
				$result=$obj_user_login_dao->change_password_by_token($obj_user_login);
					if($result=1)
					{
						$message="Password Reset Successful";
					$_SESSION['SUCCESS_FORGOT_PASSWORD_RESET']=$message;
					$_SESSION['token']=NULL;
					echo "<script type='text/javascript'>window.location='?module=user&action=sign_in';</script>";
					exit();
					}
						else
						{
							$message="Password Reset Link Failed. Please Try Again";
							$_SESSION['ERROR_FORGOT_PASSWORD_RESET']=$message;
						echo "<script type='text/javascript'>window.location='?module=password&action=token&token=".$token."';</script>";
				exit();

						}
			}
			else
			{
							
							$message="Passwords Didn't Match";
							$_SESSION['ERROR_NEW_CONF_MISMATCH']=$message;
						echo "<script type='text/javascript'>window.location='?module=password&action=token&token=".$token."';</script>";
				exit();
			}
		}
		
		
	}
	 
}
?>