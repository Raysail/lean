<div class="main_content">
      <div class="container">
        <div class="row">
        
	<?php $this->load->view('reviewer/reviewer_header.php') ?>
        
        <div class="col-md-12">

        	<div class="authr-dtl-box">
        	<div class="authr-dshbrd-left">
				<?php  $src ='';
						if(!empty($article_data[0]->art_scheme)){ $src ='upload/article/author-'.$article_data[0]->art_userid.'/'.$article_data[0]->art_scheme; }else { $src ='design/front/images/tab_img.jpg';}?>
							 
                        	<img src="<?php echo base_url().$src;?>">
            </div>
            <div class="authr-dshbrd-right">
            	<div class="authr-dsbrd-head">
                	<strong><?php echo $article_data[0]->art_fulltitle;?></strong>
                </div>
                <div class="authr-dsbrd-txt">
                	<p>
					<?php //echo $article_data[0]->user_fname.'&nbsp;'.$article_data[0]->user_lname.';';
					
						if(!empty($other_author))
						{	
							foreach($other_author as $author_list)
							{
								echo $author_list->oa_fname.'&nbsp;'.$author_list->oa_lname.';&nbsp;';
							}
						}
					?>
					
					
					
					</p>
                </div>
                <div class="authr-dsbrd-btn">
                	<div class="sbmsn-box">
                    	<a href="#">
						<?php 
						if(($article_data[0]->art_status==2)||($article_data[0]->art_status==5)||($article_data[0]->art_status==6)){ echo 'In Review';}
						if(($article_data[0]->art_status==10)||($article_data[0]->art_status==11)||($article_data[0]->art_status==12)){ echo 'In Proof';}
						if(($article_data[0]->art_status==13)||($article_data[0]->art_status==14)){ echo 'In Proof Completion';}
						  if(($article_data[0]->art_status==7)){ echo 'In Revision';}
						  if(($article_data[0]->art_status==15)){ echo 'Publish';}
						   if(($article_data[0]->art_status==4)||($article_data[0]->art_status==8)	){ echo 'Declined';}
						?></a>
                    </div>
                    <div class="authr-tyt-date">
                    	<span><?php 	echo $article_data[0]->art_dateadd; ?>
					   </span>
                    </div>
                </div>
            </div>
        </div>
        
        </div>
        <div class="authr-opsn-tab">
        	 <div class="col-md-12">
            <div class="panel with-nav-tabs panel-primary">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1primary" data-toggle="tab">In Submission</a></li>
                            <li><a href="#tab2primary" data-toggle="tab">In Review</a></li>
                            <li><a href="#tab3primary" data-toggle="tab">In Proof</a></li>
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content" style="text-align:left">
                        <div class="tab-pane fade in active" id="tab1primary" >
						<?php if(!empty($article_data[0]->art_cover) ||
								!empty($article_data[0]->art_menuscript) ||
								!empty($article_data[0]->art_figure) ||
								!empty($article_data[0]->art_slide) ||
								!empty($article_data[0]->art_supple) ||
								!empty($article_data[0]->art_response)
								){?>
							<h3>File Attached</h3>
							<?php }?>
							<p><?php if(!empty($article_data[0]->art_cover)){?>
								<a target="_blank"  href="<?php echo base_url().'upload/article/author-'.$article_data[0]->art_userid.'/'.$article_data[0]->art_cover; ?>" > Cover letter</a>
								<?php } ?>
							</p>
							
							<p><?php if(!empty($article_data[0]->art_menuscript)){?>
								<a target="_blank"  href="<?php echo base_url().'upload/article/author-'.$article_data[0]->art_userid.'/'.$article_data[0]->art_menuscript;?>">Manuscript</a>
								<?php } ?>
							</p>
							<p><?php if(!empty($article_data[0]->art_figure)){?>
								<a target="_blank"  href="<?php echo base_url().'upload/article/author-'.$article_data[0]->art_userid.'/'.$article_data[0]->art_figure; ?>" > Fighre & Table</a>
								<?php } ?>
							</p>			
							<p><?php if(!empty($article_data[0]->art_slide)){?>
								<a target="_blank"  href="<?php echo base_url().'upload/article/author-'.$article_data[0]->art_userid.'/'.$article_data[0]->art_slide; ?>" > Powerpoint Slide</a>
								<?php } ?>
							</p>			
							<p><?php if(!empty($article_data[0]->art_supple)){?>
								<a target="_blank"  href="<?php echo base_url().'upload/article/author-'.$article_data[0]->art_userid.'/'.$article_data[0]->art_supple; ?>" >Supplementary</a>
								<?php } ?>
							</p>			
							<p><?php if(!empty($article_data[0]->art_response)){?>
								<a target="_blank"  href="<?php echo base_url().'upload/article/author-'.$article_data[0]->art_userid.'/'.$article_data[0]->art_response; ?>" >  Response to Reviewer</a>
								<?php } ?>
							
							</p>
						</div>
                        <div class="tab-pane fade" id="tab2primary">Review</div>
                        <div class="tab-pane fade" id="tab3primary">Proof</div>
                    </div>
                </div>
            </div>
        </div>
        </div>
		
        
        <div class="new-feed-cls">
    <div class="col-md-12">
    	
        
    	<div class="authr-nwsfeed-box">
        	<div class="au-nwsfeed-hed">
				<h1>Newsfeed</h1>
            </div>     
			
			
			<?php 
			$setting_data = $this->user_model->get_row_with_con('tbl_admin',array('id'=>'1'));
			if(!empty($all_message)){
				
					foreach($all_message as $msg_list)
					{
						$src1 = 'design/front/images/notification.jpg';
						
						if($msg_list->art_status!='2')
						{			
							 if( ($msg_list->from_type=='E') && (!empty($setting_data->editor_image))){
							 $src1 = 'upload/slider/'.$setting_data->editor_image;
							 }
							 if( ($msg_list->from_type=='P') && (!empty($setting_data->publish_image))){
							 $src1 = 'upload/slider/'.$setting_data->publish_image;
							 }
							 if( ($msg_list->from_type=='A') && (!empty($setting_data->author_image))){
							 $src1 = 'upload/slider/'.$setting_data->author_image;
							 }		
					?>
						<div class="au-nwsfeed-box">
							<div class="authr-nwsfeed-left">
							<img src="<?php echo base_url().$src1;?>">
						</div>
							<div class="authr-dshbrd-right">
										  
								<p><?php echo $msg_list->message;?></p>
								<?php if(!empty($msg_list->proof_file)){?>
					<p> <a target="_blank"  href="<?php echo base_url().$msg_list->proof_file;?>">Manuscript</a></p>
					<?php }?>
								
							</div>
						</div>
					<?php
						}
						elseif( ($msg_list->art_status=='2') && ($msg_list->id==$assign_art->asign_msgid) )
						{		
						
							if( !empty($setting_data->review_image)){
								 $src1 = 'upload/slider/'.$setting_data->review_image;
							 }
							 
							if($assign_art->asign_status=='0')
							{
							?>
								<div class="au-nwsfeed-box">
							<div class="authr-nwsfeed-left">
							<img src="<?php echo base_url().$src1;?>">
						</div>
							<div class="authr-dshbrd-right">
										  
								<p>
									<?php echo $article_data[0]->user_fname.'&nbsp;'.$article_data[0]->user_lname;?> 
									invite you to review his manuscript in <Lean Corrosion>. If you are willing to review this manuscript in 10 days, you can click the button of "Agree to Review".
								</p>
								<div class="feed-box-btn">								
								<a href="#" onclick="choos_status('1');">Agree to review</a>
							</div>
							<div class="feed-box-btn">
							
								
								<a href="#" onclick="choos_status('2');">Reject to review</a>
							</div>
								
							</div>
					
						
						</div>
							<?php
							}
							elseif( ($assign_art->asign_status=='1') && ($assign_art->assign_submit=='0') )
							{
								
					?>
							<div class="au-nwsfeed-box">
							<div class="authr-nwsfeed-left">
							<img src="<?php echo base_url().$src1;?>">
						</div>
							<div class="authr-dshbrd-right">
										  
								<p>
									You are agree to review this manuscript. Please submit your review report furtur 10days.   
								</p>
								<div class="feed-box-btn">								
								<a href="<?php echo base_url().'submit-review/'.$assign_art->asgin_id;?>">Submit Review report</a>
							</div>
							
								
							</div>
					
						
						</div>
					<?php
							}
							elseif( ($assign_art->asign_status=='1') && ($assign_art->assign_submit=='1') )
							{
								
							$reviewer_review=$this->user_model->get_row_with_con('tbl_submit_review',
											array('sr_userid'=>$this->session->userdata( 'userid' ),
													'sr_artid'=>$assign_art->asign_artid,
													'sr_assignid'=>$assign_art->asgin_id));	
								
								
					?>
							<div class="au-nwsfeed-box">
							<div class="authr-nwsfeed-left">
							<img src="<?php echo base_url().$src1;?>">
						</div>
							<div class="authr-dshbrd-right">
								<div class="feed-box-btn">								
								<a href="#"><?php echo $reviewer_review->sr_status;?></a>
							</div>
							<div class="feed-box-btn">	
							<?php $title_s = 'No'; if($reviewer_review->sr_quality)	{$title_s = 'Yes'; } ?>
								<a href="#"><?php echo $title_s ;?></a>
							</div>
									<br /><br />  
								<p>
									<?php echo $reviewer_review->sr_report ;?>
								</p>
								
							
								
							</div>
					
						
						</div>
					<?php
							}
							elseif($assign_art->asign_status=='2')
							{
							?>
							<div class="au-nwsfeed-box">
							<div class="authr-nwsfeed-left">
							<img src="<?php echo base_url().$src1;?>">
						</div>
							<div class="authr-dshbrd-right">
										  
								<p>
									Manuscript is reject for review 
								</p>
								
							<div class="feed-box-btn">
							
								
								<a href="#">Reject by reviewer</a>
							</div>
								
							</div>
					
						
						</div>
							<?php
							}
						}
					}
			}
			
			?>
			<?php if($article_data[0]->art_status>0) {?>
			<?php
					$src = '';
				 if(empty($setting_data->author_image)){$src = 'design/front/images/notification.jpg';}else
				 $src = 'upload/slider/'.$setting_data->author_image;
				 ?>
            	<div class="au-nwsfeed-box">
        		<div class="authr-nwsfeed-left">
            	<img src="<?php echo base_url().$src;?>">
            </div>
            	<div class="authr-dshbrd-right">
            	              
                	<p>Your mainscript send to editorto be checked. The proces takes 1-2days and your will be informed once the manuscript status is updated.</p>
                    
            </div>
            </div>
			<?php }?>
        </div>
     
     </div>
    </div>
        
        </div>
      </div>
    </div>
	
	<script>
	function choos_status(choose_val)
	{
		var art_id = '<?php echo $article_data[0]->art_id?>';
		var asign_id = '<?php echo $assign_art->asgin_id?>';
	
	
		if(choose_val==1){
		var r= confirm('Are you sure you Agree for review on this article?');
		}	
		if(choose_val==2){
		var r= confirm('Are you sure you Reject this article?');
		}		
		
		if( r==true ){
		
				data = 'asgin_id='+asign_id+'&asign_artid='+art_id+'&asign_status='+choose_val;
				url =  "<?php echo base_url()?>reviewer/upadte_status";
				$.ajax({
					   type: "POST",
					   url: url,
					   data: data,
					   dataType: 'html',
					   success: function(msg)
					   {
							location.reload(true);
					   }
				});
		}
	}
	</script>