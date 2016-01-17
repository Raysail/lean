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
                <h1>GET MORE PROJECTS  LIKE THIS <br>
                  <span class="right_col">IN YOUR INBOX!</span></h1>
                <p>Sign up for our daily email and get the PROJECTS everyone is talking about.</p>
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
		  	<?php if(!empty($fund_list)){
				foreach($fund_list as $f_list){
				
					$status ='';
				if($f_list->fund_status=='1')	{$status ='Open';}
				if($f_list->fund_status=='2')	{$status ='Evaluation';}
				if($f_list->fund_status=='3')	{$status ='Awarded';}
				if($f_list->fund_status=='4')	{$status ='Close';}
					
				$bin = decbin($f_list->fund_id);
				$bin = substr("00000000",0,8 - strlen($bin)).$bin;
			?>
				<div class="col-md-4">
              <div class="cont_sec_one"> <a href="<?php echo base_url().'funding-detail/'.$bin;?>"><img src="<?php echo base_url().'upload/fund/'.$f_list->fund_coverpic; ?>"><div class="fnd-img-toppr"><span><?php echo $status;?></span>
			  </div> </a>
                <p ><?php echo $f_list->fund_title;?></p><!--class="cont_text"-->
                <p style="text-align:left;"> <span class="fnd-btn-shw">Reward</span> <?php echo $f_list->fund_reward;?>USD <br /></p>
                <p style="text-align:left;"> <span class="fnd-btn-shw">Deadline</span> <?php echo date('M d Y',strtotime($f_list->fund_decline));?></p>
              </div>
            </div>
			<?php
				}
			 }?>
		  
          </div>
        </div>
      </div>
    </div>
	

	