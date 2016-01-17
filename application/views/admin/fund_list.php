<aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1> Funding 
                        <small>Preview</small>                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url();?>administrator/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active"> Funding list </li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
							
												
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
								
                                <div class="box-header">
                                    <h3 class="box-title">&nbsp;</h3>
									
									<a href="<?php echo base_url();?>administrator/fund-form" style="float:right; padding-right:20px; padding-top:10px;"> ADD FUNDING </a> 
												
									
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
									<div>
									<ul class="nav nav-tabs"  role="tablist">
										<li class="active"><a href="#a" role="tab" data-toggle="tab">OPEN</a></li>
										<li><a href="#b" role="tab" data-toggle="tab">EVALUATION</a></li>
										<li><a href="#c" role="tab" data-toggle="tab">AWARDED</a></li>
										<li><a href="#d" role="tab" data-toggle="tab">CLOSE</a></li>
									</ul>
									<div class="tab-content">
									<div class="tab-pane active" id="a">
									<table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Funding Title</th>
                                                <th>Company</th>
                                                <th>Reward</th>
                                                <th>Deadline</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php 
											if(!empty($fund_list)){
											foreach($fund_list as  $flist ){
										?>
                                            <tr>
                                                <td><a href="<?php echo base_url();?>administrator/funding-detail/<?php echo $flist->fund_id;?>"><?php echo $flist->fund_title;?></a></td>
                                                <td><?php echo $flist->fund_company;?></td>
                                                <td><?php echo $flist->fund_reward;?></td>
                                                <td><?php echo date('m-d-Y',strtotime($flist->fund_decline));?></td>
                                                <td>
												<form name="choose_open<?php echo $flist->fund_id;?>" id="choose_open<?php echo $flist->fund_id;?>" method="post" action="<?php echo base_url();?>administrator/applicant-message">
									<input type="hidden" name="fund_id" value="<?php echo $flist->fund_id;?>" />
												
													<select name="choos_option" id="choos_open" onchange="choose_submit(this.value,'<?php echo $flist->fund_id;?>','choose_open<?php echo $flist->fund_id;?>')">
													<option value="0">Choose Option</option>
													<option value="2">Assign Funding to Evaluation</option>
													<option value="4">Close</option>
													</select>
												</form>	
												</td>
                                            </tr>	<?php 
												}
											}
											?>
                                        </tbody>
                                        <tfoot>
										
									
                                            <tr>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                            </tr>
										
                                        </tfoot>
                                    </table></div>
									<div class="tab-pane " id="b">
									<table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Funding Title</th>
                                                <th>Company</th>
                                                <th>Reward</th>
                                                <th>Deadline</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php 
											if(!empty($fund_eval)){
											foreach($fund_eval as  $flist ){
										?>
                                            <tr>
                                                <td><a href="<?php echo base_url();?>administrator/funding-detail/<?php echo $flist->fund_id;?>"><?php echo $flist->fund_title;?></a></td>
                                                <td><?php echo $flist->fund_company;?></td>
                                                <td><?php echo $flist->fund_reward;?></td>
                                                <td><?php echo date('m-d-Y',strtotime($flist->fund_decline));?></td>                                                <td>
												<form name="choose_eval<?php echo $flist->fund_id;?>" id="choose_eval<?php echo $flist->fund_id;?>" method="post" action="<?php echo base_url();?>administrator/applicant-message">
									<input type="hidden" name="fund_id" value="<?php echo $flist->fund_id;?>" />
												
													<select name="choos_option" id="choos_open" onchange="choose_submit(this.value,'<?php echo $flist->fund_id;?>','choose_eval<?php echo $flist->fund_id;?>')">
													<option value="0">Choose Option</option>
													<option value="3">Assign Funding to Awarded</option>
													<option value="4">Close</option>
													</select>
												</form>	
												</td>
                                            </tr>	<?php 
												}
											}
											?>
                                        </tbody>
                                        <tfoot>
										
									
                                            <tr>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                            </tr>
										
                                        </tfoot>
                                    </table></div>
									<div class="tab-pane " id="c">
									<table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Funding Title</th>
                                                <th>Company</th>
                                                <th>Reward</th>
                                                <th>Awarded Date</th>
                                                <th>Awarded Persons</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php 
											if(!empty($fund_award)){
											foreach($fund_award as  $flist ){
											$awarded_body_name ='';
										if(!empty($flist->fund_awardname))	{
								$where_app = "app_fund_id='".$flist->fund_id."' 
												AND find_in_set( app_id,'".$flist->fund_awardname."' )";
				
				$fund_applicant = $this->user_model->select_query('group_concat(app_name )as app_name','tbl_fund_applicant',$where_app );
				
				$awarded_body_name = $fund_applicant[0]->app_name;
				}
										?>
                                            <tr>
                                                <td><a href="<?php echo base_url();?>administrator/funding-detail/<?php echo $flist->fund_id;?>"><?php echo $flist->fund_title;?></a></td>
                                                <td><?php echo $flist->fund_company;?></td>
                                                <td><?php echo $flist->fund_reward;?></td>
                                                <td><?php echo date('m-d-Y',strtotime($flist->fund_award_data));?></td>
                                                <td><?php echo $awarded_body_name;?></td>
                                            </tr>	<?php 
												}
											}
											?>
                                        </tbody>
                                        <tfoot>
										
									
                                            <tr>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                            </tr>
										
                                        </tfoot>
                                    </table></div>
									<div class="tab-pane " id="d">
									<table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Funding Title</th>
                                                <th>Company</th>
                                                <th>Reward</th>
                                                <th>Close Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php 
											if(!empty($fund_close)){
											foreach($fund_close as  $flist ){
										?>
                                            <tr>
                                                <td><a href="<?php echo base_url();?>administrator/funding-detail/<?php echo $flist->fund_id;?>"><?php echo $flist->fund_title;?></a></td>
                                                <td><?php echo $flist->fund_company;?></td>
                                                <td><?php echo $flist->fund_reward;?></td>
                                                <td><?php echo date('m-d-Y',strtotime($flist->fund_update));?>
												</td>
                                            </tr>	<?php 
												}
											}
											?>
                                        </tbody>
                                        <tfoot>
										
									
                                            <tr>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                            </tr>
										
                                        </tfoot>
                                    </table>
									</div>
									</div>	
									</div>
								
									
                                    
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

                            <!-- /.box -->
                        </div>
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside>
<script>
	function choose_submit(val,id,frm_id)
	{
		var confrim  = '';
	
		if(val=='2')
		{
			confrim  = confirm("Are you want to Assign Funding to Evaluation? ");
		}
		if(val=='3')
		{
			confrim  = confirm("Are you want to Assign Funding to Awarded? ");
			$("#"+frm_id).attr("action", "fund-awarded");
		}
		if(val=='4')
		{
			confrim  = confirm("Are you want to Close Funding? ");
		}
		
		if(confrim)
		{
			$("#"+frm_id).submit();	
		}
		else
		{
			return false;
		}
	}
	
</script>			