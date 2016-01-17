<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class General_login extends CI_Controller { 

	/**

	 * Index Page for this controller.

	 *

	 * Maps to the following URL

	 * 		http://example.com/index.php/welcome

	 *	- or -  

	 * 		http://example.com/index.php/welcome/index

	 *	- or -

	 * Since this controller is set as the default controller in 

	 * config/routes.php, it's displayed at http://example.com/

	 *

	 * So any other public methods not prefixed with an underscore will

	 * map to /index.php/welcome/<method_name>

	 * @see http://codeigniter.com/user_guide/general/urls.html

	 */

	 

	 

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
	 }

	 	
	public function login()
	{
		if($this->session->userdata('userid'))
		{
			redirect('user-dashboard');
		}
		else
		{
			$data='';
	
			$this->load->view('header');
			$this->load->view('login',$data);
			$this->load->view('footer');
		}
	}
	
	public function login_action()
	{
		//echo '<pre>';
		//print_r($_POST);
		//exit;
		
		$this->load->helper('cookie');
			 
		extract($this->input->post());
			 
		$check_where =  array('user_email'=>$user_email,'user_password'=>md5($user_pass),'user_type'=>$user_type);
 		$check_ussertype_details = $this->user_model->select_checkunique( '*','tbl_users', $check_where);	
		
		
			 
		$check_where1 =  array('user_email'=>$user_email,'user_password'=>md5($user_pass));
		
 		$check_ussertype_details1 = $this->user_model->select_checkunique( '*','tbl_users', $check_where1);	
		
		
		// CONDITION FOR REVIEWER WHICH IS NOT AUTHOR START 
		if(empty($check_ussertype_details) && ($user_type=='1') && ($check_ussertype_details1[0]->user_type=='3'))
		{
			$whre_user_id=	$check_ussertype_details1[0]->user_id;
			$update_val['user_type'] = '1';
			$update_val['user_reviewer'] = '1';
			$insert_id = $this->user_model->update("tbl_users",$update_val,array('user_id'=>$whre_user_id));

			$check_where =  array('user_email'=>$user_email,'user_password'=>md5($user_pass),'user_type'=>'1','user_reviewer'=>'1');
 			$check_ussertype_details = $this->user_model->select_checkunique( '*','tbl_users', $check_where);	
			
		}		
		// CONDITION FOR REVIEWER WHICH IS NOT AUTHOR END 
		
		
		if(empty($check_ussertype_details) && ($user_type=='3'))
		{
			
			$check_where =  array('user_email'=>$user_email,'user_password'=>md5($user_pass),'user_type'=>'1','user_reviewer'=>'1');
 			$check_ussertype_details = $this->user_model->select_checkunique( '*','tbl_users', $check_where);	
				$this->session->set_userdata( 'user_rool','reviewer');
		}
		
		
		if( empty($check_ussertype_details) && (!empty($check_ussertype_details1)))
		{
			if(($user_type=='3')&&(!empty($check_ussertype_details1[0]->user_artid))
				 &&(!empty($check_ussertype_details1[0]->user_inviteid)) )
				{
 					$check_ussertype_details = $check_ussertype_details1;
					$this->session->set_userdata( 'user_rool','reviewer');
				} 
		}
		
		
			 if(is_array($check_ussertype_details) && !empty($check_ussertype_details))
			 {
					$data['user_details'] = 	 $check_ussertype_details;
					$active_st = $data['user_details'][0]->user_status;				
					
					if(  $active_st ==1 ){
						
						$this->session->set_userdata( 'user_details',$data['user_details']);
						$this->session->set_userdata( 'userid',$data['user_details'][0]->user_id);
						$this->session->set_userdata( 'username',$data['user_details'][0]->user_fname);
						
						
						//$this->session->set_userdata( 'usertype',$data['user_details'][0]->user_type);
						
						
						
						$this->session->set_userdata( 'usertype',$user_type);
						
                    
							 	
							$this->load->helper('cookie');
			 
						if(isset($_POST['user_remember']) && ($_POST['user_remember']=='1'))
						{ 
						
							  $time_coockie = (time()+3600*24*7);
							 $domain = base_url();
						   $this->input->set_cookie('remember_user', $user_email,$time_coockie);
						   $this->input->set_cookie('remember_pass', $user_pass,$time_coockie);
						   $this->input->set_cookie('remember_me', $user_remember,$time_coockie);
						
						
							
						}		
						
						 $this->session->set_flashdata('success', 'Your are login successfully!');
						 
						 redirect('user-dashboard');
					
					}
					else
					 {
						$this->session->set_flashdata('error', 'Your Account is not activate.');
						redirect('login');
					 }
			 }
			 else
			 {
					$this->session->set_flashdata('error', 'Invalid Email, passowrd or Identity');
					redirect('login');
			
			 }
		
	}
	
	public function logout()
	{		
		$user_details = $this->session->userdata('user_details');
			$this->session->unset_userdata('userid');
			$this->session->unset_userdata('user_details');
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('usertype');			
			$this->session->sess_destroy();
			redirect(base_url());
	}
	
	public function sign_up()
	{
	
		if($this->session->userdata('userid'))
		{
			redirect('user-dashboard');
		}
		else
		{
		
			$data['countries'] =$this->user_model->select_query('*','tbl_countries',array('code != '=>''),'name','asc');
			$data['classify'] =$this->user_model->select_query('*','tbl_article_classified',array('asubmi_status'=>'1'),'asubmi_id','desc');
	
			$this->load->view('header');
			$this->load->view('sign_up',$data);
			$this->load->view('footer');
		}
	}
	
	public function sign_up_action()
	{
		/*echo '<pre>'; 
		print_r($_POST);
		exit;*/
	
		$user_catid ='1';
			
				$post=$this->input->post();
				$tbl_name  = "tbl_users";
				 extract($post);
				 
					 $str = rand(5,10);
			 		$randum_key = md5($str);
					
					
						$user_reviewer_value =0;
					
					if(isset($_POST['user_reviewer']))
					{
						$user_reviewer_value =1;
					}
					
					
				 $inset_data  =  array("user_type"=>$user_catid,
										"user_fname"=>$user_fname,
										"user_lname"=>$user_lname,
										"user_email"=>$user_email,
										"user_address"=>$user_address,
										"user_country"=>$user_country,
										"user_password"=>md5($user_password),
										"user_invitepass"=>$user_password,
										"user_instiute"=>$user_instiute,
										"user_classification"=>$user_classification,
										"user_reviewer"=>$user_reviewer_value,
										"user_status"=>'1',
										"randum_key"=>$randum_key,
										"user_dateadd"=>date("Y-m-d"));
										
							$insert = $this->user_model->insert_data($tbl_name,$inset_data);
							/*$this->session->set_flashdata("sucess","Successfully registration.");
							redirect('login');*/
							
							
							
							
							$copy = $this->user_model->get_row_with_con('tbl_admin',array('id'=>1));
							 $to = $user_email;
							/*$subject = 'Account Activation link';
							$message = "							
							<html>
							<head>
							<title>".$subject."</title>
							</head>
							<body>
							<div  style='width:700px; float:left;'>
  <div  style='width: 98%;float: left;background: #F7F7F7;padding: 1%;border-radius: 4px;border-top: 3px solid #ee4723;'>
  <div > <img src='".base_url()."design/front/images/logo.png'/> </div> 
								<p style='font-size: 17px; font-family:Tahoma, Geneva, sans-serif;'>Dear ".$user_fname." ".$user_lname.", </p>
							 <p style='font-size: 15px; font-family:Tahoma, Geneva, sans-serif; color: #646161'>Thank you for joining  us . Before you are able to post your article  on Portal, you need to activate your account. In order to activate your account, you must verify your email by going to the link below. <br><br>
							 <a href='".base_url("set-activation/".$randum_key)."' style='color: #000;letter-spacing: 1px;text-decoration: none;font-size: 17px;text-transform: capitalize;font-weight: 600;font-family:Tahoma, Geneva, sans-serif;'>Please click here to activate your account </a></p>
							 </div>
  <div  style='width:100%;float:left; background:#ee4723; padding:0%; color:#fff; text-align:center;'>
    <p>".$copy->footer_copy."</p>
  </div>
</div>
							</body>
							</html>
							";*/
							
							$subject = 'Account Detail';
							$message = "							
							<html>
							<head>
							<title>".$subject."</title>
							</head>
							<body>
							<div  style='width:700px; float:left;'>
  <div  style='width: 98%;float: left;background: #F7F7F7;padding: 1%;border-radius: 4px;border-top: 3px solid #ee4723;'>
  <div > <img src='".base_url()."design/front/images/logo.png'/> </div> 
								<p style='font-size: 17px; font-family:Tahoma, Geneva, sans-serif;'>Dear ".$user_fname." ".$user_lname.", </p>
							 <p style='font-size: 15px; font-family:Tahoma, Geneva, sans-serif; color: #646161'>Thank you for creating an account for Lean Corrosion.<br><br>
							 You can login to your account and edit your personal information and contact preferences using the information below:<br><br>							 
							 Access your account here: <br>".base_url()."login<br>
							 USER ID: ".$user_email."<br>
							 Password: ".$user_password."<br><br>							 
							 You can check and edit your research interests in our online review system by logging into your account, clicking on your name at the top of the screen, selecting 'User ID & Password' from the list, and then completing the 'Research Interests' box (at end of page). You may also select a number of keywords describing your particular area(s) of expertise. Under the \"Keywords\" heading, in the \"Search on this list\" box you can search the list using the wildcard * for keywords relevant to your area of expertise, e.g. ENZYM* to find keywords related to enzymes.<br><br>
If you have any questions about why you have received this email, please contact the editorial office.<br><br>
Yours sincerely,<br>
Lean Corrosion Editorial Office<br>
leancorrosion@lean.com
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
							
							
								
								
							if($result==false) {
								$this->session->set_flashdata("error", 'Email not send');
								redirect('login');
							} else {
							
							   $this->session->set_flashdata("success","You are registered successfully.Please check your email for login detail");	
								redirect('login');
							}
		
	}
	public function check_unique_email()
	{
	
		$email = $_POST['email'];
		$tbl_name = "tbl_users";
		$where_condition = array('user_email'=>$email);
		
		
		$return =  $this->user_model->check_booking($tbl_name,$where_condition);	
		
		if($return)	{		
				echo 1;
		}
		else
		{
			echo 0;			
		}
	
	}
	
	
	public function user_activation()
	{
		
		$key = $this->uri->segment(2);
		
		$update_data = array('randum_key'=>'','user_status'=>'1');
		$tbl_name = "tbl_users";
		$where_condition = array('randum_key'=>$key);
		
		
		$return =  $this->user_model->get_row_with_con($tbl_name,$where_condition);
		if($return)	{
			
					//	$update_pass   = $this->user_model->update_query($data, $tbl_name,$where_condition);	
						
			$return = $this->user_model->update_query($update_data,$tbl_name,$where_condition);	
			$this->session->set_flashdata("success", "Your account sucessfully activeted.");
			redirect('login');
		}
		else
		{
			$this->session->set_flashdata("error","Your account not actived");
			redirect('login');
		}
	}
	
	
	
	
	public function forgot_password()
	{		  
	    $data['title'] = 'Forget Password';	   
		$this->load->view('header');
		$this->load->view('reset_password',$data);
		$this->load->view('footer');
	}
	
	
	public function reset_password()
	{
	   
	    $post=$this->input->post();
		
	    if(isset($post['user_email']))
		{
		    $str = rand(5,10);
			$randum_key = md5($str);
			$update_val['reset_key'] = $randum_key;
			$insert_id = $this->user_model->update("tbl_users",$update_val,array('user_email'=>$post['user_email']));
			
			if(is_numeric($insert_id) and $insert_id>0)
			{					
				$result=$this->user_model->get_row_with_con('tbl_users',array('user_email'=>$post['user_email']));
				$user_fname = $result->user_fname;
				$user_lname = $result->user_lname;
				
				
				$copy = $this->user_model->get_row_with_con('tbl_admin',array('id'=>1));
						
				$key=$result->reset_key;
				$link = base_url().'change-password/?reset_link='.$key;
		        $newlink= "<a href='".$link."'>click here</a>";
				$to = $post['user_email'];
				$subject = 'Forget Password';
				$message = "
				<html>
				<head>
				<title>".$subject."</title>
				</head>
				<body>
				<div  style='width:700px; float:left;'>
					  <div  style='width: 98%;float: left;background: #F7F7F7;padding: 1%;border-radius: 4px;border-top: 3px solid #ee4723;'>
					  <div > <img src='".base_url()."design/front/images/logo.png'/> </div>
													<p style='font-size: 17px; font-family:Tahoma, Geneva, sans-serif;'>Dear ".$user_fname." ".$user_lname.", </p>
												 <p style='font-size: 15px; font-family:Tahoma, Geneva, sans-serif; color: #646161'>Thank you for requesting to reset your password. You can reset your password using the link below.<br><br>
												 <a href='".$link ."' style='color: #000;letter-spacing: 1px;text-decoration: none;font-size: 17px;text-transform: capitalize;font-weight: 600;font-family:Tahoma, Geneva, sans-serif;'>Please click here  </a><br><br>
									If you wish to edit your personal information and contact preferences, please login to your account using the information below:<br>
									Access your account here:<br> ".base_url()."login<br>
USER ID: ".$result->user_email."<br>
Password: ".$result->user_invitepass."<br><br>";

if($result->user_reviewer){

$message.= "Please note, your user ID and password are the same for Lean Corrosion as author and reviewer.<br><br>";
}

$message.= "Yours sincerely,<br>
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
				
				$result = chatroomemail($to,MAILFROM,MAILFROMNAME,$subject,$message);
				
				
					
					
				if($result==false) {
				    
					$this->session->set_flashdata("error","Mail Not Sent...");
					redirect(base_url().'forgot-password');
				} else {
				  
				   $this->session->set_flashdata("success", "You request accepted successfully.For reset password click on the link received on your mail.");	
				   redirect(base_url().'forgot-password');
				
				}
			}
			else{
			    $this->session->set_flashdata("error","Please enter registered email.");
				redirect(base_url().'forgot-password');
			}
		}
	}
	public function change_password()
	{
		/*echo '<pre>';
		print_r($_POST);
		exit;*/
	
	    $post=$this->input->post();
		if(isset($post['submit']))
		{
			$update_val['user_password'] = md5($post['user_cnewpass']);
			$update_val['user_invitepass'] = $post['user_cnewpass'];
			$update_val['reset_key'] = '';
			$insert_id = $this->user_model->update("tbl_users",$update_val,array('reset_key'=>$post['reset_key']));
			if(is_numeric($insert_id) and $insert_id>0)
			{
			    $this->session->set_flashdata("success","Password reset successfully.");
				$this->session->set_flashdata("log_error","Password does not change.");
				redirect(base_url().'login');
			}
			else
			{  
			    $this->session->set_flashdata("error","Password does not change.");
				$this->session->set_flashdata("log_error","Password does not change.");
				redirect(base_url().'login');
			}
		}
	    $data['reset_key'] = $this->input->get('reset_link');
	    if(isset($data['reset_key']))
		{
			$result=$this->user_model->get_row_with_con('tbl_users',array('reset_key'=>$data['reset_key']));
			if(!empty($result))
			{
			    //echo "now you can change your password"; die;
				$data['title'] = 'Change Password';
				$this->load->view('header',$data);
				$this->load->view('rest_new_password',$data);
				$this->load->view('footer');
		    }
		    else{
			    $this->session->set_flashdata("error","Password already reset.");
		        $this->session->set_flashdata("log_error","Password does not change.");
				redirect(base_url().'login');
		    }
	    }
	}
	
	
	/* REVIEWER AGREE TO REVIEW BY EMAIL */
	function reviewer_agree()
	{
		
		
		$key = $this->uri->segment(2);
		
		$where_condition = array('asign_randum'=>$key);
		
		
		$result =  $this->user_model->get_row_with_con('tbl_assgin_reviewer',$where_condition);
		if($result)
		{
			$asign_status ='1';
			$asign_artid = $result->asign_artid ;
			$asign_userid = $result->asign_userid ;
			
			$data = array( 'asign_status' => $asign_status,'asign_randum'=>'');
			$where_condition = array('asgin_id'=>$result->asgin_id,'asign_artid'=>$result->asign_artid,'asign_randum'=>$key);			
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
			
			$message = "<html>
							<head>
							<title>".$subject."</title>
							</head>
							<body>
							<div  style='width:700px; float:left;'>
  <div  style='width: 98%;float: left;background: #F7F7F7;padding: 1%;border-radius: 4px;border-top: 3px solid #ee4723;'>
  <div > <img src='".base_url()."design/front/images/logo.png'/> </div> 
								<p style='font-size: 17px; font-family:Tahoma, Geneva, sans-serif;'>Dear ".$art_data[0]->user_fname."&nbsp".$art_data[0]->user_lname.": </p>
							 <p style='font-size: 15px; font-family:Tahoma, Geneva, sans-serif; color: #646161'>";
$message .='Your manuscript entitled "'.$art_data[0]->art_fulltitle.'" has been assigned to the Reviewer. The reviewer one have accepted the invitation to agree to review your manuscript in 10 days. Please keep your patience to wait for review report.<br><br> You can click the button of "author view" to check the process of manuscript.<br><br>';
$message .="You can click the button of 

	<a href='".base_url()."login'><button type='button' style='background: #00CC33;border: none;padding:1% 2%;color: #fff; letter-spacing: 1px;margin: 0% 0% 1%;cursor: pointer;font-size: 16px;border-radius: 4px;'>Auhtor main menu</button></a>
	
	
	<br><br>
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
							
							
							$result = chatroomemail($to,MAILFROM,MAILFROMNAME,$subject,$message);
			
			/* EDITOR EMAIL*/
			$editor = $this->user_model->get_row_with_con('tbl_users',array('user_type'=>'2'));
			$to_editor =$editor->user_email;
			
			$result = chatroomemail($to_editor,MAILFROM,MAILFROMNAME,$subject,$message);
			
			
			if(($asign_status==1) && ($feed_back_send==0))
			{		
				$update_pass   = $this->user_model->update_query(array( 'art_status' => '5'),'tbl_article',array('art_id'=>$asign_artid));
			}
							
							
							
			/* REVIEWER EMAIL*/				
			
			$reviewer = $this->user_model->get_row_with_con('tbl_users',array('user_id'=>$asign_userid));
			$to_reviewer =$reviewer->user_email;
			$reviewer_sub ="Reviewer can submit the review report before Due Date";
				
			$message_reviewer = "<html>
							<head>
							<title>".$reviewer_sub."</title>
							</head>
							<body>
							<div  style='width:700px; float:left;'>
  <div  style='width: 98%;float: left;background: #F7F7F7;padding: 1%;border-radius: 4px;border-top: 3px solid #ee4723;'>
  <div > <img src='".base_url()."design/front/images/logo.png'/> </div> 
								<p style='font-size: 17px; font-family:Tahoma, Geneva, sans-serif;'>Dear ".$reviewer->user_fname."&nbsp".$reviewer->user_lname.",<br></p>
							 <p style='font-size: 15px; font-family:Tahoma, Geneva, sans-serif; color: #646161'>";
$message_reviewer .='Thank you for agreeing to review manuscript, "'.$art_data[0]->art_fulltitle.'", for Lean Corrosion. The Editors want to ensure that all manuscripts published in the Lean Corrosion have significant novelty and have not been published elsewhere, in whole or in part. We therefore request that you provide specific comments regarding the novelty of the research in your recommendation...<br><br>If possible, I would appreciate receiving your review for Lean Corrosion by '.date("M d, Y",strtotime($art_data[0]->art_duedate)).'<br><br>
You can download all manuscript and check the newsfeed about this manuscript. 
';
$message_reviewer .="<a href='".base_url()."login'> <button type='button' style='background: #00CC33;border: none;padding:1% 2%;color: #fff; letter-spacing: 1px;margin: 0% 0% 1%;cursor: pointer;font-size: 16px;border-radius: 4px;'>Reviewer Mainmenu</button> </a><br><br>
Or Please log into the journal System at ".base_url()." as a Reviewer to access the manuscript and submit your review online.<br><br>

Your username is: ".$reviewer->user_email."<br><br>
Your password is: ".$reviewer->user_invitepass."<br><br>

	
	
	<br><br>
	Thank you for participating in the peer-review process, which is so important to all of us as researchers and authors.
	
	<br><br>
	
With kind regards,<br><br>
Yours sincerely,<br>
Lean Corrosion Editorial Office<br>
leancorrosion@lean.com<br></p></div>
  <div  style='width:100%;float:left; background:#ee4723; padding:0%; color:#fff; text-align:center;'>
    <p>".$copy->footer_copy."</p>
  </div>
</div>
							</body>
							</html>";
							
							
							$result = chatroomemail($to_reviewer,MAILFROM,MAILFROMNAME,$subject,$message_reviewer);
						
			   $this->session->set_flashdata("success","Thanks, for agrre to review on manuscript.");
			
		}
		else
		{
			
			    $this->session->set_flashdata("error","You already submit your response for manuscript.");
		}
		
			
				redirect(base_url().'login');
			
			
			
	
	}
	
	
	/* REVIEWER REJECT TO REVIEW BY EMAIL */
	function reviewer_reject()
	{
		
		
		
		$key = $this->uri->segment(2);
		
		$where_condition = array('asign_randum'=>$key);
		
		
		$result =  $this->user_model->get_row_with_con('tbl_assgin_reviewer',$where_condition);
		if($result)
		{
			$asign_status ='2';
			$asign_artid = $result->asign_artid ;
			$asign_userid = $result->asign_userid ;
			
			$data = array( 'asign_status' => $asign_status,'asign_randum'=>'');
			$where_condition = array('asgin_id'=>$result->asgin_id,'asign_artid'=>$result->asign_artid,'asign_randum'=>$key);			
			$update_pass   = $this->user_model->update_query($data,'tbl_assgin_reviewer',$where_condition);
			
			
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
			$subject = 'Reviewer reject to review this manuscript';
			
			$message = "<html>
							<head>
							<title>".$subject."</title>
							</head>
							<body>
							<div  style='width:700px; float:left;'>
  <div  style='width: 98%;float: left;background: #F7F7F7;padding: 1%;border-radius: 4px;border-top: 3px solid #ee4723;'>
  <div > <img src='".base_url()."design/front/images/logo.png'/> </div> 
								<p style='font-size: 17px; font-family:Tahoma, Geneva, sans-serif;'>Dear ".$art_data[0]->user_fname."&nbsp".$art_data[0]->user_lname.": </p>
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
							
							
							$result = chatroomemail($to,MAILFROM,MAILFROMNAME,$subject,$message);
			
			/* EDITOR EMAIL*/
			$editor = $this->user_model->get_row_with_con('tbl_users',array('user_type'=>'2'));
			$to_editor =$editor->user_email;
			
			$result = chatroomemail($to_editor,MAILFROM,MAILFROMNAME,$subject,$message);
			
				
			   $this->session->set_flashdata("success","Thanks, for Reject to review on manuscript.");
			
		}
		else
		{
			
			    $this->session->set_flashdata("error","You already submit your response for manuscript.");
		}
		
			
				redirect(base_url().'login');
			
			
			
			
	
	}
	
	
}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */
