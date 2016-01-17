<script type="text/javascript">
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '411711492357688',
      xfbml      : true,
      version    : 'v2.4'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));


</script>
  
<?php 
	$url	= "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$url1	= "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$text	= 'check this link for get best home';
	
	$url=str_replace('https','http',$url); 
	$image	= $url.'design/front/images/logo.png';
	$main_ad_image= base_url().'upload/publish/article-'.$art_data[0]->pub_artid.'/'.$art_data[0]->pub_cover;
?>
<script type="text/javascript">
                                    $(document).ready(function () {
                                        $('#share_button').click(function (e) {
                                            var desc = $("#desc").val();
                                            var imge = $("#simg").val();
                                            var sti = $("#stitle").val();
                                            e.preventDefault();
                                            FB.ui(
                                                    {
                                                        method: 'feed',
                                                        name: sti,
                                                        link: '<?php echo $url?>',
                                                        picture: imge,
                                                        description: desc,
                                                        message: ''
                                                    });
                                        });
                                    });
                                </script>		
<script type="text/javascript">
function fbs_click() {
    var twtTitle = $("#stitle").val();//document.title;
    var twtUrl = location.href;
    var maxLength = 140 - (twtUrl.length + 1);
    if (twtTitle.length > maxLength) {
        twtTitle = twtTitle.substr(0, (maxLength - 3)) + '...';
    }
    var twtLink = 'http://twitter.com/home?status=' + encodeURIComponent(twtTitle + ' ' + twtUrl);
    window.open(twtLink);
}
</script>  	
<div class="main_content">
      <div class="container" style="text-align:left;">
        <div class="row">
          <div class="cont_article_sec">
            <div class="cont_article_sec_top">
              <div class="col-md-12">
                <div class="cont_article_sec_top_left">
                  <p class="article_h"><?php echo $art_data[0]->art_fulltitle;?></p>
                  <span class="left_article_text">
				  	<?php
					//$reviewer_name = $art_data[0]->user_fname.'&nbsp;'.$art_data[0]->user_lname.', ';
					$reviewer_name ='';
						if(!empty($other_author)){
							foreach($other_author as $other_author_list){								
								 $reviewer_name .= $other_author_list->oa_fname.'&nbsp;'.$other_author_list->oa_lname.', ';
							}
						$reviewer_name = rtrim($reviewer_name,', ');
							echo $reviewer_name;
						}?>
				  </span>
                  <p class="artical_stro"> <strong  class="artical_stro">Affiliation</strong> <strong  class="artical_stro"><?php echo $art_data[0]->user_instiute;?></strong></p>
                  <p class="artice_tex_buttom">Lean Corrosion, <?php echo $art_data[0]->pub_year.','.$art_data[0]->pub_valume.','.$art_data[0]->pub_issue;?>:[DOI] <?php echo $art_data[0]->pub_DOI;?></p>
                  <span class="article_social">
					
					
                  <a href="#"  id="share_button" class="fb_share"><i class="fa fa-facebook-square"></i> share on Facebook</a> 
				
				   <input type="hidden" name="desc" value="<?php echo $art_data[0]->art_fulltitle ?>" id="desc" />
                                <input type="hidden" name="simg" value="<?php echo $main_ad_image ?>" id="simg" />
                                <input type="hidden" name="stitle" value="<?php echo $art_data[0]->art_fulltitle ?>" id="stitle" />
                                
								
								
                  <a href="#" class="wc_share"><i class="fa fa-wechat"></i> Wechat</a> 
				  
				  
                  <a href="#" onclick="fbs_click();" class="tw_share"><i class="fa fa-twitter"></i> Tweet</a>
				  
				  <script type="text/javascript">
function qqs_click() {    
    var twtLink = 'http://v.t.qq.com/share/share.php?url=<?php echo $url; ?>&title=<?php echo urlencode($art_data[0]->art_fulltitle); ?>';
    window.open(twtLink);
}
</script>

                  <a href="#"  onclick="qqs_click();"  class="qq_share"> <i class="fa fa-qq"></i> QQ</a> 
				
						
                  <a  href="https://plus.google.com/share?url=<?php echo $url;?>" title="google+" class="gp_share"><i class="fa fa-google-plus"></i> Google+</a> 
                  <!--<a href="#" class="em_share"><i class="fa fa-envelope-o"></i> Email</a> -->
                  
                  
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
                        <?php if(!empty($art_data[0]->pub_cover)){?>
                       <img src="<?php echo base_url().'upload/publish/article-'.$art_data[0]->pub_artid.'/'.$art_data[0]->pub_cover; ?>">
					   <?php } ?>
                     
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