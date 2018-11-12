        <?php session_start(); ?>
                 <?php if(isset($_SESSION['user_email'])){ ?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">User Details</h4>
                                <p class="category"></p>
                            </div>
                            <hr />
                            <div class="content" id="main_div">
                             <?php if(isset($_SESSION['USER_ADD_SUCCESS'])){?>
							<div class="alert alert-success">
							  <strong>Success!</strong> <?php echo $_SESSION['USER_ADD_SUCCESS'];$_SESSION['USER_ADD_SUCCESS']=NULL;?>
                              							</div>
                                        <?php } ?>   
                                        
                                        
                                        <?php if(isset($_SESSION['USER_DELETE_SUCCESS'])){?>
							<div class="alert alert-success">
							  <strong>Success!</strong> <?php echo $_SESSION['USER_DELETE_SUCCESS'];$_SESSION['USER_DELETE_SUCCESS']=NULL;?>
                              							</div>
                                        <?php } ?>  
                                        
                                         <?php if(isset($_SESSION['USER_DELETE_FAILURE'])){?>
							<div class="alert alert-danger">
							  <strong>Sorry!</strong> <?php echo $_SESSION['USER_DELETE_FAILURE'];$_SESSION['USER_DELETE_FAILURE']=NULL;?>
                              							</div>
                                        <?php } ?>   
                                        
                                                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                       
                                    	<th>Name</th>
                                    	<th>Email</th>
                                    	<th>ContactNo</th>
                                    	<th>State</th>
                                        <th>City</th>
                                        <th>User Type</th>
                                        <?php if($_SESSION['usertype']=="ADMIN"){?><th>EDIT</th> 
                                        <th>DELETE</th><?php }?>                                        
                                                                               
        
                                    </thead>
                                    <tbody>
                                            <?php foreach($result as $data){ ?>
                                        <tr>
                                        	<td><?php echo $data->getFirstName()." ".$data->getLastName(); ?></td>
                                        	<td><?php echo $data->getEmail(); ?></td>
                                        	<td><?php echo $data->getContactNo(); ?></td>
                                            <td><?php echo $data->getState(); ?></td>
                                            <td><?php echo $data->getCity(); ?></td>
                                            <td><?php echo $data->getUserType(); ?></td>
                                            <?php if($_SESSION['usertype']=="ADMIN"){?>
                                            <td>
                                            <?php
											
											 if($data->getUserType()=="USER"){ 
											 ?>
                                    		<button type="button" onclick="get_edit_data('<?php echo $data->getId(); ?>')" class="btn btn-info btn-fill pull-right">EDIT</button>
											<?php } ?>
                                            </td> 
                                            <?php } ?>
                                             <?php if($_SESSION['usertype']=="ADMIN"){?>
											<td>
											 <?php 
											
											 if($data->getUserType()=="USER"){ 
											 ?>
                                             <a href="<?php echo '?module=user&action=delete_user&id='.base64_encode($data->getId()).''?>" class="btn btn-fill btn-info">DELETE</a>
                                             <?php }?>
                                            </td>
                                            <?php } ?>
	
										</tr>	
                                        <?php } ?>
                                    </tbody>
                                </table>

                            </div>
                       
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">EDIT USER</h4>
      </div>
      <form id="update_project_form" action="" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" class="form-control" name="user_id" id="user_id" value="">

      <label>Salutation</label>
      <select class="form-control" id="salutation" name="salutation" required="required">
		<option selected="selected" value="">Select</option>
        <option value="Mr" <?php if($salutation=="Mr"){ echo "selected='selected'";}?>>Mr</option>
        <option value="Miss" <?php if($salutation=="Miss"){ echo "selected='selected'";}?>>Miss</option>
        <option value="Mrs" <?php if($salutation=="Mrs"){ echo "selected='selected'";}?>>Mrs</option>
        <option value="Dr" <?php if($salutation=="Dr"){ echo "selected='selected'";}?>>Dr</option>
                                                 </select> 
        
          <label>First Name</label>
          <input type="text" class="form-control" placeholder="Project Name" name="fname" id="fname" value="" pattern="^[a-zA-Z]{1,30}$" title="First name should not be greater than 30 characters and should have only letters." required="required">
          <label>Last Name</label>
          <input type="text" class="form-control" placeholder="Project Name" name="lname" id="lname" value="" pattern="^[a-zA-Z]{1,30}$" title="Last name should not be greater than 30 characters and should have only letters." required="required">

          <label>Email</label>
          <input type="email" class="form-control" placeholder="Email" name="email" id="email" required="required" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Enter A Valid Email Address Containing '@' and '.' and after '.' cam have maximum 2 to 3 characters"> 
          <label>Conatct No</label>
          <input type="text" class="form-control" placeholder="Contact No" name="contact_no" id="contact_no" required="required" pattern="[0-9]{10}" title="Contact Number should Contain Only Numbers and should be 10 characters long" maxlength="10" min="10" >

          <label>State</label>
          	<select class="form-control" id="state" name="state" onclick="show_districts()"  required="required">
				<option value=''>Select State</option>
                        <?php foreach($array_states as $state_name){?>
				<option value='<?php echo strtoupper($state_name['state']);?>'
				<?php if($state_name['state']!='' && $state!=''){if(strtoupper($state_name['state'])==strtoupper($state)){?> selected  <?php } }?>
				><?php echo $state_name['state'];?>
				</option>	
                 <?php }?>
			</select>

			<label>District</label>
               <select class="form-control" id="city" name="city" required="required">
				</select>


            <label>Postal Code</label>
                <input type="text" class="form-control" placeholder="ZIP Code" name="zipcode" id="zipcode" required="required" pattern="[0-9]{6}" title="Postal Code should Contain Only Numbers and should be 6 characters long"  maxlength="6">

            <label>Name Of the Organisation</label>
                <input type="text" class="form-control" placeholder="Organisation Name" name="org_name" id="org_name" pattern="^[a-zA-Z]{2,100}$" title="Organisation Name cannot be less than 2 characters and only letters allowed" required="required" maxlength="100">


			<label>Designation</label>
  				<input type="text" class="form-control" placeholder="Designation" name="desig" id="desig" pattern="^[a-zA-Z]{2,100}$" title="Designation cannot be less than 2 characters and only letters allowed" required="required" maxlength="50">
            <label>User Type</label>
                <select  class="form-control" id="user_type" name="user_type" required="required">
					<option selected="selected" value="">Select</option>
                          <option value="ADMIN" <?php if($user_type=="ADMIN"){ echo "selected='selected'";}?>>ADMIN</option>
                          <option value="USER" <?php if($user_type=="USER"){ echo "selected='selected'";}?>>USER</option>

                </select>   


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-info btn-fill" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-default btn-info btn-fill" onclick="update_user()" >Update</button>
        </div>
      </form>
    </div>
  </div>
</div>

<style>
body.modal-open div.modal-backdrop { 
    z-index: 0; 
}
</style>

<script>
function get_edit_data($aa){
	var user_id = $aa;
			var formData={user_id:user_id};
			//ajax--START
			$.ajax({url: "ajax/edit_user_data.php",
			type: "POST",		
			data : formData, success: function(result){
					    var JSONObject = JSON.parse(result);
					  for (var i = 0, len = JSONObject.length; i < len; ++i) {
										var dt = JSONObject[i];
										$("#user_id").val(dt.id);										
										$("#fname").val(dt.fname);
										$("#lname").val(dt.lname);
										$("#email").val(dt.email);
										$("#zipcode").val(dt.pin);
										$("#org_name").val(dt.org_name);
										$("#desig").val(dt.desig);
										$("#contact_no").val(dt.contact_no);
										$("#salutation").val(dt.salutation).prop('selected', true);
										$("#state").val(dt.state).prop('selected', true);
										show_districts();
										$("#city").text(dt.city).prop('selected', true);	
										$("#user_type").val(dt.user_type).prop('selected', true);																															
								  }	
					   jQuery("#myModal").modal('show');
			},
  						error: function(){
    					alert('error');
  						}});	
}
</script>

<script>
function show_districts(){
		var state_name = $("#state").val();	
		
		var formData = {job:"show_dist",state:state_name}; //Array  

			$.ajax({url: "ajax/get_districts.php",
			type: "POST",		
			data : formData, success: function(result){	

				
								$("#city option").each(function() {
									$(this).remove();
								});

				
								  var JSONObject = JSON.parse(result);
								  var peopleHTML = "";	
								   peopleHTML += "<option value=''>";
								  peopleHTML +="Select District"; 
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
<script>
function update_user(){
	var user_id_val = $("#user_id").val();
	var fname = $("#fname").val();		
	var lname = $("#lname").val();
	var contact_no = $("#contact_no").val();		
	var state = $("#state").val();		

	var city = $("#city").val();		
	var zipcode = $("#zipcode").val();		
	var org_name = $("#org_name").val();
	var desig = $("#desig").val();
	var user_type = $("#user_type").val();
	var salutation = $("#salutation").val()
	
	
			var formData={user_id_val:user_id_val,fname:fname,lname:lname,contact_no:contact_no,
			state:state,city:city,zipcode:zipcode,org_name:org_name,desig:desig,user_type:user_type,salutation:salutation};
			//ajax--START
			$.ajax({url: "ajax/update_user.php",
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
				if(result==1){
					   //alert("Verifcation completed")
					 $("#main_div").load(" #main_div");
					jQuery("#myModal").modal('hide');
				}
				else{
					alert(result);
				}
			}});	
		//ajax--END	

}

</script>

<?php } else { echo "<script type='text/javascript'>window.location='?';</script>";
					exit();}?>