<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Content extends CI_Controller { 

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
	
	
	/* CONATENT SECTION*/
	function pages_list()
	{
		$data ='';
		$page_display='';
		if($this->uri->segment(2)=='channel-list')
		{
			
			$page_display='2';
		}
		elseif($this->uri->segment(2)=='pages-list')
		{
			
			$page_display='1';
		}
		
		$data['page_display'] = $page_display;
		
		$select_filed = "*";
		$tbl_name ='tbl_pages';	
		$where_condition=array('page_display'=>$page_display);
		$order_by_field='page_id';
		$order_by_type='desc';
		$limit='';$offset='';$all_record='';
				
		$data['list'] =$this->user_model->select_query_with_join_order_by($select_filed, $tbl_name, $where_condition,$limit, $offset, $all_record, $order_by_field, $order_by_type);
		
			$this->load->view( 'admin/header' );
			$this->load->view( 'admin/page_list',$data);
			$this->load->view( 'admin/footer');
		
	}
	
	
	function pages_form()
	{
		
		if($this->uri->segment(2)=='channel-form')
		{
			
			$page_display='2';
		}
		elseif($this->uri->segment(2)=='pages-form')
		{
			
			$page_display='1';
		}
		$data['page_display'] = $page_display; 
	
		if($this->uri->segment(3))
		{
			$page_id=$this->uri->segment(3);
			
			$select_filed = "*";
			$tbl_name ='tbl_pages';	
			$where_condition=array('page_id'=>$page_id);
			$order_by_field='';
			$order_by_type='';
					
			$data['list'] =$this->user_model->select_query($select_filed, $tbl_name, $where_condition,$order_by_field, $order_by_type);
		
			$data['page_id'] = $page_id; 
			$data['but_value'] = 'Update'; 
						
		}
		else
		{
			$data['page_id'] = '0'; 
			$data['but_value'] = 'Add'; 
		}
			$this->load->view( 'admin/header' );
			$this->load->view( 'admin/page_form',$data);
			$this->load->view( 'admin/footer');
		
	}
	
	
	
	
	public function pages_action()
	{
		/*echo '<pre>';
		print_r($_POST);exit;*/
		
		
		$tbl_name = "tbl_pages";
		extract($this->input->post());
			if(($page_id=='0') && ($cat_button=='Add'))
					{
						$inset_data  =  array("page_title"=>$page_title,
															"page_desc"=>$page_desc,
															"page_mtitle"=>$page_mtitle,
															"page_mkey"=>$page_mkey, 
															"page_mdesc"=>$page_mdesc,
															"page_url"=>$this->seoUrl($page_title),
															"page_display"=>$page_display,
															"page_status"=>$page_status,
															"page_dateadd"=>date("Y-m-d"));
						$query =$this->user_model->insert_data($tbl_name,$inset_data);
						$this->session->set_flashdata("sucess","Successfully inserted.");
						//redirect('administrator/pages-list');
							if($page_display=='2')
							{
								redirect('administrator/channel-list');
							}
							elseif($page_display=='1')
							{
								redirect('administrator/pages-list');
							}
					}
					if(($page_id>0) && ($cat_button=='Update'))
					{
						$url = $page_url;
						if($page_old_title!=$page_title){ $url = $this->seoUrl($page_title);}
						$where =  array("page_id"=>$page_id);
						$update_data  =  array("page_title"=>$page_title,
															"page_desc"=>$page_desc,
															"page_mtitle"=>$page_mtitle,
															"page_mkey"=>$page_mkey, 
															"page_mdesc"=>$page_mdesc,
															"page_url"=> $url ,
															"page_display"=>$page_display,
															"page_status"=>$page_status,
															"page_update"=>date("Y-m-d"));
															
						$query = $this->user_model->update_data($tbl_name,$update_data,$where);
						$this->session->set_flashdata("sucess","Successfully Updated.");
						//redirect('administrator/pages-list');
							if($page_display=='2')
							{
								redirect('administrator/channel-list');
							}
							elseif($page_display=='1')
							{
								redirect('administrator/pages-list');
							}
					}	
	}
	

	
	public function page_status()
	{
		
		$page_id=$this->uri->segment(4);
		$page_status=$this->uri->segment(5);
		$new_status = '';
		if($page_status=='1'){$new_status = '0';}
		if($page_status=='0'){$new_status = '1';}
		
		$where =  array("page_id"=>$page_id);						
						$update_data  =  array("page_status"=>$new_status);
		
		$query = $this->user_model->update_data("tbl_pages",$update_data,$where);
						$this->session->set_flashdata("sucess","Successfully Updated.");
		if($this->uri->segment(6)=='2')
		{
			redirect('administrator/channel-list');
		}
		elseif($this->uri->segment(6)=='1')
		{
			redirect('administrator/pages-list');
		}				
						
					
	}
	
	public function page_delete()
	{		
	
		$page_id=$this->uri->segment(4);
			
		$this->user_model->delete_query("tbl_pages",array("page_id"=>$page_id));
		$this->session->set_flashdata("sucess","Successfully Deleted.");
		
		
		if($this->uri->segment(5)=='2')
		{
			redirect('administrator/channel-list');
		}
		elseif($this->uri->segment(5)=='1')
		{
			redirect('administrator/pages-list');
		}				
						
						
		/*redirect('administrator/pages-list');
		print_r($_REQUEST);
		exit;*/
	}
	
	
	/* CHANNEL SECTION*/
	function channel_list()
	{
		$data ='';
		
		$select_filed = "*";
		$tbl_name ='tbl_pages';	
		$where_condition=array('page_display'=>'2');
		$order_by_field='page_id';
		$order_by_type='desc';
		$limit='';$offset='';$all_record='';
				
		$data['list'] =$this->user_model->select_query_with_join_order_by($select_filed, $tbl_name, $where_condition,$limit, $offset, $all_record, $order_by_field, $order_by_type);
		
			$this->load->view( 'admin/header' );
			$this->load->view( 'admin/page_list',$data);
			$this->load->view( 'admin/footer');
		
	}
	
	
	function channel_form()
	{
		if($this->uri->segment(3))
		{
			$page_id=$this->uri->segment(3);
			
			$select_filed = "*";
			$tbl_name ='tbl_pages';	
			$where_condition=array('page_id'=>$page_id);
			$order_by_field='';
			$order_by_type='';
					
			$data['list'] =$this->user_model->select_query($select_filed, $tbl_name, $where_condition,$order_by_field, $order_by_type);
		
			$data['page_id'] = $page_id; 
			$data['but_value'] = 'Update'; 
						
		}
		else
		{
			$data['page_id'] = '0'; 
			$data['but_value'] = 'Add'; 
		}
			$this->load->view( 'admin/header' );
			$this->load->view( 'admin/page_form',$data);
			$this->load->view( 'admin/footer');
		
	}
	
	
	
	
	public function channel_action()
	{
		/*echo '<pre>';
		print_r($_POST);exit;*/
		
		
		$tbl_name = "tbl_pages";
		extract($this->input->post());
			if(($page_id=='0') && ($cat_button=='Add'))
					{
						$inset_data  =  array("page_title"=>$page_title,
															"page_desc"=>$page_desc,
															"page_mtitle"=>$page_mtitle,
															"page_mkey"=>$page_mkey, 
															"page_mdesc"=>$page_mdesc,
															"page_url"=>$this->seoUrl($page_title),
															"page_display"=>'1',
															"page_status"=>$page_status,
															"page_dateadd"=>date("Y-m-d"));
						$query =$this->user_model->insert_data($tbl_name,$inset_data);
						$this->session->set_flashdata("sucess","Successfully inserted.");
						redirect('administrator/pages-list');
					}
					if(($page_id>0) && ($cat_button=='Update'))
					{
						$url = $page_url;
						if($page_old_title!=$page_title){ $url = $this->seoUrl($page_title);}
						$where =  array("page_id"=>$page_id);
						$update_data  =  array("page_title"=>$page_title,
															"page_desc"=>$page_desc,
															"page_mtitle"=>$page_mtitle,
															"page_mkey"=>$page_mkey, 
															"page_mdesc"=>$page_mdesc,
															"page_url"=> $url ,
															"page_display"=>'1',
															"page_status"=>$page_status,
															"page_update"=>date("Y-m-d"));
															
						$query = $this->user_model->update_data($tbl_name,$update_data,$where);
						$this->session->set_flashdata("sucess","Successfully Updated.");
						redirect('administrator/pages-list');
					}	
	}
	

	
	public function channel_status()
	{
		
		$page_id=$this->uri->segment(4);
		$page_status=$this->uri->segment(5);
		$new_status = '';
		if($page_status=='1'){$new_status = '0';}
		if($page_status=='0'){$new_status = '1';}
		
		$where =  array("page_id"=>$page_id);						
						$update_data  =  array("page_status"=>$new_status);
		
		$query = $this->user_model->update_data("tbl_pages",$update_data,$where);
						$this->session->set_flashdata("sucess","Successfully Updated.");
						redirect('administrator/pages-list');
	}
	
	public function channel_delete()
	{		
	
		$page_id=$this->uri->segment(4);
			
		$this->user_model->delete_query("tbl_pages",array("page_id"=>$page_id));
		$this->session->set_flashdata("sucess","Successfully Deleted.");
		redirect('administrator/pages-list');
		/*print_r($_REQUEST);
		exit;*/
	}
	

	/* FAQ CONATENT SECTION*/
	function faqs_list()
	{
		$data ='';
		
		$select_filed = "*";
		$tbl_name ='tbl_faqs';	
		$where_condition='';
		$order_by_field='faq_id';
		$order_by_type='desc';
		$limit='';$offset='';$all_record='';
				
		$data['list'] =$this->user_model->select_query_with_join_order_by($select_filed, $tbl_name, $where_condition,$limit, $offset, $all_record, $order_by_field, $order_by_type);
		
			$this->load->view( 'admin/admin_header' );
			$this->load->view( 'admin/faqs_list',$data);
			$this->load->view( 'admin/admin_footer');
		
	}
	
	
	function faqs_form()
	{
		$data['lang_list'] =$this->user_model->select_query('*', 'tbl_languages', array('lang_status'=>'1'),'lang_id', 'asc');
		if($this->uri->segment(3))
		{
			$faq_id=$this->uri->segment(3);
			
			$select_filed = "*";
			$tbl_name ='tbl_faqs';	
			$where_condition=array('faq_id'=>$faq_id);
			$order_by_field='';
			$order_by_type='';
					
			$data['list'] =$this->user_model->select_query($select_filed, $tbl_name, $where_condition,$order_by_field, $order_by_type);
		
			$data['faq_id'] = $faq_id; 
			$data['but_value'] = 'Update'; 
						
		}
		else
		{
			$data['faq_id'] = '0'; 
			$data['but_value'] = 'Add'; 
		}
			$this->load->view( 'admin/admin_header' );
			$this->load->view( 'admin/faqs_form',$data);
			$this->load->view( 'admin/admin_footer');
		
	}
		
	public function faqs_action()
	{
		/*echo '<pre>';
		print_r($_POST);
		exit;*/
		
		
		$lang_list=$this->user_model->select_query('*', 'tbl_languages', array('lang_status'=>'1'),'lang_id', 'asc');
		
		$tbl_name = "tbl_faqs";
		extract($this->input->post());
			if(($faq_id=='0') && ($cat_button=='Add'))
					{
						$inset_data  =  array(  
															"faq_status"=>$faq_status,
															"faq_dateadd"=>date("Y-m-d"));
						$query =$this->user_model->insert_data($tbl_name,$inset_data);
															
					  
					  $i=0;  
					  
					  foreach ($lang_list as $language) {
						  
					  $insert_desc1=       array("faq_id"=>$query,
															"lang_id"=>$language->lang_id,
															"faq_title"=>$faq_title[$language->lang_id],
															"faq_desc"=>$faq_desc[$language->lang_id]);
															
										$query_12 =$this->user_model->insert_data('tbl_faqdesc',$insert_desc1);						
						
										
															
								$i++;							
					  }
						
						$this->session->set_flashdata("sucess","Successfully inserted.");
						redirect('administrator/faqs-list');
					}
					if(($faq_id>0) && ($cat_button=='Update'))
					{
						
						
						
						
					//	if($page_old_title!=$page_title){ $url = $this->seoUrl($page_title);}
						$where =  array("faq_id"=>$faq_id);
						$update_data  =  array("faq_status"=>$faq_status,
															"faq_update"=>date("Y-m-d"));
															
						$query = $this->user_model->update_data($tbl_name,$update_data,$where);
						
						//echo $this->db->last_query();
						
						  
							  $i=0;  
					  
					 		 foreach ($lang_list as $language) {
								 
						  $where = array("faq_id"=>$faq_id,"lang_id"=>$language->lang_id);
					  $update_data	=       array("faq_id"=>$faq_id,
					  										"lang_id"=>$language->lang_id,
					  										"faq_title"=>$faq_title[$language->lang_id],
															"faq_desc"=>$faq_desc[$language->lang_id]);
															
															
								$check_data  = $this->user_model->check_booking('tbl_faqdesc',$where);
														
							if($check_data>0)								
							{	
								$query_update = $this->user_model->update_data('tbl_faqdesc',$update_data,$where);
							}
							else
							{
								$query_12 =$this->user_model->insert_data('tbl_faqdesc',$update_data);		
								
							}
										
										
															
								$i++;							
					  }
						
						
						
						
						//exit;
						
						$this->session->set_flashdata("sucess","Successfully Updated.");
						redirect('administrator/faqs-list');
					}	
	}
	
	
	public function faq_status()
	{
		
		$faq_id=$this->uri->segment(4);
		$page_status=$this->uri->segment(5);
		$new_status = '';
		if($page_status=='1'){$new_status = '0';}
		if($page_status=='0'){$new_status = '1';}
		
		$where =  array("faq_id"=>$faq_id);						
						$update_data  =  array("faq_status"=>$new_status);
		
		$query = $this->user_model->update_data("tbl_faqs",$update_data,$where);
		
	
						$this->session->set_flashdata("sucess","Successfully Updated.");
						redirect('administrator/faqs-list');
	}
	
	public function faq_delete()
	{		
	
		$faq_id=$this->uri->segment(4);
			
		$this->user_model->delete_query("tbl_faqs",array("faq_id"=>$faq_id));
		$this->session->set_flashdata("sucess","Successfully Deleted.");
		redirect('administrator/faqs-list');
		/*print_r($_REQUEST);
		exit;*/
	}
	
	
	/* BORD DATA SECTION*/
	function bord_list()
	{
		$data ='';
		
		
		$select_filed = "*";
		$tbl_name ='tbl_board';	
		$where_condition='';
		$order_by_field='bord_id';
		$order_by_type='desc';
		$limit='';$offset='';$all_record='';
				
		$data['list'] =$this->user_model->select_query_with_join_order_by($select_filed, $tbl_name, $where_condition,$limit, $offset, $all_record, $order_by_field, $order_by_type);
		
			$this->load->view( 'admin/header' );
			$this->load->view( 'admin/board_list',$data);
			$this->load->view( 'admin/footer');
		
	}
	
	
	function bord_form()
	{
		
	
		if($this->uri->segment(3))
		{
			$bord_id=$this->uri->segment(3);
			
			$select_filed = "*";
			$tbl_name ='tbl_board';	
			$where_condition=array('bord_id'=>$bord_id);
			$order_by_field='';
			$order_by_type='';
					
			$data['list'] =$this->user_model->select_query($select_filed, $tbl_name, $where_condition,$order_by_field, $order_by_type);
		
			$data['bord_id'] = $bord_id; 
			$data['but_value'] = 'Update'; 
						
		}
		else
		{
			$data['bord_id'] = '0'; 
			$data['but_value'] = 'Add'; 
		}
			$this->load->view( 'admin/header' );
			$this->load->view( 'admin/board_form',$data);
			$this->load->view( 'admin/footer');
		
	}
	
	
	
	
	public function bord_action()
	{
		/*echo '<pre>';
		print_r($_POST);exit;*/
		
		
		$tbl_name = "tbl_board";
		extract($this->input->post());
		$member_image='';
		
		if(!empty($bord_old_image))
		{
			$member_image=$bord_old_image;
		}
		
		
		if ((isset($_FILES['bord_image'])) && (!empty($_FILES['bord_image']['name'])))
		{			
			 $dir_name = 'upload/board';
			 
			  /* SCHENE DOC*/
			  
			 if(!empty($_FILES['bord_image']['name']) && ($_FILES['bord_image']['error']==0))
			 {
				 $this->create_dir( $dir_name );
				$file_name = time()."-".str_replace(" ","_",$_FILES['bord_image']['name']);
				
				$config['upload_path'] = $dir_name;
				$config['allowed_types'] = 'png|jpeg|jpg|gif';
				$config['file_name'] = $file_name;

				$this->upload->initialize($config);
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('bord_image'))
				{
					$data = $this->upload->data();
					$member_image = $data['file_name'];
				}
			 }
		}
		
		
		
		
		
			if(($bord_id=='0') && ($cat_button=='Add'))
			{
				$inset_data = array("bord_name"=>$bord_name,
									"bord_email"=>$bord_email,
									"bord_affi"=>$bord_affi,
									"bord_detail"=>$bord_desc, 
									"bord_image"=>$member_image,
									"bord_status"=>$bord_status,
									"bord_dateadd"=>date("Y-m-d"));
				$query =$this->user_model->insert_data($tbl_name,$inset_data);
				$this->session->set_flashdata("sucess","Successfully inserted.");
				redirect('administrator/board-list');
			}
			if(($bord_id>0) && ($cat_button=='Update'))
			{
				$where =  array("bord_id"=>$bord_id);
				 $update_data  =  array("bord_name"=>$bord_name,
										"bord_email"=>$bord_email,
										"bord_affi"=>$bord_affi,
										"bord_detail"=>$bord_desc, 
										"bord_image"=>$member_image,
										"bord_status"=>$bord_status,
										"bord_update"=>date("Y-m-d"));
													
				$query = $this->user_model->update_data($tbl_name,$update_data,$where);
				$this->session->set_flashdata("sucess","Successfully Updated.");
				redirect('administrator/board-list');
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
	
	
}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */
