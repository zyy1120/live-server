<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
   
*/
class Chat_model extends CI_Model {  

    public function __construct()
    {  
    	$this->tbl = 'chat_content';
      $this->tbl_key = 'id';
      parent::__construct();   
    }

    function get($limit = 30)
    {

      $res = $this->db->from($this->tbl)
           ->select('id,uid,name,content,role,level,utime')
           ->where('status','1')
           ->order_by('utime','desc')
           ->limit($limit)
           ->get()->result_array();
      return $res;
    }

    function getAll($limit = 100)
    {

      $res = $this->db->from($this->tbl)
           ->select('id,uid,name,content,role,level,utime')
           ->where('status','1')
           ->or_where('status','0')
           ->order_by('utime','desc')
           ->limit($limit)
           ->get()->result_array();
      return $res;
    }

    function save()
    { 
      $req = $this->input->post();
      $this->load->helper('string');
      $content = trim(html2text($req['content']));
      $res['code'] ='0';
      if($content == '')
      {
         $res['msg'] ='内容不能为空';
      }
      else if(strlen($content)>250)
      {
         $res['msg'] ='内容超过限制';
      }
      else
      {
        $this->load->model('Auth_model','auth');
        $user = $this->auth->userinfo();
        $status
        $now = time();
        $chat = array(
          'uid' => $user['uid'],
          'name'=>$user['name'],
          'content'=>$content,
          'role'=>$user['role'],
          'level'=>$user['level'],
          'utime'=>$now,
          'ctime'=>$now,
          'ip'=>long2ip($this->input->ip_address()),
          'status'=>
          );
        $this->db->insert($this->tbl, $data);
        $res['code'] ='1';
        $res['msg'] ='内容发布成功';
      }
      echo json_encode($res);
      return;

    }

    function remove($id)
    {
      $role = array('status','-1');
      $this->db->where('id',$id)
           ->update($this->tbl, $role);
    }

    function activate($id)
    {
      $role = array('status','1');
      $this->db->where('id',$id)
           ->update($this->tbl, $role);
    }
   
  }