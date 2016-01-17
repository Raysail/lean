<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="<?php if(isset($meta_desc)){echo $meta_desc;}else{get_meta_desc();}?>">
<meta name="keyword" content="<?php if(isset($meta_key)){echo $meta_key;}else{get_meta_keyword();}?>">
<meta name="author" content="">
<link rel="icon" href="../../favicon.ico">





<title> <?php if(isset($meta_title)){echo $meta_title;}else{get_meta_title();}?></title>

<!-- Bootstrap core CSS -->
<link href="" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="<?php echo base_url();?>design/front/css/master.css" rel="stylesheet">
<link href="<?php echo base_url();?>design/front/css/new_master.css" rel="stylesheet">
<link href="<?php echo base_url();?>design/front/css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>design/front/css/style2.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>design/front/css/animate-custom.css" />
<link href="<?php echo base_url();?>design/front/css/font-awesome.css" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>design/front/css/base.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>design/front/css/buttons.css" />
<link href="<?php echo base_url();?>design/front/css/font-awesome.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>design/front/css/easy-responsive-tabs.css " />


<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>design/front/css/normalize.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>design/front/css/demo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>design/front/css/component.css" />
<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>design/datepicker/css/datepicker.css" />-->


<link href="<?php echo base_url();?>design/front/css/smk-accordion.css" rel="stylesheet">

<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>


<script src="<?php echo base_url(); ?>design/js/jquery-1.8.1.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>design/js/jquery.validate.min.js" type="text/javascript"></script>


<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="wrapper">
  <div class="main_wrapper"> 
    
    <!-- Fixed navbar -->
    
    <div class="main_header">
      <nav class="navbar navbar-default navbar-fixed-top main_menu ">
        <div class="container">
          <div class="col-md-4">
            <div class="logo"> <a href="<?php echo base_url();?>"> <img src="<?php echo base_url();?>design/front/images/logo.png"></a> </div>
          </div>
          <div class="col-md-8">
            <div class="main_nav">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                <a class="navbar-brand" href="#"></a> </div>
              <div id="navbar" class="navbar-collapse collapse orng-menu">
                <ul class="nav navbar-nav">
				<li class="dropdown">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-newspaper-o"></i>Articl<b class="caret"></b></a>
                <ul class="dropdown-menu">			
                    <li><a href="<?php echo base_url();?>"><i class="fa fa-inbox"></i> Article ASAP</a></li>
                    <li><a href="<?php echo base_url().'archive-list';?>"><i class="fa fa-file-archive-o"></i>Archive</a></li>
                </ul>
            </li>
			
			<li><a href="<?php echo base_url().'funding-list';?>"><i class="fa fa-database"></i>Funding</a></li>
						
                  <li>
				  <?php 
				  $link ='';
				  if($this->session->userdata('userid'))
				  {				  	
				 	 $link = base_url().'user-dashboard';	
				  }
				  else
				  { 	
				 	 $link = base_url().'login';				  
				  }
				  ?>
				  <a href="<?php echo $link;?>">	
				  
				  	<span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Submission & Review
				  
				  </a></li>
                  <li><a href="<?php echo base_url().'editorial-board';?>"><i class="fa fa-user"></i> Editorial Board</a></li>
				
                  
                  <li><a href="#contact" data-toggle="modal" data-target="#myModal"><i class="fa fa-search"></i></a> </li>
                </ul>
              </div>
              <!--/.nav-collapse --> 
              
            </div>
          </div>
        </div>
      </nav>
    </div>
    <div class="container"> 
      <!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog"> 
          
          <!-- Modal content-->
          <div class="modal-content new_ser">
            <div class="modal-header n_h">
              <button type="button" class="close n_c" data-dismiss="modal">&times;</button>
            </div>
			<form action="<?php echo base_url();?>search-detail" name="search_frm" method="post">
            <div class="modal-body">
              <div class="input-group new_search">
                <input type="text" class="form-control ser_sec" name="search_art" id="search_art" placeholder="Search for..." required>
                <span class="input-group-btn">
                <button class="btn btn-default new_but" type="submit"><i class="fa fa-search"></i></button>
                </span> 
				</div>
            </div>
			</form>
          </div>
        </div>
      </div>
    </div>