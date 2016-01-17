 <div class="main_content">
    <div class="container">
    <div class="row">
	
	<?php $this->load->view('reviewer/reviewer_header.php') ?>
		
		<div class="wlcm-user-dtl">
		
			<?php if($this->session->flashdata('error')){echo '<div class="alert alert-danger" role="alert">'.$this->session->flashdata('error').'</div>' ;} ?>
        	<?php if($this->session->flashdata('success')){echo  '<div class="alert alert-success" role="alert">'.$this->session->flashdata('success').'</div>';} ?>
			
			
		 <?php if(!empty($pro_listing)){
			 	foreach($pro_listing as $pro_list){
				$author_data = $this->user_model->get_row_with_con('tbl_users',array('user_id'=>$pro_list->art_userid));
				
				$count_message = 0;
				$where_message = '(art_id="'.$pro_list->art_id.'")';
				$count_message  = $this->user_model->check_no_rec('tbl_article_message',$where_message);
				
			 ?>
        	<div class="col-md-4">
            	<div class="wlcm-usr-div">
				
					<?php if($count_message>0){?>
                	<div class="short-tip">
                    	<span><?php echo $count_message;?></span>
                    </div>
					<?php }?>
                	<div class="wlcm-row1">
                		<div class="sbmsn-btn">
                        	<div class="sbmsn-box">
                            	<a href="#"><?php 
								  if( ($pro_list->art_status==2)||($pro_list->art_status==5)||($pro_list->art_status==6)){ echo 'In Review';}
								  if( ($pro_list->art_status==10)||($pro_list->art_status==11)||($pro_list->art_status==12)){ echo 'In Proof';}
								  
								  if( ($pro_list->art_status==13)||($pro_list->art_status==14)){ echo 'In Proof Completion';}
								  
								  if( ($pro_list->art_status==7)){ echo 'In Revision';}
								  
						  if(($pro_list->art_status==15)){ echo 'Publish';}
								  if(($pro_list->art_status==4)||($pro_list->art_status==8)){ echo 'Declined';}?></a>
								  
                            </div>
                        </div>
						<?php if($pro_list->art_status==4){ ?>
                    	<div class="on-off-btn">
                        	<label class="switch switch-green">
                              <input type="checkbox" class="switch-input" checked>
                              <span class="switch-label" data-on="On" data-off="Off"></span>
                              <span class="switch-handle"></span>
                            </label>
                        </div>
						<?php }?>
                	</div>
                    
                    <div class="wlcm-txt-box">
                       	<p> <?php echo word_limiter($pro_list->art_fulltitle,10);?></p>
                    </div>
                    
                    <div class="wlcm-row3">
                    	<div class="wlcm-prl-img">
						<?php  $src ='';
						if(!empty($pro_list->art_scheme)){ $src ='upload/article/author-'.$pro_list->art_userid.'/'.$pro_list->art_scheme; }else { $src ='design/front/images/tab_img.jpg';}?>
							 
                        	<img src="<?php echo base_url().$src;?>">
                        </div>
                        <div class="wlcm-prl-name">
                        	<!--<p><?php //echo $author_data->user_fname.'&nbsp;'.$author_data->user_lname;?></p>-->
							<?php
							$other_author=$this->user_model->select_query('*','tbl_other_author',array(
																'oa_art_id'=>$pro_list->art_id,
																'oa_userid'=>$pro_list->art_userid
																),'oa_order','asc');
																
								if(!empty($other_author))
								{	
									foreach($other_author as $author_list)
									{
										echo '<p>'.$author_list->oa_fname.'&nbsp;'.$author_list->oa_lname.'</p>';
									}
								}
							?>
                            <span> <?php echo $pro_list->art_dateadd;?></span>
                        </div>
                    </div>
                    
                    <div class="wlcm-row4">
                    	<a href="<?php echo base_url().'reviewer_view_project/'.$pro_list->art_no;?>"> View Project</a>
                    </div>
                </div>
            </div>
			<?php }
				}
			?>
        </div>
		
     
    </div>
    </div>
    </div>