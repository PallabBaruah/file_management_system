 <?php if(!isset($_SESSION['user_email'])){ ?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Partner Login</h4>
                            </div>
                            <div class="content">
                              
                                <form enctype="multipart/form-data" name="form_login" method="post" action="?module=user&action=login_screen">
                                   <?php if(isset($_SESSION['ERROR_MESSAGE_SIGN_IN'])){?>
							<div class="alert alert-warning">
							  <strong>Warning!</strong> <?php echo $_SESSION['ERROR_MESSAGE_SIGN_IN'];$_SESSION[			'ERROR_MESSAGE_SIGN_IN']=NULL;?>
                              							</div>

                              <?php } ?>
                              
                               <?php if(isset($_SESSION['SUCCESS_FORGOT_PASSWORD_RESET'])){?>
							<div class="alert alert-success">
							  <strong>Success!</strong> <?php echo $_SESSION['SUCCESS_FORGOT_PASSWORD_RESET'];$_SESSION[			'SUCCESS_FORGOT_PASSWORD_RESET']=NULL;?>
                              							</div>

                              <?php } ?>
                                        
                                        <div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" placeholder="Email" name="email" required>
                                             </div>
                                        </div>
                                     
                                        

                                        
                                        <div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control" placeholder="Password" name="password"  id="password" required>
                                                <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                            </div>
                                        </div>  
                                        
                                        <div>
                                            <div class="form-group">
                                                <a href="?module=password&action=forgot_pass_email">Forgot Password?</a>
                                            </div>
                                        </div>  


                                    

                                   <button type="submit" class="btn btn-info btn-fill ">LogIn</button>

                                   <button type="reset" class="btn btn-info btn-fill ">Reset</button>

                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
          </div>
           <script>
		   $(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
		   </script>     
<?php } ?>