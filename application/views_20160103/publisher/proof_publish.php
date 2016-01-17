<style>
.tab_one_sec a.good-btn {
	width: auto;
	background: #EE4723;
	font-weight: 100;
	color: white;
	border: 0 none;
	border-radius: 1px;
	cursor: pointer;
	padding: 10px 10px;
	margin: 10px 5px;
	font-family: 'Oswald', sans-serif;
	letter-spacing: 2px;
	min-width: 100px;
}
.resp-vtabs .resp-tabs-list li a {
	font-family: 'Segoe UI';
	color: #131313;
	display: block;
}
.resp-vtabs .resp-tabs-list li.active a {
	color: #fff;
}
.resp-vtabs .resp-tabs-list li:hover a {
	text-decoration: none;
}
.resp-vtabs .resp-tabs-list li.active {
	background-color: #EE4723 !important;
	text-decoration: none;
}
.resp-vtabs .resp-tabs-list li a {
	font-family: 'Segoe UI';
	color: #131313;
	display: block;
	padding: 15px 15px;
}
.resp-vtabs .resp-tabs-list li {
	padding: 0px !important;
}

#ajax_loddder {

position: fixed;
top: 0;
left: 0;
width: 100%;
height: 100%;
background:rgba(27, 26, 26, 0.48);
z-index: 1001;
}
#ajax_loddder img {
top: 50%;
left: 46.5%;
position: absolute;
}
</style>
<script type="text/javascript" src="<?php echo base_url()?>design/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
		selector: "textarea",
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
		toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages | fontselect,fontsizeselect",
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
<div class="main_content">
          <div class="container">
          <div class="row">	
			<?php $this->load->view('publisher/publisher_header.php') ?>
              <div class="main_subm_sec">
			  	   <h1 style="float:left; padding-left:20px;">Publish Process</h1>
              <div class="col-md-12">
			  
                <div class="main_subm_tab">
                <div id="parentHorizontalTab" class="resp-vtabs hor_1">
                      <ul class="resp-tabs-list hor_1 new_full_tab">
					  
                    <li class="active" id="basic_info"><a href="#basic_inforamtion">Basic information</a></li>
					
                    <li class="" id="full"><a href="#full_html">Full Text Html </a></li><!-- data-toggle="tab"-->
                    <li class="" id='attach'><a href="#attach_file">Attachment File</a></li><!--data-toggle="tab"-->
                    <li class="" id='rese'><a href="#research">Must See Research In lean Corrosion</a></li><!--data-toggle="tab"-->
                    <li class="" id='like_art'><a href="#like_article">Research  and article you may like</a></li><!-- data-toggle="tab"-->
                    <!--     <li><a href="#e" data-toggle="tab">Enter Keywords</a></li>
                    <li><a href="#f" data-toggle="tab">Attach manuscript</a></li>-->
                </ul>
				
				
				
                        <div class="tab-content new_tab_fullwidth">
						
						<div  class="resp-tabs-container tab-pane active" id="basic_inforamtion">
						
						<div class="cont_article_sec_top_left" style="text-align:left;padding-left:20px;; font-weight:normal; ">
                  <p class="article_h"><?php echo $art_data[0]->art_fulltitle;?></p>
                  <span class="left_article_text"><?php
						$reviewer_name = '';
						if(!empty($assin_reviewer)){
							foreach($other_author as $other_author_list){								
								 $reviewer_name .= $other_author_list->oa_fname.'&nbsp;'.$other_author_list->oa_lname.', ';
							}
						$reviewer_name = rtrim($reviewer_name,', ');
							
							echo $reviewer_name;
						}?></span>
                  <p class="artical_stro"> <strong  class="artical_stro">Affiliation</strong>
				  	 <strong  class="artical_stro"><?php echo $art_data[0]->user_instiute;?></strong></p>
                     </div>
					 
						<form name="step_11frm"  id="step_basic" method="post" enctype="multipart/form-data">					
						<input type="hidden" name="pub_artid" id="pub_artid" value="<?php echo $art_data[0]->art_id;?>"/>
						<input type="hidden" class="inset_artid" name="pub_id" id="pub_id" value=""/>
                          <div class="tab_one_sec public_n">
                        <div class="main_attachment">
                              <div class="col-md-6">
                            <div class="main_attachment_left">
                                  <p>Year:</p>
                                </div>
                          </div>
                              <div class="col-md-6">
                            <div class="main_attachment_right">
                                  <div class="input-group">
                                <input type="text" name="pub_year" id="pub_year"  class="form-control custom-control"  required="required">
                              </div>
                                </div>
                          </div>
                            </div>
                        <div class="main_attachment">
                              <div class="col-md-6">
                            <div class="main_attachment_left">
                                  <p>Volume:</p>
                                </div>
                          </div>
                              <div class="col-md-6">
                            <div class="main_attachment_right">
                                  <div class="input-group">
                                <input type="text" name="pub_valume" id="pub_valume"  class="form-control custom-control"  required="required">
                              </div>
                                </div>
                          </div>
                            </div>
                        <div class="main_attachment">
                              <div class="col-md-6">
                            <div class="main_attachment_left">
                                  <p>Issue:</p>
                                </div>
                          </div>
                              <div class="col-md-6">
                            <div class="main_attachment_right">
                                  <div class="input-group">
                                <input type="text" name="pub_issue" id="pub_issue"  class="form-control custom-control"  required="required" >
                              </div>
                                </div>
                          </div>
                            </div>
                        <div class="main_attachment">
                              <div class="col-md-6">
                            <div class="main_attachment_left">
                                  <p>DOI</p>
                                </div>
                          </div>
                              <div class="col-md-6">
                            <div class="main_attachment_right">
                                  <div class="input-group">
                                <input type="text" name="pub_DOI" id="pub_DOI"  class="form-control custom-control" required="required">
                              </div>
                                </div>
                          </div>
                            </div>
                        
						<div class="main_attachment">
                              <div class="col-md-6">
                            <div class="main_attachment_left">
                                  <p> Paper style </p>
                                </div>
                          </div>
                              <div class="col-md-6">
                            <div class="main_attachment_right">
                                  <div class="input-group">
								  	<select name="pub_paper" id="pub_paper" class="form-control custom-control">
										<option value="Article_or_Communication">Article or Communication</option>
										<option value="Review_article_or_Correspondence">Review article or Correspondence</option>
									</select>
                               
                              </div>
                                </div>
                          </div>
                            </div>
                        <p class="public_next">
						 <a href="#" data-toggle="tab" class="good-btn next_full_html">Next</a> 				  
						</p>
                      </div>
					   </form>
                        </div>
						
						
                        <div class="resp-tabs-container tab-pane " id="full_html">
                      	  <div class="tab_one_sec public_n">
							<div id="parentVerticalTab" class="resp-vtabs hor_1">
              		 	   		<ul class="resp-tabs-list hor_1 full_html_tab">
								<li class="active"  id='l1'><a href="#a">Abstract</a></li>
								<li class="pagestyle2 "  id='l2' style="display:none;"><a href="#j">
									Mainbody</a></li>
								<li class="pagestyle" id='l2'><a href="#b">Introduction</a></li>
								<li class="pagestyle" id='l3'><a href="#c">Experiment</a></li>
								<li class="pagestyle" id='l4'><a href="#d">Result & discussion</a></li>
								<li class="" id='l5'><a href="#e">Conclusion</a></li>
								<li class="" id='l6'><a href="#f">Acknowledge</a></li>
								<li class="" id='l7'><a href="#g">Reference</a></li>
								<li class="" id='l8'><a href="#h">Supplementary</a></li>
								<li class="" id='l9'><a href="#i">Review Information</a></li>
							  </ul>
                 			 	<div class="tab-content">
                    
									
									<div class="resp-tabs-container tab-pane active" id="a">
									  <div class="tab_one_sec">
									  <form name="step_1frm"  id="step_1" method="post">					
										<input type="hidden" name="pub_artid" id="pub_artid" value="<?php echo $art_data[0]->art_id;?>"/>
										<input type="hidden" class="inset_artid" name="pub_id" id="pub_id" value=""/>
									   <p style="text-align:left !important">Abstract   </p>
										<div class="input-group tab_textarea">
										  <textarea class="form-control custom-control" name="pub_abstract" id="pub_abstract"  style="resize:none"></textarea><!--style="resize:none"-->
										</div>
										
										<p>
										<!-- <a href="#" data-toggle="tab" data-act-tab="b" data-act-li="1" data-act-curt="a" class="good-btn next_pub" data-id="step_1" >Next</a>-->
										
										<a href="#" data-toggle="tab" data-act-tab="b" data-act-tab-new="j" data-act-li="1" data-act-curt="a" class="good-btn next_pub" data-id="step_1" >Next</a>
										
										
										</p>
									   </form>
									  </div>
									</div>
									
									<div class="resp-tabs-container tab-pane " id="j">
									<form name="step_1frm"  id="step_2j" method="post">					
										<input type="hidden" name="pub_artid" id="pub_artid" value="<?php echo $art_data[0]->art_id;?>"/>
										<input type="hidden" class="inset_artid" name="pub_id" id="pub_id" value=""/>
									  <div class="tab_one_sec">
									  
									   <p style="text-align:left !important">Mainbody</p>
										<div class="input-group tab_textarea">
										  <textarea class="form-control custom-control" name="pub_mainbody" id="pub_mainbody" rows="3" ></textarea>
										</div>
										
										<p>
										   <a href="#" data-toggle="tab" data-act-tab="e" data-act-li="4" data-act-curt="j" class="good-btn next_pub" data-id="step_2" >Next</a>
										</p>
									  </div>
									  </form>
									</div>
									
									<div  class="resp-tabs-container tab-pane" id="b">
									<form name="step_1frm"  id="step_2" method="post">					
										<input type="hidden" name="pub_artid" id="pub_artid" value="<?php echo $art_data[0]->art_id;?>"/>
										<input type="hidden" class="inset_artid" name="pub_id" id="pub_id" value=""/>
									  <div class="tab_one_sec">
									  
									   <p style="text-align:left !important">Introduction</p>
										<div class="input-group tab_textarea">
										  <textarea class="form-control custom-control" name="pub_intro" id="pub_intro" rows="3" ></textarea>
										</div>
										
										<p>
										   <a href="#" data-toggle="tab" data-act-tab="c" data-act-li="2" data-act-curt="b" class="good-btn next_pub" data-id="step_2" >Next</a>
										</p>
									  </div>
									  </form>
									</div>
									
									<div  class="resp-tabs-container tab-pane" id="c">
									<form name="step_1frm"  id="step_3" method="post">					
										<input type="hidden" name="pub_artid" id="pub_artid" value="<?php echo $art_data[0]->art_id;?>"/>
										<input type="hidden" class="inset_artid" name="pub_id" id="pub_id" value=""/>
									  <div class="tab_one_sec">
									  
									   <p style="text-align:left !important">Experiment</p>
										<div class="input-group tab_textarea">
										  <textarea class="form-control custom-control" name="pub_expri" id="pub_expri" ></textarea>
										</div>
										
										<p>
										  
										   <a href="#" data-toggle="tab" data-act-tab="d" data-act-li="3" data-act-curt="c" class="good-btn next_pub" data-id="step_3" >Next</a>
										</p>
									  </div>    
									  </form>                  
									</div>
									
									<div  class="resp-tabs-container tab-pane" id="d">
									<form name="step_1frm"  id="step_4" method="post">					
										<input type="hidden" name="pub_artid" id="pub_artid" value="<?php echo $art_data[0]->art_id;?>"/>
										<input type="hidden" class="inset_artid" name="pub_id" id="pub_id" value=""/>
									  <div class="tab_one_sec">
										<p style="text-align:left !important">Result & discussion</p>
										<div class="input-group tab_textarea">
										  <textarea class="form-control custom-control" name="pub_result" id="pub_result"></textarea>
										</div>
										<p style="padding: 0;">
										   <a href="#" data-toggle="tab" data-act-tab="e" data-act-li="4" data-act-curt="d" class="good-btn next_pub" data-id="step_4" >Next</a>
										</p>
									  </div>
									  </form>
									</div>
									
									<div  class="resp-tabs-container tab-pane" id="e">
									<form name="step_1frm"  id="step_5" method="post">					
										<input type="hidden" name="pub_artid" id="pub_artid" value="<?php echo $art_data[0]->art_id;?>"/>
										<input type="hidden" class="inset_artid" name="pub_id" id="pub_id" value=""/>
									  <div class="tab_one_sec">
									  
										<p style="text-align:left !important">Conclusion</p>
										<div class="input-group tab_textarea">
										  <textarea class="form-control custom-control" name="pub_concl" id="pub_concl"></textarea>
										</div>
										<p style="padding: 0;">
										   <a href="#" data-toggle="tab" data-act-tab="f" data-act-li="5" data-act-curt="e" class="good-btn next_pub" data-id="step_5" >Next</a>
										</p>
									  </div>
									  </form>
									</div>
									
									<div  class="resp-tabs-container tab-pane" id="f">
									<form name="step_1frm"  id="step_6" method="post">					
										<input type="hidden" name="pub_artid" id="pub_artid" value="<?php echo $art_data[0]->art_id;?>"/>
										<input type="hidden" class="inset_artid" name="pub_id" id="pub_id" value=""/>
									  <div class="tab_one_sec">
									  
										<p style="text-align:left !important">Acknowledge</p>
										<div class="input-group tab_textarea">
										  <textarea class="form-control custom-control" name="pub_ack" id="pub_ack"></textarea>
										</div>
										<p style="padding: 0;">
										   <a href="#" data-toggle="tab" data-act-tab="g" data-act-li="6" data-act-curt="f" class="good-btn next_pub" data-id="step_6" >Next</a>
										</p>
									  </div>
									  </form>
									</div>
									
									<div  class="resp-tabs-container tab-pane" id="g">
									<form name="step_1frm"  id="step_7" method="post">					
										<input type="hidden" name="pub_artid" id="pub_artid" value="<?php echo $art_data[0]->art_id;?>"/>
										<input type="hidden" class="inset_artid" name="pub_id" id="pub_id" value=""/>
									  <div class="tab_one_sec">
									  
										<p style="text-align:left !important">Reference</p>
										<div class="input-group tab_textarea">
										  <textarea class="form-control custom-control" name="pub_ref" id="pub_ref"></textarea>
										</div>
										<p style="padding: 0;">
										   <a href="#" data-toggle="tab" data-act-tab="h" data-act-li="7" data-act-curt="g" class="good-btn next_pub" data-id="step_7" >Next</a>
										</p>
									  </div>
									  </form>
									</div>
									
									<div  class="resp-tabs-container tab-pane" id="h">
									<form name="step_1frm"  id="step_8" method="post">					
										<input type="hidden" name="pub_artid" id="pub_artid" value="<?php echo $art_data[0]->art_id;?>"/>
										<input type="hidden" class="inset_artid" name="pub_id" id="pub_id" value=""/>
									  <div class="tab_one_sec">
									  
										<p style="text-align:left !important">Supplementary</p>
										<div class="input-group tab_textarea">
										  <textarea class="form-control custom-control" name="pub_suply" id="pub_suply"></textarea>
										</div>
										<p style="padding: 0;">
										   <a href="#" data-toggle="tab" data-act-tab="i" data-act-li="8" data-act-curt="h" class="good-btn next_pub" data-id="step_8" >Next</a>
										</p>
									  </div>
									  </form>
									</div>
									
									<div  class="resp-tabs-container tab-pane" id="i">
									<form name="step_1frm"  id="step_9" method="post">					
										<input type="hidden" name="pub_artid" id="pub_artid" value="<?php echo $art_data[0]->art_id;?>"/>
										<input type="hidden" class="inset_artid" name="pub_id" id="pub_id" value=""/>
									  <div class="tab_one_sec">
									  
										<p style="text-align:left !important">Review Information</p>
										<div class="input-group tab_textarea">
										  <textarea class="form-control custom-control" name="pub_reviewer" id="pub_reviewer"></textarea>
										</div>
										<p style="padding: 0;">
										   <a href="#" data-toggle="tab" data-act-tab="attach_file" data-act-li="9" data-act-curt="i" class="good-btn next_pub" data-id="step_9" >Next</a>
										</p>
									  </div>
									  </form>
									</div>
								  </div>
               				 </div>
                      	  </div>
                        </div>
                    <div  class="resp-tabs-container tab-pane" id="attach_file">
                          <form name="step_10frm"  id="step_10" method="post" enctype="multipart/form-data">					
						<input type="hidden" name="pub_artid" id="pub_artid" value="<?php echo $art_data[0]->art_id;?>"/>
						<input type="hidden" class="inset_artid" name="pub_id" id="pub_id" value=""/>
                          <div class="tab_one_sec public_n" id="attach_file">
						  <div class="main_attachment">
                              <div class="col-md-6">
                            <div class="main_attachment_left">
                                  <p>Cover Picture:</p>
                                </div>
                          </div>
                              <div class="col-md-6">
                            <div class="main_attachment_right">
                                  <div class="input-group">
                                <input type="file" name="pub_cover" id="pub_cover">
                              </div>
                                </div>
                          </div>
                            </div>
							
                        <div class="main_attachment">
                              <div class="col-md-6">
                            <div class="main_attachment_left">
                                  <p>PDF:</p>
                                </div>
                          </div>
                              <div class="col-md-6">
                            <div class="main_attachment_right">
                                  <div class="input-group">
                                <input type="file" name="pub_pdf" id="pub_pdf">
                              </div>
                                </div>
                          </div>
                            </div>
                        <div class="main_attachment">
                              <div class="col-md-6">
                            <div class="main_attachment_left">
                                  <p>PPT Slide:</p>
                                </div>
                          </div>
                              <div class="col-md-6">
                            <div class="main_attachment_right">
                                  <div class="input-group">
                                <input type="file" name="pub_ppt" id="pub_ppt" >
                              </div>
                                </div>
                          </div>
                            </div>
                        <div class="main_attachment">
                              <div class="col-md-6">
                            <div class="main_attachment_left">
                                  <p>Download Citation:</p>
                                </div>
                          </div>
                              <div class="col-md-6">
                            <div class="main_attachment_right">
                                  <div class="input-group">
                                <input type="file" name="pub_cita" id="pub_cita" >
                              </div>
                                </div>
                          </div>
                            </div>
                        <div class="main_attachment">
                              <div class="col-md-6">
                            <div class="main_attachment_left">
                                  <p>Endnote output Style</p>
                                </div>
                          </div>
                              <div class="col-md-6">
                            <div class="main_attachment_right">
                                  <div class="input-group">
                                <input type="file" name="pub_output" id="pub_output" >
                              </div>
                                </div>
                          </div>
                            </div>
                        <div class="main_attachment">
                              <div class="col-md-6">
                            <div class="main_attachment_left"> </div>
                          </div>
                              <div class="col-md-6">
                            <div class="main_attachment_right">
                                  <div class="input-group">
								   <a href="#" data-toggle="tab" data-act-tab="research"  data-act-curt="attach_file" class="good-btn" data-id="step_10" id="Submit_proof_files" >Upload</a>
								   
                              </div>
                                </div>
                          </div>
                            </div>
                        <p class="public_next"> <a href="#" data-toggle="tab" data-act-tab="research"  data-act-curt="attach_file" class="good-btn next_research">Next</a> </p>
                      </div>
					  </form>
                        </div>
                    <div  class="resp-tabs-container tab-pane" id="research">
                          <div class="tab_one_sec public_n">
						  <form name="must_see" id="must_see" method="post">
						  <input type="hidden" name="pub_artid" id="pub_artid" value="<?php echo $art_data[0]->art_id;?>"/>
						<input type="hidden" class="inset_artid" name="pub_id" id="pub_id" value=""/>
								
                        <table>
                              <thead>
                            <tr>
                                  <th>Paper Manuscript</th>
                                  <th>Publish date</th>
                                  <th>Cover Page</th>
                                  <th>Choose</th>
                                </tr>
                          </thead>
                              <tbody>
							  
							  <?php
							   if(!empty($publish_data)){ 
							  	foreach($publish_data as $publish_list)
								{
							  	?>
                            	<tr>
                                  <th><?php echo word_limiter($publish_list->art_fulltitle,20);?></th>
                                  <td><?php echo date('m-d-Y',strtotime($publish_list->art_publish));?> </td>
                                  <td><?php if(!empty($publish_list->art_cover)){}?> </td>
                                  <td><input type="checkbox" class="art_must_see" name="art_see[]" id="art_see" value="<?php echo $publish_list->art_id;?>"/></td>
                                </tr>
								<?php } ?>								
									<tr>
                                  <td>&nbsp;</td>
                                  <td>&nbsp; </td>
                                  <td>&nbsp; </td>
                                  <td>
								  	<a href="#" class="next action-button submit_see_complete">Complete</a>
								  </td>
                                </tr>
                            <?php }else{?>
								<tr>                                  
                                  <td colspan="4">No record found!</td>
                                </tr>
							<?php }?>
                          </tbody>
                            </table>
						 	</form>
							
                        <div class="form-group tab_three_sec">
                              <div class="col-md-12">
                            <p class="public_next"> <a href="#" data-toggle="tab" class="good-btn next_like_article">Next</a></p>
                          </div>
                            </div>
                      </div>
                        </div>
                    <div  class="resp-tabs-container tab-pane" id="like_article">
                          <div class="tab_one_sec_public_new">
						  <div id="all_data">
							<div class="main_public_se_head">
								  <div class="col-md-2">
								<div class="main_public_se_head_one">
									  <P><strong>Title</strong> </P>
									</div>
							  </div>
								  <div class="col-md-2">
								<div class="main_public_se_head_one">
									  <P><strong>Journal</strong> </P>
									</div>
							  </div>
								  <div class="col-md-2">
								<div class="main_public_se_head_one">
									  <P><strong>Picture</strong> </P>
									</div>
							  </div>
								  <div class="col-md-2">
								<div class="main_public_se_head_one">
									  <P><strong>URL</strong> </P>
									</div>
							  </div>
								  <div class="col-md-4">
								<div class="main_public_se_head_one">
									  <P><strong>Action</strong> </P>
									</div>
							  </div>
								</div>
								
								
								<?php 
								$i=1;
								$i++;
								?>
								
								<div class="main_public_se_cont">
								<form name="res_art" id="res_art1" method="post"  enctype="multipart/form-data">
								 <input type="hidden" name="research_id" id="research_id1" value="">
								 
								<input type="hidden" class="inset_artid" name="pub_id" id="pub_id" value=""/>
								<input type="hidden" name="research_artid" id="research_artid" value="<?php echo $art_data[0]->art_id;?>">
								  <div class="col-md-2">
								<div class="main_public_se_head_two">
									  <input type="text" name="research_title" id="research_title1" value="" required="required">
									</div>
							  </div>
								  <div class="col-md-2">
								<div class="main_public_se_head_two">
									 <input type="text" name="research_journal" id="research_journal1" value="" required="required">
									</div>
							  </div>
								  <div class="col-md-2">
								<div class="main_public_se_head_two">
									<input type="file" name="research_file" id="research_file" class="next action-button"/> </div>
							  </div>
								  <div class="col-md-2">
								<div class="main_public_se_head_two">
									  <input type="text" name="research_url"  id="research_url1" value=""required="required">
									</div>
							  </div>
								  <div class="col-md-4">
								<div class="main_public_se_head_two"> 
									<a href="#" class="next action-button submit_res_asrt" data-sno="1">Submit</a> </div>
							  </div>
							  	</form>
								</div>
								
								
							</div>
							<div class="main_public_se_cont">
								  <div class="col-md-2">
								<div class="main_public_se_head_two">&nbsp;</div>
							  </div>
								  <div class="col-md-2">
								<div class="main_public_se_head_two">&nbsp;</div>
							  </div>
								  <div class="col-md-2">
								<div class="main_public_se_head_two">&nbsp;</div>
							  </div>
								  <div class="col-md-2">
								<div class="main_public_se_head_two">&nbsp;</div>
							  </div>
								  <div class="col-md-4">
								<div class="main_public_se_head_two"><a href="#" data-artid="<?php echo $art_data[0]->art_id; ?>" data-fid='<?php echo $i;?>' id="add_res_art" class="next action-button">Add</a> </div>
							  </div>
								</div>
                        <p class="public_next"> 
							<a href="#" data-toggle="tab" data-artid='<?php echo $art_data[0]->art_id; ?>' class="good-btn new_but preview_article">Next</a>
						 </p>
                      </div>
                        </div>
                  </div>
                    </div>
              </div>
                </div>
          </div>
            </div>
      </div>
        </div>
		
		
<div id="ajax_loddder" style="display:none;">
	 <div align="center" style="vertical-align:middle;">
		<img src="<?php echo base_url();?>design/ajax-loader1.gif" />
	</div>
</div>
