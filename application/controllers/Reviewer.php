<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Reviewer extends CI_Controller {

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
		front_reviwer_user_func_check();
	}
	
	
	
	public function reviewer_view_project()
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
			$data_update = array( 'r_read'=>'1');
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
			
			$data['assign_art'] =$this->user_model->get_row_with_con('tbl_assgin_reviewer',array('asign_artid'=>$art_id,'asign_userid'=>$this->session->userdata('userid')));
			
			$this->load->view( 'header' );
			$this->load->view( 'reviewer/project_detail',$data);
			$this->load->view( 'footer');
			
		}
		else
		{
			redirect('user-dashboard');
		}
			
	}
	public function upadte_status()
	{
	
		 extract($this->input->post());
		 
		 	$data = array( 'asign_status' => $asign_status);
			$where_condition 	= array('asgin_id'=>$asgin_id,'asign_artid'=>$asign_artid);			
			$update_pass   = $this->user_model->update_query($data,'tbl_assgin_reviewer',$where_condition);
			
				
			$feed_back_send   = $this->user_model->check_no_rec('tbl_article',array( 'art_status > ' => '5','art_id'=>$asign_artid));
			
			
			
			
			$select_filed = 'a.*,u.*';	
			$tbl_name= 'tbl_article as  a ';	
			$where_condition =  array('a.art_id'=>$asign_artid);
			$order_by_field = 'a.art_id';
			$order_by_type ='desc';
			$group_by_field = 'a.art_id';
			$join_tbl1 = 'tbl_users as u'; 
			$join_type1 = ''; 
			$join_condition1 = 'a.art_userid=u.user_id';
			$art_data =$this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field, $join_tbl1, $join_type1, $join_condition1);
			
			
			
			$copy = $this->user_model->get_row_with_con('tbl_admin',array('id'=>1));
			$to = $art_data[0]->user_email;
			$subject = 'Reviewer agree to review this manuscript';
			
			if($asign_status==1)
			{
							
			$message = "<html>
							<head>
							<title>".$subject."</title>
							</head>
							<body>
							<div  style='width:700px; float:left;'>
  <div  style='width: 98%;float: left;background: #F7F7F7;padding: 1%;border-radius: 4px;border-top: 3px solid #ee4723;'>
  <div > <img src='".base_url()."design/front/images/logo.png'/> </div> 
								<p style='font-size: 17px; font-family:Tahoma, Geneva, sans-serif;'>Dear ".$art_data[0]->user_fname."&nbsp;".$art_data[0]->user_lname.": </p>
							 <p style='font-size: 15px; font-family:Tahoma, Geneva, sans-serif; color: #646161'>";
$message .='Your manuscript entitled "'.$art_data[0]->art_fulltitle.'" has been assigned to the Reviewer. The reviewer one have accepted the invitation to agree to review your manuscript in 10 days. Please keep your patience to wait for review report.<br><br> You can click the button of "author view" to check the process of manuscript.<br><br>';
$message .="You can click the button of <a href='".base_url()."login'><button type='button' style='background: #00CC33;border: none;padding:1% 2%;color: #fff; letter-spacing: 1px;margin: 0% 0% 1%;cursor: pointer;font-size: 16px;border-radius: 4px;'>Auhtor main menu</button></a><br><br>
Sincerely,<br><br>
Yours sincerely,<br>
Lean Corrosion Editorial Office<br>
leancorrosion@lean.com<br></p></div>
  <div  style='width:100%;float:left; background:#ee4723; padding:0%; color:#fff; text-align:center;'>
    <p>".$copy->footer_copy."</p>
  </div>
</div>
							</body>
							</html>";
	

			}
			elseif($asign_status==2)
			{
				
							
			$message = "<html>
							<head>
							<title>".$subject."</title>
							</head>
							<body>
							<div  style='width:700px; float:left;'>
  <div  style='width: 98%;float: left;background: #F7F7F7;padding: 1%;border-radius: 4px;border-top: 3px solid #ee4723;'>
  <div > <img src='".base_url()."design/front/images/logo.png'/> </div> 
								<p style='font-size: 17px; font-family:Tahoma, Geneva, sans-serif;'>Dear ".$art_data[0]->user_fname."&nbsp;".$art_data[0]->user_lname.": </p>
							 <p style='font-size: 15px; font-family:Tahoma, Geneva, sans-serif; color: #646161'>";
$message .='Your manuscript entitled "'.$art_data[0]->art_fulltitle.'" has been assigned to the Reviewer. The reviewer one have reject the invitation to  review your manuscript in 10 days. <br><br>';
$message .="Sincerely,<br><br>
Yours sincerely,<br>
Lean Corrosion Editorial Office<br>
leancorrosion@lean.com<br></p></div>
  <div  style='width:100%;float:left; background:#ee4723; padding:0%; color:#fff; text-align:center;'>
    <p>".$copy->footer_copy."</p>
  </div>
</div>
							</body>
							</html>";
			}
			
			
			$result = chatroomemail($to,MAILFROM,MAILFROMNAME,$subject,$message);
			
			
			$editor = $this->user_model->get_row_with_con('tbl_users',array('user_type'=>'2'));
			$to_editor =$editor->user_email;
			
			$result = chatroomemail($to_editor,MAILFROM,MAILFROMNAME,$subject,$message);
			
			
			if(($asign_status==1) && ($feed_back_send==0))
			{		
				$update_pass   = $this->user_model->update_query(array( 'art_status' => '5'),'tbl_article',array('art_id'=>$asign_artid));
			}
			
	}
	
	
	public function submit_review()
	{
	
		$asgin_id =$this->uri->segment(2);
		$user_id = $this->session->userdata('userid');
		
		$where_condition = array('asign_status'=>'1','asgin_id'=>$asgin_id,'asign_userid'=>$user_id);
		
		$data['assign_data'] = $get_rec = $this->user_model->select_query('*','tbl_assgin_reviewer', $where_condition);
		if(!empty($get_rec))
		{
			$this->load->view( 'header' );
			$this->load->view( 'reviewer/submit_review_frm',$data);
			$this->load->view( 'footer');	
		}
		else
		{
			redirect('article-progress');
		}
		
	}
	
	public function submit_review_action()
	{		
		 extract($this->input->post());
		 
		 $new_sr_quality=0;
		 
		 if(isset($_POST['sr_quality']))
		 {
		 	 $new_sr_quality=1;
		 }
		
		$insert_data =  array("sr_assignid"=>$asgin_id,
							  "sr_artid"=>$art_id,
							  "sr_userid"=>$this->session->userdata('userid'),
							  "sr_status"=>$sr_status,
							  "sr_quality"=>$new_sr_quality,
							  "sr_report"=>$sr_report,
							  "sr_dateadd"=>date('Y-m-d')
							);
							
	$query =$this->user_model->insert_data('tbl_submit_review',$insert_data);
	
	
	
	
	
			$data = array( 'assign_submit' => '1');
			$where_condition 	= array('asgin_id'=>$asgin_id,'asign_artid'=>$art_id);			
			$update_pass   = $this->user_model->update_query($data,'tbl_assgin_reviewer',$where_condition);
			
			
			
			$update_artital_status  = $this->user_model->update_query(array( 'art_status' => '6'),'tbl_article',array('art_id'=>$art_id));
			
			
	
	
	
	 $select_filed = 'a.*,u.*';	
		 $tbl_name= 'tbl_article as  a ';	
		$where_condition = array('a.art_id'=>$art_id,'a.art_status >'=>'1');
		$order_by_field = 'a.art_id';
		$order_by_type ='desc';
		$group_by_field = 'a.art_id';
		$join_tbl1 = 'tbl_users as u'; 
		$join_type1 = ''; 
		$join_condition1 = 'u.user_id=a.art_userid';
		
	
		$all_list =$this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field, $join_tbl1, $join_type1, $join_condition1);
		

	$autho_username = $all_list[0]->user_fname.'&nbsp;'.$all_list[0]->user_lname;
	$autho_toemail =$all_list[0]->user_email;
	
	
	
							$copy = $this->user_model->get_row_with_con('tbl_admin',array('id'=>1));
							$to = $autho_toemail;
							$subject = 'Review by Reviewer';
							$message = "							
							<html>
							<head>
							<title>".$subject."</title>
							</head>
							<body>
							<div  style='width:700px; float:left;'>
  <div  style='width: 98%;float: left;background: #F7F7F7;padding: 1%;border-radius: 4px;border-top: 3px solid #ee4723;'>
  <div > <img src='".base_url()."design/front/images/logo.png'/> </div> 
								<p style='font-size: 17px; font-family:Tahoma, Geneva, sans-serif;'>Dear ".$autho_username.", </p>
							 <p style='font-size: 15px; font-family:Tahoma, Geneva, sans-serif; color: #646161'>".$sr_report." <br><br>
							</p>
							 </div>
  <div  style='width:100%;float:left; background:#ee4723; padding:0%; color:#fff; text-align:center;'>
    <p>".$copy->footer_copy."</p>
  </div>
