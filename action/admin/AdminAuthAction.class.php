<?php
import('Admin','action');
class AdminAuthAction extends AdminAction{
    protected function _after_delete($id){//父亲删除了，孩子也一起删除
        $where['pid']=$id;
        $this->db->table('admin_auth')->where($where)->delete();
    }
    private function parent_auth(){
       $list=$this->db->table('admin_auth')->where('pid=0')->order('orderid')->select();
       $this->assign('parent_auth',$list);
    }
    public function index(){
        $list=$this->db->table('admin_auth')->order('orderid')->select();
        $list=list_to_tree($list);//转换成Tree
        $this->assign('list',$list);
        $this->display();
    }
    public function add(){
        $this->parent_auth();
        $this->display();
    }
    public function edit(){
        $this->parent_auth();
        parent::edit();
    }
}
?>