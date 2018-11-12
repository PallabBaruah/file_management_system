<?php

ini_set('display_errors',0);


class ProjectDetails{


	public static $TABLE_NAME = "project_details";

	private $id;
	private $project_id;
	private $task_name;
	private $task_description;
	private $task_start_date;
	private $task_end_date;
	private $user_id;
	private $priority;
	private $remarks;
	private $created_by;
	private $created_date;
	private $modified_by;
	private $modified_date;
	private $is_completed;
	private $delegated_id;
	


	public function setId($id){

		$this->id=$id;
	}

	public function getId(){

		return $this->id;
	}

	public function setProjectId($project_id){

		$this->project_id=$project_id;
	}

	public function getProjectId(){

		return $this->project_id;
	}


	public function setTaskName($task_name){

		$this->task_name=$task_name;
	}

	public function getTaskName(){

		return $this->task_name;
	}



	public function setTaskDescription($task_description){

		$this->task_description=$task_description;
	}

	public function getTaskDescription(){

		return $this->task_description;
	}


	public function setTaskStartDate($task_start_date){

		$this->task_start_date=$task_start_date;
	}

	
	public function getTaskStartDate(){

		return $this->task_start_date;
	}


	public function setTaskEndDate($task_end_date){

		$this->task_end_date=$task_end_date;
	}

	
	public function getTaskEndDate(){

		return $this->task_end_date;
	}



	public function setUserId($user_id){

		$this->user_id=$user_id;
	}

	
	public function getUserId(){

		return $this->user_id;
	}


	public function setPriority($priority){

		$this->priority=$priority;
	}

	
	public function getPriority(){

		return $this->priority;
	}


	public function setRemarks($remarks){

		$this->remarks=$remarks;
	}

	
	public function getRemarks(){

		return $this->remarks;
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
		
		public function setDelegatedId($delegated_id){

			$this->delegated_id=$delegated_id;


		}

		public function getDelegatedId(){

			return $this->$delegated_id;
		}


}

class ProjectDetailsDAO{


		public function insert_project_details($projectDetails_obj){


		$SQL_INSERT = "INSERT INTO ".ProjectDetails::$TABLE_NAME."(

		project_id,
		task_name,
		task_description,
		task_start_date,
		task_end_date,
		user_id,
		priority,
		remarks,
		created_by,
		created_date,
		modified_by,
		modified_date,
		is_completed,
		delegated_id

		)";

		$SQL_INSERT .= " VALUES(

		:project_id,
		:task_name,
		:task_description,
		:task_start_date,
		:task_end_date,
		:user_id,
		:priority,
		:remarks,
		:created_by,
		 NOW(),
		:modified_by,
		:modified_date,
		:is_completed,
		:delegated_id
			
		)";	

		$database = new Database();

		$database->query($SQL_INSERT);

		$database->bind(':project_id',$projectDetails_obj->getProjectId());

		$database->bind(':task_name',$projectDetails_obj->getTaskName());

		$database->bind(':task_description',$projectDetails_obj->getTaskDescription());

		$database->bind(':task_start_date',$projectDetails_obj->getTaskStartDate());

		$database->bind(':task_end_date',$projectDetails_obj->getTaskEndDate());

		$database->bind(':user_id',$projectDetails_obj->getUserId());

		$database->bind(':priority',$projectDetails_obj->getPriority());

		$database->bind(':remarks',$projectDetails_obj->getRemarks());

		$database->bind(':created_by',$projectDetails_obj->getCreatedBy());

		$database->bind(':modified_by',$projectDetails_obj->getModifiedBy());

		$database->bind(':modified_date',$projectDetails_obj->getModifiedDate());

		$database->bind(':is_completed',$projectDetails_obj->getIsCompleted());
		
		$database->bind(':delegated_id',$projectDetails_obj->getDelegatedId());


		$database->execute();

		$result= $database->lastInsertId();

