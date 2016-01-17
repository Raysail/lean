<div class="wlcm-user-box">
          <div class="col-md-4">
          	<div class="wlcm-user"><h1>Welcome <?php echo $this->session->userdata('username');?></h1></div>
          </div>
          <div class="col-md-8">
          	<div class="usrprfl-menu">
            	<ul>
                	<li <?php if(($this->uri->segment(1)!='update-publisher-profile')||($this->uri->segment(1)!='update-password')){ echo 'class="active"';}?> ><a href="<?php echo base_url();?>user-dashboard">Dashboard</a></li>
                    <li <?php if($this->uri->segment(1)=='update-publisher-profile'){ echo 'class="active"';}?> ><a href="<?php echo base_url();?>update-publisher-profile">Edit Profile</a></li>
                    <li <?php if($this->uri->segment(1)=='update-password'){ echo 'class="active"';}?> ><a href="<?php echo base_url();?>update-password">Chang Password</a></li>
                     <li <?php if($this->uri->segment(1)=='logout'){ echo 'class="active"';}?> ><a href="<?php echo base_url();?>sign-out">Logout</a></li>
                </ul>
            </div>
          </div>
        </div>
