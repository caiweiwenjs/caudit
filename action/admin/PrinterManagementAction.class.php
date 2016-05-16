<?php
import('Admin','action');
class PrinterManagementAction extends AdminAction{
    //private $role_list=array();
    public function __construct(){
        parent::__construct();
		$this->table_name = 'user_printer';
        //$this->role_list=$this->db->table('user_printer')->select();
        //$this->assign('role',$this->role_list);
    }
	/*
    //新增前操作
    protected function _before_insert(){
        if( $this->db_data['role_id']==1 && $_SESSION[SESSION_NAME]['role_id']!=1 ){
            $this->error('无法新增系统管理员用户！'); // 只有系统管理员才能增加系统管理员用户
        }
        $this->db_data['uname']=$this->checkUser();
        $this->db_data['pwd']=$this->checkPwd();
        $this->db_data['auth']='';//注意！授权字段不能动，保证安全
    }
    //修改前操作
    protected function _before_update(){
        $where['id']=(int)$_POST['id'];
        if($_SESSION[SESSION_NAME]['role_id'] != 1){
            if($this->db_data['role_id'] == 1){ // 只有系统管理员才能将其他角色的用户更改为系统管理员
                $this->error('无法更改用户为系统管理员！');
            }
            $user = $this->db->table('admin_user')->where($where)->find();
            if($user['role_id'] == 1){//只有系统管理员才能更改系统管理员
                $this->error('您无法更改系统管理员！'); 
            }
        }
        if(isset($this->db_data['uname'])){//用户名不能修改
            unset($this->db_data['uname']);
        }
        if(isset($this->db_data['auth'])){//注意！授权字段不能动，保证安全
            unset($this->db_data['auth']);
        }
        if($this->db_data['pwd']!=''){//密码不修改留空
            $this->db_data['pwd']=$this->checkPwd();
        }else{
            unset($this->db_data['pwd']);
        }
    }*/
	/*
    public function status(){
        $id = $this->get_id();
        $data['status']=$_GET['status']==1 ? 1 : 0;
        $msg = '设置成功！';
        $type = 'refresh';
        $err = 0;
        foreach($id as $v){
            $where['id']=(int)$v;
            if($_SESSION[SESSION_NAME]['role_id'] != 1){//非系统管理员只能设置非系统管理员用户
                $where['role_id'] = array('neq',1);
            }
            $result = $this->db->table('admin_user')->where($where)->data($data)->update();
            if(!$result>0){
                $err++;
                $msg = "出错！{$err}条数据无法成功设置！";
                $type = 'error';
            }
        }
        $this->success($msg,$type);
    }
    public function delete(){
        $id = $this->get_id();
        $msg = '删除成功！';
        $type = 'refresh';
        $err = 0;
        foreach($id as $v){
            $where['id'] = (int)$v;
            if($_SESSION[SESSION_NAME]['role_id'] != 1){//非系统管理员只能删除非系统管理员用户
                $where['role_id'] = array('neq',1);
            }
            $result = $this->db->table('admin_user')->where($where)->delete();
            if($result>0){
                $this->_after_delete($where['id']);
            }else{
                $err++;
                $msg = "删除出错！{$err}条数据无法删除！";
                $type = 'error';
            }
        }
        $this->success($msg,$type);
    }*/
}
?>