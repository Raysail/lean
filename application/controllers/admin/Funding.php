<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class funding extends CI_Controller { 

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

		$this->load->model('admin/user_model');

		$this->load->library('upload');
		$this->load->library('pagination');
		date_default_timezone_set('Asia/Kolkata');
		$this->load->helper('login');
		$this->load->helper('general');	
		$this->load->library('encrypt');

		login_check();
		user_func_check();
		

	 }

	 


	function create_dir( $dir_name ){

		$filename = $dir_name . "/";
		if (!file_exists($filename)) {
		mkdir( $dir_name,0755,TRUE );
		}
	}

	
	public function seoUrl($string) {
	$new_string='';		
        //Lower case everything
        $string1 = strtolower($string);
        //Make alphanumeric (removes all other characters)
        $string1 = preg_replace("/[^a-z0-9_\s-]/", "", $string1);
        //Clean up multiple dashes or whitespaces
        $string1 = preg_replace("/[\s-]+/", " ", $string1);
        //Convert whitespaces and underscore to dash
        $string1 = preg_replace("/[\s_]/", "-", $string1);		
		
        if( !empty($string1) || $string1 != '' ){		
            $new_string =  $string1;
        }else{
            $new_string =  $string;
        }
		
		$this->db->select("*");
		$this->db->from("tbl_pages");
		$this->db->where("page_url",$new_string);
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			$count = $query->num_rows()+1;
			return $new_string.$count;
		}
		else
		{
			return  $new_string;
		}
		
		
       
    }
	
	
	function fund_list()
	{
		$data ='';
		
		
		$select_filed = "*";
		$tbl_name ='tbl_fund';	
		$where_condition=array('fund_status'=>'1');
		$order_by_field='fund_id';
		$order_by_type='desc';
		$limit='';$offset='';$all_record='';
				
		$data['fund_list'] =$this->user_model->select_query_with_join_order_by($select_filed, $tbl_name, $where_condition,$limit, $offset, $all_record, $order_by_field, $order_by_type);
		
		
		$where_condition_eval=array('fund_status'=>'2');
				
		$data['fund_eval'] =$this->user_model->select_query_with_join_order_by($select_filed, $tbl_name, $where_condition_eval,$limit, $offset, $all_record, $order_by_field, $order_by_type);
			
		$where_condition_award=array('fund_status'=>'3');
				
		$data['fund_award'] =$this->user_model->select_query_with_join_order_by($select_filed, $tbl_name, $where_condition_award,$limit, $offset, $all_record, $order_by_field, $order_by_type);
		
		$where_condition_close=array('fund_status'=>'4');
				
		$data['fund_close'] =$this->user_model->select_query_with_join_order_by($select_filed, $tbl_name, $where_condition_close,$limit, $offset, $all_record, $order_by_field, $order_by_type);
		
			$this->load->view( 'admin/header' );
			$this->load->view( 'admin/fund_list',$data);
			$this->load->view( 'admin/footer');
		
	}
	
	
	function fund_form()
	{
		
	
		if($this->uri->segment(3))
		{
			$fund_id=$this->uri->segment(3);
			
			$select_filed = "*";
			$tbl_name ='tbl_fund';	
			$where_condition=array('fund_id'=>$fund_id);
			$order_by_field='';
			$order_by_type='';
					
			$data['list'] =$this->user_model->select_query($select_filed, $tbl_name, $where_condition,$order_by_field, $order_by_type);
		
			$data['fund_id'] = $fund_id; 
			$data['but_value'] = 'Update'; 
						
		}
		else
		{
			$data['fund_id'] = '0'; 
			$data['but_value'] = 'Add'; 
		}
			$this->load->view( 'admin/header' );
			$this->load->view( 'admin/fund_form',$data);
			$this->load->view( 'admin/footer');
		
	}
	
	
	
	
	public function funding_action()
	{
		/*echo '<pre>';
		print_r($_POST);
		print_r($_FILES);exit;*/
		
		
		$tbl_name = "tbl_fund";
		extract($this->input->post());
		$member_image='';
		
		if(!empty($fund_old_image))
		{
			$member_image=$fund_old_image;
		}
		
		
		if ((isset($_FILES['fund_coverpic'])) && (!empty($_FILES['fund_coverpic']['name'])))
		{			
			 $dir_name = 'upload/fund';
			 
			  /* SCHENE DOC*/
			  
			 if(!empty($_FILES['fund_coverpic']['name']) && ($_FILES['fund_coverpic']['error']==0))
			 {
				 $this->create_dir( $dir_name );
				$file_name = time()."-".str_replace(" ","_",$_FILES['fund_coverpic']['name']);
				
				$config['upload_path'] = $dir_name;
				$config['allowed_types'] = 'png|jpeg|jpg|gif';
				$config['file_name'] = $file_name;

				$this->upload->initialize($config);
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('fund_coverpic'))
				{
					$data = $this->upload->data();
					$member_image = $data['file_name'];
				}
			 }
		}
		
		
		
		
		
			if(($fund_id=='0') && ($cat_button=='Add'))
			{
				$inset_data = array("fund_title"=>$fund_title,
									"fund_company"=>$fund_company,
									"fund_reward"=>$fund_reward,
									"fund_posted"=>$fund_posted, 
									"fund_decline"=>$fund_decline,
									"fund_customID"=>$fund_customID,
									"fund_country"=>$fund_country,
									"fund_info"=>$fund_info,
									"fund_status"=>'1',
									"fund_coverpic"=>$member_image,
									"fund_dateadd"=>date("Y-m-d"));
				$query =$this->user_model->insert_data($tbl_name,$inset_data);
				$this->session->set_flashdata("sucess","Successfully inserted.");
				redirect('administrator/fund-list');
			}
			if(($fund_id>0) && ($cat_button=='Update'))
			{
				$where =  array("fund_id"=>$fund_id);
				 $update_data  =  array("fund_title"=>$fund_title,
										"fund_company"=>$fund_company,
										"fund_reward"=>$fund_reward,
										"fund_posted"=>$fund_posted, 
										"fund_decline"=>$fund_decline,
										"fund_customID"=>$fund_customID,
										"fund_country"=>$fund_country,
										"fund_info"=>$fund_info,
										"fund_status"=>'1',
										"fund_coverpic"=>$member_image,
										"fund_update"=>date("Y-m-d"));
														
				$query = $this->user_model->update_data($tbl_name,$update_data,$where);
				$this->session->set_flashdata("sucess","Successfully Updated.");
				redirect('administrator/fund-list');
			}	
	}
	

	
	public function bord_status()
	{
		
		$bord_id=$this->uri->segment(4);
		$bord_status=$this->uri->segment(5);
		$new_status = '';
		if($bord_status=='1'){$new_status = '0';}
		if($bord_status=='0'){$new_status = '1';}
		
		$where =  array("bord_id"=>$bord_id);						
						$update_data  =  array("bord_status"=>$new_status);
		
		$query = $this->user_model->update_data("tbl_board",$update_data,$where);
						$this->session->set_flashdata("sucess","Successfully Updated.");
		
			redirect('administrator/board-list');
					
	}
	
	public function bord_delete()
	{		
	
		$bord_id=$this->uri->segment(4);
			
		$this->user_model->delete_query("tbl_board",array("bord_id"=>$bord_id));
		$this->session->set_flashdata("sucess","Successfully Deleted.");
		
			redirect('administrator/board-list');
	}
	
	
	public function applicant_message()
	{
		//print_r($_POST);
		
		if(isset($_POST) && (!empty($_POST['fund_id'])))
		{
		
		
			$fund_id=$_POST['fund_id'];
			$data['fund_new_status']=$fund_new_status=$_POST['choos_option'];
			
			$data['fund_title'] = '';
			if($fund_new_status=='2'){$data['fund_title'] = 'Assign Funding to Evaluation';}
			if($fund_new_status=='3'){$data['fund_title'] = 'Assign Funding to Awarded';}
			if($fund_new_status=='4'){$data['fund_title'] = 'Close';}
			
			
			$select_filed = "*";
			$tbl_name ='tbl_fund';	
			$where_condition=array('fund_id'=>$fund_id);
			$order_by_field='';
			$order_by_type='';
					
			$data['fdata'] =$this->user_model->select_query($select_filed, $tbl_name, $where_condition,$order_by_field, $order_by_type);
		
			$data['fund_id'] = $fund_id; 
			$data['but_value'] = 'Update'; 
			
			$this->load->view( 'admin/header' );
			$this->load->view( 'admin/applicant_message',$data);
			$this->load->view( 'admin/footer');
		
						
		}
		else
		{
			redirect('administrator/fund-list');
			
		}
		
	}
	
	public function applicant_action()
	{		
		
		$tbl_name = "tbl_fund";
		extract($this->input->post());
		$fund_evalmsg ='';
		$fund_awardmsg ='';
		$fund_closmsg ='';
		
		$subject_fund = '';
		$message_body = '';
		
		if($fund_new_status=='2')
		{
			$fund_evalmsg =$applicant_message;
			$subject_fund = 'assign Funding to Evaluation';
		}
		
		if($fund_new_status=='3')
		{
			$fund_awardmsg =$applicant_message;
			$subject_fund = 'assign Funding to Awarded';
		}
		
		if($fund_new_status=='4')
		{
			$fund_closmsg =$applicant_message;
			$subject_fund =  'fund Close';
		}
		
		$where =  array("fund_id"=>$fund_id);
		$update_data  =  array( 
								"fund_closmsg"=>$fund_closmsg,
								"fund_awardmsg"=>$fund_awardmsg,
								"fund_evalmsg"=>$fund_evalmsg,
								"fund_status"=>$fund_new_status,
								"fund_update"=>date("Y-m-d")
								);
												
		$query = $this->user_model->update_data($tbl_name,$update_data,$where);
		
		
		$fund_detail =$this->user_model->select_query('*','tbl_fund',array("fund_id"=>$fund_id));
			
		$fund_applicant = $this->user_model->select_query('*','tbl_fund_applicant',array('app_fund_id'=>$fund_id));
		
		if(!empty($fund_applicant))
		{
			foreach($fund_applicant as $app_list)
			{
			
					$art_detail = $this->user_model->get_row_with_con('tbl_article',array('art_id'=>$art_id));
							
							$copy = $this->user_model->get_row_with_con('tbl_admin',array('id'=>1));
							$to = $app_list->app_email;
							$subject =$fund_detail[0]->fund_title.'&nbsp'.$subject_fund;
							$message = "							
							<html>
							<head>
							<title>".$subject."</title>
							</head>
							<body>
							<div  style='width:700px; float:left;'>
  <div  style='width: 98%;float: left;background: #F7F7F7;padding: 1%;border-radius: 4px;border-top: 3px solid #ee4723;'>
  <div > <img src='".base_url()."design/front/images/logo.png'/> </div> 
								<p style='font-size: 17px; font-family:Tahoma, Geneva, sans-serif;'>Dear ".$app_list->app_name.", </p>
							 <p style='font-size: 15px; font-family:Tahoma, Geneva, sans-serif; color: #646161'>
							 	".nl2br($applicant_message)."
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
		}
		
		
		
		
		
		$this->session->set_flashdata("sucess","Successfully Updated.");
		redirect('administrator/fund-list');
	}
	
	
	function applicant_awarded()
	{
		
		
		if(isset($_POST) && (!empty($_POST['fund_id'])))
		{
		
		
			$fund_id=$_POST['fund_id'];
			$data['fund_new_status']=$fund_new_status=$_POST['choos_option'];
			
			$data['fund_title'] = '';
			if($fund_new_status=='2'){$data['fund_title'] = 'Assign Funding to Evaluation';}
			if($fund_new_status=='3'){$data['fund_title'] = 'Assign Funding to Awarded';}
			if($fund_new_status=='4'){$data['fund_title'] = 'Close';}
			
			
			$select_filed = "*";
			$tbl_name ='tbl_fund';	
			$where_condition=array('fund_id'=>$fund_id);
			$order_by_field='';
			$order_by_type='';
					
			$data['fdata'] =$this->user_model->select_query($select_filed, $tbl_name, $where_condition,$order_by_field, $order_by_type);
			
			$data['applicant_data'] =$this->user_model->select_query('*','tbl_fund_applicant',array('app_fund_id'=>$fund_id),$order_by_field, $order_by_type);
			
		
			$data['fund_id'] = $fund_id; 
			$data['but_value'] = 'Update'; 
			
			$this->load->view( 'admin/header' );
			$this->load->view( 'admin/applicant_award',$data);
			$this->load->view( 'admin/footer');
		
						
		}
		else
		{
			redirect('administrator/fund-list');
			
		}
	}
	
	
	public function award_action()
	{		
		/*echo '<pre>';
		print_r($_POST);
		exit;
*/		
		$tbl_name = "tbl_fund";
		extract($this->input->post());
		$fund_evalmsg ='';
		$fund_awardmsg ='';
		$fund_closmsg ='';
		
		$subject_fund = '';
			$fund_awardmsg =$applicant_message;
			$subject_fund = 'assign Funding to Awarded';
			
			$awarded_name = '';
			$awarded_body_name = '';
			
			if(isset($applicant_awarded))
			{
				$awarded_name = implode(',',$applicant_awarded);
				
				$where_app = "app_fund_id='".$fund_id."' AND find_in_set( app_id,'".$awarded_name."' )";
				
				$fund_applicant = $this->user_model->select_query('group_concat(app_name )as app_name','tbl_fund_applicant',$where_app );
				
				$awarded_body_name = $fund_applicant[0]->app_name;
				
				
			}
		
		
		$where =  array("fund_id"=>$fund_id);
		$update_data  =  array( 
								
								"fund_awardmsg"=>$fund_awardmsg,
								"fund_awardname"=>$awarded_name,
								"fund_status"=>$fund_new_status,
								"fund_award_data"=>date("Y-m-d"),
								"fund_update"=>date("Y-m-d")
								);
												
		$query = $this->user_model->update_data($tbl_name,$update_data,$where);
		
		
		$fund_detail =$this->user_model->select_query('*','tbl_fund',array("fund_id"=>$fund_id));
			
		$fund_applicant = $this->user_model->select_query('*','tbl_fund_applicant',array('app_fund_id'=>$fund_id));
		
		if(!empty($fund_applicant))
		{
			foreach($fund_applicant as $app_list)
			{
			
					$art_detail = $this->user_model->get_row_with_con('tbl_article',array('art_id'=>$art_id));
							
							$copy = $this->user_model->get_row_with_con('tbl_admin',array('id'=>1));
							$to = $app_list->app_email;
							$subject =$fund_detail[0]->fund_title.'&nbsp'.$subject_fund;
							$message = "							
							<html>
							<head>
							<title>".$subject."</title>
							</head>
							<body>
							<div  style='width:700px; float:left;'>
  <div  style='width: 98%;float: left;background: #F7F7F7;padding: 1%;border-radius: 4px;border-top: 3px solid #ee4723;'>
  <div > <img src='".base_url()."design/front/images/logo.png'/> </div> 
								<p style='font-size: 17px; font-family:Tahoma, Geneva, sans-serif;'>Dear ".$app_list->app_name.", </p>
							 <p style='font-size: 15px; font-family:Tahoma, Geneva, sans-serif; color: #646161'>
							 	".nl2br($applicant_message)."
							<br><br>	
							<b>Persons Awarded </b>
							<br>".nl2br($awarded_body_name)."
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
		}
		
		
		
		
		
		$this->session->set_flashdata("sucess","Successfully Updated.");
		redirect('administrator/fund-list');
	}
	function funding_detail()
	{
		if($this->uri->segment(3))
		{
			$fund_id=$this->uri->segment(3);
			
			$select_filed = "*";
			$tbl_name ='tbl_fund';	
			$where_condition=array('fund_id'=>$fund_id);
			$order_by_field='';
			$order_by_type='';
					
			$data['fdata'] =$this->user_model->select_query($select_filed, $tbl_name, $where_condition,$order_by_field, $order_by_type);
			
			$data['news_feed'] = $this->user_model->select_query('*','tbl_fund_applicant',array('app_fund_id'=>$fund_id),'app_id','asc'); 
		
			$data['fund_id'] = $fund_id; 
			$this->load->view( 'admin/header' );
			$this->load->view( 'admin/fund_detail',$data);
			$this->load->view( 'admin/footer');
						
		}
		else
		{	
			
				redirect('administrator/fund-list');
		}
			
	}
	
	function applicant_msg()
	{
		if($this->uri->segment(3))
		{
			$app_id=$this->uri->segment(3);
			
			
			$data['app_list'] = $this->user_model->select_query('*','tbl_fund_applicant',array('app_id'=>$app_id),'app_id','asc'); 
			$fund_id = $data['app_list'][0]->app_fund_id;
			
			$select_filed = "*";
			$tbl_name ='tbl_fund';	
			$where_condition=array('fund_id'=>$fund_id);
			$order_by_field='';
			$order_by_type='';
					
			$data['fdata'] =$this->user_model->select_query($select_filed, $tbl_name, $where_condition,$order_by_field, $order_by_type);
			
			
			$data['news_feed'] =$this->user_model->select_query('*','tbl_fund_msg',array('msg_fundid'=>$fund_id,'msg_appid'=>$app_id),$order_by_field, $order_by_type);
			
		
			$data['fund_id'] = $fund_id; 
			$data['app_id'] = $app_id; 
			
			
			if(!empty($data['app_list'])){
			$this->load->view( 'admin/header' );
			$this->load->view( 'admin/applicant_detail',$data);
			$this->load->view( 'admin/footer');
			}
			else
			{
				$redirect = base_url().'administrator/funding-detail/'.$fund_id;
				redirect($redirect );
			}
						
		}
		else
		{	
			redirect('administrator/fund-list');
		}
			
	}
	function submit_msg()
	{
		
		
		extract($this->input->post());
				$inset_data = array("msg_fundid"=>$app_fundid,
									"msg_appid"=>$app_id,
									"msg_content"=>$msg_app,
									"msg_date"=>date("Y-m-d"));
				$query =$this->user_model->insert_data('tbl_fund_msg',$inset_data);
				
				
				$fund_applicant = $this->user_model->select_query('*','tbl_fund_applicant',array('app_fund_id'=>$app_fundid,'app_id'=>$app_id));
				
				
				
				$copy = $this->user_model->get_row_with_con('tbl_admin',array('id'=>1));
				
							$to = $fund_applicant[0]->app_email;
							$subject ='Message by administrator ';
							$message = "							
							<html>
							<head>
							<title>".$subject."</title>
							</head>
							<body>
							<div  style='width:700px; float:left;'>
  <div  style='width: 98%;float: left;background: #F7F7F7;padding: 1%;border-radius: 4px;border-top: 3px solid #ee4723;'>
  <div > <img src='".base_url()."design/front/images/logo.png'/> </div> 
								<p style='font-size: 17px; font-family:Tahoma, Geneva, sans-serif;'>Dear ".$fund_applicant[0]->app_name.", </p>
							 <p style='font-size: 15px; font-family:Tahoma, Geneva, sans-serif; color: #646161'>
							 	".nl2br($msg_app)."
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
							
				
				$this->session->set_flashdata("sucess","Successfully send message.");
				$redirect = base_url().'administrator/funding-detail/'.$app_fundid;
				redirect($redirect );
				
				
	}
		
	
}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */
