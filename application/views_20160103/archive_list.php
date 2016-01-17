<div class="main_content">
      <div class="container" style="text-align:left;">
        <div class="row">
        <div class="archive_sec">
        
        <div class="accordion_example2">
		
        
        
			<!-- Section 1 -->
			<?php if(!empty($article_list))
			{
				foreach($article_list as $art_list)
				{
				
					$year ='';
					$valume='';
					
					$year =$art_list->pub_year;
					$valume=$art_list->pub_valume;
					
				
					$all_artlist ='';
					$select_filed = "*";
					$tbl_name ='tbl_article as a';	
					$where_condition=array('a.art_status'=>'15','ap.pub_year'=>$year,'ap.pub_valume'=>$valume);
					$order_by_field='a.art_id';
					$order_by_type='desc';				
					$group_by_field='a.art_id';
					
					$join_tbl1="tbl_article_publish ap";
					$join_condition1="ap.pub_artid=a.art_id";
					
					
					$all_artlist =$this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field,$join_tbl1,'',$join_condition1);
					
					
				
				
			?>
				<div class="accordion_in">
				<div class="acc_head"><?php echo $year.': Volume '.$valume;?></div>
				<div class="acc_content">
				<?php if(!empty($all_artlist)){?>
				<ul>
					<?php foreach($all_artlist as $list_art){ ?>
                   <li> 
				   		<a href="<?php echo base_url().'article-detail/'.$list_art->art_no;?>">>> <?php echo $list_art->art_fulltitle;?></a>
				   </li>
				   	<?php }?>
				  </ul>
				  <?php }?>
				</div>
			</div>

            <?php }
			}
			else
			{
				echo 'No Records found!';
			}?>

		</div>
        
        
        </div>
        </div>
      </div>
    </div>