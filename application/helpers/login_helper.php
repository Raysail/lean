<?php

		if(!function_exists('login_check'))
		{
			function login_check()
			{
				$obj =& get_instance();
				$login_detail = $obj->session->all_userdata();
				if(!isset($login_detail['admin_details']))
				{
					redirect('administrator');
				}
			}
		}
		
		
		if(!function_exists('login_user_check'))
		{
			function login_user_check()
			{
				$obj =& get_instance();
				$login_detail = $obj->session->all_userdata();
				if(!isset($login_detail['user_details']))
				{
					redirect('login');
				}
			}
		}
		
		
		
		
		
		if(!function_exists('login_check_users'))
		{
			function login_check_users()
			{
				$obj =& get_instance();
				$login_detail = $obj->session->all_userdata();
				
				if(!isset($login_detail['isLoggedIn']))
				{
					redirect('login');
				}
			}
		}
		
		if(!function_exists('user_permition_check'))
		{
			function user_permition_check($func_name,$func_type)
			{
				$obj =& get_instance();
				$login_detail=$obj->session->all_userdata();
				//echo "<pre>"; print_r($login_detail);
				//die;
				if(!isset($login_detail['admin_details']))
				{
					//redirect('admin');
					return false;
				}
				else
				{
						return true;
				
				}
			}
		}
		
		if(!function_exists('user_func_check'))
		{
			function user_func_check()
			{
				$obj =& get_instance();
				$login_detail=$obj->session->all_userdata();
				if(!isset($login_detail['admin_details']))
				{
					redirect('administrator');
				}
				/*else
				{
					
						redirect('administrator/dashboard');
					
				}*/
			}
		}
		if(!function_exists('front_user_func_check'))
		{
			function front_user_func_check()
			{
				$obj =& get_instance();
				$login_detail=$obj->session->all_userdata();
				if(!isset($login_detail['user_details']))
				{
					redirect('login');
				}
				/*else
				{
					
						redirect('administrator/dashboard');
					
				}*/
			}
		}
		
		/* FRONT EDITOR PROJECT*/
		if(!function_exists('front_editor_user_func_check'))
		{
			function front_editor_user_func_check()
			{
				$obj =& get_instance();
				$login_detail=$obj->session->all_userdata();
				if( (!isset($login_detail['user_details'])) || ($login_detail['usertype']!='2' ))
				{
					redirect('login');
				}
				/*else
				{
					
						redirect('administrator/dashboard');
					
				}*/
			}
		}
		/* FRONT EDITOR PROJECT*/
		if(!function_exists('front_reviewer_user_func_check'))
		{
			function front_reviwer_user_func_check()
			{
				$obj =& get_instance();
				$login_detail=$obj->session->all_userdata();
				if( (!isset($login_detail['user_details'])) || ($login_detail['usertype']!='3' ))
				{
					redirect('login');
				}
				/*else
				{
					
						redirect('administrator/dashboard');
					
				}*/
			}
		}
		/* FRONT EDITOR PROJECT*/
		if(!function_exists('front_publisher_user_func_check'))
		{
			function front_publisher_user_func_check()
			{
				$obj =& get_instance();
				$login_detail=$obj->session->all_userdata();
				if( (!isset($login_detail['user_details'])) || ($login_detail['usertype']!='4' ))
				{
					redirect('login');
				}
				/*else
				{
					
						redirect('administrator/dashboard');
					
				}*/
			}
		}
		
		
	if(!function_exists('seoUrl')){
		function seoUrl($string) {
		//Lower case everything
		$string1 = strtolower($string);
		//Make alphanumeric (removes all other characters)
		$string1 = preg_replace("/[^a-z0-9_\s-]/", "", $string1);
		//Clean up multiple dashes or whitespaces
		$string1 = preg_replace("/[\s-]+/", " ", $string1);
		//Convert whitespaces and underscore to dash
		$string1 = preg_replace("/[\s_]/", "-", $string1);
		if( !empty($string1) || $string1 != '' ){
		return $string1;
		}else{
		return $string;
		}
		
		}
	} 


		if(!function_exists('check_old_password'))
		{
			function check_old_password( $tbl_name, $where_condition )
			{
				$obj =& get_instance();
				$obj->db->select('count(*) as c');
				$obj->db->from( $tbl_name );
				$obj->db->where( $where_condition ); 
				$query = $obj->db->get();
				$res   = $query->result();
				
				if( $query->num_rows() >0 ) {
					return $query->row();
				} else {
					return false;
				}
			}
		}
		
?>