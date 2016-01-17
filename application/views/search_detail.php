<div class="main_content">
      <div class="container">
        <div class="row">          
          <div class="cont_sec">
		  	<?php if(!empty($search_list)){
				foreach($search_list as $art_list){
			?>
				<div class="col-md-4">
              <div class="cont_sec_one"> <a href="<?php echo base_url().'article-detail/'.$art_list->art_no;?>"><img src="<?php echo base_url().'upload/publish/article-'.$art_list->pub_artid.'/'.$art_list->pub_cover; ?>"></a>
                <p class="cont_text"><?php echo $art_list->art_fulltitle;?></p>
              </div>
            </div>
			<?php
				}
			 }else
			 {
			 	echo "No search result found!";
			 }?>	  
          
          </div>
        </div>
      </div>
    </div>
	