                 <?php if(isset($_SESSION['user_email'])){ ?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">SET USER PASSWORD</h4>
                            </div>
                            <div class="content">
                              
                                <form enctype="multipart/form-data" name="form_login" method="post" action="?module=dashboard&action=first_time_password_action">
                                   <?php if(isset($_SESSION['ERROR_MESSAGE_FIRST_PW_CHANGE'])){?>
							<div class="alert alert-warning">
							  <strong>Warning!</strong> <?php echo $_SESSION['ERROR_MESSAGE_FIRST_PW_CHANGE'];$_SESSION['ERROR_MESSAGE_FIRST_PW_CHANGE']=NULL;?>
                              							</div>

                              <?php } ?>
                              <?php if(isset($_SESSION['FIRST_PW_CHANGE_SUCCESS'])){?>
							<div class="alert alert-success">
							  <strong>Success!</strong> <?php echo $_SESSION['FIRST_PW_CHANGE_SUCCESS'];$_SESSION['FIRST_PW_CHANGE_SUCCESS']=NULL;?>
                              							</div>
                                        <?php } ?>
                                        
                                        <div>
                                            <div class="form-group">
                                                <label>ENTER 6 DIGIT OTP</label>
                                                <input type="password" class="form-control" placeholder="OTP" name="old_password" required="required" id="old_password" pattern="[0-9]{6}" title="OTP is a six digit number" maxlength="10" min="10">
                                             </div>
                                        </div>
                                     
            
                                        
                                        <div>
                                            <div class="form-group">
                                                <label>New Password</label>
                                                <input type="password" class="form-control" placeholder=" New Password" name="new_password"  id="new_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%]).{6,15}" title="Passowrd must be 6 to 15 characters long that must contain atleast one number, one special Character, one uppercase and one lowercase letter." required="required" onChange="checkPasswordMatch();">
                                            </div>
                                        </div>  

                                        <div>
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password"  id="confirm_password" onchange="checkPasswordMatch();" required="required">
                                            </div>
                                                           

                                         </div>
                                   
                        

                                   <button type="submit" class="btn btn-info btn-fill reset_pw_btn">Reset Password</button>


                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
          </div>
          
          
          <script>
function checkPasswordMatch() {
    var password = $("#new_password").val();
    var confirmPassword = $("#confirm_password").val();

    if (password != confirmPassword){
        $("#confirm_password").css('border','3px solid #DD4E41')}
    else{
        $("#confirm_password").css('border','3px solid #318D0F')}
}


$(document).ready(function () {
   $("#confirm_password").keyup(checkPasswordMatch);
});

</script>

<script>
$(document).ready(function(){
    $('.reset_pw_btn').attr('disabled',true);
 $("#new_password, #confirm_password, #old_password").bind("change keyup",
  function () { 
  if ($("#old_password").val()!="" && $("#new_password").val() != "" && $("#new_password").val() == $("#confirm_password").val()) {
            $('.reset_pw_btn').attr('disabled', false);
        }
        else
        {
            $('.reset_pw_btn').attr('disabled', true);
        }
    })
});</script>    


          
			<?php } else { echo "<script type='text/javascript'>window.location='?';</script>";
					exit();}?>
					
                    