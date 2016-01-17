<script>
jQuery(function($) {
	  $('#social_frm').validate();
});
</script>
<aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Social Form<small>Preview</small>                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url();?>administrator/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo base_url();?>administrator/social-icon"> Social List</a></li>
                        <li class="active"> Social</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
						
						
                        <div class="col-md-12">
						
						
								<?php if($this->session->flashdata('error')){?>
								
						
								<div class="box-body">
                                    <div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                        <b>Alert!</b><?php echo $this->session->flashdata('error') ;?>
                                    </div>
									 </div>
                                   <?php }  if($this->session->flashdata('sucess')) {?>
                                   		<div class="box-body"> <div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                        <b>Alert!</b><?php echo  $this->session->flashdata('sucess');?>
                                    </div> </div>
									<?php }?>
                               
								
								
                            <!-- general form elements -->
                            <div class="box box-primary">
								
                                <!-- form start -->
                                <form role="form" method="post" name="social_frm" id="social_frm" action="<?php echo base_url();?>administrator/social-action" enctype="multipart/form-data"> 
								<input type="hidden"  name="social_id" id="social_id" value="<?php echo $social_id;?>" />
								<input type="hidden"  name="old_slider_image" id="old_slider_image" value="<?php if(($social_id>0) &&(!empty($list[0]->social_icon))) {echo $list[0]->social_icon;}?>" />
                                    <div class="box-body">
									    <div class="form-group">
                                            <label>Social Title</label>
                                            <input type="text" class="form-control" id="social_title" name="social_title" value="<?php if(!empty($list[0]->social_title)){	echo   $list[0]->social_title;	}?>" required="required">
                                        </div>
										<div class="form-group">
                                            <label>Link</label>
                                            <input type="text" class="form-control" id="social_link" name="social_link" value="<?php if(!empty($list[0]->social_link)){	echo   $list[0]->social_link;	}?>" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label>Social Image</label>
                                            <input type="file" class="form-control" id="social_icon" name="social_icon" value="" <?php if($social_id==0){?> required="required" <?php }?> >
										 <?php if(($social_id>0) &&(!empty($list[0]->social_icon)))
										 {
										 	echo   '<img src="'.base_url().'timthumb.php?src='.base_url().'upload/slider/'.$list[0]->social_icon.'&w=70" style="margin:3px 3px 3px 3px">';
										}
										
											?>
                                        </div>
										
										
                                        <div class="form-group">
                                            <label >Status</label>
											
											<select class="form-control" name="social_status">
                                                <option value="1" <?php if(($social_id>0) && ( $list[0]->social_status=='1')){echo 'selected="selected"';}?>>Active</option>
                                                <option value="0" <?php if(($social_id>0) && ( $list[0]->social_status=='0')){echo 'selected="selected"';}?>>Inactive</option>
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