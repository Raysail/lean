<script>
jQuery(function($) {
	  $('#content_frm').validate();
});
</script>
<aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Content Form<small>Preview</small>                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url();?>administrator/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo base_url();?>administrator/pages-list"> Content pages List</a></li>
                        <li class="active"> Slider</li>
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
                                    <h3 class="box-title">&nbsp;</h3>
                                </div><!-- /.box-header -->
								
                                <!-- form start -->
                                <form role="form" method="post" name="content_frm" id="content_frm" action="<?php echo base_url();?>administrator/pages-action" enctype="multipart/form-data"> 
								<input type="hidden"  name="page_id" id="page_id" value="<?php echo $page_id;?>" />
								<input type="hidden"  name="page_display" id="page_display" value="<?php echo $page_display;?>" />
								
								<input type="hidden"  name="page_url" id="page_url" value="<?php if(($page_id>0) &&(!empty($list[0]->page_url))){	echo   $list[0]->page_url;	}?>" />
								<input type="hidden"  name="page_old_title" id="page_old_title" value="<?php if($page_id>0){ echo $list[0]->page_title;	}?>" />
            
								        <div class="box-body">
                                        <div class="form-group">
                                            <label>Title</label>
                                   
            
			<input type="text" class="form-control" id="page_title" name="page_title" value="<?php if($page_id>0){	echo $list[0]->page_title;	}?>" required="required">
                                          
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
											<textarea class="form-control" name="page_desc" id="page_desc"><?php if($page_id>0) {echo $list[0]->page_desc;}?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Meta title</label>
											<input type="text" class="form-control" name="page_mtitle"  id="page_mtitle"  value="<?php if($page_id>0) {	echo   $list[0]->page_mtitle;	}?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Meta Keyword</label>
											<textarea class="form-control" name="page_mkey"  id="page_mkey" ><?php if($page_id>0) {	echo   $list[0]->page_mkey;	}?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Meta Description</label>
											<textarea class="form-control" name="page_mdesc"  id="page_mdesc" ><?php if($page_id>0) {	echo   $list[0]->page_mdesc;	}?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label >Status</label>
											
											<select class="form-control" name="page_status">
                                                <option value="1" <?php if(($page_id>0) && ( $list[0]->page_status=='1')){echo 'selected="selected"';}?>>Active</option>
                                                <option value="0" <?php if(($page_id>0) && ( $list[0]->page_status=='0')){echo 'selected="selected"';}?>>Inactive</option>
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