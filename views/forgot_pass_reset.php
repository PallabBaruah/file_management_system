 <?php if(!isset($_SESSION['user_email'])){ ?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">RESET PASSWORD<a href="?module=user&action=sign_in" class="btn btn-info btn-fill pull-right"><< Sign In</a></h4>
                            </div>
                            <div class="content">
                              
                                <form enctype="multipart/form-data" name="form_login" method="post" action="?module=password&action=forgot_pass_reset_action">
                                   <?php if(isset($_SESSION['ERROR_FORGOT_PASSWORD_RESET'])){?>
							<div class="alert alert-warning">
							  <strong>Warning!</strong> <?php echo $_SESSION['ERROR_FORGOT_PASSWORD_RESET'];$_SESSION[			'ERROR_FORGOT_PASSWORD_RESET']=NULL;?>
                              							</div>

                              <?php } ?>
                              
                               <?php if(isset($_SESSION['ERROR_NEW_CONF_MISMATCH'])){?>
							<div class="alert alert-danger">
							  <strong>Sorry!</strong> <?php echo $_SESSION['ERROR_NEW_CONF_MISMATCH'];$_SESSION[			'ERROR_NEW_CONF_MISMATCH']=NULL;?>
                              							</div>

                              <?php } ?>
                                        
                                        <div>
                                            <div class="form-group">
                                                <label>New Password</label>
                                                <input type="password" class="form-control" placeholder="New Password" name="new_pass" required>
                                             </div>
                                        </div>
                                        
                                        <div>
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input type="password" class="form-control" placeholder="Confirm Password" name="conf_pass" required>
                                             </div>
                                        </div>
                                     
                                        

                                   <button type="submit" class="btn btn-info btn-fill ">RESET</button>


                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
          </div>
<?php } ?>