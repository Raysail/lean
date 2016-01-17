<aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1> Content 
                        <small>Preview</small>                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url();?>administrator/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active"> Content  list </li>
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
									
									<?php if($page_display==1){?>
									<a href="<?php echo base_url();?>administrator/pages-form" style="float:right; padding-right:20px; padding-top:10px;"> Add New </a> 
									<?php }elseif($page_display=='2'){?> 
									<a href="<?php echo base_url();?>administrator/channel-form" style="float:right; padding-right:20px; padding-top:10px;"> Add New </a> 
									<?php }?>
												
									
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Url</th>
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
                                                <td><?php echo $list->page_title;?></td>
                                                <td><?php echo $list->page_url;?></td>
                                                <td>
												<?php 
												
												if($list->page_status) {?>
												<a  href="<?php echo base_url().'admin/content/page_status/'.$list->page_id.'/'. $list->page_status.'/'.$page_display; ?>" onclick="return status_wal()" ><span class="label label-success">Active</span></a>
												<?php		}
												else
												{
													?>
													<a  href="<?php echo base_url().'admin/content/page_status/'.$list->page_id.'/'.$list->page_status.'/'.$page_display; ?>" onclick="return status_wal()" ><span class="label label-danger">Inactive</span></a>
													<?php
												}
												?>
											</td>
                                                <td>
												<?php if($page_display==1){?>
												<a href="<?php echo base_url();?>administrator/pages-form/<?php echo  $list->page_id; ?>"><i class="fa fa-pencil"></i></a> 
												<?php }elseif($page_display=='2'){?> 
												<a href="<?php echo base_url();?>administrator/channel-form/<?php echo  $list->page_id; ?>"><i class="fa fa-pencil"></i></a> 
												<?php }?>
													
													<a  href="<?php echo base_url().'admin/content/page_delete/'.$list->page_id.'/'.$page_display; ?>" onclick="return delete_wal()" ><i class="fa fa-times"></i></a>
                                                           
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