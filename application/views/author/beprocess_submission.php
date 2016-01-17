<div class="main_content">
      <div class="container">
        <div class="row">
		 		<h3 style="float:left;">Welcome <?php echo $this->session->userdata('username');?> </h3>
			<?php if($this->session->flashdata('error')){echo '<div class="alert alert-danger" role="alert">'.$this->session->flashdata('error').'</div>' ;} ?>
        	<?php if($this->session->flashdata('success')){echo  '<div class="alert alert-success" role="alert">'.$this->session->flashdata('success').'</div>';} ?>
          	<div class="main_assigned_sec"> 
       <div class="component">
				
		 		<h1>Being Process Submission List</h1>
				<table>
				
					<?php if(!empty($incomp_data)){?>
					<thead>
						<tr>
							<th>Manuscript ID</th>
							<th>TItle</th>
							<th>Attached Files</th>
							<th>Began date</th>
							<th>Action</th>
						  </tr>
					</thead>
					<tbody>
					<?php foreach($incomp_data as $inc_list){
					
						$user_id = $this->session->userdata('userid');
						?>
						<tr>
							<th>LC-<?php echo $inc_list->art_no;?></th>
							<td><?php echo $inc_list->art_fulltitle;?></td>
							<td>
								<?php if(!empty($inc_list->art_cover)){?>
									<a href="<?php echo base_url().'upload/article/author-'.$user_id.'/'.$inc_list->art_cover;?>">Cover letter</a> <br />
								<?php } if(!empty($inc_list->art_menuscript)){?>
									<a href="<?php echo base_url().'upload/article/author-'.$user_id.'/'.$inc_list->art_menuscript; ?>">Manuscript</a> <br />
								<?php } if(!empty($inc_list->art_figure)){?>
									<a href="<?php echo base_url().'upload/article/author-'.$user_id.'/'.$inc_list->art_figure;?>">Fighre & Table</a> <br />
								<?php }if(!empty($inc_list->art_slide)){?>
									<a href="<?php echo base_url().'upload/article/author-'.$user_id.'/'.$inc_list->art_slide;?>">Powerpoint Slide</a> <br />
								<?php } if(!empty($inc_list->art_supple)){?>
									<a href="<?php echo base_url().'upload/article/author-'.$user_id.'/'.$inc_list->art_supple;?>">Supplementary</a> <br />
								<?php } if(!empty($inc_list->art_response)){?>
									<a href="<?php echo base_url().'upload/article/author-'.$user_id.'/'.$inc_list->art_response;  ?>">Response to Reviewer
								<?php }?>
						      </td>
							<td><?php echo date('F d, Y', strtotime( $inc_list->art_dateadd));?></td>
							<td>Process</td>
						</tr>                        					
						<?php }?>
					</tbody>
					<tfoot>
						<th colspan="5"><?php echo $page_no;?></th>
					</tfoot>
					<?php }else{  echo '<th colspan="5">No record Found!</th>'; }?>
				</table>
			
				
			</section>
		</div>
         
    </div>
        </div>
      </div>
    </div>
	
