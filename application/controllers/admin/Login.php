<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {

	 public function __construct(){

	 	parent:: __construct();
			$this->load->model('admin/admin_model');

		/* Load the libraries and helpers */

		//$this->output->enable_profiler(TRUE);	
	 }



	public function check_admin_login()	{

		$adminid= $this->session->userdata('adminid');

		if(empty($adminid) || $this->session->userdata('adminid')=='')
		{
			$this->session->set_flashdata('error','Please Login');

			redirect('administrator');

		}
	}

	

	

	// Admin login window show 

	 public function index()
	{  
		$this->load->view('admin/sign_in');
	}

	public function login_action()
	{	

			$data['user_details'] = $this->admin_model->check_login_credentials($this->input->post());

			if(isset($data['user_details']) && $data['user_details']!=''){
					$this->session->set_userdata('admin_details',$data['user_details']);

					$this->session->set_userdata('adminid', $data['user_details'][0]->id);
					$this->session->set_userdata('adminname',$data['user_details'][0]->username);
					$data['error']="Logged In Successfully";

					$userid = $this->session->userdata('adminid');
					if(isset($userid) && $userid !=''){
						redirect('administrator/dashboard');
					}
				}
				else
				{
					$data['error'] = "Invalide Username or password";
					$this->session->set_flashdata('error',$data['error']);
					redirect('administrator');

				}

	}

	

	public function dashboard()
	{

		$this->check_admin_login();

			$userid = $this->session->userdata('adminid');

		if( isset($userid) || $userid !='' ){

			$data['user_details'] = $this->admin_model->select_deatils ( $userid );

			$this->load->view( 'admin/header' );

			$this->load->view( 'admin/dashboard', $data );

			$this->load->view( 'admin/footer');

		} else {

			redirect('administrator');

		}

	}

	public function change_password()
	{

		$this->check_admin_login();

			$userid = $this->session->userdata('adminid');

		if( isset($userid) || $userid !='' ){

			$data['user_details'] = $this->admin_model->select_deatils ( $userid );

			$this->load->view( 'admin/header' );

			$this->load->view( 'admin/change_password', $data );

			$this->load->view( 'admin/footer');

		} else {

			redirect('administrator');

		}

	}

	public function change_password_action()
	{

		$this->check_admin_login();

		extract($this->input->post());

		$this->form_validation->set_rules('old_password', "Old Password", 'trim|required');

		$this->form_validation->set_rules('new_password', "New Password", 'trim|required');

		$this->form_validation->set_rules('confirm_password', "Confirm Password", 'trim|required|matches[new_password]');

		

		if ($this->form_validation->run() == FALSE){

			//$data['reset'] = false;

		//	$data['country'] 	= $this->user_model->get_country('countries' );

			$userid = $this->session->userdata('adminid');

			$data['user_details'] = $this->admin_model->select_deatils ( $userid );

			$this->load->view( 'admin/admin_header' );

			$this->load->view( 'admin/change_password', $data );

			$this->load->view( 'admin/admin_footer');

		}else{

					$old_pass  	 = $old_password;

					$new_pass  	 = $new_password;

					$userid		 = $this->session->userdata('adminid');

					$chk_old_pass = $this->admin_model->check_old_password ( $old_pass,$userid );

					$count 		  = $chk_old_pass[0]->c;

					

						if( $count >=1 ){

							$update_pass   = $this->admin_model->update_password ( $new_pass,$userid );

						//	redirect('administrator');

							

							$data['sucess'] = ' Password Updated sucessfully!';

							$this->session->set_flashdata('sucess', $data['sucess']);

							redirect('administrator/change-password');

							

						} else {

							$data['error'] = ' Old password is not correct';

							$this->session->set_flashdata('error', $data['error']);

							redirect('administrator/change-password');

						}

		}

	}

		

	public function signout()

	{	

		$this->session->unset_userdata('admin_details');

		$this->session->unset_userdata('adminid');

		$this->session->unset_userdata('adminname');

		$this->session->sess_destroy();

		redirect('administrator');

	}

	

	

}





?>