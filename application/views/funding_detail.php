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
	$main_ad_image= base_url().'upload/fund/'.$art_data[0]->fund_coverpic;
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
          <div class="col-md-12">
            <div class="cont_article_sec_top_left">
              <p class="article_h"><?php echo $art_data[0]->fund_title;?></p>
            </div>
          </div>
          <div class="col-md-12">
            <div class="cont_article_sec_top_left">
              <div class="col-md-6">
              	<div class="fndg-left-sec">
                <?php if(!empty($art_data[0]->fund_coverpic)){?>
                <div class="cont_article_sec_two_left"> <img src="<?php echo base_url().'upload/fund/'.$art_data[0]->fund_coverpic; ?>" width="200px" height="250px"> </div>
                <?php }?>
                </div>
                 <div class="fndg-scl-btn"> <span class="article_social"> <a href="#"  id="share_button" class="fb_share"><i class="fa fa-facebook-square"></i> share on Facebook</a>
                <input type="hidden" name="desc" value="<?php echo $art_data[0]->fund_title; ?>" id="desc" />
                <input type="hidden" name="simg" value="<?php echo $main_ad_image; ?>" id="simg" />
                <input type="hidden" name="stitle" value="<?php echo $art_data[0]->fund_title; ?>" id="stitle" />
                <a href="#" class="wc_share"><i class="fa fa-wechat"></i> Wechat</a> <a href="#" onclick="fbs_click();" class="tw_share"><i class="fa fa-twitter"></i> Tweet</a> 
                <script type="text/javascript">
function qqs_click() {    
    var twtLink = 'http://v.t.qq.com/share/share.php?url=<?php echo $url; ?>&title=<?php echo urlencode($art_data[0]->fund_title); ?>';
    window.open(twtLink);
}
</script> 
                <a href="#"  onclick="qqs_click();"  class="qq_share"> <i class="fa fa-qq"></i> QQ</a> <a  href="https://plus.google.com/share?url=<?php echo $url;?>" title="google+" class="gp_share"><i class="fa fa-google-plus"></i> Google+</a> 
                <!--<a href="#" class="em_share"><i class="fa fa-envelope-o"></i> Email</a> --> 
                
                </span></div> 
              </div>
              <div class="col-md-6">
              	<div class="fndg-right-sec">
                <div class="fndg-right-dtl">
				 <span  class="fnd-blok-left">
				 <img src="<?php echo base_url();?>design/front/images/fnd-rite.png" /><?php echo $art_data[0]->fund_country;?></span>
				<span class="fnd-blok-left"><img src="<?php echo base_url();?>design/front/images/fnd-left.png" /><?php echo $total_applicant;?></span>
				 </div>
                <div class="fndg-right-price">$<?php echo $art_data[0]->fund_reward;?> </div>
                <div class="fndg-right-btn">
                <form name="fund_proposal" id="fund_proposal" method="post" action="<?php echo base_url();?>funding-application">
                  <input type="hidden" name="fund_id" id="fund_id" value="<?php echo $art_data[0]->fund_id;?>" />
                  <button type="submit" name="submit_proposal">Submit your proposal </button>
                </form>
                </div>
                </div>
                 <div class="fndg-mng-dtl">
                <p class="artice_tex_buttom">ID: <?php echo $art_data[0]->fund_customID;?>&nbsp; Posted<?php echo date('m-d-Y',strtotime($art_data[0]->fund_posted));?>&nbsp; Deadline<?php echo date('m-d-Y',strtotime($art_data[0]->fund_decline));?></p>
              </div>
              </div>
            </div>
          </div>
          
        </div>
        <div class="cont_article_sec_two">
          <div class="col-md-12">
            <div class="cont_article_sec_three_left">
              <p><?php echo $art_data[0]->fund_info;?></p>
            </div>
          </div>
        </div>
        <?php if(!empty($open_found)){ ?>
        <div class="cont_article_sec_four">
          <div class="col-md-12">
            <div class="cont_article_sec_four_left">
              <h1>Founding your May Be Interested</h1>
              <?php foreach($open_found as $open_list){
				$bin = decbin($open_list->fund_id);
				$bin = substr("00000000",0,8 - strlen($bin)).$bin;
				  
				  
				  	
					$status ='';
				if($open_list->fund_status=='1')	{$status ='Open';}
				if($open_list->fund_status=='2')	{$status ='Evaluation';}
				if($open_list->fund_status=='3')	{$status ='Awarded';}
				if($open_list->fund_status=='4')	{$status ='Close';}
				
				
				  ?>
              <div class="col-md-3">
                <div class="cont_article_sec_four_one">
                  <?php if(!empty($open_list->fund_coverpic)){?>
                  <a href="<?php echo base_url().'funding-detail/'.$bin;?>" target="_blank"><img src="<?php echo base_url().'upload/fund/'.$open_list->fund_coverpic; ?>"> <div class="fnd-img-toppr"><span><?php echo $status;?></span></div> </a>
                  <?php }?>
                  <p><?php echo $open_list->fund_title;?></p>
                  <p class="bottom_blue"> <span class="fnd-btn-shw">Reward</span> <?php echo $open_list->fund_reward;?>USD <br />
                  </p>
                  <p class="bottom_blue"><span class="fnd-btn-shw">Deadline</span>  <?php echo date('M d Y',strtotime($open_list->fund_decline));?></p>
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
