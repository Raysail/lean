<script>
jQuery(function($) {
      $('#login_frm').validate();
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
			
                            <form  action="<?php echo  base_url();?>general_login/reset_password" method="post" autocomplete="on" name="login_frm" id="login_frm"> 
                                <h3>Fotgotten Password</h3> 	
								<h1></h1>		
                                <p> 
                                    <label for="username" class="uname" data-icon="u"> Your email</label>
                                    <input name="user_email" id="user_email" type="text" placeholder=" mymail@mail.com" value="" required="required"/>
                                </p>                               
                                <p> 
                                    <input type="submit" class="action-button" value="Sent Request" /> 
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