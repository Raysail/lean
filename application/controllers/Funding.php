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

	 
	function create_dir( $dir_name ){

		$filename = $dir_name . "/";
		if (!file_exists($filename)) {
		mkdir( $dir_name,0755,TRUE );
		}
	}
	
	 

	 public function __construct(){

	 

	 	parent:: __construct();

		/* Load the libraries and helpers */

		$this->load->model('user_model');

		$this->load->library('upload');
		$this->load->library('pagination');
		date_default_timezone_set('Asia/Kolkata');
		$this->load->helper('login');
		$this->load->helper('general');	
		$this->load->library('encrypt');


	 }

	
	
	function fund_list()
	{
		$data ='';
		
		$where = "fund_status<3";
		$select_filed = "*";
		$tbl_name ='tbl_fund';	
		$where_condition=$where;
		$order_by_field='fund_id';
		$order_by_type='desc';
		$limit='';$offset='';$all_record='';
				
		$data['fund_list'] =$this->user_model->select_query_with_join_order_by($select_filed, $tbl_name, $where_condition,$limit, $offset, $all_record, $order_by_field, $order_by_type);
		
		
		$this->load->view('header');
		$this->load->view('fund_list',$data);
		$this->load->view('footer');
		
	}
		
	function fund_detail()
	{
		
				
		if($this->uri->segment(2))
		{		
			$this->uri->segment(2);
			$fund_id = bindec($this->uri->segment(2));		
		
			
			$select_filed = '*';	
			$tbl_name= 'tbl_fund as f';	
			$where_condition = array('f.fund_id'=>$fund_id);
			$order_by_field = 'f.fund_id';
			$order_by_type ='desc';
			$group_by_field = 'f.fund_id';
			$join_tbl1="";
		    $join_condition1="";
			$join_tbl2="";
		    $join_condition2="";
		
			$data['art_data'] =$this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field,$join_tbl1,'',$join_condition1,$join_tbl2,$join_condition2,'');
			
			
			
			$data['total_applicant'] = $this->user_model->check_no_rec('tbl_fund_applicant',array('app_fund_id'=>$fund_id));
			
			$data['open_found'] =$this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, array('f.fund_status'=>'1'), '', '', 'Y', $order_by_field,$order_by_type,$group_by_field,$join_tbl1,'',$join_condition1,$join_tbl2,$join_condition2,'');
			
			
		
			if(!empty($data['art_data']))
			{
				$this->load->view('header');
				$this->load->view('funding_detail',$data);
				$this->load->view('footer');
			}
			else
			{
				$redirect = base_url().'funding-list';
				 redirect($redirect);
			}
		}
		else
		{
				$redirect = base_url().'funding-list';
				 redirect($redirect);			
		}
	}
	
	public function fund_application()
	{
		/*echo '<pre>';
		print_r($_POST);
		exit;*/
		if(isset($_POST['submit_proposal']) && (isset($_POST['fund_id'])) && (!empty($_POST['fund_id'])))
		{		
			$fund_id = $_POST['fund_id'];		
		
			
			$select_filed = '*';	
			$tbl_name= 'tbl_fund as f';	
			$where_condition = array('f.fund_id'=>$fund_id);
			$order_by_field = 'f.fund_id';
			$order_by_type ='desc';
			$group_by_field = 'f.fund_id';
			$join_tbl1="";
		    $join_condition1="";
			$join_tbl2="";
		    $join_condition2="";
		
			$data['art_data'] =$this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field,$join_tbl1,'',$join_condition1,$join_tbl2,$join_condition2,'');
			
			
		
			if(!empty($data['art_data']))
			{
				$this->load->view('header');
				$this->load->view('funding_application',$data);
				$this->load->view('footer');
			}
			else
			{
				$redirect = base_url().'funding-list';
				 redirect($redirect);
			}
		}
		else
		{
				$redirect = base_url().'funding-list';
				 redirect($redirect);			
		}
	}
	public function fund_application_action()
	{		
		$propsal_file = '';
		if ((isset($_FILES['app_proposal'])) && (!empty($_FILES['app_proposal']['name'])))
		{
		
			$art_scheme='';
			
			 $dir_name = 'upload/proposal';
			 
			  /* SCHENE DOC*/
			  
			 if(!empty($_FILES['app_proposal']['name']) && ($_FILES['app_proposal']['error']==0))
			 {
			 		 	 $this->create_dir( $dir_name );
						$file_name = time()."-".str_replace(" ","_",$_FILES['app_proposal']['name']);
						
						$config['upload_path'] = $dir_name;
						$config['allowed_types'] = 'png|jpeg|jpg|gif|docx|doc|pdf';
						$config['file_name'] = $file_name;

						$this->upload->initialize($config);
						$this->load->library('upload', $config);
						if ($this->upload->do_upload('app_proposal'))
						{
							$data = $this->upload->data();
							$propsal_file = $data['file_name'];
						}
			 }
		} 
		
		
		
		extract($this->input->post());
		
			
		
		 $inset_data  = 	array("app_fund_id"=>$app_fund_id,
								  "app_name"=>$app_name,
								  "app_email"=>$app_email,
								  "app_address"=>$app_address,
								  "app_preposal"=>$propsal_file,
								  "app_date"=>date('Y-m-d')
								  );
					
							$insert = $this->user_model->insert_data('tbl_fund_applicant',$inset_data);
							
							
		
				$user_fname = $app_name;
				
				$copy = $this->user_model->get_row_with_con('tbl_admin',array('id'=>1));
						
				
				$to = $app_email;
				$subject = 'Your proposal have be successful submitted. ';
				$message = "
				<html>
				<head>
				<title>".$subject."</title>
				</head>
				<body>
				<div  style='width:700px; float:left;'>
					  <div  style='width: 98%;float: left;background: #F7F7F7;padding: 1%;border-radius: 4px;border-top: 3px solid #ee4723;'>
					  <div > <img src='".base_url()."design/front/images/logo.png'/> </div>
													<p style='font-size: 17px; font-family:Tahoma, Geneva, sans-serif;'>Dear ".$user_fname.", </p>
												 <p style='font-size: 15px; font-family:Tahoma, Geneva, sans-serif; color: #646161'>Your Proposal have been successfully submitted. We will evaluate your proposal in one week after deadline time. Please wait for inform from my website.   <br><br>
												 </p>
												 
								<p>
Yours sincerely, <br>
Lean Corrosion Editorial Office <br>
leancorrosion@lean.com <br>

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
				
				
				$thnx_msg ="<b>Congratulation</b></br>Your Proposal have been successfully submitted";
					   $this->session->set_flashdata("success",$thnx_msg);	
					   
			$redirect = base_url().'confrim';
		 redirect($redirect);			
			
	}
	function confirm_page()
	{
		if($this->session->flashdata('success')){
			$data['success'] = $this->session->flashdata('success');
			$this->load->view('header');
			$this->load->view('thanks_page',$data);
			$this->load->view('footer');
		}
		else
		{
			$redirect = base_url().'funding-list';
				 redirect($redirect);	
		}
	}
	
	
}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */
