<div class="main_content">
    <div class="container">
    <div class="row">
		
	<?php $this->load->view('author/author_header.php') ?>
     	<div class="wlcm-user-dtl" style="text-align:left"> 
      
				   				<h1> Guide for Author</h1>
								<p>
				   				<?php echo nl2br($admin_setting->guide_author);?>
							</p>
						
                    	<p>&nbsp;</p>
						<a href="<?php echo base_url();?>post-manuscript" class="next action-button Assigned">Next</a>&nbsp; 

					
 			</div>
		</div>
	</div>
</div>