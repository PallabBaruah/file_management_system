                 <?php if(isset($_SESSION['user_email'])){ ?>

                        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">User Details </h4>
                                <!--<p class="category">24 Hours performance</p>-->
                            </div>
                            <hr />
                            
                             <div class="content">
                                    <?php foreach($result as $data){ ?>
                                            <div id="chartHours" class="ct-chart"> 
                                            <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Name :</label>
                                                <?php echo $data->getFirstName()." ".$data->getLastName(); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Email :</label>
                                                <?php echo $data->getEmail(); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Contact Number :</label>
                                                <?php echo $data->getContactNo(); ?>
                                            </div>
                                        </div>
                                       </div>
                                    <div class="row">
                                    <div class="col-md-3">
                                            <div class="form-group">
                                                <label>City :</label>
                                                <?php echo $data->getCity(); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>State :</label>
                                                <?php echo $data->getState(); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Pincode :</label>
                                                <?php echo $data->getPin(); ?>
                                            </div>
                                        </div>
                                    </div>
                                <div class="row">                                    
                                    <div class="col-md-3">
                                            <div class="form-group">
                                                <label>User Type :</label>
                                                <?php echo $data->getUserType(); }?>
                                            </div>
                                        </div>
                                </div>
                                <div class="row">               
                                    <div class="col-md-3">
                                            <div class="form-group">
                                                                                       <a href="?module=dashboard&action=change_password" class="btn btn-info btn-fill">Change Password</a>
											</div>
                                    </div>
                                </div>    
                           </div>       
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php } else { echo "<script type='text/javascript'>window.location='?';</script>";
					exit();}?>