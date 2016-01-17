<div class="main_content">
      <div class="container">
        <div class="row">
		 		<h3 style="float:left;">Welcome <?php echo $this->session->userdata('username');?> </h3>
			<?php if($this->session->flashdata('error')){echo '<div class="alert alert-danger" role="alert">'.$this->session->flashdata('error').'</div>' ;} ?>
        	<?php if($this->session->flashdata('success')){echo  '<div class="alert alert-success" role="alert">'.$this->session->flashdata('success').'</div>';} ?>
          	<div class="main_assigned_sec"> 
       <div class="component">
				
		 		<h1>Incomplete Submission List</h1>
				<table>
				
					<?php if(!empty($incomp_data)){?>
					<thead>
						<tr>
							<th>Manuscript ID</th>
							<th>TItle</th>
							<th>Began date</th>
							<th>Action</th>
						  </tr>
					</thead>
					<tbody>
					<?php foreach($incomp_data as $inc_list){?>
						<tr>
							<th>LC-<?php echo $inc_list->art_no;?></th>
							<td><?php echo $inc_list->art_fulltitle;?></td>
							<td><?php echo date('F d, Y', strtotime( $inc_list->art_dateadd));?></td>
							<td>
								<a href="<?php echo base_url();?>update-mainscript/<?php echo $inc_list->art_no;?>"><i class="fa fa-pencil"></i></a>	
								<a  href="<?php echo base_url().'article/article_delete/'. $inc_list->art_id; ?>" onclick="return delete_wal()" ><i class="fa fa-times"></i></a>
							</td>
						</tr>                        					
						<?php }?>
					</tbody>
					<tfoot>
						<th colspan="4"><?php echo $page_no;?></th>
					</tfoot>
					<?php }else{  echo '<th colspan="4">No record Found!</th>}?>'; }?>
				</table>
			
				
		</div>
         
    </div>
        </div>
      </div>
    </div>
	
