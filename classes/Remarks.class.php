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
		private $delegated_id;
		private $priority;
		private $change_end_date;
		private $change_start_date;		
		private $status;
		private $start_form;
		private $num_rec_per_page;
		



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


		public function setDelegatedId($delegated_id){

			$this->delegated_id=$delegated_id;


		}

		public function getDelegatedId(){

			return $this->delegated_id;
		}

	
		public function setPriority($priority){

			$this->priority=$priority;


		}

		public function getPriority(){

			return $this->priority;
		}


		public function setChangeEndDate($change_end_date){

			$this->change_end_date=$change_end_date;

		}
		

		public function getChangeEndDate(){

			return $this->change_end_date;
		}


		public function setChangeStartDate($change_start_date){

			$this->change_start_date=$change_start_date;

		}
		

		public function getChangeStartDate(){

			return $this->change_start_date;
		}



		public function setStatus($status){

			$this->status=$status;
		}
		

		public function getStatus(){

			return $this->status;
		}
		
				public function setStartForm($start_form){

			$this->start_form=$start_form;
		}
		

		public function getStartForm(){

			return $this->start_form;
		}
		
		public function setNumRecPerPage($num_rec_per_page){

			$this->num_rec_per_page=$num_rec_per_page;
		}
		

		public function getNumRecPerPage(){

			return $this->num_rec_per_page;
		}






}


class RemarksDAO{


		public function insert_remarks($remarksClass_obj){

			$SQL_INSERT = "INSERT INTO ".Remarks::$TABLE_NAME."(

			task_id,
			remarks,
			user_id,
			created_by,
			created_date,
			remark_link,
			delegated_id,
			priority,
			change_start_date,
			change_end_date,
			status

			)";

			$SQL_INSERT .= " VALUES(

			:task_id,
			:remarks,
			:user_id,
			:created_by,
			 NOW(),
			:remark_link,
			:delegated_id,
			:priority,
			:change_start_date,
			:change_end_date,
			:status
			
			)";	
			
			$database = new Database();

			$database->query($SQL_INSERT);

			$database->bind(':task_id',$remarksClass_obj->getTaskId());

			$database->bind(':remarks',$remarksClass_obj->getRemarks());

			$database->bind(':user_id',$remarksClass_obj->getUserId());

			$database->bind(':created_by',$remarksClass_obj->getCreatedBy());

			$database->bind(':remark_link',$remarksClass_obj->getRemarkLink());
			
			$database->bind(':delegated_id',$remarksClass_obj->getDelegatedId());
			
			$database->bind(':priority',$remarksClass_obj->getPriority());

			$database->bind(':change_end_date',$remarksClass_obj->getChangeEndDate());
			
			$database->bind(':change_start_date',$remarksClass_obj->getChangeStartDate());			

			$database->bind(':status',$remarksClass_obj->getStatus());
			
			
			$database->execute();

			$result= $database->lastInsertId();

			return 1;



			}	
			


		public function read_remark_by_task_id($criteria){
		
        $SQL_READ_ALL = "SELECT * FROM ".Remarks::$TABLE_NAME." WHERE task_id=:task_id ORDER BY created_date DESC LIMIT :start_from, :num_rec_per_page";
        
        $database = new Database();
		
        $database->query($SQL_READ_ALL);
		
		$database->bind(':task_id',$criteria->getTaskId());
		
		$database->bind(':start_from',$criteria->getStartForm());
		
		$database->bind(':num_rec_per_page',$criteria->getNumRecPerPage());
       
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

			$remarkObj->setDelegatedId($row['delegated_id']);

			$remarkObj->setPriority($row['priority']);

			$remarkObj->setChangeEndDate($row['change_end_date']);
			
			$remarkObj->setChangeStartDate($row['change_start_date']);

			$remarkObj->setStatus($row['status']);


            $results[$count] = $remarkObj;
            
            $count++;

        }	
        return $results;
		
    }
	
	public function count_remark_task_id($criteria){
		
        $SQL_READ_ALL = "SELECT * FROM ".Remarks::$TABLE_NAME." WHERE task_id=:task_id";
        
        $database = new Database();
		
        $database->query($SQL_READ_ALL);
		
		$database->bind(':task_id',$criteria->getTaskId());
		
		$result=$database->execute();
		
		$count = $database->rowCount($result);
		
		return $count;
		
	}







}

?>