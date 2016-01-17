<script>
jQuery(function($) {
      $('#application_frm').validate();
});
</script>
<div class="main_content">
      <div class="container"  >
        <div class="row">
          <div class="cont_article_sec">
            <div class="cont_article_sec_top">
              <div class="col-md-12">
                <div class="cont_article_sec_top_left">
                  <p class="article_h"><?php echo $art_data[0]->fund_title;?></p>
				   <p class="artice_tex_buttom">ID: <?php echo $art_data[0]->fund_customID;?>&nbsp; Posted<?php echo date('m-d-Y',strtotime($art_data[0]->fund_posted));?>&nbsp; Deadline<?php echo date('m-d-Y',strtotime($art_data[0]->fund_decline));?></p>
				 </div>
              </div>     
			  <div class="col-md-12">			 
				<div class="cont_article_sec_top_left">
                	<div class="fndng-applicsn">
						 <form action="<?php base_url()?>funding/fund_application_action" method="post" name="application_frm" id="application_frm" enctype="multipart/form-data">
						 	<input type="hidden" name="app_fund_id" id="app_fund_id" value="<?php echo $art_data[0]->fund_id;?>" />
						 	<p> <label>Name :</label> <input type="text" name="app_name" id="app_name" value="" required="required" />  </p>	
							<p> <label> Email :</label> <input type="email" name="app_email" id="app_email" value="" required="required" />  </p>	
							<p>  <label>Address: </label><input type="text" name="app_address" id="app_address" value="" required="required" />  </p>
							<p>  <label>Proposal:</label> <input type="file" name="app_proposal" id="app_proposal" required="required" width="100px;" />  </p>
							
							<p>  <input type="submit" name="submit_application" id="submit_application" />  </p>
						 	
						 </form>
                     </div>
				  </div>
              </div>
            </div>            
          </div>
        </div>
      </div>
    </div>