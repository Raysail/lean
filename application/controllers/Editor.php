<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class  Editor extends CI_Controller {

	public function __construct(){
	
		parent:: __construct();
		/* Load the libraries and helpers */ 
		$this->load->model('user_model');
		$this->load->library('upload');
		$this->load->library('pagination');
		date_default_timezone_set('Asia/Kolkata');
		$this->load->helper('login');
		$this->load->library('encrypt');
		$this->load->helper('general');	
		login_user_check();
		front_editor_user_func_check();
	}
	
	
	/* 26-AUG-2015*/
	
	public function editor_view_project()
	{
	
		$art_no = $this->uri->segment(2);
		
		$select_filed = 'a.*,u.*';	
		$tbl_name= 'tbl_article as  a ';	
		$where_condition = array('a.art_no'=>$art_no,'a.art_status > '=>'0');
		$order_by_field = 'a.art_id';
		$order_by_type ='desc';
		$group_by_field = 'a.art_id';
		$join_tbl1 = 'tbl_users as u'; 
		$join_type1 = 'left'; 
		$join_condition1 = 'u.user_id=a.art_userid';
	
	
		$data['article_data'] = $this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field, $join_tbl1, $join_type1, $join_condition1);
		
		if(!empty($data['article_data']))	
		{	
		
			 $art_id = $data['article_data'][0]->art_id;
				$art_userid = $data['article_data'][0]->art_userid;										
			$data_update = array( 'e_read'=>'1');
			$where_condition 	= '(art_id="'.$art_id.'")';			
			$update_pass   = $this->user_model->update_query($data_update,'tbl_article_message',$where_condition);	
			
			$data['other_author'] =$this->user_model->select_query('*','tbl_other_author',array(
																'oa_art_id'=>$art_id,
																'oa_userid'=>$art_userid
																),'oa_order','asc');
																	
																
																
			$data['all_message'] =$this->user_model->select_query('*','tbl_article_message',array(
																'art_id'=>$art_id
																),'id','desc');
			$data['art_no'] = $art_no;
																
										
			
				
			
			$this->load->view( 'header' );
			$this->load->view( 'editor/project_detail',$data);
			$this->load->view( 'footer');
			
		}
		else
		{
			redirect('user-dashboard');
		}
			
	}
	
	public function send_message_box()
	{
	
		/*echo '<pre>';
		print_r($_POST);
		exit;*/
		
		if(isset($_POST['msg_id']))
		{
			$data['msg_id'] = $_POST['msg_id'];
			
			$art_msg =$this->user_model->get_row_with_con('tbl_article_message',array('id'=> $_POST['msg_id']));
			$data['msg_status']=$art_msg->art_status;
		}
	
		$data['art_for']  = $this->uri->segment(1);
		$art_no = $this->uri->segment(2);
		
		$select_filed = 'a.*,u.*';	
		$tbl_name= 'tbl_article as  a ';	
		$where_condition = array('a.art_no'=>$art_no,'a.art_status > '=>'0');
		$order_by_field = 'a.art_id';
		$order_by_type ='desc';
		$group_by_field = 'a.art_id';
		$join_tbl1 = 'tbl_users as u'; 
		$join_type1 = 'left'; 
		$join_condition1 = 'u.user_id=a.art_userid';
	
	
		$data['article_data'] = $this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field, $join_tbl1, $join_type1, $join_condition1);
		
		if(!empty($data['article_data']))	
		{	
			$data['other_author'] =$this->user_model->select_query('*','tbl_other_author',array(
																'oa_art_id'=>$data['article_data'][0]->art_id,
																'oa_userid'=>$data['article_data'][0]->art_userid
																),'oa_order','asc');
			$data['art_no'] = $art_no;
			
			$this->load->view( 'header' );
			$this->load->view( 'editor/project_message',$data);
			$this->load->view( 'footer');
			
		}
		else
		{
			redirect('user-dashboard');
		}
			
	}
	
	function back_decline_action()
	{
		/*echo '<pre>';
		print_r($_POST);*/
		
		extract($this->input->post());
		
		$user_data =$this->user_model->get_row_with_con('tbl_users',array('user_id'=>$art_userid));
		
		
				
				 
				 $arti_status = '1';
				 if($art_status=='back')
				 {
				 	 $arti_status = '3';
				 }
				 elseif($art_status=='declined')
				 {
				 	 $arti_status = '4';
				 }
			
				 
				 $inset_data  = 	array("art_id"=>$art_id,
										  "art_status"=>$arti_status,
										  "from_type"=>'E',
										  "to_type"=>'A',
										  "from_id"=>$this->session->userdata('userid'),
										  "to_id"=>$art_userid,
										  "message"=>$art_message,
										  "e_read"=>'1',
										  "date"=>date('Y-m-d')
								  );
			
										
							$insert = $this->user_model->insert_data('tbl_article_message',$inset_data);
							
			$data = array( 'art_status' => $arti_status,'art_update'=>date('Y-m-d'));
			$where_condition 	= '(art_id="'.$art_id.'")';			
			$update_pass   = $this->user_model->update_query($data,'tbl_article',$where_condition);
			$get_manuscript   = $this->user_model->get_row_with_con('tbl_article',$where_condition);
				
							
							
							$copy = $this->user_model->get_row_with_con('tbl_admin',array('id'=>1));
							 $to = $user_data->user_email;
							$subject = 'Article Process ';
							$message = "<html>
							<head>
							<title>".$subject."</title>
							</head>
							<body>
							<div  style='width:700px; float:left;'>
  <div  style='width: 98%;float: left;background: #F7F7F7;padding: 1%;border-radius: 4px;border-top: 3px solid #ee4723;'>
  <div> <img src='".base_url()."design/front/images/logo.png'/> </div> 
								<p style='font-size: 17px; font-family:Tahoma, Geneva, sans-serif;'>Dear ".$user_data->user_fname.'&nbsp;'.$user_data->user_lname.", </p>
							 <p style='font-size: 15px; font-family:Tahoma, Geneva, sans-serif; color: #646161'>".$art_message." <br><br>"; 
							 $message .="<a href='".base_url()."login'><button type='button' style='background: #00CC33;border: none;padding:1% 2%;color: #fff; letter-spacing: 1px;margin: 0% 0% 1%;cursor: pointer;font-size: 16px;border-radius: 4px;'>Auhtor Mainmenu</button> </a><br><br>
Your username is: ".$user_data->user_email."<br><br>
Your password is: ".$user_data->user_invitepass."<br><br>";							 
							 
							 $message .="</p>
							 </div>
  <div  style='width:100%;float:left; background:#ee4723; padding:0%; color:#fff; text-align:center;'>
    <p>".$copy->footer_copy."</p>
  </div>
</div>
							</body>
							</html>
							";
							
						/*	echo $to.'<br>';
							echo MAILFROM.'<br>';
							echo MAILFROMNAME.'<br>';
							
							echo $message;
							exit;*/
							$result = chatroomemail($to,MAILFROM,MAILFROMNAME,$subject,$message);
							
							if($arti_status==3)
							{
								$back_to= $user_data->user_email;
							
								$subject_back = 'Manuscript need to modify.';
								$back_message = "<html>
								<head>
								<title>".$subject_back."</title>
								</head>
								<body>
								<div  style='width:700px; float:left;'>
	  <div  style='width: 98%;float: left;background: #F7F7F7;padding: 1%;border-radius: 4px;border-top: 3px solid #ee4723;'>
	  <div> <img src='".base_url()."design/front/images/logo.png'/> </div> 
									<p style='font-size: 17px; font-family:Tahoma, Geneva, sans-serif;'>Dear ".$user_data->user_fname.'&nbsp;'.$user_data->user_lname.", </p>
								 <p style='font-size: 15px; font-family:Tahoma, Geneva, sans-serif; color: #646161'>Your manuscript,".$get_manuscript->art_fulltitle.", have been checked by editor. The editor ask you to modify this manuscript in one week <br><br>If you wish to check the process of manuscript and, please click the button of login to your account below:<br><br>"; 
								 $back_message .="<a href='".base_url()."login'><button type='button' style='background: #00CC33;border: none;padding:1% 2%;color: #fff; letter-spacing: 1px;margin: 0% 0% 1%;cursor: pointer;font-size: 16px;border-radius: 4px;'>Update menuscript</button> </a><br><br>";							 
								 
								 $back_message .="
								 Please note, your user ID and password are the same for Lean Corrosion as author and reviewer.<br><br>
Or you can use the link of Lean Corrosion to log in as reviewer.<br>
	Your username is: ".$user_data->user_email."<br><br>
	Your password is: ".$user_data->user_invitepass."<br><br>
	Yours sincerely,<br>
Lean Corrosion Editorial Office<br>
leancorrosion@lean.com<br>


								 </p>
								 </div>
	  <div  style='width:100%;float:left; background:#ee4723; padding:0%; color:#fff; text-align:center;'>
		<p>".$copy->footer_copy."</p>
	  </div>
	</div>
								</body>
								</html>
								";
							
							
							
							$result = chatroomemail($back_to,MAILFROM,MAILFROMNAME,$subject_back,$back_message);
							}
							
							
								
								
							if($result==false) {
								$this->session->set_flashdata("error", 'Email not send');
								//	redirect('login');
								redirect('user-dashboard');
							} else {
							
							   $this->session->set_flashdata("success","Email Send to author");	
								//	redirect('login');
								redirect('user-dashboard');
							
							}
		
		
		
		
	}
	
	function send_msg_action()
	{
		/*echo '<pre>';
		print_r($_POST);
		exit;*/
		
		
		extract($this->input->post());
		
		
		
		
			$data_update = array( 'again_send'=>'1');
			$where_condition 	= '(id="'.$msg_id.'")';			
			$update_pass   = $this->user_model->update_query($data_update,'tbl_article_message',$where_condition);
			
			
		$user_data =$this->user_model->get_row_with_con('tbl_users',array('user_id'=>$art_userid));
		
		
				 	 $arti_status = $art_status;
			
				 
				 $inset_data  = 	array("art_id"=>$art_id,
										  "art_status"=>$arti_status,
										  "from_type"=>'E',
										  "to_type"=>'A',
										  "from_id"=>$this->session->userdata('userid'),
										  "to_id"=>$art_userid,
										  "message"=>$art_message,
										  "e_read"=>'1',
										  "date"=>date('Y-m-d')
								  );
			
										
							$insert = $this->user_model->insert_data('tbl_article_message',$inset_data);
							
							
							
							$copy = $this->user_model->get_row_with_con('tbl_admin',array('id'=>1));
							 $to = $user_data->user_email;
							$subject = 'Article Process ';
							$message = "							
							<html>
							<head>
							<title>".$subject."</title>
							</head>
							<body>
							<div  style='width:700px; float:left;'>
  <div  style='width: 98%;float: left;background: #F7F7F7;padding: 1%;border-radius: 4px;border-top: 3px solid #ee4723;'>
  <div > <img src='".base_url()."design/front/images/logo.png'/> </div> 
								<p style='font-size: 17px; font-family:Tahoma, Geneva, sans-serif;'>Dear ".$user_data->user_fname.'&nbsp;'.$user_data->user_lname.", </p>
							 <p style='font-size: 15px; font-family:Tahoma, Geneva, sans-serif; color: #646161'>".$art_message." <br><br>
							</p>
							 </div>
  <div  style='width:100%;float:left; background:#ee4723; padding:0%; color:#fff; text-align:center;'>
    <p>".$copy->footer_copy."</p>
  </div>
</div>
							</body>
							</html>
							";
							
						/*	echo $to.'<br>';
							echo MAILFROM.'<br>';
							echo MAILFROMNAME.'<br>';
							
							echo $message;
							exit;*/
							$result = chatroomemail($to,MAILFROM,MAILFROMNAME,$subject,$message);
							
							
								
								
							if($result==false) {
								$this->session->set_flashdata("error", 'Email not send');
								//	redirect('login');
								redirect('user-dashboard');
							} else {
							
							   $this->session->set_flashdata("success","Email Send to author");	
								//	redirect('login');
								redirect('user-dashboard');
							
							}
	}
	
	function assign_reviewer()
	{
		
		$art_no = $this->uri->segment(2);
		
		$select_filed = 'a.*,u.*';	
		$tbl_name= 'tbl_article as  a ';	
		$where_condition = "a.art_no='".$art_no."' AND (a.art_status='1' OR a.art_status='3')"; 
							// array('a.art_no'=>$art_no,'a.art_status > '=>'0');
		$order_by_field = 'a.art_id';
		$order_by_type ='desc';
		$group_by_field = 'a.art_id';
		$join_tbl1 = 'tbl_users as u'; 
		$join_type1 = 'left'; 
		$join_condition1 = 'u.user_id=a.art_userid';
	
	
		$data['article_data'] = $this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field, $join_tbl1, $join_type1, $join_condition1);
		
		if(!empty($data['article_data']))	
		{	
			$reviewer_info = $this->user_model->select_query('*','tbl_users',array('user_status'=>'1','user_type'=>'3','user_inviteid'=>''),'user_id', 'desc');	
			 
			 		 			
			
			//$other_data =$this->user_model->select_query('*','tbl_users',array('user_status'=>'1','user_type'=>'3','user_artid'=>$data['article_data'][0]->art_id),'user_id', 'desc');
			
			
			$other_suthor  = $this->user_model->select_query(' GROUP_CONCAT(oa_email) as other_email','tbl_other_author',array("oa_art_id"=>$data['article_data'][0]->art_id));
			
			if(!empty($other_suthor)){
			$whre_other = "user_status = 1 AND (user_reviewer = 1 AND user_id != '".$data['article_data'][0]->art_userid."' AND  (!FIND_IN_SET('user_email','".$other_suthor[0]->other_email."')))"; 
			}else
			{
			$whre_other = "user_status = 1 AND (user_reviewer = 1 AND user_id != '".$data['article_data'][0]->art_userid."')"; 
			}
			
			$whre_author_request =  "user_status = 1 AND (FIND_IN_SET('".$data['article_data'][0]->art_id."',user_artid))"; 
			
			
			$other_data =$this->user_model->select_query('*','tbl_users',$whre_other,'user_id', 'desc','user_id');
			$author_request_data = $this->user_model->select_query('*','tbl_users',$whre_author_request,'user_id', 'desc','user_id');
			
						
			$reviewer_info_new ='';
			
			if(!empty($other_data)&& !empty($reviewer_info)){
				$reviewer_info_new  = array_merge($other_data,$reviewer_info);
			}	
			elseif(!empty($reviewer_info))
			{
				$reviewer_info_new = $reviewer_info;
			}	
			elseif(!empty($other_data))
			{
				$reviewer_info_new  = $other_data;
			}				
			
			if( !empty($author_request_data ) )
			{
				$data['reviewer_info'] = array_merge($author_request_data,$reviewer_info_new);
			}else
			{
				$data['reviewer_info'] = $reviewer_info_new;
				
			}
			
					
					
			
			$data['art_no'] = $art_no;
			
			$this->load->view( 'header' );
			$this->load->view( 'editor/reviewer_list',$data);
			$this->load->view( 'footer');
			
		}
		else
		{
			redirect('user-dashboard');
		}
	}
	
	function chose_reviewer()
	{
		 
		 
		/* echo '<pre>';
		 print_r($_POST);
		 exit;*/
		 
		   extract($this->input->post());
				 
				 $all_reviewers_name  ='';
		 $sub_status=0;
		 
		 	$art_message = "we invite ".count($user_id)." Reviewers to review your mauscript. Please wait for acceptance of reviewers";
		 $inset_data  = 	array("art_id"=>$art_id,
										  "art_status"=>'2',
										  "from_type"=>'E',
										  "to_type"=>'A',
										  "from_id"=>$this->session->userdata('userid'),
										  "to_id"=>$art_userid,
										  "message"=>$art_message,
										  "e_read"=>'1',
										  "date"=>date('Y-m-d')
								  );
			
										
							$insert_msg = $this->user_model->insert_data('tbl_article_message',$inset_data);
							
							
		 
			$data_update = array( 'art_duedate' => date('Y-m-d',strtotime($due_date)), 'art_status'=>'2');
			$where_condition 	= '(art_id="'.$art_id.'")';			
			$update_pass   = $this->user_model->update_query($data_update,'tbl_article',$where_condition);
			
		 foreach($user_id as $user_list)
		 {
				 
			$str = md5(uniqid(rand(), true));
			$randum_key = md5($str);
			
				 
		 	$inset_data  =  array(	"asign_artid"=>$art_id,
									"asign_status"=>$sub_status,
									"asign_userid"=>$user_list,
									"asign_byuserid"=>$this->session->userdata('userid'),
									"asign_randum"=>$randum_key,
									"asign_msgid"=>$insert_msg,
									"asign_date"=>date("Y-m-d"));
										
							$insert = $this->user_model->insert_data('tbl_assgin_reviewer',$inset_data);	
										
							
							
							$user_detail = $this->user_model->get_row_with_con('tbl_users',array('user_id'=>$user_list));
							
							$all_reviewers_name  .= $user_detail->user_fname.'&nbsp;'.$user_detail->user_lname.'<br>';
							
							
							
							$art_detail = $this->user_model->get_row_with_con('tbl_article',array('art_id'=>$art_id));
							
							$copy = $this->user_model->get_row_with_con('tbl_admin',array('id'=>1));
							 $to = $user_detail->user_email;
							$subject = 'New article for review';
							$message = "							
							<html>
							<head>
							<title>".$subject."</title>
							</head>
							<body>
							<div  style='width:700px; float:left;'>
  <div  style='width: 98%;float: left;background: #F7F7F7;padding: 1%;border-radius: 4px;border-top: 3px solid #ee4723;'>
  <div > <img src='".base_url()."design/front/images/logo.png'/> </div> 
								<p style='font-size: 17px; font-family:Tahoma, Geneva, sans-serif;'>Dear ".$user_detail->user_fname.'&nbsp;'.$user_detail->user_lname.", </p>
							 <p style='font-size: 15px; font-family:Tahoma, Geneva, sans-serif; color: #646161'>
							 	We are assigne to you a  new article '".$art_detail->art_fulltitle."' for review. Please accept that artical request and update.
							  <br><br>
								Your account name:".$user_detail->user_email."<br>
								Your password: ".$user_detail->user_invitepass."<br>								
								You can accept or reject the invitation by the following button:
								<br><br>
								  <a href='".base_url()."reviewer-agree/".$randum_key."'>
							  	  <button type='button' style='background: #00CC33;border: none;padding:1% 2%;color: #fff; letter-spacing: 1px;margin: 0% 0% 1%;cursor: pointer;font-size: 16px;border-radius: 4px;'> Agree to Review</button> </a>
								     <a href='".base_url()."reviewer-reject/".$randum_key."'>
							  	  <button type='button' style='background: #00CC33;border: none;padding:1% 2%;color: #fff; letter-spacing: 1px;margin: 0% 0% 1%;cursor: pointer;font-size: 16px;border-radius: 4px;'> Reject to Review</button> </a>
							<br><br>	
							
 Or you can operate the process by account name or password with the following link: 
 
								</p>
								
							 <p align='center'>
							 
							 

							  <a href='".base_url()."login'>
							  	  <button type='button' style='background: #00CC33;border: none;padding:1% 2%;color: #fff; letter-spacing: 1px;margin: 0% 0% 1%;cursor: pointer;font-size: 16px;border-radius: 4px;'> Reviewer main meun</button>
							  	  </a>
								 <br><br>
							</p>
							 <p style='font-size: 15px; font-family:Tahoma, Geneva, sans-serif; color: #646161'>
							 Thank you, <br><br>
							 Lean corrosion

							 </p>
							 </div>
  <div  style='width:100%;float:left; background:#ee4723; padding:0%; color:#fff; text-align:center;'>
    <p>".$copy->footer_copy."</p>
  </div>
</div>
							</body>
							</html>
							";
							
						/*	echo $message;*/
							
							$result = chatroomemail($to,MAILFROM,MAILFROMNAME,$subject,$message);
							
							
		}
		
							
							
							
							$user_data =$this->user_model->get_row_with_con('tbl_users',array('user_id'=>$art_userid));
							
							$copy = $this->user_model->get_row_with_con('tbl_admin',array('id'=>1));
							 $to = $user_data->user_email;
							$subject = 'Manuscript has been assigned to the Reviewer';
							$message = "							
							<html>
							<head>
							<title>".$subject."</title>
							</head>
							<body>
							<div  style='width:700px; float:left;'>
  <div  style='width: 98%;float: left;background: #F7F7F7;padding: 1%;border-radius: 4px;border-top: 3px solid #ee4723;'>
  <div > <img src='".base_url()."design/front/images/logo.png'/> </div> 
								<p style='font-size: 17px; font-family:Tahoma, Geneva, sans-serif;'>Dear ".$user_data->user_fname.'&nbsp;'.$user_data->user_lname.", </p>
							 <p style='font-size: 15px; font-family:Tahoma, Geneva, sans-serif; color: #646161'>";
							$message .= 'Your manuscript entitled "'.$art_detail->art_fulltitle.'" has been assigned to the Reviewer: <br>'.$all_reviewers_name .'You can click the button of "author view" to check the process of manuscript.<br><br>';
							$message .="<a href='".base_url()."login'><button type='button' style='background: #00CC33;border: none;padding:1% 2%;color: #fff; letter-spacing: 1px;margin: 0% 0% 1%;cursor: pointer;font-size: 16px;border-radius: 4px;'>Auhtor Mainmenu</button></a><br><br>";
							 $message .="Submission of a manuscript to Lean Corrosion implies that the work reported therein has not received prior publication and is not under consideration for publication elsewhere in any medium, including electronic journals and computer databases of a public nature.  This manuscript is being considered with the understanding that it is submitted on an exclusive basis. If otherwise, please advise.<br><br>Sincerely,<br><br>
Yours sincerely,<br>
Lean Corrosion Editorial Office<br>
leancorrosion@lean.com<br>
<br><br>
							</p>
							 </div>
  <div  style='width:100%;float:left; background:#ee4723; padding:0%; color:#fff; text-align:center;'>
    <p>".$copy->footer_copy."</p>
  </div>
</div>
							</body>
							</html>
							";
							
						/*	echo $to.'<br>';
							echo MAILFROM.'<br>';
							echo MAILFROMNAME.'<br>';
							
							echo $message;
							exit;*/
							$result = chatroomemail($to,MAILFROM,MAILFROMNAME,$subject,$message);
							
							
						   $this->session->set_flashdata("success","Manuscript assign to reviewer.");	
							redirect('user-dashboard');
	}
	
	function assign_publisher()
	{
				
		$art_no = $this->uri->segment(2);
		
		$select_filed = 'a.*,u.*';	
		$tbl_name= 'tbl_article as  a ';	
		$where_condition = "a.art_no='".$art_no."' AND (a.art_status='6' OR a.art_status='7' OR a.art_status='9')"; 
							// array('a.art_no'=>$art_no,'a.art_status > '=>'0');
		$order_by_field = 'a.art_id';
		$order_by_type ='desc';
		$group_by_field = 'a.art_id';
		$join_tbl1 = 'tbl_users as u'; 
		$join_type1 = 'left'; 
		$join_condition1 = 'u.user_id=a.art_userid';
	
	
		$data['article_data'] = $this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field, $join_tbl1, $join_type1, $join_condition1);
		
		if(!empty($data['article_data']))	
		{	
			$data['art_no'] = $art_no;
			
			$this->load->view( 'header' );
			$this->load->view( 'editor/assign_publisher',$data);
			$this->load->view( 'footer');
		}
		else
		{
			redirect('user-dashboard');
		}
	
		
		
	}
	
	function assign_publisher_action()
	{
		/*echo '<pre>';
		print_r($_POST);*/
		
		
		extract($this->input->post());
		
		$select_filed = 'a.*,u.*';	
		$tbl_name= 'tbl_assgin_reviewer as  a ';	
		$where_condition = "a.asign_artid='".$art_id."' AND (a.asign_status='1' AND  a.assign_submit='1')"; 
		$order_by_field = 'a.asign_artid';
		$order_by_type ='desc';
		$group_by_field = 'a.asgin_id';
		$join_tbl1 = 'tbl_users as u'; 
		$join_type1 = 'left'; 
		$join_condition1 = 'u.user_id=a.asign_userid';
	
	
		$reviewer_data= $this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field, $join_tbl1, $join_type1, $join_condition1);
		
		$select_filed = 'a.*,u.*';	
		$tbl_name= 'tbl_article as  a ';	
		$where_condition = "a.art_id='".$art_id."' AND (a.art_status='6' OR a.art_status='7' OR a.art_status='9'  )"; 
		$order_by_field = 'a.art_id';
		$order_by_type ='desc';
		$group_by_field = 'a.art_id';
		$join_tbl1 = 'tbl_users as u'; 
		$join_type1 = 'left'; 
		$join_condition1 = 'u.user_id=a.art_userid';
	
	
		$article_data = $this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field, $join_tbl1, $join_type1, $join_condition1);
		
		
		$editor_data = $this->user_model->get_row_with_con('tbl_users',array('user_type'=>'2'));
		
		$publisher_data = $this->user_model->get_row_with_con('tbl_users',array('user_type'=>'4'));
		
		
		 $inset_data  = 	array("art_id"=>$art_id,
										  "art_status"=>'10',
										  "from_type"=>'E',
										  "to_type"=>'A',
										  "from_id"=>$this->session->userdata('userid'),
										  "to_id"=>$article_data[0]->art_userid,
										  "message"=>'Editor accept the final manuscript and send the revised manuscript to publisher for publish.',
										  "e_read"=>'1',
										  "date"=>date('Y-m-d')
								  );
					
							$insert = $this->user_model->insert_data('tbl_article_message',$inset_data);
							
			
			
						
				
			$data = array( 'art_status' =>'10','art_decision_data'=>date('Y-m-d'),'art_update'=>date('Y-m-d'));
			$where_condition 	= '(art_id="'.$art_id.'")';			
			$update_pass   = $this->user_model->update_query($data,'tbl_article',$where_condition);
				
			
			
			
			$copy = $this->user_model->get_row_with_con('tbl_admin',array('id'=>1));
			
			
							/* PUBLISHER EMAIL */
			
							 $to_publisher = $publisher_data->user_email;
							$subject = 'Editor assign Manuscript to Publisher';
							$message_publisher = "							
							<html>
							<head>
							<title>".$subject."</title>
							</head>
							<body>
							<div  style='width:700px; float:left;'>
  <div  style='width: 98%;float: left;background: #F7F7F7;padding: 1%;border-radius: 4px;border-top: 3px solid #ee4723;'>
  <div > <img src='".base_url()."design/front/images/logo.png'/> </div> 
								<p style='font-size: 17px; font-family:Tahoma, Geneva, sans-serif;'>Dear ".$publisher_data->user_fname.'&nbsp;'.$publisher_data->user_lname.", </p>
							 <p style='font-size: 15px; font-family:Tahoma, Geneva, sans-serif; color: #646161'>";
							$message_publisher .= 'The manuscript "'.$article_data[0]->art_fulltitle.'", have been accepted and publisher will finish proof by two weeks.<br>To access just the manuscript for review directly with  enter log in details, click the link below:<br><br>';
							$message_publisher .=" <a href='".base_url()."login'>
							  	  <button type='button' style='background: #00CC33;border: none;padding:1% 2%;color: #fff; letter-spacing: 1px;margin: 0% 0% 1%;cursor: pointer;font-size: 16px;border-radius: 4px;'>Publisher main menu</button> </a> <br><br>
							 	Access your account here:".base_url()."
								User ID:".$publisher_data->user_email."<br>
								Password:".$publisher_data->user_invitepass."<br>	<br>";
							 $message_publisher .="With kind regards,<br><br>
