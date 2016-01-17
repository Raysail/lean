<div class="wlcm-user-box">
          <div class="col-md-4">
          	<div class="wlcm-user"><h1>Welcome <a href="<?php echo base_url();?>user-dashboard"><?php echo $this->session->userdata('username');?></a></h1></div>
          </div>
          <div class="col-md-8">
          	<div class="usrprfl-menu">
            	<ul>
                	<li <?php if(($this->uri->segment(1)=='user-dashboard')||($this->uri->segment(1)=='author-guide')||($this->uri->segment(1)=='post-manuscript')||($this->uri->segment(1)=='update-mainscript')||($this->uri->segment(1)=='revission-update-mainscript')||($this->uri->segment(1)=="view_project") || ($this->uri->segment(1)=='send-message-editor')){ echo 'class="active"';}?> ><a href="<?php echo base_url();?>author-guide">Submit new menuscript</a></li>
					<?php 		
					$user_data_header =$this->user_model->get_row_with_con('tbl_users',
											array('user_id'=>$this->session->userdata('userid'))
										);
					if($user_data_header->user_reviewer){?>
                    <li><a href="#" id="reviewer_view">Reviewer View</a></li>
					<?php }?>
					
                    <li <?php if($this->uri->segment(1)=='hidden-project'){ echo 'class="active"';}?> ><a href="<?php echo base_url();?>hidden-project">Hidden Project</a></li>
                    <li <?php if($this->uri->segment(1)=='update-author-profile'){ echo 'class="active"';}?> ><a href="<?php echo base_url();?>update-author-profile">Edit Profile</a></li>
                    <li <?php if($this->uri->segment(1)=='update-password'){ echo 'class="active"';}?> ><a href="<?php echo base_url();?>update-password">Chang Password</a></li>
                     <li <?php if($this->uri->segment(1)=='logout'){ echo 'class="active"';}?> ><a href="<?php echo base_url();?>sign-out">Logout</a></li>
                </ul>
            </div>
          </div>
        </div>
		
		
<script>		

$(document).on('click', '#reviewer_view', function(event){

var r= confirm('Are you sure you want to check your reviewer account?');
	if( r==true ){
	
	  var data= 'rool_type=reviewer';
	  url =  "<?php echo base_url()?>user/change_rool";
		  $.post( url, data, function( result ) {
		 	 window.location.href="<?php echo base_url()?>user-dashboard"; 
		});
	}
});
</script>