</div>
							</body>
							</html>
							";
							
							/*echo $message;
							exit;*/
							$result = chatroomemail($to,MAILFROM,MAILFROMNAME,$subject,$message);
							
							
							/*Reviewer Email*/
							$reviewer_data = $this->user_model->get_row_with_con('tbl_users',array('user_id'=>$this->session->userdata('userid')));
							
							$reviewer_username = $reviewer_data->user_fname.'&nbsp;'.$reviewer_data->user_lname;
							$to_reviewer = $reviewer_data->user_email;
							$subject_reviewer = 'Thanks To Reviewer';
							$message_reviewer = "							
							<html>
							<head>
							<title>".$subject_reviewer."</title>
							</head>
							<body>
							<div  style='width:700px; float:left;'>
  <div  style='width: 98%;float: left;background: #F7F7F7;padding: 1%;border-radius: 4px;border-top: 3px solid #ee4723;'>
  <div > <img src='".base_url()."design/front/images/logo.png'/> </div> 
								<p style='font-size: 17px; font-family:Tahoma, Geneva, sans-serif;'>Dear ".$reviewer_username.", </p>
							 <p style='font-size: 15px; font-family:Tahoma, Geneva, sans-serif; color: #646161'>Thank you for your review of this manuscript, ".$all_list[0]->art_fulltitle." <br><br>You may access your review comments and the decision letter (when available) by logging onto the web System at <a href=".base_url().">".base_url()."</a>.<br><br> 
					 <a href='".base_url()."login'>
					<button type='button' style='background: #00CC33;border: none;padding:1% 2%;color: #fff; letter-spacing: 1px;margin: 0% 0% 1%;cursor: pointer;font-size: 16px;border-radius: 4px;'>Reviewer mainmenu</button>
					 	  </a><br>
							 Kind regards,<br>
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
							
							/*echo $message;
							exit;*/
							$result = chatroomemail($to_reviewer,MAILFROM,MAILFROMNAME,$subject_reviewer,$message_reviewer);
							
							
							
	  	$this->session->set_flashdata("success","Email Send to author for report.");	
	
		redirect('user-dashboard');
	}
			
}
?>