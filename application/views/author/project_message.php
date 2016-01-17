<script language="javascript">
jQuery(function($) {
	  $('#email_frm').validate();
});
</script>
<div class="main_content">
      <div class="container">
        <div class="row">
        
	<?php $this->load->view('author/author_header.php') ?>
        
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
								echo $author_list->oa_fname.'&nbsp;'.$author_list->oa_lname.';';
							}
						}
					?>
					
					
					
					</p>
                </div>
                <div class="authr-dsbrd-btn">
                	<div class="sbmsn-box">
                    	<a href="#"><?php if($article_data[0]->art_status==1){ echo 'In Submission';}
											if($article_data[0]->art_status==3){ echo 'In Submission';}
											if($article_data[0]->art_status==7){ echo 'In Revision';}
											if(($article_data[0]->art_status==7)||($article_data[0]->art_status==11)||($article_data[0]->art_status==12)){ echo 'In Proof';}?></a>
                    </div>
                    <div class="authr-tyt-date">
                    	<span><?php echo $article_data[0]->art_dateadd;?></span>
                    </div>
                </div>
            </div>
        </div>
        
        </div>
        
		
        
        <div class="new-feed-cls">
    <div class="col-md-12">
    	
        
    	<div class="authr-nwsfeed-box">
        	<div class="au-nwsfeed-hed">
				<h1><?php 
				
				
					$button_title ='';
					$url = '';
					$script_type = '';
					$script_type =$article_data[0]->art_status;
					$button_title ='Send Message to Editor';
					
					$url =  'article/editor_message_action' ;
					
					if($script_type=='11'){$button_title ='Response to Publisher';
					$url =  'article/proof_responce_box_action' ;
					}
					if($script_type=='12'){$button_title ='Send Message to Publisher';
					$url =  'article/proof_responce_box_action' ;
					}
					
				/*if($art_for=='decline'){ echo 'Declined Manuscript';$button_title ='Declined';$script_type ='declined';}
				if($art_for=='send-author'){ echo 'Manuscript Send back to author';$button_title ='Send back to author';$script_type ='back';}*/
				
				
				
				
				?> </h1>
            </div>  
            	<div class="au-nwsfeed-box">
        		<div class="authr-nwsfeed-left">&nbsp;</div>
            	<div class="authr-dshbrd-right">
				
            	     <form  name="email_frm" id="email_frm" method="post" enctype="multipart/form-data" action="<?php echo  base_url().$url;?>">
					 	<input type="hidden" name="msg_id" id="msg_id" value="<?php echo $msg_id;?>" />
					 	<input type="hidden" name="art_id" id="art_id" value="<?php echo $article_data[0]->art_id;?>" />
						<input type="hidden" name="art_userid" id="art_userid" value="<?php echo $article_data[0]->art_userid;?>"/>
						<input type="hidden" name="art_status" id="art_status" value="<?php echo $script_type;?>" />
					   <p><textarea name="art_message" id="art_message" class="form-control" required="required"></textarea></p>						
						<p >
						
						<?php 
							if($script_type=='11'){
							?>
							Atthachament Proof:
							<input type="file" name="att_proof" id="att_proof"  />
							<?php
							}
						?>	
						
						
						 <br />
						<input type="submit" name="sunmit_msg" value="<?php echo $button_title ;?>"  /> 
							</p>
					 </form>
                    
            </div>
            </div>
        </div>
     
     </div>
    </div>
        
        </div>
      </div>
    </div>