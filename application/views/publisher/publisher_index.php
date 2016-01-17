 <style>
.tab_one_sec a.good-btn {
	width: auto;
	background: #EE4723;
	font-weight: 100;
	color: white;
	border: 0 none;
	border-radius: 1px;
	cursor: pointer;
	padding: 10px 10px;
	margin: 10px 5px;
	font-family: 'Oswald', sans-serif;
	letter-spacing: 2px;
	min-width: 100px;
}
.resp-vtabs .resp-tabs-list li a {
	font-family: 'Segoe UI';
	color: #131313;
	display: block;
}
.resp-vtabs .resp-tabs-list li.active a {
	color: #fff;
}
.resp-vtabs .resp-tabs-list li:hover a {
	text-decoration: none;
}
.resp-vtabs .resp-tabs-list li.active {
	background-color: #EE4723 !important;
	text-decoration: none;
}
.resp-vtabs .resp-tabs-list li a {
	font-family: 'Segoe UI';
	color: #131313;
	display: block;
	padding: 15px 15px;
}
.resp-vtabs .resp-tabs-list li {
	padding: 0px !important;
}
</style>
 <div class="main_content">
    <div class="container">
    <div class="row">
	
	
			<?php $this->load->view('publisher/publisher_header.php') ?>
			
        
        
        <div class="authr-opsn-tab">
        	 <div class="col-md-12">
            
                <div class="main_subm_tab">
                <div id="parentHorizontalTab" class="resp-vtabs hor_1">
                      <ul class="resp-tabs-list hor_1 new_full_tab">
                    <li><a href="#proof" data-toggle="tab">In Proof </a></li>
                    <li><a href="#complete" data-toggle="tab"> Completion</a></li>
                </ul>
                        <div class="tab-content new_tab_fullwidth">
                       	  
                   		  
                 		  <div  class="resp-tabs-container tab-pane active" id="proof">
                          <div class="tab_one_sec public_n">
                      		  <?php if(!empty($in_proof))
									 {
									 ?>
									 <table>
									  <thead>
									<tr>
										  <th>Title </th>
										  <th>Author</th>
										  <th>Reviewer</th>
										  <th>Accept Date</th>
										  <th>Action</th>
										</tr>
								  </thead>
									  <tbody>
										<?php foreach($in_proof as $proof_list){ 
										
										$select_filed = '*';	
										$tbl_name= 'tbl_assgin_reviewer as r';	
										$where_condition = array('r.asign_artid'=>$proof_list->art_id,'r.asign_status'=>'1');
										$order_by_field = 'r.asgin_id';
										$order_by_type ='asc';
										$group_by_field = 'r.asgin_id';
										$join_tbl1 = 'tbl_users as u'; 
										$join_type1 = ''; 
										$join_condition1 = 'r.asign_userid=u.user_id';
									
										$all_list =$this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field, $join_tbl1, $join_type1, $join_condition1);
										$reviewer_name_data= '';
										if(!empty($all_list))
										{
											foreach($all_list as $review_list)
											{
												$reviewer_name_data.= $review_list->user_fname.'<br>';
											}
										}
						
												$count_message = 0;
												$where_message = '(art_id="'.$proof_list->art_id.'" AND p_read=0)';
												$count_message  = $this->user_model->check_no_rec('tbl_article_message',$where_message);
										 ?>
										<tr>
									  <th>
										<?php if($count_message==0){?>
									  <a href="<?php echo base_url().'publisher_view_project/'.$proof_list->art_no;?>" style="font-weight:normal !important;"><?php echo word_limiter($proof_list->art_fulltitle,5);?></a>
										<?php }else{?>
									  <a href="<?php echo base_url().'publisher_view_project/'.$proof_list->art_no;?>" style="color:#000 !important;"><strong><?php echo word_limiter($proof_list->art_fulltitle,5);?></strong></a>
										<?php }?>
									  </th>
									  <td><?php echo $proof_list->user_fname.'&nbsp'.$proof_list->user_lname;?></td>
									  <td><?php echo $reviewer_name_data;?> </td>
									  <td><?php echo $proof_list->art_decision_data;?> </td>
									  <td>									  
									  <select name="chose_option" id="chose_option"  class="btn btn-info assigned" style="background-color:#EE4723 !important;" onchange="chose_option(this.value)">
									<option value="0">Choose Option</option>
									
									<option value="<?php echo base_url().'proof-for-author/'.$proof_list->art_no;?>">Proof for Author check</option>
									<option value="<?php echo base_url().'sentby-publisher/'.$proof_list->art_no;?>">Sent back to Author </option>
									<option value="<?php echo base_url().'completby-publisher/'.$proof_list->art_no;?>">Completion</option>
									</select>
									
									  
									  </td>
									  
									
									</tr>
										<?php }?>
								  </tbody>
									</table>
										 
									 <?php
									 }else
									 {
										echo '<center>Currently not any manuscript "In Proof Section"</center>';
									 }
								 ?>	
                        
                            </div>
                      </div>
                  		  <div  class="resp-tabs-container tab-pane" id="complete">                          
                          <div class="tab_one_sec public_n">
							  	  <?php if(!empty($in_completion))
									 {
									 ?>
									 <table>
									  <thead>
									<tr>
										  <th>Title </th>
										  <th>Author</th>
										  <th>Reviewer</th>
										  <th>Accept Date</th>
										  <th>Action</th>
										</tr>
								  </thead>
									  <tbody>
										<?php foreach($in_completion as $comp_list){ 
										
										$select_filed = '*';	
										$tbl_name= 'tbl_assgin_reviewer as r';	
										$where_condition = array('r.asign_artid'=>$comp_list->art_id,'r.asign_status'=>'1');
										$order_by_field = 'r.asgin_id';
										$order_by_type ='asc';
										$group_by_field = 'r.asgin_id';
										$join_tbl1 = 'tbl_users as u'; 
										$join_type1 = ''; 
										$join_condition1 = 'r.asign_userid=u.user_id';
									
										$all_list =$this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field, $join_tbl1, $join_type1, $join_condition1);
										$reviewer_name_data= '';
										if(!empty($all_list))
										{
											foreach($all_list as $review_list)
											{
												$reviewer_name_data.= $review_list->user_fname.'<br>';
											}
										}
						
												$count_message = 0;
												$where_message = '(art_id="'.$comp_list->art_id.'" AND p_read=0)';
												$count_message  = $this->user_model->check_no_rec('tbl_article_message',$where_message);
												
												$tot_res = $this->user_model->check_no_rec('tbl_article_publish',array('pub_artid'=>$comp_list->art_id)); 
												
										 ?>
										<tr>
									  <th>
										<?php if($count_message==0){?>
									  <a href="<?php echo base_url().'publisher_view_project/'.$comp_list->art_no;?>" style="font-weight:normal !important;"><?php echo word_limiter($comp_list->art_fulltitle,5);?></a>
										<?php }else{?>
									  <a href="<?php echo base_url().'publisher_view_project/'.$comp_list->art_no;?>" style="color:#000 !important;"><strong><?php echo word_limiter($comp_list->art_fulltitle,5);?></strong></a>
										<?php }?>
									  </th>
									  <td><?php echo $comp_list->user_fname.'&nbsp'.$comp_list->user_lname;?></td>
									  <td><?php echo $reviewer_name_data;?> </td>
									  <td><?php echo $comp_list->art_decision_data;?> </td>
									  <td>
									   <?php if( ($tot_res>0) && (($comp_list->art_status<'15') || ($comp_list->art_status=='15')) ){?>
							<a class="next action-button Assigned" href="<?php echo base_url();?>publish-continue/<?php echo $comp_list->art_no?>">Edit</a>
							<a class="next action-button Assigned" href="#"  onclick="return proof_paper_delete('<?php echo $comp_list->art_id;?>')">Delete</a>
							<?php }/*if( ($tot_res>0) && ($comp_list->art_status=='15') ){?>
							<a class="next action-button Assigned" href="#">Final Published</a>
							<?php }*/
							elseif( ($tot_res==0)){?>
							<a class="next action-button Assigned" href="<?php echo base_url();?>publish-mainscript/<?php echo $comp_list->art_no?>">Publish</a>
							<?php }?>	
							
							</td>
									  
									
									</tr>
										<?php }?>
								  </tbody>
									</table>
										 
									 <?php
									 }else
									 {
										echo '<center>Currently not any manuscript "In Completion Section"</center>';
									 }
								 ?>	
                     		 </div>
                        </div>
                  		  
                  </div>
                    </div>
              </div>
        </div>
        </div>
        
        
    </div>
    </div>
    </div>
<script>
function chose_option(choase_val)
{
	if(choase_val!='0'){
	window.location=choase_val;
	}
}
</script>	

<script>

function proof_paper_delete(art_id)
{
	var conf=confirm("Are you sure delete this manuscript publish content!.");
	if(conf)
	{
		
		
		var pub_artid =art_id;	
		
		data = 'pub_artid='+pub_artid;
		url =  "<?php echo base_url()?>publisher/delete_publish_article";
		$.ajax({
				   type: "POST",
				   url: url,
				   data: data,
				   dataType: 'html',
				   success: function(msg)
				   {
					  window.location.href = "<?php echo base_url();?>/user-dashboard";
				   }
			});
			
			
	
	
	}
	else
	{
		return false;
	}
}
</script>	
    

