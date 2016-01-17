<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>OJS ADMIN SECTION</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo base_url();?>design/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo base_url();?>design/admin/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo base_url();?>design/admin/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="<?php echo base_url();?>design/admin/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="<?php echo base_url();?>design/admin/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url();?>design/admin/css/Admin.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
		
		

<script src="<?php echo base_url();?>design/js/jquery-1.8.1.min.js"></script> 

<script src="<?php echo base_url();?>design/js/jquery.validate.min.js" type="text/javascript"></script>		
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="<?php  echo base_url();?>administrator/dashboard" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                Admin Panel
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
           
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $this->session->userdata('adminname'); ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <!--<li class="user-header bg-light-blue">
                                    <img src="img/avatar3.png" class="img-circle" alt="User Image" />
                                    <p>
                                        Jane Doe - Web Developer
                                        <small>Member since Nov. 2012</small>
                                    </p>
                                </li>-->
                                <!-- Menu Body -->
                             <!--   <li class="user-body">
                                    <div class="col-xs-7 text-center">
                                        <a href="<?php echo base_url();?>administrator/change-password">Change Password </a>
                                    </div>
                                   
                                </li>-->
                                <!-- Menu Footer-->
                               <!-- <li class="user-footer">
                                    <div class="pull-right">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
								</li>-->
								<li class="user-footer">	
                                    <div class="pull-right">
                                        <a href="<?php echo base_url();?>administrator/signout" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
  
                    <!-- sidebar menu: : style can be found in sidebar.less -->
					<?php $class = ' class="active"';?>
                    <ul class="sidebar-menu">
                        <li <?php if($this->uri->segment(2) == 'dashboard'){ echo $class;}?>>
                            <a href="<?php  echo base_url();?>administrator/dashboard">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
						
                        <li <?php if(($this->uri->segment(2) == 'pages-list')|| ($this->uri->segment(2) == 'pages-form')){echo $class;}?>>
                            <a href="<?php  echo base_url();?>administrator/pages-list">
                                <i class="fa fa-th"></i> <span>Content Pages</span> 
                            </a>
                        </li> 
						
                        <li <?php if(($this->uri->segment(2) == 'channel-list')||($this->uri->segment(2) == 'channel-form')){echo $class;}?>>
                            <a href="<?php  echo base_url();?>administrator/channel-list">
                                <i class="fa fa-th"></i> <span>Channels Pages</span> 
                            </a>
                        </li> 
						
						
                        <li <?php if(($this->uri->segment(2) == 'board-list')||($this->uri->segment(2) == 'board-form')){echo $class;}?>>
                            <a href="<?php  echo base_url();?>administrator/board-list">
                                <i class="fa fa-th"></i> <span>Editorial Board</span> 
                            </a>
                        </li> 
						
						
                        
                        <li class="treeview <?php if(($this->uri->segment(2) == 'articletype-list')  ||  ($this->uri->segment(2) == 'articletype-form')||($this->uri->segment(2) == 'articlesubmi-list')|| ($this->uri->segment(2)=='articlesubmi-form')){echo 'active';}?>">
                            <a href="#">
                                <i class="fa fa-edit"></i> <span>Article Module</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php  echo base_url();?>administrator/articletype-list"><i class="fa fa-angle-double-right"></i>Article Type</a></li>
                                <li><a href="<?php  echo base_url();?>administrator/articlesubmi-list"><i class="fa fa-angle-double-right"></i>Submission Classification</a></li>
								<li><a href="#"><i class="fa fa-angle-double-right"></i>Article List</a></li> <!--<?php  echo base_url();?>administrator/article-list-->                             
                            </ul>
                        </li>
						
                        
                        <li class="treeview  <?php if(($this->uri->segment(2) == 'author-list')  ||  ($this->uri->segment(2) == 'editor-list')||($this->uri->segment(2) == 'reviewer-list')|| ($this->uri->segment(2)=='publisher-list')|| ($this->uri->segment(2)=='author-form')|| ($this->uri->segment(2)=='editor-form')|| ($this->uri->segment(2)=='reviewer-form')|| ($this->uri->segment(2)=='publisher-form')){echo 'active';}?>">
                            <a href="#">
                                <i class="fa fa-edit"></i> <span>User Module</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url();?>administrator/author-list"><i class="fa fa-angle-double-right"></i>Author List</a></li>
                                <li><a href="<?php echo base_url();?>administrator/editor-list"><i class="fa fa-angle-double-right"></i>Editor List</a></li>
								<li><a href="<?php echo base_url();?>administrator/reviewer-list"><i class="fa fa-angle-double-right"></i>Reviewer List</a></li>  
								<li><a href="<?php echo base_url();?>administrator/publisher-list"><i class="fa fa-angle-double-right"></i>Publisher List</a></li>                              
                            </ul>
                        </li>
						
                        <li class="treeview   <?php if(($this->uri->segment(2) == 'general-setting')  ||  ($this->uri->segment(2) == 'social-icon')||($this->uri->segment(2) == 'social-form')|| ($this->uri->segment(2)=='change-password')){echo 'active';}?>">
                            <a href="#">
                                <i class="fa fa-edit"></i> <span>Site Setting</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php  echo base_url();?>administrator/general-setting"><i class="fa fa-angle-double-right"></i>General Settings</a></li>
								<li><a href="<?php  echo base_url();?>administrator/social-icon"><i class="fa fa-angle-double-right"></i>Manage Social Links</a></li>
								<li><a href="<?php  echo base_url();?>administrator/change-password"><i class="fa fa-angle-double-right"></i>Change Password</a></li>
								  
                            </ul>
                        </li>
						
						
						
                        
                        
					
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>