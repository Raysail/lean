<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Publisher extends CI_Controller {

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
		front_publisher_user_func_check();
	}
	
	function create_dir( $dir_name ){

		$filename = $dir_name . "/";
		if (!file_exists($filename)) {
		mkdir( $dir_name,0755,TRUE );
		}
	}
	
	public function publisher_view_project()
	{
	
		$art_no = $this->uri->segment(2);
		
		$select_filed = 'a.*,u.*';	
		$tbl_name= 'tbl_article as  a ';	
		$where_condition = array('a.art_no'=>$art_no,'a.art_status >= '=>'10');
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
			$data_update = array( 'p_read'=>'1');
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
			$this->load->view( 'publisher/project_detail',$data);
			$this->load->view( 'footer');
			
		}
		else
		{
			redirect('user-dashboard');
		}
			
	}
	
	public function completby_publisher()
	{
		
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
			$this->load->view( 'publisher/complete_message',$data);
			$this->load->view( 'footer');
			
		}
		else
		{
			redirect('user-dashboard');
		}
			
	}
	
	function completby_publisher_action()
	{
		
		
		/*echo '<pre>';
		print_r($_POST);*/
		
		
		extract($this->input->post());
		
				
		$select_filed = 'a.*,u.*';	
		$tbl_name= 'tbl_article as  a ';	
		$where_condition = "a.art_id='".$art_id."' AND (a.art_status='10' OR a.art_status='11' OR a.art_status='12'  )"; 
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
										  "art_status"=>'13',
										  "from_type"=>'P',
										  "to_type"=>'A',
										  "from_id"=>$this->session->userdata('userid'),
										  "to_id"=>$article_data[0]->art_userid,
										  "message"=>"Publisher finish the check of manuscript's proof.",
										  "p_read"=>'1',
										  "date"=>date('Y-m-d')
								  );
					
							$insert = $this->user_model->insert_data('tbl_article_message',$inset_data);
							
			
			
						
				
				$data = array( 'art_status' =>'13','art_update'=>date('Y-m-d'));
			$where_condition 	= '(art_id="'.$art_id.'")';			
			$update_pass   = $this->user_model->update_query($data,'tbl_article',$where_condition);
				
			
			
			
			$copy = $this->user_model->get_row_with_con('tbl_admin',array('id'=>1));
			
			
						
							
							/* AUTHOR EMAIL */
			
							 $to_author = $article_data[0]->user_email;
							$subject = 'Publisher choose the completion';
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
							$message_author .= 'The manuscript "'.$article_data[0]->art_fulltitle.'", have been completed and publisher will publish your paper.<br><br>To access just the manuscript for process directly, click the link below:';
							 $message_author .="<br><br>
								  <a href='".base_url()."login'>
							  	  <button type='button' style='background: #00CC33;border: none;padding:1% 2%;color: #fff; letter-spacing: 1px;margin: 0% 0% 1%;cursor: pointer;font-size: 16px;border-radius: 4px;'> Author Main Menu</button> </a>
<br><br>
Access your account here: ".base_url()."
Your account name:".$article_data[0]->user_email."<br>
Your password: ".$article_data[0]->user_invitepass."<br>	

