 <?php if(!isset($_SESSION['user_email'])){ ?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Please Enter Your registered email ID <a href="?module=user&action=sign_in" class="btn btn-info btn-fill pull-right"><< Partner Login</a></h4>
                            </div>
                            <div class="content">
                              
                                <form enctype="multipart/form-data" name="form_login" method="post" action="?module=password&action=forgot_pass_action">
                                   <?php if(isset($_SESSION['EMAIL_EXIST_ERROR'])){?>
							<div class="alert alert-danger">
							  <strong>Warning!</strong> <?php echo $_SESSION['EMAIL_EXIST_ERROR'];$_SESSION[			'EMAIL_EXIST_ERROR']=NULL;?>
                              							</div>

                              <?php } ?>
                              
                               <?php if(isset($_SESSION['ERROR_PASSWORD_TOKEN'])){?>
							<div class="alert alert-warning">
							  <strong>Warning!</strong> <?php echo $_SESSION['ERROR_PASSWORD_TOKEN'];$_SESSION[			'ERROR_PASSWORD_TOKEN']=NULL;?>
                              							</div>

                              <?php } ?>
                              
                              <?php if(isset($_SESSION['EMAIL_EXIST_SUCCESS'])){?>
							<div class="alert alert-success">
							  <?php echo $_SESSION['EMAIL_EXIST_SUCCESS'];
							  $_SESSION['EMAIL_EXIST_SUCCESS']=NULL;?>
                              							</div>

                              <?php } ?>
                                        
                                        <div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" placeholder="Email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Enter A Valid Email Address Containing '@' and '.' and after '.' can have maximum 2 to 3 characters" required>
                                             </div>
                                        </div>
                                     
                                        

                                   <button type="submit" class="btn btn-info btn-fill ">SUBMIT</button>


                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
          </div>
<?php } ?>