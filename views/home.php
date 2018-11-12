 <?php								
//ob_start();
//session_start();
session_start();
if($admin=$_SESSION['user_email']==null)
{
	header("Location:?");
}
else{

?>
<h2> <?php echo $_SESSION['user_id'];	 ?></h2>

       
                                   <?php
								   //if(!isset($_SESSION)){session_start();}
		
								echo $_SESSION['user_name'];	
								echo $_SESSION['user_id'];
								echo $_SESSION['user_email'];
								echo $_SESSION['usertype'];	}
								   ?>

