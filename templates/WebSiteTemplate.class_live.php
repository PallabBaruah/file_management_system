<?php
session_start();
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_WARNING & ~E_STRICT);
error_reporting(E_ALL); ini_set('display_errors', 'On'); 

class PageTemplate{




   public static $BASEURL  = "http://www.shapingtomorrow.in/admin";

function GeneratePageHeader($title, $META_KEYWORDS){

	

	PageTemplate::$BASEURL = "http://www.shapingtomorrow.in/admin";


	global $META_KEYWORDS;

	global $DESCRIPTION;

	if($META_KEYWORDS == ""){

	   $META_KEYWORDS  = "Shaping Tomorrow";

	}

	if($DESCRIPTION == ""){

		$DESCRIPTION = "Shaping Tomorrow";

	}

	$dir  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

	$currentPage = $_SERVER['PHP_SELF'];

	 

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />

        <script src="<?=PageTemplate::$BASEURL?>/assets/js/jquery-1.12.4.js"></script>
      	<script src="<?=PageTemplate::$BASEURL?>/assets/js/jquery-ui.js"></script>


	<link rel="icon" type="image/png" href="<?=PageTemplate::$BASEURL?>/assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title></title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <link href="<?=PageTemplate::$BASEURL?>/assets/css/bootstrap.min.css" rel="stylesheet" />

    <link href="<?=PageTemplate::$BASEURL?>/assets/css/animate.min.css" rel="stylesheet"/>

    <link href="<?=PageTemplate::$BASEURL?>/assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>
    <link href="<?=PageTemplate::$BASEURL?>/assets/css/pe-icon-7-stroke.css" rel="stylesheet"/>



    <!--     Fonts and icons     -->
    <link href="<?=PageTemplate::$BASEURL?>/assets/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <!--<link href="<?=PageTemplate::$BASEURL?>/assets/css/pe-icon-7-stroke.css" rel="stylesheet" />-->
    
    <link href="<?=PageTemplate::$BASEURL?>/assets/css/bootstrap-datepicker.css" rel="stylesheet" />
    
     <link href="<?=PageTemplate::$BASEURL?>/assets/css/custom.css" rel="stylesheet" />
     
    
     <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


</head>

<body>
 <?php if(isset($_SESSION['user_email'])){ ?>
<div class="wrapper">

    <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">

    	<div class="sidebar-wrapper">
            <div class="logo">
            <img src="assets/img/logo_st.png" width="100" height="60"> </div>

            <ul class="nav">
                <li class="<?php if(isset($_SESSION['password_created']) && $_SESSION['password_created']==1 ){ echo "disabled";} else {echo""; }?>">
                    <a href="<?php if(isset($_SESSION['password_created']) && $_SESSION['password_created']==2 ){ echo "?module=dashboard&action=list"; } else { echo""; }?>">
                        <i class="fa fa-tachometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <!--<li class="<?php if(isset($_SESSION['password_created']) && $_SESSION['password_created']==1 ){ echo "disabled";} else {echo""; }?>">
                    <a href="<?php if(isset($_SESSION['password_created']) && $_SESSION['password_created']==2 ){ echo "?module=dashboard&action=user"; } else { echo""; }?>">
                        <i class="pe-7s-user"></i>
                        <p>Manage User</p>
                    </a>
                </li>-->
            
             <?php if(isset($_SESSION['usertype']) && $_SESSION['usertype']== "ADMIN"){?>

             
                <li class="<?php if(isset($_SESSION['password_created']) && $_SESSION['password_created']==1 ){ echo "disabled";} else {echo""; }?>">
                    <a href="<?php if(isset($_SESSION['password_created']) && $_SESSION['password_created']==2 ){ echo "?module=user&action=create_user"; } else { echo""; }?>">
                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                        <p>Create User</p>
                    </a>
                </li>
            <?php }  else {}?>

            

             <?php if(isset($_SESSION['usertype']) && $_SESSION['usertype']!= "NORMAL"){?>
                <li class="<?php if(isset($_SESSION['password_created']) && $_SESSION['password_created']==1 ){ echo "disabled";} else {echo""; }?>">
                    <a href="<?php if(isset($_SESSION['password_created']) && $_SESSION['password_created']==2 ){ echo "?module=user&action=view_user"; } else { echo""; }?>">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                        <p>View Users</p>
                    </a>
                </li>
                <?php } ?>

                 <!--<li class="<?php if(isset($_SESSION['password_created']) && $_SESSION['password_created']==1 ){ echo "disabled";} else {echo""; }?>">
                    <a href="<?php if(isset($_SESSION['password_created']) && $_SESSION['password_created']==2 ){ echo "?module=dashboard&action=project"; } else { echo""; }?>">
                        <i class="pe-7s-note2"></i>
                        <p>Projects</p>
                    </a>
                </li>-->

                 
                 <?php if(isset($_SESSION['usertype']) && $_SESSION['usertype']!= "NORMAL"){?>
        
                 <li class="<?php if(isset($_SESSION['password_created']) && $_SESSION['password_created']==1 ) { echo "disabled";} else {echo""; }?>">
                    <a href="<?php if(isset($_SESSION['password_created']) && $_SESSION['password_created']==2 ){ echo "?module=project&action=project_add"; } else { echo""; }?>">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        <p>Create Project</p>
                    </a>
                </li>
                <?php } ?>
                

                
                 <?php if(isset($_SESSION['usertype']) && $_SESSION['usertype']!= "NORMAL"){?>
                 <li class="<?php if(isset($_SESSION['password_created']) && $_SESSION['password_created']==1 ){ echo "disabled";} else {echo""; }?>">
                    <a href="<?php if(isset($_SESSION['password_created']) && $_SESSION['password_created']==2 ){ echo "?module=project&action=project_view"; } else { echo""; }?>">
                        <i class="fa fa-folder-open" aria-hidden="true"></i>
                        <p>View Projects</p>
                    </a>
                </li>
                 <?php } ?>

                  
                <li class="<?php if(isset($_SESSION['password_created']) && $_SESSION['password_created']==1 ){ echo "disabled";} else {echo""; }?>">
                    <a href="<?php if(isset($_SESSION['password_created']) && $_SESSION['password_created']==2 ){ echo "?module=project&action=project_view_complete"; } else { echo""; }?>">
                        <i class="fa fa-list-alt" aria-hidden="true"></i>
                        <p>Completed Projects</p>
                    </a>
                </li>
                
                <li class="<?php if(isset($_SESSION['password_created']) && $_SESSION['password_created']==1 ){ echo "disabled";} else {echo""; }?>">
                    <a href="<?php if(isset($_SESSION['password_created']) && $_SESSION['password_created']==2 ){ echo "?module=user&action=profile"; } else { echo""; }?>">
                        <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                        <p>Partner Profile</p>
                    </a>
                </li>
                 <!--<li class="<?php if(isset($_SESSION['password_created']) && $_SESSION['password_created']==1 ){ echo "disabled";} else {echo""; }?>">
                    <a href="<?php if(isset($_SESSION['password_created']) && $_SESSION['password_created']==2 ){ echo "?module=dashboard&action=change_password"; } else { echo""; }?>">
                        <i class="pe-7s-news-paper"></i>
                        <p>Change Password</p>
                    </a>
                </li>-->
            </ul>
    	</div>
    </div>

    <div class="main-panel">
    <div class="welcome">
                               <p class="welcome_msg">Welcome to the admin panel of <span class="colr2">Shaping Tomorrow for our partners</span></p>
                          </div>
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse">
                    

                    <ul class="nav navbar-nav pull-right top-nav">
                    
                        <li>
                          
                               <p class="welcomename">Welcome <?php if(isset($_SESSION['first_name'])){ echo $_SESSION['salutation']." ".$_SESSION['first_name']." ".$_SESSION['last_name'];	} ?></p>
                           
                        </li>
                        <li>
                            <a href="?module=user&action=log_out">
                                <p class="logout">Log out</p>
                            </a>
                        </li>
						<li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>

<?php }else{ ?>
    <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">

    	<div class="sidebar-wrapper">
            <div class="logo">
            <img src="assets/img/logo_st.png" width="100" height="60"> </div>

            <ul class="nav">

            </ul>
   	  </div>
    </div>
    <div class="main-panel">
        <div class="welocme">
                  
                         <p class="welcome_msg">Welcome to the admin panel of <span class="colr2">Shaping Tomorrow for our partners</span></p>
                          </div>
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                
                         
            </div>


	
	
	<?php } }
function GeneratePageFooter(){

$dir  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

$currentPage = $_SERVER['PHP_SELF'];

?>

        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                       
                    </ul>
                </nav>
                
            </div>
        </footer>
</div>
    </div>
</div>


</body>

	<script src="<?=PageTemplate::$BASEURL?>/assets/js/bootstrap.min.js" type="text/javascript"></script>

	<script src="<?=PageTemplate::$BASEURL?>/assets/js/bootstrap-checkbox-radio-switch.js"></script>

	<script src="<?=PageTemplate::$BASEURL?>/assets/js/chartist.min.js"></script>

    <script src="<?=PageTemplate::$BASEURL?>/assets/js/bootstrap-notify.js"></script>

    <!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>-->

	<script src="<?=PageTemplate::$BASEURL?>/assets/js/light-bootstrap-dashboard.js"></script>
    

    
    


</html>
<?php } }?>