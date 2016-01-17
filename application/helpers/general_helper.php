<?php

	function get_meta_title()
	{
		
		$html_meta_title ='';
		$CI =& get_instance();
		$CI->load->model('user_model');		
		$data_pp =$CI->user_model->get_row_with_con('tbl_admin',array('id'=>'1'));
		$html_meta_title = $data_pp->meta_title;
		echo $html_meta_title ;
	}
	function get_meta_keyword()
	{
		
		$html_meta_key ='';
		$CI =& get_instance();
		$CI->load->model('user_model');		
		$data_pp =$CI->user_model->get_row_with_con('tbl_admin',array('id'=>'1'));
		$html_meta_key = $data_pp->meta_keyword;
		echo $html_meta_key ;
	}
	function get_meta_desc()
	{
		
		$html_meta_desc ='';
		$CI =& get_instance();
		$CI->load->model('user_model');		
		$data_pp =$CI->user_model->get_row_with_con('tbl_admin',array('id'=>'1'));
		$html_meta_desc = $data_pp->meta_keyword;
		echo $html_meta_desc ;
	}
	function get_footer_copyright()
	{
		
		$html_copyright ='';
		$CI =& get_instance();
		$CI->load->model('user_model');		
		$data_pp =$CI->user_model->get_row_with_con('tbl_admin',array('id'=>'1'));
		$html_copyright = $data_pp->footer_copy;
		echo $html_copyright ;
	}
	
	
	function get_more_info()
	{
		
		
		$html_footer ='';
		$CI =& get_instance();
		$CI->load->model('user_model');
		
		$select_filed = "*";
			$tbl_name ='tbl_pages';	
			$where_condition=array('page_status'=>'1' , 'page_display'=>'1');
			$order_by_field='';
			$order_by_type='';
					
			$records =$CI->user_model->select_query($select_filed, $tbl_name, $where_condition,$order_by_field, $order_by_type);
			
		
									
		if( !empty($records))
		{$html_footer .='<ul>';		
		 	 foreach(  $records as $footer_data) {
			$html_footer .='<li><a href="'.base_url().'page-detail/'.$footer_data->page_url.'">'.$footer_data->page_title.'</a></li>';
				
			}		
			$html_footer .='</ul>';
		}
		
		echo $html_footer ;
	}
	
	function get_channel()
	{		
		$html_channel_footer ='';
		$CI =& get_instance();
		$CI->load->model('user_model');
					
		$select_filed = "*";
			$tbl_name ='tbl_pages';	
			$where_condition=array('page_status'=>'1' , 'page_display'=>'2');
			$order_by_field='';
			$order_by_type='';
					
			$records =$CI->user_model->select_query($select_filed, $tbl_name, $where_condition,$order_by_field, $order_by_type);
			
		
									
		if( !empty($records))
		{
		$html_channel_footer .='<ul>';		
		
			
			foreach(  $records as $footer_data) {
				$html_channel_footer .='<li><a  href="'.base_url().'page-detail/'.$footer_data->page_url.'">'.$footer_data->page_title.'</a></li>';
				
			}		
			$html_channel_footer .='</ul>';
		}
		
		echo $html_channel_footer ;
	}
	
	
	function get_social_link()
	{
		
		$html_social_link ='';
		$CI =& get_instance();
		$CI->load->model('user_model');
					
		$select_filed = "*";
			$tbl_name ='tbl_social';	
			$where_condition=array('social_status'=>'1');
			$order_by_field='';
			$order_by_type='';
					
			$records =$CI->user_model->select_query($select_filed, $tbl_name, $where_condition,$order_by_field, $order_by_type);
			
									
		if( !empty($records))
		{
		$html_social_link .=' <p class="footer_icon"> ';	
			
			foreach(  $records as $social) {
				$html_social_link .='<a href="'.$social->social_link.'" title="'.$social->social_title.'" class="fa " target="_blank"><img src="'.base_url().'timthumb.php?src='.base_url().'upload/slider/'.$social->social_icon.'&w=26&h=25"></a>';
				
			}		
			$html_social_link .='</p>';
		}
		
		echo $html_social_link ;
	}
	
	if(!function_exists('afghanemail'))
	{
		function chatroomemail($to,$from,$fromname,$subject,$message)
		{  
			
			$obj =& get_instance();
			$obj->load->library('email');
			$obj->email->set_mailtype("html");
			$obj->email->from($from,$fromname);
			$obj->email->to($to);
			$obj->email->subject($subject);
			$obj->email->message($message);
			if(!$obj->email->send()){
			  return false;
			}else{
			  return true;
			}
		}
	}
	if(!function_exists('custom_pagination'))
	{
			function custom_pagination($url,$no_data,$limit,$uri_seg)
			{
				$obj = & get_instance();
				
							$config['base_url']		 	= $url;
							$config['total_rows']	 	= $no_data;
							$config['per_page']         =  $limit;
							$config['full_tag_open'] 	= '<ul class="pagination">';
							$config['full_tag_close'] 	= '</ul>'; 
							$config['first_tag_open']   = '<li>';
							$config['first_tag_close']  = '</li>';
							$config['first_link'] 		= 'First';
							$config['last_link'] 		= 'Last';
							$config['last_tag_open'] 	= '<li>';
							$config['last_tag_close'] 	= '</li>'; 
							$config['prev_link'] 		= '&laquo;';
							$config['prev_tag_open'] 	= '<li>';
							$config['prev_tag_close'] 	= '</li>';
							$config['next_link'] 		= '&raquo;';
							$config['next_tag_open'] 	= '<li>';
							$config['next_tag_close'] 	= '</li>';
							$config['cur_tag_open'] 	= '<li class="active"><a>';
							$config['cur_tag_close'] 	= '</a></li>';
							$config['num_tag_open'] 	= '<li>';
							$config['num_tag_close'] 	= '</li>';
							$config['use_page_numbers'] = true;
							$config['uri_segment'] 		= $uri_seg;
							
							$obj->pagination->initialize($config); 
							$page_no 	 = $obj->pagination->create_links(); 
						return $page_no ;
			}
		}
		

?>