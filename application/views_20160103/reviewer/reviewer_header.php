<div class="wlcm-user-box">
          <div class="col-md-4">
          	<div class="wlcm-user"><h1>Welcome <a href="<?php echo base_url();?>user-dashboard"><?php echo $this->session->userdata('username');?></a></h1></div>
          </div>
          <div class="col-md-8">
          	<div class="usrprfl-menu">
            	<ul>
					
				<li <?php if(($this->uri->segment(1)!='update-reviewer-profile')||($this->uri->segment(1)!='update-password')){ echo 'class="active"';}?> ><a href="<?php echo base_url();?>user-dashboard">Dashboard</a></li>
					<?php 
					$user_data_header =$this->user_model->get_row_with_con('tbl_users',
											array('user_id'=>$this->session->userdata('userid'))
										);
					if($user_data_header->user_reviewer){?>
                    <li><a href="#" id="reviewer_view">Author View</a></li>
					<?php }?>
					
					
				
					<li <?php if($this->uri->segment(1)=='update-reviewer-profile'){ echo 'class="active"';}?>> <a href="<?php echo base_url();?>update-reviewer-profile">Edit Profile</a></li>
					<li <?php if($this->uri->segment(1)=='update-password'){ echo 'class="active"';}?>><a href="<?php echo base_url();?>update-password">Change Password</a></li>
					<li><a href="<?php echo base_url();?>sign-out">Logout</a></li>
					 
                </ul>
            </div>
          </div>
        </div>
		
		
		<script>		

$(document).on('click', '#reviewer_view', function(event){

var r= confirm('Are you sure you want to check your author account?');
	if( r==true ){
	
	  var data= 'rool_type=author';
	  url =  "<?php echo base_url()?>user/change_rool";
		  $.post( url, data, function( result ) {
		 	 window.location.href="<?php echo base_url()?>user-dashboard"; 
		});
	}
});
</script>