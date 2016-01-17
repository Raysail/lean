<script>
jQuery(function($) {
	  $('#user_frm').validate();
});

$(document).on('blur', '#user_email', function(){ 

	var email='';
	
	var email=$('#user_email').val();
	  
	  data = 'email='+email;
		url =  "<?php echo base_url()?>admin/user/check_unique_email";
		$.ajax({
				   type: "POST",
				   url: url,
				   data: data,
				   dataType: 'html',
				   success: function(msg)
				   {
				   		//alert(msg);
				   		if(msg==1)
						{			
							
					   	   $('#show_error_email').show();
						   $("#user_email").val(null); 
						}
						else
						{		
							$('#show_error_email').hide();		
						}
				   }

 		});

});


</script>
<aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><?php echo $user_type_name; ?> User Form<small>Preview</small>                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url();?>administrator/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo base_url();?>administrator/<?php echo $add_link;?>-list"> User List</a></li>
                        <li class="active"><?php echo $user_type_name; ?> User </li>
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
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="post" name="user_frm" id="user_frm" action="<?php echo base_url();?>administrator/user-action">
								<input type="hidden"  name="user_id" id="user_id" value="<?php echo $user_id;?>" />
								<input type="hidden"  name="user_type" id="user_type" value="<?php echo $user_type;?>" />
                                    <div class="box-body">			
									
										 <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" id="user_email" name="user_email" value="<?php if($user_id>0){echo $user_data[0]->user_email;}?>" required="required" <?php if($user_id>0) { echo ' readonly="readonly"';} ?>>
											<span style="color:#FF0000; display:none;" id="show_error_email">Duplicate Email id</span>
									
                                        </div>
										 <?php if($user_id==0){?>
										 <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control" id="user_password" name="user_password" value="" required="required">
                                        </div>
										
										 <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input type="password" class="form-control" id="user_cpassword" name="user_cpassword" value="<?php if($user_id>0){echo $user_data[0]->user_email;}?>" required="required" equalto="#user_password">
											
                                        </div>	
										
										<?php }?>						
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" class="form-control" id="user_fname" name="user_fname" value="<?php if($user_id>0){echo $user_data[0]->user_fname;}?>" required="required">
                                        </div>
										
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control" id="user_lname" name="user_lname" value="<?php if($user_id>0){echo $user_data[0]->user_lname;}?>" required="required">
                                        </div>
										
                                       
										
                                        <div class="form-group">
                                            <label>Instiution</label>
                                            <input type="text" class="form-control" id="user_instiute" name="user_instiute" value="<?php if($user_id>0){echo $user_data[0]->user_instiute;}?>" required="required">
										
                                        </div>
										
                                        <div class="form-group">
                                            <label>Address</label>
											<textarea name="user_address" id="user_address" required="required" class="form-control"><?php if($user_id>0){echo $user_data[0]->user_address;}?></textarea>
                                        </div>
										
										<div class="form-group">
                                            <label>Country</label>
											
										<select name="user_country" id="user_country" required="required" class="form-control" >
						<option value=""> Select Counrty</option>
						<?php 
						
						foreach($countries as $country)
						{
							
								$selected = '';
							if(($user_id>0) && ($user_data[0]->user_country==$country->code)){$selected = 'selected="selected"';}
							
						?>
							<option value="<?php echo $country->code; ?>" <?php echo $selected;?> > <?php echo $country->name; ?></option>
						<?php		
						}
						?>
					</select>
					
                                        </div>
										
										
										<div class="form-group">
                                            <label>Personal Classification (Press Ctrl+Click for multiple select)</label>
											
										<select name="user_classification[]" id="user_classification" required="required" class="form-control"  multiple="multiple" >
						<?php 
						
						foreach($classified as $classi)
						{
							
								$selected = '';
								$explode_classi = explode(',',$user_data[0]->user_classification);
							if(($user_id>0) && (in_array($classi->asubmi_id,$explode_classi))){$selected = 'selected="selected"';}
							
						?>
							<option value="<?php echo $classi->asubmi_id; ?>" <?php echo $selected;?> > <?php echo $classi->asubmi_title; ?></option>
						<?php		
						}
						?>
					</select>
					
                                        </div>
										
										
										
										
                                        <div class="form-group">
                                            <label >Status</label>
											
											<select class="form-control" name="user_status">
                                                <option value="1" <?php if(($user_id>0) && ( $user_data[0]->user_status=='1')){echo 'selected="selected"';}?>>Active</option>
                                                <option value="0" <?php if(($user_id>0) && ( $user_data[0]->user_status=='0')){echo 'selected="selected"';}?>>Inactive</option>
                                            </select>
											
                                          
                                        </div>
                                        
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary" name="cat_button" value="<?php echo $but_value?>">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->

                  
                        </div><!--/.col (left) -->
                        <!-- right column -->
                        <!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside>