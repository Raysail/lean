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
	
	<script language="javascript">
function showimagepreview_comp(input) {
       if (input.files && input.files[0]) {
               var filerdr = new FileReader();
               filerdr.onload = function(e) {
               $('#imgprvw_comp').show();
               $('#imgprvw_comp').attr('src', e.target.result);
               $('#imgprvw_comp').attr('height','150');
               $('#imgprvw_comp').attr('width','100');
               }
               filerdr.readAsDataURL(input.files[0]);
       }
}
</script>
<div class="main_content">
      <div class="container">
        <div class="row">
			<?php $this->load->view('author/author_header.php') ?>
			
          <div class="main_registation_sec">
            <div class="col-md-12">
			
		 		<!--<h3 style="float:left;">Welcome <?php //echo $this->session->userdata('username');?> </h3>-->
				<br />
				
			
			<?php if($this->session->flashdata('error')){echo '<div class="alert alert-danger" role="alert">'.$this->session->flashdata('error').'</div>' ;} ?>
        	<?php if($this->session->flashdata('success')){echo  '<div class="alert alert-success" role="alert">'.$this->session->flashdata('success').'</div>';} ?>
			
			
			
              <div class="main_subm_tab">
			  <div id="parentVerticalTab" class="resp-vtabs hor_1">
                  <ul class="resp-tabs-list hor_1">
                    <li class="active" id='l1'><a href="#a" >select artical type</a></li>
                    <li class="" id='l2'><a href="#b" >Enter title</a></li>
                    <li class="" id='l3'><a href="#c" >Edit author</a></li>
                    <li class="" id='l4'><a href="#d" >Submit abstract</a></li>
                    <li class="" id='l5'><a href="#e" >Upload Scheme</a></li>
                    <li class="" id='l6'><a href="#f" >Attach manuscript</a></li>
                    <li class="" id='l7'><a href="#g" >Invite Reviewers</a></li>
                  </ul>
                  <div class="tab-content">
                    
                    
                    <div class="resp-tabs-container tab-pane active" id="a">
                      <div class="tab_one_sec">
					<form name="step_1frm"  id="step_1" method="post">	
					<input type="hidden" name="from_name" id="from_name" value="<?php echo $from_page;?>" />				
					<input type="hidden" class="inset_artid" name="art_id" id="art_id" value=""/>
                        <div class="col-md-6">
                          <div class="tab_one_sec_main">
                            <h3> Select aritcal Type</h3>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="tab_one_sec_main">
                            <select name="art_type" id="art_type" class="form-control" required="required">
							<option value="">Select Article Type</option>
							 <?php  foreach($article_type as $atype){
							 ?>							 
                              <option value="<?php echo $atype->atype_id;?>">
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
                          <span style="color:#ff0000">Please download <a href="<?php echo base_url();?>design/front/meanucscript_templete.docx">LEAN CORROSION TEMPLATE</a></span> </p>
					  </form>
                      </div>
                    </div>
                    
                    <div  class="resp-tabs-container tab-pane" id="b">
                      <div class="tab_one_sec" id="b">
					  	<form name="step_2frm" id="step_2" method="post">	
					<input type="hidden" name="from_name" id="from_name" value="<?php echo $from_page;?>" />				
					<input type="hidden" class="inset_artid" name="art_id" id="art_id" value=""/>
                        <div class="input-group tab_textarea">
                          <textarea  name="art_fulltitle" id="art_fulltitle" class="form-control custom-control" rows="3"style="resize:none"></textarea>
                        </div>
                        <p class="tab_te">The long of full title is no more than 100 characters, including spaces.</p>
                        <p>
                   <!--       <input type="button" name="next" class="next action-button" value="Next">-->
				   
				  		 <a href="#" data-toggle="tab" data-act-tab="c" data-act-li="2" data-act-curt="b" class="good-btn next_frm" data-id="step_2" >Next</a>
                        </p>
						</form>
                      </div>
                    </div>
                    
                    <div  class="resp-tabs-container tab-pane" id="c">
                      <div class="tab_one_sec">
					  
					  	<form name="other_authorfrm" id="other_authorfrm" method="post">
						<input type="hidden" class="inset_artid" name="oa_art_id" id="art_id" value=""/>
						<input type="hidden" name="oa_userid" id="oa_userid" value="<?php echo $user_id; ?>"/>
						<input type="hidden" name="oa_id" id="oa_id" value=""/>
						
                          <div class="form-group tab_three_sec">
                          <div class="col-md-4">
                            <label for="InputName">First Name*</label>
                          </div>
                          <div class="col-md-4">
                            <div class="input-group">
                              <input type="text" class="form-control" name="oa_fname" id="oa_fname" placeholder="Enter Name" required>
                            </div>
                          </div>
                        </div>
                          <div class="form-group tab_three_sec">
                          <div class="col-md-4">
                            <label for="InputEmail">Last Name*</label>
                          </div>
                          <div class="col-md-4">
                            <div class="input-group">
                              <input type="text" class="form-control" id="oa_lname" name="oa_lname" placeholder="Last Name" required  >
                            </div>
                          </div>
                        </div>
                          <div class="form-group tab_three_sec">
                          <div class="col-md-4">
                            <label for="InputEmail">Affiliation</label>
                          </div>
                          <div class="col-md-4">
                            <div class="input-group">
                              <input type="text" class="form-control" id="oa_affiliation" name="oa_affiliation" placeholder="Affiliation">
                            </div>
                          </div>
                        </div>
                          <div class="form-group tab_three_sec">
                          <div class="col-md-4">
                            <label for="InputEmail">E-mail</label>
                          </div>
                          <div class="col-md-4">
                            <div class="input-group">
                              <input type="email" class="form-control" id="oa_email" name="oa_email" placeholder="E-mail" required  >
                            </div>
                          </div>
                          <div class="col-md-4">
                            <input type="button" name="Add as Author" id="other_aut_btn" class="next action-button" value="Add as Author" style="margin:0px;">
                          </div>
						  
						  
                        </div>
					    </form>
                        <div class="form-group tab_three_sec">
                          <div class="col-md-12">
                            <!--<input type="button" name="next" class="next action-button" value="Next" style="margin:0px;">
                            <a href="#d" data-toggle="tab" class="good-btn">Next</a>-->
							
					<form name="step_3frm" id="step_3" method="post">	
					<input type="hidden" name="from_name" id="from_name" value="<?php echo $from_page;?>" />				
						<input type="hidden" class="inset_artid" name="art_id" id="art_id" value=""/>
							 <a href="#" data-toggle="tab" data-act-tab="d" data-act-li="3" data-act-curt="c" class="good-btn next_frm" data-id="step_3" >Next</a>
							 
					  </form>
                          </div>
                        </div>
                      </div>
					  
                      
					  
					  <div class="tab_two_sec">
					   <div>
                        <div class="col-md-3">
                          <div class="tab_two_sec_buttom">
                            <p class="sec_active">Name </p>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="tab_two_sec_buttom">
                            <p>Affiliation </p>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="tab_two_sec_buttom">
                            <p>Email </p>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="tab_two_sec_buttom">
                            <p>Edit </p>
                          </div>
                        </div>
						</div>
						
						
						 <div  class="other_author" id="oter_add_author">
							 <div  class="other_author manage_author">
						
                        <div class="col-md-3">
                          <div class="tab_two_sec_buttom">
                            <p class="sec_active"><?php echo $user_data->user_fname.'&nbsp;'.$user_data->user_lname;?> </p>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="tab_two_sec_buttom">
                            <p><?php echo $user_data->user_instiute;?>  </p>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="tab_two_sec_buttom">
                            <p><?php echo $user_data->user_email;?> </p>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="tab_two_sec_buttom">
                            <p>Edit </p>
                          </div>
                        </div>
						
						</div>
						</div>
                      </div>
					  
					  
					  
                    </div>
                    
                    <div  class="resp-tabs-container tab-pane" id="d">
                      <div class="tab_one_sec">
					  
					<form name="step_4frm"  id="step_4" method="post">	
					<input type="hidden" name="from_name" id="from_name" value="<?php echo $from_page;?>" />				
					<input type="hidden" class="inset_artid" name="art_id" id="art_id" value=""/>
                        <div class="input-group tab_textarea">
                          <textarea class="form-control custom-control" name="art_abstract" id="art_abstract" rows="3" style="resize:none;   min-height: 150px;"></textarea>
                        </div>
                        <p class="tab_te" style="text-align:right;padding: 0; ">More then 200 words</p>
                        <p style="padding: 0;">
						   <a href="#" data-toggle="tab" data-act-tab="e" data-act-li="4" data-act-curt="d" class="good-btn next_frm" data-id="step_4" >Next</a>
						   
                        </p>
						</form>
                      </div>
                    </div>
                    
                    <div  class="resp-tabs-container tab-pane" id="e">
                      <div class="tab_one_sec">
					  <form name="step_5frm" id="step_5" method="post" enctype="multipart/form-data">
					<input type="hidden" name="from_name" id="from_name" value="<?php echo $from_page;?>" />					
					  	
						<input type="hidden" class="inset_artid" name="art_id" id="art_id" value=""/>
                         
                        <div class="form-group tab_three_sec">
						
						 <div class="col-md-3">
                            <label for="InputName">Upload Scheme</label>
                          </div>
                          <div class="col-md-6">
                            <div class="input-group full-wid">
							<input type="file" name="art_scheme" id="art_scheme" onchange="showimagepreview_comp(this)" required="required" />	
							<div id="art_scheme_error" style="display:none"> Invalid File Type!</div>
                            </div>
                          </div>
                          <div class="col-md-3">
							 <a href="#" data-toggle="tab" data-act-tab="f" data-act-li="5" data-act-curt="e" class="good-btn" data-id="step_5" id="submit_scheme_file" >Upload</a>
							 
                          </div>
                        </div>
                        <div class="form-group tab_three_sec">
                          <div class="col-md-12" id="keyword_list"> 
						  	 <img id="imgprvw_comp" class="img-responsive" src="" width='100' height='100' />
							</div>
                        </div>
                        <div class="form-group tab_three_sec">
                          <div class="col-md-12">
							 <a href="#" data-toggle="tab" data-act-tab="f" data-act-li="5" data-act-curt="e" class="good-btn next_frm" data-id="step_5" >Next</a>
                          </div>
                        </div>
						</form>
                      </div>
                    </div>
                    
                    
                    <div  class="resp-tabs-container tab-pane" id="f">
                      <div>
					  
					  <form name="step_6frm" id="step_6" method="post" action="#" enctype="multipart/form-data">
					  <input type="hidden" name="from_name" id="from_name" value="<?php echo $from_page;?>" />					
						<input type="hidden" class="inset_artid" name="art_id" id="art_id" value=""/>
						<input type="hidden"  name="old_cover" id="old_cover" value=""/>
						<input type="hidden"  name="old_menuscript" id="old_menuscript" value=""/>
						<input type="hidden"  name="old_figure" id="old_figure" value=""/>
						<input type="hidden"  name="old_slide" id="old_slide" value=""/>
						<input type="hidden"  name="old_supple" id="old_supple" value=""/>
						<input type="hidden"  name="old_response" id="old_response" value=""/>
						
						
						
                        <div class="tab_one_sec">
                          <div class="form-group tab_three_sec">
                            <div class="col-md-4">
                              <label for="InputName">Cover letter</label>
                            </div>
                            <div class="col-md-4">
                              <div class="input-group">
                                <input type="file" class="crt_file_type" name="art_cover" id="art_cover">
							
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
								 <a href="#" data-toggle="tab" data-act-tab="g" data-act-li="6" data-act-curt="f" class="good-btn" data-id="step_6" id="Submit_files" >Upload</a>
                              </div>
                            </div>
                            <div class="col-md-4"><br /><br />
							 <a href="#" data-toggle="tab" data-act-tab="g" data-act-li="6" data-act-curt="f" class="good-btn next_frm" data-id="step_6" >Next</a>
							 
                              
                            </div>
                          </div>
                        </div>
						</form>
                      </div>
                    </div>
					
					
					<div  class="resp-tabs-container tab-pane" id="g">
                      <div>
					  
					  <form name="step_7frm" id="step_7" method="post" action="<?php echo base_url();?>article/final_submission" >					
						<input type="hidden" class="inset_artid" name="art_id" id="art_id" value=""/>
					<input type="hidden" name="from_name" id="from_name" value="<?php echo $from_page;?>" />
                        <div class="tab_one_sec">					  
					  	  <div class="form-group tab_three_sec">
                          <div class="col-md-12">
                            <label style="float:left !important">Invite your friend to review this mainscipt </label>
                          </div>
                        </div>
                      </div>
					  
                      
					  
						  <div class="tab_two_sec">
					   <div>
                        <div class="col-md-2">
                          <div class="tab_two_sec_buttom">
                            <p class="sec_active">Name </p>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="tab_two_sec_buttom">
                            <p>Affiliation </p>
                          </div>
                        </div>
						<div class="col-md-2">
                          <div class="tab_two_sec_buttom">
                            <p>Position </p>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="tab_two_sec_buttom">
                            <p>Email </p>
                          </div>
                        </div>
                        
                        <div class="col-md-4">
                          <div class="tab_two_sec_buttom">
                            <p>Personal Website/Information </p>
                          </div>
                        </div>
						</div>
						
						 <div id="user_data123">
							<?php 	
							for($ij=0;$ij<3;$ij++)
							{
							?>
							
								<input type="hidden" name="frnd_id[]" id="frnd_id" value="" />
							<div class="col-md-2">
							  <div class="tab_two_sec_buttom">
								<p class="sec_active"><input type="text" name="frnd_name[]" id="frnd_name" value="" /></p>
							  </div>
							</div>
							<div class="col-md-2">
							  <div class="tab_two_sec_buttom">
								<p class="sec_active"><input type="text" name="frnd_affiliat[]" id="frnd_affiliat" value=""/></p>
							  </div>
							</div>
							<div class="col-md-2">
							  <div class="tab_two_sec_buttom">
								<p class="sec_active"><input type="text" name="frnd_position[]" id="frnd_position" value=""/></p>
							  </div>
							</div>
							<div class="col-md-2">
							  <div class="tab_two_sec_buttom">
								<p class="sec_active"><input type="email" name="frnd_email[]" id="frnd_email" value=""/></p>
							  </div>
							</div>
							<div class="col-md-4">
							  <div class="tab_two_sec_buttom">
								<p class="sec_active"><input type="text" name="frnd_info[]" id="frnd_info" value=""/></p>
							  </div>
							</div>
							<?php
							}
							
							?>
						
						
						</div>
					
					
						
                      </div>
					  
					  	 <div class="tab_one_sec">					  
                       		 <p style="text-align:left!important">Welcome to invite your friends to review your manuscript, please obey some rules as follows:
								 	
									<ul style="text-align:left!important">
										<li>Least two reviewer's position is Professor or Associate Professor </li>
										<li>Least one reviewer should come from different country compared to Author</li>
										<li>Reviewers and Author cannot be come from same university/Institute</li>
										<li>Reviewer's expertise are relating to corrosion and material</li>
										<li>Please offers the link of Reviewers personal website/paper publish</li>
									</ul>
								</p>
								
							<p>
                   	   
				  		<input type="button" name="next" class="next action-button" id="Submit_Submission" value="Submit Submission" style="margin:0px;">
                        </p>
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
	
	
	<div id="ajax_loddder" style="display:none;">
 <div align="center" style="vertical-align:middle;">
<img src="<?php echo base_url();?>design/ajax-loader1.gif" />
</div>
</div>

