<script>
jQuery(function($) {
	  $('#atypei_frm').validate();
});
</script>
<aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1> Article Module<small>Preview</small>                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url();?>administrator/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo base_url();?>administrator/articletype-list"> Article Type List</a></li>
                        <li class="active"> Article Type Form</li>
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
                                    <h3 class="box-title">Article Type Form</h3>
                                </div><!-- /.box-header -->
								
                                <!-- form start -->
                                <form role="form" method="post" name="atypei_frm" id="atypei_frm" action="<?php echo base_url();?>administrator/articletype-action" enctype="multipart/form-data"> 
								<input type="hidden"  name="atype_id" id="atype_id" value="<?php echo $atype_id;?>" />
								
            
								        <div class="box-body">
                                        <div class="form-group">
                                            <label>Title</label>
                                   
            
			<input type="text" class="form-control" id="atype_title" name="atype_title" value="<?php if($atype_id>0){	echo $list[0]->atype_title;	}?>" required="required">
                                          
                                        </div>
                                        <div class="form-group">
                                            <label >Status</label>
											
											<select class="form-control" name="atype_status">
                                                <option value="1" <?php if(($atype_id>0) && ( $list[0]->atype_status=='1')){echo 'selected="selected"';}?>>Active</option>
                                                <option value="0" <?php if(($atype_id>0) && ( $list[0]->atype_status=='0')){echo 'selected="selected"';}?>>Inactive</option>
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