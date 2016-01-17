<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Setting extends CI_Controller { 



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


	
	/* load add gallery image view    */
	public function social_image() {
//		
		$tablname ='slider';
		$data['imgid'] = $this->uri->segment(3);
		if( $data['imgid'] !='add' && $data['imgid'] >0 ) {
			$data['image'] = $this->user_model->selectpage_byid( $data['imgid'], $tablname);//print_r($data['image']);exit;
			$this->load->view('admin/add-slide', $data);
		} else {
			$data['image'] ='';
			$this->load->view('admin/add-slide', $data);
		}
	}
		
	function create_dir( $dir_name ){

		$filename = $dir_name . "/";
		if (!file_exists($filename)) {
		mkdir( $dir_name,0755,TRUE );
		}
	}

	
	public function social_icon()
	{
	   $data['title']="Manage Social Club";
		
		    $tbl_name = 'tbl_social';
			$data['list'] = $this->user_model->select_query('*', $tbl_name, '' ,'', '');
			$this->load->view( 'admin/header' );
		    $this->load->view( 'admin/social_view',$data);
		    $this->load->view( 'admin/footer');  
	}
	
	public function social_form()
	{
	    if($this->uri->segment(3))
		{
			$social_id=$this->uri->segment(3);
			
			$select_filed = "*";
			$tbl_name ='tbl_social';	
			$where_condition=array('social_id'=>$social_id);
			$order_by_field='';
			$order_by_type='';
					
			$data['list'] =$this->user_model->select_query($select_filed, $tbl_name, $where_condition,$order_by_field, $order_by_type);
		
			$data['social_id'] = $social_id; 
			$data['but_value'] = 'Update'; 
						
		}
		else
		{
			$data['social_id'] = '0'; 
			$data['but_value'] = 'Add'; 
		}
			$this->load->view( 'admin/header' );
			$this->load->view( 'admin/social_form',$data);
			$this->load->view( 'admin/footer');
	}
	
	
	
	/* action of add and edit pages of gallery  */
	public function social_action() {
       
		extract($this->input->post());
			
				$tbl_name ='tbl_social';	
			
			  $dir_name = 'upload/slider';
			  $front_name ='';
			  
			  	if(isset($_POST['old_slider_image']) && (!empty($_POST['old_slider_image'])))
				{
					$front_name = $_POST['old_slider_image'];
				}
			  
				if( (isset($_FILES['social_icon'])) && (!empty($_FILES['social_icon']['name'])) )
				{
							if(!empty($_POST['old_slider_image'])){							
								unlink( $dir_name.'/'.$_POST['old_slider_image']);
							}
							
							if($_FILES['social_icon']['error']==0){
						//$path = 'upload/users/dc/';
					   
					//   $dir_name = 'upload/property/'.$folderName;
					 	  $this->create_dir( $dir_name );
						$file_name = time()."-".str_replace(" ","_",$_FILES['social_icon']['name']);
						
						$config['upload_path'] = $dir_name;
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['max_size'] = '1000'; 
						$config['max_width'] = '10240'; 
						$config['max_height'] = '7680';
						$config['file_name'] = $file_name;

						$this->upload->initialize($config);


						$this->load->library('upload', $config);
						
						if ($this->upload->do_upload('social_icon'))
							{
								$data = $this->upload->data();
								$front_name = $data['file_name'];
								//echo "<pre>"; print_r($data); die;
							}
							else
							{
								$errors = $this->upload->display_errors();
								$this->session->set_flashdata("error", "Front Image :".$errors);
								$this->session->set_flashdata('return',$ret_data);
								redirect(base_url().'social-form');
							}
						}					
					}
			
			

					if(($social_id=='0') && ($cat_button=='Add'))
					{
						$inset_data  =  array("social_title"=>$social_title,"social_link"=>$social_link,"social_icon"=>$front_name,"social_status"=>$social_status);
						$query =$this->user_model->insert_data($tbl_name,$inset_data);
						$this->session->set_flashdata("sucess","Successfully inserted.");
						redirect('administrator/social-icon');
					}
					if(($social_id>0) && ($cat_button=='Update'))
					{
						$where =  array("social_id"=>$social_id);
						$update_data  =  array("social_title"=>$social_title,"social_link"=>$social_link,"social_icon"=>$front_name,"social_status"=>$social_status);
						$query = $this->user_model->update_data($tbl_name,$update_data,$where);
						$this->session->set_flashdata("sucess","Successfully Updated.");
						redirect('administrator/social-icon');
					}					
					
					




	}
	
	public function social_delete()
	{		
	
		$social_id=$this->uri->segment(4);
			
			$select_filed = "*";
			$tbl_name ='tbl_social';	
			$where_condition=array('social_id'=>$social_id);
			$order_by_field='';
			$order_by_type='';
					
			$list =$this->user_model->select_query($select_filed, $tbl_name, $where_condition,$order_by_field, $order_by_type);
		
				unlink( 'upload/slider/'.$list[0]->social_icon);
		
		
		$this->user_model->delete_query("tbl_social",array("social_id"=>$social_id));
		$this->session->set_flashdata("sucess","Successfully Deleted.");
		redirect('administrator/social-icon');
		/*print_r($_REQUEST);
		exit;*/
	}
	public function social_status()
	{
		$social_id=$this->uri->segment(4);
		$user_status=$this->uri->segment(5);
		$new_status = '';
		if($user_status=='1'){$new_status = '0';}
		if($user_status=='0'){$new_status = '1';}
		
		$where =  array("social_id"=>$social_id);
						
						$update_data  =  array("social_status"=>$new_status);
		
		$query = $this->user_model->update_data("tbl_social",$update_data,$where);
						$this->session->set_flashdata("sucess","Successfully Updated.");
						redirect('administrator/social-icon');
		
	}
	
	
	
	/* general setting and auction functioanlity*/
	
	public function general_setting()
	{
		$data['general_detal'] =$this->user_model->select_query('*', 'tbl_admin','','', '');
		
		$this->load->view( 'admin/header' );
		$this->load->view( 'admin/general-form',$data);
		$this->load->view( 'admin/footer');     
	}
	
	public function general_update()
	{
		 extract($this->input->post());
		 
		 
		  $dir_name = 'upload/slider';
			  $front_name ='';
			  
			  	if(isset($_POST['old_banner_image']) && (!empty($_POST['old_banner_image'])))
				{
					$front_name = $_POST['old_banner_image'];
				}
			  
				if( (isset($_FILES['banner_image'])) && (!empty($_FILES['banner_image']['name'])) )
				{
							if(!empty($_POST['old_banner_image'])){							
								unlink( $dir_name.'/'.$_POST['old_banner_image']);
							}
							
							if($_FILES['banner_image']['error']==0){
						//$path = 'upload/users/dc/';
					   
					//   $dir_name = 'upload/property/'.$folderName;
					 	  $this->create_dir( $dir_name );
						$file_name = time()."-".str_replace(" ","_",$_FILES['banner_image']['name']);
						
						$config['upload_path'] = $dir_name;
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['max_size'] = '1000'; 
						$config['max_width'] = '10240'; 
						$config['max_height'] = '7680';
						$config['file_name'] = $file_name;

						$this->upload->initialize($config);


						$this->load->library('upload', $config);
						
						if ($this->upload->do_upload('banner_image'))
							{
								$data = $this->upload->data();
								$front_name = $data['file_name'];
								//echo "<pre>"; print_r($data); die;
							}
							else
							{
								$errors = $this->upload->display_errors();
								$this->session->set_flashdata("error", "Front Image :".$errors);
								$this->session->set_flashdata('return',$ret_data);
								redirect(base_url().'general-setting');
							}
						}					
					}
			
			
			  $author_image ='';
			  if(isset($_POST['old_author_image']) && (!empty($_POST['old_author_image'])))
				{
					$front_name = $_POST['old_author_image'];
				}
			  
				if( (isset($_FILES['author_image'])) && (!empty($_FILES['author_image']['name'])) )
				{
							if(!empty($_POST['old_author_image'])){							
								unlink( $dir_name.'/'.$_POST['old_author_image']);
							}
							
							if($_FILES['author_image']['error']==0){
						//$path = 'upload/users/dc/';
					   
					//   $dir_name = 'upload/property/'.$folderName;
					 	  $this->create_dir( $dir_name );
						$author_image = time()."-".str_replace(" ","_",$_FILES['author_image']['name']);
						
						$config['upload_path'] = $dir_name;
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['max_size'] = '1000'; 
						$config['max_width'] = '10240'; 
						$config['max_height'] = '7680';
						$config['file_name'] = $author_image;

						$this->upload->initialize($config);


						$this->load->library('upload', $config);
						
						if ($this->upload->do_upload('author_image'))
							{
								$data = $this->upload->data();
								$author_image = $data['file_name'];
								//echo "<pre>"; print_r($data); die;
							}
							else
							{
								$errors = $this->upload->display_errors();
								$this->session->set_flashdata("error", "Author Image :".$errors);
								$this->session->set_flashdata('return',$ret_data);
								redirect(base_url().'general-setting');
							}
						}					
					}
					
			  $reviewer_image ='';
			  if(isset($_POST['old_reviewer_image']) && (!empty($_POST['old_reviewer_image'])))
				{
					$reviewer_image = $_POST['old_reviewer_image'];
				}
			  
				if( (isset($_FILES['review_image'])) && (!empty($_FILES['review_image']['name'])) )
				{
							if(!empty($_POST['old_reviewer_image'])){							
								unlink( $dir_name.'/'.$_POST['old_reviewer_image']);
							}
							
							if($_FILES['review_image']['error']==0){
						//$path = 'upload/users/dc/';
					   
					//   $dir_name = 'upload/property/'.$folderName;
					 	  $this->create_dir( $dir_name );
						$reviewer_image = time()."-".str_replace(" ","_",$_FILES['review_image']['name']);
						
						$config['upload_path'] = $dir_name;
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['max_size'] = '1000'; 
						$config['max_width'] = '10240'; 
						$config['max_height'] = '7680';
						$config['file_name'] = $reviewer_image;

						$this->upload->initialize($config);


						$this->load->library('upload', $config);
						
						if ($this->upload->do_upload('review_image'))
							{
								$data = $this->upload->data();
								$reviewer_image = $data['file_name'];
								//echo "<pre>"; print_r($data); die;
							}
							else
							{
								$errors = $this->upload->display_errors();
								$this->session->set_flashdata("error", "Reviewer Image :".$errors);
								$this->session->set_flashdata('return',$ret_data);
								redirect(base_url().'general-setting');
							}
						}					
					}
					
			  $editor_image ='';
			  if(isset($_POST['old_editor_image']) && (!empty($_POST['old_editor_image'])))
				{
					$editor_image = $_POST['old_editor_image'];
				}
			  
				if( (isset($_FILES['editor_image'])) && (!empty($_FILES['editor_image']['name'])) )
				{
							if(!empty($_POST['old_editor_image'])){							
								unlink( $dir_name.'/'.$_POST['old_editor_image']);
							}
							
							if($_FILES['editor_image']['error']==0){
						//$path = 'upload/users/dc/';
					   
					//   $dir_name = 'upload/property/'.$folderName;
					 	  $this->create_dir( $dir_name );
						$editor_image = time()."-".str_replace(" ","_",$_FILES['editor_image']['name']);
						
						$config['upload_path'] = $dir_name;
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['max_size'] = '1000'; 
						$config['max_width'] = '10240'; 
						$config['max_height'] = '7680';
						$config['file_name'] = $editor_image;

						$this->upload->initialize($config);


						$this->load->library('upload', $config);
						
						if ($this->upload->do_upload('editor_image'))
							{
								$data = $this->upload->data();
								$editor_image = $data['file_name'];
								//echo "<pre>"; print_r($data); die;
							}
							else
							{
								$errors = $this->upload->display_errors();
								$this->session->set_flashdata("error", "Editor Image :".$errors);
								$this->session->set_flashdata('return',$ret_data);
								redirect(base_url().'general-setting');
							}
						}					
					}
					
			  $publisher_image ='';
			  if(isset($_POST['old_publisher_image']) && (!empty($_POST['old_publisher_image'])))
				{
					$publisher_image = $_POST['old_publisher_image'];
				}
			  
				if( (isset($_FILES['publish_image'])) && (!empty($_FILES['publish_image']['name'])) )
				{
							if(!empty($_POST['old_publisher_image'])){							
								unlink( $dir_name.'/'.$_POST['old_publisher_image']);
							}
							
							if($_FILES['publish_image']['error']==0){
						//$path = 'upload/users/dc/';
					   
					//   $dir_name = 'upload/property/'.$folderName;
					 	  $this->create_dir( $dir_name );
						$publisher_image = time()."-".str_replace(" ","_",$_FILES['publish_image']['name']);
						
						$config['upload_path'] = $dir_name;
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['max_size'] = '1000'; 
						$config['max_width'] = '10240'; 
						$config['max_height'] = '7680';
						$config['file_name'] = $publisher_image;

						$this->upload->initialize($config);


						$this->load->library('upload', $config);
						
						if ($this->upload->do_upload('publish_image'))
							{
								$data = $this->upload->data();
								$publisher_image = $data['file_name'];
								//echo "<pre>"; print_r($data); die;
							}
							else
							{
								$errors = $this->upload->display_errors();
								$this->session->set_flashdata("error", "Publisher Image :".$errors);
								$this->session->set_flashdata('return',$ret_data);
								redirect(base_url().'general-setting');
							}
						}					
					}
					
			
			
				$where =  array("id"=>'1');
				$update_data  =  array(
										'email'=>$email,
										'Phone_no'=>$Phone_no,
										'address'=>$address,
										'footer_copy'=>$footer_copy,
										'meta_title'=>$meta_title,
										'meta_keyword'=>$meta_keyword,
										'meta_desc'=>$meta_desc,
										'guide_author'=>$guide_author,
										'banner_image'=>$front_name,
										'publish_image'=>$publisher_image,
										'author_image'=>$author_image,
										'review_image'=>$reviewer_image,
										'editor_image'=>$editor_image
										);
				$query = $this->user_model->update_data('tbl_admin',$update_data,$where);
				$this->session->set_flashdata("sucess","Successfully Updated.");
				redirect('administrator//general-setting');
		
	}
	
}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */
