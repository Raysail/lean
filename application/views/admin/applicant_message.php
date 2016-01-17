<script type="text/javascript" src="<?php echo base_url()?>design/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
		selector: "#applicant_message",
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
<script>

function check_from(){
var editorContent = tinyMCE.get('applicant_message').getContent();
if (editorContent == '')
{
    // Editor empty
	alert('Please Enter the message!');
	return false;
}
else
{
    // Editor contains a value
	
	
	return true;
}
}
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
                                <form role="form" method="post" name="content_frm" id="content_frm" action="<?php echo base_url();?>admin/funding/applicant_action" enctype="multipart/form-data" onsubmit="return check_from();" > 
								<input type="hidden"  name="fund_id" id="fund_id" value="<?php echo $fund_id;?>" />
								
								<input type="hidden"  name="fund_new_status" id="fund_new_status" value="<?php echo $fund_new_status;?>" />
            
								        <div class="box-body">
										<table cellpadding="5" cellspacing="5" width="100%">
											<tr>
												<td width="20%">	
													<img src="<?php echo base_url();?>upload/fund/<?php echo $fdata[0]->fund_coverpic;?>" width="200px;" height="250px;"  />
												</td>
												<td valign="top" align="left"><?php echo $fdata[0]->fund_title;?><br /><br />
													Compnay Name: <?php echo $fdata[0]->fund_title;?><br /><br />
													OPEN: <?php echo date('m-d-Y',strtotime($fdata[0]->fund_posted));?>
												</td>
											</tr>
											<tr>
												<td  colspan="2"><?php echo $fund_title;?></td>
											</tr>
											<tr>
												<td colspan="2"><textarea class="form-control" name="applicant_message" id="applicant_message" ></textarea>
												
												
												</td>
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
