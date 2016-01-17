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
                  <p class="artice_tex_buttom">Lean Corrosion, <?php echo $art_data[0]->pub_year;?>,<?php echo $art_data[0]->pub_valume;?>,<?php echo $art_data[0]->pub_issue;?>:[DOI] <?php echo $art_data[0]->pub_DOI;?></p>
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
              <div class="col-md-3">
                <div class="cont_article_sec_top_right">
                  <ul>
				  <?php if(!empty($art_data[0]->pub_pdf)){?>
                    <li> <a href="<?php echo base_url().'upload/publish/article-'.$art_data[0]->pub_artid.'/'.$art_data[0]->pub_pdf; ?>"> <i class="fa fa-file-archive-o article"></i> PDF (1321 kb)</a></li>
					 <?php }if(!empty($art_data[0]->pub_ppt)){?>					
                    <li><a href="<?php echo base_url().'upload/publish/article-'.$art_data[0]->pub_artid.'/'.$art_data[0]->pub_ppt; ?>"><i class="fa fa-file-powerpoint-o article"></i>  PPT Slide (1856 kb)</a></li>
					 <?php }?>
                    <li><a href="<?php echo base_url()?>detail-fulltext/<?php echo $art_data[0]->art_no;?>"><i class="fa fa-html5 article"></i>  FULL TEXT HTML</a></li>
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
                  
                  
                  </span>
				  </div>
              </div>
              <div class="col-md-3">
                <?php if(!empty($must_see)){	
					$i=0;
					foreach($must_see as $must_list){?>
						<div class="cont_article_sec_three_right">
						<?php if($i==0){?>
                  <h3>Must See Research in Lean Corrosion</h3>
				  <?php }?>
                 <a href="<?php echo base_url().'article-detail/'.$must_list->art_no;?>"> <img src="<?php echo base_url().'upload/publish/article-'.$must_list->pub_artid.'/'.$must_list->pub_cover; ?>"></a> <!-- width="399px" height="250px;"-->
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
						<a href="<?php echo $res_art_list->res_url;?>" target="_blank"><img src="<?php echo base_url().'upload/publish/article-'.$res_art_list->res_artid.'/'.$res_art_list->res_image; ?>"></a>
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