Yours sincerely,<br>
Lean Corrosion Editorial Office<br>
leancorrosion@lean.com<br>
<br><br>
							</p>
							 </div>
  <div  style='width:100%;float:left; background:#ee4723; padding:0%; color:#fff; text-align:center;'>
    <p>".$copy->footer_copy."</p>
  </div>
</div>
							</body>
							</html>
							";
					
							$result = chatroomemail($to_publisher,MAILFROM,MAILFROMNAME,$subject,$message_publisher);
							
							
							/* AUTHOR EMAIL */
			
							 $to_author = $article_data[0]->user_email;
							$subject = 'Editor assign Manuscript to Publisher';
							$message_author = "							
							<html>
							<head>
							<title>".$subject."</title>
							</head>
							<body>
							<div  style='width:700px; float:left;'>
  <div  style='width: 98%;float: left;background: #F7F7F7;padding: 1%;border-radius: 4px;border-top: 3px solid #ee4723;'>
  <div > <img src='".base_url()."design/front/images/logo.png'/> </div> 
								<p style='font-size: 17px; font-family:Tahoma, Geneva, sans-serif;'>Dear ".$article_data[0]->user_fname.'&nbsp;'.$article_data[0]->user_lname.", </p>
							 <p style='font-size: 15px; font-family:Tahoma, Geneva, sans-serif; color: #646161'>";
							$message_author .= 'The manuscript "'.$article_data[0]->art_fulltitle.'", have been accepted and publisher will finish proof by two weeks.<br>To access just the manuscript for review directly with no need to enter log in details, click the link below:<br><br>';
							$message_author .="<a href='".base_url()."login'><button type='button' style='background: #00CC33;border: none;padding:1% 2%;color: #fff; letter-spacing: 1px;margin: 0% 0% 1%;cursor: pointer;font-size: 16px;border-radius: 4px;'>Author main meun</button></a>";
							 $message_author .="<br><br>With kind regards,<br><br>
