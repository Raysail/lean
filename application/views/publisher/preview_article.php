<div class="main_content">
      <div class="container">
        <div class="row">		 		
	
			<?php $this->load->view('publisher/publisher_header.php') ?>
        </div>
      </div>
    </div>

    <div class="main_content">
      <div class="container"  style="text-align: left;">
        <div class="row">
          <div class="cont_article_sec">
            <div class="cont_article_sec_top">
              <div class="col-md-9">
                <div class="cont_article_sec_top_left">
                  <p class="article_h"><?php echo $art_data[0]->art_fulltitle;?></p>
                  <span class="left_article_text"><?php
						//$reviewer_name = $art_data[0]->user_fname.'&nbsp;'.$art_data[0]->user_lname.', ';
						$reviewer_name ='';
						if(!empty($other_author)){
							foreach($other_author as $other_author_list){								
								 $reviewer_name .= $other_author_list->oa_fname.'&nbsp;'.$other_author_list->oa_lname.', ';
							}
						$reviewer_name = rtrim($reviewer_name,', ');
							
							echo $reviewer_name;
						}?></span>
                  <p class="artical_stro"> <strong  class="artical_stro">Affiliation</strong>
				  	 <strong  class="artical_stro"><?php echo $art_data[0]->user_instiute;?></strong></p>
                  <p class="artice_tex_buttom">Lean Corrosion, <?php echo $art_data[0]->pub_year.','.$art_data[0]->pub_valume.','.$art_data[0]->pub_issue;?>:[DOI] <?php echo $art_data[0]->pub_DOI;?></p>
                    <span class="article_social">
                  <a href="#" class="fb_share"><i class="fa fa-facebook-square"></i> share on Facebook</a> 
                  <a href="#" class="wc_share"><i class="fa fa-wechat"></i> Wechat</a> 
                  <a href="#" class="tw_share"><i class="fa fa-twitter"></i> Tweet</a> 
                  <a href="#" class="qq_share"> <i class="fa fa-qq"></i> QQ</a> 
                  <a href="#" class="gp_share"><i class="fa fa-google-plus"></i> Google+</a> 
                  <a href="#" class="em_share"><i class="fa fa-envelope-o"></i> Email</a> 
                  
                  
                  </span> </div>
              </div>
              <div class="col-md-3">
                <div class="cont_article_sec_top_right">
                  <ul>
				  <?php if(!empty($art_data[0]->pub_pdf)){?>
                    <li> <a href="<?php echo base_url().'upload/publish/article-'.$art_data[0]->pub_artid.'/'.$art_data[0]->pub_pdf; ?>"> <i class="fa fa-file-archive-o article"></i> PDF (1321 kb)</a></li>
					 <?php }if(!empty($art_data[0]->pub_ppt)){?>					
                    <li><a href="<?php echo base_url().'upload/publish/article-'.$art_data[0]->pub_artid.'/'.$art_data[0]->pub_ppt; ?>"><i class="fa fa-file-powerpoint-o article"></i>  PPT Slide (1856 kb)</a></li>
					 <?php }?>
                    <li><a href="<?php echo base_url()?>article_fulltext/<?php echo $art_data[0]->pub_artid;?>"><i class="fa fa-html5 article"></i>  FULL TEXT HTML</a></li>
					 <?php if(!empty($art_data[0]->pub_cita)){?>
                    <li> <a href="<?php echo base_url().'upload/publish/article-'.$art_data[0]->pub_artid.'/'.$art_data[0]->pub_cita; ?>"><i class="fa fa-download article"></i> DOWNLOAD CITATION </a></li>
					 <?php } if(!empty($art_data[0]->pub_output)){?>
                    <li> <a href="<?php echo base_url().'upload/publish/article-'.$art_data[0]->pub_artid.'/'.$art_data[0]->pub_output; ?>"><i class="fa fa-file-text"></i>  Endnote output style </a></li>
                    <?php }?> 
                   
                  </ul>
                </div>
              </div>
            </div>
            <div class="cont_article_sec_two">
              <div class="col-md-9">
			  <?php if(!empty($art_data[0]->pub_cover)){?>
                <div class="cont_article_sec_two_left">
				 <img src="<?php echo base_url().'upload/publish/article-'.$art_data[0]->pub_artid.'/'.$art_data[0]->pub_cover; ?>"> </div>
				 <?php }?>
				<div class="cont_article_sec_three_left">
                  <p><?php echo $art_data[0]->pub_abstract;?></p>
                  
                  
                  <span class="article_social">
                  <a href="#" class="fb_share"><i class="fa fa-facebook-square"></i> share on Facebook</a> 
                  <a href="#" class="wc_share"><i class="fa fa-wechat"></i> Wechat</a> 
                  <a href="#" class="tw_share"><i class="fa fa-twitter"></i> Tweet</a> 
                  <a href="#" class="qq_share"> <i class="fa fa-qq"></i> QQ</a> 
                  <a href="#" class="gp_share"><i class="fa fa-google-plus"></i> Google+</a> 
                  <a href="#" class="em_share"><i class="fa fa-envelope-o"></i> Email</a> 
                  
                  
                  </span> </div>
              </div>
              <div class="col-md-3">
			  	<?php if(!empty($must_see)){	
					$i=0;
					foreach($must_see as $must_list){?>
						<div class="cont_article_sec_three_right">
						<?php if($i==0){?>
                  <h3>Must See Research in Lean Corrosion</h3>
				  <?php }?>
                  <img src="<?php echo base_url().'upload/publish/article-'.$must_list->pub_artid.'/'.$must_list->pub_cover; ?>"> <!-- width="399px" height="250px;"-->
                  <p><?php echo  word_limiter($must_list->art_fulltitle, 30);?> </p>
                </div>
			  	<?php
					$i++;
					}
				 }?>
              </div>
            </div>
    
			<?php if(!empty($res_art)){ ?>
            <div class="cont_article_sec_four">
              <div class="col-md-12">
                <div class="cont_article_sec_four_left">
                  <h1>Researches And Articles your May Like</h1>
				  <?php foreach($res_art as $res_art_list){?>
				  <div class="col-md-3">
                    <div class="cont_article_sec_four_one"> 
					
						<?php if(!empty($res_art_list->res_image)){?>
						<img src="<?php echo base_url().'upload/publish/article-'.$res_art_list->res_artid.'/'.$res_art_list->res_image; ?>">
							<?php }?>
                      <p><?php echo $res_art_list->res_title;?></p>
                      <p class="bottom_blue"><a href="<?php echo $res_art_list->res_url;?>" target="_blank"><?php echo $res_art_list->res_journal;?></a></p>
                    </div>
                  </div>
				  <?php }?>
                </div>
              </div>
              
            </div>
			<?php }?>
          </div>
        </div>
      </div>
    </div>
    	
	 <div class="main_content">
      <div class="container">
        <div class="row">
          <div class="cont_article_sec">
            <div class="cont_article_sec_top">
              <div class="col-md-9">
                <div class="cont_article_sec_top_left">
                    <span class="article_social">
                 	 <a href="#" data-artid="<?php echo $art_data[0]->pub_artid;?>" class="gp_share" id="final_publish">Publish Article</a>           
                 	 </span> 
				 </div>
              </div>
			</div>
		  </div>
		 </div>
		</div>
	  </div>
	  
	  		
<script>		

$(document).on('click', '#final_publish', function(event){

var r= confirm('Are you sure you want to final publish this article?');
	if( r==true ){
	
		var art_id = $(this).attr('data-artid');
		
		var data = "art_id="+art_id;
	    var url =  "<?php echo base_url()?>publisher/publish_final_article";
		  $.post( url, data, function( result ) {
		 	 window.location.href="<?php echo base_url()?>user-dashboard"; 
		});
	}
});
</script>