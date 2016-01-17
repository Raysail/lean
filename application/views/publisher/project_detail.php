<div class="main_content">
      <div class="container">
        <div class="row">
        
	<?php $this->load->view('publisher/publisher_header.php') ?>
        
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
						<?php if(($article_data[0]->art_status==1)||($article_data[0]->art_status==3)){ echo 'In Submission';}
						if(($article_data[0]->art_status==2)||($article_data[0]->art_status==5)||($article_data[0]->art_status==6)){ echo 'In Review';}
						if(($article_data[0]->art_status==4) ||($article_data[0]->art_status==8)){ echo 'Declined';}
						
						if(($article_data[0]->art_status==10)||($article_data[0]->art_status==11)||($article_data[0]->art_status==12)){ echo 'In Proof';}
							if(($article_data[0]->art_status==13)||($article_data[0]->art_status==14)){ echo 'Proof Complete';}
							
						  if(($article_data[0]->art_status==7)){ echo 'In Revision';}
						  if(($article_data[0]->art_status==9)){ echo 'Resubmit Manuscript';}
						  
						  if(($article_data[0]->art_status==15)){ echo 'Published';}
						?></a>
                    </div>
                    <div class="authr-tyt-date">
                    	<span><?php if($article_data[0]->art_status==4){ echo $article_data[0]->art_update;}
									else{	echo $article_data[0]->art_dateadd; }?>
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
						if($msg_list->art_status=='2')
						{
							 if( !empty($setting_data->review_image)){
								 $src1 = 'upload/slider/'.$setting_data->review_image;
							 }
						
							$select_filed = 'a.*,u.*';	
							$tbl_name= 'tbl_submit_review as  a ';	
							$where_condition = array('a.sr_artid'=>$msg_list->art_id,'ar.asign_status = '=>'1','ar.asign_msgid'=> $msg_list->id);
							$order_by_field = 'a.sr_id';
							$order_by_type ='desc';
							$group_by_field = 'a.sr_id';
							$join_tbl1 = 'tbl_users as u'; 
							$join_type1 = 'left'; 
							$join_condition1 = 'u.user_id=a.sr_userid';
							$join_tbl2 = 'tbl_assgin_reviewer as ar'; 
							$join_type2 = 'left'; 
							$join_condition2 = 'ar.asgin_id=a.sr_assignid';
								
							
								$reviewer_reivew = $this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field, $join_tbl1, $join_type1, $join_condition1,$join_tbl2,  $join_condition2,$join_type2);
				
										
										
										
						
						
							$select_filed = 'a.*,u.*';	
							$tbl_name= 'tbl_assgin_reviewer as  a ';	
							$where_condition = array('a.asign_artid'=>$msg_list->art_id,'a.asign_status > '=>'0','a.asign_msgid'=> $msg_list->id);
							$order_by_field = 'a.asgin_id';
							$order_by_type ='desc';
							$group_by_field = 'a.asgin_id';
							$join_tbl1 = 'tbl_users as u'; 
							$join_type1 = 'left'; 
							$join_condition1 = 'u.user_id=a.asign_userid';
								
							
								$reviewer_list = $this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field, $join_tbl1, $join_type1, $join_condition1);
				
				
							if(!empty($reviewer_reivew))
							{
								foreach($reviewer_reivew as $review_list)
								{
						?>
									<div class="au-nwsfeed-box">
										<div class="authr-nwsfeed-left">
											<img src="<?php echo base_url().$src1;?>">
										</div>
									<div class="authr-dshbrd-right">
										<div class="feed-box-btn">								
										<a href="#"><?php echo $review_list->sr_status;?></a>
									</div>
									<div class="feed-box-btn">	
									<?php $title_s = 'No'; if($review_list->sr_quality)	{$title_s = 'Yes'; } ?>
										<a href="#"><?php echo $title_s ;?></a>
									</div>
											<br /><br />  
										<p>
											<?php echo nl2br($review_list->sr_report) ;?>
										</p>
										<p>Reviewer Name: <?php echo $review_list->user_fname;?></p>
									
										
									</div>
							
								
								</div>
						<?php
								}
							}
							
							if(!empty($reviewer_list))
							{
								
								foreach($reviewer_list as $review_list)
								{
						?>
									<div class="au-nwsfeed-box">
										<div class="authr-nwsfeed-left">
											<img src="<?php echo base_url().$src1;?>">
										</div>
									<div class="authr-dshbrd-right">										
									<div class="feed-box-btn">	
									<?php $title_s = 'Reject'; if($review_list->asign_status==1)	{$title_s = 'Accept'; } ?>
										<a href="#"><?php echo $title_s ;?></a>
									</div>
										<p>&nbsp;the Manuscript for review.</p>
											<br /><br />  
										<p>Reviewer Name: <?php echo $review_list->user_fname;?></p>
									
										
									</div>
							
								
								</div>
						<?php
								}
							
							}
						}
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
            	              
                	<p><?php echo nl2br($msg_list->message);?> </p>
					
					<?php if(!empty($msg_list->proof_file)){?>
					<p><a target="_blank"  href="<?php echo base_url().$msg_list->proof_file;?>">Attached File</a><br /><br /></p>
					<?php }?>
					
                	
					<?php if( ($article_data[0]->art_status=='11') && ($msg_list->from_type=='A') && ($msg_list->again_send==0) )	{?>
							<div class="feed-box-btn">
								<form name="msg_send" id="mes_send_<?php echo $msg_list->id;?>" method="post" action="<?php echo base_url();?>proof-publisher-responce/<?php echo $article_data[0]->art_no;?>">
									<input type="hidden" name="msg_id" value="<?php echo $msg_list->id;?>" />
									<input type="hidden" name="art_no" value="<?php echo $article_data[0]->art_no;;?>" />
								</form>
								
								<a href="#" onclick="meg_submit('mes_send_<?php echo $msg_list->id;?>');">Again Send Proof </a>
							</div>
								<?php }?>	
								
					<?php if( ($article_data[0]->art_status=='12') &&  ($msg_list->art_status=='12') && ($msg_list->from_type=='A') && ($msg_list->again_send==0) )	{?>
							<div class="feed-box-btn">
								<form name="msg_send" id="mes_send_<?php echo $msg_list->id;?>" method="post" action="<?php echo base_url();?>sentby-publisher/<?php echo $article_data[0]->art_no;?>">
									<input type="hidden" name="msg_id" value="<?php echo $msg_list->id;?>" />
									<input type="hidden" name="art_no" value="<?php echo $article_data[0]->art_no;;?>" />
								
								</form>
								
								<a href="#" onclick="meg_submit('mes_send_<?php echo $msg_list->id;?>');">Send Message</a>
							</div>
								<?php }?>	
                    
            </div>
            </div>
					<?php
					}
			}
			
			?>
			<?php if($article_data[0]->art_status>0){?>
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
	function meg_submit(frm_name)
	{
		
		document.getElementById(frm_name).submit();
	}
	</script>