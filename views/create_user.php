                         <?php if(isset($_SESSION['user_email'])){ ?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Create User Profile</h4>
                            </div>
                            <hr />
                            <div class="content">
                                <form name="create_user_form" method="post" action="?module=user&action=save_user">
                                              
                                                        <?php if(isset($_SESSION['ERROR_USER_ADD'])){?>
							<div class="alert alert-danger">
							  <strong>Sorry!</strong> <?php echo $_SESSION['ERROR_USER_ADD'];$_SESSION['ERROR_USER_ADD']=NULL;?>
                              							</div>

                              <?php } ?>
                                    <div class="row">
                                    <div class="col-md-2">
                                            <div class="form-group">
                                            <?php $salutation='';
								if(isset($_SESSION['FORM_FIELDS']['salutation'])){
									 $salutation=$_SESSION['FORM_FIELDS']['salutation'];
								}
								?>
                                                <label>Salutation</label>
                                                <select class="form-control" id="salutation" name="salutation" required="required">

                                                    <option selected="selected" value="">Select</option>
                                                    <option value="Mr" <?php if($salutation=="Mr"){ echo "selected='selected'";}?>>Mr</option>
                                                    <option value="Miss" <?php if($salutation=="Miss"){ echo "selected='selected'";}?>>Miss</option>
                                                    <option value="Mrs" <?php if($salutation=="Mrs"){ echo "selected='selected'";}?>>Mrs</option>
                                                    <option value="Dr" <?php if($salutation=="Dr"){ echo "selected='selected'";}?>>Dr</option>
                                                    <!--<option value="3">User 3</option>-->

                                                 </select> 
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                            <?php $fname='';
								if(isset($_SESSION['FORM_FIELDS']['fname'])){
									 $fname=$_SESSION['FORM_FIELDS']['fname'];
								}
								?>
                                                <label for="exampleInputEmail1">First Name</label>
                                                <input type="text" class="form-control" placeholder="First Name" name="fname" required="required" value="<?php echo $fname; ?>" pattern="^[a-zA-Z]{2,30}$" title="First Name cannot be less than 2 characters and only letters allowed" maxlength="30">
                                            </div>
                                        </div>
                                         <div class="col-md-3">
                                            <div class="form-group">
                                             <?php $lname='';
								if(isset($_SESSION['FORM_FIELDS']['lname'])){
									 $lname=$_SESSION['FORM_FIELDS']['lname'];
								}
								?>
                                                <label for="exampleInputEmail1">Last Name</label>
                                                <input type="text" class="form-control" placeholder="Last Name" name="lname" required="required" value="<?php echo $lname; ?>" pattern="^[a-zA-Z]{2,30}$" title="Last Name cannot be less than 2 characters and only letters allowed" maxlength="30">
                                            </div>
                                         </div>
                                    </div>                                         
                                   
                                   <!--<div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="text" class="form-control" placeholder="Password" name="password"  id="password" readonly="readonly" required="required">
                                            </div>
                                        </div>
                                    

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Generate Password</label><br />
                                                <button type="button" onClick="myFunction()">Click Me!!</button>
                                            </div>
                                        </div>
                                    

                                   </div>-->


                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                             <?php $email='';
								if(isset($_SESSION['FORM_FIELDS']['email'])){
									 $email=$_SESSION['FORM_FIELDS']['email'];
								}
								?>
                                             <label>Email</label>
                                                <input type="email" class="form-control" placeholder="Email" name="email" required="required" value="<?php echo $email; ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Enter A Valid Email Address Containing '@' and '.' and after '.' cam have maximum 2 to 3 characters"> 
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                             <?php $contact_no='';
								if(isset($_SESSION['FORM_FIELDS']['contact_no'])){
									 $contact_no=$_SESSION['FORM_FIELDS']['contact_no'];
								}
								?>
                                                <label>Conatct No</label>
                                                <input type="text" class="form-control" placeholder="Contact No" name="contact_no" required="required" value="<?php echo $contact_no; ?>" pattern="[0-9]{10}" title="Contact Number should Contain Only Numbers and should be 10 characters long" maxlength="10" min="10" >
                                            </div>
                                        </div>
                                    </div>



                                  <!--  <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control" placeholder="Home Address" name="address">
                                            </div>
                                        </div>
                                    </div> -->

                                    <div class="row">
                                     <div class="col-md-3">
                                            <div class="form-group">
                                                <label>State</label>
                                                <select class="form-control" id="state" name="state" onchange="show_districts()"  required="required">
				<option value=''>Select State</option>
                                                
                                                <?php foreach($array_states as $state_name){?>
				<option <?php if($state_name['state']!='' && $state!=''){if(strtoupper($state_name['state'])==strtoupper($state)){?>value='<?php echo $state_name['state'];?>'
				 selected  <?php } }?>
				><?php echo $state_name['state'];?>
				</option>	
                 <?php }?>
					</select>
                                                
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>District</label>
                                                 <select class="form-control" id="city" name="city"  required="required">
				
                </select>
                                            </div>
                                        </div>
                                       
                                        <div class="col-md-3">
                                            <div class="form-group">
                                             <?php $zipcode='';
								if(isset($_SESSION['FORM_FIELDS']['pin'])){
									 $zipcode=$_SESSION['FORM_FIELDS']['pin'];
								}
								?>
                                                <label>Postal Code</label>
                                                <input type="text" class="form-control" placeholder="ZIP Code" name="zipcode" required="required" value="<?php echo $zipcode; ?>" pattern="[0-9]{6}" title="Postal Code should Contain Only Numbers and should be 6 characters long"  maxlength="6">
                                            </div>
                                        </div>
                                    </div>
                                     <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <?php $org_name='';
								if(isset($_SESSION['FORM_FIELDS']['org_name'])){
									 $org_name=$_SESSION['FORM_FIELDS']['org_name'];
								}
								?>
                                             <label>Name Of the Organisation</label>
                                                <input type="text" class="form-control" placeholder="Organisation Name" name="org_name" value="<?php echo $org_name; ?>" id="org_name" pattern="^[a-zA-Z]{2,100}$" title="Organisation Name cannot be less than 2 characters and only letters allowed" required="required" maxlength="100">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Designation</label>
                                                <?php $desig='';
								if(isset($_SESSION['FORM_FIELDS']['desig'])){
									 $desig=$_SESSION['FORM_FIELDS']['desig'];
								}
								?>
                                                <input type="text" class="form-control" placeholder="Designation" name="desig" id="desig" value="<?php echo $desig; ?>" pattern="^[a-zA-Z]{2,100}$" title="Designation cannot be less than 2 characters and only letters allowed" required="required" maxlength="50">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                             <?php $user_type='';
								if(isset($_SESSION['FORM_FIELDS']['user_type'])){
									 $user_type=$_SESSION['FORM_FIELDS']['user_type'];
								}
								?>
                                                <label>User Type</label>
                                                <select  class="form-control" id="user_type" name="user_type" required="required">

                                                    <option selected="selected" value="">Select</option>
                                                    <option value="ADMIN" <?php if($user_type=="ADMIN"){ echo "selected='selected'";}?>>ADMIN</option>
                                                    <option value="USER" <?php if($user_type=="USER"){ echo "selected='selected'";}?>>USER</option>

                                                 </select>   
                                            </div>
                                        </div>
									</div>

                                    

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Save Profile</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>



<script>
function myFunction() {


    var min = 100000;
    var max = 999999;
    var num = Math.floor(Math.random() * (max - min + 1)) + min;

    document.getElementById("password").value = num;
}
</script>


<script>
function show_districts(){
		var state_name = $("#state").val();	
		
		var formData = {job:"show_dist",state:state_name}; //Array  

			$.ajax({url: "ajax/get_districts.php",
			beforeSend: function(){	
				//$("#container").html('');
				//block_screen();		
				//loading_show()		
			},		 
			type: "POST",		
			complete: function(){			  
				//loading_hide();
			},  
			data : formData, success: function(result){	

				
								$("#city option").each(function() {
									$(this).remove();
								});

				
								  var JSONObject = JSON.parse(result);
								  var peopleHTML = "";	
								   peopleHTML += "<option value=''>";
								  peopleHTML +="Select"; 
								  peopleHTML += "</option>";
								  for (var i = 0, len = JSONObject.length; i < len; ++i) {
										var dt = JSONObject[i];
										peopleHTML += "<option value='"+dt.district+"'>";
										peopleHTML +=dt.district; 
										peopleHTML += "</option>";					
								  }		 
								  $('#city').append(peopleHTML);
				
				
			}});	


}

</script>
<?php } else { echo "<script type='text/javascript'>window.location='?';</script>";
					exit();}?>