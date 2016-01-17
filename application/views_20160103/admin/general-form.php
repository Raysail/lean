<script>
jQuery(function($) {
	  $('#general_setting').validate();
});
</script>

<script type="text/javascript" src="<?php echo base_url()?>design/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
		selector: "#guide_author",
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

		/*file_browser_callback: RoxyFileBrowser,
		templates: [
			{title: 'Test template 1', content: 'Test 1'},
			{title: 'Test template 2', content: 'Test 2'}
		]*/
	});
	
	/*function RoxyFileBrowser(field_name, url, type, win) {
  var roxyFileman = '<?php echo base_url().'design/fileman/index.html' ?>';
  if (roxyFileman.indexOf("?") < 0) {     
    roxyFileman += "?type=" + type;   
  }
  else {
    roxyFileman += "&type=" + type;
  }
  roxyFileman += '&input=' + field_name + '&value=' + document.getElementById(field_name).value;
  if(tinyMCE.activeEditor.settings.language){
    roxyFileman += '&langCode=' + tinyMCE.activeEditor.settings.language;
  }
  tinyMCE.activeEditor.windowManager.open({
     file: roxyFileman,
     title: 'File Upload',
     width: 750, 
     height: 450,
     resizable: "yes",
     plugins: "media",
     inline: "yes",
     close_previous: "no"  
  }, {     window: win,     input: field_name    });
  return false; 
}*/
</script>
<aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>General Setting <small>Preview</small>                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url();?>administrator/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#"> General Setting</a></li>
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
                                <form role="form" method="post" name="general_setting" id="general_setting" action="<?php echo base_url();?>admin/setting/general_update" enctype="multipart/form-data"> 
								<input type="hidden" name="old_banner_image" id="old_banner_image" value="<?php echo $general_detal[0]->banner_image;?>"  />
								<input type="hidden" name="old_author_image" id="old_author_image" value="<?php echo $general_detal[0]->author_image;?>"  />
								<input type="hidden" name="old_reviewer_image" id="old_reviewer_image" value="<?php echo $general_detal[0]->review_image;?>"  />
								<input type="hidden" name="old_editor_image" id="old_editor_image" value="<?php echo $general_detal[0]->editor_image;?>"  />
								<input type="hidden" name="old_publisher_image" id="old_publisher_image" value="<?php echo $general_detal[0]->publish_image;?>"  />
								<input type="hidden" name="id" id="id" value="<?php if(!empty($list[0]->id)){echo $general_detal[0]->id;	}?>" />
								
                                    <div class="box-body">
									
									    <div class="form-group">
                                            <label>Email :</label>
                                            <input type="email" class="form-control" id="email" name="email" value="<?php	echo   $general_detal[0]->email ;?>" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label>Contact No :</label>
											 <input type="text" number="number" class="form-control" id="Phone_no" name="Phone_no" value="<?php	echo   $general_detal[0]->Phone_no ;?>" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label>Address :</label>
											<textarea name="address" id="address" class="form-control"><?php echo $general_detal[0]->address ;?></textarea>
                                        </div>
										
										
                                        <div class="form-group">
                                            <label>Footer Copy Right:</label>
											<textarea name="footer_copy" id="footer_copy" class="form-control" required="required"><?php echo $general_detal[0]->footer_copy ;?></textarea>
                                        </div>
										
										
                                        <div class="form-group">
                                            <label>Meta Title :</label>
											 <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?php	echo   $general_detal[0]->meta_title ;?>" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label>Meta Keyword :</label>
											<textarea name="meta_keyword" id="meta_keyword" class="form-control" required="required"><?php echo $general_detal[0]->meta_keyword ;?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Meta Description :</label>
											<textarea name="meta_desc" id="meta_desc" class="form-control" required="required"><?php echo $general_detal[0]->meta_desc ;?></textarea>
                                        </div>
                                       
                                        <div class="form-group">
                                            <label>Gide For Auhtors :</label>
											<textarea name="guide_author" id="guide_author" class="form-control" required="required"><?php echo $general_detal[0]->guide_author ;?></textarea>
                                        </div>
										
                                        <div class="form-group">
                                            <label>Upload banner image :</label>
											<input type="file" name="banner_image" id="banner_image" value="" />
											<?php if(!empty($general_detal[0]->banner_image) )	{?>
											<img src="<?php echo base_url().'upload/slider/'.$general_detal[0]->banner_image;?>" />
											
											<?php }	?>
											
                                        </div>
										
                                        <div class="form-group">
                                            <label>Author image :</label>
											<input type="file" name="author_image" id="author_image" value="" />
											<?php if(!empty($general_detal[0]->author_image) )	{?>
											<img src="<?php echo base_url().'upload/slider/'.$general_detal[0]->author_image;?>"/>											
											<?php }	?>
											
                                        </div>
										
                                        <div class="form-group">
                                            <label>Reviewer image :</label>
											<input type="file" name="review_image" id="review_image" value="" />
											<?php if(!empty($general_detal[0]->review_image) )	{?>
											<img src="<?php echo base_url().'upload/slider/'.$general_detal[0]->review_image;?>"/>											
											<?php }	?>
											
                                        </div>
										
                                        <div class="form-group">
                                            <label>Editor image :</label>
											<input type="file" name="editor_image" id="editor_image" value="" />
											<?php if(!empty($general_detal[0]->editor_image) )	{?>
											<img src="<?php echo base_url().'upload/slider/'.$general_detal[0]->editor_image;?>"/>											
											<?php }	?>
											
                                        </div>
										
                                        <div class="form-group">
                                            <label>Publisher image :</label>
											<input type="file" name="publish_image" id="publish_image" value="" />
											<?php if(!empty($general_detal[0]->publish_image) )	{?>
											<img src="<?php echo base_url().'upload/slider/'.$general_detal[0]->publish_image;?>"/>											
											<?php }	?>
											
                                        </div>
                                       
                                        
                                        
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary" name="cat_button" value="Update">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->

                  
                        </div><!--/.col (left) -->
                        <!-- right column -->
                        <!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside>