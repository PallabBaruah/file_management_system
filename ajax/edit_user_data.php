<?php
				include_once ('../classes/User.php');
				include ('../classes/database.class.php'); 
				$obj_user_dao=new UserDAO();
				$obj_user=new User();
				if(!isset($_SESSION)){session_start();}
				
				
if(isset($_POST['user_id'])){
	$user_id = $_POST['user_id'];
}

//$obj_user->setId($user_id);
$list=$obj_user_dao->readAll_Byid($user_id);
$array_result=array();
$i=0;
foreach($list as $row){
            $array_result[$i]['id']=$row->getId();
            $array_result[$i]['salutation']=$row->getSalutation();			
            $array_result[$i]['fname']=$row->getFirstName();
            $array_result[$i]['lname']=$row->getLastName();			
            $array_result[$i]['email']=$row->getEmail();
            $array_result[$i]['user_type']=$row->getUserType();
            $array_result[$i]['contact_no']=$row->getContactNo();
			$array_result[$i]['state']=$row->getState();
			$array_result[$i]['city']=$row->getCity();
            $array_result[$i]['pin']=$row->getPin();
			$array_result[$i]['org_name']=$row->getOrgName();	
			$array_result[$i]['desig']=$row->getDesignation();								
            $i++;
}
	
echo json_encode($array_result);
exit();

?>