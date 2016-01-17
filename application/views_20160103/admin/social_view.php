<aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Social
                        <small>Preview</small>                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url();?>administrator/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active"> Social list </li>
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
									<a href="<?php echo base_url();?>administrator/social-form" style="float:right; padding-right:20px; padding-top:10px;"> Add New Social Icon</a>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
											    <th>Title</th>
											    <th>Link</th>
                                                <th>Icon</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php 
											if(!empty($list)){
											foreach($list as  $list ){?>
                                            <tr>
											    <td><?php echo $list->social_title; ?></td>
												<td><?php echo $list->social_link; ?></td>
												
                                                <td>
												<img src="<?php echo base_url().'timthumb.php?src='.base_url().'upload/slider/'.$list->social_icon.'&w=40&h=40';?>" style="margin:3px 3px 3px 3px">	
												</td>
                                                <td>
												<?php 
												
												if($list->social_status) {?>
												<a  href="<?php echo base_url().'admin/setting/social_status/'. $list->social_id.'/'. $list->social_status; ?>" onclick="return status_wal()" ><span class="label label-success">Active</span></a>
												<?php		}
												else
												{
													?>
													<a  href="<?php echo base_url().'admin/setting/social_status/'. $list->social_id.'/'. $list->social_status; ?>" onclick="return status_wal()" ><span class="label label-danger">Inactive</span></a>
													<?php
												}
												?>
											</td>
                                                <td>
															<a href="<?php echo base_url();?>administrator/social-form/<?php echo  $list->social_id; ?>"><i class="fa fa-pencil"></i></a>
															<a  href="<?php echo base_url().'admin/setting/social_delete/'.$list->social_id; ?>" onclick="return delete_wal()" ><i class="fa fa-times"></i></a>
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
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

                            <!-- /.box -->
                        </div>
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside>