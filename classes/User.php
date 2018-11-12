<?php
ini_set('display_errors',0);

class User{


		public static $TABLE_NAME = "users";

		private $id;

		private $email;

		private $username;

		private $password;

		private $user_type;

		private $fname;
		
		private $lname;

		private $contact_no;

		private $state;

		private $city;

		private $pin_code;
		
		private $ip_address;

		private $is_password_set;
		
		private $salutation;
		
		private $org_name;

		private $desig;
		
		private $token;
		
		private $modifiedby;





		public function setId($id){

			$this->id = $id;

		}

		public function getId(){

			return $this->id;
		}


		public function setEmail($email){

			$this->email = $email;

		}

		public function getEmail(){

			return $this->email;
		}


		public function setUsername($username){

			$this->username = $username;

		}

		public function getUsername(){

			return $this->username;
		}


		public function setPassword($password){

			$this->password = $password;

		}

		public function getPassword(){

			return $this->password;
		}



		public function setUserType($user_type){

			$this->user_type = $user_type;

		}

		public function getUserType(){

			return $this->user_type;
		}


		public function setFirstName($fname){

			$this->fname = $fname;

		}

		public function getFirstName(){

			return $this->fname;
		}
		
		public function setLastName($lname){

			$this->lname = $lname;

		}

		public function getLastName(){

			return $this->lname;
		}


		public function setContactNo($contact_no){

			$this->contact_no = $contact_no;

		}

		public function getContactNo(){

			return $this->contact_no;
		}


		public function setState($state){

			$this->state = $state;

		}

		public function getState(){

			return $this->state;

		}

		public function setCity($city){

			$this->city = $city;

		}

		public function getCity(){

			return $this->city;
		}

		public function setPin($pin_code){

			$this->pin_code = $pin_code;

		}

		public function getPin(){

			return $this->pin_code;
		}	

		public function setPasswordCreated($is_password_set){

			$this->is_password_set = $is_password_set;

		}

		public function getPasswordCreated(){

			return $this->is_password_set;
		}
		
		public function setIpAddress($ip_address){

			$this->ip_address = $ip_address;

		}

		public function getIpAddress(){

			return $this->ip_address;
		}
		
		public function setSalutation($salutation){

			$this->salutation = $salutation;

		}

		public function getSalutation(){

			return $this->salutation;
		}
		
		public function setOrgName($org_name){

			$this->org_name = $org_name;

		}

		public function getOrgName(){

			return $this->org_name;
		}
		
		public function setDesignation($desig){

			$this->desig = $desig;

		}

		public function getDesignation(){

			return $this->desig;
		}
		
		public function setToken($token){

			$this->token = $token;

		}

		public function getToken(){

			return $this->token;
		}
		
		public function setModifiedBy($modifiedby){

			$this->modifiedby = $modifiedby;

		}

		public function getModifiedBy(){

			return $this->modifiedby;
		}



}


class UserDAO{



		public function insert_users($userClass_obj){




			$SQL_INSERT = "INSERT INTO ".User::$TABLE_NAME."(

			email,
			password,
			user_type,
			salutation,
			fname,
			lname,
			contact_no,
			state,
			city,
			pin,
			ip_address,
			password_created,
			org_name,
			desig	

			)";


			$SQL_INSERT .= " VALUES (

