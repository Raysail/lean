<script language="javascript">
jQuery(function($) {
	  $('#email_frm').validate();
});
</script>
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
								echo $author_list->oa_fname.'&nbsp;'.$author_list->oa_lname.';';
							}
						}
					?>
					
					
					
					</p>
                </div>
                <div class="authr-dsbrd-btn">
                	<div class="sbmsn-box">
                    	<a href="#"><?php if(($article_data[0]->art_status==10)||($article_data[0]->art_status==11)||($article_data[0]->art_status==12)){ echo 'In Proof';}?></a>
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
				<h1> </h1>
            </div>  
            	<div class="au-nwsfeed-box">
        		<div class="authr-nwsfeed-left">&nbsp;</div>
            	<div class="authr-dshbrd-right">
            	     <form  name="email_frm" id="email_frm" method="post" action="<?php echo  base_url()?>publisher/completby_publisher_action">
					 	<input type="hidden" name="art_id" id="art_id" value="<?php echo $article_data[0]->art_id;?>" />
						<input type="hidden" name="art_userid" id="art_userid" value="<?php echo $article_data[0]->art_userid;?>" />
						<input type="hidden" name="art_status" id="art_status" value="13" />
						<p>
							Dear Publisher<br />
							Do you finish the check of manuscript's proof? If you complete it, please click "Yes"; If you don't finish it, you can cancel.
						</p>
						<input type="submit" name="submit_msg" value="Yes"  /> 
						<input type="button" name="cancle_btn" value="Cancel" onclick="chose_option()" />
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
	
	<script>
function chose_option()
{
	window.location='<?php echo base_url().'/user-dashboard'?>';
}
</script>	