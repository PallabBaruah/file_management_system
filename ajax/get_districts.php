<?php
$state='';


if(isset($_POST['state'])){
	$state=$_POST['state'];
}


$string = file_get_contents("../data/districts.json");
$jsonRS = json_decode ($string,true);



$array_districts=array();
$i=0;





foreach ($jsonRS as $rs) {	
	/****
	if(stripslashes($rs['state'])!=''){
			  if(strtoupper($state)==strtoupper(stripslashes($rs['state'])){
				  $array_districts[$i]['district']=stripslashes($rs['district']);
				 
			  }
			  $i++;

	}
	***/
	 //echo stripslashes($rs['state'])."<br/>";
	 if(strtoupper(stripslashes($rs['state']))==strtoupper($state)){
		//echo stripslashes($rs['district'])."<br/>";
		$array_districts[$i]['district']=stripslashes($rs['district']);
		$i++;
	 }

}

//$result=array('state'=>$state,'district'=>$district);
$array_districts = array_map("unserialize", array_unique(array_map("serialize", $array_districts)));
$result=array();
$i=0;
foreach($array_districts as $dt){
	$result[$i]['district']=$dt['district'];
	$i++;

}
//$result= $array_districts;

echo json_encode($result);
?>