		return 1;

	}


		public function update_project_details($projectDetails_obj){

		$SQL_UPDATE ="UPDATE ".ProjectDetails::$TABLE_NAME."

		SET project_id = :project_id, task_name=:task_name,
		task_description =:task_description,task_start_date=:task_start_date
		task_end_date =:task_end_date,user_id=:user_id,priority=:priority,remarks=:remarks,
		modified_by=:modified_by,modified_date=:modified_date,is_completed=:is_completed
		where id=:id"; 

		$database = new Database();
		$database->query($SQL_UPDATE);	

		$database->bind(':project_id',$projectDetails_obj->getProjectId());

		$database->bind(':task_name',$projectDetails_obj->getTaskName());

		$database->bind(':task_description',$projectDetails_obj->getTaskDescription());

		$database->bind(':task_start_date',$projectDetails_obj->getTaskStartDate());

		$database->bind(':task_end_date',$projectDetails_obj->getTaskEndDate());

		$database->bind(':user_id',$projectDetails_obj->getUserId());

		$database->bind(':priority',$projectDetails_obj->getPriority());

		$database->bind(':remarks',$projectDetails_obj->getRemarks());

		$database->bind(':modified_by',$projectDetails_obj->getModifiedBy());

		$database->bind(':modified_date',$projectDetails_obj->getModifiedDate());

		$database->bind(':is_completed',$projectDetails_obj->getIsCompleted());

		$database->bind(':id',$projectDetails_obj->getId());

		$result= $database->execute();

		if($database->rowCount() > 0){

			$result=TRUE;

		}

		return $result;

	}



		public function getProjectDetailsByProjectId($projectDetails_obj){


		$SQL_FIND = "SELECT * FROM ".ProjectDetails::$TABLE_NAME." where project_id=:project_id";


		$database = new Database();

		$database->query($SQL_FIND);

		$database->bind(':project_id',$projectDetails_obj->getProjectId());

		$database->execute();
        
        $results = array();
        
        $records = $database->resultset();

        $count = 0;
	
		foreach ($records as $row){
	
				$projectDetailsObj = new ProjectDetails();

				$projectDetailsObj->setId($row['id']);

				$projectDetailsObj->setTaskName($row['task_name']);

				$projectDetailsObj->setTaskDescription($row['task_description']);

				$projectDetailsObj->setTaskStartDate($row['task_start_date']);

				$projectDetailsObj->setTaskEndDate($row['task_end_date']);
				
				$projectDetailsObj->setUserId($row['user_id']);

				$projectDetailsObj->setPriority($row['priority']);

				$projectDetailsObj->setRemarks($row['remarks']);

				$projectDetailsObj->setCreatedBy($row['created_by']);

				$projectDetailsObj->setCreatedDate($row['created_date']);

				$projectDetailsObj->setModifiedBy($row['modified_by']);

				$projectDetailsObj->setModifiedDate($row['modified_date']);

				$projectDetailsObj->setIsCompleted($row['is_completed']);

				$results[$count] = $projectDetailsObj;
				
				$count++;

		
			}
		
			return $results;
		

		}




		public function getProjectDetailsByUserId($projectDetails_obj){


		$SQL_FIND = "SELECT * FROM ".ProjectDetails::$TABLE_NAME." where user_id=:user_id";

		$database = new Database();

		$database->query($SQL_FIND);

		$database->bind(':user_id',$projectDetails_obj->getUserId());

		
		$database->execute();
        
        $results = array();
        
        $records = $database->resultset();

        $count = 0;
		
	
		foreach ($records as $row){


				$projectDetailsObj = new ProjectDetails();

				$projectDetailsObj->setId($row['id']);

				$projectDetailsObj->setProjectId($row['project_id']);

				$projectDetailsObj->setTaskName($row['task_name']);

				$projectDetailsObj->setTaskDescription($row['task_description']);

				$projectDetailsObj->setTaskStartDate($row['task_start_date']);

				$projectDetailsObj->setTaskEndDate($row['task_end_date']);

				$projectDetailsObj->setPriority($row['priority']);

				$projectDetailsObj->setRemarks($row['remarks']);

				$projectDetailsObj->setCreatedBy($row['created_by']);

				$projectDetailsObj->setCreatedDate($row['created_date']);

				$projectDetailsObj->setModifiedBy($row['modified_by']);

				$projectDetailsObj->setModifiedDate($row['modified_date']);

				$projectDetailsObj->setIsCompleted($row['is_completed']);

				$results[$count] = $projectDetailsObj;
				
				$count++;


			}
			return $results;
		


		}

		 public function delete_task($id)
    {
        //$result = FALSE;
        $SQL_DELETE  = " DELETE ";
        $SQL_DELETE .= " FROM ".ProjectDetails::$TABLE_NAME;
        $SQL_DELETE .= " WHERE id = :id";
        $database = new Database();
        $database->query($SQL_DELETE);
        $database->bind(':id', $id->getId());
        $result = $database->execute();

        return $result;
    }
		
		
				 public function update_task_completed($criteria)
    {
        $SQL_UPDATE_COMPLETED  = " UPDATE ".ProjectDetails::$TABLE_NAME." SET is_completed = :is_completed WHERE id = :id";
        $database = new Database();
        $database->query($SQL_UPDATE_COMPLETED);
        $database->bind(':id', $criteria->getId());
		$database->bind(':is_completed', $criteria->getIsCompleted());
        $result = $database->execute();

        return $result;
    }
	
	public function get_is_completed_status_with_id($criteria)
    {
        $SQL_SELECT_COMPLETED  = " SELECT is_completed FROM ".ProjectDetails::$TABLE_NAME." WHERE project_id = :project_id";
        $database = new Database();
        $database->query($SQL_SELECT_COMPLETED);
        $database->bind(':project_id', $criteria->getProjectId());
        $result = $database->execute();
		
		$records = $database->resultset();
		
		//$sum=array_sum($records);
		
		 
		 $sum=array_sum(array_column($records, 'is_completed'));
		 
		 $count=$database->rowCount($records);
		 
		 $rowcount=2*$count;
		
		if ($count==0)
		
		{
			return 0;
		}
		elseif($rowcount == $sum)
		{
			return 2;
		}
		else{
			return 1;
		}
		
		
    }

	
		public function getProjectDetailsBy_Id($projectDetails_obj){


		$SQL_FIND = "SELECT * FROM ".ProjectDetails::$TABLE_NAME." where id=:id";


		$database = new Database();

		$database->query($SQL_FIND);

		$database->bind(':id',$projectDetails_obj->getId());

		$database->execute();
        
        $results = array();
        
        $records = $database->resultset();

        $count = 0;
	
		foreach ($records as $row){
	
				$projectDetailsObj = new ProjectDetails();

				$projectDetailsObj->setId($row['id']);

				$projectDetailsObj->setTaskName($row['task_name']);

				$projectDetailsObj->setTaskDescription($row['task_description']);

				$projectDetailsObj->setTaskStartDate($row['task_start_date']);

				$projectDetailsObj->setTaskEndDate($row['task_end_date']);
				
				$projectDetailsObj->setUserId($row['user_id']);

				$projectDetailsObj->setPriority($row['priority']);

				$projectDetailsObj->setRemarks($row['remarks']);

				$projectDetailsObj->setCreatedBy($row['created_by']);

				$projectDetailsObj->setCreatedDate($row['created_date']);

				$projectDetailsObj->setModifiedBy($row['modified_by']);

				$projectDetailsObj->setModifiedDate($row['modified_date']);

				$projectDetailsObj->setIsCompleted($row['is_completed']);

				$results[$count] = $projectDetailsObj;
				
				$count++;

		
			}
		
			return $results;
		

		}




		

}








?>