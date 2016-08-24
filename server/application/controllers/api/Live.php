<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Live extends CI_Controller {
    
  
	public function room()
	{
        // $this->output->enable_profiler(TRUE);
		$this->load->database();
		$this->load->library('session');

		$this->load->model('Auth_model');
		$user  =  $this->Auth_model->userinfo();
        $this->load->model('Chat_model','chat');
        $chat = $user['role'] != 1 ? $this->chat->get() : $this->chat->getAll();
        $res = array(
        	'user' => $user,
        	'chat' => $chat
        	);
        echo json_encode($res);
	}

	
}