Yours sincerely,<br>
Lean Corrosion Editorial Office<br>
leancorrosion@lean.com<br>
<br><br>
							</p>
							 </div>
  <div  style='width:100%;float:left; background:#ee4723; padding:0%; color:#fff; text-align:center;'>
    <p>".$copy->footer_copy."</p>
  </div>
</div>
							</body>
							</html>
							";
					
							$result = chatroomemail($to_author,MAILFROM,MAILFROMNAME,$subject,$message_author);
							
							
							
							/* EDITOR EMAIL */
			
							 $to_editor = $editor_data->user_email;
							$subject = 'Editor assign Manuscript to Publisher';
							$message_editor = "							
							<html>
							<head>
							<title>".$subject."</title>
							</head>
							<body>
							<div  style='width:700px; float:left;'>
  <div  style='width: 98%;float: left;background: #F7F7F7;padding: 1%;border-radius: 4px;border-top: 3px solid #ee4723;'>
  <div > <img src='".base_url()."design/front/images/logo.png'/> </div> 
								<p style='font-size: 17px; font-family:Tahoma, Geneva, sans-serif;'>Dear ".$editor_data->user_fname.'&nbsp;'.$editor_data->user_lname.", </p>
							 <p style='font-size: 15px; font-family:Tahoma, Geneva, sans-serif; color: #646161'>";
							$message_editor .= 'The manuscript "'.$article_data[0]->art_fulltitle.'", have been accepted and publisher will finish proof by two weeks.<br>To access just the manuscript for review directly with no need to enter log in details, click the link below:<br><br>';
							$message_editor .="<a href='".base_url()."login'><button type='button' style='background: #00CC33;border: none;padding:1% 2%;color: #fff; letter-spacing: 1px;margin: 0% 0% 1%;cursor: pointer;font-size: 16px;border-radius: 4px;'>Editor main meun</button></a>";
							 $message_editor .="<br><br>With kind regards,<br><br>
