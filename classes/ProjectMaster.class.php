<?php

ini_set('display_errors',0);

class Project{


		public static $TABLE_NAME ="project_master";

		private $id;
		private $project_name;
		private $project_description;
		private $project_start_date;
		private $project_end_date;
		private $project_leader;
		private $project_owner;
		private $created_by;
		private $created_date;
		private $modified_by;	
		private $modified_date;
		private $is_completed;
		private $project_code;

		public function setId($id){

			$this->id=$id;


		}

		public function getId(){

			return $this->id;
		}


		public function setProjectName($project_name){

			$this->project_name=$project_name;


		}

		public function getProjectName(){

			return $this->project_name;
		}

		
		public function setProjectDescription($project_description){

			$this->project_description=$project_description;


		}

		public function getProjectDescription(){

			return $this->project_description;
		}


		public function setProjectStartDate($project_start_date){

			$this->project_start_date=$project_start_date;


		}

		public function getProjectStartDate(){

			return $this->project_start_date;
		}



		public function setProjectEndDate($project_end_date){

			$this->project_end_date=$project_end_date;


		}

		public function getProjectEndDate(){

			return $this->project_end_date;
		}


		public function setProjectLeader($project_leader){

			$this->project_leader=$project_leader;


		}

		public function getProjectLeader(){

			return $this->project_leader;
		}



		public function setCreatedBy($created_by){

			$this->created_by=$created_by;


		}

		public function getCreatedBy(){

			return $this->created_by;
		}


		public function setCreatedDate($created_date){

			$this->created_date=$created_date;


		}

		public function getCreatedDate(){

			return $this->created_date;
		}



		public function setModifiedBy($modified_by){

			$this->modified_by=$modified_by;


		}

		public function getModifiedBy(){

			return $this->modified_by;
		}


		public function setModifiedDate($modified_date){

			$this->modified_date=$modified_date;


		}

		public function getModifiedDate(){

			return $this->modified_date;
		}



		public function setIsCompleted($is_completed){

			$this->is_completed=$is_completed;


		}

		public function getIsCompleted(){

			return $this->is_completed;
		}
		
		
		public function setProjectCode($project_code){

			$this->project_code=$project_code;


		}

		public function getProjectCode(){

			return $this->project_code;
		}
		
		public function setProjectOwner($project_owner){

			$this->project_owner=$project_owner;


		}

		public function getProjectOwner(){

			return $this->project_owner;
		}
		
		public function setProjectRemark($project_remark){

			$this->project_remark=$project_remark;


		}

		public function getProjectRemark(){

			return $this->project_remark;
		}
			

}


class ProjectDAO {



	public function insert_project_master($projectClass_obj){



		$SQL_INSERT = "INSERT INTO ".Project::$TABLE_NAME."(

		project_name,
		project_description,
		project_start_date,
		project_end_date,
		project_leader,
		created_by,
		created_date,
		modified_by,
		modified_date,
		is_completed,
		project_owner_id,
		project_remark
		)";

		$SQL_INSERT .= " VALUES(

