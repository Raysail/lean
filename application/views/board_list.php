<div class="main_content">
      <div class="container">
        <div class="row">
        
        <div class="editorial_board_sec" style="text-align:left;">
        <h1>Lean Corrosion  Editorial Board</h1>
		<?php 
		if(!empty($board_list)){
			foreach($board_list as  $list ){	?>
				<div class="col-md-6">
				<div class="editorial_board_sec_one">
				<div class="editorial_board_sec_one_left">
				<h2><?php echo $list->bord_name;?></h2>
				<p><?php echo $list->bord_affi;?></p>
				<h4>Email <?php echo $list->bord_email;?></h4>
				</div> 
				<div class="editorial_board_sec_one_right">
				<?php if(!empty($list->bord_image)){?>
				<img src="<?php echo base_url().'upload/board/'.$list->bord_image;?>" width="100px;" height="110px;">
				<?php }	?>
				</div> 
				</div>
				</div>
			<?php
			}
		}
		else
		{
			echo 'No records found!';
		}
		?>
											
											
											
        
<!--       <div class="col-md-6">
        <div class="editorial_board_sec_one">
        <div class="editorial_board_sec_one_left">
        <h2>G.D. Christian</h2>
        <p>University of Washington, Seattle, Washington, USA</p>
        <h4>Email G.D. Christian</h4>
        </div> 
        <div class="editorial_board_sec_one_right">
        <img src="images/client.jpg">
        </div> 
        </div>
        </div>
        
        <div class="col-md-6">
        <div class="editorial_board_sec_one">
        <div class="editorial_board_sec_one_left">
        <h2>G.D. Christian</h2>
        <p>University of Washington, Seattle, Washington, USA</p>
        <h4>Email G.D. Christian</h4>
        </div> 
        <div class="editorial_board_sec_one_right">
        <img src="images/client.jpg">
        </div> 
        </div>
        </div>
        
        <div class="col-md-6">
        <div class="editorial_board_sec_one">
        <div class="editorial_board_sec_one_left">
        <h2>G.D. Christian</h2>
        <p>University of Washington, Seattle, Washington, USA</p>
        <h4>Email G.D. Christian</h4>
        </div> 
        <div class="editorial_board_sec_one_right">
        <img src="images/client.jpg">
        </div> 
        </div>
        </div>
        
        <div class="col-md-6">
        <div class="editorial_board_sec_one">
        <div class="editorial_board_sec_one_left">
        <h2>G.D. Christian</h2>
        <p>University of Washington, Seattle, Washington, USA</p>
        <h4>Email G.D. Christian</h4>
        </div> 
        <div class="editorial_board_sec_one_right">
        <img src="images/client.jpg">
        </div> 
        </div>
        </div>
        
        <div class="col-md-6">
        <div class="editorial_board_sec_one">
        <div class="editorial_board_sec_one_left">
        <h2>G.D. Christian</h2>
        <p>University of Washington, Seattle, Washington, USA</p>
        <h4>Email G.D. Christian</h4>
        </div> 
        <div class="editorial_board_sec_one_right">
        <img src="images/client.jpg">
        </div> 
        </div>
        </div>
        
        <div class="col-md-6">
        <div class="editorial_board_sec_one">
        <div class="editorial_board_sec_one_left">
        <h2>G.D. Christian</h2>
        <p>University of Washington, Seattle, Washington, USA</p>
        <h4>Email G.D. Christian</h4>
        </div> 
        <div class="editorial_board_sec_one_right">
        <img src="images/client.jpg">
        </div> 
        </div>
        </div>
        -->
        
        </div>
        </div>
      </div>
    </div>