	<?php 
				if(!isset($_SESSION)){session_start();}

				include '../classes/User.php';
				include_once ('../classes/database.class.php'); 

				$obj_save_user=new User();
				$obj_save_user_dao=new UserDAO();

				$user_id_val='';
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
				
				if(isset($_POST['user_id_val'])){			
					
					$user_id_val=$_POST['user_id_val'];
				
					if(empty($user_id_val)){
					$error_message="User Id Missing";
					
					}

					if(!empty($error_message))
						{
							echo $error_message;
						exit();		
						}
				}

				
				if(isset($_POST['salutation'])){			
					
					$salutation=$_POST['salutation'];
				
					if($salutation==''){
					$error_message="Select Salutation ";
					
					}

					if(!empty($error_message))
						{
							echo $error_message;
						exit();		
						}
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
					if(!empty($error_message))
						{
							echo $error_message;
						exit();		
						}
				
					
					
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
					if(!empty($error_message))
						{
							echo $error_message;
						exit();		
						}
				
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
					if(!empty($error_message))
						{
							echo $error_message;
						exit();		
						}
				
				}
				
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

					if(!empty($error_message))
						{
							echo $error_message;
						exit();		
						}

				}

				if(isset($_POST['city'])){			
					$city=strtoupper($_POST['city']);

					if($city=='')
					{
						$error_message="District Required";
					}

					elseif(!preg_match("/^[a-zA-Z ]*$/",$city)){
						
					$error_message="District:Numbers are Not allowed";
					

					}
					elseif(strlen($city) > 30){

					$error_message="District should be less then 30 characters";
					
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
					if(!empty($error_message))
						{
							echo $error_message;
						exit();		
						}
					

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

					if(!empty($error_message))
						{
							echo $error_message;
						exit();		
						}

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

					if(!empty($error_message))
						{
							echo $error_message;
						exit();		
						}
		
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
					if(!empty($error_message))
						{
							echo $error_message;
						exit();		
						}
					
				}

					if(isset($_POST['user_type'])){			
					
					$user_type=$_POST['user_type'];
				
					if($user_type==''){
					$error_message="Select User Type ";
					
					}
					$array_form_fields['user_type']=$user_type;								
		
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
					
					
				$obj_save_user->setId($user_id_val);

				$get_contact_number = $obj_save_user_dao->check_contactno_by_id($obj_save_user);
	
 				if($get_contact_number->getContactNo()==$contact_no){
					
				$obj_save_user->setUserType($user_type);
				$obj_save_user->setSalutation($salutation);
				$obj_save_user->setFirstName($fname);
				$obj_save_user->setLastName($lname);
				$obj_save_user->setContactNo($contact_no);
				$obj_save_user->setState($state);
				$obj_save_user->setCity($city);
				$obj_save_user->setPin($pin);
				$obj_save_user->setIpAddress($ipaddress);
				$obj_save_user->setOrgName($org_name);
				$obj_save_user->setDesignation($desig);
				$obj_save_user->setModifiedBy($modified_by);				

				

				$result = $obj_save_user_dao->updateUser($obj_save_user);
		
						
				if($result == true){
				echo 1;
				exit();
				}
				else
				{
					echo 0;
					exit();
				}

					
					}
					
					else{
				
				$obj_save_user->setContactNo($contact_no);

				$chk_contact_exist = $obj_save_user_dao->checkContactExist($obj_save_user);
				
				$modified_by=$_SESSION['first_name']. $_SESSION['last_name'];
	
					if($chk_contact_exist == false){

				$obj_save_user->setUserType($user_type);
				$obj_save_user->setSalutation($salutation);
				$obj_save_user->setFirstName($fname);
				$obj_save_user->setLastName($lname);
				$obj_save_user->setContactNo($contact_no);
				$obj_save_user->setState($state);
				$obj_save_user->setCity($city);
				$obj_save_user->setPin($pin);
				$obj_save_user->setIpAddress($ipaddress);
				$obj_save_user->setOrgName($org_name);
				$obj_save_user->setDesignation($desig);
				$obj_save_user->setModifiedBy($modified_by);				

				

				$result = $obj_save_user_dao->updateUser($obj_save_user);
		
						
				if($result == true){
				echo 1;
				exit();
				}
				else
				{
					echo("Data Couldn't Be Updated");
					exit();
				}
		}
		else{
			echo("Contact Number Already Exist");
			exit();
		}
					}

?>