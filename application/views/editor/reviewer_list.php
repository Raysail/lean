<div class="main_content">
    <div class="container">
    <div class="row">
	
	
			<?php $this->load->view('editor/editor_header.php'); ?>
			
        
        
        <div class="authr-opsn-tab">
        	 <div class="col-md-12">
            
                <?php if(!empty($reviewer_info)){?>
						<form name="reviewer_frm" action="<?php echo base_url()?>editor/chose_reviewer" id="reviewer_frm<?php echo $article_data[0]->art_id;?>" method="post" >
					<input type="hidden" name="art_id" id="art_id" value="<?php echo $article_data[0]->art_id;?>" />
					<input type="hidden" name="art_userid" id="art_userid" value="<?php echo $article_data[0]->art_userid;?>" />
               		 <table>
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Affilication </th>
                        <th>Expertise</th>
                        <th>Email</th>
                        <th>Choose</th>
                      </tr>
                      </thead>
                      <tbody>
					  <?php
					  foreach($reviewer_info as  $reviewer_list)
					  {
					  
					  	$where_classi = "asubmi_status= 1 AND FIND_IN_SET(asubmi_id,'".$reviewer_list->user_classification."')";	
										  
					  $all_classi =$this->user_model->select_query('group_concat( asubmi_title ) as as_title','tbl_article_classified',$where_classi,'asubmi_id', 'desc');
					  
					  					  					  
					  ?>
                      <tr>
                        <th><?php echo $reviewer_list->user_fname.'&nbsp'.$reviewer_list->user_lname;?></th>
                        <td><?php echo $reviewer_list->user_instiute;?></td>
                        <td><?php echo $all_classi[0]->as_title;?></td>
                        <td><?php echo $reviewer_list->user_email;?></td>
                        <td><!--<a href="#" class="next action-button">Choose Reviewer</a>-->
                          
                          <div class="radio radio-danger">
                            <input type="checkbox" name="user_id[]" id="user_id" value="<?php echo $reviewer_list->user_id;?>" required="required">
                            <label for="radio3"> </label>
                          </div></td>
                      </tr>
                      <?php }?>
					  <tr>
                        <th>Due Date</th>
                        <td> <input type="text" name="due_date" id="due_date" value="" required="required" />
						</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                    </tbody>
                  </table>
				    <div class="modal-footer assigned_menu">
				  <button type="button" class="btn btn-default assigned_menu chose_reviewer" data-fid="reviewer_frm<?php echo $article_data[0]->art_id;?>">submit</button>
				  </div>
				  </form>
				  <?php }else{ echo 'No reviewer Found For submit the article!';}?>
       		 </div>
        </div>
        
        
    </div>
    </div>
    </div>