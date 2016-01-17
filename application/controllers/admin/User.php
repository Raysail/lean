<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class  User extends CI_Controller {

	public function __construct(){
	
		parent:: __construct();
		/* Load the libraries and helpers */ 
		$this->load->model('admin/user_model');
		$this->load->library('upload');
		$this->load->library('pagination');
		date_default_timezone_set('Asia/Kolkata');
		$this->load->helper('login');
		$this->load->library('encrypt');
		$this->load->helper('general');	
		login_check();
		user_func_check();
	}
	
	/*   USER REGISTRATION */
		
	public function  auhtor_list()
	{
		$data['user_type']= 'Author';
		$data['add_link']='author';		
		$data['user_type_id']= '1';
		
		
		
		$select_filed = "u.*";
		$tbl_name ='tbl_users as u';	
		$where_condition=array('u.user_type'=>'1');
		$order_by_field='u.user_id';
		$order_by_type='desc';
		$limit='';$offset='';$all_record='';
		$join_tbl1='';
		$join_condition1='';
			
		$data['classified'] =$this->user_model->select_query('*','tbl_article_classified',array('asubmi_status'=>'1'),'asubmi_id','desc');
		$data['list'] =$this->user_model->select_query_with_join_left_group_by_home($select_filed, $tbl_name, $where_condition,$limit, $offset, $all_record, $order_by_field, $order_by_type,'',$join_tbl1,$join_condition1);
			$this->load->view( 'admin/header' );
			$this->load->view( 'admin/user_list',$data);
			$this->load->view( 'admin/footer');
	}	
		
	public function  editor_list()
	{
		$data['user_type']= 'Editor';
		$data['add_link']='editor';
		$data['user_type_id']= '2';
		
		$select_filed = "u.*";
		$tbl_name ='tbl_users as u';	
		$where_condition=array('u.user_type'=>'2');
		$order_by_field='u.user_id';
		$order_by_type='desc';
		$limit='';$offset='';$all_record='';
		$join_tbl1='';
		$join_condition1='';
		
		
			
		$data['classified'] =$this->user_model->select_query('*','tbl_article_classified',array('asubmi_status'=>'1'),'asubmi_id','desc');		
		$data['list'] =$this->user_model->select_query_with_join_left_group_by_home($select_filed, $tbl_name, $where_condition,$limit, $offset, $all_record, $order_by_field, $order_by_type,'',$join_tbl1,$join_condition1);
			$this->load->view( 'admin/header' );
			$this->load->view( 'admin/user_list',$data);
			$this->load->view( 'admin/footer');
	}	
		
	public function reviewer_list()
	{
		$data['user_type']= 'Reviewer';
		$data['add_link']='reviewer';
		$data['user_type_id']= '3';
		
		$select_filed = "u.*";
		$tbl_name ='tbl_users as u';	
		$where_condition=array('u.user_type'=>'3');
		$order_by_field='u.user_id';
		$order_by_type='desc';
		$limit='';$offset='';$all_record='';
		$join_tbl1='';
		$join_condition1='';
		
		
			
		$data['classified'] =$this->user_model->select_query('*','tbl_article_classified',array('asubmi_status'=>'1'),'asubmi_id','desc');
				
		$data['list'] =$this->user_model->select_query_with_join_left_group_by_home($select_filed, $tbl_name, $where_condition,$limit, $offset, $all_record, $order_by_field, $order_by_type,'',$join_tbl1,$join_condition1);
			$this->load->view( 'admin/header' );
			$this->load->view( 'admin/user_list',$data);
			$this->load->view( 'admin/footer');
	}	
		
	public function publisher_list()
	{
	
		$data['user_type']= 'Publisher';
		$data['add_link']='publisher';
		$data['user_type_id']= '4';
		
		$select_filed = "u.*";
		$tbl_name ='tbl_users as u';	
		$where_condition=array('u.user_type'=>'4');			
		$order_by_field='u.user_id';
		$order_by_type='desc';
		$limit='';$offset='';$all_record='';
		$join_tbl1='';
		$join_condition1='';
			
			
			
		$data['classified'] =$this->user_model->select_query('*','tbl_article_classified',array('asubmi_status'=>'1'),'asubmi_id','desc');
			
		$data['list'] =$this->user_model->select_query_with_join_left_group_by_home($select_filed, $tbl_name, $where_condition,$limit, $offset, $all_record, $order_by_field, $order_by_type,'',$join_tbl1,$join_condition1);
			$this->load->view( 'admin/header' );
			$this->load->view( 'admin/user_list',$data);
			$this->load->view( 'admin/footer');
	}	
		
	
	public function user_form()
	{
	
		$user_type ='';
		
		if($this->uri->segment(2)=='author-form')	
		{
			$data['user_type']=1;
			$data['user_type_name']= 'Author';
			$data['add_link']='author';
		}
		elseif($this->uri->segment(2)=='editor-form')	
		{
			$data['user_type']=2;				
			$data['user_type_name']= 'Editor';
			$data['add_link']='editor';
		}
		elseif($this->uri->segment(2)=='reviewer-form')	
		{
			$data['user_type']=3;
			$data['user_type_name']= 'Reviewer';
			$data['add_link']='reviewer';
		}
		elseif($this->uri->segment(2)=='publisher-form')	
		{
			$data['user_type']=4;			
			$data['user_type_name']= 'Publisher';
			$data['add_link']='publisher';
		}
		
	
	$data['countries'] =$this->user_model->select_query('*','tbl_countries',array('code != '=>''),'name','asc');
	$data['classified'] =$this->user_model->select_query('*','tbl_article_classified',array('asubmi_status'=>'1'),'asubmi_id','desc');
	
			
			if($this->uri->segment(3))
			{
				$user_id=$this->uri->segment(3);
				
				$select_filed = "*";
				$tbl_name ='tbl_users';	
				$where_condition=array('user_id'=>$user_id);
				$order_by_field='';
				$order_by_type='';
										
				$data['user_data'] =$this->user_model->select_query($select_filed, $tbl_name, $where_condition,$order_by_field, $order_by_type);
				$data['user_id'] = $user_id; 
				$data['but_value'] = 'Update'; 
			
							
			}
			else
			{
				$data['user_id'] = '0'; 
				$data['but_value'] = 'Add'; 
			}
			
			
			
	
			$this->load->view( 'admin/header' );
			$this->load->view( 'admin/user_form',$data);
			$this->load->view( 'admin/footer');
		
	}
	
	public function user_action()
	{
		
		
			$post=$this->input->post();
			$tbl_name  = "tbl_users";
			if(!empty($post))
			{
				extract($post);
				
					if(($user_id=='0') && ($cat_button=='Add'))
					{		$tbl_name_ty_email='tbl_users.user_email';
							$this->form_validation->set_rules('user_email', "Email", 'trim|required|valid_email|is_unique['.$tbl_name_ty_email.']');	
							
							if ($this->form_validation->run() == FALSE){
				
								$this->session->set_flashdata("error","Duplicate email id!");
								redirect('administrator/user-form');
							}
							else
							{
								  $inset_data  =  array("user_type"=>$user_type,
														"user_fname"=>$user_fname,
														"user_lname"=>$user_lname,
														"user_email"=>$user_email,
														"user_instiute"=>$user_instiute,
														"user_address"=>$user_address,
														"user_password"=>md5($user_password),
														"user_country"=>$user_country,
														"user_classification"=> implode(',',$_POST['user_classification']),
														"user_status"=>$user_status,
														"user_dateadd"=>date("Y-m-d"));
									$query =$this->user_model->insert_data($tbl_name,$inset_data);
									$this->session->set_flashdata("sucess","Successfully inserted.");
									
									
									
									
									
									
							$copy = $this->user_model->get_row_with_con('tbl_admin',array('id'=>1));
							 $to = $user_email;
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
							 <p style='font-size: 15px; font-family:Tahoma, Geneva, sans-serif; color: #646161'>Thank you for joining  us . <br><br>Please login in our website with the following detail:<br>User Name:".$user_email." <br>Password: ".$user_password."
							
							</p>
							 </div>
  <div  style='width:100%;float:left; background:#ee4723; padding:0%; color:#fff; text-align:center;'>
    <p>".$copy->footer_copy."</p>
  </div>
</div>
							</body>
							</html>";
							
							/*echo $message;
							exit;*/
							$result = chatroomemail($to,MAILFROM,MAILFROMNAME,$subject,$message);
							
							
									
									
									
									
									
									
									
									
									if($user_type=='1')	
									{
										redirect('administrator/author-list');
									}
									elseif($user_type=='2')	
									{
										redirect('administrator/editor-list');
									}
									elseif($user_type=='3')	
									{
										redirect('administrator/reviewer-list');
									}
									elseif($user_type=='4')	
									{
										redirect('administrator/publisher-list');
									}
						}
					}
					if(($user_id>0) && ($cat_button=='Update'))
					{
						$where =  array("user_id"=>$user_id);
						
						$update_data  =  array("user_type"=>$user_type,
												"user_fname"=>$user_fname,
												"user_lname"=>$user_lname,
												"user_instiute"=>$user_instiute,
												"user_address"=>$user_address,
												"user_country"=>$user_country,
												"user_classification"=> implode(',',$_POST['user_classification']),
												"user_status"=>$user_status,
												"user_updated"=>date("Y-m-d"));
															
															
						$query = $this->user_model->update_data($tbl_name,$update_data,$where);
						$this->session->set_flashdata("sucess","Successfully Updated.");
						
									if($user_type=='1')	
									{
										redirect('administrator/author-list');
									}
									elseif($user_type=='2')	
									{
										redirect('administrator/editor-list');
									}
									elseif($user_type=='3')	
									{
										redirect('administrator/reviewer-list');
									}
									elseif($user_type=='4')	
									{
										redirect('administrator/publisher-list');
									}
					}					
			}
	}
	
	public function user_delete()
	{		
	
		$user_id=$this->uri->segment(4);
		$this->user_model->delete_query("tbl_users",array("user_id"=>$user_id));
		$this->session->set_flashdata("sucess","Successfully Deleted.");
		$user_type = $this->uri->segment(5);
		
			if($user_type=='1')	
			{
				redirect('administrator/author-list');
			}
			elseif($user_type=='2')	
			{
				redirect('administrator/editor-list');
			}
			elseif($user_type=='3')	
			{
				redirect('administrator/reviewer-list');
			}
			elseif($user_type=='4')	
			{
				redirect('administrator/publisher-list');
			}
			
			
		//redirect('administrator/user-list');
		/*print_r($_REQUEST);
		exit;*/
	}
	public function user_status()
	{
		$user_id=$this->uri->segment(4);
		$user_status=$this->uri->segment(5);
		$new_status = '';
		if($user_status=='1'){$new_status = '0';}
		if($user_status=='0'){$new_status = '1';}
		
		$where =  array("user_id"=>$user_id);						
						$update_data  =  array("user_status"=>$new_status);
		
		$query = $this->user_model->update_data("tbl_users",$update_data,$where);
						$this->session->set_flashdata("sucess","Successfully Updated.");
			//			redirect('administrator/user-list');
			$user_type = $this->uri->segment(6);
			if($user_type=='1')	
			{
				redirect('administrator/author-list');
			}
			elseif($user_type=='2')	
			{
				redirect('administrator/editor-list');
			}
			elseif($user_type=='3')	
			{
				redirect('administrator/reviewer-list');
			}
			elseif($user_type=='4')	
			{
				redirect('administrator/publisher-list');
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
	
}
?>