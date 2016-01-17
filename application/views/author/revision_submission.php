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
	display:block;
}
.resp-vtabs .resp-tabs-list li.active a {
    color: #fff;
}
.resp-vtabs .resp-tabs-list li:hover a {
    text-decoration: none;
}
.resp-vtabs .resp-tabs-list li.active {
    background-color: #EE4723 !important;
	text-decoration:none;
}
.resp-vtabs .resp-tabs-list li a {
    font-family: 'Segoe UI';
    color: #131313;
    display: block;
    padding: 15px 15px;
}
.resp-vtabs .resp-tabs-list li {
padding:0px !important;
}

    </style>
<div class="main_content">
      <div class="container">
        <div class="row">
          <div class="main_registation_sec">
            <div class="col-md-12">
			
		 		<h3 style="float:left;">Welcome <?php echo $this->session->userdata('username');?> </h3>
				<br />
				
			
			<?php if($this->session->flashdata('error')){echo '<div class="alert alert-danger" role="alert">'.$this->session->flashdata('error').'</div>' ;} ?>
        	<?php if($this->session->flashdata('success')){echo  '<div class="alert alert-success" role="alert">'.$this->session->flashdata('success').'</div>';} ?>
			
			
			
              <div class="main_subm_tab">
			  <div id="parentVerticalTab" class="resp-vtabs hor_1">
                  <ul class="resp-tabs-list hor_1">
                    <li class="active" id='l1'><a href="#a" data-toggle="tab">select artical type</a></li>
                    <li class="" id='l2'><a href="#b" data-toggle="tab" >Enter Title</a></li>
                    <li class="" id='l3'><a href="#c" data-toggle="tab">Submit Abstract</a></li>
                    <li class="" id='l4'><a href="#d" data-toggle="tab">Enter Keywords</a></li>
                    <li class="" id='l5'><a href="#e" data-toggle="tab">Attach Manuscript</a></li>
                   <!-- <li class="" id='l3'><a href="#c" data-toggle="tab">Edit Author</a></li>-->
                    <!--<li class="" id='l7'><a href="#g" data-toggle="tab">Invite Reviewers</a></li>-->
                  </ul>
                  <div class="tab-content">
                    
                    
                    <div class="resp-tabs-container tab-pane active" id="a">
                      <div class="tab_one_sec">
					<form name="step_1frm" class="inset_artid" id="step_1" method="post">					
					<input type="hidden" name="art_id" id="art_id" value="<?php if($art_no>0){ echo $article_data->art_id;} ?>"/>
                        <div class="col-md-6">
                          <div class="tab_one_sec_main">
                            <h3> Select aritcal Type</h3>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="tab_one_sec_main">
                            <select name="art_type" id="art_type" class="form-control" required="required" disabled="disabled">
							<option value="">Select Article Type</option>
							 <?php  foreach($article_type as $atype){
							 	$selected = '';
								if(($art_no>0)&&($article_data->art_type==$atype->atype_id)){ $selected='selected="selected"';}
							 ?>							 
                              <option value="<?php echo $atype->atype_id;?>" <?php echo $selected;?>>
							  <?php echo $atype->atype_title;?></option>
							 <?php }?>
                            </select>
                          </div>
                        </div>
                        <p>
						  <a href="#" data-toggle="tab" data-act-tab="b" data-act-li="1" data-act-curt="a" class="good-btn next_frm" data-id="step_1" >Next</a>
                     
                        </p>
                        <p class="tab_te"> You can use Our template to help you structure and format your manuscript.<br>
						We provide article template for use with MICROSOFT WORD <br />
                          <span style="color:#ff0000">Please download LEAN CORROSION TEMPLATE</span> </p>
					  </form>
                      </div>
                    </div>
                    
                    <div  class="resp-tabs-container tab-pane" id="b">
                      <div class="tab_one_sec" id="b">
					  	<form name="step_2frm" id="step_2" method="post">					
					<input type="hidden" class="inset_artid" name="art_id" id="art_id" value="<?php if($art_no>0){ echo $article_data->art_id;} ?>"/>
                        <div class="input-group tab_textarea">
                          <textarea  name="art_fulltitle" id="art_fulltitle" class="form-control custom-control" rows="3"style="resize:none"><?php if($art_no>0){ echo $article_data->art_fulltitle;} ?></textarea>
                        </div>
                        <p class="tab_te">The long of full title is no more than 100 characters, including spaces.</p>
                        <p>
                   	   
				  		 <a href="#" data-toggle="tab" data-act-tab="c" data-act-li="2" data-act-curt="b" class="good-btn next_frm" data-id="step_2" >Next</a>
                        </p>
						</form>
                      </div>
                    </div>
                    
                    
                    
                    <div  class="resp-tabs-container tab-pane" id="c">
                      <div class="tab_one_sec">
					  
					<form name="step_4frm"  id="step_3" method="post">					
					<input type="hidden" class="inset_artid" name="art_id" id="art_id" value="<?php if($art_no>0){ echo $article_data->art_id;} ?>"/>
                        <div class="input-group tab_textarea">
                          <textarea class="form-control custom-control" name="art_abstract" id="art_abstract" rows="3" style="resize:none;   min-height: 150px;"><?php if($art_no>0){ echo $article_data->art_abstract;} ?></textarea>
                        </div>
                        <p class="tab_te" style="text-align:right;padding: 0; ">More then 200 words</p>
                        <p style="padding: 0;">
						  <!-- <a href="#" data-toggle="tab" data-act-tab="e" data-act-li="4" data-act-curt="d" class="good-btn next_frm" data-id="step_4" >Next</a>-->
						    <a href="#" data-toggle="tab" data-act-tab="d" data-act-li="3" data-act-curt="c" class="good-btn next_frm" data-id="step_3" >Next</a>
                        </p>
						</form>
                      </div>
                    </div>
                    
                    <div  class="resp-tabs-container tab-pane" id="d">
                      <div class="tab_one_sec">
					  <form name="step_5frm" id="step_4" method="post">					
						<input type="hidden" class="inset_artid" name="art_id" id="art_id" value="<?php if($art_no>0){ echo $article_data->art_id;} ?>"/>
                         
                        <div class="form-group tab_three_sec">
						
						 <div class="col-md-3">
                            <label for="InputName">Keywords</label>
                          </div>
                          <div class="col-md-6">
                            <div class="input-group full-wid">
								<input type="hidden" name="art_keyword" value="<?php if($art_no>0){ echo $article_data->art_keyword;} ?>" id="art_keyword" />
                              <input type="text" class="form-control" name="art_keyword_tep" id="art_keyword_tep" placeholder="Enter Name" required>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <input type="button" name="Add as Keyword" id="add_keyword_revission" class="next action-button" value="Add as Keyword" style="margin:0px;">
                          </div>
                        </div>
                        <div class="form-group tab_three_sec">
                          <div class="col-md-12" id="keyword_list"> 
						  <?php if($art_no>0){ 
						  	$key_data = $article_data->art_keyword;
							if(!empty($key_data))
							{
									$key_data = explode(',',$article_data->art_keyword);
							  foreach($key_data as $key_list )
								{
								?>
									<span class="tab_fiv"><?php echo $key_list;?> <a href="#" class="del_key" data-name="<?php echo $key_list;?>" data-artid="<?php echo $article_data->art_id;?>">X</a></span> <br>
								<?php
								}
							  }	
							} ?>
							</div>
                        </div>
                        <div class="form-group tab_three_sec">
                          <div class="col-md-12">
							<!-- <a href="#" data-toggle="tab" data-act-tab="f" data-act-li="5" data-act-curt="e" class="good-btn next_frm" data-id="step_5" >Next</a>-->
							<a href="#" data-toggle="tab" data-act-tab="e" data-act-li="4" data-act-curt="d" class="good-btn next_frm" data-id="step_4" >Next</a>
                          </div>
                        </div>
						</form>
                      </div>
                    </div>
                    
                    <div  class="resp-tabs-container tab-pane" id="e">
                      <div>
					  
					  <form name="step_6frm" id="step_5" method="post" action="#" enctype="multipart/form-data">					
						<input type="hidden" class="inset_artid" name="art_id" id="art_id" value="<?php if($art_no>0){ echo $article_data->art_id;} ?>"/>
						<input type="hidden"  name="old_cover" id="old_cover" value="<?php if($art_no>0){ echo $article_data->art_cover;} ?>"/>
						<input type="hidden"  name="old_menuscript" id="old_menuscript" value="<?php if($art_no>0){ echo $article_data->art_menuscript;} ?>"/>
						<input type="hidden"  name="old_figure" id="old_figure" value="<?php if($art_no>0){ echo $article_data->art_figure;} ?>"/>
						<input type="hidden"  name="old_slide" id="old_slide" value="<?php if($art_no>0){ echo $article_data->art_slide;} ?>"/>
						<input type="hidden"  name="old_supple" id="old_supple" value="<?php if($art_no>0){ echo $article_data->art_supple;} ?>"/>
						<input type="hidden"  name="old_response" id="old_response" value="<?php if($art_no>0){ echo $article_data->	art_response;} ?>"/>
						
						
						
                        <div class="tab_one_sec">
                          <div class="form-group tab_three_sec">
                            <div class="col-md-4">
                              <label for="InputName">Cover letter</label>
                            </div>
                            <div class="col-md-4">
                              <div class="input-group">
                                <input type="file" class="crt_file_type" name="art_cover" id="art_cover">
									<?php if(!empty($article_data->art_cover)){?>
								<a target="_blank"  href="<?php echo base_url().'upload/article/author-'.$this->session->userdata('userid').'/'.$article_data->art_cover; ?>" >  <?php echo $article_data->art_cover;?></a>
								<?php } ?>
							
								<span id="art_cover_error" style="display:none"> Invalid File Type!</span>
                              </div>
                            </div>
                          </div>
                          <div class="form-group tab_three_sec">
                            <div class="col-md-4">
                              <label for="InputEmail">Manuscript</label>
                            </div>
                            <div class="col-md-4">
                              <div class="input-group">
                                <input type="file" class="crt_file_type" name="art_menuscript" id="art_menuscript">
									<?php if(!empty($article_data->art_menuscript)){?>
								<a target="_blank"  href="<?php echo base_url().'upload/article/author-'.$this->session->userdata('userid').'/'.$article_data->art_menuscript;?>"><?php echo $article_data->art_menuscript;?></a>
								<?php } ?>
								<span id="art_menuscript_error" style="display:none"> Invalid File Type!</span>
                              </div>
                            </div>
                          </div>
                          <div class="form-group tab_three_sec">
                            <div class="col-md-4">
                              <label for="InputName"> Fighre & Table</label>
                            </div>
                            <div class="col-md-4">
                              <div class="input-group">
                                <input type="file" class="crt_file_type" name="art_figure" id="art_figure">
									<?php if(!empty($article_data->art_figure)){?>
								<a target="_blank"  href="<?php echo base_url().'upload/article/author-'.$this->session->userdata('userid').'/'.$article_data->art_figure; ?>" >  <?php echo $article_data->art_figure;?></a>
								<?php } ?>
								<span id="art_figure_error" style="display:none"> Invalid File Type!</span>
                              </div>
                            </div>
                          </div>
                          <div class="form-group tab_three_sec">  
                            <div class="col-md-4">
                              <label for="InputName">Powerpoint Slide</label>
                            </div>
                            <div class="col-md-4">
                              <div class="input-group">
                                <input type="file" class="crt_file_type" name="art_slide" id="art_slide">
									<?php if(!empty($article_data->art_slide)){?>
								<a target="_blank"  href="<?php echo base_url().'upload/article/author-'.$this->session->userdata('userid').'/'.$article_data->art_slide; ?>" >  <?php echo $article_data->art_slide;?></a>
								<?php } ?>
								<span id="art_slide_error"  style="display:none"> Invalid File Type!</span>
                              </div>
                            </div>
                          </div>
                          <div class="form-group tab_three_sec">
                            <div class="col-md-4">
                              <label for="InputName">Supplementary</label>
                            </div>
                            <div class="col-md-4">
                              <div class="input-group">
                                <input type="file" class="crt_file_type" name="art_supple" id="art_supple">
									<?php if(!empty($article_data->art_supple)){?>
								<a target="_blank"  href="<?php echo base_url().'upload/article/author-'.$this->session->userdata('userid').'/'.$article_data->art_supple; ?>" >  <?php echo $article_data->art_supple;?></a>
								<?php } ?>
								<span id="art_supple_error" style="display:none"> Invalid File Type!</span>
                              </div>
                            </div>
                          </div>
                          <div class="form-group tab_three_sec">
                            <div class="col-md-4">
                              <label for="InputName">Response to Reviewer</label>
                            </div>
                            <div class="col-md-4">
                              <div class="input-group">
                                <input type="file" class="crt_file_type" name="art_response" id="art_response">
									<?php if(!empty($article_data->art_response)){?>
								<a target="_blank"  href="<?php echo base_url().'upload/article/author-'.$this->session->userdata('userid').'/'.$article_data->art_response; ?>" >  <?php echo $article_data->art_response;?></a>
								<?php } ?>
								<span id="art_response_error" style="display:none"> Invalid File Type!</span>
                              </div>
                            </div>
                          </div>
						  
                          <div class="form-group tab_three_sec">
                            <div class="col-md-4">
                              <label for="InputEmail"></label>
                            </div>
                            <div class="col-md-4">
                              <div class="input-group">
								  <!--  <input type="button" name="Upload" id="Submit_files" class="next action-button" value="Upload" style="margin:0px;">-->
								  	<br /><br />
								 <a href="#" data-toggle="tab" data-act-tab="e" data-act-li="5" data-act-curt="f" class="good-btn" data-id="step_5" id="Submit_files_revision" >Upload</a>
                              </div>
                            </div>
                            <div class="col-md-4"><br /><br />
							<!-- <a href="#" data-toggle="tab" data-act-tab="g" data-act-li="6" data-act-curt="f" class="good-btn next_frm" data-id="step_6" >Next</a>-->
							
				  		<input type="button" name="next" class="next action-button" id="Submit_revison_Submission" value="Submit Submission" style="margin:0px;">
							 
                              
                            </div>
                          </div>
                        </div>
						</form>
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