<script language="javascript">
function submit_frm( val_act)
{
	if(val_act=='Yes')
	{
		document.getElementById("email_frm").submit();
	}
	else
	{
		window.location.href = '<?php echo base_url().'user-dashboard'?>'; 
	}
}
</script>
<div class="main_content">
      <div class="container">
        <div class="row">
        
	<?php $this->load->view('editor/editor_header.php') ?>
        
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
					<?php echo $article_data[0]->user_fname.'&nbsp;'.$article_data[0]->user_lname.';';
					
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
                    	<a href="#"><?php if(($article_data[0]->art_status==6)){ echo 'In Review';}
						 
						  if(($article_data[0]->art_status=='9')){ echo 'Resubmit Manuscript';}
						?></a>
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
				<h1></h1>
            </div>  
            	<div class="au-nwsfeed-box">
        		<div class="authr-nwsfeed-left">&nbsp;</div>
            	<div class="authr-dshbrd-right">
            	     <form  name="email_frm" id="email_frm" method="post" action="<?php echo  base_url().'editor/assign_publisher_action';?>">
					 <input type="hidden" name="art_id" id="art_id" value="<?php echo $article_data[0]->art_id;?>" />
					 	
						<p><textarea name="art_message" id="art_message"  class="form-control"  readonly="readonly">Do you accept the final manuscript and send the revised manuscript to publisher for publish?</textarea></p>						
						<p > <br />
						<input type="button" name="submit_msg" value="Yes" onclick="submit_frm(this.value);"  /> 
						
						<input type="button" name="submit_msg" value="Cancel" onclick="submit_frm(this.value);" />
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