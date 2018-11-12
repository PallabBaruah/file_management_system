<?php
				include_once ('../classes/ProjectMaster.class.php');
				include_once ('../classes/User.php');				
				include_once ('../classes/database.class.php'); 
				$obj_project_dao=new ProjectDAO();
				$obj_project=new Project();
				
				$obj_user_class=new User();
				$obj_user_class_dao=new UserDAO();

				
				$project_id='';
				$array_form_fields=array();


				
				if(isset($_POST['project_id'])){			
					
					$project_id=$_POST['project_id'];
					

					if(empty($project_id)){
					$error_message="No Project Id";
					}
					
				}
				if(isset($_POST['user_id'])){			
					
					$user_id=$_POST['user_id'];
					

					if(empty($user_id)){
					$error_message="No User Id";
					}
					
				}
				if(isset($_POST['user_type'])){			
					
					$user_type=$_POST['user_type'];
					

					if(empty($user_type)){
					$error_message="No User Type";
					}
					
				}
				
				
				
				$_SESSION['FORM_FIELDS']=$array_form_fields;
							if(!empty($error_message))
						{
							echo $error_message;
						exit();		
						}
				$_SESSION['ERROR_PROJECT_UPDATE']=NULL;
				
				$obj_project->SetId($project_id);
				$result=$obj_project_dao->getProjectById($obj_project);
				
				$array_result=array();
				$i=0;

				foreach($result as $row){
				$array_result[$i]['project_owner_id']=$row->getProjectOwner();
				$array_result[$i]['project_leader']=$row->getProjectLeader();
				$i++;
				}
				foreach($array_result as $data){ 
				$owner=$data['project_owner_id'];
				$leader=$data['project_leader'];
				}
				if($user_type=='USER'){
				if($leader==$user_id){
				$array_result2=array();
				$j=0;
				
				$aa=(explode(",",$owner));
					foreach($aa as $bb){
					$owner_result=$obj_user_class_dao->readAll_Byid($bb);
					foreach($owner_result as $data){
						$array_result2[$j]['fname']=$data->getFirstName();
						$array_result2[$j]['lname']=$data->getLastName();
						$array_result2[$j]['id']=$data->getId();
						$j++;
                     }
					}
					$array_result3=array();
					$k=0;
					 $leader_result=$obj_user_class_dao->readAll_Byid($leader);
					foreach($leader_result as $data){
						$array_result3[$k]['fname']=$data->getFirstName();
						$array_result3[$k]['lname']=$data->getLastName();
						$array_result3[$k]['id']=$data->getId();
						$k++;
                     }
				
					$array_result1=(array_merge($array_result2,$array_result3));
					echo json_encode($array_result1);
				exit();
				}
				else{
					$array_result4=array();
					$l=0;
					$user_result=$obj_user_class_dao->readAll_Byid($user_id);
					foreach($user_result as $data){
						$array_result4[$l]['fname']=$data->getFirstName();
						$array_result4[$l]['lname']=$data->getLastName();
						$array_result4[$l]['id']=$data->getId();
						$l++;
                     }
					 echo json_encode($array_result4);
				}
				}
				else{
					$array_result2=array();
				$j=0;
				
				$aa=(explode(",",$owner));
					foreach($aa as $bb){
					$owner_result=$obj_user_class_dao->readAll_Byid($bb);
					foreach($owner_result as $data){
						$array_result2[$j]['fname']=$data->getFirstName();
						$array_result2[$j]['lname']=$data->getLastName();
						$array_result2[$j]['id']=$data->getId();
						$j++;
                     }
					}
					$array_result3=array();
					$k=0;
					 $leader_result=$obj_user_class_dao->readAll_Byid($leader);
					foreach($leader_result as $data){
						$array_result3[$k]['fname']=$data->getFirstName();
						$array_result3[$k]['lname']=$data->getLastName();
						$array_result3[$k]['id']=$data->getId();
						$k++;
                     }
				
					$array_result1=(array_merge($array_result2,$array_result3));
					echo json_encode($array_result1);
				exit();
				}

	?>		