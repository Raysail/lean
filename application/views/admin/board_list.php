<aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1> Content 
                        <small>Preview</small>                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url();?>administrator/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active"> Board Member list </li>
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
									
									<a href="<?php echo base_url();?>administrator/board-form" style="float:right; padding-right:20px; padding-top:10px;"> Add New </a> 
												
									
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php 
											if(!empty($list)){
											foreach($list as  $list ){							
												
												?>
                                            <tr>
                                                <td>
													
												<?php if(!empty($list->bord_image)){?>
												<img src="<?php echo base_url();?>upload/board/<?php echo $list->bord_image;?>" width="100px" height="110px;" />
												<?php }?></td>
                                                <td><?php echo $list->bord_name;?></td>
                                                <td><?php echo $list->bord_email;?></td>
                                                <td>
												<?php 
												
												if($list->bord_status) {?>
												<a  href="<?php echo base_url().'admin/content/bord_status/'.$list->bord_id.'/'.$list->bord_status; ?>" onclick="return status_wal()" ><span class="label label-success">Active</span></a>
												<?php		}
												else
												{
													?>
													<a  href="<?php echo base_url().'admin/content/bord_status/'.$list->bord_id.'/'.$list->bord_status; ?>" onclick="return status_wal()" ><span class="label label-danger">Inactive</span></a>
													<?php
												}
												?>
											</td>
                                                <td>
												<a href="<?php echo base_url();?>administrator/board-form/<?php echo  $list->bord_id; ?>"><i class="fa fa-pencil"></i></a> 
													
													<a  href="<?php echo base_url().'admin/content/bord_delete/'.$list->bord_id; ?>" onclick="return delete_wal()" ><i class="fa fa-times"></i></a>
                                                           
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