		:project_name,
		:project_description,
		:project_start_date,
		:project_end_date,
		:project_leader,
		:created_by,
		 NOW(),
		:modified_by,
		:modified_date,
		:project_is_completed,
		:project_owner_id	,
		:project_remark
		)";	

		$database = new Database();

		$database->query($SQL_INSERT);

		$database->bind(':project_name',$projectClass_obj->getProjectName());

		$database->bind(':project_description',$projectClass_obj->getProjectDescription());

		$database->bind(':project_start_date',$projectClass_obj->getProjectStartDate());

		$database->bind(':project_end_date',$projectClass_obj->getProjectEndDate());

		$database->bind(':project_leader',$projectClass_obj->getProjectLeader());

		$database->bind(':created_by',$projectClass_obj->getCreatedBy());
		
		$database->bind(':modified_by',$projectClass_obj->getModifiedBy());

		$database->bind(':modified_date',$projectClass_obj->getModifiedDate());
		
		$database->bind(':project_is_completed',$projectClass_obj->getIsCompleted());
		
		//$database->bind(':project_code',$projectClass_obj->getProjectCode());
		
		$database->bind(':project_owner_id',$projectClass_obj->getProjectOwner());
		
		$database->bind(':project_remark',$projectClass_obj->getProjectRemark());		
		
		$database->execute();
		
		$result= $database->lastInsertId();
		
		if($result!=''){
		return 1;
		}
		else{
			return 0;
		}
		
	}		


	public function update_project_master($projectClass_obj){


		$SQL_UPDATE ="UPDATE ".Project::$TABLE_NAME."

		SET project_name = :project_name, project_description=:project_description,
		project_start_date =:project_start_date,project_end_date=:project_end_date,
		project_leader = :project_leader,modified_by =:modified_by,modified_date=NOW(),
		is_completed=:is_completed,project_remark=:project_remark 
		where id=:id"; 	

		$database = new Database();

		$database->query($SQL_UPDATE);

		$database->bind(':project_name',$projectClass_obj->getProjectName());

		$database->bind(':project_description',$projectClass_obj->getProjectDescription());

		$database->bind(':project_start_date',$projectClass_obj->getProjectStartDate());

		$database->bind(':project_end_date',$projectClass_obj->getProjectEndDate());

		$database->bind(':project_leader',$projectClass_obj->getProjectLeader());

		$database->bind(':modified_by',$projectClass_obj->getModifiedBy());
	
		$database->bind(':is_completed',$projectClass_obj->getIsCompleted());
		
		//$database->bind(':project_owner_id',$projectClass_obj->getProjectOwner());
		
		$database->bind(':project_remark',$projectClass_obj->getProjectRemark());		
		
		$database->bind(':id',$projectClass_obj->getId());

		$result= $database->execute();

		if($database->rowCount() > 0){

			$result=TRUE;

		}
		return $result;



	}



		public function getProjectById($projectClass_obj){


		$SQL_FIND = "SELECT * FROM ".Project::$TABLE_NAME." where id=:id";

		$database = new Database();

		$database->query($SQL_FIND);
		$database->bind(':id',$projectClass_obj->getId());
			
					
		$database->execute();
        
        $results = array();
        
        $records = $database->resultset();
		
		
        $count=0;
		
				foreach($records as $row) {	
		
			$projectClass_obj = new Project();

			$projectClass_obj->setId($row['id']);	

			$projectClass_obj->setProjectName($row['project_name']);	

			$projectClass_obj->setProjectCode($row['project_code']);				

			$projectClass_obj->setProjectDescription($row['project_description']);

			$projectClass_obj->setProjectStartDate($row['project_start_date']);

			$projectClass_obj->setProjectEndDate($row['project_end_date']);

			$projectClass_obj->setProjectLeader($row['project_leader']);

			$projectClass_obj->setCreatedBy($row['created_by']);

			$projectClass_obj->setCreatedDate($row['created_date']);

			$projectClass_obj->setModifiedBy($row['modified_by']);	

			$projectClass_obj->setModifiedDate($row['modified_date']);	

			$projectClass_obj->setIsCompleted($row['is_completed']);

			$projectClass_obj->setProjectOwner($row['project_owner_id']);	

			$projectClass_obj->setProjectRemark($row['project_remark']);	
	

            $results[$count] = $projectClass_obj;
            
            $count++;

        }	
        return $results;


		}


		public function getAllProjects(){
		
        $SQL_READ_ALL = "SELECT * FROM ".Project::$TABLE_NAME;
        
        $database = new Database();
		
        $database->query($SQL_READ_ALL);
       
        $database->execute();
        
        $results = array();
        
        $records = $database->resultset();
		
		
        $count=0;

		foreach($records as $row) {	
		
			$projectObj = new Project();

			$projectObj->setId($row['id']);	

			$projectObj->setProjectName($row['project_name']);	

			$projectObj->setProjectCode($row['project_code']);				

			$projectObj->setProjectDescription($row['project_description']);

			$projectObj->setProjectStartDate($row['project_start_date']);

			$projectObj->setProjectEndDate($row['project_end_date']);

			$projectObj->setProjectLeader($row['project_leader']);

			$projectObj->setCreatedBy($row['created_by']);

			$projectObj->setCreatedDate($row['created_date']);

			$projectObj->setModifiedBy($row['modified_by']);	

			$projectObj->setModifiedDate($row['modified_date']);	

			$projectObj->setIsCompleted($row['is_completed']);

			$projectObj->setProjectOwner($row['project_owner_id']);	

			$projectObj->setProjectRemark($row['project_remark']);	
	

            $results[$count] = $projectObj;
            
            $count++;

        }	
        return $results;
		
    }

		
		public function get_project_leader_name($leader){
		
        $SQL_READ_ALL = "SELECT fname,lname,id FROM users WHERE id=:id";
        
        $database = new Database();
		
        $database->query($SQL_READ_ALL);
		
		$database->bind(':id',$leader);
       
        $database->execute();
        
        $results = array();
        
        $records = $database->resultset();
		
		
        $count=0;

		foreach($records as $row) {	
			$results[$count]['fname']=$row['fname'];
			$results[$count]['lname']=$row['lname'];			
			$results[$count]['id']=$row['id'];            
            $count++;

        }	
        return $results;
		
    }

		public function get_project_owner_from_project_id($criteria){
		
        $SQL_READ_ALL = "SELECT project_owner_id, project_leader FROM project_master WHERE id=:id";
        
        $database = new Database();
		
        $database->query($SQL_READ_ALL);
		
		$database->bind(':id',$criteria);
       
        $database->execute();
        
        $results = array();
        
        $records = $database->resultset();
		
		
        $count=0;

		foreach($records as $row) {	
			$results[$count]['project_owner_id']=$row['project_owner_id'];
			$results[$count]['project_leader']=$row['project_leader'];
            $count++;

        }	
        return $results;
		
    }
	
	
	public function get_all_completed_projects(){
		
        $SQL_READ_ALL = "SELECT * FROM ".Project::$TABLE_NAME." WHERE is_completed=2";
        
        $database = new Database();
		
        $database->query($SQL_READ_ALL);
       
        $database->execute();
        
        $results = array();
        
        $records = $database->resultset();
		
		
        $count=0;

		foreach($records as $row) {	
		
			$projectObj = new Project();

			$projectObj->setId($row['id']);	

			$projectObj->setProjectName($row['project_name']);	

			$projectObj->setProjectCode($row['project_code']);				

			$projectObj->setProjectDescription($row['project_description']);

			$projectObj->setProjectStartDate($row['project_start_date']);

			$projectObj->setProjectEndDate($row['project_end_date']);

			$projectObj->setProjectLeader($row['project_leader']);

			$projectObj->setCreatedBy($row['created_by']);

			$projectObj->setCreatedDate($row['created_date']);

			$projectObj->setModifiedBy($row['modified_by']);	

			$projectObj->setModifiedDate($row['modified_date']);	

			//$projectObj->setIsCompleted($row['is_completed']);

			$projectObj->setProjectOwner($row['project_owner_id']);	

			$projectObj->setProjectRemark($row['project_remark']);	
	

            $results[$count] = $projectObj;
            
            $count++;

        }	
        return $results;
		
    }
	
	
		public function get_projects_by_leader($criteria){
		
        $SQL_READ_ALL = "SELECT * FROM ".Project::$TABLE_NAME." WHERE project_leader=:project_leader AND is_completed=1 ORDER BY created_date DESC";
        
        $database = new Database();
		
        $database->query($SQL_READ_ALL);
		
		$database->bind(':project_leader',$criteria->getProjectLeader());
       
        $database->execute();
        
        $results = array();
        
        $records = $database->resultset();
		
		
        $count=0;

		foreach($records as $row) {	
		
			$projectObj = new Project();

			$projectObj->setId($row['id']);	

			$projectObj->setProjectName($row['project_name']);	

			$projectObj->setProjectCode($row['project_code']);				

			$projectObj->setProjectDescription($row['project_description']);

			$projectObj->setProjectStartDate($row['project_start_date']);

			$projectObj->setProjectEndDate($row['project_end_date']);

			$projectObj->setProjectLeader($row['project_leader']);

			$projectObj->setCreatedBy($row['created_by']);

			$projectObj->setCreatedDate($row['created_date']);

			$projectObj->setModifiedBy($row['modified_by']);	

			$projectObj->setModifiedDate($row['modified_date']);	

			//$projectObj->setIsCompleted($row['is_completed']);

			$projectObj->setProjectOwner($row['project_owner_id']);	

			$projectObj->setProjectRemark($row['project_remark']);	
	

            $results[$count] = $projectObj;
            
            $count++;

        }	
        return $results;
		
    }
	
	
	
	public function get_projects_by_member($criteria){
		
        $SQL_READ_ALL = "SELECT * FROM ".Project::$TABLE_NAME." WHERE FIND_IN_SET('$criteria', project_owner_id) AND is_completed=1 ORDER BY created_date DESC";
        
        $database = new Database();
		
        $database->query($SQL_READ_ALL);
		
		//$database->bind(':project_owner_id',$criteria->getProjectOwner());
       
        $database->execute();
        
        $results = array();
        
        $records = $database->resultset();
		
		
        $count=0;

		foreach($records as $row) {	
		
			$projectObj = new Project();

			$projectObj->setId($row['id']);	

			$projectObj->setProjectName($row['project_name']);	

			$projectObj->setProjectCode($row['project_code']);				

			$projectObj->setProjectDescription($row['project_description']);

			$projectObj->setProjectStartDate($row['project_start_date']);

			$projectObj->setProjectEndDate($row['project_end_date']);

			$projectObj->setProjectLeader($row['project_leader']);

			$projectObj->setCreatedBy($row['created_by']);

			$projectObj->setCreatedDate($row['created_date']);

			$projectObj->setModifiedBy($row['modified_by']);	

			$projectObj->setModifiedDate($row['modified_date']);	

			//$projectObj->setIsCompleted($row['is_completed']);

			$projectObj->setProjectOwner($row['project_owner_id']);	

			$projectObj->setProjectRemark($row['project_remark']);	
	

            $results[$count] = $projectObj;
            
            $count++;

        }	
        return $results;
		
    }
	
	
	
	
	
	public function get_all_projects_for_admin($criteria){
		
        $SQL_READ_ALL = "SELECT * FROM ".Project::$TABLE_NAME." WHERE is_completed=1 ORDER BY created_date DESC LIMIT 5";
        
        $database = new Database();
		
        $database->query($SQL_READ_ALL);
		
		//$database->bind(':project_leader',$criteria->getProjectLeader());
       
        $database->execute();
        
        $results = array();
        
        $records = $database->resultset();
		
		
        $count=0;

		foreach($records as $row) {	
		
			$projectObj = new Project();

			$projectObj->setId($row['id']);	

			$projectObj->setProjectName($row['project_name']);	

			$projectObj->setProjectCode($row['project_code']);				

			$projectObj->setProjectDescription($row['project_description']);

			$projectObj->setProjectStartDate($row['project_start_date']);

			$projectObj->setProjectEndDate($row['project_end_date']);

			$projectObj->setProjectLeader($row['project_leader']);

			$projectObj->setCreatedBy($row['created_by']);

			$projectObj->setCreatedDate($row['created_date']);

			$projectObj->setModifiedBy($row['modified_by']);	

			$projectObj->setModifiedDate($row['modified_date']);	

			//$projectObj->setIsCompleted($row['is_completed']);

			$projectObj->setProjectOwner($row['project_owner_id']);	

			$projectObj->setProjectRemark($row['project_remark']);	
	

            $results[$count] = $projectObj;
            
            $count++;

        }	
        return $results;
		
    }



    	//LAKHYA START

    	public function getTotalProjectUnderLeader($projectClass_obj){

    	$SQL_COUNT = "SELECT count(id) as total_projects FROM ".Project::$TABLE_NAME." 
    	
    	where project_leader=:project_leader  and is_completed=1";

    	$database = new Database();

    	$database->query($SQL_COUNT);

    	$database->bind(':project_leader',$projectClass_obj->getProjectLeader());

    	$database->execute();

    	$records = array();

    	$result = $database->resultset();

    	foreach ($result as $row) {
    		# code...

    		$records['total_projects'] = $row['total_projects'];


    		}	

    		return $records;
    		
    	}
		
		
		public function getTotalProject(){

    	$SQL_COUNT = "SELECT count(id) as total_projects FROM ".Project::$TABLE_NAME." 
    	
    	where is_completed=1";

    	$database = new Database();

    	$database->query($SQL_COUNT);

    	//$database->bind(':project_leader',$projectClass_obj->getProjectLeader());

    	$database->execute();

    	$records = array();

    	$result = $database->resultset();

    	foreach ($result as $row) {
    		# code...

    		$records['total_projects'] = $row['total_projects'];


    		}	

    		return $records;
    		
    	}

		

    	public function getTotalProjectAsMember($projectClass_obj){

    	$SQL_COUNT = "SELECT count(*)as total_member_projects FROM ".Project::$TABLE_NAME." 
    	
    	where FIND_IN_SET(:project_owner_id,project_owner_id) and is_completed=1 ";

    	$database = new Database();

    	$database->query($SQL_COUNT);

    	$database->bind(':project_owner_id',$projectClass_obj->getProjectOwner());

    	$database->execute();

    	$records = array();

    	$result = $database->resultset();
    	$count= 0;

    	foreach ($result as $row) {
    		# code...

    		$records['total_member_projects'] = $row['total_member_projects'];
    		
    		}	

    		return $records;
    		
    	}

    	

    

    	public function getTotalOverDueProjectsDetails($projectClass_obj){

    	$SQL_COUNT = "SELECT id,project_name,project_start_date,project_end_date,datediff(CURDATE(),project_end_date) as overdue FROM 
    	".Project::$TABLE_NAME." where CURDATE() > project_end_date and is_completed=1 and project_leader=:project_leader";

    	$database = new Database();

    	$database->query($SQL_COUNT);

    	$database->bind(':project_leader',$projectClass_obj->getProjectLeader());

    	$database->execute();

    	$records = array();

    	$result = $database->resultset();
    	$count = 0;

    	if($database->rowCount() > 0) {

    	foreach ($result as $row) {
    		# code...

    		$records[$count]['id'] = $row['id'];
    		$records[$count]['project_name'] = $row['project_name'];
    		$records[$count]['project_start_date'] = $row['project_start_date'];
    		$records[$count]['project_end_date'] = $row['project_end_date'];
    		$records[$count]['overdue'] = $row['overdue'];
    		
    		$count++;

    		}
    		
    		return $records;

    	}

    		return 0;
   	 }


    	public function getTotalOverDueProjectsUnderLeader($projectClass_obj){

    	
    	$SQL_COUNT = "SELECT count(id) as overdue_projects FROM ".Project::$TABLE_NAME." 
    	
    	where project_leader=:project_leader  and is_completed=1 and  CURDATE() > project_end_date";

    	$database = new Database();

    	$database->query($SQL_COUNT);

    	$database->bind(':project_leader',$projectClass_obj->getProjectLeader());

    	$database->execute();

    	$records = array();

    	$result = $database->resultset();

    	foreach ($result as $row) {
    		# code...

    		$records['overdue_projects'] = $row['overdue_projects'];


    		}	

    		return $records;
    	}
		
			public function getTotalOverDueProjects(){

    	
    	$SQL_COUNT = "SELECT count(id) as overdue_projects FROM ".Project::$TABLE_NAME." 
    	
    	where is_completed=1 and  CURDATE() > project_end_date";

    	$database = new Database();

    	$database->query($SQL_COUNT);

    	//$database->bind(':project_leader',$projectClass_obj->getProjectLeader());

    	$database->execute();

    	$records = array();

    	$result = $database->resultset();

    	foreach ($result as $row) {
    		# code...

    		$records['overdue_projects'] = $row['overdue_projects'];


    		}	

    		return $records;
    	}




    	public function updateProjectMaster($projectClass_obj){

		$SQL_UPDATE ="UPDATE ".Project::$TABLE_NAME."

		SET project_name = :project_name, project_description=:project_description,
		project_start_date =:project_start_date,project_end_date=:project_end_date,project_leader=:project_leader,
		modified_by =:modified_by,modified_date=CURDATE(),is_completed=:is_completed,
		project_owner_id =:project_owner_id,project_remark=:project_remark 
		where id=:id"; 	

		$database = new Database();

		$database->query($SQL_UPDATE);

		$database->bind(':project_name',$projectClass_obj->getProjectName());

		$database->bind(':project_description',$projectClass_obj->getProjectDescription());

		$database->bind(':project_start_date',$projectClass_obj->getProjectStartDate());

		$database->bind(':project_end_date',$projectClass_obj->getProjectEndDate());

		$database->bind(':project_leader',$projectClass_obj->getProjectLeader());

		//$database->bind(':created_by',$projectClass_obj->getCreatedBy());
		
		$database->bind(':modified_by',$projectClass_obj->getModifiedBy());

		$database->bind(':modified_date',$projectClass_obj->getModifiedDate());
		
		$database->bind(':project_is_completed',$projectClass_obj->getIsCompleted());
		
		$database->bind(':project_owner_id',$projectClass_obj->getProjectOwner());
		
		$database->bind(':project_remark',$projectClass_obj->getProjectRemark());		
		
		$database->bind(':id',$projectClass_obj->getId());

		$database->execute();

		if($database->rowCount() > 0){

			return true;

		}

			return false;
		}


		public function get_project_start_end_date_by_project_id($criteria){
		
        $SQL_READ_ALL = "SELECT project_start_date, project_end_date FROM project_master WHERE id=:id";
        
        $database = new Database();
		
        $database->query($SQL_READ_ALL);
		
		$database->bind(':id',$criteria->getId());
       
        $database->execute();
        
        $results = array();
        
        $records = $database->resultset();
		
		
        $count=0;

			foreach($records as $row) {	
		
			$criteria = new Project();

			$criteria->setProjectStartDate($row['project_start_date']);

			$criteria->setProjectEndDate($row['project_end_date']);

            $results[$count] = $criteria;
            
            $count++;

        }	
        return $results;


		}
		
		public function check_project_status_by_id($criteria){
		
        $SQL_READ_ALL = "SELECT * FROM ".Project::$TABLE_NAME." WHERE project_leader=:project_leader AND is_completed=1";
       
        $database = new Database();
        $database->query($SQL_READ_ALL);
		$database->bind(':project_leader',$criteria->getProjectLeader());		
        $database->execute();
		
        if($database->rowCount() > 0){

        	return true;

        	}
        
        	return false;

        }
		
		
		public function add_project_member($projectClass_obj){
			
		$SQL_INSERT = "UPDATE ".Project::$TABLE_NAME." SET project_owner_id = CONCAT(project_owner_id,:project_owner_id) WHERE
		id=:id";	

		$database = new Database();

		$database->query($SQL_INSERT);

		$database->bind(':project_owner_id',$projectClass_obj->getProjectOwner());
		
		$database->bind(':id',$projectClass_obj->getId());		
		
		$database->execute();
		
		$result= $database->lastInsertId();
		
		if($result!=''){
		return 1;
		}
		else{
			return 0;
		}
		
	}
	
		 public function delete_project($id)
    {
        $SQL_DELETE  = " DELETE ";
        $SQL_DELETE .= " FROM ".Project::$TABLE_NAME;
        $SQL_DELETE .= " WHERE id = :id";
        $database = new Database();
        $database->query($SQL_DELETE);
        $database->bind(':id', $id->getId());
        $database->execute();

        if($database->rowCount() > 0){

        	return true;

        	}
        
        	return false;

    }
	
	public function delete_project_member($projectClass_obj){
		
		
		
		$SQL_READ_ALL = "SELECT project_owner_id FROM project_master WHERE id=:id";
        
        $database = new Database();
		
        $database->query($SQL_READ_ALL);
		
		$database->bind(':id',$projectClass_obj->getId());
       
        $database->execute();
        
        $results = array();
        
        $records = $database->resultset();
		
		$count=0;

		foreach($records as $row) {	
		
			$projectObj = new Project();

			$projectObj->setProjectOwner($row['project_owner_id']);	

            $results[$count] = $projectObj;
            
            $count++;
		}
         foreach($results as $data){
		
		$old_list_of_members=$data->getProjectOwner(); 
		$member_to_delete=$projectClass_obj->getProjectOwner();
		//$newList = str_replace($member_to_delete.",", "", $old_list_of_members);
		
		$array = explode(',', $old_list_of_members);
		$pos = array_search($member_to_delete, $array);
		unset($array[$pos]);
		$string = implode(',', $array);
		 }
			
		$SQL_INSERT = "UPDATE ".Project::$TABLE_NAME." SET project_owner_id = '".$string."' WHERE
		id=:id";	

 		$database2 = new Database();
		
		$database2->query($SQL_INSERT);

		//$database2->bind(':project_owner_id',$projectClass_obj->getProjectOwner());
		
		$database2->bind(':id',$projectClass_obj->getId());
		
		$database2->execute();
	
		if($database2->rowCount() > 0){

        	return true;

        	}
        
        	return false;

		
		
	}
	
	
	public function get_projects_by_leader_and_project_id($criteria){
		
        $SQL_READ_ALL = "SELECT * FROM ".Project::$TABLE_NAME." WHERE project_leader=:project_leader AND id=:id AND is_completed=1";
        
        $database = new Database();
		
        $database->query($SQL_READ_ALL);
		
		$database->bind(':project_leader',$criteria->getProjectLeader());
		
		$database->bind(':id',$criteria->getId());
       
        $database->execute();
        
        $results = array();
        
        $records = $database->resultset();
		
		
        $count=0;

		foreach($records as $row) {	
		
			$projectObj = new Project();

			$projectObj->setId($row['id']);	

			$projectObj->setProjectName($row['project_name']);	

			$projectObj->setProjectCode($row['project_code']);				

			$projectObj->setProjectDescription($row['project_description']);

			$projectObj->setProjectStartDate($row['project_start_date']);

			$projectObj->setProjectEndDate($row['project_end_date']);

			$projectObj->setProjectLeader($row['project_leader']);

			$projectObj->setCreatedBy($row['created_by']);

			$projectObj->setCreatedDate($row['created_date']);

			$projectObj->setModifiedBy($row['modified_by']);	

			$projectObj->setModifiedDate($row['modified_date']);	

			//$projectObj->setIsCompleted($row['is_completed']);

			$projectObj->setProjectOwner($row['project_owner_id']);	

			$projectObj->setProjectRemark($row['project_remark']);	
	

            $results[$count] = $projectObj;
            
            $count++;

        }	
        return $results;
		
    }
	
		public function get_all_projects_for_admin_by_project_id($criteria){
		
        $SQL_READ_ALL = "SELECT * FROM ".Project::$TABLE_NAME." WHERE is_completed=1 AND id=:id";
        
        $database = new Database();
		
        $database->query($SQL_READ_ALL);
		
		$database->bind(':id',$criteria->getId());
       
        $database->execute();
        
        $results = array();
        
        $records = $database->resultset();
		
		
        $count=0;

		foreach($records as $row) {	
		
			$projectObj = new Project();

			$projectObj->setId($row['id']);	

			$projectObj->setProjectName($row['project_name']);	

			$projectObj->setProjectCode($row['project_code']);				

			$projectObj->setProjectDescription($row['project_description']);

			$projectObj->setProjectStartDate($row['project_start_date']);

			$projectObj->setProjectEndDate($row['project_end_date']);

			$projectObj->setProjectLeader($row['project_leader']);

			$projectObj->setCreatedBy($row['created_by']);

			$projectObj->setCreatedDate($row['created_date']);

			$projectObj->setModifiedBy($row['modified_by']);	

			$projectObj->setModifiedDate($row['modified_date']);	

			//$projectObj->setIsCompleted($row['is_completed']);

			$projectObj->setProjectOwner($row['project_owner_id']);	

			$projectObj->setProjectRemark($row['project_remark']);	
	

            $results[$count] = $projectObj;
            
            $count++;

        }	
        return $results;
		
    }
	public function getTotalOverDueProjectsDetailsAll(){

    	$SQL_COUNT = "SELECT id,project_name,project_start_date,project_end_date,datediff(CURDATE(),project_end_date) as overdue FROM 
    	".Project::$TABLE_NAME." where CURDATE() > project_end_date and is_completed=1";

    	$database = new Database();

    	$database->query($SQL_COUNT);

    	//$database->bind(':project_leader',$projectClass_obj->getProjectLeader());

    	$database->execute();

    	$records = array();

    	$result = $database->resultset();
    	$count = 0;

    	if($database->rowCount() > 0) {

    	foreach ($result as $row) {
    		# code...

    		$records[$count]['id'] = $row['id'];
    		$records[$count]['project_name'] = $row['project_name'];
    		$records[$count]['project_start_date'] = $row['project_start_date'];
    		$records[$count]['project_end_date'] = $row['project_end_date'];
    		$records[$count]['overdue'] = $row['overdue'];
    		
    		$count++;

    		}
    		
    		return $records;

    	}

    		return 0;
   	 }
	
	

	
}	



?>
