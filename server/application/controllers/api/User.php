<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    
    //登陆
	public function signin()
	{
		$this->load->database();
		$req = $this->input->post();
		$this->load->model('User_model','user');
		$user = array(
             'username' => $req['username'],
             'password' => $req['password']
            );
		$res = $this->user->auth($user);
		echo json_encode($res);
		return;
	}

	//注册s
	public function signup()
	{
		$this->load->database();
		$req = $this->input->post();
		$this->load->model('User_model','user');
		$user = array(
             'username' => $req['username'],
             'password' => $req['password'],
             'name' => $req['name'],
             'phone' => $req['phone']
            );
		$res = $this->user->create_user($user);
		echo json_encode($res);
		return;
	}

}
