<div class="main_content">
      <div class="container">
        <div class="row">
        
	<?php $this->load->view('reviewer/reviewer_header.php') ?>
			<div class="col-md-12">	
				<div class="submit_review">
				
    <h1>Your Recommendation:</h1>
    <?php if($this->session->flashdata('error')){echo '<div class="alert alert-danger" role="alert">'.$this->session->flashdata('error').'</div>' ;} ?>
        	<?php if($this->session->flashdata('success')){echo  '<div class="alert alert-success" role="alert">'.$this->session->flashdata('success').'</div>';} ?>
			
			<form name="review_frm" id="review_frm" method="post" action="<?php echo base_url();?>reviewer/submit_review_action"> 
			<input type="hidden" name="art_id" id="art_id" value="<?php echo $assign_data[0]->asign_artid;?>" />
			<input type="hidden" name="asgin_id" id="asgin_id" value="<?php echo $assign_data[0]->asgin_id;?>" />
    
  <div class="btn-group" data-toggle="buttons">
  <label class="btn btn-primary active">
    <input type="radio" name="sr_status" id="sr_status1" value="Reject" autocomplete="off" checked>Reject
  </label>
  <label class="btn btn-primary">
    <input type="radio" name="sr_status" id="sr_status2" value="Accept" autocomplete="off"> Accept without revision
  </label>
  <label class="btn btn-primary">
    <input type="radio" name="sr_status" id="sr_status3" value="Revision" autocomplete="off"> Revision
  </label>
</div>
  
  
<p>Does its quality adhere to the standard of < Corrosion Science  >? </p>


<div class="panel-body">
    <input type="checkbox" data-reverse name="sr_quality" id="sr_quality" value="1">
  </div>
<span class="review_report">Your review report:</span>

<textarea name="sr_report" id="sr_report" class="review_textarea" rows="10" cols="50" required="required"></textarea>

<p>
	  <button type="submit" class="btn btn-default assigned_menu chose_reviewer">Submit Review</button>
	  
<!--<input type="submit" class="" name="submit" value="Submit Review" />
<a href="#" class="next action-button">Submit Review</a>-->

</p>

</form>
    
    		</div>
		</div>
	
	
          	
        </div>
      </div>
    </div>	