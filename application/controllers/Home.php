<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller { 
 
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
		$this->load->library('encrypt');
		$this->load->helper('general');
	 }

	 	
	public function index()
	{
		$data['setting_data'] =$this->user_model->get_row_with_con('tbl_admin',array('id'=>'1'));
	
		$select_filed = "*";
			$tbl_name ='tbl_article as a';	
			$where_condition=array('a.art_status'=>15);
			$order_by_field='a.art_id';
			$order_by_type='desc';				
			$group_by_field='a.art_id';
			
			$join_tbl1="tbl_article_publish ap";
		    $join_condition1="ap.pub_artid=a.art_id";
			
			
			$data['home_art_list'] =$this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field,$join_tbl1,'',$join_condition1);

		$this->load->view('header');
		$this->load->view('home',$data);
		$this->load->view('footer');
	}
	
	public function page_detail()
	{
	
			if($this->uri->segment(2))
			{	
				$page_url = $this->uri->segment(2);				
						
				$select_filed = "*";
				$tbl_name ='tbl_pages';	
				$where_condition=array('page_status'=>1, 'page_url'=>$page_url);
				$order_by_field='page_id';
				$order_by_type='desc';
				$data['page_data'] =$this->user_model->get_row_with_con( $tbl_name, $where_condition);
		
				if(!empty($data['page_data']))
				{		
					$data['meta_desc'] = $data['page_data']->page_mdesc;
					$data['meta_title'] = $data['page_data']->page_mtitle;
					$this->load->view('header',$data);
					$this->load->view('page_detail',$data);
					$this->load->view('footer');
				}
				else
				{
					 redirect('404_override');					
				}
				
			}
			else
			{
				 redirect('404_override');
			}
		
	}
	
	function editorial_board()
	{	
	
		$data['board_list'] =$this->user_model->select_query('*','tbl_board',array('bord_status'=>'1'),'bord_id','desc');	
	
	
		$this->load->view('header');
		$this->load->view('board_list',$data);
		$this->load->view('footer');
	}
	
	function archive_list()
	{
				
			$select_filed = "*";
			$tbl_name ='tbl_article as a';	
			$where_condition=array('a.art_status'=>15);
			$order_by_field='a.art_id';
			$order_by_type='desc';				
			$group_by_field='ap.pub_year,ap.pub_valume';
			
			$join_tbl1="tbl_article_publish ap";
		    $join_condition1="ap.pub_artid=a.art_id";
			
			
			$data['article_list'] =$this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field,$join_tbl1,'',$join_condition1);
				
	
		$this->load->view('header');
		$this->load->view('archive_list',$data);
		$this->load->view('footer');
		
	}
	
	
	function artilce_detail()
	{
		
				
		if($this->uri->segment(2))
		{		
			$this->uri->segment(2);
			$art_no = $this->uri->segment(2);		
		
			
			$select_filed = '*';	
			$tbl_name= 'tbl_article as a';	
			$where_condition = array('a.art_status'=>'15','a.art_no'=>$art_no);
			$order_by_field = 'a.art_id';
			$order_by_type ='desc';
			$group_by_field = 'a.art_id';
			$join_tbl1="tbl_article_publish p";
		    $join_condition1="p.pub_artid=a.art_id";
			$join_tbl2="tbl_users u";
		    $join_condition2="u.user_id=a.art_userid";
		
			$data['art_data'] =$this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field,$join_tbl1,'',$join_condition1,$join_tbl2,$join_condition2,'');
			
			$where_must_see	= "a.art_status='15' and find_in_set(a.art_id,'".$data['art_data'][0]->pub_must_see."')";			
			$data['must_see'] =$this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_must_see, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field,$join_tbl1,'',$join_condition1);
			
			
						
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
				$this->load->view('header');
				$this->load->view('article_detail',$data);
				$this->load->view('footer');
			}
			else
			{
				$redirect = base_url();
				 redirect($redirect);
			}
		}
		else
		{
				$redirect = base_url();
				 redirect($redirect);			
		}
	}
	
	public function article_fulltext()
	{
		if($this->uri->segment(2))
		{
			$art_no = $this->uri->segment(2);
			
			$select_filed = '*';	
			$tbl_name= 'tbl_article as a';	
			$where_condition = array('a.art_status'=>'15','a.art_no'=>$art_no);
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
				$this->load->view( 'article_detail_fulltext',$data);
				$this->load->view( 'footer');
			}
			else
			{
				
				$redirect = base_url();
				 redirect($redirect);
			}
		}
		else
		{
			
				$redirect = base_url();
				 redirect($redirect);
		}
	}
	
	
	function search_article()
	{
		/*echo '<pre>';
		print_r($_POST);
		exit;*/
		
		$where_condi='';
		if(isset($_POST['search_art']) && !empty($_POST['search_art']))
		{
			$where_condi=" AND (a.art_fulltitle LIKE '%".$_POST['search_art']."%' OR ap.pub_abstract LIKE '%".$_POST['search_art']."%')";
		$select_filed = "*";
			$tbl_name ='tbl_article as a';	
			$where_condition='a.art_status = 15 ';
			$order_by_field='a.art_id';
			$order_by_type='desc';				
			$group_by_field='a.art_id';			
			$join_tbl1="tbl_article_publish ap";
		    $join_condition1="ap.pub_artid=a.art_id";
			
			$where_condition .=$where_condi;
			$data['search_list'] =$this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field,$join_tbl1,'',$join_condition1);

		$this->load->view('header');
		$this->load->view('search_detail',$data);
		$this->load->view('footer');
		}
		else
		{	
				$redirect = base_url();
				 redirect($redirect);
			
		}
		
	}
	
	function submit_subscriber()
	{
		extract($this->input->post());
	
		$search_email = '';
		if(isset($_POST['research_header']) && (!empty($_POST['research_header'])))
		{
			$search_email = $_POST['research_header'];
		}
		elseif(isset($_POST['research_footer']) && (!empty($_POST['research_footer'])))
		{
			$search_email = $_POST['research_footer'];
		}
		
		$count_data = 0;	 
		
		$where_check_sub = array('sub_email'=>$search_email,'sub_for'=>$sub_for);
		
		$count_data =$this->user_model->check_no_rec('tbl_subscribe',$where_check_sub);	
		
		if($count_data==0)
		{
		
			$inset_data = array(
								"sub_for"=>$sub_for,
								"sub_email"=>$search_email,
								"sub_name"=>'',
								"sub_status"=>'1',
								"sub_date"=>date('Y-m-d')
							   );
			$insert = $this->user_model->insert_data('tbl_subscribe',$inset_data);
			echo 'Think you for "GET MORE RESEARCHES LIKE THIS IN YOUR INBOX!"';
		}
		else
		{
			echo 'Your email already exits!';
			
		}
	}
}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */
