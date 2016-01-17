<script>
jQuery(function($) {
	  $('#content_frm').validate();
});
</script>

  

<script type="text/javascript" src="<?php echo base_url()?>design/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
		selector: "#fund_info",
		theme: "modern",
		height : 300,
		//file_browser_callback : 'myFileBrowser',
		plugins: [
			"advlist autolink lists link image charmap print preview hr anchor pagebreak",
			"searchreplace wordcount visualblocks visualchars code fullscreen",
			"insertdatetime media nonbreaking save table contextmenu directionality",
			"emoticons template paste textcolor moxiemanager",
			"insertdatetime media table contextmenu paste jbimages"
		],
		toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
		toolbar2: "print preview  | forecolor backcolor emoticons",
		image_advtab: true,
		relative_urls: false,
	});

</script>


<aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Funding Form<small>Preview</small>                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url();?>administrator/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo base_url();?>administrator/fund-list"> Funding List</a></li>
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
                                <form role="form" method="post" name="content_frm" id="content_frm" action="<?php echo base_url();?>admin/funding/funding_action" enctype="multipart/form-data" > 
								<input type="hidden"  name="fund_id" id="fund_id" value="<?php echo $fund_id;?>" />
								
								<input type="hidden"  name="fund_old_image" id="fund_old_title" value="<?php if($fund_id>0){ echo $list[0]->fund_image;	}?>" />
            
								        <div class="box-body">
										<table cellpadding="5" cellspacing="5" width="100%">
											<tr>
												<td width="20%"> Funding Title</td>
												<td width="30%"><input class="form-control" type="text" id="fund_title" name="fund_title" value="<?php if($fund_id>0){echo $list[0]->fund_title;}?>" required="required"></td>
												<td  width="20%">Posted</td>
												<td  width="30%">
												<input class="form-control" type="text" id="posted_date" name="fund_posted" value="<?php if($fund_id>0){echo $list[0]->fund_posted;}?>" required="required"></td>
											</tr>
											<tr>
												<td>Company Name</td>
												<td><input class="form-control" type="text" id="fund_company" name="fund_company" value="<?php if($fund_id>0){echo $list[0]->fund_company; }?>" required="required"></td>
												<td>Deadlint</td>
												<td>
												<input class="form-control" type="text"  id="deadline_date" name="fund_decline" value="<?php if($fund_id>0){echo $list[0]->fund_decline;	}?>" required="required"></td>
											</tr>
											<tr>
												<td>Reward</td>
												<td><input type="text" class="form-control" id="fund_reward" name="fund_reward" value="<?php if($fund_id>0){echo $list[0]->fund_reward;	}?>" required="required"></td>
												<td>Cover Picture</td>
												<td><input class="form-control" type="file"  id="fund_coverpic" name="fund_coverpic" value="" required="required"></td>
											</tr>
											<tr>
												<td>ID</td>
												<td><input class="form-control" type="text"  id="fund_customID" name="fund_customID" value="<?php if($fund_id>0){echo $list[0]->fund_customID;	}?>" required="required"></td>
												<td>Country</td>
												<td><input class="form-control" type="text"  id="fund_country" name="fund_country" value="<?php if($fund_id>0){echo $list[0]->fund_country;}?>" required="required"></td>
											</tr>
											<tr>
												<td valign="top">Funding Infromation</td>
												<td colspan="3"><textarea class="form-control" name="fund_info" id="fund_info"><?php if($fund_id>0) {echo $list[0]->fund_info;}?></textarea></td>
											</tr>
										</table>
										
                                        
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
