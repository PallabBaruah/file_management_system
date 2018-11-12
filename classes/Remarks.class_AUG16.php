<?php

ini_set('display_errors',0);

class Remarks{


	public static $TABLE_NAME = "remarks";


		private $id;
		private $task_id;
		private $project_id;
		private $remarks;
		private $user_id;
		private $created_by;
		private $created_date;
		private $remark_link;


		public function setId($id){

			$this->id =$id;
		}	


		public function getId(){

			return $this->id;
		}	

		public function setTaskId($task_id){

			$this->task_id =$task_id;
		}	


		public function getTaskId(){

			return $this->task_id;
		}	

		public function setRemarks($remarks){

			$this->remarks =$remarks;
		}	


		public function getRemarks(){

			return $this->remarks;
		}	




		public function setUserId($user_id){

			$this->user_id =$user_id;
		}	


		public function getUserId(){

			return $this->user_id;
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
		
		public function setRemarkLink($remark_link){

			$this->remark_link=$remark_link;


		}

		public function getRemarkLink(){

			return $this->remark_link;
		}
		
		
		public function setProjectId($project_id){

			$this->project_id=$project_id;


		}

		public function getProjectId(){

			return $this->project_id;
		}

}


class RemarksDAO{


		public function insert_remarks($remarksClass_obj){

			$SQL_INSERT = "INSERT INTO ".Remarks::$TABLE_NAME."(

			task_id,
			project_id,
			remarks,
			user_id,
			created_by,
			created_date,
			remark_link

			)";

			$SQL_INSERT .= " VALUES(

			:task_id,
			:project_id,
			:remarks,
			:user_id,
			:created_by,
			 NOW(),
			:remark_link
			
			)";	

			$database = new Database();

			$database->query($SQL_INSERT);

			$database->bind(':task_id',$remarksClass_obj->getTaskId());

			$database->bind(':remarks',$remarksClass_obj->getRemarks());

			$database->bind(':user_id',$remarksClass_obj->getUserId());

			$database->bind(':created_by',$remarksClass_obj->getCreatedBy());

			$database->bind(':remark_link',$remarksClass_obj->getRemarkLink());
			
			$database->bind(':project_id',$remarksClass_obj->getProjectId());

			$database->execute();

			$result= $database->lastInsertId();

			return 1;



	}		
	
	
			public function read_remark_by_task_id($criteria){
		
        $SQL_READ_ALL = "SELECT * FROM remarks WHERE task_id=:task_id";
        
        $database = new Database();
		
        $database->query($SQL_READ_ALL);
		
		$database->bind(':task_id',$criteria->getTaskId());
       
        $database->execute();
        
        $results = array();
        
        $records = $database->resultset();
		
		
        $count=0;

		foreach($records as $row) {	
		
			$remarkObj = new Remarks();

			$remarkObj->setId($row['id']);	

			$remarkObj->setTaskId($row['task_id']);	

			$remarkObj->setProjectId($row['project_id']);				

			$remarkObj->setRemarks($row['remarks']);

			$remarkObj->setUserId($row['user_id']);

			$remarkObj->setCreatedBy($row['created_by']);

			$remarkObj->setCreatedDate($row['created_date']);

			$remarkObj->setRemarkLink($row['remark_link']);


            $results[$count] = $remarkObj;
            
            $count++;

        }	
        return $results;
		
    }






}

?>