<script>
jQuery(function($) {
	  $('#content_frm').validate();
});
</script>

<script type="text/javascript" src="<?php echo base_url()?>design/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
		selector: "#bord_desc",
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
                    <h1>Content Form<small>Preview</small>                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url();?>administrator/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo base_url();?>administrator/board-list"> Board Member List</a></li>
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
                                <form role="form" method="post" name="content_frm" id="content_frm" action="<?php echo base_url();?>administrator/board-action" enctype="multipart/form-data" > 
								<input type="hidden"  name="bord_id" id="bord_id" value="<?php echo $bord_id;?>" />
								
								<input type="hidden"  name="bord_old_image" id="bord_old_title" value="<?php if($bord_id>0){ echo $list[0]->bord_image;	}?>" />
            
								        <div class="box-body">
                                        <div class="form-group">
                                            <label>Name</label>                                  
            
			<input type="text" class="form-control" id="bord_name" name="bord_name" value="<?php if($bord_id>0){	echo $list[0]->bord_name;	}?>" required="required">
                                          
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                   
            
			<input type="email" class="form-control" id="bord_email" name="bord_email" value="<?php if($bord_id>0){	echo $list[0]->bord_email;	}?>" required="required">
                                          
                                        </div>
                                        <div class="form-group">
                                            <label>Affiliates</label>
                                   <textarea class="form-control" name="bord_affi" id="bord_affi"><?php if($bord_id>0) {echo $list[0]->bord_affi;}?></textarea>                                          
                                        </div>
                                        <div class="form-group">
                                            <label>Image</label>
                                   
			<input type="file" class="form-control" id="bord_image" name="bord_image">                                          
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
											<textarea class="form-control" name="bord_desc" id="bord_desc"><?php if($bord_id>0) {echo $list[0]->bord_detail;}?></textarea>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label >Status</label>
											
											<select class="form-control" name="bord_status">
                                                <option value="1" <?php if(($bord_id>0) && ( $list[0]->bord_status=='1')){echo 'selected="selected"';}?>>Active</option>
                                                <option value="0" <?php if(($bord_id>0) && ( $list[0]->bord_status=='0')){echo 'selected="selected"';}?>>Inactive</option>
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