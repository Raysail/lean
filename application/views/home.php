<div class="main_content">
      <div class="container">
        <div class="row">
          <div class="main_banner">
            <div class="col-md-8">
              <div class="main_banner_left"> 
			  <?php $image_path = 'design/front/images/banner.jpg';
			  if(!empty($setting_data->banner_image)){
			  	$image_path = 'upload/slider/'.$setting_data->banner_image;}
			  ?>
			  <img src="<?php echo base_url().$image_path;?>">
               <!-- <p class="banner_text"> These Simple Tests Will Teach You So Much About Your Own Body</p>-->
              </div>
            </div>
            <div class="col-md-4">
              <div class="main_rightbar">
                <h1>GET MORE RESEARCHES LIKE THIS <br>
                  <span class="right_col">IN YOUR INBOX!</span></h1>
                <p>Sign up for our daily email and get the RESEARCHES everyone is talking about.</p>
				<form method="post" name="header_res_frm" id="header_res_frm">
                <div class="input-group right_search">		
					<input type="hidden" name="sub_for" value="1" />	 
                  <input type="email" class="form-control" name="research_header" placeholder="Email on ..." require="required">
                  <span class="input-group-btn">
                  	<button class="btn btn-default" id="header_res_btn" type="button">OK</button>
                  </span> 
				 </div>
				 <div id="header_res_msg" style="display:none; color:#fff;padding: 2%;">				 	
				 </div>
				 </form> 
              </div>
            </div>
          </div>
          <div class="cont_sec">
		  	<?php if(!empty($home_art_list)){
				foreach($home_art_list as $art_list){
			?>
				<div class="col-md-4">
              <div class="cont_sec_one"> <a href="<?php echo base_url().'article-detail/'.$art_list->art_no;?>"><img src="<?php echo base_url().'upload/publish/article-'.$art_list->pub_artid.'/'.$art_list->pub_cover; ?>"></a>
                <p class="cont_text"><?php echo $art_list->art_fulltitle;?></p>
              </div>
            </div>
			<?php
				}
			 }?>
		  
          </div>
        </div>
      </div>
    </div>
	

	