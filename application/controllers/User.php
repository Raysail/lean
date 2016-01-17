<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class  User extends CI_Controller {

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
		front_user_func_check();
	}
	
	
	public function user_dashboard()
	{		
		$user_type =$this->session->userdata('usertype');
		$user_id =  $this->session->userdata('userid');
		
		if($user_type=='1')
		{	
			$data['user_data'] =$this->user_model->get_row_with_con('tbl_users',array('user_id'=>$user_id));
			$data['pro_listing'] =$this->user_model->select_query_with_pagination(  "*", "tbl_article",array('art_userid'=>$user_id,'art_hidden'=>'0') , '', '', 'Y', 'art_id','desc','art_id');
			
			
			
			
			$this->load->view( 'header' );
			$this->load->view( 'author/author_index',$data);
			$this->load->view( 'footer');
		}
		elseif($user_type=='2')
		{
			
			
		 $select_filed = 'a.*,u.*';	
		$tbl_name= 'tbl_article as  a ';	
		$where_condition =  "(a.art_status = 1 or a.art_status=3)";//array('a.art_status'=>'1');
		$where_condition_decline = "(a.art_status = 4 or a.art_status = 8 )";
		$where_condition_review ="(a.art_status = 2 or a.art_status = 5  or a.art_status = 6   or a.art_status = 7   or a.art_status = 9  )";
		$where_condition_proof ="(a.art_status = 10 or a.art_status = 11  or a.art_status = 12  or a.art_status = 13  or a.art_status = 14  )";
		$where_condition_complete ="(a.art_status = 15 )";
		$where_condition_back = array('a.art_status'=>'3');
		$order_by_field = 'a.art_id';
		$order_by_type ='desc';
		$group_by_field = 'a.art_id';
		$join_tbl1 = 'tbl_users as u'; 
		$join_type1 = 'left'; 
		$join_condition1 = 'u.user_id=a.art_userid';
	
		$data['in_submit'] =$this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field, $join_tbl1, $join_type1, $join_condition1);
		
		
	
		$data['in_review'] =$this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition_review, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field, $join_tbl1, $join_type1, $join_condition1);
		
	
		$data['in_decline'] =$this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition_decline, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field, $join_tbl1, $join_type1, $join_condition1);
			
	
		$data['in_proof'] =$this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition_proof, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field, $join_tbl1, $join_type1, $join_condition1);
			
	
		$data['in_complte'] =$this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition_complete, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field, $join_tbl1, $join_type1, $join_condition1);
			
			$this->load->view( 'header' );
			$this->load->view( 'editor/editor_index',$data);
			$this->load->view( 'footer');			
		}
		elseif($user_type=='3')
		{
			$user_id =  $this->session->userdata('userid');
			
			
			$select_filed = 'a.*,ar.*';	
			$tbl_name= 'tbl_assgin_reviewer as  ar ';	
			$where_condition =  array('asign_userid'=>$user_id);
			$order_by_field = 'ar.asgin_id';
			$order_by_type ='desc';
			$group_by_field = 'ar.asign_artid';
			$join_tbl1 = 'tbl_article as a'; 
			$join_type1 = ''; 
			$join_condition1 = 'a.art_id=ar.asign_artid';
			$data['pro_listing'] =$this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field, $join_tbl1, $join_type1, $join_condition1);
			
			
			
			
			
			
			
			
			
		
			$this->load->view( 'header' );
			$this->load->view( 'reviewer/reviewer_index',$data);
			$this->load->view( 'footer');
		}
		elseif($user_type=='4')
		{
		
		
			/*$where_feedback 	= ' art_status = 10 ';			
			$data['accept_publisher']   = $this->user_model->check_no_rec('tbl_article',$where_feedback);	
			
			
			$where_feedback 	= ' art_status = 11 AND (art_editor_decision="Accept")';			
			$data['proof_progerss']   = $this->user_model->check_no_rec('tbl_article',$where_feedback);	
			
			
			$where_feedback 	= ' art_status = 12 AND (art_editor_decision="Accept")';			
			$data['complete_proof']   = $this->user_model->check_no_rec('tbl_article',$where_feedback);	
			
			$where_feedback 	= ' art_status = 13 AND (art_editor_decision="Accept")';			
			$data['proof_waiting']   = $this->user_model->check_no_rec('tbl_article',$where_feedback);	
			
			$where_feedback 	= ' (art_status = 14 or art_status = 15)AND (art_editor_decision="Accept")';			
			$data['complete_paper']   = $this->user_model->check_no_rec('tbl_article',$where_feedback);	*/
			
			
		$select_filed = 'a.*,u.*';	
		$tbl_name= 'tbl_article as  a ';	
		$where_condition ="(a.art_status = 10 or a.art_status = 11  or a.art_status = 12  )";
		$where_condition_complet ="(a.art_status = 13 or a.art_status = 14  or a.art_status = 15  )";
		$order_by_field = 'a.art_id';
		$order_by_type ='desc';
		$group_by_field = 'a.art_id';
		$join_tbl1 = 'tbl_users as u'; 
		$join_type1 = 'left'; 
		$join_condition1 = 'u.user_id=a.art_userid';
	
		$data['in_proof'] =$this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field, $join_tbl1, $join_type1, $join_condition1);
	
		$data['in_completion'] =$this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition_complet, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field, $join_tbl1, $join_type1, $join_condition1);
		
			
			$this->load->view( 'header' );
			$this->load->view( 'publisher/publisher_index',$data);
			$this->load->view( 'footer');			
		}
		
		
			
	}
	
	
	public function change_password()
	{
		
		
			$data['user_id'] =  $this->session->userdata('userid');
			$this->load->view( 'header' );
			$this->load->view( 'user_changepass',$data);
			$this->load->view( 'footer');
	}
	
	public function update_password()
	{	
	
		extract($this->input->post());
		
		
		
		$tbl_name 		= 'tbl_users'; 
	
	
		$old_pass  	 = $user_passwords;
		$new_pass  	 = $user_newpass;
		$user_id  	  = $id   = $this->session->userdata( 'userid' );
			
		
		
		$where_condition 	= '(user_password="'.md5($user_passwords).'" AND user_id="'.$user_id.'")';
		$chk_old_pass = check_old_password( $tbl_name, $where_condition );
		$count 		  = $chk_old_pass->c;
		
		
		if( $count >=1 ){
			$data = array(
			   'user_password' => md5($new_pass),
			   'user_invitepass' => $new_pass
			);
			$where_condition 	= '(user_id="'.$user_id.'")';
			
			$update_pass   = $this->user_model->update_query($data, $tbl_name,$where_condition);	
			
			$this->session->set_flashdata('success', 'Password Updated Successfully.');
			redirect('update-password');
			
		} else {
			$data['error'] = 'Old Password not correct!';
			$this->session->set_flashdata('error', $data['error']);
			redirect('update-password');
		}
	}
	
	public function edit_profile()
	{	
		
		$user_type =$this->session->userdata('usertype');
		$user_id =  $this->session->userdata('userid');


		if( ($user_type=='1') && ($this->uri->segment(1)=='update-author-profile'))
		{	
					
					
					
				if(($this->session->userdata('user_rool'))&&(($this->session->userdata('user_rool'))=='author'))
				{
					
					$where_condition=array('user_id'=>$user_id,'user_type'=>'1','user_reviewer'=>'1');
				}
				else
				{
					
					$where_condition=array('user_id'=>$user_id,'user_type'=>$user_type);
				}
				
				
				$user_id =  $this->session->userdata('userid');			
				$select_filed = "*";
				$tbl_name ='tbl_users';	
				//$where_condition=array('user_id'=>$user_id,'user_type'=>$user_type);
				$order_by_field='user_id';
				$order_by_type='desc';
						
				$data['user_info'] =$this->user_model->select_query($select_filed, $tbl_name, $where_condition,$order_by_field, $order_by_type);
				$data['countries'] =$this->user_model->select_query('*','tbl_countries',array('code != '=>''),'name','asc');
				$data['classify'] =$this->user_model->select_query('*','tbl_article_classified',array('asubmi_status'=>'1'),'asubmi_id','desc');
				
				if(!empty($data['user_info']))
				{
					
					$data['user_id']=$this->session->userdata('userid');	
					$data['user_type']=$this->session->userdata('user_type');	
					
					$this->load->view( 'header' );
					$this->load->view( 'author/user_profile',$data);
					$this->load->view( 'footer');
				}
				else
				{
					 redirect('user-dashboard');
				}
			}
			elseif(($user_type=='2') && ($this->uri->segment(1)=='update-editor-profile'))
			{
				$user_id =  $this->session->userdata('userid');			
				$select_filed = "*";
				$tbl_name ='tbl_users';	
				$where_condition=array('user_id'=>$user_id,'user_type'=>$user_type);
				$order_by_field='user_id';
				$order_by_type='desc';
						
				$data['user_info'] =$this->user_model->select_query($select_filed, $tbl_name, $where_condition,$order_by_field, $order_by_type);
				$data['countries'] =$this->user_model->select_query('*','tbl_countries',array('code != '=>''),'name','asc');
				$data['classify'] =$this->user_model->select_query('*','tbl_article_classified',array('asubmi_status'=>'1'),'asubmi_id','desc');
				
				if(!empty($data['user_info']))
				{
				
					$data['user_id']=$this->session->userdata('userid');	
					$data['user_type']=$this->session->userdata('user_type');	
					
					$this->load->view( 'header' );
					$this->load->view( 'editor/user_profile',$data);
					$this->load->view( 'footer');
				}
				else
				{
					 redirect('user-dashboard');
				}
			}
			elseif(($user_type=='3') && ($this->uri->segment(1)=='update-reviewer-profile'))
			{
				$user_id =  $this->session->userdata('userid');			
				
				if(($this->session->userdata('user_rool'))&&(($this->session->userdata('user_rool'))=='reviewer'))
				{
					
					//$where_condition=array('user_id'=>$user_id,'user_type'=>'1','user_reviewer'=>'1');
					$where_condition=array('user_id'=>$user_id);
				}
				else
				{
					
					$where_condition=array('user_id'=>$user_id,'user_type'=>$user_type);
				}
				
				
				$select_filed = "*";
				$tbl_name ='tbl_users';	
				
			//	$where_condition=array('user_id'=>$user_id,'user_type'=>$user_type);
				
				$order_by_field='user_id';
				$order_by_type='desc';
						
				$data['user_info'] =$this->user_model->select_query($select_filed, $tbl_name, $where_condition,$order_by_field, $order_by_type);
				
				//echo $this->db->last_query();exit;
				$data['countries'] =$this->user_model->select_query('*','tbl_countries',array('code != '=>''),'name','asc');
				$data['classify'] =$this->user_model->select_query('*','tbl_article_classified',array('asubmi_status'=>'1'),'asubmi_id','desc');
				
				
				
				//exit;
				if(!empty($data['user_info']))
				{
				
					$data['user_id']=$this->session->userdata('userid');	
					$data['user_type']=$this->session->userdata('user_type');	
					
					$this->load->view( 'header' );
					$this->load->view( 'reviewer/user_profile',$data);
					$this->load->view( 'footer');
				}
				else
				{
					 redirect('user-dashboard');
				}
			}
			elseif(($user_type=='4') && ($this->uri->segment(1)=='update-publisher-profile'))
			{
				$user_id =  $this->session->userdata('userid');			
				$select_filed = "*";
				$tbl_name ='tbl_users';	
				$where_condition=array('user_id'=>$user_id,'user_type'=>$user_type);
				$order_by_field='user_id';
				$order_by_type='desc';
						
				$data['user_info'] =$this->user_model->select_query($select_filed, $tbl_name, $where_condition,$order_by_field, $order_by_type);
				$data['countries'] =$this->user_model->select_query('*','tbl_countries',array('code != '=>''),'name','asc');
				$data['classify'] =$this->user_model->select_query('*','tbl_article_classified',array('asubmi_status'=>'1'),'asubmi_id','desc');
				
				if(!empty($data['user_info']))
				{
					$data['user_id']=$this->session->userdata('userid');	
					$data['user_type']=$this->session->userdata('user_type');	
					$this->load->view( 'header' );
					$this->load->view( 'publisher/user_profile',$data);
					$this->load->view( 'footer');
				}
				else
				{
					 redirect('user-dashboard');
				}
			}
			
	}
	
	public function editprofile_action()
	{	
		$user_type =$this->session->userdata('usertype');		
		$user_id =  $this->session->userdata('userid');
		
		$tbl_name ='tbl_users';	
		extract($this->input->post());
		
		
		$result_user=$this->user_model->get_row_with_con($tbl_name,array('user_id'=>$user_id));
		
		
		$user_reviewer_value =0;
					
					if(isset($_POST['user_reviewer']))
					{
						$user_reviewer_value =1;					
					}
					
		if(($result_user->user_type=='1') && ($this->session->userdata('usertype')!='3'))
		{
				$update_val['user_reviewer'] = $user_reviewer_value;
		}
					$update_val['user_fname'] = $user_fname;
					$update_val['user_lname'] = $user_lname;
					$update_val['user_instiute'] = $user_instiute;
					$update_val['user_address'] = $user_address;
					$update_val['user_country'] = $user_country;
					$update_val['user_classification'] = $user_classification;
					$update_val['user_updated'] =date("Y-m-d");
				
		/*$data  =  array("user_fname"=>$user_fname,
						"user_lname"=>$user_lname,
						"user_instiute"=>$user_instiute,
						"user_address"=>$user_address,
						"user_country"=>$user_country,		
						"user_classification"=>$user_classification,
						"user_reviewer"=>$user_reviewer_value,
						"user_updated"=>date("Y-m-d"));*/
						
						
						/*echo '<pre>';
						print_r($update_val);
						exit;*/

		   	$where = array ('user_id'=> $user_id);
			$return = $this->user_model->update_query($update_val, $tbl_name,$where);	
			 $this->session->set_flashdata("success","Proflie Updated Successfully.");
			 redirect('user-dashboard');
			 
		/* if($user_type=='1')
		{	
			redirect('user-dashboard');
		}
		elseif($user_type=='2')
		{
			redirect('user-dashboard');	
		}
		elseif($user_type=='3')
		{
			redirect('user-dashboard');
		}
		elseif($user_type=='4')
		{
			redirect('user-dashboard');
		}*/
		
			
		
	}
	
	public function view_submission_pdf()
	{
	
		$html='shweta';
		   $data = pdf_create($html, '', true);
    		 write_file('name', $data);
		
	}
	
	
	public function change_rool()
	{
		
		
		$user_type =$this->session->userdata('usertype');		
		$user_id =  $this->session->userdata('userid');
		
		if($_POST['rool_type']=='reviewer')
		{
			$check_where =  array('user_id'=>$user_id,'user_type'=>'1','user_reviewer'=>'1');
				
			$check_ussertype_details = $this->user_model->select_checkunique( '*','tbl_users', $check_where);	
			$data['user_details'] = 	 $check_ussertype_details;
			
			$this->session->set_userdata( 'user_details',$data['user_details']);
			$this->session->set_userdata( 'userid',$data['user_details'][0]->user_id);
			$this->session->set_userdata( 'username',$data['user_details'][0]->user_fname);
			$this->session->set_userdata( 'usertype','3');			
			$this->session->set_userdata( 'user_rool','reviewer');
		}
		if($_POST['rool_type']=='author')
		{
			$check_where =  array('user_id'=>$user_id,'user_type'=>'1','user_reviewer'=>'1');
				
			$check_ussertype_details = $this->user_model->select_checkunique( '*','tbl_users', $check_where);	
			$data['user_details'] = 	 $check_ussertype_details;
			
			$this->session->set_userdata( 'user_details',$data['user_details']);
			$this->session->set_userdata( 'userid',$data['user_details'][0]->user_id);
			$this->session->set_userdata( 'username',$data['user_details'][0]->user_fname);
			$this->session->set_userdata( 'usertype',$data['user_details'][0]->user_type);
			$this->session->set_userdata( 'user_rool','author');
		}
		
		echo $_POST['rool_type'];
		
						
	}
}
?>