<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model { 

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
		parent::__construct();
		
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
		$this->db->from("pages");
		$this->db->where("p_url",$new_string);
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
	 /*
	 * To check login credential details in db
	 * it will return user details if credentials found in db
	 **/
	public function check_login_credentials( $postdata ){
		extract( $postdata );
		$this->db->select('*');
		$this->db->from('tbl_admin');
		$this->db->where('username', $username); 
		$this->db->where('password', md5($password)); 
		$query = $this->db->get();
		$res   = $query->result();
		if( $query->num_rows() >0 ) {
			return $query->result();
		}
	}
	
	
	/*
	change password functionality. 
	check if entered old password is correct or not.
	*/
	public function check_old_password ( $old_pass,$userid ){
		//echo md5($old_pass).','.$userid;exit;
		
		$this->db->select('count(*) as c');
		$this->db->from('tbl_admin');
		$this->db->where('password', md5($old_pass)); 
		$this->db->where('id', $userid); 
		$query = $this->db->get();
		$res   = $query->result();
		if( $query->num_rows() >0 ) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	
	
	/*change password functionality. 
	update old password from new.
	*/
	public function update_password ( $new_pass,$userid ){
		
		$data = array(
               'password' => md5($new_pass)
            );
		$this->db->where('id', $userid);
		$this->db->update('tbl_admin', $data);
		return true;
	}
	
	/*
	* post data and user id
	* Function for edit user profile.
	**/
	
	public function update_deatils ( $postdata,$userid ){
		extract( $postdata );
		$data = array(
              /* 'password' => md5($password),*/
			   'username' => $username,
			   'email' 	  => $email,
			   'address' 	=> $address,
			   'skype_id' 	=> $skype_id,
			   'Phone_no' 	=> $phone_no 
            );
		$this->db->where('id', $userid);
		$this->db->update('admin', $data);
		return true;
	}
	
	public function update_conatcat ( $postdata,$userid ){
		extract( $postdata );
		$data = array(
              /* 'password' => md5($password),*/
			   'contact_add' => $contact_add,
			   'contact_email' 	  => $contact_email,
			   'contact_site' 	=> $contact_site,
			   'contact_no' 	=> $contact_no 
            );
		$this->db->where('id', $userid);
		$this->db->update('admin', $data);
		return true;
	}
	
	/* SELECT ADMIN DETAIL */
	
	public function select_deatils( $userid)
	{
		$this->db->select("*");
		$this->db->from('tbl_admin');
		$this->db->where('id',$userid);
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
		
	/* MANAGE PAGES START  */	
		
		
	/* SELECT PARENT PAGES*/		
	
	
	public function get_all_menus( $tablname ){
		$this->db->select('*');
		$this->db->from( $tablname );
		$this->db->where('p_parent','0');
		$query = $this->db->get();
		
		if( $query->num_rows() >0 ) {
			return $query->result();
		} else {
			return false;
		}
	}
	
		/* Select page  for edit by id  */
	public function selectpage_byid( $pageid, $table_name){
		$this->db->select('*');
		$this->db->from( $table_name );
		$this->db->where('p_pageid', $pageid); 
		$query = $this->db->get();
		
		if( $query->num_rows() >0 ) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	/* Select page  for edit by url  */
	public function selectpage_byurl( $pageid, $table_name){
		$this->db->select('*');
		$this->db->from( $table_name );
		$this->db->where('p_url', $pageid); 
		$query = $this->db->get();
		
		if( $query->num_rows() >0 ) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	
	
	
	
	/* Insert  page content  */
	public function insert_page($post_data, $tbl_name)
	{
		extract($post_data);
		$data = array(
		   'p_title' => $page_title ,
		   'p_description' => $description ,
		   'p_url' =>$this->seoUrl($page_title),
		   'p_metatitle' => $meta_title,
		   'p_keyword' => $meta_key,
		   'p_metadesc' => $meta_desc,
		   'p_parent' => $page_parent 
		);
		
				$this->db->insert( $tbl_name, $data ); 
		return  $this->db->insert_id();

	}
	
	/* update  page content  */
	function update_page( $postdata,  $tbl_name  ) {
		extract($postdata);
			$data = array(
		   'p_title' => $page_title ,
		   'p_description' => $description ,
		   'p_url' =>$this->seoUrl($page_title),
		   'p_metatitle' => $meta_title,
		   'p_keyword' => $meta_key,
		   'p_metadesc' => $meta_desc,
		   'p_parent' => $page_parent 
		);
			
		$this->db->where('p_pageid', $pageid);
		$this->db->update($tbl_name , $data);
		return true;
	}
	
	
	/* SELECT DATA from pages table*/
	public function select_pages( $tbl_name, $limit=false, $offset=false ) {
		$this->db->select('*');
		$this->db->from( $tbl_name );		
		$this->db->order_by('p_pageid', 'desc');
		if( $offset !='' ){
			$this->db->limit($limit, $offset);
		}elseif( $offset =='' && $limit==4 ){
			$this->db->limit(4, 0);
		}
		$query = $this->db->get();
		
		if( $query->num_rows() >0 ) {
			return $query->result();
		} else {
			return false;
		}
	}
	
		/* delete  page  */
	function delete_page( $pageid, $tblname ) {
		$this->db->where('p_pageid', $pageid);
		$this->db->delete($tblname); 
		return true;
	}
	
	/* Disaply No of subpages in any  page*/
	function parent_page($pageid, $tblname )
	{
		$this->db->select('*');
		$this->db->from( $tblname );
		$this->db->where('p_parent', $pageid);
		$query = $this->db->get();
		
		if( $query->num_rows() >0 ) {
			return $query->num_rows();
		} else {
			return false;
		}

	}
	
	/* Disaply No of subpages in any  page*/
	function parent_page_link($pageid, $tblname )
	{
		$this->db->select('*');
		$this->db->from( $tblname );
		$this->db->where('p_parent', $pageid);
		$query = $this->db->get();
		
		if( $query->num_rows() >0 ) {
			return $query->result();
		} else {
			return false;
		}

	}
	
	/* Disaply No of subpages in any  page*/
	function parent_page_active($pageid, $tblname )
	{
		$this->db->select('*');
		$this->db->from( $tblname );
		$this->db->where('p_parent', $pageid);
		$this->db->where('p_status', '1');
		$query = $this->db->get();
		
		if( $query->num_rows() >0 ) {
			return $query->num_rows();
		} else {
			return false;
		}

	}
	
	/* Disaply No of subpages in any  page*/
	function parent_page_link_active($pageid, $tblname )
	{
		$this->db->select('*');
		$this->db->from( $tblname );
		$this->db->where('p_parent', $pageid);
		$this->db->where('p_status', '1');
		$query = $this->db->get();
		
		if( $query->num_rows() >0 ) {
			return $query->result();
		} else {
			return false;
		}

	}
	
	
	/* MANAGE PAGES END  */	
	
	
	
	/*MANAGE FAQ START*/
	
	// FAQ listing.......
	
 function select_faq( $tbl_name, $limit=false, $offset=false )
 {
 	$this->db->select("*");
	$this->db->from($tbl_name);		
	$this->db->order_by('f_id', 'desc');
	if( $offset !='' ){
			$this->db->limit($limit, $offset);
		}elseif( $offset =='' && $limit==4){
			$this->db->limit(4, 0);
		}
		$query = $this->db->get();
		
		if( $query->num_rows() >0 ) {
			return $query->result();
		} else {
			return false;
		}
	
 }
 
 
 /* Insert faq*/
 public function insert_faq($post_data, $tbl_name)
	{
		extract($post_data);
		$data = array(
		   'f_title' => $faq_title ,
		   'f_content' => $description ,
		   'f_is_active' => $f_status 
		);
		
				$this->db->insert( $tbl_name, $data ); 
		return  $this->db->insert_id();

	}
	
	/* update  page content  */
	function update_faq( $postdata,  $tbl_name  ) {
		extract($postdata);
			$data = array(
		   'f_title' => $faq_title ,
		   'f_content' => $description ,
		   'f_is_active' => $f_status 
		);
			
		$this->db->where('f_id', $faqid);
		$this->db->update($tbl_name , $data);
		return true;
	}
	/* update  faq status content  */
	function update_faqstatus( $postdata,  $tbl_name  ) {
		extract($postdata);
		$new_val= '';
		if($val=='0'){$new_val =1;} 
		if($val=='1'){$new_val =0;} 
		
			$data = array(
		   'f_is_active' => $new_val 
		);
			
		$this->db->where('f_id', $id);
		$this->db->update($tbl_name , $data);
		return true;
	}
		
	/* Select FAQ for edit by id  */
	public function selectfaq_byid( $faqid, $table_name){
		$this->db->select('*');
		$this->db->from( $table_name );
		$this->db->where('f_id', $faqid); 
		$query = $this->db->get();
		
		if( $query->num_rows() >0 ) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	/* DELETE FAQ*/
	function delete_faq( $pageid, $tblname ) {
		$this->db->where('f_id', $pageid);
		$this->db->delete($tblname); 
		return true;
	}
	/* MANAGE FAQ END */
	
		
 function select_fpages( $tbl_name, $limit=false, $offset=false )
 {
 	$this->db->select("*");
	$this->db->from($tbl_name);		
	$this->db->where('f_is_active','1');		
	$this->db->order_by('f_id', 'desc');
		$query = $this->db->get();
		
		if( $query->num_rows() >0 ) {
			return $query->result();
		} else {
			return false;
		}
	
 }
 
 	/* MANAGE PAGES END  */	
	
	function update_query_where( $data, $tbl_name, $where_condition ){
		
		$this->db->where( $where_condition );
		$this->db->update( $tbl_name, $data);
		return true;
	}
}