Yours sincerely,<br>
Lean Corrosion Editorial Office<br>
leancorrosion@lean.com<br>
<br><br>
							</p>
							 </div>
  <div  style='width:100%;float:left; background:#ee4723; padding:0%; color:#fff; text-align:center;'>
    <p>".$copy->footer_copy."</p>
  </div>
</div>
							</body>
							</html>
							";
					
							$result = chatroomemail($to_editor,MAILFROM,MAILFROMNAME,$subject,$message_editor);
							
							
								
							/* Reviewer EMAIL */
			
			
			
						if(!empty($reviewer_data))	
						{
							foreach($reviewer_data as $reviewer_list)
							{
								
							
							 $to_review = $reviewer_list->user_email;
							$subject = 'Editor assign Manuscript to Publisher';
							$message_review = "							
							<html>
							<head>
							<title>".$subject."</title>
							</head>
							<body>
							<div  style='width:700px; float:left;'>
  <div  style='width: 98%;float: left;background: #F7F7F7;padding: 1%;border-radius: 4px;border-top: 3px solid #ee4723;'>
  <div > <img src='".base_url()."design/front/images/logo.png'/> </div> 
								<p style='font-size: 17px; font-family:Tahoma, Geneva, sans-serif;'>Dear ".$reviewer_list->user_fname.'&nbsp;'.$reviewer_list->user_lname.", </p>
							 <p style='font-size: 15px; font-family:Tahoma, Geneva, sans-serif; color: #646161'>";
							$message_review .= 'The manuscript "'.$article_data[0]->art_fulltitle.'", have been accepted and publisher will finish proof by two weeks.<br>To access just the manuscript for review directly with no need to enter log in details, click the link below:<br><br>';
							$message_review .="<a href='".base_url()."login'><button type='button' style='background: #00CC33;border: none;padding:1% 2%;color: #fff; letter-spacing: 1px;margin: 0% 0% 1%;cursor: pointer;font-size: 16px;border-radius: 4px;'>Reviewer main meun</button></a>";
							 $message_review .="<br><br>With kind regards,<br><br>
Yours sincerely,<br>
Lean Corrosion Editorial Office<br>
leancorrosion@lean.com<br>
<br><br>
							</p>
							 </div>
  <div  style='width:100%;float:left; background:#ee4723; padding:0%; color:#fff; text-align:center;'>
    <p>".$copy->footer_copy."</p>
  </div>
</div>
							</body>
							</html>
							";
					
							$result = chatroomemail($to_review,MAILFROM,MAILFROMNAME,$subject,$message_review);
							}
						}
							
							
						   $this->session->set_flashdata("success","Manuscript assign to publisher.");	
							redirect('user-dashboard');
							
							
							
		
	}
	
	
	function required_revission()
	{
		$data['art_for']  = $this->uri->segment(1);
		$art_no = $this->uri->segment(2);
		
		$select_filed = 'a.*,u.*';	
		$tbl_name= 'tbl_article as  a ';	
		$where_condition = "a.art_no='".$art_no."' AND (a.art_status='6')"; 
							// array('a.art_no'=>$art_no,'a.art_status > '=>'0');
		$order_by_field = 'a.art_id';
		$order_by_type ='desc';
		$group_by_field = 'a.art_id';
		$join_tbl1 = 'tbl_users as u'; 
		$join_type1 = 'left'; 
		$join_condition1 = 'u.user_id=a.art_userid';
	
	
		$data['article_data'] = $this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field, $join_tbl1, $join_type1, $join_condition1);
		
		if(!empty($data['article_data']))	
		{	
			$data['art_no'] = $art_no;
			
			$this->load->view( 'header' );
			$this->load->view( 'editor/req_dec_revision',$data);
			$this->load->view( 'footer');
		}
		else
		{
			redirect('user-dashboard');
		}
	}
	function required_revission_action()
	{
		/*echo '<pre>';
		print_r($_POST);*/
		
		
		extract($this->input->post());
		
		$user_data =$this->user_model->get_row_with_con('tbl_users',array('user_id'=>$art_userid));
		
		
				
				 
				 $arti_status = '1';
				 if($art_status=='back')
				 {
				 	 $arti_status = '7';
				 }
				 elseif($art_status=='declined')
				 {
				 	 $arti_status = '8';
				 }
			
				 
				 $inset_data  = 	array("art_id"=>$art_id,
										  "art_status"=>$arti_status,
										  "from_type"=>'E',
										  "to_type"=>'A',
										  "from_id"=>$this->session->userdata('userid'),
										  "to_id"=>$art_userid,
										  "message"=>$art_message,
										  "e_read"=>'1',
										  "date"=>date('Y-m-d')
								  );
			
										
							$insert = $this->user_model->insert_data('tbl_article_message',$inset_data);
							
			$data = array( 'art_status' => $arti_status,'art_update'=>date('Y-m-d'));
			$where_condition 	= '(art_id="'.$art_id.'")';			
			$update_pass   = $this->user_model->update_query($data,'tbl_article',$where_condition);
				
							
							
							$copy = $this->user_model->get_row_with_con('tbl_admin',array('id'=>1));
							 $to = $user_data->user_email;
							$subject = 'Article Process ';
							$message = "							
							<html>
							<head>
							<title>".$subject."</title>
							</head>
							<body>
							<div  style='width:700px; float:left;'>
  <div  style='width: 98%;float: left;background: #F7F7F7;padding: 1%;border-radius: 4px;border-top: 3px solid #ee4723;'>
  <div > <img src='".base_url()."design/front/images/logo.png'/> </div> 
								<p style='font-size: 17px; font-family:Tahoma, Geneva, sans-serif;'>Dear ".$user_data->user_fname.'&nbsp;'.$user_data->user_lname.", </p>
							 <p style='font-size: 15px; font-family:Tahoma, Geneva, sans-serif; color: #646161'>".$art_message." <br><br>";
							 $message .="<a href='".base_url()."login'> <button type='button' style='background: #00CC33;border: none;padding:1% 2%;color: #fff; letter-spacing: 1px;margin: 0% 0% 1%;cursor: pointer;font-size: 16px;border-radius: 4px;'>Auhtor Mainmenu</button> </a><br><br>
Your username is: ".$user_data->user_email."<br><br>
Your password is: ".$user_data->user_invitepass."<br><br>";							 
							 
							 $message .="</p>
							 </div>
  <div  style='width:100%;float:left; background:#ee4723; padding:0%; color:#fff; text-align:center;'>
    <p>".$copy->footer_copy."</p>
  </div>
</div>
							</body>
							</html>
							";
							$result = chatroomemail($to,MAILFROM,MAILFROMNAME,$subject,$message);
							
							
								
								
							if($result==false) {
								$this->session->set_flashdata("error", 'Email not send');
								redirect('user-dashboard');
							} else {
							
							   $this->session->set_flashdata("success","Email Send to author");
								redirect('user-dashboard');
							
							}
	}
	
	function required_declined()
	{
		$data['art_for']  = $this->uri->segment(1);
		$art_no = $this->uri->segment(2);
		
		$select_filed = 'a.*,u.*';	
		$tbl_name= 'tbl_article as  a ';	
		$where_condition = "a.art_no='".$art_no."' AND (a.art_status='2' OR a.art_status='5' OR a.art_status='6' OR a.art_status='7' OR a.art_status='9')"; 
							// array('a.art_no'=>$art_no,'a.art_status > '=>'0');
		$order_by_field = 'a.art_id';
		$order_by_type ='desc';
		$group_by_field = 'a.art_id';
		$join_tbl1 = 'tbl_users as u'; 
		$join_type1 = 'left'; 
		$join_condition1 = 'u.user_id=a.art_userid';
	
	
		$data['article_data'] = $this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field, $join_tbl1, $join_type1, $join_condition1);
		
		if(!empty($data['article_data']))	
		{	
			$data['art_no'] = $art_no;
			
			$this->load->view( 'header' );
			$this->load->view( 'editor/req_dec_revision',$data);
			$this->load->view( 'footer');
		}
		else
		{
			redirect('user-dashboard');
		}
	}
	
	
	
	
	
	function again_assign_reviewer()
	{
		
		$art_no = $this->uri->segment(2);
		
		$select_filed = 'a.*,u.*';	
		$tbl_name= 'tbl_article as  a ';	
		//$where_condition = "a.art_no='".$art_no."' AND (a.art_status='2')"; 
							// array('a.art_no'=>$art_no,'a.art_status > '=>'0');
		$where_condition = "a.art_no='".$art_no."' AND (a.art_status='2' OR a.art_status>2)"; 
		$order_by_field = 'a.art_id';
		$order_by_type ='desc';
		$group_by_field = 'a.art_id';
		$join_tbl1 = 'tbl_users as u'; 
		$join_type1 = 'left'; 
		$join_condition1 = 'u.user_id=a.art_userid';
	
	
		$data['article_data'] = $this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field, $join_tbl1, $join_type1, $join_condition1);
		
		if(!empty($data['article_data']))	
		{	
		
		
			$select_filed = 'a.*,u.*';	
			$tbl_name= 'tbl_users as  u ';	
			
			$where_condition =array('u.user_status'=>'1','u.user_type'=>'3','u.user_inviteid'=>'0');
								
			$where_other_data = "user_status = 1 AND (user_reviewer = 1 AND user_id != '".$data['article_data'][0]->art_userid."')"; 
			
			$where_auther_request = "user_status = 1 AND (FIND_IN_SET('".$data['article_data'][0]->art_id."',user_artid))"; 
			
			
				
			$order_by_field = 'u.user_id';
			$order_by_type ='desc';
			$group_by_field = 'u.user_id';
			$join_tbl1 = 'tbl_assgin_reviewer as a'; 
			$join_type1 = ''; 
			$join_condition1 = 'u.user_id!=a.asign_userid';
		
		
			$reviewer_info = $this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field, $join_tbl1, $join_type1, $join_condition1);
					
					$other_data = $this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_other_data, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field, $join_tbl1, $join_type1, $join_condition1);
					$author_request_data = $this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_auther_request, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field, $join_tbl1, $join_type1, $join_condition1);
			
			
			
			$reviewer_info_new ='';
			
			if(!empty($other_data)&& !empty($reviewer_info)){
				$reviewer_info_new  = array_merge($other_data,$reviewer_info);
			}	
			elseif(!empty($reviewer_info))
			{
				$reviewer_info_new = $reviewer_info;
			}	
			elseif(!empty($other_data))
			{
				$reviewer_info_new  = $other_data;
			}		
			
			
			if( !empty($author_request_data ) )
			{
				$data['reviewer_info'] = array_merge($author_request_data,$reviewer_info_new);
			}else
			{
				$data['reviewer_info'] = $reviewer_info_new;
				
			}				
				
			$data['art_no'] = $art_no;
			
			$this->load->view( 'header' );
			$this->load->view( 'editor/reviewer_list',$data);
			$this->load->view( 'footer');
			
		}
		else
		{
			redirect('user-dashboard');
		}
	}
}
?>
