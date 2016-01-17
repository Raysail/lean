<script>
jQuery(function($) {
      $('#msform').validate();
});
</script>
<div class="main_content">
      <div class="container">
        <div class="row">
			<?php $this->load->view('author/author_header.php') ?>
          <div class="main_registation_sec">
            <div class="col-md-12">
			
				
			
			<?php if($this->session->flashdata('error')){echo '<div class="alert alert-danger" role="alert">'.$this->session->flashdata('error').'</div>' ;} ?>
        	<?php if($this->session->flashdata('success')){echo  '<div class="alert alert-success" role="alert">'.$this->session->flashdata('success').'</div>';} ?>
			
              <form id="msform" action="<?php echo  base_url();?>user/editprofile_action" method="post">
			  <input type="hidden"  name="user_id" id="user_id" value="<?php echo $user_info[0]->user_id;?>" />
				<input type="hidden"  name="user_type" id="user_type" value="<?php echo  $user_info[0]->user_type;?>" />
                <!-- progressbar -->
                <ul id="progressbar">
                  <li class="active">Login Information</li>
                  <li>Personal information</li>
                  <li>Areas of expertise</li>
                </ul>
                <!-- fieldsets -->
                <fieldset>
                  <h2 class="fs-title">Login Information</h2>
                  <input type="email" name="user_email" id="user_email" value="<?php echo $user_info[0]->user_email;?>" readonly="readonly"/>
                  <input type="button" name="next" class="next action-button" value="Next" />
                </fieldset>
                <fieldset>
                  <h2 class="fs-title">Personal information</h2>
                  <input type="text" id="user_fname" name="user_fname" value="<?php echo $user_info[0]->user_fname;?>" placeholder="First Name"  required="required"/>
                  <input type="text" id="user_lname" name="user_lname" value="<?php echo $user_info[0]->user_lname;?>" placeholder="Last Name" required="required"/>
                  <input type="text" id="user_instiute" name="user_instiute" value="<?php echo $user_info[0]->user_instiute;?>"  placeholder="Institution" required="required"/>
                  <textarea name="user_address" id="user_address" required="required" class="form-control" placeholder="Address"><?php echo $user_info[0]->user_address;?></textarea>
					
                  <select name="user_country" id="user_country" required="required" class="form-control" >
					<option value=""> Select Counrty</option>
					<?php 								
					foreach($countries as $country)
					{
						$selected = '';
				if(($user_id>0) && ($user_info[0]->user_country==$country->code)){$selected = 'selected="selected"';}	
					?>
						<option value="<?php echo $country->code; ?>" <?php echo $selected;?> ><?php echo $country->name; ?></option>
					<?php		
					}
					?>
				</select>
                  <input type="button" name="previous" class="previous action-button" value="Previous" />
                  <input type="button" name="next" class="next action-button" value="Next" />
                </fieldset>
                <fieldset>
                  <h2 class="fs-title">Areas of expertise</h2>
				  <input type="hidden" name="user_classification" id="user_classification" value="<?php echo $user_info[0]->user_classification;?>" required />
				  
				  <div class="select_one">
<p>Personal Classification</p>
</div> 

<div class="select_left" id="all_sel_exp">

<?php foreach($classify as $classi)	{
		$value = explode(',',$user_info[0]->user_classification);
		if(in_array($classi->asubmi_id,$value))
		{
?>
	<div id="user_axct-<?php echo $classi->asubmi_id; ?>"><div class="select_final_left"><?php echo $classi->asubmi_title; ?></div></div>
 <?php	
  		}
 }	?>

</div>

<div class="select_right">

<!-- Small modal -->
<button type="button" class="btn btn-primary select_sec_but" data-toggle="modal" data-target=".bs-example-modal-sm">Select</button>
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm regis_model">
     <div class="modal-header">
          <button type="button" class="close reg_close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
          <h4 class="modal-title area_sec" id="mySmallModalLabel">AREAS OF EXPERTISE</h4>
        </div>
   
    <div class="modal-content regis_chack">
	<?php foreach($classify as $classi)	{
		$checked= '';
		$value = explode(',',$user_info[0]->user_classification);
		if(in_array($classi->asubmi_id,$value))
		{
			$checked= 'checked="checked"';
		}
	?>
   
 <input class="inner_check"  name="user_expt" id="user_expt_<?php echo $classi->asubmi_id; ?>" data-parentid="<?php echo $classi->asubmi_id; ?>" data-name="<?php echo $classi->asubmi_title; ?>" type="checkbox" value="<?php echo $classi->asubmi_id; ?>" <?php echo $checked; ?>><label for="cb6" class="inner_cont_box"><?php echo $classi->asubmi_title; ?></label>
 <?php	}	?>
    </div>
  </div>
</div>


</div>



            
            <div class="on_left">
            <p>Avalabile as a Reviewer</p>
            </div>
            <div class="on_right">
            <div class="onoffswitch">
                    <input type="checkbox"  name="user_reviewer" class="onoffswitch-checkbox" id="myonoffswitch" <?php if($user_info[0]->user_reviewer){ echo 'checked="checked"';} ?> >
                    <label class="onoffswitch-label" for="myonoffswitch"> <span class="onoffswitch-inner"></span> <span class="onoffswitch-switch"></span> </label>
                  </div>
            </div>
			
				  
				  
                  <input type="button" name="previous" class="previous action-button" value="Previous" />
                  <input type="submit" name="submit" class="submit action-button" value="Submit" />
                </fieldset>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
	<script>

$(document).ready(function(){
	$(document).on('click', ".inner_check", function(e) {	
	
		 var sr_no = $(this).attr('data-parentid');		
		 var checkboxes = $("#user_expt_"+sr_no);	 
		 if(checkboxes.is(":checked"))
		 {
		 	
			 var clssi_name = '';
			 clssi_name = $(this).attr('data-name');	
			 
			var new_de = '';
			new_de =  '<div id="user_axct-'+sr_no+'"><div class="select_final_left">'+clssi_name+'</div></div>';
			
			  $("#all_sel_exp").append(new_de);
			  
			  if($('#user_classification').val())
			  {
			  	v1 = $('#user_classification').val();
				v2 = v1+','+sr_no;
			  	$('#user_classification').val(v2);
			  }
			  else
			  {
			  	$('#user_classification').val(sr_no);
			  	
			  }
			  
		 }
		 else
		 {
		 	 var clssi_name = '';
			 clssi_name = $(this).attr('data-name');	
			  if($('#user_classification').val())
			  {
			  	v1 = $('#user_classification').val();
				v2 = v1.split(',');
				
				var new_val = '';
					for(i=0;i<v2.length; i++)
					{
						if(v2[i]!=sr_no)
						{
							 new_val = new_val+v2[i]+',';
						}						
					}
					
					var ids = $('.txtValue').val();
					var lastChar = new_val.slice(-1);
					if (lastChar == ',') {
					  new_val = new_val.slice(0, -1);
					}					
				$('#user_classification').val(new_val);
		
			  }
			
			 $('#user_axct-'+sr_no).remove();
			 
		 
		 }
    });
});

</script>