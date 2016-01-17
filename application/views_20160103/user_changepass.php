<script>
jQuery(function($) {
      $('#cpass_frm').validate();
});
</script>
<div class="main_content">
      <div class="container">
        <div class="row">
       <div class="main_login_sec"> 
	   
	   
	   		<?php if($this->session->userdata('usertype')=='1'){
						$this->load->view('author/author_header.php');
					} if($this->session->userdata('usertype')=='2'){
						$this->load->view('editor/editor_header.php');
					}  if($this->session->userdata('usertype')=='3'){
						$this->load->view('reviewer/reviewer_header.php');
					}  if($this->session->userdata('usertype')=='4'){
						$this->load->view('publisher/publisher_header.php');
					} ?>
         <div class="col-md-12">		 		
                <div id="container_demo" >
                    <div id="wrapper">
                        <div id="" class="animate form">
						
		 			<h3 >Change Password</h3>
								<?php if($this->session->flashdata('error')){echo '<div class="alert alert-danger" role="alert">'.$this->session->flashdata('error').'</div>' ;} ?>
        	<?php if($this->session->flashdata('success')){echo  '<div class="alert alert-success" role="alert">'.$this->session->flashdata('success').'</div>';} ?>
			
                            <form action="<?php echo  base_url();?>user/update_password" method="post" autocomplete="on" name="cpass_frm" id="cpass_frm"> 			
							<p> 
								<label for="username" class="youpasswd" data-icon="p" style="color:#333 !important"> Old Password</label>
								<input name="user_passwords" id="user_passwords" type="password" required="required"/>
							</p>
							<p> 
								<label for="password" class="youpasswd" data-icon="p" style="color:#333 !important"> New password </label>
								<input name="user_newpass" id="user_newpass" type="password" required="required" /> 
							</p>
							<p> 
								<label for="password" class="youpasswd" data-icon="p" style="color:#333 !important"> Confirm New password </label>
								<input name="user_cnewpass" id="user_cnewpass" type="password" equalto="#user_newpass" required="required" /> 
							</p>
							
							<p > 
								<input type="submit" class="action-button" value="Update" /> 
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