			:email,
			:password,
			:user_type,
			:salutation,
			:fname,
			:lname,
			:contact_no,
			:state,
			:city,
			:pin,
			:ip_address,
			:password_created,
			:org_name,
			:desig	
			
			)";

			
			$database = new Database();

			$database->query($SQL_INSERT);

			$database->bind(':email',$userClass_obj->getEmail());

			$database->bind(':password',$userClass_obj->getPassword());

			$database->bind(':user_type',$userClass_obj->getUserType());

			$database->bind(':fname',$userClass_obj->getFirstName());
			
			$database->bind(':lname',$userClass_obj->getLastName());

			$database->bind(':contact_no',$userClass_obj->getContactNo());

			$database->bind(':state',$userClass_obj->getState());

			$database->bind(':city',$userClass_obj->getCity());

			$database->bind(':pin',$userClass_obj->getPin());

			$database->bind(':password_created',$userClass_obj->getPasswordCreated());
			
			$database->bind(':ip_address',$userClass_obj->getIpAddress());
			
			$database->bind(':salutation',$userClass_obj->getSalutation());
			
			$database->bind(':org_name',$userClass_obj->getOrgName());
			
			$database->bind(':desig',$userClass_obj->getDesignation());



			$database->execute();


			return 1;
	

		}


		public function readAll(){
		
        $SQL_READ_ALL = "SELECT * FROM ".User::$TABLE_NAME." WHERE is_delete=0";
        $database = new Database();
        $database->query($SQL_READ_ALL);
		
        $database->execute();
        $results = array();
        $records = $database->resultset();
		
        $count=0;
		foreach($records as $row) {			
			$UserClassObject = new User();
            $UserClassObject->setId($row['id']);
			$UserClassObject->setSalutation($row['salutation']);
            $UserClassObject->setFirstName($row['fname']);
            $UserClassObject->setLastName($row['lname']);			
            $UserClassObject->setEmail($row['email']);
            $UserClassObject->setUserType($row['usertype']);
            $UserClassObject->setContactNo($row['contact_no']);
			$UserClassObject->setState($row['state']);
			$UserClassObject->setCity($row['city']);
            $UserClassObject->setPin($row['pin']);
            $UserClassObject->setIpAddress($row['ip_address']);
            $UserClassObject->setPasswordCreated($row['password_created']);	
			$UserClassObject->setOrgName($row['org_name']);	
			$UserClassObject->setDesignation($row['desig']);			
            $results[$count] = $UserClassObject;
            $count++;
        }	

        return $results;
    }
	
	public function readAll_Byid($criteria){
		
        $SQL_READ_ALL = "SELECT * FROM users WHERE id=:id AND is_delete=0";
       
        $database = new Database();
        $database->query($SQL_READ_ALL);
		$database->bind(':id',$criteria);
        $database->execute();
        $results = array();
        $records = $database->resultset();
		
        $count=0;
		foreach($records as $row) {			
			$UserClassObject = new User();
            $UserClassObject->setId($row['id']);
            $UserClassObject->setSalutation($row['salutation']);			
            $UserClassObject->setFirstName($row['fname']);
            $UserClassObject->setLastName($row['lname']);			
            $UserClassObject->setEmail($row['email']);
            $UserClassObject->setUserType($row['user_type']);
            $UserClassObject->setContactNo($row['contact_no']);
			$UserClassObject->setState($row['state']);
			$UserClassObject->setCity($row['city']);
            $UserClassObject->setPin($row['pin']);
            $UserClassObject->setIpAddress($row['ip_address']);
            $UserClassObject->setPasswordCreated($row['password_created']);	
			$UserClassObject->setOrgName($row['org_name']);	
			$UserClassObject->setDesignation($row['desig']);								
            $results[$count] = $UserClassObject;
            $count++;
        }	

        return $results;
    }
	
		


	    public function userLogin($userClass_obj){


    	$SQL_FIND_ID = "SELECT email FROM ".User::$TABLE_NAME." where email=:email AND is_delete=0";

    	$database = new Database();

    	$database->query($SQL_FIND_ID);

    	$database->bind(':email',$userClass_obj->getEmail());


    	$database->execute();
		
		//$records = $database->single();
		
        $records = $database->resultset();		
		
		$result=$database->rowCount($records);
		
		
		if($result >= 1){
			
		$SQL_FIND_PASS = "SELECT password FROM ".User::$TABLE_NAME." where email=:email AND password=:password AND is_delete=0";

    	$database = new Database();

    	$database->query($SQL_FIND_PASS);

    	$database->bind(':email',$userClass_obj->getEmail());

    	$database->bind(':password',$userClass_obj->getPassword());


    	$records2 = $database->resultset();		
		
		$result2=$database->rowCount($records2);

		

			if($result2>=1){

				return 1;

			}

			  else{


			  	return 2;
			  }

		
				
		

			
		}
		else
		{
			return 0;
		}
		
    }
	
	
	
		
	    public function setSessionforUser($userClass_obj){


    	$SQL_FIND_ID = "SELECT * FROM ".User::$TABLE_NAME." where email=:email AND password=:password AND is_delete=0";

    	$database = new Database();

    	$database->query($SQL_FIND_ID);

    	$database->bind(':email',$userClass_obj->getEmail());

    	$database->bind(':password',$userClass_obj->getPassword());

    	$database->execute();
		
		
        $records = $database->resultset();		
		
		$results= array();
		
		$count=0;

		
		
		foreach($records as $row){
			
			$UserClassObject = new User();
            $UserClassObject->setId($row['id']);
            $UserClassObject->setSalutation($row['salutation']);						
            $UserClassObject->setFirstName($row['fname']);
			$UserClassObject->setLastName($row['lname']);
            $UserClassObject->setEmail($row['email']);
            $UserClassObject->setUserType($row['user_type']);
			$UserClassObject->setPasswordCreated($row['password_created']);
			
			$results[$count] = $UserClassObject;
            $count++;
		}
		
		return $results;
    }
	
		    public function logout($userClass_obj){
			$_SESSION = array();
				// If it's desired to kill the session, also delete the session cookie.
				// Note: This will destroy the session, and not just the session data!
					if (ini_get("session.use_cookies")) {
    					$params = session_get_cookie_params();
    					setcookie(session_name(), '', time() - 42000,
        				$params["path"], $params["domain"],
        				$params["secure"], $params["httponly"]
    			);
			}
				// Finally, destroy the session.
					session_destroy();
					return 1;
					
    		}
	
	
		public function read_by_email($criteria){
		
        $SQL_READ_BY_EMAIL = "SELECT * FROM users WHERE email=:email AND is_delete=0";
       
        $database = new Database();
        $database->query($SQL_READ_BY_EMAIL);
		$database->bind(':email',$criteria->getEmail());
        $database->execute();
        $records = $database->resultset();
		
		$results=$database->rowCount($records);
		
		if($results>=1){
			
			return 1;
			
		}
			else
			{
			return 0;
			}

    	}



    	public function viewUsersByAdmin(){


    		$SQL_FIND_ALL="SELECT  * FROM ".User::$TABLE_NAME." WHERE is_delete=0 ORDER BY id DESC";

    		$database = new Database();

    		$database->query($SQL_FIND_ALL);

    		$database->execute();

    		$result = array();

    		$records = $database->resultset();

    		$count=0;

    		foreach ($records as $row) {
    			
    		
    			$userAllobj	= new User();

            	$userAllobj->setFirstName($row['fname']);
            	$userAllobj->setLastName($row['lname']);			
    			$userAllobj->setEmail($row['email']);
    			$userAllobj->setContactNo($row['contact_no']);	
    			$userAllobj->setState($row['state']);
    			$userAllobj->setCity($row['city']);
				$userAllobj->setUserType($row['user_type']);
				$userAllobj->setId($row['id']);
				

    			$result[$count]=$userAllobj;
    			$count++;

    		}
    		return $result;


    	}


    	
    	public function getFirstPasswordCreated($userClass_obj){


    		$SQL_CHECK="SELECT password_created FROM ".User::$TABLE_NAME." where email=:email AND is_delete=0";

    		$database = new Database();

    		$database->query($SQL_CHECK);

    		$database->bind(':email',$userClass_obj->getEmail());


    		$record = $database->single();

    		if($record['password_created'] == 1){

    			return true; //first password not set

    		}else
    		{

    			return false;
    		}


    	}
		
		
		public function change_password($criteria){
		
        $SQL_UPDATE_PASSWORD  = " UPDATE ".User::$TABLE_NAME." SET password = :password WHERE id = :id AND is_delete=0";
        $database = new Database();
        $database->query($SQL_UPDATE_PASSWORD);
        $database->bind(':id', $criteria->getId());
		$database->bind(':password', $criteria->getPassword());
        $result = $database->execute();
			
		$result2=$database->rowCount($result);
		
		if($result2>=1)
			{
				return 1;
			}
			else
			{
				return 0;
			}
					
    	}
		
		
		public function getpassword_Byid($criteria){
		
        $SQL_READ_ALL = "SELECT password FROM ".User::$TABLE_NAME." WHERE id=:id AND is_delete=0";
       
        $database = new Database();
        $database->query($SQL_READ_ALL);
		$database->bind(':id',$criteria->getId());
        $database->execute();
        $results = array();
        $records = $database->resultset();
		
        $count=0;
		foreach($records as $row) {			
			$UserClassObject = new User();
            $UserClassObject->setPassword($row['password']);								
            $results[$count] = $UserClassObject;
            $count++;
        }	

        return $results;
    }
	
	public function first_time_password($criteria){
		
        $SQL_UPDATE_PASSWORD  = " UPDATE ".User::$TABLE_NAME." SET password = :password, password_created = 2 WHERE id = :id AND is_delete=0";
        $database = new Database();
        $database->query($SQL_UPDATE_PASSWORD);
        $database->bind(':id', $criteria->getId());
		$database->bind(':password', $criteria->getPassword());
        $result = $database->execute();
			
		$result2=$database->rowCount($result);
		
		if($result2>=1)
			{
				return 1;
			}
			else
			{
				return 0;
			}
					
    	}
	
	public function check_email_exist($criteria){
		
        $SQL_READ_ALL = "SELECT email FROM ".User::$TABLE_NAME." WHERE email=:email AND is_delete=0";
       
        $database = new Database();
        $database->query($SQL_READ_ALL);
		$database->bind(':email',$criteria->getEmail());
        $database->execute();
        $results = array();
        $records = $database->resultset();
        
		$result2=$database->rowCount($records);
		
		if($result2>=1)
			{
				return 1;
			}
			else
			{
				return 0;
			}
					
    }
	
	public function insert_token($criteria){
		
        $SQL_UPDATE_TOKEN  = " UPDATE ".User::$TABLE_NAME." SET token = :token , token_date = NOW() WHERE email = :email AND is_delete=0";
       
        $database = new Database();
        $database->query($SQL_UPDATE_TOKEN);
		$database->bind(':email',$criteria->getEmail());
		$database->bind(':token',$criteria->getToken());		
        $database->execute();
        $results = array();
        return $results;
					
    }
	
		public function check_token_exist($criteria){
		
        $SQL_READ_ALL = "SELECT email,datediff(NOW(),token_date) AS token_exp FROM ".User::$TABLE_NAME." WHERE token=:token AND is_delete=0";
       
        $database = new Database();
        $database->query($SQL_READ_ALL);
		$database->bind(':token',$criteria->getToken());
        $database->execute();
        $results = array();
        $records = $database->resultset();
		
		foreach ($records as $row) {
    		# code...

    		$records['token_exp'] = $row['token_exp'];
        
		//$result2=$database->rowCount($records);
		
		
		
		if($records['token_exp']>=0 && $records['token_exp']<1)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
    }
	
	
	public function change_password_by_token($criteria){
		
        $SQL_UPDATE_PASSWORD  = " UPDATE ".User::$TABLE_NAME." SET password = :password WHERE token = :token AND is_delete=0";
        $database = new Database();
        $database->query($SQL_UPDATE_PASSWORD);
        $database->bind(':token', $criteria->getToken());
		$database->bind(':password', $criteria->getPassword());
        $result = $database->execute();
			
		$result2=$database->rowCount($result);
		
		if($result2>=1)
			{
				$SQL_UPDATE  = " UPDATE ";
        $SQL_UPDATE .= User::$TABLE_NAME;
        $SQL_UPDATE .= " SET token='',token_date=NULL WHERE token = :token";
        $database = new Database();
        $database->query($SQL_UPDATE);
        $database->bind(':token', $criteria->getToken());
        $result = $database->execute();
				return 1;
			}
			else
			{
				return 0;
			}
					
    	}

   

    	public function checkContactExist($criteria){
		
        $SQL_READ_ALL = "SELECT contact_no FROM ".User::$TABLE_NAME." WHERE contact_no=:contact_no AND is_delete=0";
       
        $database = new Database();
        $database->query($SQL_READ_ALL);
		$database->bind(':contact_no',$criteria->getContactNo());
        $database->execute();

        if($database->rowCount() > 0){

        	return true;

        	}
        
        	return false;

        }


        public function updateUser($userClass_obj){

 		$SQL_UPDATE = "UPDATE ".User::$TABLE_NAME."
 		SET user_type=:user_type,salutation=:salutation,fname=:fname,lname=:lname,contact_no=:contact_no,
 		state=:state,city=:city,pin=:pin,ip_address=:ip_address,org_name=:org_name,desig=:desig,modified_by=:modified_by,modified_date=NOW() where id=:id";	

 		$database = new Database();

 		$database->query($SQL_UPDATE);
		
		$database->bind(':id',$userClass_obj->getId());
 		$database->bind(':user_type',$userClass_obj->getUserType());
 		$database->bind(':salutation',$userClass_obj->getSalutation());
 		$database->bind(':fname',$userClass_obj->getFirstName());
 		$database->bind(':lname',$userClass_obj->getLastName());
 		$database->bind(':contact_no',$userClass_obj->getContactNo());
 		$database->bind(':state',$userClass_obj->getState());
 		$database->bind(':city',$userClass_obj->getCity());
 		$database->bind(':pin',$userClass_obj->getPin());
 		$database->bind(':ip_address',$userClass_obj->getIpAddress());
 		$database->bind(':org_name',$userClass_obj->getOrgName());
 		$database->bind(':desig',$userClass_obj->getDesignation());
 		$database->bind(':modified_by',$userClass_obj->getModifiedBy());
		

 		$database->execute();

 		if( $database->rowCount() > 0){

 			return true;

 		}
 			return false;

 		}
   

		public function read_all_users_by_usertype($criteria){
		
        $SQL_READ_ALL = "SELECT * FROM users WHERE user_type=:user_type AND is_delete=0 AND NOT (email = :email)";
       
        $database = new Database();
        $database->query($SQL_READ_ALL);
		$database->bind(':user_type',USER);
		$database->bind(':email',$criteria->getEmail());
        $database->execute();
        $results = array();
        $records = $database->resultset();
		
        $count=0;
		foreach($records as $row) {			
			$UserClassObject = new User();
            $UserClassObject->setId($row['id']);
            $UserClassObject->setSalutation($row['salutation']);			
            $UserClassObject->setFirstName($row['fname']);
            $UserClassObject->setLastName($row['lname']);			
            $UserClassObject->setEmail($row['email']);
            $UserClassObject->setUserType($row['user_type']);
            $UserClassObject->setContactNo($row['contact_no']);
			$UserClassObject->setState($row['state']);
			$UserClassObject->setCity($row['city']);
            $UserClassObject->setPin($row['pin']);
            $UserClassObject->setIpAddress($row['ip_address']);
            $UserClassObject->setPasswordCreated($row['password_created']);	
			$UserClassObject->setOrgName($row['org_name']);	
			$UserClassObject->setDesignation($row['desig']);								
            $results[$count] = $UserClassObject;
            $count++;
        }	

        return $results;
    }

	    public function check_contactno_by_id($criteria){
		
        $SQL_READ_ALL = "SELECT contact_no FROM ".User::$TABLE_NAME." WHERE id=:id AND is_delete=0";
       
        $database = new Database();
        $database->query($SQL_READ_ALL);
		$database->bind(':id',$criteria->getId());
        $result=$database->single();
		
		if(!empty($result)){
			$criteria->setContactNo($result['contact_no']);
		}
		return $criteria;

        }
		
		
		public function get_member_except_these($criteria){
			
		$user_id=rtrim($criteria->getId(),',');
        $SQL_READ_ALL = "SELECT id,fname,lname FROM ".User::$TABLE_NAME." WHERE id NOT IN ($user_id) AND user_type='USER' AND is_delete=0";
       
        $database = new Database();
        $database->query($SQL_READ_ALL);
		//$database->bind(':project_id',$criteria->getProjectId());						
        $database->execute();
		
		$results = array();
        $records = $database->resultset();
		
        $count=0;
		foreach($records as $row) {			
			$UserClassObject = new User();
            $UserClassObject->setId($row['id']);            	
            $UserClassObject->setFirstName($row['fname']);
            $UserClassObject->setLastName($row['lname']);
			$results[$count] = $UserClassObject;
            $count++;
        }	

        return $results;
		

        }
		
		public function deleteUser($userClass_obj){

 		$SQL_UPDATE = "UPDATE ".User::$TABLE_NAME."
 		SET is_delete=1 where id=:id";	

 		$database = new Database();

 		$database->query($SQL_UPDATE);
		
		$database->bind(':id',$userClass_obj->getId());
 		$database->execute();

 		if( $database->rowCount() > 0){

 			return true;

 		}
 			return false;

 		}
		
				public function read_all_users_by_usertype_admin($criteria){
		
        $SQL_READ_ALL = "SELECT * FROM users WHERE user_type=:user_type AND is_delete=0 AND NOT (email = :email)";
       
        $database = new Database();
        $database->query($SQL_READ_ALL);
		$database->bind(':user_type',ADMIN);
		$database->bind(':email',$criteria->getEmail());
        $database->execute();
        $results = array();
        $records = $database->resultset();
		
        $count=0;
		foreach($records as $row) {			
			$UserClassObject = new User();
            $UserClassObject->setId($row['id']);
            $UserClassObject->setSalutation($row['salutation']);			
            $UserClassObject->setFirstName($row['fname']);
            $UserClassObject->setLastName($row['lname']);			
            $UserClassObject->setEmail($row['email']);
            $UserClassObject->setUserType($row['user_type']);
            $UserClassObject->setContactNo($row['contact_no']);
			$UserClassObject->setState($row['state']);
			$UserClassObject->setCity($row['city']);
            $UserClassObject->setPin($row['pin']);
            $UserClassObject->setIpAddress($row['ip_address']);
            $UserClassObject->setPasswordCreated($row['password_created']);	
			$UserClassObject->setOrgName($row['org_name']);	
			$UserClassObject->setDesignation($row['desig']);								
            $results[$count] = $UserClassObject;
            $count++;
        }	

        return $results;
    }
	
			public function read_all_users($criteria){
		
        $SQL_READ_ALL = "SELECT * FROM users WHERE is_delete=0 AND NOT (email = :email)";
       
        $database = new Database();
        $database->query($SQL_READ_ALL);
		//$database->bind(':user_type',USER);
		$database->bind(':email',$criteria->getEmail());
        $database->execute();
        $results = array();
        $records = $database->resultset();
		
        $count=0;
		foreach($records as $row) {			
			$UserClassObject = new User();
            $UserClassObject->setId($row['id']);
            $UserClassObject->setSalutation($row['salutation']);			
            $UserClassObject->setFirstName($row['fname']);
            $UserClassObject->setLastName($row['lname']);			
            $UserClassObject->setEmail($row['email']);
            $UserClassObject->setUserType($row['user_type']);
            $UserClassObject->setContactNo($row['contact_no']);
			$UserClassObject->setState($row['state']);
			$UserClassObject->setCity($row['city']);
            $UserClassObject->setPin($row['pin']);
            $UserClassObject->setIpAddress($row['ip_address']);
            $UserClassObject->setPasswordCreated($row['password_created']);	
			$UserClassObject->setOrgName($row['org_name']);	
			$UserClassObject->setDesignation($row['desig']);								
            $results[$count] = $UserClassObject;
            $count++;
        }	

        return $results;
    }
	
			public function get_member_except_these_all_user($criteria){
			
		$user_id=rtrim($criteria->getId(),',');
        $SQL_READ_ALL = "SELECT id,fname,lname FROM ".User::$TABLE_NAME." WHERE id NOT IN ($user_id) AND is_delete=0";
       
        $database = new Database();
        $database->query($SQL_READ_ALL);
		//$database->bind(':project_id',$criteria->getProjectId());						
        $database->execute();
		
		$results = array();
        $records = $database->resultset();
		
        $count=0;
		foreach($records as $row) {			
			$UserClassObject = new User();
            $UserClassObject->setId($row['id']);            	
            $UserClassObject->setFirstName($row['fname']);
            $UserClassObject->setLastName($row['lname']);
			$results[$count] = $UserClassObject;
            $count++;
        }	

        return $results;
		

        }




}

	




?>

