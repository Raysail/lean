<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class  Article extends CI_Controller {

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
	
		
	
	function create_dir( $dir_name ){

		$filename = $dir_name . "/";
		if (!file_exists($filename)) {
		mkdir( $dir_name,0755,TRUE );
		}
	}
	
	
	
	public function author_guide()
	{
	
		$data['user_id'] = $user_id   = $this->session->userdata( 'userid' );
		$data['admin_setting'] =$this->user_model->get_row_with_con('tbl_admin',array('id'=>'1'));
		
	
		$this->load->view( 'header' );
		$this->load->view( 'author/author_guide',$data);
		$this->load->view( 'footer');			
	}
	
	
	public function new_article()
	{		
		$data['user_id'] = $user_id   = $this->session->userdata( 'userid' );
		$data['article_type'] =$this->user_model->select_query('*','tbl_article_type',array('atype_status'=>'1'),'atype_id','asc');
		
		$data['classify'] =$this->user_model->select_query('*','tbl_article_classified',array('asubmi_status'=>'1'),'asubmi_id','desc');
																
		$data['user_data'] =$this->user_model->get_row_with_con('tbl_users',array('user_id'=>$user_id));
		$data['from_page'] = $this->uri->segment(1);
	
		$this->load->view( 'header' );
		$this->load->view( 'author/new_submission',$data);
		$this->load->view( 'footer');			
		
	}
	
	function update_article()
	{
		$art_no = 0;
		$data['user_id'] = $user_id   = $this->session->userdata( 'userid' );
		$data['article_type'] =$this->user_model->select_query('*','tbl_article_type',array('atype_status'=>'1'),'atype_id','asc');
		$data['classify'] =$this->user_model->select_query('*','tbl_article_classified',array('asubmi_status'=>'1'),'asubmi_id','desc');	
		$data['user_data'] =$this->user_model->get_row_with_con('tbl_users',array('user_id'=>$user_id));
		

		
		
		if($this->uri->segment(2))
		{
		
		
			$data['from_page'] = $this->uri->segment(1);
			$art_no = $this->uri->segment(2);
			$data['article_data'] =$this->user_model->get_row_with_con('tbl_article',
																	array('art_no'=>$art_no,
																		  'art_userid'=>$user_id));
			$data['art_no'] = $art_no;
			
			
			$data['other_author'] =$this->user_model->select_query('*','tbl_other_author',array(
																'oa_art_id'=>$data['article_data']->art_id,
																'oa_userid'=>$user_id
																),'oa_order','asc');
																
			$data['invite_frnds'] =$this->user_model->select_query('*','tbl_invite_frnds',array(
																'frnd_artid'=>$data['article_data']->art_id,
																'frnd_userid'=>$user_id
																),'','');
			if(!empty($data['article_data']))
			{
				$this->load->view( 'header' );
				$this->load->view( 'author/update_submission',$data);
				$this->load->view( 'footer');
			}
			else
			{
				 redirect('user-dashboard');
			}
		}
		else
		{
			 redirect('user-dashboard');
		}
					
		
		
	}
	
	
	public function submit_article()
	{
	
		/*echo '<pre>';
		print_r($_POST);
		print_r($_FILES);
		exit;*/
		
		$tbl_name = "tbl_article_type";
		$user_id   = $this->session->userdata( 'userid' );
		
		extract($this->input->post());
		
	   $art_type='';
       $art_fulltitle='';
       $art_abstract='';
       $art_keyword='';
       $art_cover='';
       $art_menuscript='';
       $art_figure='';
       $art_slide='';
       $art_supple='';
       $art_response='';
	   
	   $data_update = '';
		if(isset($_POST['art_type']) && (!empty($_POST['art_type'])))
		{
			if(isset($_POST['art_id'])&& ($_POST['art_id']>0))
			{
				
			   $art_type=$_POST['art_type'];
			  $data_update = array('art_type'=>$art_type,'art_userid'=>$user_id,'art_update'=>date('Y-m-d'));
			  
			}
			else
			{	
			 
				$art_type=$_POST['art_type'];
				
				$toalt_rec =  $this->user_model->check_no_rec('tbl_article',array('art_dateadd'=>date('Y-m-d')));
				$art_no = '';
				if($toalt_rec<10){ $art_no = date('Ymd').'00'.($toalt_rec+1);}	
				elseif(($toalt_rec>9)&& ($toalt_rec<100)){ $art_no = date('Ymd').'0'.($toalt_rec+1);}		
				else{ $art_no = date('Ymd').($toalt_rec+1);}	
				
			  $data_update = array('art_type'=>$art_type,'art_userid'=>$user_id,'art_no'=>$art_no,'art_dateadd'=>date('Y-m-d'));
			
			}
		}
		if(isset($_POST['art_fulltitle']) && (!empty($_POST['art_fulltitle'])))
		{
			  $art_fulltitle=$_POST['art_fulltitle'];			  
			  $data_update = array('art_fulltitle'=>$art_fulltitle,'art_userid'=>$user_id);
		}
		if(isset($_POST['art_abstract']) && (!empty($_POST['art_abstract'])))
		{
			  $art_abstract=$_POST['art_abstract'];			  
			  $data_update = array('art_abstract'=>$art_abstract,'art_userid'=>$user_id);
		}
		
		
		if(isset($_POST['art_keyword']) && (!empty($_POST['art_keyword'])))
		{
		
			$art_key = $_POST['art_keyword'];
			  
			  $data_update = array('art_keyword'=>$art_key,'art_userid'=>$user_id);
			  
		}
		
		
		
		
		
		if ((isset($_FILES['art_scheme'])) && (!empty($_FILES['art_scheme']['name'])))
		{
		
			$art_scheme='';
			
			$folderName = 'author-'.$this->session->userdata('userid');
			
			 $dir_name = 'upload/article/'.$folderName;
			 
			  /* SCHENE DOC*/
			  
			 if(!empty($_FILES['art_scheme']['name']) && ($_FILES['art_scheme']['error']==0))
			 {
			 		 	 $this->create_dir( $dir_name );
						$file_name = time()."-".str_replace(" ","_",$_FILES['art_scheme']['name']);
						
						$config['upload_path'] = $dir_name;
						$config['allowed_types'] = 'png|jpeg|jpg|gif';
						$config['file_name'] = $file_name;

						$this->upload->initialize($config);
						$this->load->library('upload', $config);
						if ($this->upload->do_upload('art_scheme'))
						{
							$data = $this->upload->data();
							$art_scheme = $data['file_name'];
						}
			 }
			 
			  
			   $data_update = array('art_scheme'=>$art_scheme);
			  
		}
		
		
		
		
		
		if ( 
			(isset($_FILES['art_cover']) && (!empty($_FILES['art_cover']['name']))) || 
			(isset($_FILES['art_menuscript']) && (!empty($_FILES['art_menuscript']['name']))) ||
			(isset($_FILES['art_figure']) && (!empty($_FILES['art_figure']['name'])))	||	   
			(isset($_FILES['art_slide']) && (!empty($_FILES['art_slide']['name']))) ||
			(isset($_FILES['art_supple']) && (!empty($_FILES['art_supple']['name']))) ||
			(isset($_FILES['art_response']) && (!empty($_FILES['art_response']['name'])))
			)
		{
		
			$art_cover='';
			$art_menuscript='';
			$art_figure='';
			$art_slide='';
			$art_supple='';
			$art_response='';
			
			$folderName = 'author-'.$this->session->userdata('userid');
			
			 $dir_name = 'upload/article/'.$folderName;
			 
			  /* COVER DOC*/
			  
			 if(!empty($_FILES['art_cover']['name']) && ($_FILES['art_cover']['error']==0))
			 {
			 		 	 $this->create_dir( $dir_name );
						$file_name = time()."-".str_replace(" ","_",$_FILES['art_cover']['name']);
						
						$config['upload_path'] = $dir_name;
						$config['allowed_types'] = 'docx|doc';
						$config['file_name'] = $file_name;

						$this->upload->initialize($config);
						$this->load->library('upload', $config);
						if ($this->upload->do_upload('art_cover'))
						{
							$data = $this->upload->data();
							$art_cover = $data['file_name'];
							
							$data_update['art_cover'] = $art_cover;
						}
			 }
			 
			 
			/* MENU SCRIPT DOC*/
			 if(!empty($_FILES['art_menuscript']['name']) && ($_FILES['art_menuscript']['error']==0))
			 {
			 		 	 $this->create_dir( $dir_name );
						$file_name = time()."-".str_replace(" ","_",$_FILES['art_menuscript']['name']);
						
						$config['upload_path'] = $dir_name;
						$config['allowed_types'] = 'docx|doc';
						$config['file_name'] = $file_name;

						$this->upload->initialize($config);
						$this->load->library('upload', $config);
						if ($this->upload->do_upload('art_menuscript'))
						{
							$data = $this->upload->data();
							$art_menuscript = $data['file_name'];
							
							$data_update['art_menuscript'] = $art_menuscript;
						}
			 }
			  
			  
			 
			/* FIGURE DOC*/
			 if(!empty($_FILES['art_figure']['name']) && ($_FILES['art_figure']['error']==0))
			 {
			 		 	 $this->create_dir( $dir_name );
						$file_name = time()."-".str_replace(" ","_",$_FILES['art_figure']['name']);
						
						$config['upload_path'] = $dir_name;
						$config['allowed_types'] = 'docx|doc';
						$config['file_name'] = $file_name;

						$this->upload->initialize($config);
						$this->load->library('upload', $config);
						if ($this->upload->do_upload('art_figure'))
						{
							$data = $this->upload->data();
							$art_figure = $data['file_name'];
							
							$data_update['art_figure'] = $art_figure;
						}
			 }
			  
			 
			/* SLIDER DOC*/
			 if(!empty($_FILES['art_slide']['name']) && ($_FILES['art_slide']['error']==0))
			 {
			 		 	 $this->create_dir( $dir_name );
						$file_name = time()."-".str_replace(" ","_",$_FILES['art_slide']['name']);
						
						$config['upload_path'] = $dir_name;
						$config['allowed_types'] = 'docx|doc|ppt|pptx';
						$config['file_name'] = $file_name;

						$this->upload->initialize($config);
						$this->load->library('upload', $config);
						if ($this->upload->do_upload('art_slide'))
						{
							$data = $this->upload->data();
							$art_slide = $data['file_name'];
							
							$data_update['art_slide'] = $art_slide;
						}
			 }
			  
			 
			/* SUPPLE DOC*/
			 if(!empty($_FILES['art_supple']['name']) && ($_FILES['art_supple']['error']==0))
			 {
			 		 	 $this->create_dir( $dir_name );
						$file_name = time()."-".str_replace(" ","_",$_FILES['art_supple']['name']);
						
						$config['upload_path'] = $dir_name;
						$config['allowed_types'] = 'docx|doc';
						$config['file_name'] = $file_name;

						$this->upload->initialize($config);
						$this->load->library('upload', $config);
						if ($this->upload->do_upload('art_supple'))
						{
							$data = $this->upload->data();
							$art_supple = $data['file_name'];
							
							$data_update['art_supple'] = $art_supple;
						}
			 }
			  
			/* RESPONCE DOC*/
			 if(!empty($_FILES['art_response']['name']) && ($_FILES['art_response']['error']==0))
			 {
			 		 	 $this->create_dir( $dir_name );
						$file_name = time()."-".str_replace(" ","_",$_FILES['art_response']['name']);
						
						$config['upload_path'] = $dir_name;
						$config['allowed_types'] = 'docx|doc';
						$config['file_name'] = $file_name;

						$this->upload->initialize($config);
						$this->load->library('upload', $config);
						if ($this->upload->do_upload('art_response'))
						{
							$data = $this->upload->data();
							$art_response = $data['file_name'];
							$data_update['art_response'] = $art_response;
						}
			 }
			 
			 
			 
			  
			/*   $data_update = array(	'art_cover'=>$art_cover,
			   							'art_menuscript'=>$art_menuscript,
			   							'art_figure'=>$art_figure,
			   							'art_slide'=>$art_slide,
			   							'art_supple'=>$art_supple,
										'art_response'=>$art_response);*/
			  
		}
		
		
		
		
		
		
		
		if(isset($_POST['art_id'])&& ($_POST['art_id']>0))
		{
			$where = array('art_id'=>$_POST['art_id'],'art_userid'=>$user_id);
			if(!empty($data_update)){
				$query = $this->user_model->update_query($data_update,'tbl_article',$where);
			//	echo $this->db->last_query();
				echo $_POST['art_id'];	
			}
			else
			{
				echo $_POST['art_id'];
			}
		}
		else
		{
			$query =$this->user_model->insert_data('tbl_article',$data_update);
			
			
			
			  /*Other data Insert in autor table*/
			  $user_data =$this->user_model->get_row_with_con('tbl_users',array('user_id'=>$user_id));
			  
			  	
			  		 $data_other_author = array('oa_art_id'=>$query,
		 					  'oa_userid'=>$user_id,
		 					  'oa_fname'=>$user_data->user_fname,
		 					  'oa_lname'=>$user_data->user_lname,
		 					  'oa_affiliation'=>$user_data->user_instiute,
		 					  'oa_email'=>$user_data->user_email,
		 					  'oa_order'=>'1',
							  'oa_author'=>'1',
		 					  'oa_dateadd'=>date('Y-m-d'),
							  'oa_updated'=>date('Y-m-d'));
					$query1 =$this->user_model->insert_data('tbl_other_author',$data_other_author); 
		
		
		
		
			echo $query;
		
		}
		
		
		
		
	}
	
	public function get_author()
	{
		$other_data_html ='';
		extract($this->input->post());
		$user_id   = $this->session->userdata( 'userid' );
		$other_author =$this->user_model->select_query('*','tbl_other_author',array(
																'oa_art_id'=>$oa_art_id,
																'oa_userid'=>$user_id
																),'oa_order','asc');
		if(!empty($other_author))
		{
			foreach($other_author as $list_author)
			{
			
				$other_data_html .='<div id="'.$list_author->oa_id.'" class="other_author">
					<div class="col-md-3">
                          <div class="tab_two_sec_buttom">
                            <p class="sec_active">';
							if($list_author->oa_order!='1'){		
				$other_data_html .='<a href="javascript:void(0);" class="order_down"
										 data-autid="'.$list_author->oa_id.'"
										 data-artid="'.$list_author->oa_art_id.'"
										 data-order="'.$list_author->oa_order.'"><img src="'. base_url().'design/down.png" /></a>&nbsp;';
								}		 									
				$other_data_html .=$list_author->oa_fname.'&nbsp;'.$list_author->oa_lname.'&nbsp;
							<a href="javascript:void(0);" class="order_up"
										 data-autid="'.$list_author->oa_id.'"
										 data-artid="'.$list_author->oa_art_id.'"
										 data-order="'.$list_author->oa_order.'"><img src="'. base_url().'design/up.png" /></a>
										 </p>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="tab_two_sec_buttom">
                            <p>'.$list_author->oa_affiliation.' </p>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="tab_two_sec_buttom">
                            <p>'.$list_author->oa_email.' </p>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="tab_two_sec_buttom">
                            <p>';
							
							if($list_author->oa_author!='1'){
							$other_data_html .=	' <a href="#" class="edit_author" 
										 data-autid="'.$list_author->oa_id.'"
										 data-artid="'.$list_author->oa_art_id.'" 
										 data-fname="'.$list_author->oa_fname.'"
										 data-lname="'.$list_author->oa_lname.'" 
										 data-affi="'.$list_author->oa_affiliation.'" 
										 data-mail="'.$list_author->oa_email.'">
										 <i class="fa fa-pencil"></i></a>&nbsp;
										 
										 <a href="#" class="del_author"
										 data-autid="'.$list_author->oa_id.'"
										 data-artid="'.$list_author->oa_art_id.'">X</a>&nbsp;';
								}else{ $other_data_html .= '&nbsp;';}
								$other_data_html .=	'</p>
                          </div>
                        </div>
						</div>';
				
			}
			
		}	
		
		echo $other_data_html;													
																		
	}
	
	
	
	
	
	public function submit_other_author()
	{
		extract($this->input->post());
		
		
		
		$sort_order = 1;
		//$oder_data =$this->user_model->get_row_with_con('tbl_other_author',array('oa_art_id'=>$oa_art_id),'oa_id','desc');
		
		
			$oder_data = '';
		$oder_data = $this->user_model->select_query('max(`oa_order`) as oaorder','tbl_other_author',array('oa_art_id'=>$oa_art_id),'','');
					
		if(!empty($oder_data))			
		{
			$sort_order = ($oder_data[0]->oaorder+1);
		}
			
		$data_update['oa_art_id'] =$oa_art_id;
		$data_update['oa_userid'] =$oa_userid;
		$data_update['oa_fname'] =$oa_fname;
		$data_update['oa_lname'] =$oa_lname;
		$data_update['oa_affiliation'] =$oa_affiliation;
		$data_update['oa_email'] =$oa_email;
		$data_update['oa_dateadd'] =date('Y-m-d');
		$data_update['oa_updated'] =date('Y-m-d');
		
	/*	 $data_update = array('oa_art_id'=>$oa_art_id,
		 					  'oa_userid'=>$oa_userid,
		 					  'oa_fname'=>$oa_fname,
		 					  'oa_lname'=>$oa_lname,
		 					  'oa_affiliation'=>$oa_affiliation,
		 					  'oa_email'=>$oa_email,
		 					  'oa_order'=>$sort_order,
		 					  'oa_dateadd'=>date('Y-m-d'),
							  'oa_updated'=>date('Y-m-d'));*/
							  
		 if(isset($_POST['oa_id'])&& ($_POST['oa_id']>0))
		{
			$where = array('oa_id'=>$_POST['oa_id'],'oa_art_id'=>$oa_art_id);
			$query = $this->user_model->update_query($data_update,'tbl_other_author',$where);
			
		$curt_ord_data=$this->user_model->get_row_with_con('tbl_other_author',array('oa_art_id'=>$oa_art_id));
			
			$new_html ='';
			
			 		$new_html ='<div class="col-md-3">
                          <div class="tab_two_sec_buttom">
                            <p class="sec_active">
							 <a href="javascript:void(0);" class="order_down"
										 data-autid="'.$_POST['oa_id'].'"
										 data-artid="'.$oa_art_id.'"
										 data-order="'.$curt_ord_data->oa_order.'"><img src="'. base_url().'design/down.png" /></a>&nbsp;
										 '.$oa_fname.'&nbsp;'.$oa_lname.'&nbsp;
							<a href="javascript:void(0);" class="order_up"
										 data-autid="'.$_POST['oa_id'].'"
										 data-artid="'.$oa_art_id.'"
										 data-order="'.$curt_ord_data->oa_order.'"><img src="'. base_url().'design/up.png" /></a>
										 
										
										  </p>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="tab_two_sec_buttom">
                            <p>'.$oa_affiliation.' </p>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="tab_two_sec_buttom">
                            <p>'.$oa_email.' </p>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="tab_two_sec_buttom">
                            <p> <a href="#" class="edit_author" 
										 data-autid="'.$_POST['oa_id'].'"
										 data-artid="'.$oa_art_id.'" 
										 data-fname="'.$oa_fname.'"
										 data-lname="'.$oa_lname.'" 
										 data-affi="'.$oa_affiliation.'" 
										 data-mail="'.$oa_email.'">
										 <i class="fa fa-pencil"></i></a>
										 
										 <a href="#" class="del_author"
										 data-autid="'.$_POST['oa_id'].'"
										 data-artid="'.$oa_art_id.'">X</a>										 
										 </p>
                          </div>
                        </div>';
			
			
				
			echo $new_html;
		}
		else
		{
		
			$data_update['oa_order'] =$sort_order;
			$query1 =$this->user_model->insert_data('tbl_other_author',$data_update);
						
			$new_html ='';
			
			 		$new_html ='<div id="'.$query1.'" class="other_author">
					<div class="col-md-3">
                          <div class="tab_two_sec_buttom">
                            <p class="sec_active"> <a href="javascript:void(0);" class="order_down"
										  data-autid="'.$query1.'"
										 data-artid="'.$oa_art_id.'"
										 data-order="'.$sort_order.'"><img src="'. base_url().'design/down.png" /></a>&nbsp;
										 '.$oa_fname.'&nbsp;'.$oa_lname.'&nbsp;
							<a href="javascript:void(0);" class="order_up"
										data-autid="'.$query1.'"
										 data-artid="'.$oa_art_id.'"
										 data-order="'.$sort_order.'"><img src="'. base_url().'design/up.png" /></a></p>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="tab_two_sec_buttom">
                            <p>'.$oa_affiliation.' </p>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="tab_two_sec_buttom">
                            <p>'.$oa_email.' </p>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="tab_two_sec_buttom">
                            <p>
							 <a href="#" class="edit_author" 
										 data-autid="'.$query1.'"
										 data-artid="'.$oa_art_id.'" 
										 data-fname="'.$oa_fname.'"
										 data-lname="'.$oa_lname.'" 
										 data-affi="'.$oa_affiliation.'" 
										 data-mail="'.$oa_email.'">
										 <i class="fa fa-pencil"></i></a>
										 
										 <a href="#" class="del_author"
										 data-autid="'.$query1.'"
										 data-artid="'.$oa_art_id.'">X</a>
							</p>
                          </div>
                        </div>
						</div>';
						
						echo $new_html;
			
		
		}
		
		
		
		 
	}
	
	public function delete_author()
	{
		extract($this->input->post());
		$user_id   = $this->session->userdata( 'userid' );
		
		$where_condition = array('oa_id'=>$oa_id,'oa_art_id'=>$oa_art_id);	
		
		$curt_ord_data=$this->user_model->get_row_with_con('tbl_other_author',$where_condition);		
		$curr_oser_id =$curt_ord_data->oa_order;
			 
		$where2 = "oa_order > ".$curr_oser_id." AND oa_art_id = ".$oa_art_id;
		
		$points = 1;
		$this->db->set('oa_order', 'oa_order - ' . (int) $points, FALSE);		
		$this->db->where($where2);
		$this->db->update('tbl_other_author');
		
		$query =$this->user_model->delete_query('tbl_other_author',$where_condition);	
	}
	
	public function update_ordertype()
	{
		
		//echo '<pre>';
		//print_r($_POST);
		
		
		extract($this->input->post());
		if($_POST['order_type']=='up'){
		  // 
			$data_update2= array("oa_order"=>($_POST['ou_order']));
			$where2= array('oa_order'=>($ou_order-1),'oa_art_id'=>$ou_artid,'oa_id != '=>$ou_id);
			$query2= $this->user_model->update_query($data_update2,'tbl_other_author',$where2);
		 /// 
			$data_update1= array("oa_order"=>($ou_order-1));
			$where1 = array('oa_id'=>$ou_id,'oa_art_id'=>$ou_artid);
			$query1 = $this->user_model->update_query($data_update1,'tbl_other_author',$where1);
		}
		if($_POST['order_type']=='down'){
		
		$oder_data =$this->user_model->get_row_with_con('tbl_other_author',
					array('oa_art_id'=>$ou_artid),'oa_id','desc');
			
			//print_r($oder_data);
			
			if($oder_data->oa_order!=$_POST['ou_order'])
			{
				 // 
					$data_update2= array("oa_order"=>($_POST['ou_order']));
					$where2= array('oa_order'=>($ou_order+1),'oa_art_id'=>$ou_artid,'oa_id != '=>$ou_id);
					$query2= $this->user_model->update_query($data_update2,'tbl_other_author',$where2);
				 /// 
					$data_update1= array("oa_order"=>($ou_order+1));
					$where1 = array('oa_id'=>$ou_id,'oa_art_id'=>$ou_artid);
					$query1 = $this->user_model->update_query($data_update1,'tbl_other_author',$where1);
				
			}
		}
		
	}
	
	
	public function keyword_sudmission()
	{
		extract($this->input->post());
		$user_id   = $this->session->userdata( 'userid' );
		
		$where = array('art_id'=>$_POST['art_id'],'art_userid'=>$user_id);
		$data_update= array('art_keyword'=>$art_keyword);		
	
		$query = $this->user_model->update_query($data_update,'tbl_article',$where);
			
				$new_html ='';
				$new_html ='<span class="tab_fiv">'.$art_keyword_tep.'<a href="#" class="del_key" data-name="'.$art_keyword_tep.'" data-artid="'.$_POST['art_id'].'">X</a></span><br>';
				
				echo $new_html;			
		 
	}
	
	public function update_key_sudmission()
	{
		extract($this->input->post());
		$user_id   = $this->session->userdata( 'userid' );
		
		 $get_all_keys='';
		  $set_all_images = '';
		  
		$table_name 	 = 'tbl_article';
		$where_condition = array('art_id'=>$_POST['art_id'],'art_userid'=>$user_id);
		
		$get_all_key =  $this->user_model->get_row_with_con(  $table_name, $where_condition);
		
		$get_keys_arr = explode(',', $get_all_key->art_keyword);
		 foreach ($get_keys_arr as $key => $value){
			if ($get_keys_arr[$key] == $key_name){
				unset($get_keys_arr[$key]);
			}
		}
		 $get_all_keys = array_values($get_keys_arr);
		 $set_all_keys = implode(',',$get_all_keys);		 
		 $data_update = array('art_keyword' => $set_all_keys );
		 $query = $this->user_model->update_query($data_update,'tbl_article',$where_condition);
		 echo $set_all_keys;
	}
	
	
	public function final_submission()
	{
		/*echo '<pre>';
	
		print_r($_POST);
		print_r($_FILES);
		exit;*/
		
		$copy = $this->user_model->get_row_with_con('tbl_admin',array('id'=>1));
		
		extract($this->input->post());
		$user_id   = $this->session->userdata( 'userid' );
		
		  
		$table_name 	 = 'tbl_article';
		$where_condition = array('art_id'=>$_POST['art_id'],'art_userid'=>$user_id);
		
		$get_all_key =  $this->user_model->get_row_with_con(  $table_name, $where_condition);
		
		
	   
		if( (!empty($get_all_key->art_type)) && (!empty($get_all_key->art_fulltitle)) &&
			(!empty($get_all_key->art_abstract)) && (!empty($get_all_key->art_scheme)) && (($from_name=='update-mainscript')  || ($from_name=='post-manuscript')))
		{
		
			
			
				$user_data=$this->user_model->get_row_with_con('tbl_users',array('user_id'=>$user_id));
				$user_fname = $user_data->user_fname;
				$user_lname = $user_data->user_lname;
				
				
				$copy = $this->user_model->get_row_with_con('tbl_admin',array('id'=>1));
						
				
				$to = $user_data->user_email;
				$subject = 'Author complete the project submission ';
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
												 <p style='font-size: 15px; font-family:Tahoma, Geneva, sans-serif; color: #646161'>Thank you for submitting your manuscript,".$get_all_key->art_fulltitle.", to Lean Corrosion. You have completed the submission of manuscript.   <br><br>If you wish to check the process of manuscriptand, please click the button of login to your account below:<br><br>
												 												 
		<a href='".base_url()."login'><button type='button' style='background: #00CC33;border: none;padding:1% 2%;color: #fff; letter-spacing: 1px;margin: 0% 0% 1%;cursor: pointer;font-size: 16px;border-radius: 4px;'>  Author main meun</button></a>
												 
												 <br>
	Please note, your user ID and password are the same for Lean Corrosion as author and reviewer.
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
				
				
				
		
		
				$data_update = array('art_status'=>'1'); // status 1 for being process
				$query = $this->user_model->update_query($data_update,'tbl_article',$where_condition);
				
		}
		elseif( (!empty($get_all_key->art_type)) && (!empty($get_all_key->art_fulltitle)) &&
			(!empty($get_all_key->art_abstract)) && (!empty($get_all_key->art_scheme)) && ($from_name=='update-mainscript-edtrequest'))
		{
		
			/*$select_filed = '*';	
			$tbl_name= 'tbl_article_message';	
			$where_condition_msg = "art_id = '".$_POST['art_id']."' AND art_status = '3'"; 
			$order_by_field = 'id';
			$order_by_type ='desc';
			$group_by_field = 'id';
		
		
		$all_msg= $this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition_msg, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field);*/
		
			$where_condition_msg = "art_id = '".$_POST['art_id']."' AND art_status = '3'"; 
		$msg_update  = array("again_send" => '1');
		
		$query_update = $this->user_model->update_query($msg_update,'tbl_article_message',$where_condition_msg);
		
			$art_status =17;
			$get_editor =  $this->user_model->get_row_with_con('tbl_users',array("user_type"=>'2'));
		 	$art_message = "Author submitted the revised manuscript and response report of editor.";
				 $inset_data  = 	array("art_id"=>$_POST['art_id'],
										  "art_status"=>$art_status,
										  "from_type"=>'A',
										  "to_type"=>'E',
										  "from_id"=>$this->session->userdata('userid'),
										  "to_id"=>$get_editor->user_id,
										  "message"=>$art_message,
										  "proof_file"=>'',
										  "date"=>date('Y-m-d')
								  );
			
										
							$insert = $this->user_model->insert_data('tbl_article_message',$inset_data);
							
							
							
							/* EDITOR EMAIL */
								
							 $to_editor = $get_editor->user_email;
							$subject_editor = 'Author revise and update manuscript';
							$message_editor = "							
							<html>
							<head>
							<title>".$subject_editor."</title>
							</head>
							<body>
							<div  style='width:700px; float:left;'>
  <div  style='width: 98%;float: left;background: #F7F7F7;padding: 1%;border-radius: 4px;border-top: 3px solid #ee4723;'>
  <div > <img src='".base_url()."design/front/images/logo.png'/> </div> 
								<p style='font-size: 17px; font-family:Tahoma, Geneva, sans-serif;'>Dear ".$get_editor->user_fname.'&nbsp;'.$get_editor->user_lname.", </p>
							 <p style='font-size: 15px; font-family:Tahoma, Geneva, sans-serif; color: #646161'>";
							$message_editor .= 'The author of manuscript, "'.$get_all_key->art_fulltitle.'",  have submitted the revised manuscript and response report of editor.<br>,To access just the manuscript for review directly, click the link below:<br><br>';
							$message_editor .="<a href='".base_url()."login'><button type='button' style='background: #00CC33;border: none;padding:1% 2%;color: #fff; letter-spacing: 1px;margin: 0% 0% 1%;cursor: pointer;font-size: 16px;border-radius: 4px;'>Editor main menu</button></a><br><br>";
							 $message_editor .="Or Please log into the journal System at ".base_url()." as a Editor to access the manuscript and submit your review online.<br>
							 
With kind regards,<br><br>
Yours sincerely,<br>
Lean Corrosion Editorial Office<br>
leancorrosion@lean.com<br>
<br><br>
							</p>
							 </div>
  <div  style='width:100%;float:left; background:#ee4723; padding:0%; color:#fff; text-align:center;'>
    <p>".$copy->footer_copy."</p>
  </div>
</div>
							</body>
							</html>
							";
					
							$result_editor = chatroomemail($to_editor,MAILFROM,MAILFROMNAME,$subject_editor,$message_editor);
							/* EDITOR EMAIL END */
							
				
				
				
				$query =$_POST['art_id'];
		}
		elseif( (!empty($get_all_key->art_type)) && (!empty($get_all_key->art_fulltitle)) &&
			(!empty($get_all_key->art_abstract)) && (!empty($get_all_key->art_scheme)) && ($from_name=='revission-update-mainscript'))
		{
		
			$art_status =9;
			$get_editor =  $this->user_model->get_row_with_con('tbl_users',array("user_type"=>'2'));
		 	$art_message = "Author submitted the revised manuscript and response report of reviewer.";
				 $inset_data  = 	array("art_id"=>$_POST['art_id'],
										  "art_status"=>$art_status,
										  "from_type"=>'A',
										  "to_type"=>'E',
										  "from_id"=>$this->session->userdata('userid'),
										  "to_id"=>$get_editor->user_id,
										  "message"=>$art_message,
										  "proof_file"=>'',
										  "date"=>date('Y-m-d')
								  );
			
										
							$insert = $this->user_model->insert_data('tbl_article_message',$inset_data);
							
							
							
							/* EDITOR EMAIL */
								
							 $to_editor = $get_editor->user_email;
							$subject_editor = 'Author revise and update manuscript';
							$message_editor = "							
							<html>
							<head>
							<title>".$subject_editor."</title>
							</head>
							<body>
							<div  style='width:700px; float:left;'>
  <div  style='width: 98%;float: left;background: #F7F7F7;padding: 1%;border-radius: 4px;border-top: 3px solid #ee4723;'>
  <div > <img src='".base_url()."design/front/images/logo.png'/> </div> 
								<p style='font-size: 17px; font-family:Tahoma, Geneva, sans-serif;'>Dear ".$get_editor->user_fname.'&nbsp;'.$get_editor->user_lname.", </p>
							 <p style='font-size: 15px; font-family:Tahoma, Geneva, sans-serif; color: #646161'>";
							$message_editor .= 'The author of manuscript, "'.$get_all_key->art_fulltitle.'",  havesubmitted the revised manuscript and response report of reviewer.<br>,To access just the manuscript for review directly, click the link below:<br><br>';
							$message_editor .="<a href='".base_url()."login'><button type='button' style='background: #00CC33;border: none;padding:1% 2%;color: #fff; letter-spacing: 1px;margin: 0% 0% 1%;cursor: pointer;font-size: 16px;border-radius: 4px;'>Editor main menu</button></a><br><br>";
							 $message_editor .="Or Please log into the journal System at ".base_url()." as a Editor to access the manuscript and submit your review online.<br>
							 
With kind regards,<br><br>
Yours sincerely,<br>
Lean Corrosion Editorial Office<br>
leancorrosion@lean.com<br>
<br><br>
							</p>
							 </div>
  <div  style='width:100%;float:left; background:#ee4723; padding:0%; color:#fff; text-align:center;'>
    <p>".$copy->footer_copy."</p>
  </div>
</div>
							</body>
							</html>
							";
					
							$result_editor = chatroomemail($to_editor,MAILFROM,MAILFROMNAME,$subject_editor,$message_editor);
							/* EDITOR EMAIL END */
							
				
				
				
			$select_filed = 'a.*,u.*';	
			$tbl_name= 'tbl_assgin_reviewer as  a ';	
			$where_condition_reviewer = "a.asign_artid='".$_POST['art_id']."' AND (a.asign_status='1' AND  a.assign_submit='1')"; 
			$order_by_field = 'a.asign_artid';
			$order_by_type ='desc';
			$group_by_field = 'a.asgin_id';
			$join_tbl1 = 'tbl_users as u'; 
			$join_type1 = 'left'; 
			$join_condition1 = 'u.user_id=a.asign_userid';
		
		
		$reviewer_data= $this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition_reviewer, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field, $join_tbl1, $join_type1, $join_condition1);
						
					
					
						if(!empty($reviewer_data))	
						{
							foreach($reviewer_data as $reviewer_list)
							{
								
							
							 $to_review = $reviewer_list->user_email;
							$subject = 'Author revise and update manuscript';
							$message_review = "							
							<html>
							<head>
							<title>".$subject."</title>
							</head>
							<body>
							<div  style='width:700px; float:left;'>
  <div  style='width: 98%;float: left;background: #F7F7F7;padding: 1%;border-radius: 4px;border-top: 3px solid #ee4723;'>
  <div > <img src='".base_url()."design/front/images/logo.png'/> </div> 
								<p style='font-size: 17px; font-family:Tahoma, Geneva, sans-serif;'>Dear ".$reviewer_list->user_fname.'&nbsp;'.$reviewer_list->user_lname.", </p>
							 <p style='font-size: 15px; font-family:Tahoma, Geneva, sans-serif; color: #646161'>";
							$message_review .= 'The manuscript "'.$get_all_key->art_fulltitle.'", have submitted the revised manuscript and response report of reviewer. To access just the manuscript for review directly with enter log in details, click the link below:<br><br>';
							$message_review .="<a href='".base_url()."login'>  <button type='button' style='background: #00CC33;border: none;padding:1% 2%;color: #fff; letter-spacing: 1px;margin: 0% 0% 1%;cursor: pointer;font-size: 16px;border-radius: 4px;'>Reviewer main menu</button></a>";
							 $message_review .="Or Please log into the journal System at ".base_url()." as a Reviewer to access the manuscript and submit your review online.<br>

Your username is: ".$reviewer_list->user_email."<br>

Your password is: ".$reviewer_list->user_invitepass."<br>

With kind regards,<br><br>
Yours sincerely,<br>
Lean Corrosion Editorial Office<br>
leancorrosion@lean.com<br>
<br><br>
							</p>
							 </div>
  <div  style='width:100%;float:left; background:#ee4723; padding:0%; color:#fff; text-align:center;'>
    <p>".$copy->footer_copy."</p>
  </div>
</div>
							</body>
							</html>
							";
					
							$result = chatroomemail($to_review,MAILFROM,MAILFROMNAME,$subject,$message_review);
							}
						}
			
				$data_update = array('art_status'=>'9'); // status 1 for being process
				$query = $this->user_model->update_query($data_update,'tbl_article',$where_condition);
		}
		elseif( (!empty($get_all_key->art_type)) && (!empty($get_all_key->art_fulltitle)) &&
			(!empty($get_all_key->art_abstract)) && (!empty($get_all_key->art_scheme)) && ($from_name=='update-mainscript-pubrequest'))
		{
			
				$data_update = array('art_status'=>'9'); // status 1 for being process
				$query = $this->user_model->update_query($data_update,'tbl_article',$where_condition);
		}
		
		
		
		
		
		
		
		
		
		//	 redirect('user-dashboard');
		
		
	}
	
	
	public function article_invite_frnds()
	{
			
		
		extract($this->input->post());
		$user_id   = $this->session->userdata( 'userid' );
		
			for($i=0;$i<count($frnd_name);$i++)
			{
		
				/*$data_value = array( "frnd_artid"=>$art_id,
									 "frnd_userid"=>$user_id,
									 "frnd_name"=>$frnd_name[$i],
									 "frnd_affi"=>$frnd_affiliat[$i],
									 "frnd_posit"=>$frnd_position[$i],
									 "frnd_email"=>$frnd_email[$i],
									 "frnd_info"=>$frnd_info[$i],
									 "frnd_dateadd"=>date('Y-m-d')
									 );*/
									 
				$data_value = array( "frnd_artid"=>$art_id,
									 "frnd_userid"=>$user_id,
									 "frnd_name"=>$frnd_name[$i],
									 "frnd_affi"=>$frnd_affiliat[$i],
									 "frnd_exp"=>$frnd_exp[$i],
									 "frnd_email"=>$frnd_email[$i],
									 "frnd_dateadd"=>date('Y-m-d')
									 );
									 
									 
				$count_data = 0;	 
									 
				$count_data =$this->user_model->check_no_rec('tbl_users',array('user_email'=>$frnd_email[$i]));					 				
							 
				
				if((isset($frnd_id)) && !empty($frnd_id[$i]))
				{
					$where = array('frnd_id'=>$frnd_id[$i],'frnd_artid'=>$art_id);
					$query = $this->user_model->update_query($data_value,'tbl_invite_frnds',$where);
					$query =$frnd_id[$i];
					
					
					
					$inv_user_cond = "user_status = 1 AND FIND_IN_SET('".$art_id."',user_artid)   AND FIND_IN_SET('".$query."',user_inviteid)  ";
					$user_invite_l =$this->user_model->select_query('*','tbl_users',$inv_user_cond ,'user_id', 'desc');
					if(!empty($user_invite_l ))
					{
						foreach($user_invite_l as $inv_list)
						{
							$exp_inviteid = explode(',',$inv_list->user_inviteid);
							$exp_artid = explode(',',$inv_list->user_artid);
							
							 foreach ($exp_inviteid as $key => $value){
								if ($exp_inviteid[$key] == $query){
									unset($exp_inviteid[$key]);
								}
							}
							 $get_all_inviteid = array_values($exp_inviteid);
							 $set_all_inviteid = implode(',', $get_all_inviteid);
							 
							/* FOR ARTICLE*/
							 foreach ($exp_artid as $key => $value){
								if ($exp_artid[$key] == $art_id){
									unset($exp_artid[$key]);
								}
							}
							 $get_all_artid = array_values($exp_artid);
							 $set_all_artid = implode(',', $get_all_artid);
							
							
							$update_user_data['user_inviteid']  =  $set_all_inviteid;
							$update_user_data['user_artid']  =  $set_all_artid;
							
							$user_info = $this->user_model->update_query($update_user_data,'tbl_users',
									array('user_id'=>$inv_list->user_id));
						}
					}
					
					
					//$where_users=  array('user_inviteid'=>$frnd_id[$i],'user_artid'=>$art_id);
					 $str = rand(10000,90000);
					 
					 if($count_data==0)
					{
						
						$inset_data  =  array("user_type"=>'3',
										"user_fname"=>$frnd_name[$i],
										"user_lname"=>'',
										"user_email"=>$frnd_email[$i],
										"user_address"=>'',
										"user_country"=>'',
										"user_password"=>md5($str),
										"user_invitepass"=>$str,
										"user_instiute"=>$frnd_affiliat[$i],
										"user_classification"=>$frnd_exp[$i],
										"user_reviewer"=>'',
										"user_status"=>'1',
										"randum_key"=>'',
										"user_artid"=>$art_id,
										"user_inviteid"=>$query,
										"user_dateadd"=>date("Y-m-d"));
										
							$insert = $this->user_model->insert_data('tbl_users',$inset_data);
					}
					else
					{
						$where_user  = array('user_email'=>$frnd_email[$i]); 
					 $user_datalist =$this->user_model->get_row_with_con('tbl_users',$where_user);
						if( empty($user_datalist->user_inviteid) && empty($user_datalist->user_artid))	
						{
							
							$update_user_data['user_inviteid']  =  $query;
							$update_user_data['user_artid']  =  $art_id;
						}
						else
						{
						  $update_user_data['user_inviteid'] = $user_datalist->user_inviteid.','.$query;
						  $update_user_data['user_artid']  =  $user_datalist->user_artid.','.$art_id;
						  
						}
						
						
						
						if(empty($user_datalist->user_classification))	
						{
							
							$update_user_data['user_classification']  = $frnd_exp[$i];
						}
						else
						{
							$exp_data = explode(',',$frnd_exp[$i]);
							$user_clasi = explode(',',$user_datalist->user_classification);
							$final_exp = '';
							for($u=0;$u<count($exp_data);$u++)
							{
								if(!in_array($exp_data[$u],$user_clasi))
								{
									$final_exp .=','.$exp_data[$u];
								}
							}
							
							
						  $update_user_data['user_classification'] = $user_datalist->user_classification.$final_exp;
						}
						$user_info = $this->user_model->update_query($update_user_data,'tbl_users',$where_user);														
						
					}
					
					
				}
				elseif( (!empty($frnd_name[$i])) && (!empty($frnd_affiliat[$i])) && (!empty($frnd_email[$i])) )	{			 
					$query =$this->user_model->insert_data('tbl_invite_frnds',$data_value);	
					 $str = rand(10000,90000);
					 
					 if($count_data==0)
					{
						
						$inset_data  =  array("user_type"=>'3',
										"user_fname"=>$frnd_name[$i],
										"user_lname"=>'',
										"user_email"=>$frnd_email[$i],
										"user_address"=>'',
										"user_country"=>'',
										"user_password"=>md5($str),
										"user_invitepass"=>$str,
										"user_instiute"=>$frnd_affiliat[$i],
										"user_classification"=>$frnd_exp[$i],
										"user_reviewer"=>'',
										"user_status"=>'1',
										"randum_key"=>'',
										"user_artid"=>$art_id,
										"user_inviteid"=>$query,
										"user_dateadd"=>date("Y-m-d"));
										
							$insert = $this->user_model->insert_data('tbl_users',$inset_data);
					}
					else
					{
						$where_user  =array('user_email'=>$frnd_email[$i]); 
					    $user_datalist =$this->user_model->get_row_with_con('tbl_users',$where_user);
						if( empty($user_datalist->user_inviteid) && empty($user_datalist->user_artid))	
						{
							
							$update_user_data['user_inviteid']  =  $query;
							$update_user_data['user_artid']  =  $art_id;
						}
						else
						{
						  $update_user_data['user_inviteid'] = $user_datalist->user_inviteid.','.$query;
						   $update_user_data['user_artid']  =  $user_datalist->user_artid.','.$art_id;
						}
						
						
						
						if(empty($user_datalist->user_classification))	
						{
							
							$update_user_data['user_classification']  = $frnd_exp[$i];
						}
						else
						{
							$exp_data = explode(',',$frnd_exp[$i]);
							$user_clasi = explode(',',$user_datalist->user_classification);
							$final_exp = '';
							for($u=0;$u<count($exp_data);$u++)
							{
								if(!in_array($exp_data[$u],$user_clasi))
								{
									$final_exp .=','.$exp_data[$u];
								}
							}
							
							
						  $update_user_data['user_classification'] = $user_datalist->user_classification.$final_exp;
						}
						
						
						
						
						
						
						
						
						$user_info = $this->user_model->update_query($update_user_data,'tbl_users',$where_user);														
						
					}
				
				}	
				
				
				
				
				
				
				
				
				
				
							
							
			}			 
						
			echo $_POST['art_id'];	 	 
					

					 
				
	}
	
	
	/*
		CHANGES 07-Oct-2015
	public function article_invite_frnds()
	{
			
		
		extract($this->input->post());
		$user_id   = $this->session->userdata( 'userid' );
		
			for($i=0;$i<count($frnd_name);$i++)
			{
		
				$data_value = array( "frnd_artid"=>$art_id,
									 "frnd_userid"=>$user_id,
									 "frnd_name"=>$frnd_name[$i],
									 "frnd_affi"=>$frnd_affiliat[$i],
									 "frnd_posit"=>$frnd_position[$i],
									 "frnd_email"=>$frnd_email[$i],
									 "frnd_info"=>$frnd_info[$i],
									 "frnd_dateadd"=>date('Y-m-d')
									 );
									 
									 
									 
									 
							 
				
				if((isset($frnd_id)) && !empty($frnd_id[$i]))
				{
					$where = array('frnd_id'=>$frnd_id[$i],'frnd_artid'=>$art_id);
					$query = $this->user_model->update_query($data_value,'tbl_invite_frnds',$where);
					
					$where_users=  array('user_inviteid'=>$frnd_id[$i],'user_artid'=>$art_id);
					$update_user_data  =  array("user_fname"=>$frnd_name[$i],
												"user_email"=>$frnd_email[$i],
												"user_instiute"=>$frnd_affiliat[$i]
												);
					
					$user_info = $this->user_model->update_query($update_user_data,'tbl_users',$where_users);
					
				}
				elseif( (!empty($frnd_name[$i])) && (!empty($frnd_affiliat[$i])) && (!empty($frnd_email[$i])) )	{			 
					$query =$this->user_model->insert_data('tbl_invite_frnds',$data_value);	
					 $str = rand(10000,90000);
				
					$inset_data  =  array("user_type"=>'3',
										"user_fname"=>$frnd_name[$i],
										"user_lname"=>'',
										"user_email"=>$frnd_email[$i],
										"user_address"=>'',
										"user_country"=>'',
										"user_password"=>md5($str),
										"user_invitepass"=>$str,
										"user_instiute"=>$frnd_affiliat[$i],
										"user_classification"=>'',
										"user_reviewer"=>'',
										"user_status"=>'1',
										"randum_key"=>'',
										"user_artid"=>$art_id,
										"user_inviteid"=>$query,
										"user_dateadd"=>date("Y-m-d"));
										
							$insert = $this->user_model->insert_data('tbl_users',$inset_data);
				}	
				
				
							
							
			}			 
						
			echo $_POST['art_id'];	 	 
					
		
							 
		//if(isset($_POST['art_id'])&& ($_POST['art_id']>0))
//		{
//			$where = array('art_id'=>$_POST['art_id'],'art_userid'=>$user_id);
//			if(!empty($data_update)){
//				$query = $this->user_model->update_query($data_update,'tbl_invite_frnds',$where);
//			//	echo $this->db->last_query();
//				echo $_POST['art_id'];	
//			}
//			else
//			{
//				echo $_POST['art_id'];
//			}
//		}
//		else
//		{
//			$query =$this->user_model->insert_data('tbl_invite_frnds',$data_update);
//			echo $query;
//		
//		}	
					 
				
	}*/
	
	
	
	
	public function incomplete_article()
	{
	
		$user_id   = $this->session->userdata( 'userid' );
		
	 $select_filed = '*';	
	 $tbl_name= 'tbl_article';	
	$where_condition = array('art_status'=>'0',"art_userid"=>$user_id);
	$order_by_field = 'art_id';
	$order_by_type ='desc';
	$group_by_field = 'art_id';
	
		$all_list =$this->user_model->select_query_with_pagination(  "*", "tbl_article", $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field);
		
		$url = base_url().'incomplete-manuscript';
		$no_data = sizeof($all_list);
		$limit = 10;
		$uri_seg =$this->uri->segment(2);
		$all_record = 'N';
		
		
		$data['total_records']	= sizeof($all_list); 

		if($this->uri->segment(2)==0 or $this->uri->segment(2)==1){
			$data['offset']	= $offset =0;
		}else{
			$data['offset']	= $offset = ($this->uri->segment(2)-1)*$limit;
		}


		$data['page_no'] 	 =  custom_pagination($url,$no_data,$limit,$uri_seg);
		
		$data['incomp_data'] 		 = $this->user_model->select_query_with_pagination( $select_filed, $tbl_name, $where_condition, $limit, $offset, $all_record, $order_by_field, $order_by_type,$group_by_field);
		
	
		$this->load->view( 'header' );
		$this->load->view( 'author/incomplete_submission',$data);
		$this->load->view( 'footer');		
	}
	
	
	public function beprocess_article()
	{
	
		$user_id   = $this->session->userdata( 'userid' );
		
	 $select_filed = '*';	
	 $tbl_name= 'tbl_article';	
	$where_condition = ("art_userid ='".$user_id."' AND (art_status='1' OR art_status='2' OR art_status = '5' OR art_status = '6' OR art_status = '7' OR art_status = '8')");
	$order_by_field = 'art_id';
	$order_by_type ='desc';
	$group_by_field = 'art_id';
	
		$all_list =$this->user_model->select_query_with_pagination(  "*", "tbl_article", $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field);
		
		$url = base_url().'beprocess-manuscript';
		$no_data = sizeof($all_list);
		$limit = 10;
		$uri_seg =$this->uri->segment(2);
		$all_record = 'N';
		
		
		$data['total_records']	= sizeof($all_list); 

		if($this->uri->segment(2)==0 or $this->uri->segment(2)==1){
			$data['offset']	= $offset =0;
		}else{
			$data['offset']	= $offset = ($this->uri->segment(2)-1)*$limit;
		}


		$data['page_no'] 	 =  custom_pagination($url,$no_data,$limit,$uri_seg);
		
		$data['incomp_data'] 		 = $this->user_model->select_query_with_pagination( $select_filed, $tbl_name, $where_condition, $limit, $offset, $all_record, $order_by_field, $order_by_type,$group_by_field);
		
	
		$this->load->view( 'header' );
		$this->load->view( 'author/beprocess_submission',$data);
		$this->load->view( 'footer');		
	}
	
	
	public function complete_article()
	{
		$user_id   = $this->session->userdata( 'userid' );
		
	 $select_filed = '*';	
	 $tbl_name= 'tbl_article';	
	$where_condition = ("art_userid ='".$user_id."' AND art_status>='9'");
	$order_by_field = 'art_id';
	$order_by_type ='desc';
	$group_by_field = 'art_id';
	
		$all_list =$this->user_model->select_query_with_pagination(  "*", "tbl_article", $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field);
		
		$url = base_url().'completed-manuscript';
		$no_data = sizeof($all_list);
		$limit = 10;
		$uri_seg =$this->uri->segment(2);
		$all_record = 'N';
		
		
		$data['total_records']	= sizeof($all_list); 

		if($this->uri->segment(2)==0 or $this->uri->segment(2)==1){
			$data['offset']	= $offset =0;
		}else{
			$data['offset']	= $offset = ($this->uri->segment(2)-1)*$limit;
		}


		$data['page_no'] 	 =  custom_pagination($url,$no_data,$limit,$uri_seg);
		
		$data['decision_list'] 		 = $this->user_model->select_query_with_pagination( $select_filed, $tbl_name, $where_condition, $limit, $offset, $all_record, $order_by_field, $order_by_type,$group_by_field);
		
	
		$this->load->view( 'header' );
		$this->load->view( 'author/complete_submission',$data);
		$this->load->view( 'footer');		
	}
	
	/* REVISION MAINSCRIPT*/
	
	function revision_article()
	{
		$art_no = 0;
		$data['user_id'] = $user_id   = $this->session->userdata( 'userid' );
		$data['article_type'] =$this->user_model->select_query('*','tbl_article_type',array('atype_status'=>'1'),'atype_id','asc');

		$data['user_data'] =$this->user_model->get_row_with_con('tbl_users',array('user_id'=>$user_id));
		
		
		
		if($this->uri->segment(2))
		{
			$art_no = $this->uri->segment(2);
			$data['article_data'] =$this->user_model->get_row_with_con('tbl_article',
																	array('art_no'=>$art_no,
																		  'art_userid'=>$user_id));
			$data['art_no'] = $art_no;
			
			
			$data['other_author'] =$this->user_model->select_query('*','tbl_other_author',array(
																'oa_art_id'=>$data['article_data']->art_id,
																'oa_userid'=>$user_id
																),'oa_order','asc');
																
			$data['invite_frnds'] =$this->user_model->select_query('*','tbl_invite_frnds',array(
																'frnd_artid'=>$data['article_data']->art_id,
																'frnd_userid'=>$user_id
																),'','');
			if(!empty($data['article_data']))
			{
				$this->load->view( 'header' );
				$this->load->view( 'author/revision_submission',$data);
				$this->load->view( 'footer');
			}
			else
			{
				 redirect('user-dashboard');
			}
		}
		else
		{
			redirect('user-dashboard');
		}
					
		
		
	}
	
	function revision_action()
	{
	
		
		extract($this->input->post());
		$art_id = $art_id;
			
		$data['user_id'] = $user_id   = $this->session->userdata( 'userid' );
		$art_data=$this->user_model->select_query('*','tbl_article',array('art_id'=>$art_id,'art_userid'=>$user_id));
		
		
		$totla_revision_data = $this->user_model->check_no_rec('tbl_article_revision',array('art_decision_data'=>$art_data[0]->art_decision_data,'art_id'=>$art_data[0]->art_id));
		if($totla_revision_data==0)
		{
		
				  $inset_data  =  array("art_id"=>$art_data[0]->art_id,
										"art_no"=>$art_data[0]->art_no,
										"art_userid"=>$art_data[0]->art_userid,
										"art_type"=>$art_data[0]->art_type,
										"art_fulltitle"=>$art_data[0]->art_fulltitle,
										"art_abstract"=>$art_data[0]->art_abstract,
										"art_keyword"=>$art_data[0]->art_keyword,
										"art_cover"=>$art_data[0]->art_cover,
										"art_menuscript"=>$art_data[0]->art_menuscript,
										"art_figure"=>$art_data[0]->art_figure,
										"art_slide"=>$art_data[0]->art_slide,
										"art_supple"=>$art_data[0]->art_supple,
										"art_response"=>$art_data[0]->art_response,
										"art_status"=>$art_data[0]->art_status,
										"art_duedate"=>$art_data[0]->art_duedate,
										"art_dateadd"=>$art_data[0]->art_dateadd,
										"art_editor_decision"=>$art_data[0]->art_editor_decision,
										"art_editor_msg"=>$art_data[0]->art_editor_msg,
										"art_decision_data"=>$art_data[0]->art_decision_data,
										"art_update"=>$art_data[0]->art_update,
										"art_authoremail"=>$art_data[0]->art_authoremail,
										"rev_status"=>'0',
										"rev_date"=>date("Y-m-d"));
										
							$insert = $this->user_model->insert_data('tbl_article_revision',$inset_data);
							
							 $data_update = array('art_rev_id'=>$insert,'art_revadd'=>date('Y-m-d'));
							$query_update = $this->user_model->update_query($data_update,'tbl_article',array('art_id'=>$art_id,'art_userid'=>$user_id));
			
		}
		
		
		 $art_type='';
       $art_fulltitle='';
       $art_abstract='';
       $art_keyword='';
       $art_cover='';
       $art_menuscript='';
       $art_figure='';
       $art_slide='';
       $art_supple='';
       $art_response='';
	   
	   $data_update = '';
		if(isset($_POST['art_fulltitle']) && (!empty($_POST['art_fulltitle'])))
		{
			  $art_fulltitle=$_POST['art_fulltitle'];			  
			  $data_update = array('art_fulltitle'=>$art_fulltitle,'art_userid'=>$user_id);
		}
		if(isset($_POST['art_abstract']) && (!empty($_POST['art_abstract'])))
		{
			  $art_abstract=$_POST['art_abstract'];			  
			  $data_update = array('art_abstract'=>$art_abstract,'art_userid'=>$user_id);
		}
		
		
		if(isset($_POST['art_keyword']) && (!empty($_POST['art_keyword'])))
		{
		
			$art_key = $_POST['art_keyword'];
			  
			  $data_update = array('art_keyword'=>$art_key,'art_userid'=>$user_id);
			  
		}
		
		
		if ( 
			(isset($_FILES['art_cover']) && (!empty($_FILES['art_cover']['name']))) || 
			(isset($_FILES['art_menuscript']) && (!empty($_FILES['art_menuscript']['name']))) ||
			(isset($_FILES['art_figure']) && (!empty($_FILES['art_figure']['name'])))	||	   
			(isset($_FILES['art_slide']) && (!empty($_FILES['art_slide']['name']))) ||
			(isset($_FILES['art_supple']) && (!empty($_FILES['art_supple']['name']))) ||
			(isset($_FILES['art_response']) && (!empty($_FILES['art_response']['name'])))
			)
		{
		
			$art_cover='';
			$art_menuscript='';
			$art_figure='';
			$art_slide='';
			$art_supple='';
			$art_response='';
			
			$folderName = 'author-'.$this->session->userdata('userid');
			
			 $dir_name = 'upload/article/'.$folderName;
			 
			  /* COVER DOC*/
			  
			 if(!empty($_FILES['art_cover']['name']) && ($_FILES['art_cover']['error']==0))
			 {
			 		 	 $this->create_dir( $dir_name );
						$file_name = time()."-".str_replace(" ","_",$_FILES['art_cover']['name']);
						
						$config['upload_path'] = $dir_name;
						$config['allowed_types'] = 'docx|doc';
						$config['file_name'] = $file_name;

						$this->upload->initialize($config);
						$this->load->library('upload', $config);
						if ($this->upload->do_upload('art_cover'))
						{
							$data = $this->upload->data();
							$art_cover = $data['file_name'];
						}
			 }
			 
			 
			/* MENU SCRIPT DOC*/
			 if(!empty($_FILES['art_menuscript']['name']) && ($_FILES['art_menuscript']['error']==0))
			 {
			 		 	 $this->create_dir( $dir_name );
						$file_name = time()."-".str_replace(" ","_",$_FILES['art_menuscript']['name']);
						
						$config['upload_path'] = $dir_name;
						$config['allowed_types'] = 'docx|doc';
						$config['file_name'] = $file_name;

						$this->upload->initialize($config);
						$this->load->library('upload', $config);
						if ($this->upload->do_upload('art_menuscript'))
						{
							$data = $this->upload->data();
							$art_menuscript = $data['file_name'];
						}
			 }
			  
			  
			 
			/* FIGURE DOC*/
			 if(!empty($_FILES['art_figure']['name']) && ($_FILES['art_figure']['error']==0))
			 {
			 		 	 $this->create_dir( $dir_name );
						$file_name = time()."-".str_replace(" ","_",$_FILES['art_figure']['name']);
						

						$config['upload_path'] = $dir_name;
						$config['allowed_types'] = 'docx|doc';
						$config['file_name'] = $file_name;

						$this->upload->initialize($config);
						$this->load->library('upload', $config);
						if ($this->upload->do_upload('art_figure'))
						{
							$data = $this->upload->data();
							$art_figure = $data['file_name'];
						}
			 }
			  
			 
			/* SLIDER DOC*/
			 if(!empty($_FILES['art_slide']['name']) && ($_FILES['art_slide']['error']==0))
			 {
			 		 	 $this->create_dir( $dir_name );
						$file_name = time()."-".str_replace(" ","_",$_FILES['art_slide']['name']);
						
						$config['upload_path'] = $dir_name;
						$config['allowed_types'] = 'docx|doc';
						$config['file_name'] = $file_name;

						$this->upload->initialize($config);
						$this->load->library('upload', $config);
						if ($this->upload->do_upload('art_slide'))
						{
							$data = $this->upload->data();
							$art_slide = $data['file_name'];
						}
			 }
			  
			 
			/* SUPPLE DOC*/
			 if(!empty($_FILES['art_supple']['name']) && ($_FILES['art_supple']['error']==0))
			 {
			 		 	 $this->create_dir( $dir_name );
						$file_name = time()."-".str_replace(" ","_",$_FILES['art_supple']['name']);
						
						$config['upload_path'] = $dir_name;
						$config['allowed_types'] = 'docx|doc';
						$config['file_name'] = $file_name;

						$this->upload->initialize($config);
						$this->load->library('upload', $config);
						if ($this->upload->do_upload('art_supple'))
						{
							$data = $this->upload->data();
							$art_supple = $data['file_name'];
						}
			 }
			  
			/* RESPONCE DOC*/
			 if(!empty($_FILES['art_response']['name']) && ($_FILES['art_response']['error']==0))
			 {
			 		 	 $this->create_dir( $dir_name );
						$file_name = time()."-".str_replace(" ","_",$_FILES['art_response']['name']);
						
						$config['upload_path'] = $dir_name;
						$config['allowed_types'] = 'docx|doc';
						$config['file_name'] = $file_name;

						$this->upload->initialize($config);
						$this->load->library('upload', $config);
						if ($this->upload->do_upload('art_response'))
						{
							$data = $this->upload->data();
							$art_response = $data['file_name'];
						}
			 }
			 
			 
			 
			  
			   $data_update = array(	'art_cover'=>$art_cover,
			   							'art_menuscript'=>$art_menuscript,
			   							'art_figure'=>$art_figure,
			   							'art_slide'=>$art_slide,
			   							'art_supple'=>$art_supple,
										'art_response'=>$art_response);
			  
		}
		
		
		
		
		
		if(isset($_POST['art_id'])&& ($_POST['art_id']>0))
		{
			$where = array('art_id'=>$_POST['art_id'],'art_userid'=>$user_id);
			if(!empty($data_update)){
				$query = $this->user_model->update_query($data_update,'tbl_article',$where);
			//	echo $this->db->last_query();
				echo $_POST['art_id'];	
			}
			else
			{
				echo $_POST['art_id'];
			}
		}
		
	
		
	}
	
	
	public function final_revission_submission()
	{
		/*echo '<pre>';
	
		print_r($_POST);
		print_r($_FILES);
		exit;*/
		
		extract($this->input->post());
		$user_id   = $this->session->userdata( 'userid' );
		
		  
		$table_name 	 = 'tbl_article';
		$where_condition = array('art_id'=>$_POST['art_id'],'art_userid'=>$user_id);
		
		$get_all_key =  $this->user_model->get_row_with_con(  $table_name, $where_condition);
		
		
	   
		if( (!empty($get_all_key->art_type)) && (!empty($get_all_key->art_fulltitle)) &&
			(!empty($get_all_key->art_abstract)) )
		{
		
			$data_update = array('art_status'=>'16','art_rev_status'=>'1'); // status 1 for being process
				$query = $this->user_model->update_query($data_update,'tbl_article',$where_condition);
				
		}
		
		
		
		
		
		
		
		
		
		//	 redirect('user-dashboard');
		
		
	}
	
	
	
	
	/* 26-AUG-2015*/
	
	public function view_article()
	{
	
		$user_id   = $this->session->userdata( 'userid' );
		
			$data['user_data'] =$this->user_model->get_row_with_con('tbl_users',array('user_id'=>$user_id));
		$art_no = $this->uri->segment(2);
			$data['article_data'] =$this->user_model->get_row_with_con('tbl_article',
																	array('art_no'=>$art_no,
																		  'art_userid'=>$user_id));
																		  
		if(!empty($data['article_data']))	
		{																	  
			$data['other_author'] =$this->user_model->select_query('*','tbl_other_author',array(
																'oa_art_id'=>$data['article_data']->art_id
																),'oa_order','asc');
			$data['all_message'] =$this->user_model->select_query('*','tbl_article_message',array(
																'art_id'=>$data['article_data']->art_id
																),'id','desc');
			
																
			
				
			$data['art_no'] = $art_no;
			
			$this->load->view( 'header' );
			$this->load->view( 'author/project_detail',$data);
			$this->load->view( 'footer');
	  }
	  else
	  {	
	  	redirect('user-dashboard');
	  }		
			
	}
	
	
	public function send_message_box()
	{
		
		if(isset($_POST['msg_id']))
		{
			$data['msg_id'] = $_POST['msg_id'];
		}
	
		$user_id   = $this->session->userdata( 'userid' );
		$data['art_for']  = $this->uri->segment(1);
		$art_no = $this->uri->segment(2);
		
		$select_filed = 'a.*,u.*';	
		$tbl_name= 'tbl_article as  a ';	
		$where_condition = array('a.art_no'=>$art_no,'a.art_status > '=>'0','a.art_userid'=>$user_id);
		$order_by_field = 'a.art_id';
		$order_by_type ='desc';
		$group_by_field = 'a.art_id';
		$join_tbl1 = 'tbl_users as u'; 
		$join_type1 = 'left'; 
		$join_condition1 = 'u.user_id=a.art_userid';
	
	
		$data['article_data'] = $this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field, $join_tbl1, $join_type1, $join_condition1);
		
		if(!empty($data['article_data']))	
		{	
			$data['other_author'] =$this->user_model->select_query('*','tbl_other_author',array(
																'oa_art_id'=>$data['article_data'][0]->art_id,
																'oa_userid'=>$data['article_data'][0]->art_userid
																),'oa_order','asc');
			$data['art_no'] = $art_no;
			
			$this->load->view( 'header' );
			$this->load->view( 'author/project_message',$data);
			$this->load->view( 'footer');
			
		}
		else
		{
			redirect('user-dashboard');
		}
			
	}
	
	function editor_message_action()
	{
		/*echo '<pre>';
		print_r($_POST);
		exit;*/
		
		$user_data = $this->user_model->get_row_with_con('tbl_users',array('user_type'=>'3'));
		
			extract($this->input->post());
			
			$data_update = array( 'again_send'=>'1');
			$where_condition 	= '(id="'.$msg_id.'")';			
			$update_pass   = $this->user_model->update_query($data_update,'tbl_article_message',$where_condition);
			
				
				 
				$arti_status = $art_status;
			
				 
				 $inset_data  = 	array("art_id"=>$art_id,
										  "art_status"=>$arti_status,
										  "from_type"=>'A',
										  "to_type"=>'E',
										  "from_id"=>$this->session->userdata('userid'),
										  "to_id"=>$user_data->user_id,
										  "message"=>$art_message,
										  "date"=>date('Y-m-d')
								  );
			
										
							$insert = $this->user_model->insert_data('tbl_article_message',$inset_data);
							
			/*$data = array( 'art_status' => $arti_status,'art_update'=>date('Y-m-d'));
			$where_condition 	= '(art_id="'.$art_id.'")';			
			$update_pass   = $this->user_model->update_query($data,'tbl_article',$where_condition);*/
				
							
							
							$copy = $this->user_model->get_row_with_con('tbl_admin',array('id'=>1));
							 $to = $user_data->user_email;
							$subject = 'New message from Author';
							$message = "							
							<html>
							<head>
							<title>".$subject."</title>
							</head>
							<body>
							<div  style='width:700px; float:left;'>
  <div  style='width: 98%;float: left;background: #F7F7F7;padding: 1%;border-radius: 4px;border-top: 3px solid #ee4723;'>
  <div > <img src='".base_url()."design/front/images/logo.png'/> </div> 
								<p style='font-size: 17px; font-family:Tahoma, Geneva, sans-serif;'>Dear ".$user_data->user_fname.'&nbsp;'.$user_data->user_lname.", </p>
							 <p style='font-size: 15px; font-family:Tahoma, Geneva, sans-serif; color: #646161'>".$art_message." <br><br>
							</p>
							 </div>
  <div  style='width:100%;float:left; background:#ee4723; padding:0%; color:#fff; text-align:center;'>
    <p>".$copy->footer_copy."</p>
  </div>
</div>
							</body>
							</html>
							";
							
						/*	echo $to.'<br>';
							echo MAILFROM.'<br>';
							echo MAILFROMNAME.'<br>';
							
							echo $message;
							exit;*/
							$result = chatroomemail($to,MAILFROM,MAILFROMNAME,$subject,$message);
							
							
								
								
							if($result==false) {
								$this->session->set_flashdata("error", 'Email not send');
								//	redirect('login');
								redirect('user-dashboard');
							} else {
							
							   $this->session->set_flashdata("success","Email Send to Editor");	
								//	redirect('login');
								redirect('user-dashboard');
							
							}
							
	}
	
	
	
	public function proof_responce_box()
	{
		$data['msg_id'] ='';
		if(isset($_POST['msg_id']))
		{
			$data['msg_id'] = $_POST['msg_id'];
		}
	
		$user_id   = $this->session->userdata( 'userid' );
		$data['art_for']  = $this->uri->segment(1);
		$art_no = $this->uri->segment(2);
		
		$select_filed = 'a.*,u.*';	
		$tbl_name= 'tbl_article as  a ';	
		$where_condition = array('a.art_no'=>$art_no,'a.art_status >= '=>'10','a.art_userid'=>$user_id);
		$order_by_field = 'a.art_id';
		$order_by_type ='desc';
		$group_by_field = 'a.art_id';
		$join_tbl1 = 'tbl_users as u'; 
		$join_type1 = 'left'; 
		$join_condition1 = 'u.user_id=a.art_userid';
	
	
		$data['article_data'] = $this->user_model->select_query_with_pagination(  $select_filed, $tbl_name, $where_condition, '', '', 'Y', $order_by_field,$order_by_type,$group_by_field, $join_tbl1, $join_type1, $join_condition1);
		
		if(!empty($data['article_data']))	
		{	
			$data['other_author'] =$this->user_model->select_query('*','tbl_other_author',array(
																'oa_art_id'=>$data['article_data'][0]->art_id,
																'oa_userid'=>$data['article_data'][0]->art_userid
																),'oa_order','asc');
			$data['art_no'] = $art_no;
			
			$this->load->view( 'header' );
			$this->load->view( 'author/project_message',$data);
			$this->load->view( 'footer');
			
		}
		else
		{
			redirect('user-dashboard');
		}
			
	}
	
	
	function proof_responce_box_action()
	{
		/*echo '<pre>';
		print_r($_POST);
		print_r($_FILES);
		exit;*/
		
			extract($this->input->post());
			
		
		
			$file_name='';
			$full_name='';
			 $folderName = 'author-'.$art_userid;
			 $dir_name = 'upload/article/'.$folderName;
		if(isset($_FILES) && (!empty($_FILES['att_proof']['name'])))
		{
			$this->create_dir( $dir_name );
						$file_name = time()."-".str_replace(" ","_",$_FILES['att_proof']['name']);
						
						$config['upload_path'] = $dir_name;
						$config['allowed_types'] = 'docx|doc|txt|pdf|jpg|ginf|png';
						$config['file_name'] = $file_name;

						$this->upload->initialize($config);
						$this->load->library('upload', $config);
						if ($this->upload->do_upload('att_proof'))
						{
							$data = $this->upload->data();
							$file_name = $data['file_name'];
							$full_name=$dir_name.'/'.$file_name ;
						}
		}
				 
				 
				 
		$user_data = $this->user_model->get_row_with_con('tbl_users',array('user_id'=>$art_userid));
		
			$data_update = array( 'again_send'=>'1');
			$where_condition 	= '(id="'.$msg_id.'")';			
			$update_pass   = $this->user_model->update_query($data_update,'tbl_article_message',$where_condition);
			
				
				 
				$arti_status = $art_status;
			
				 
				 $inset_data  = 	array("art_id"=>$art_id,
										  "art_status"=>$art_status,
										  "from_type"=>'A',
										  "to_type"=>'P',
										  "from_id"=>$this->session->userdata('userid'),
										  "to_id"=>$user_data->user_id,
										  "message"=>$art_message,
										  "proof_file"=>$full_name,
										  "date"=>date('Y-m-d')
								  );
			
										
							$insert = $this->user_model->insert_data('tbl_article_message',$inset_data);
							
							
						$arti_data = $this->user_model->get_row_with_con('tbl_article',array('art_id'=>$art_id));
							
							$copy = $this->user_model->get_row_with_con('tbl_admin',array('id'=>1));
							
							
							/* Send Author Email */
							$to = $user_data->user_email;
							$subject = 'Upload the revised proof.';
							$message = "							
							<html>
							<head>
							<title>".$subject."</title>
							</head>
							<body>
							<div  style='width:700px; float:left;'>
  <div  style='width: 98%;float: left;background: #F7F7F7;padding: 1%;border-radius: 4px;border-top: 3px solid #ee4723;'>
  <div > <img src='".base_url()."design/front/images/logo.png'/> </div> 
								<p style='font-size: 17px; font-family:Tahoma, Geneva, sans-serif;'>Dear ".$user_data->user_fname.'&nbsp;'.$user_data->user_lname.", </p>
							 <p style='font-size: 15px; font-family:Tahoma, Geneva, sans-serif; color: #646161'>
							The revisedProof, ".$arti_data->art_fulltitle.", have been uploaded and publisher will check and publish your paper in one week.<br><br>
							To access just the manuscript for process directly, click the link below:<br>
							  <a href='".base_url()."login'>
							  	  <button type='button' style='background: #00CC33;border: none;padding:1% 2%;color: #fff; letter-spacing: 1px;margin: 0% 0% 1%;cursor: pointer;font-size: 16px;border-radius: 4px;'>Author main menu</button> </a>
								 <br><br>
							 	Access your account here:".base_url()."<br>
								User ID:".$user_detail->user_email."<br>
								Password:".$user_detail->user_invitepass."<br>	<br>	
								With kind regards,<br>	<br>	

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
							
						/*	echo $to.'<br>';
							echo MAILFROM.'<br>';
							echo MAILFROMNAME.'<br>';
							
							echo $message;
							exit;*/
							$result = chatroomemail($to,MAILFROM,MAILFROMNAME,$subject,$message);
							
							
							
							/* Send Publisher Email */
							
							$publisher_data = $this->user_model->get_row_with_con('tbl_users',array('user_type'=>'4'));
							
							$to = $publisher_data->user_email;
							$subject = 'Athor have checked the proof and upload the revised  proof.';
							$message = "							
							<html>
							<head>
							<title>".$subject."</title>
							</head>
							<body>
							<div  style='width:700px; float:left;'>
  <div  style='width: 98%;float: left;background: #F7F7F7;padding: 1%;border-radius: 4px;border-top: 3px solid #ee4723;'>
  <div > <img src='".base_url()."design/front/images/logo.png'/> </div> 
								<p style='font-size: 17px; font-family:Tahoma, Geneva, sans-serif;'>Dear ".$publisher_data->user_fname.'&nbsp;'.$publisher_data->user_lname.", </p>
							 <p style='font-size: 15px; font-family:Tahoma, Geneva, sans-serif; color: #646161'>
						I have checked proof and upload the revised proof. Please check it.<br><br>
								
							</p>
							 </div>
  <div  style='width:100%;float:left; background:#ee4723; padding:0%; color:#fff; text-align:center;'>
    <p>".$copy->footer_copy."</p>
  </div>
</div>
							</body>
							</html>
							";
							
						/*	echo $to.'<br>';
							echo MAILFROM.'<br>';
							echo MAILFROMNAME.'<br>';
							
							echo $message;
							exit;*/
							$result = chatroomemail($to,MAILFROM,MAILFROMNAME,$subject,$message);
							
							
								
								
								
							if($result==false) {
								$this->session->set_flashdata("error", 'Email not send');
								//	redirect('login');
								redirect('user-dashboard');
							} else {
							
							   $this->session->set_flashdata("success","Email Send to Editor");	
								//	redirect('login');
								redirect('user-dashboard');
							
							}
							
	}
	
	
	function hidden_article_list()
	{
	
		$user_type =$this->session->userdata('usertype');
		$user_id =  $this->session->userdata('userid');
		
		
			$data['user_data'] =$this->user_model->get_row_with_con('tbl_users',array('user_id'=>$user_id));
		
		$where_pro_list =  "art_userid = '".$user_id."' AND art_hidden = '1' AND (art_status = 4 or art_status = 8 or art_status = 15)";
		$data['pro_listing'] =$this->user_model->select_query_with_pagination(  "*", "tbl_article",$where_pro_list , '', '', 'Y', 'art_id','desc','art_id');
			
			
			
			
			$this->load->view( 'header' );
			$this->load->view( 'author/hidden_project',$data);
			$this->load->view( 'footer');
	}	
	
	function hidden_article_action()
	{
		extract($this->input->post());
		
		$article_data =$this->user_model->get_row_with_con('tbl_article',array('art_id'=>$art_id));
		$hidden_val =1;
		if($article_data->art_hidden)
		{
			$hidden_val =0;
		}
		  $data_update = array('art_hidden'=>$hidden_val);
		  $where = array('art_id'=>$art_id);
				$query = $this->user_model->update_query($data_update,'tbl_article',$where);
				echo $art_id;	
	}
	
}
?>