With kind regards,<br><br>
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
							$subject = 'Publisher choose the completion';
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
							$message_editor .= 'The manuscript "'.$article_data[0]->art_fulltitle.'", have been completed and publisher will publish your paper.';
							 $message_editor .="With kind regards,<br><br>
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
							
							
								
							
						   $this->session->set_flashdata("success","Manuscript proof finished.");	
							redirect('user-dashboard');
							
							
							
		
	
	}
	function proof_for_author()
	{
		
		$data['msg_id'] = '';
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
		//$where_condition = array('a.art_no'=>$art_no,'a.art_status >= '=>'10');
		$where_condition = 'a.art_no="'.$art_no.'" AND (a.art_status="10" OR a.art_status="11"  OR a.art_status="12"  )';
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
			$this->load->view( 'publisher/project_message',$data);
			$this->load->view( 'footer');
			
		}
		else
		{
			redirect('user-dashboard');
		}
			
	}
	
	function proof_for_author_action()
	{
		
		/*echo '<pre>';
		print_r($_POST);
		exit;*/
		extract($this->input->post());
		
		$user_data =$this->user_model->get_row_with_con('tbl_users',array('user_id'=>$art_userid));
		
		if(isset($_POST['msg_id']) && (!empty($_POST['msg_id'])))
		{
			$data_update = array( 'again_send'=>'1');
			$where_condition 	= '(id="'.$msg_id.'")';			
			$update_pass  = $this->user_model->update_query($data_update,'tbl_article_message',$where_condition);
	   }		
			
		
			$file_name='';
			$full_name='';
			 $folderName = 'author-'.$art_userid;
			 $dir_name = 'upload/article/'.$folderName;
		if(isset($_FILES) && (!empty($_FILES['att_proof']['name'])))
		{
			$this->create_dir( $dir_name );
						$file_name = time()."-".str_replace(" ","_",$_FILES['att_proof']['name']);
						
						$config['upload_path'] = $dir_name;
						$config['allowed_types'] = 'docx|doc|txt|pdf|jpg|ginf|png|ppt|pptx';
						$config['file_name'] = $file_name;

						$this->upload->initialize($config);
						$this->load->library('upload', $config);
						if ($this->upload->do_upload('att_proof'))
						{
							$data = $this->upload->data();
							$file_name = $data['file_name'];
							$full_name=$dir_name.'/'.$file_name ;
						}
		}
				 
				 
				
			
				 
				 $inset_data  = 	array("art_id"=>$art_id,
										  "art_status"=>$art_status,
										  "from_type"=>'P',
										  "to_type"=>'A',
										  "from_id"=>$this->session->userdata('userid'),
										  "to_id"=>$art_userid,
										  "message"=>$art_message,
										  "p_read"=>'1',
										  "proof_file"=>$full_name,
										  "date"=>date('Y-m-d')
								  );
			
										
							$insert = $this->user_model->insert_data('tbl_article_message',$inset_data);
							
			$data = array( 'art_status' => $art_status,'art_update'=>date('Y-m-d'));
			$where_condition 	= '(art_id="'.$art_id.'")';			
			$update_pass   = $this->user_model->update_query($data,'tbl_article',$where_condition);
			
			
			
			
				
							$message_predefin='';
							
							$copy = $this->user_model->get_row_with_con('tbl_admin',array('id'=>1));
							
							$art_data = $this->user_model->get_row_with_con('tbl_article',array('art_id'=>$art_id));
							
							 $to = $user_data->user_email;
							 if($art_status==11){
							$subject = 'Proof message by publisher ';
							
							$subject_predefine = 'Proof for author check by Publisher';
							
							$message_predefin = "							
							<html>
							<head>
							<title>".$subject_predefine."</title>
							</head>
							<body>
							<div  style='width:700px; float:left;'>
  <div  style='width: 98%;float: left;background: #F7F7F7;padding: 1%;border-radius: 4px;border-top: 3px solid #ee4723;'>
  <div > <img src='".base_url()."design/front/images/logo.png'/> </div> 
								<p style='font-size: 17px; font-family:Tahoma, Geneva, sans-serif;'>Dear ".$user_data->user_fname.'&nbsp;'.$user_data->user_lname.", </p>
							 <p style='font-size: 15px; font-family:Tahoma, Geneva, sans-serif; color: #646161'>
							 The manuscript ".$art_data->art_fulltitle.", have been proofed. You can check this proof and answer the question from publisher’s query.<br>br>To access just the manuscript fordownload in author main menu, click the link below :<br><br>
							  <a href='".base_url()."login'><button type='button' style='background: #00CC33;border: none;padding:1% 2%;color: #fff; letter-spacing: 1px;margin: 0% 0% 1%;cursor: pointer;font-size: 16px;border-radius: 4px;'>Author main menu</button></a>
								 <br><br>
								 Or Please log into the journal System at ".base_url()." as a Author to access the manuscript and submit your revised proof online.<br><br>
								 
							 	Access your account here:".base_url()."<br>
								User ID:".$user_detail->user_email."<br>
								Password:".$user_detail->user_invitepass."<br>	<br>	
								With kind regards,<br>	<br>	

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
							
							$result = chatroomemail($to,MAILFROM,MAILFROMNAME,$subject_predefine,$message_predefin);
							
							
							
							}
							 if($art_status==12){
							$subject = 'Manuscript send back to author by Publisher';
							
							$subject_predefine = 'Manuscript sendback to author by Publisher for update';
							
							$message_predefin = "							
							<html>
							<head>
							<title>".$subject_predefine."</title>
							</head>
							<body>
							<div  style='width:700px; float:left;'>
  <div  style='width: 98%;float: left;background: #F7F7F7;padding: 1%;border-radius: 4px;border-top: 3px solid #ee4723;'>
  <div > <img src='".base_url()."design/front/images/logo.png'/> </div> 
								<p style='font-size: 17px; font-family:Tahoma, Geneva, sans-serif;'>Dear ".$user_data->user_fname.'&nbsp;'.$user_data->user_lname.", </p>
							 <p style='font-size: 15px; font-family:Tahoma, Geneva, sans-serif; color: #646161'>
							 Your manuscript has been further modified. Please submit your check and feedback in one week. You can directly log in author view with account and password: <br><br>
							  <a href='".base_url()."login'>
							  	  <button type='button' style='background: #00CC33;border: none;padding:1% 2%;color: #fff; letter-spacing: 1px;margin: 0% 0% 1%;cursor: pointer;font-size: 16px;border-radius: 4px;'>Author main menu</button> </a>
								 <br><br>
							 	Access your account here:".base_url()."
								User ID:".$user_detail->user_email."<br>
								Password:".$user_detail->user_invitepass."<br>	<br>	
								With kind regards,<br>	<br>	

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
							
							$result = chatroomemail($to,MAILFROM,MAILFROMNAME,$subject_predefine,$message_predefin);
							
							}
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
						//	$result = chatroomemail($to,MAILFROM,MAILFROMNAME,$subject,$message);
							
							
								
								
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
	
	function sendby_publisher()
	{
		
		$data['msg_id'] = '';
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
		$where_condition = array('a.art_no'=>$art_no,'a.art_status >= '=>'10');
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
			$this->load->view( 'publisher/project_message',$data);
			$this->load->view( 'footer');
			
		}
		else
		{
			redirect('user-dashboard');
		}
	}
	
	
	
	/* PUBLISH FORM WITH ALL CONDITION */

	public function publish_manuscript()
	{
		$art_no = $this->uri->segment(2);
		if($this->uri->segment(2))
		{
			$select_filed = '*';	
			$tbl_name= 'tbl_article as a';	
			$where_condition = array('a.art_status'=>'13','a.art_no'=>$art_no);
			$where_condition_publish = array('a.art_status'=>'15');
			$order_by_field = 'a.art_id';
			$order_by_type ='desc';
			$group_by_field = 'a.art_id';
			$join_tbl1="tbl_users u";
		    $join_condition1="u.user_id=a.art_userid";
		
			$data['art_data'] =$this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field,$join_tbl1,'',$join_condition1);
			
			$data['publish_data'] =$this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition_publish, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field,$join_tbl1,'',$join_condition1);
			
			$select_filed = '*';	
			$tbl_name= 'tbl_assgin_reviewer as a';	
			$where_condition = array('a.asign_status'=>'1','a.assign_submit'=>'1','a.asign_artid'=>$data['art_data'][0]->art_id);
			$order_by_field = 'a.asgin_id';
			$order_by_type ='desc';
			$group_by_field = 'a.asgin_id';
			$join_tbl1="tbl_users u";
		    $join_condition1="u.user_id=a.asign_userid";
			
			
			$data['assin_reviewer'] =$this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field,$join_tbl1,'',$join_condition1);
			
			$data['other_author'] =$this->user_model->select_query('*','tbl_other_author',
													array('oa_art_id'=>$data['art_data'][0]->art_id),
													'oa_order','asc');
			
			
			if(!empty($data['art_data']))
			{
				$this->load->view( 'header' );
				$this->load->view( 'publisher/proof_publish',$data);
				$this->load->view( 'footer');
			}
			else
			{
				 redirect('user-dashboard');
			}
		}
		else
		{
			redirect('user-dashboard');
		}			
	}
	
	
	
	public function submit_publisher()
	{
	
	
		/*echo '<pre>';
		print_r($_POST);
	exit;*/
		
		$tbl_name = "tbl_article_publish";
		$user_id   = $this->session->userdata( 'userid' );
		
		extract($this->input->post());
		
		
	   $data_update = '';
	   
	   if(isset($_POST['pub_year']) && (!empty($_POST['pub_year'])))
		{
			  $data_update = array('pub_year'=>$pub_year,
			  					   'pub_valume'=>$pub_valume,
			  					   'pub_issue'=>$pub_issue,
			  					   'pub_DOI'=>$pub_DOI,
			  					   'pub_paper'=>$pub_paper,
			  					   'pub_userid'=>$user_id,
								   'pub_artid'=>$pub_artid,
								   'pub_dateadd'=>date('Y-m-d'));
		}
		
		
	   
	   
		if(isset($_POST['pub_abstract']) && (!empty($_POST['pub_abstract'])))
		{
			  $data_update = array('pub_abstract'=>$pub_abstract);
			  					  /* 'pub_userid'=>$user_id,
								   'pub_artid'=>$pub_artid,
								   'pub_dateadd'=>date('Y-m-d')*/
		}
		
		
		
		
		if(isset($_POST['pub_mainbody']) && (!empty($_POST['pub_mainbody'])))
		{
			  $data_update = array('pub_mainbody'=>$pub_mainbody);
		}
		if(isset($_POST['pub_intro']) && (!empty($_POST['pub_intro'])))
		{
			  $data_update = array('pub_intro'=>$pub_intro);
		}
		if(isset($_POST['pub_expri']) && (!empty($_POST['pub_expri'])))
		{
			  $data_update = array('pub_expri'=>$pub_expri);
		}
		if(isset($_POST['pub_result']) && (!empty($_POST['pub_result'])))
		{
			  $data_update = array('pub_result'=>$pub_result);
		}		
		if(isset($_POST['pub_concl']) && (!empty($_POST['pub_concl'])))
		{
			  $data_update = array('pub_concl'=>$pub_concl);
		}	
		if(isset($_POST['pub_ack']) && (!empty($_POST['pub_ack'])))
		{
			  $data_update = array('pub_ack'=>$pub_ack);
		}
		if(isset($_POST['pub_ref']) && (!empty($_POST['pub_ref'])))
		{
			  $data_update = array('pub_ref'=>$pub_ref);
		}
		if(isset($_POST['pub_suply']) && (!empty($_POST['pub_suply'])))
		{
			  $data_update = array('pub_suply'=>$pub_suply);
		}
		
		if(isset($_POST['pub_reviewer']) && (!empty($_POST['pub_reviewer'])))
		{
			  $data_update = array('pub_reviewer'=>$pub_reviewer);
		}
		if(isset($_POST['art_see']) && (!empty($_POST['art_see'])))
		{
			  $data_update = array('pub_must_see'=>implode(',',$_POST['art_see']));
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		if(isset($_POST['pub_id'])&& ($_POST['pub_id']>0))
		{
			$where = array('pub_id'=>$_POST['pub_id'],'pub_userid'=>$user_id);
			if(!empty($data_update)){
				$query = $this->user_model->update_query($data_update,$tbl_name,$where);
			//	echo $this->db->last_query();
				echo $_POST['pub_id'];	
			}
			else
			{
				echo $_POST['pub_id'];
			}
		}
		else
		{
			$query =$this->user_model->insert_data($tbl_name,$data_update);
			echo $query;
		
		}
		
	}
	
	/* PUBLISH FORM WITH ALL CONDITION IF FROMIS COMPLETE  */
	function publish_continue()
	{
		
		if($this->uri->segment(2))
		{
			$art_no = $this->uri->segment(2);
			$select_filed = '*';	
			$tbl_name= 'tbl_article as a';	
			//$where_condition = array('a.art_status'=>'13','a.art_no'=>$art_no);
			
			$where_condition = "(a.art_status=13 or a.art_status=14 or a.art_status=15 ) AND a.art_no='".$art_no."'";
			$order_by_field = 'a.art_id';
			$order_by_type ='desc';
			$group_by_field = 'a.art_id';
			$join_tbl1="tbl_article_publish p";
		    $join_condition1="p.pub_artid=a.art_id";
			$join_tbl2="tbl_users u";
		    $join_condition2="u.user_id=a.art_userid";
		
			$data['art_data'] =$this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field,$join_tbl1,'',$join_condition1,$join_tbl2,$join_condition2,'');
			
			
			
			$data['res_art'] = $this->user_model->select_query('*','tbl_research',array('res_artid'=>$data['art_data'][0]->art_id) );
			
			
			$where_condition_publish = array('art_status'=>'15');
			$data['publish_data'] =$this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition_publish, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field);
			
				$select_filed = '*';	
			$tbl_name= 'tbl_assgin_reviewer as a';	
			$where_condition = array('a.asign_status'=>'1','a.assign_submit'=>'1','a.asign_artid'=>$data['art_data'][0]->art_id);
			$order_by_field = 'a.asgin_id';
			$order_by_type ='desc';
			$group_by_field = 'a.asgin_id';
			$join_tbl1="tbl_users u";
		    $join_condition1="u.user_id=a.asign_userid";
			
			
			$data['assin_reviewer'] =$this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field,$join_tbl1,'',$join_condition1);
			
			
			$data['other_author'] =$this->user_model->select_query('*','tbl_other_author',
													array('oa_art_id'=>$data['art_data'][0]->art_id),
													'oa_order','asc');
													
			
			
			if(!empty($data['art_data']))
			{
				$this->load->view( 'header' );
				$this->load->view( 'publisher/update_proof',$data);
				$this->load->view( 'footer');
			}
			else
			{
				 redirect('user-dashboard');
			}
		}

		else
		{
			 redirect('user-dashboard');
		}
	}
	
	
	/* RESEARCH AND ART SUBMISSION */
	public function res_art_submit()
	{
	
	
		$tbl_name = "tbl_article_publish";
		$user_id   = $this->session->userdata( 'userid' );
		
		extract($this->input->post());
		
		
		 $research_file='';
		 
			 $folderName = 'article-'.$research_artid;
			
			 $dir_name = 'upload/publish/'.$folderName;
			 
			/* RESEARCH DOC*/
			 if(!empty($_FILES['research_file']['name']) && ($_FILES['research_file']['error']==0))
			 {
			 		 	 $this->create_dir( $dir_name );
						$file_name = time()."-".str_replace(" ","_",$_FILES['research_file']['name']);
						
						$config['upload_path'] = $dir_name;
						$config['allowed_types'] = 'docx|doc|pdf|txt|jpg|gif|png';
						$config['file_name'] = $file_name;

						$this->upload->initialize($config);
						$this->load->library('upload', $config);
						if ($this->upload->do_upload('research_file'))
						{
							$data = $this->upload->data();
							$research_file = $data['file_name'];
						}
			 }
			  
			  
		if($research_id>0){
		
		
		
			$where = array('res_artid'=>$research_artid,'res_id'=>$research_id);
			
			if(empty($research_file)){
			$art_res_data = $this->user_model->get_row_with_con('tbl_research',$where);
				$research_file = $art_res_data->res_image;
			}				
							
		
			$update_data = array('res_artid'=>$research_artid,
							'res_userid'=>$this->session->userdata( 'userid' ),
							'res_title'=>$research_title,
							'res_journal'=>$research_journal,
							'res_image'=>$research_file,
							'res_url'=>$research_url,
							'res_update'=>date('Y-m-d')	
							);
							
		
				$query = $this->user_model->update_query($update_data,'tbl_research',$where);
					echo $research_id;
							
		}
		else
		{
			
			$update_data = array('res_artid'=>$research_artid,
							'res_userid'=>$this->session->userdata( 'userid' ),
							'res_title'=>$research_title,
							'res_journal'=>$research_journal,
							'res_image'=>$research_file,
							'res_url'=>$research_url,
							'res_dateadd'=>date('Y-m-d')	
							);
							
				$query =$this->user_model->insert_data('tbl_research',$update_data);
				echo $query;
		}			
		
				
		
		
	}
	
	/**/
	
	public function submit_files()
	{
		/*echo '<pre>';
		
		print_r($_POST);
		print_r($_FILES);
		exit;*/
		
		$tbl_name = "tbl_article_publish";
		$user_id   = $this->session->userdata( 'userid' );
		
		extract($this->input->post());
		
		$data_update=array();
		
			$pub_pdf='';
			$pub_cover='';
			$pub_ppt='';
			$pub_cita='';
			$pub_output='';
			 $data_update ='';
		if ( 
			(isset($_FILES['pub_cover']) && (!empty($_FILES['pub_cover']['name']))) || 
			(isset($_FILES['pub_pdf']) && (!empty($_FILES['pub_pdf']['name']))) || 
			(isset($_FILES['pub_ppt']) && (!empty($_FILES['pub_ppt']['name']))) ||
			(isset($_FILES['pub_cita']) && (!empty($_FILES['pub_cita']['name'])))	||	   
			(isset($_FILES['pub_output']) && (!empty($_FILES['pub_output']['name'])))
			)
		{
		
			
			 $folderName = 'article-'.$pub_artid;
			
			 $dir_name = 'upload/publish/'.$folderName;
			 
			 
			  /* COVE IMAGE*/
			  
			 if(!empty($_FILES['pub_cover']['name']) && ($_FILES['pub_cover']['error']==0))
			 {
			 		 	 $this->create_dir( $dir_name );
						$file_name = time()."-".str_replace(" ","_",$_FILES['pub_cover']['name']);
						
						$config['upload_path'] = $dir_name;
						$config['allowed_types'] = 'docx|doc|pdf|txt|jpg|gif|jpeg|png';
						$config['file_name'] = $file_name;

						$this->upload->initialize($config);
						$this->load->library('upload', $config);
						if ($this->upload->do_upload('pub_cover'))
						{
							$data = $this->upload->data();
							$pub_pdf = $data['file_name'];
						}
						$data_update['pub_cover']=$pub_pdf;
			 }
			 
			 
			  /* PDF DOC*/
			  
			 if(!empty($_FILES['pub_pdf']['name']) && ($_FILES['pub_pdf']['error']==0))
			 {
			 		 	 $this->create_dir( $dir_name );
						$file_name = time()."-".str_replace(" ","_",$_FILES['pub_pdf']['name']);
						
						$config['upload_path'] = $dir_name;
						$config['allowed_types'] = 'docx|doc|pdf|txt|jpg|gif';
						$config['file_name'] = $file_name;

						$this->upload->initialize($config);
						$this->load->library('upload', $config);
						if ($this->upload->do_upload('pub_pdf'))
						{
							$data = $this->upload->data();
							$pub_pdf = $data['file_name'];
						}
						$data_update['pub_pdf']=$pub_pdf;
			 }
			 
			 
			/* PPT DOC*/
			 if(!empty($_FILES['pub_ppt']['name']) && ($_FILES['pub_ppt']['error']==0))
			 {
			 		 	 $this->create_dir( $dir_name );
						$file_name = time()."-".str_replace(" ","_",$_FILES['pub_ppt']['name']);
						
						$config['upload_path'] = $dir_name;
						$config['allowed_types'] = 'docx|doc|pdf|txt|jpg|gif|png|jpeg|ppt|pptx';
						$config['file_name'] = $file_name;

						$this->upload->initialize($config);
						$this->load->library('upload', $config);
						if ($this->upload->do_upload('pub_ppt'))
						{
							$data = $this->upload->data();
							$pub_ppt = $data['file_name'];
						}
						$data_update['pub_ppt']=$pub_ppt;
			 }
			  
			 
			/* CITATION DOC*/
			 if(!empty($_FILES['pub_cita']['name']) && ($_FILES['pub_cita']['error']==0))
			 {
			 		 	 $this->create_dir( $dir_name );
						$file_name = time()."-".str_replace(" ","_",$_FILES['pub_cita']['name']);
						
						$config['upload_path'] = $dir_name;
						$config['allowed_types'] = 'docx|doc|pdf|txt|jpg|gif|ris';
						$config['file_name'] = $file_name;

						$this->upload->initialize($config);
						$this->load->library('upload', $config);
						if ($this->upload->do_upload('pub_cita'))
						{
							$data = $this->upload->data();
							$pub_cita = $data['file_name'];
						}
						$data_update['pub_cita']=$pub_cita;
			 }
			  
			/* OUTPUT DOC*/
			 if(!empty($_FILES['pub_output']['name']) && ($_FILES['pub_output']['error']==0))
			 {
			 		 	 $this->create_dir( $dir_name );
						$file_name = time()."-".str_replace(" ","_",$_FILES['pub_output']['name']);
						
						$config['upload_path'] = $dir_name;
						$config['allowed_types'] = 'docx|doc|pdf|txt|jpg|gif|ens';
						$config['file_name'] = $file_name;

						$this->upload->initialize($config);
						$this->load->library('upload', $config);
						if ($this->upload->do_upload('pub_output'))
						{
							$data = $this->upload->data();
							$pub_output = $data['file_name'];
						}
						$data_update['pub_output']=$pub_output;
			 }
			 
			 
			  
		}
		

			$where = array('pub_id'=>$_POST['pub_id'],'pub_userid'=>$user_id);
			if(!empty($data_update)){
				$query = $this->user_model->update_query($data_update,$tbl_name,$where);
			//	echo $this->db->last_query();
				echo $_POST['pub_id'];	
			}
			else
			{
				echo $_POST['pub_id'];
			}
		
		
		
	}
	
	public function preview_article()
	{
		
		if($this->uri->segment(2))
		{
		
			$art_id = $this->uri->segment(2);
			
				$data_update = array( 'art_status' =>'14');
				$where_condition 	= '(art_id="'.$art_id.'")';			
				$update_pass   = $this->user_model->update_query($data_update,'tbl_article',$where_condition);
				
				
			$select_filed = '*';	
			$tbl_name= 'tbl_article as a';	
			$where_condition = array('a.art_status'=>'14','a.art_id'=>$art_id);
			$order_by_field = 'a.art_id';
			$order_by_type ='desc';
			$group_by_field = 'a.art_id';
			$join_tbl1="tbl_article_publish p";
		    $join_condition1="p.pub_artid=a.art_id";
			$join_tbl2="tbl_users u";
		    $join_condition2="u.user_id=a.art_userid";
		
			$data['art_data'] =$this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field,$join_tbl1,'',$join_condition1,$join_tbl2,$join_condition2,'');
						
			$data['res_art'] = $this->user_model->select_query('*','tbl_research',array('res_artid'=>$data['art_data'][0]->art_id) );
			
			
			
			
				$where_must_see	= "a.art_status='15' and find_in_set(a.art_id,'".$data['art_data'][0]->pub_must_see."')";			
			$data['must_see'] =$this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_must_see, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field,$join_tbl1,'',$join_condition1);
			
			
			
			
			
			$select_filed = '*';	
			$tbl_name= 'tbl_assgin_reviewer as a';	
			$where_condition = array('a.asign_status'=>'1','a.assign_submit'=>'1','a.asign_artid'=>$data['art_data'][0]->art_id);
			$order_by_field = 'a.asgin_id';
			$order_by_type ='desc';
			$group_by_field = 'a.asgin_id';
			$join_tbl1="tbl_users u";
		    $join_condition1="u.user_id=a.asign_userid";
			
			
			$data['assin_reviewer'] =$this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field,$join_tbl1,'',$join_condition1);
			
			
			$data['other_author'] =$this->user_model->select_query('*','tbl_other_author',
													array('oa_art_id'=>$data['art_data'][0]->art_id),
													'oa_order','asc');
			
			
			if(!empty($data['art_data']))
			{
			
				$this->load->view( 'header' );
				$this->load->view( 'publisher/preview_article',$data);
				$this->load->view( 'footer');
			}
			else
			{
				 redirect('user-dashboard');
			}
		}
		else
		{
			 redirect('user-dashboard');
		}
	}
	
	public function preview_article_fulltext()
	{
		if($this->uri->segment(2))
		{
			$art_id = $this->uri->segment(2);
			
			$select_filed = '*';	
			$tbl_name= 'tbl_article as a';	
			$where_condition = array('a.art_status'=>'14','a.art_id'=>$art_id);
			$order_by_field = 'a.art_id';
			$order_by_type ='desc';
			$group_by_field = 'a.art_id';
			$join_tbl1="tbl_article_publish p";
		    $join_condition1="p.pub_artid=a.art_id";
			$join_tbl2="tbl_users u";
		    $join_condition2="u.user_id=a.art_userid";
		
			$data['art_data'] =$this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field,$join_tbl1,'',$join_condition1,$join_tbl2,$join_condition2,'');
			
			
			$data['res_art'] = $this->user_model->select_query('*','tbl_research',array('res_artid'=>$data['art_data'][0]->art_id) );
			
			
			$select_filed = '*';	
			$tbl_name= 'tbl_assgin_reviewer as a';	
			$where_condition = array('a.asign_status'=>'1','a.assign_submit'=>'1','a.asign_artid'=>$data['art_data'][0]->art_id);
			$order_by_field = 'a.asgin_id';
			$order_by_type ='desc';
			$group_by_field = 'a.asgin_id';
			$join_tbl1="tbl_users u";
		    $join_condition1="u.user_id=a.asign_userid";
			
			
			$data['assin_reviewer'] =$this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field,$join_tbl1,'',$join_condition1);
			
			
			$data['other_author'] =$this->user_model->select_query('*','tbl_other_author',
													array('oa_art_id'=>$data['art_data'][0]->art_id),
													'oa_order','asc');
			
			if(!empty($data['art_data']))
			{
				$this->load->view( 'header' );
				$this->load->view( 'publisher/preview_article_fulltext',$data);
				$this->load->view( 'footer');
			}
			else
			{
				 redirect('user-dashboard');
			}
		}
		else
		{
			 redirect('user-dashboard');
		}
	}
	
	
	
	/* COMPLETE PAPER MANUSCRIPT LIST*/	
	public function complete_paper()
	{
	
		
		$select_filed = '*';	
		 $tbl_name= 'tbl_article';	
		//$where_condition = array('art_status'=>'14','art_editor_decision'=>'Accept');
		$where_condition = '(art_status="14" OR art_status="15" ) AND art_editor_decision ="Accept"';
		$order_by_field = 'art_id';
		$order_by_type ='desc';
		$group_by_field = 'art_id';
	
		$all_list =$this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field);
		
		$url = base_url().'complete-paper';
		$no_data = sizeof($all_list);
		$limit = 10;
		$uri_seg =$this->uri->segment(2);
		$all_record = 'N';
		
		
		$data['total_records']	= sizeof($all_list); 

		if($this->uri->segment(2)==0 or $this->uri->segment(2)==1){
			$data['offset']	= $offset =0;
		}else{
			$data['offset']	= $offset = ($this->uri->segment(2)-1)*$limit;
		}


		$data['page_no'] 	 =  custom_pagination($url,$no_data,$limit,$uri_seg);
		
		$data['proof_data'] 		 = $this->user_model->select_query_with_pagination( $select_filed, $tbl_name, $where_condition, $limit, $offset, $all_record, $order_by_field, $order_by_type,$group_by_field);
		
	
		$this->load->view( 'header' );
		$this->load->view( 'publisher/compelte_paper',$data);
		$this->load->view( 'footer');		
	}
	
	function publish_final_article()
	{
		extract($this->input->post());
		$data_update = array( 'art_status' =>'15','art_publish'=>date('Y-m-d'),'art_update'=>date('Y-m-d'));
		$where_condition 	= '(art_id="'.$art_id.'")';			
		$update_pass   = $this->user_model->update_query($data_update,'tbl_article',$where_condition);
		
		
				
		$select_filed = 'a.*,u.*';	
		$tbl_name= 'tbl_article as  a ';	
		$where_condition = "a.art_id='".$art_id."' AND (a.art_status='13' OR a.art_status='14' OR a.art_status='15'  )"; 
		$order_by_field = 'a.art_id';
		$order_by_type ='desc';
		$group_by_field = 'a.art_id';
		$join_tbl1 = 'tbl_users as u'; 
		$join_type1 = 'left'; 
		$join_condition1 = 'u.user_id=a.art_userid';
	
	
		$article_data = $this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field, $join_tbl1, $join_type1, $join_condition1);
		
		
		
		 $inset_data  = 	array("art_id"=>$art_id,
										  "art_status"=>'15',
										  "from_type"=>'P',
										  "to_type"=>'A',
										  "from_id"=>$this->session->userdata('userid'),
										  "to_id"=>$article_data[0]->art_userid,
										  "message"=>"Publisher publish your article.",
										  "p_read"=>'1',
										  "date"=>date('Y-m-d')
								  );
					
							$insert = $this->user_model->insert_data('tbl_article_message',$inset_data);
							
			
			$copy = $this->user_model->get_row_with_con('tbl_admin',array('id'=>1));
			
			
						
							
							/* AUTHOR EMAIL */
			
							 $to_author = $article_data[0]->user_email;
							$subject = 'Publisher publish your article ';
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
							$message_author .= 'The manuscript "'.$article_data[0]->art_fulltitle.'", have been publish in my journal..<br><br></p>';
							 $message_author .=" <p align='center'>
							  <a href='".base_url()."article-detail/".$article_data[0]->art_no."'>
							  	  <button type='button' style='background: #00CC33;border: none;padding:1% 2%;color: #fff; letter-spacing: 1px;margin: 0% 0% 1%;cursor: pointer;font-size: 16px;border-radius: 4px;'>Paper publish link</button>
							  	  </a>
								 <br>
							</p>
							 <p style='font-size: 15px; font-family:Tahoma, Geneva, sans-serif; color: #646161'>
							 
							 With kind regards,<br><br>
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
							
							
					
		
		
		
		echo $art_id;
	}
	
	function delete_publish_article()
	{
		extract($this->input->post());
		$data_update = array( 'art_status' =>'13');
		$where_condition 	= '(art_id="'.$pub_artid.'")';			
		$update_pass   = $this->user_model->update_query($data_update,'tbl_article',$where_condition);
		
		
		$delete_publish_art   = $this->user_model->delete_query('tbl_article_publish',array('pub_artid'=>$pub_artid));
		echo $art_id;
		
	}
}
?>
