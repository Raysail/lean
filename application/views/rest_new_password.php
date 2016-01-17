<script>
jQuery(function($) {
      $('#reset_frm').validate();
});
</script>
<div class="main_content">
      <div class="container">
        <div class="row">
       <div class="main_login_sec"> 
         <div class="col-md-12">		
                <div id="container_demo" >
                    <div id="wrapper">
                        <div id="login" class="animate form">
						
								<?php if($this->session->flashdata('error')){echo '<div class="alert alert-danger" role="alert">'.$this->session->flashdata('error').'</div>' ;} ?>
        	<?php if($this->session->flashdata('success')){echo  '<div class="alert alert-success" role="alert">'.$this->session->flashdata('success').'</div>';} ?>
			
                            <form  action="<?php echo  base_url();?>general_login/change_password" method="post" autocomplete="on" name="reset_frm" id="reset_frm"> 
							<input type="hidden" name="reset_key" id="reset_key" value="<?php echo $reset_key;?>" />
                                <h3><?php echo $title;?></h3> 	
								<h1></h1>		
                                <p> 
                                    <label for="username" class="uname" data-icon="u"> New Password</label>
                                    <input name="user_newpass" id="user_newpass" type="text" placeholder="New Password" value="" required="required"/>
                                </p>           	
                                <p> 
                                    <label for="username" class="uname" data-icon="u"> Confirm New email</label>
                                    <input name="user_cnewpass" id="user_cnewpass" type="text" placeholder="Confrim New Password" value="" equalTo="#user_newpass" required="required"/>
                                </p>                               
                                <p> 
                                    <input type="submit"class="action-button" name="submit" id="submit" value="Update"/> 
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