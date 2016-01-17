<aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><?php echo $user_type; ?>  User   <small>Preview</small>                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url();?>administrator/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active"> <?php echo $user_type; ?> User  list </li>
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
								
									<?php if(($this->uri->segment(2)!='publisher-list') &&
									($this->uri->segment(2)!='editor-list')){?>
									<a href="<?php echo base_url();?>administrator/<?php echo $add_link;?>-form" style="float:right; padding-right:20px; padding-top:10px;"> Add New User</a>
									<?php } ?>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email </th>
                                                <th>Instiution</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php 
											if(!empty($list)){
											$i=0;
											foreach($list as  $list ){?>
                                            <tr>
                                                <td><?php echo ucfirst($list->user_fname).'&nbsp;'.ucfirst($list->user_fname);?></td>
                                                <td><?php echo $list->user_email;?></td>
                                                <td><?php echo $list->user_instiute;?></td>
                                                <td><?php 
												
												if($list->user_status) {?>
												<a  href="<?php echo base_url().'admin/user/user_status/'. $list->user_id.'/'. $list->user_status.'/'.$user_type_id; ?>" onclick="return status_wal()" ><span class="label label-success">Active</span></a>
												<?php		}
												else
												{
													?>
													<a  href="<?php echo base_url().'admin/user/user_status/'. $list->user_id.'/'. $list->user_status.'/'.$user_type_id; ?>" onclick="return status_wal()" ><span class="label label-danger">Inactive</span></a>
													<?php
												}
												?></td>
                                                <td>
                                              			<a href="<?php echo base_url();?>administrator/<?php echo $add_link;?>-form/<?php echo  $list->user_id; ?>"><i class="fa fa-pencil"></i></a>	
														<?php if(($this->uri->segment(2)!='publisher-list') &&
									($this->uri->segment(2)!='editor-list')){?>									
														<a  href="<?php echo base_url().'admin/user/user_delete/'. $list->user_id.'/'.$user_type_id; ?>" onclick="return delete_wal()" ><i class="fa fa-times"></i></a>
														<?php }?>
														<a class="btn btn-block btn-primary" data-toggle="modal" data-target="#compose-modal<?php echo $i;?>" >View</a>
															
																   <!-- COMPOSE MESSAGE MODAL -->
        <div class="modal fade" id="compose-modal<?php echo $i;?>" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-envelope-o"></i>Full Detail of User</h4>
                    </div>
                        <div class="modal-body">
                            <div class="form">
                                <div class="input">
                                    <span class="input-group" style="float:left;font-weight:bold; ">User Name: &nbsp;&nbsp;</span>
									<span><?php echo ucfirst($list->user_fname).'&nbsp;'.ucfirst($list->user_lname);?></span>
                                </div>
								<p>&nbsp;	</p>
                            </div>
                            <div class="form">
                                <div class="input">
                                    <span class="input-group"  style="float:left;font-weight:bold; ">Email:&nbsp;&nbsp;</span>
									<span><?php echo $list->user_email;?></span>

                                </div>
								<p>&nbsp;	</p>
                            </div>
                            <div class="form">
                                <div class="input">
                                    <span class="input-group"  style="float:left;font-weight:bold;">Address: &nbsp;&nbsp;</span>
									<span>	<?php echo $list->user_address;?></span>
                                </div>
								<p>&nbsp;</p>
                            </div>
                            <div class="form">
                                <div class="input">
                                    <span class="input-group"  style="float:left;font-weight:bold;">Instiution:&nbsp;&nbsp;</span>
									<span>	<?php echo  $list->user_instiute ?></span>
                                </div>
										<p>&nbsp;</p>
                            </div>
                            <div class="form">
                                <div class="input">
                                    <span class="input-group"  style="float:left;font-weight:bold;">Country:&nbsp;&nbsp;</span>
									<span><?php echo $list->user_country;?></span>
                                </div>
										<p>&nbsp;</p>
                            </div>
                            
                            <div class="form">
                                <div class="input">
                                    <span class="input-group"  style="float:left;font-weight:bold;">Personal Classification:&nbsp;&nbsp;</span><br>
									
						<?php 				
						$ij=0;		
						foreach($classified as $classi)
						{
							
								$explode_classi = explode(',',$list->user_classification);
							if(in_array($classi->asubmi_id,$explode_classi)){
							$ij++;
							 echo '<span style="padding-left:50px;">'.$ij.': '.$classi->asubmi_title.'</span><br>';							
							}
								
						}
						?>
									
									
                                </div>
										<p>&nbsp;</p>
                            </div>
						
                        </div>
                        
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
												</td>
                                            </tr>	<?php  $i++;}
											}
											?>
                                        </tbody>
                                        <tfoot>
										
									
											<?php 	if(!empty($list)){?>
                                            <tr>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                            </tr>
										<?php  }else{?> 
                                            <tr>
                                                <th colspan="6">&nbsp;</th>
                                            </tr>
										<?php } ?>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

                            <!-- /.box -->
                        </div>
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside>