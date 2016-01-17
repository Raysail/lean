<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {
 
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
	 
	 /*
	 * To check login credential details in db
	 * it will return user details if credentials found in db
	 **/
	

	function edit_query( $data,  $update_field, $id, $table_name ){
	//echo '<pre>'.$id;print_r($data);exit;
		$this->db->where( $update_field, $id );
		$response = $this->db->update( $table_name, $data ); 
		return $response;
	}	
	
	
	function select_query( $data, $table_name, $where_condition =false,$order_by_field=false, $order_by_type=false){
			
			$this->db->select( $data );
			$this->db->from($table_name);
			if(  !empty($where_condition )){
				$this->db->where($where_condition);
			}
			
			
			
			if(  !empty($order_by_field )){
				$this->db->order_by( $order_by_field, $order_by_type );
			}
			
			$query = $this->db->get();	
			if($query->num_rows()>0)
			{
				return $response = $query->result();
			}
			
		}
		
		
		function select_query_with_join( $data, $table_name, $where_condition =false, $limit=false, $offset=false, $all_record=false, $join_tbl1=false, $join_condition1=false, $join_tbl2=false, $join_condition2=false, $join_tbl3=false, $join_condition3=false){
			
			$this->db->select( $data );
			$this->db->from($table_name);
			
			if(  !empty($join_condition1) ){
				$this->db->join( $join_tbl1, $join_condition1 );
			}
			if(  !empty($join_condition2) ){
				$this->db->join( $join_tbl2, $join_condition2 );
			}
			if(  !empty($join_condition3) ){
				$this->db->join( $join_tbl3, $join_condition3 );
			}
			if( !empty($offset) ){
				$this->db->limit($limit, $offset);
				
			}
			if( $all_record == 'N' ){
				
				$this->db->limit(10, 0);
			
			}
			if(  !empty($where_condition )){
				$this->db->where($where_condition);
			}
			
			
			$query = $this->db->get();//echo $this->db->last_query();
			$res  = $query->result();
			if($query->num_rows()>0)
			{
				return $response = $query->result();
			}
			
		}
		
		
		//with order by condition
		function select_query_with_join_order_by( $data, $table_name, $where_condition =false, $limit=false, $offset=false, $all_record=false, $order_by_field=false, $order_by_type=false, $join_tbl1=false, $join_condition1=false, $join_tbl2=false, $join_condition2=false, $join_tbl3=false, $join_condition3=false){
			
			$this->db->select( $data );
			$this->db->from($table_name);
			
			if(  !empty($join_condition1) ){
				$this->db->join( $join_tbl1, $join_condition1 );
			}
			if(  !empty($join_condition2) ){
				$this->db->join( $join_tbl2, $join_condition2 );
			}
			if(  !empty($join_condition3) ){
				$this->db->join( $join_tbl3, $join_condition3 );
			}
			if( !empty($offset) ){
				$this->db->limit($limit, $offset);
				
			}
			if( $all_record == 'N' ){
				
				$this->db->limit(2, 0);
			
			}
			if(  !empty($where_condition )){
				$this->db->where($where_condition);
			}
			
			if(  !empty($order_by_field )){
				$this->db->order_by( $order_by_field, $order_by_type );
			}
			
			$query = $this->db->get();//echo $this->db->last_query();
			$res  = $query->result();
			if($query->num_rows()>0)
			{
				return $response = $query->result();
			}
			
		}
		
		
		//with group by condition
		function select_query_with_join_group_by( $data, $table_name, $where_condition =false, $limit=false, $offset=false, $all_record=false, $order_by_field=false, $order_by_type=false, $group_by_field = false, $join_tbl1=false, $join_condition1=false, $join_tbl2=false, $join_condition2=false, $join_tbl3=false, $join_condition3=false, $join_tbl4=false, $join_condition4=false, $join_tbl5=false, $join_condition5=false,$join_tbl6=false, $join_condition6=false){
			
			$this->db->select( $data );
			$this->db->from($table_name);
			
			if(  !empty($join_condition1) ){
				$this->db->join( $join_tbl1, $join_condition1 );
			}
			if(  !empty($join_condition2) ){
				$this->db->join( $join_tbl2, $join_condition2 );
			}
			if(  !empty($join_condition3) ){
				$this->db->join( $join_tbl3, $join_condition3 );
			}
			if(  !empty($join_condition4) ){
				$this->db->join( $join_tbl4, $join_condition4 );
			}
			if(  !empty($join_condition5) ){
				$this->db->join( $join_tbl5, $join_condition5 );
			}
			if(  !empty($join_condition6) ){
				$this->db->join( $join_tbl6, $join_condition6 );
			}
			if( !empty($offset) ){
				$this->db->limit($limit, $offset);
				
			}
			if( $all_record == 'N' ){
				
				$this->db->limit(10, 0);
			
			}
			if(  !empty($where_condition )){
				$this->db->where($where_condition);
			}
			
			if(  !empty( $group_by_field )){
				$this->db->group_by( $group_by_field );
			}
			
			if(  !empty($order_by_field )){
				$this->db->order_by( $order_by_field, $order_by_type );
			}
			
			$query = $this->db->get();//echo $this->db->last_query();
			$res  = $query->result();
			if($query->num_rows()>0)
			{
				return $response = $query->result();
			}
			
		}
		
		
		function update_query ( $data, $tbl_name, $where_condition ){
				
				$this->db->where( $where_condition );
				$this->db->update( $tbl_name, $data);
				return true;
			}
	
	
	/* delete  query  */
	function delete_query(  $tblname, $where_condition ) {
		$this->db->where( $where_condition );
		$this->db->delete($tblname); 
		return true;
	}
	
	
	//* HCECK UNIQUE ID*/
	function select_checkunique($field,$tbl_name,$where_condition)
	{
		$this->db->select($field);
		$this->db->from($tbl_name);
	//	$this->db->where($condition1);
		$this->db->where($where_condition);
		$query = $this->db->get() ;
		
		
//		echo $this->last_query();
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			$zero = 0;
			return $zero;;
		}
		
	}
	
	
	
	//check availability
	public function check_availability( $select_avail, $tbl_avail,$where ,$where_arr){
	
		$this->db->select($select_avail);
		$this->db->from($tbl_avail);
		$this->db->where( $where );
		$this->db->where( $where_arr );		
		$query = $this->db->get();             
		$res   = $query->result();

		return $res;
	}
		
	//to update
	
	
	function update_rate_and_availability( $tbl_name, $postdata , $condition ) {

			$this->db->where( $condition );
			
			$this->db->update($tbl_name, $postdata );
			
			
			return 1;
	}
	
	//to insert rate and availability
	function insert_data( $tbl_name , $postdata ){

		$query = $this->db->insert($tbl_name,$postdata);
		
		return  $this->db->insert_id();
	}
	
	
	function update_data( $tbl_name , $postdata,  $where ){
		
		$this->db->where($where);
		$this->db->update($tbl_name , $postdata);
		
		return true;
		
	}
	
	/* FOR CALENDER END FUNCTION */
	
	
	
	public function check_booking($tbl_name,$where)
	{
		$this->db->select('*');
		$this->db->from($tbl_name);
		$this->db->where($where);
		$query = $this->db->get() ;      
		$result   = $query->result();
		
		if($query->num_rows()>0)
		{
			return $query->num_rows();
		}
		else
		{
			$zero = 0;
			return $zero;;
		}
	}
	
	function select_date($field,$price_tablname, $tprce_condition, $condition1)
	{
		$this->db->select($field);
		$this->db->from($price_tablname);
		$this->db->where($condition1);
		$this->db->where($tprce_condition);
		$query = $this->db->get() ;
		
		
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			$zero = 0;
			return $zero;;
		}
		
	}
	
	
	//with group by condition LEFT JOIN
		function select_query_with_join_left_group_by( $data, $table_name, $where_condition =false, $limit=false, $offset=false, $all_record=false, $order_by_field=false, $order_by_type=false, $group_by_field = false, $join_tbl1=false, $join_condition1=false, $join_tbl2=false, $join_condition2=false, $join_tbl3=false, $join_condition3=false, $join_tbl4=false, $join_condition4=false, $join_tbl5=false, $join_condition5=false,$join_tbl6=false, $join_condition6=false){
			
			$this->db->select( $data );
			$this->db->from($table_name);
			
			if(  !empty($join_condition1) ){
				$this->db->join( $join_tbl1, $join_condition1 );
			}
			if(  !empty($join_condition2) ){
				$this->db->join( $join_tbl2, $join_condition2," LEFT " );
			}
			if(  !empty($join_condition3) ){
				$this->db->join( $join_tbl3, $join_condition3 );
			}
			if(  !empty($join_condition4) ){
				$this->db->join( $join_tbl4, $join_condition4 );
			}
			if(  !empty($join_condition5) ){
				$this->db->join( $join_tbl5, $join_condition5 );
			}
			if(  !empty($join_condition6) ){
				$this->db->join( $join_tbl6, $join_condition6 );
			}
			if( !empty($offset) ){
				$this->db->limit($limit, $offset);
				
			}
			if( $all_record == 'N' ){
				
				$this->db->limit(10, 0);
			
			}
			if(  !empty($where_condition )){
				$this->db->where($where_condition);
			}
			
			if(  !empty( $group_by_field )){
				$this->db->group_by( $group_by_field );
			}
			
			if(  !empty($order_by_field )){
				$this->db->order_by( $order_by_field, $order_by_type );
			}
			
			$query = $this->db->get();//echo $this->db->last_query();
			$res  = $query->result();
			if($query->num_rows()>0)
			{
				return $response = $query->result();
			}
			
		}
	
	//with group by condition LEFT JOIN AJAX
		function select_query_with_join_left_group_by_home( $data, $table_name, $where_condition =false, $limit=false, $offset=false, $all_record=false, $order_by_field=false, $order_by_type=false, $group_by_field = false, $join_tbl1=false, $join_condition1=false, $join_tbl2=false, $join_condition2=false, $join_tbl3=false, $join_condition3=false, $join_tbl4=false, $join_condition4=false, $join_tbl5=false, $join_condition5=false,$join_tbl6=false, $join_condition6=false){
			
			$this->db->select( $data );
			$this->db->from($table_name);
			
			if(  !empty($join_condition1) ){
				$this->db->join( $join_tbl1, $join_condition1," LEFT"  );
			}
			if(  !empty($join_condition2) ){
				$this->db->join( $join_tbl2, $join_condition2," LEFT " );
			}
			if(  !empty($join_condition3) ){
				$this->db->join( $join_tbl3, $join_condition3 );
			}
			if(  !empty($join_condition4) ){
				$this->db->join( $join_tbl4, $join_condition4 );
			}
			if(  !empty($join_condition5) ){
				$this->db->join( $join_tbl5, $join_condition5 );
			}
			if(  !empty($join_condition6) ){
				$this->db->join( $join_tbl6, $join_condition6 );
			}
			if( !empty($offset) ){
				$this->db->limit($limit, $offset);
				
			}
			if( $all_record == 'N' ){
				
				$this->db->limit(4, 0);
			
			}
			if(  !empty($where_condition )){
				$this->db->where($where_condition);
			}
			
			if(  !empty( $group_by_field )){
				$this->db->group_by( $group_by_field );
			}
			
			if(  !empty($order_by_field )){
				$this->db->order_by( $order_by_field, $order_by_type );
			}
			
			$query = $this->db->get();//echo $this->db->last_query();
			$res  = $query->result();
			if($query->num_rows()>0)
			{
				return $response = $query->result();
			}
			
		}
		
			
	/* FOR CALENDER END FUNCTION */
	
			 
	 public function get_row_with_con($table,$where)
	 {
	 	$this->db->select('*');
		$this->db->from($table);
		$this->db->where($where);
		$query = $this->db->get();
		/*echo $this->db->last_query();
		die;*/
		return $query->row(); 
	 } 
	 
	 
	
		
}