<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {
    
    public function __construct()
    {  
      parent::__construct();   
    }
    
	public function get()
	{
        // $this->output->enable_profiler(TRUE);
		$this->load->database();
		$this->load->library('session');
       
		$this->load->model('Auth_model');
		$user  =  $this->Auth_model->userinfo();
        $this->load->model('Chat_model','chat');
        $utime = $this->input->get('t');
        if(is_numeric($utime))
        {
            $chat = $user['role'] != 1 ? $this->chat->get($utime) : $this->chat->getAll($utime);
            $res = $chat;
        }
         else
         {
            $res = array(
            	'code' => 0,
            	'msg' => '输入异常'
            	);
         }
        echo json_encode($res);
	}

	public function set()
	{
        // $this->output->enable_profiler(TRUE);
		$this->load->database();
		$this->load->library('session');
    $this->load->model('Chat_model','chat');
    $content = $this->input->post('content');
    $res = $this->chat->save($content);
    echo json_encode($res);
	}

  public function remove()
  {
    $this->load->database();
    $this->load->library('session');
    $this->load->model('Chat_model','chat');
    $id = $this->input->post('id');
     $res = array(
              'code' => 1,
              'msg' => '删除成功'
              );
    $this->chat->remove($id);
     echo json_encode($res);
  }

  public function activate()
  {
    $this->load->database();
    $this->load->library('session');
    $this->load->model('Chat_model','chat');
    $id = $this->input->post('id');
    $this->chat->activate($id);
    $res = array(
              'code' => 1,
              'msg' => '审核通过'
            );
     echo json_encode($res);
  }
  
   	
}
