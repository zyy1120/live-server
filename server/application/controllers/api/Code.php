<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Code extends CI_Controller {

	function __construct()
  {		
		parent::__construct();
    $this->load->model('Vcode_model','vcode'); 
	}


  public function signup() 
  {   
      $this->load->library('session');
      echo $this->vcode->doimg(); 
  	  $code = $this->vcode->getCode();
      $this->session->unset_userdata("signup_code");
      $this->session->set_userdata("signup_code",$code);
      return;
  }

}