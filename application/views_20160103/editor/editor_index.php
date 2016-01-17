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
	
	
			<?php $this->load->view('editor/editor_header.php') ?>
			
        
        
        <div class="authr-opsn-tab">
        	 <div class="col-md-12">
            
                <div class="main_subm_tab">
                <div id="parentHorizontalTab" class="resp-vtabs hor_1">
                      <ul class="resp-tabs-list hor_1 new_full_tab">
                    <li><a href="#submission" data-toggle="tab">In Submission </a></li>
                    <li><a href="#review" data-toggle="tab"> In Review</a></li>
                    <li><a href="#proof" data-toggle="tab">In Proof</a></li>
                    <li><a href="#complete" data-toggle="tab"> Complete</a></li>
                    <li><a href="#decline" data-toggle="tab">Decline</a></li>
                </ul>
                        <div class="tab-content new_tab_fullwidth">
                       	  <div class="resp-tabs-container tab-pane active" id="submission">
							<div class="tab_one_sec public_n">
							<?php if(!empty($in_submit))
								 {
								 ?>
								 <table>
								  <thead>
								<tr>
									  <th>Title </th>
									  <th>Author</th>
									  <th>Submit Date</th>
									  <th>Action</th>
									</tr>
							  </thead>
								  <tbody>
									<?php foreach($in_submit as $submit_list){ 
											$count_message = 0;
											$where_message = '(art_id="'.$submit_list->art_id.'" AND e_read=0)';
											$count_message  = $this->user_model->check_no_rec('tbl_article_message',$where_message);
									 ?>
									<tr>
                                  <th>
								  	<?php if($count_message==0 ){?>
								  <a href="<?php echo base_url().'editor_view_project/'.$submit_list->art_no;?>" style="font-weight:normal !important;"><strong><?php echo word_limiter($submit_list->art_fulltitle,20);?></strong></a>
								  	<?php }else{?>
								  <a href="<?php echo base_url().'editor_view_project/'.$submit_list->art_no;?>" style="color:#000 !important;"><?php echo word_limiter($submit_list->art_fulltitle,20);?></a>
								  	<?php }?>
								  </th>
                                  <td><?php echo $submit_list->user_fname.'&nbsp'.$submit_list->user_lname;?></td>
                                  <td><?php echo $submit_list->art_dateadd;?> </td>
                                  <td>
								  
								  	<select name="chose_option" id="chose_option" onchange="chose_option(this.value)" class="btn btn-info assigned" style="background-color:#EE4723 !important;">
									<option value="0">Choose Option</option>
									<option value="<?php echo base_url().'assign-reviewer/'.$submit_list->art_no;?>">Assign Manuscript to Reviewer</option>
									<option value="<?php echo base_url().'send-author/'.$submit_list->art_no;?>">Sendback to Author</option>
									<option value="<?php echo base_url().'decline/'.$submit_list->art_no;?>">Declined</option>
									</select>
								  </td>
                                </tr>
								  	<?php }?>
							  </tbody>
								</table>
									 
								 <?php
								 }else
								 {
								 	echo '<center>Currently not any manuscript "In Submission section"</center>';
								 }
							 ?>	
								
						  </div>
                        </div>
                   		  <div  class="resp-tabs-container tab-pane" id="review">
							  <div class="tab_one_sec public_n">
							  	
								<?php if(!empty($in_review))
									 {
									 ?>
									 <table>
									  <thead>
									<tr>
										  <th>Title </th>
										  <th>Author</th>
										  <th>Reviewer</th>
										  <th>Review Date</th>
										  <th>Action</th>
										</tr>
								  </thead>
									  <tbody>
										<?php foreach($in_review as $submit_list){ 
										
										$select_filed = '*';	
										$tbl_name= 'tbl_assgin_reviewer as r';	
										$where_condition = array('r.asign_artid'=>$submit_list->art_id);
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
												$where_message = '(art_id="'.$submit_list->art_id.'" AND e_read=0)';
												$count_message  = $this->user_model->check_no_rec('tbl_article_message',$where_message);
										 ?>
										<tr>
									  <th>
										<?php if($count_message==0 && ($submit_list->art_status!='9')){?>
									  <a href="<?php echo base_url().'editor_view_project/'.$submit_list->art_no;?>" style="font-weight:normal !important;"><?php echo word_limiter($submit_list->art_fulltitle,20);?></a>
										<?php }else if($submit_list->art_status=='9' ){?>
									  <a href="<?php echo base_url().'editor_view_project/'.$submit_list->art_no;?>" style="font-weight:bold !important;color:#000000!important;"><?php echo word_limiter($submit_list->art_fulltitle,20);?></a>
										<?php }else{?>
									  <a href="<?php echo base_url().'editor_view_project/'.$submit_list->art_no;?>" style="color:#000 !important;"><?php echo word_limiter($submit_list->art_fulltitle,20);?></a>
										<?php }?>
									  </th>
									  <td><?php echo $submit_list->user_fname.'&nbsp'.$submit_list->user_lname;?></td>
									  <td><?php echo $reviewer_name_data;?> </td>
									  <td><?php echo $submit_list->art_duedate;?> </td>
									  <td>
									  
									  
									  
									  <select name="chose_option" id="chose_option"  class="btn btn-info assigned" style="background-color:#EE4723 !important;" onchange="chose_option(this.value)">
									<option value="0">Choose Option</option>
									
									<?php if($submit_list->art_status<10){?>
									<option value="<?php echo base_url().'again-assign-reviewer/'.$submit_list->art_no;?>">Again invite Reviewer</option>
									<?php }?>
									<option value="<?php echo base_url().'assign-publisher/'.$submit_list->art_no;?>">Assign to Publisher</option>
									<option value="<?php echo base_url().'required-revission/'.$submit_list->art_no;?>">Revision</option>
									<option value="<?php echo base_url().'required-declined/'.$submit_list->art_no;?>">Declined</option>
									</select>
									
									  
									  </td>
									</tr>
										<?php }?>
								  </tbody>
									</table>
										 
									 <?php
									 }else
									 {
										echo '<center>Currently not any manuscript "In Review section"</center>';
									 }
								 ?>	
                     		 </div>
						 </div>
                 		  <div  class="resp-tabs-container tab-pane" id="proof">
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
										</tr>
								  </thead>
									  <tbody>
										<?php foreach($in_proof as $proof_list){ 
										
										$select_filed = '*';	
										$tbl_name= 'tbl_assgin_reviewer as r';	
										$where_condition = array('r.asign_artid'=>$proof_list->art_id);
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
												$where_message = '(art_id="'.$proof_list->art_id.'" AND e_read=0)';
												$count_message  = $this->user_model->check_no_rec('tbl_article_message',$where_message);
										 ?>
										<tr>
									  <th>
										<?php if($count_message==0){?>
									  <a href="<?php echo base_url().'editor_view_project/'.$proof_list->art_no;?>" style="font-weight:normal !important;"><?php echo word_limiter($proof_list->art_fulltitle,20);?></a>
										<?php }else{?>
									  <a href="<?php echo base_url().'editor_view_project/'.$proof_list->art_no;?>" style="color:#000 !important;"><?php echo word_limiter($proof_list->art_fulltitle,20);?></a>
										<?php }?>
									  </th>
									  <td><?php echo $proof_list->user_fname.'&nbsp'.$proof_list->user_lname;?></td>
									  <td><?php echo $reviewer_name_data;?> </td>
									  <td><?php echo $proof_list->art_decision_data;?> </td>
									
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
							  	
                      		  <?php if(!empty($in_complte))
									 {
									 ?>
									 <table>
									  <thead>
									<tr>
										  <th>Title </th>
										  <th>Author</th>
										  <th>Reviewer</th>
										  <th>Published Date</th>
										</tr>
								  </thead>
									  <tbody>
										<?php foreach($in_complte as $complete_list){ 
										
										$select_filed = '*';	
										$tbl_name= 'tbl_assgin_reviewer as r';	
										$where_condition = array('r.asign_artid'=>$complete_list->art_id);
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
												$where_message = '(art_id="'.$complete_list->art_id.'" AND e_read=0)';
												$count_message  = $this->user_model->check_no_rec('tbl_article_message',$where_message);
										 ?>
										<tr>
									  <th>
										<?php if($count_message==0){?>
									  <a href="<?php echo base_url().'editor_view_project/'.$complete_list->art_no;?>" style="font-weight:normal !important;"><?php echo word_limiter($complete_list->art_fulltitle,20);?></a>
										<?php }else{?>
									  <a href="<?php echo base_url().'editor_view_project/'.$complete_list->art_no;?>" style="color:#000 !important;"><?php echo word_limiter($complete_list->art_fulltitle,20);?></a>
										<?php }?>
									  </th>
									  <td><?php echo $complete_list->user_fname.'&nbsp'.$complete_list->user_lname;?></td>
									  <td><?php echo $reviewer_name_data;?> </td>
									  <td><?php echo $complete_list->art_publish;?> </td>
									
									</tr>
										<?php }?>
								  </tbody>
									</table>
										 
									 <?php
									 }else
									 {
										echo '<center>Currently not any manuscript "In Complete Section"</center>';
									 }
								 ?>	
                     		 </div>
                        </div>
                  		  <div  class="resp-tabs-container tab-pane" id="decline">                          
                           <div class="tab_one_sec public_n">
							  	<?php if(!empty($in_decline))
								 {
								 ?>
								 <table>
								  <thead>
								<tr>
									  <th>Title </th>
									  <th>Author</th>
									  <th>Decline Date</th>
									</tr>
							  </thead>
								  <tbody>
									<?php foreach($in_decline as $decline_list){  ?>
									<tr>
                                  <th>
								  <a href="<?php echo base_url().'editor_view_project/'.$decline_list->art_no;?>" style="font-weight:normal !important;"><?php echo word_limiter($decline_list->art_fulltitle,20);?></a></th>
                                  <td><?php echo $decline_list->user_fname.'&nbsp'.$decline_list->user_lname;?></td>
                                  <td><?php echo $decline_list->art_update;?> </td>
                                </tr>
								  	<?php }?>
							  </tbody>
								</table>
									 
								 <?php
								 }else
								 {
								 	echo '';
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
    

