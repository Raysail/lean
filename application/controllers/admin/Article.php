<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Article extends CI_Controller { 

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
		$this->db->from("tbl_article_type");
		$this->db->where("atype_url",$new_string);
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
	function atricle_type_list()
	{
		$data ='';
		
		$select_filed = "*";
		$tbl_name ='tbl_article_type';	
		$where_condition='';
		$order_by_field='atype_id';
		$order_by_type='desc';
		$limit='';$offset='';$all_record='';
				
		$data['list'] =$this->user_model->select_query_with_join_order_by($select_filed, $tbl_name, $where_condition,$limit, $offset, $all_record, $order_by_field, $order_by_type);
		
			$this->load->view( 'admin/header' );
			$this->load->view( 'admin/article_type',$data);
			$this->load->view( 'admin/footer');
		
	}
	
	
	function atricle_type_form()
	{
			
		if($this->uri->segment(3))
		{
			$atype_id=$this->uri->segment(3);
			
			$select_filed = "*";
			$tbl_name ='tbl_article_type';	
			$where_condition=array('atype_id'=>$atype_id);
			$order_by_field='';
			$order_by_type='';
					
			$data['list'] =$this->user_model->select_query($select_filed, $tbl_name, $where_condition,$order_by_field, $order_by_type);
		
			$data['atype_id'] = $atype_id; 
			$data['but_value'] = 'Update'; 
						
		}
		else
		{
			$data['atype_id'] = '0'; 
			$data['but_value'] = 'Add'; 
		}
			$this->load->view( 'admin/header' );
			$this->load->view( 'admin/article_type_form',$data);
			$this->load->view( 'admin/footer');
		
	}
	
	
	
	
	public function atricle_type_action()
	{
		$tbl_name = "tbl_article_type";
		extract($this->input->post());
			if(($atype_id=='0') && ($cat_button=='Add'))
					{
						$inset_data  =  array("atype_title"=>$atype_title,
												"atype_status"=>$atype_status,
												"atype_dateadd"=>date("Y-m-d"));
						$query =$this->user_model->insert_data($tbl_name,$inset_data);
						$this->session->set_flashdata("sucess","Successfully inserted.");
						redirect('administrator/articletype-list');
						
					}
					if(($atype_id>0) && ($cat_button=='Update'))
					{
						$where =  array("atype_id"=>$atype_id);
						$update_data  =  array("atype_title"=>$atype_title,
												"atype_status"=>$atype_status,
												"atype_update"=>date("Y-m-d"));
															
						$query = $this->user_model->update_data($tbl_name,$update_data,$where);
						$this->session->set_flashdata("sucess","Successfully Updated.");
						redirect('administrator/articletype-list');
					}	
	}
	

	
	public function atricle_type_status()
	{
		
		$atype_id=$this->uri->segment(4);
		$atype_status=$this->uri->segment(5);
		$new_status = '';
		if($atype_status=='1'){$new_status = '0';}
		if($atype_status=='0'){$new_status = '1';}
		
		$where =  array("atype_id"=>$atype_id);						
						$update_data  =  array("atype_status"=>$new_status);
		
		$query = $this->user_model->update_data("tbl_article_type",$update_data,$where);
						$this->session->set_flashdata("sucess","Successfully Updated.");		
			redirect('administrator/articletype-list');
	}
	
	public function atricle_type_delete()
	{		
	
		$atype_id=$this->uri->segment(4);
			
		$this->user_model->delete_query("tbl_article_type",array("atype_id"=>$atype_id));
		$this->session->set_flashdata("sucess","Successfully Deleted.");
				
						
						
		redirect('administrator/articletype-list');
	}
	
	
	/* CHANNEL SECTION*/
	function atricle_submision_list()
	{
		$data ='';
		
		$select_filed = "*";
		$tbl_name ='tbl_article_classified';	
		$where_condition='';
		$order_by_field='asubmi_id';
		$order_by_type='desc';
		$limit='';$offset='';$all_record='';
				
		$data['list'] =$this->user_model->select_query_with_join_order_by($select_filed, $tbl_name, $where_condition,$limit, $offset, $all_record, $order_by_field, $order_by_type);
		
			$this->load->view( 'admin/header' );
			$this->load->view( 'admin/article_submi',$data);
			$this->load->view( 'admin/footer');
		
	}
	
	
	function atricle_submision_form()
	{
		if($this->uri->segment(3))
		{
			$asubmi_id=$this->uri->segment(3);
			
			$select_filed = "*";
			$tbl_name ='tbl_article_classified';	
			$where_condition=array('asubmi_id'=>$asubmi_id);
			$order_by_field='';
			$order_by_type='';
					
			$data['list'] =$this->user_model->select_query($select_filed, $tbl_name, $where_condition,$order_by_field, $order_by_type);
		
			$data['asubmi_id'] = $asubmi_id; 
			$data['but_value'] = 'Update'; 
						
		}
		else
		{
			$data['asubmi_id'] = '0'; 
			$data['but_value'] = 'Add'; 
		}
			$this->load->view( 'admin/header' );
			$this->load->view( 'admin/article_submi_form',$data);
			$this->load->view( 'admin/footer');
		
	}
	
	
	
	
	public function atricle_submision_action()
	{
		/*echo '<pre>';
		print_r($_POST);exit;*/
		
		
		$tbl_name = "tbl_article_classified";
		extract($this->input->post());
			if(($asubmi_id=='0') && ($cat_button=='Add'))
					{
						$inset_data  =  array("asubmi_title"=>$asubmi_title,
												"asubmi_status"=>$asubmi_status,
												"asubmi_dateadd"=>date("Y-m-d"));
						$query =$this->user_model->insert_data($tbl_name,$inset_data);
						$this->session->set_flashdata("sucess","Successfully inserted.");
						redirect('administrator/articlesubmi-list');
					}
					if(($asubmi_id>0) && ($cat_button=='Update'))
					{
						
						$where =  array("asubmi_id"=>$asubmi_id);
						$update_data  =  array("asubmi_title"=>$asubmi_title,
												"asubmi_status"=>$asubmi_status,
												"asubmi_updated"=>date("Y-m-d"));
															
						$query = $this->user_model->update_data($tbl_name,$update_data,$where);
						$this->session->set_flashdata("sucess","Successfully Updated.");
						redirect('administrator/articlesubmi-list');
					}	
	}
	

	
	public function atricle_submision_status()
	{
		
		$asubmi_id=$this->uri->segment(4);
		$asubmi_status=$this->uri->segment(5);
		$new_status = '';
		if($asubmi_status=='1'){$new_status = '0';}
		if($asubmi_status=='0'){$new_status = '1';}
		
		$where =  array("asubmi_id"=>$asubmi_id);						
						$update_data  =  array("asubmi_status"=>$new_status);
		
		$query = $this->user_model->update_data("tbl_article_classified",$update_data,$where);
						$this->session->set_flashdata("sucess","Successfully Updated.");
						redirect('administrator/articlesubmi-list');
	}
	
	public function atricle_submision_delete()
	{		
	
		$asubmi_id=$this->uri->segment(4);
			
		$this->user_model->delete_query("tbl_article_classified",array("asubmi_id"=>$asubmi_id));
		$this->session->set_flashdata("sucess","Successfully Deleted.");
		redirect('administrator/articlesubmi-list');
	}
	
}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */
