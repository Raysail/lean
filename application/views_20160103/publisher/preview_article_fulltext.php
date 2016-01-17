<div class="main_content">
      <div class="container">
	     <div class="row">		 		
			<?php $this->load->view('publisher/publisher_header.php') ?>
        </div>
      </div>
    </div>   	
<div class="main_content">
      <div class="container" style="text-align:left;">
        <div class="row">
          <div class="cont_article_sec">
            <div class="cont_article_sec_top">
              <div class="col-md-12">
                <div class="cont_article_sec_top_left">
                  <p class="article_h"><?php echo $art_data[0]->art_fulltitle;?></p>
                  <span class="left_article_text"><?php
						//$reviewer_name = $art_data[0]->user_fname.'&nbsp;'.$art_data[0]->user_lname.', ';
						$reviewer_name = '';
						if(!empty($other_author)){
							foreach($other_author as $other_author_list){								
								 $reviewer_name .= $other_author_list->oa_fname.'&nbsp;'.$other_author_list->oa_lname.', ';
							}
						$reviewer_name = rtrim($reviewer_name,', ');
							
							echo $reviewer_name;
						}?></span>
                  <p class="artical_stro"> <strong  class="artical_stro">Affiliation</strong> <strong  class="artical_stro"><?php echo $art_data[0]->user_instiute;?></strong></p>
                  <p class="artice_tex_buttom">Lean Corrosion, <?php echo $art_data[0]->pub_year.','.$art_data[0]->pub_valume.','.$art_data[0]->pub_issue;?>:[DOI] <?php echo $art_data[0]->pub_DOI;?></p>
                  <span class="article_social"> <a href="#" class="fb_share"><i class="fa fa-facebook-square"></i> share on Facebook</a> <a href="#" class="wc_share"><i class="fa fa-wechat"></i> Wechat</a> <a href="#" class="tw_share"><i class="fa fa-twitter"></i> Tweet</a> <a href="#" class="qq_share"> <i class="fa fa-qq"></i> QQ</a> <a href="#" class="gp_share"><i class="fa fa-google-plus"></i> Google+</a> 
				  
				  </span> </div>
              </div>
              
            </div>
            <div class="cont_article_sec_two">
              
              
              <div class="main_full_page">
                
                
                <div id="parentVerticalTab">
                  <ul class="resp-tabs-list hor_1">
                    <li>Abstract</li>
					<?php if($art_data[0]->pub_paper=='Review_article_or_Correspondence'){?>
                    <li>Mainbody</li>
					<?php }else{?>
                    <li>Introduction</li>
                    <li>Experiment</li>
                    <li>Result & discussion</li>
					<?php }?>
                    <li>Conclusion</li>
                    <li>Acknowledge</li>
                    <li>Reference</li>
                    <li>Supplementary</li>
                  </ul>
                  <div class="resp-tabs-container hor_1">
                    
                    
                    <div>
                      <div class="fullpage_tab_one_sec">
                        
                       <img src="<?php echo base_url().'upload/publish/article-'.$art_data[0]->pub_artid.'/'.$art_data[0]->pub_ppt; ?>">
                     
                       <p><?php echo $art_data[0]->pub_abstract;?></p> 
                        
                      </div>
                    </div>
					
					<?php if($art_data[0]->pub_paper=='Review_article_or_Correspondence'){?>
					<div>
                      <div class="fullpage_tab_one_sec">
					    <p><?php echo $art_data[0]->pub_mainbody;?></p>                   
                      </div>
                    </div>
					<?php }else{?>
                    
                    <div>
                      <div class="fullpage_tab_one_sec">
					    <p><?php echo $art_data[0]->pub_intro;?></p>                   
                      </div>
                    </div>
                    
                    <div>
                      <div class="fullpage_tab_one_sec">                        
                          <p><?php echo $art_data[0]->pub_expri;?></p>
                      </div>
                      
                    </div>
                    
                    <div>
                      <div class="fullpage_tab_one_sec">
                            <p><?php echo $art_data[0]->pub_result;?></p>
                      </div>
                    </div>
                    
					<?php }?>
                    <div>
                      <div class="fullpage_tab_one_sec">
                        
                    <p><?php echo $art_data[0]->pub_concl;?></p>
                  
                      </div>
                    </div>
                    
                    <div>
                      <div class="fullpage_tab_one_sec">
                        
                    <p><?php echo $art_data[0]->pub_ack;?></p>
                  
                      </div>
                    </div>
                    
                    <div>
                      <div>
                        <div class="fullpage_tab_one_sec">
                   			 <p><?php echo $art_data[0]->pub_ref;?></p>
                        </div>
                      </div>
                    </div>
                    
                    <div>
                      <div class="fullpage_tab_one_sec">
                      
                            <p><?php echo $art_data[0]->pub_suply;?></p>
                        
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