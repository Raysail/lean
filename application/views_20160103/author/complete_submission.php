<div class="main_content">
      <div class="container">
        <div class="row">
		 		<h3 style="float:left;">Welcome <?php echo $this->session->userdata('username');?> </h3>
          	<div class="main_assigned_sec"> 
       <div class="component">
			<?php if($this->session->flashdata('error')){echo '<div class="alert alert-danger" role="alert">'.$this->session->flashdata('error').'</div>' ;} ?>
        	<?php if($this->session->flashdata('success')){echo  '<div class="alert alert-success" role="alert">'.$this->session->flashdata('success').'</div>';} ?>
				
		 		<h1>Submssion with a Decision </h1>
				<table>
				
					<?php if(!empty($decision_list)){?>
					<thead>
						<tr>
							<th>Manuscript ID</th>
							<th>TItle</th>
							<th>Sudmitied date</th>
							<th>Decision date</th>
							<th>Full ManuScript</th>
							<th>Editor Letter</th>
							<th>Action</th>
						  </tr>
					</thead>
					<tbody>
					<?php foreach($decision_list as $dec_list){	?>
						<tr>
							<th>LC-<?php echo $dec_list->art_no;?></th>
							<td><?php echo $dec_list->art_fulltitle;?></td>
							<td><?php echo date('F d, Y', strtotime( $dec_list->art_dateadd));?></td>
							<td><?php echo date('F d, Y', strtotime( $dec_list->art_decision_data));?></td>
							<td>PDF</td>
							<td>
							<button type="button" class="btn btn-info btn-lg assigned" data-toggle="modal" data-target="#newModal<?php echo $dec_list->art_id;?>"><?php echo $dec_list->art_editor_decision;?></button>
							
							 <div class="modal fade" id="newModal<?php echo $dec_list->art_id;?>" role="dialog">
								<div class="modal-dialog"> 
								  
								  <!-- Modal content-->
								  <div class="modal-content assigned_menu">
									<div class="modal-body">
										<p> <?php echo $dec_list->art_editor_msg;?>  </p>
									  
									</div>
									<div class="modal-footer assigned_menu">
									  <button type="button" class="btn btn-default assigned_menu" data-dismiss="modal">Close</button>
									</div>
								  </div>
								</div>
							  </div>
							</td>
							<td>
							
								<?php if( ($dec_list->art_editor_decision=='Accept') && ($dec_list->art_status>'9')){	?>							
								<a href="#" class="next action-button Assigned">Send To Publisher</a>
								<?php }?>
				
							</td>
						</tr>
						 
						                       					
						<?php }?>
					</tbody>
					<tfoot>
						<th colspan="7"><?php echo $page_no;?></th>
					</tfoot>
					<?php }else{  echo '<th colspan="7">No record Found!</th>'; }?>
				</table>
			
				
			</section>
		</div>
         
    </div>
        </div>
      </div>
    </div>
	
