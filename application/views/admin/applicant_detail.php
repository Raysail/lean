
<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>Applicant Detail<small>Preview</small>                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url();?>administrator/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo base_url();?>administrator/funding-detail/<?php echo $fund_id;?>"> Funding Detail</a></li>
                        <li class="active"> Applicant Detail</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
						
						
                        <div class="col-md-12">
						
						
						<div class="box-body">
						
								<?php if($this->session->flashdata('error')){?>
                                    <div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                        <b>Alert!</b><?php echo $this->session->flashdata('error') ;?>
                                    </div>
                                   <?php }  if($this->session->flashdata('sucess')) {?>
                                    <div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                        <b>Alert!</b><?php echo  $this->session->flashdata('sucess');?>
                                    </div>
									<?php }?>
                                </div>
								
								
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">&nbsp;</h3>
                                </div><!-- /.box-header -->
								
                                <!-- form start -->
                              
            
								        <div class="box-body">
										<table cellpadding="5" cellspacing="5" width="100%">
											<tr>
												<td width="10%">	
													<img src="<?php echo base_url();?>upload/fund/<?php echo $fdata[0]->fund_coverpic;?>" width="150px;" height="200px;"/>
												</td>
												<td valign="top" align="left"><?php echo $fdata[0]->fund_title;?><br /><br />
													Compnay Name: <?php echo $fdata[0]->fund_title;?><br /><br />
													OPEN: <?php echo date('m-d-Y',strtotime($fdata[0]->fund_posted));?>
												</td>
											</tr>
										</table>
										
										<?php if(!empty($news_feed)){?>
										 <button type="button" class="btn btn-primary" name="cat_button">NEWSFEED</button>
										<table cellpadding="5" cellspacing="5" width="100%">
											<?php foreach($news_feed as $news_feed){?>
											<tr>
												<td width="8%">	
													<img width="50px;" height="50px" src="<?php echo base_url();?>design/front/images/member.png"  />
												</td>
												<td align="left"><?php echo $news_feed->msg_content;?>&nbsp&nbsp;
													
													   
												</td>
											</tr>
											<?php }?>
										</table>
										<?php }else{?>
										
									<!--	<table cellpadding="5" cellspacing="5" width="100%">
											<tr>
												<td valign="top" align="center">
													 Not Available Any Newsfeed!
												</td>
											</tr>
										</table>-->
										
										<?php } ?>
										
										
										
								 <div id="applicant_msg"> 
								 	<form name="msg_applicant" id="msg_applicant_frm" method="post" action="<?php echo base_url()?>admin/funding/submit_msg">
									<input type="hidden" name="app_id" id="app_id" value="<?php echo $app_id;?>" />
									<input type="hidden" name="app_fundid" id="app_fundid" value="<?php echo $fund_id;?>" />
										<div><img width="50px;" height="50px" src="<?php echo base_url();?>design/front/images/member.png" />
										<span id="app_name"><?php echo $app_list[0]->app_name;?></span>
										</div>
										<div>
											<span id="apn_msg_app">
											</span>
											<textarea name="msg_app" id="msg_app" class="form-control" required></textarea>
										</div>
									<div>
                                        <button type="submit" class="btn btn-primary" name="cat_button" id="submit_msg">Submit</button>
										</div>
								    </form>			
                                    </div>
									
                                        
                                    </div><!-- /.box-body -->
									

                                    <!--<div class="box-footer">
                                        <button type="submit" class="btn btn-primary" name="cat_button" value="">Submit</button>
                                    </div>-->
                            </div><!-- /.box -->

                  
                        </div><!--/.col (left) -->
                        <!-- right column -->
                        <!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside>
<script>
jQuery(function($) {
	  $('#msg_applicant_frm').validate();
});
</script>	

