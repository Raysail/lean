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
			 <form  action="<?php echo  base_url();?>general_login/login_action" method="post" autocomplete="on" name="login_frm" id="login_frm">
                             
                                <h1>Log in</h1> 			
                                <p> 
                                    <label for="username" class="uname" data-icon="u" > Your email</label>
                                    <input name="user_email" id="user_email" type="text" placeholder=" mymail@mail.com" value="<?php if($this->input->cookie('remember_user')!=''){ echo $this->input->cookie('remember_user');}?>" required="required"/>
                                </p>
                                <p> 
                                    <label for="password" class="youpasswd" data-icon="p"> Your password </label>
                                    <input name="user_pass" id="user_pass" type="password" placeholder="eg. X8df!90EO" value="<?php if($this->input->cookie('remember_pass')!=''){ echo $this->input->cookie('remember_pass');}?>" required="required" /> 
                                </p>
								
								<p> 
                                    <label for="password" class="youpasswd" data-icon=""><i class="fa fa-user"></i> Your identity</label>
                                   <select class="form-control login_identity" name="user_type" id="user_type"  required='required' >
										<option value="">Please Select Your Identity</option>
										<option value="1">Author</option>
										<option value="3">Reviewer</option>
										<option value="2">Editor</option>
										<option value="4">Publisher</option>
                          		  </select>
                                </p>
								<span class="keep_me_login"> <label class="checkbox">
									<input type="checkbox" name="user_remember" value="1"  id="loginkeeping" <?php if($this->input->cookie('remember_me')=='1'){ echo 'checked="checked"';}?>  />Keep me logged in
								 </label>
								 </span>
							 </form>	
								<div class="login_bottom_two">
         
         <ul>
         <li><a href="<?php echo base_url();?>forgot-password">fotgotten password</a>     </li>
            <li><a href="<?php echo base_url();?>sign-up">register Now</a>     </li>
            <li><a href="#">Help Login</a>     </li>
         </ul>
         
     
         
         
     
         </div>
                        </div>

                       
						
                    </div>
                </div>  
         </div>
         
		
         </div>
       </div>
     </div>
    
    </div>