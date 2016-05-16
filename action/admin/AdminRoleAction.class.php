<?php
import('Admin','action');
class AdminRoleAction extends AdminAction{
    //用户角色授权
    public function auth(){
        $where['id']=(int)$_GET['role_id'];
        if($_POST['update']==1){
            if(is_array($_POST['auth_id'])){
                $data['auth']=implode(',',$_POST['auth_id']);
            }else{
                $data['auth']='';
            }
            $result=$this->db->table('admin_role')->data($data)->where($where)->update();
            if($result>0){
                $this->success('更新成功！');
            }elseif($result===0){
                $this->error('没有变化！');
            }else{
                $this->error('更新失败！');
            }
        }
        $role_info=$this->db->table('admin_role')->field('auth')->where($where)->find();
        $role_auth=explode(',',$role_info['auth']);
        $this->assign('role_auth',$role_auth);
        $auth_list=$this->db->table('admin_auth')->field('id,title,pid')->order('orderid')->select();
        $auth_list=list_to_tree($auth_list);//转换成Tree
        $this->assign('auth_list',$auth_list);
        $this->display();
    }
    protected function _before_update(){
        $id = (int)$_POST['id'];
        if( $id==1 && $_SESSION[SESSION_NAME]['role_id']!=1 ){
            $this->error('无法更改系统管理员！'); //role id 为1是系统管理员，只有系统管理员本身能修改此条记录的信息
        }
        if( $id==1 && $_POST['status']=='0' ) $this->error('无法锁定系统管理员！');//谁都无法锁定系统管理员
        if(isset($this->db_data['auth'])){//注意！授权字段不能动，保证安全
            unset($this->db_data['auth']);
        }
    }
    protected function _before_insert(){
        $this->db_data['auth']='';//注意！授权字段不能动，保证安全
    }
    protected function check_id($id){
        if( in_array(1,$id) ) $this->error('无法更改系统管理员！'); // role id为1是系统管理员，无法删除和锁定等
    }
}
?>