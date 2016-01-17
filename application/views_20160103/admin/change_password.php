<script>
jQuery(function($) {
	  $('#update_password').validate();
});
</script>
<aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Change Password
                        <small>Preview</small>                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url();?>administrator/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active"> Change Password</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
						
						
                        <div class="col-md-12">
						
						
						<div class="box-body">
						
								<?php if($this->session->flashdata('error')){?>
                                    <div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                        <b>Alert!</b><?php echo $this->session->flashdata('error') ;?>
                                    </div>
                                   <?php }  if($this->session->flashdata('sucess')) {?>
                                    <div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                        <b>Alert!</b><?php echo  $this->session->flashdata('sucess');?>
                                    </div>
									<?php }?>
                                </div>
								
								
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Change Password</h3>
                                </div><!-- /.box-header -->
								
								
								
                                <!-- form start -->
                                <form role="form" method="post" name="update_password" id="update_password" action="<?php echo base_url();?>administrator/change-password-action">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label>Old Password</label>
                                            <input type="password" class="form-control" id="old_password" name="old_password" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label >New  Password</label>
                                            <input type="password" class="form-control" id="new_password" name="new_password" required="required" >
                                        </div>
                                        <div class="form-group">
                                            <label>Confrim  Password</label>
                                            <input type="password" class="form-control" id="confirm_password" name="confirm_password"  required="required" equalTo="#new_password">
											
                                        </div>
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->

                  
                        </div><!--/.col (left) -->
                        <!-- right column -->
                        <!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside>