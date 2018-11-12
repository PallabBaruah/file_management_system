                         <?php if(isset($_SESSION['user_email'])){ ?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                            <?php
							$session_task_id=$_SESSION['TASK_ID'];
							$session_task_status=$_SESSION['TASK_STATUS'];
							 ?>
                                <h4 class="title">Add a Remark <a href="?module=remark&action=view_remark&id=<?php echo base64_encode($session_task_id); ?>&status=<?php echo $session_task_status;?>" class="btn btn-info btn-fill pull-right"><< Back to Task Details</a></h4>
                            </div>
                            <div class="content">
                                <form name="create_project_form" method="post" action="?module=remark&action=create_remark" enctype="multipart/form-data">
                                <?php if(isset($_SESSION['REMARK_ADD_SUCCESS'])){?>
							<div class="alert alert-success">
							  <strong>Success!</strong> <?php echo $_SESSION['REMARK_ADD_SUCCESS'];$_SESSION['REMARK_ADD_SUCCESS']=NULL;?>
                              							</div>
                                        <?php } ?>                 
                                                        <?php if(isset($_SESSION['ERROR_REMARK_ADD'])){?>
							<div class="alert alert-danger">
							  <strong>Sorry!</strong> <?php echo $_SESSION['ERROR_REMARK_ADD'];$_SESSION['ERROR_REMARK_ADD']=NULL;?>
                              							</div>

                              <?php } ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Write a remark</label>
                                                <textarea rows="5" class="form-control" placeholder="Describe your project here" id="text_remark" name="text_remark"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                
                                                <input type="hidden" class="form-control" id="task_id" name="task_id" value="<?php echo $task_id; ?>"/>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Add a file</label>
                                                <input name="file" id="file" type="file" class="form-control" required="required"/>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Add Remark</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    

                </div>
            </div>
        </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/js/bootstrap-datepicker.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.0/css/bootstrap-datepicker.css" rel="stylesheet" />
<script>
$(document).ready(function(){
  
    $("#startdate").datepicker({
        todayBtn:  1,
        autoclose: true,
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $('#enddate').datepicker('setStartDate', minDate);
    });
    
    $("#enddate").datepicker()
        .on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#startdate').datepicker('setEndDate', minDate);
        });

});
</script>
  <?php } else { echo "<script type='text/javascript'>window.location='?';</script>";
					exit();}?>

