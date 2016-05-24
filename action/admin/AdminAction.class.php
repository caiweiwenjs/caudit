<?php
import('','action');//加载基础action
class AdminAction extends Action{

    protected $db; //数据库类对象
    protected $search_where = array();//列表页面查询条件，用于构造sql语句
    protected $search_value = array();//列表页面查询条件，用于表单赋值
    protected $db_data = array();//用于保存insert,update的数据
    protected $table_name='';//表名
    protected $order_by='id desc';//排序
    protected $list_num=20;//每页显示记录数

    public function __construct(){
        if(!isset($_SESSION[SESSION_NAME])){//登录检测
            if( $this->isAjax() ) $this->error('登录超时，请重新登录！');
            $url=U(array('a'=>'User','f'=>'login'));
            redirect($url);
        }else{
            $this->db = new db();
            if($_SESSION[SESSION_NAME]['role_id']!=1){//非系统管理员需要验证权限
                $this->checkAuth();//权限验证
            }
        }
        parent::__construct();
        $this->assign('session',$_SESSION[SESSION_NAME]);
    }
    //权限验证
    protected function checkAuth(){
        $where['auth_action']=ACTION_NAME;
        $where['auth_fun']=array('like','%'.FUN_NAME.',%');
        $auth=$this->db->table('admin_auth')->field('id,status')->where($where)->find();
        if(!$auth) $this->error('此操作没有设置权限，不能进行操作！');
        if($auth['status']!=1) $this->error('此操作被禁用！');
        if(!in_array($auth['id'],$_SESSION[SESSION_NAME]['auth'])) $this->error('对不起，您无权限进行此操作！');
    }
    //获取表名
    protected function get_table(){
        return $this->table_name ? $this->table_name : parse_name(ACTION_NAME);
    }
    //获取字段信息.有缓存,更改数据表结构记得删除缓存
    protected function getFields($table=''){
        $cache_path = CACHE_PATH.'fields/';
        if(!$table) $table = $this->get_table();
        $fields=F($table,'',$cache_path);
        if($fields) return $fields;
        $query = $this->db->query('SHOW COLUMNS FROM '.DB_PREFIX.$table);
        $result = $this->db->getAll($query);
        $fields=array();
        foreach($result as $v){
            $fields[]=$v['Field'];
        }
        F($table,$fields,$cache_path);
        return $fields;
    }
    //根据数据表字段信息获取POST数据
    protected function getPostData($table=''){
        $fields=$this->getFields($table);
        $data=array();
        foreach($fields as $k){
            if(isset($_POST[$k]) && !is_array($_POST[$k]))
                $data[$k]=trim($_POST[$k]);
        }
        $this->db_data=$data;
        return $data;
    }
    //更新，插入的前置操作
    //通常用来验证数据，或填充数据
    protected function _before_update(){
    }
    protected function _before_insert(){
    }
    //删除后置操作 (通常用来删除关联数据)
    protected function _after_delete($id){
    }
    //检查、得到要操作的ID，比如删除、设置状态时用到
    protected function check_id($id){
    }
    protected function get_id(){
        $id=$_REQUEST['id'];
        if(empty($id)){
            $this->error('请选择要操作的记录！');
        }
        if(!is_array($id)){//批量支持，不是数组搞成数组，这样就一视同仁了
            $id=(array)$id;
        }
        $this->check_id($id);
        return $id;
    }
    //公用的列表页查询方法
    protected function _search(){
        if($_POST['search_where']){
            $where=array();
            foreach($_POST['search_where'] as $key=>$val){
                foreach($val as $k=>$v){
                   if($v=='') continue;//if(!$v)这样写法如果值为0不行
                   if($k=='like'){
                       $where[$key]=array($k,'%'.$v.'%');
                   }elseif($k=='exp'){
                       $v=explode('-',$v);
                       $where[$key]=array($v[0],(int)$v[1]);
                   }elseif($k=='and'||$k=='or'){
                       foreach($v as $k2=>$v2){
                           if($v2=='') continue;
                           if($k2=='gt_date'){
                               $where[$key][]=array('gt',strtotime($v2));
                           }elseif($k2=='lt_date'){
                               $where[$key][]=array('lt',strtotime("$v2 +1 day"));
                           }else{
                               $where[$key][]=array($k2,$v2);
                           }
                       }
                       if($where[$key]) $where[$key][]=$k;
                   }else{
                       $where[$key]=array($k,$v);
                   }
                }
            }
            $this->search_where = array_merge($this->search_where,$where);
            $_SESSION['search_where'] = $this->search_where;
            $this->search_value = array_merge($this->search_value,$_POST['search_where']);
            $_SESSION['search_value'] = $this->search_value;
        }
    }
    //列表数据格式化
    protected function format_list(&$list){
    }
    //默认列表页
    public function index(){
        $table=$this->get_table();
        if($_GET['do']=='search'){//查询
            $this->_search();
            $this->search_where = $_SESSION['search_where'];
            $this->search_value = $_SESSION['search_value'];
            $this->assign('search_where',$this->search_value);
        }
        $count=$this->db->table($table)->where($this->search_where)->count('id');
        if($count==0) $this->display();
        import('Page');
        $Page = new Page($count,$this->list_num);
        $limit=$Page->firstRow.','.$Page->listRows;
        $list=$this->db->table($table)->where($this->search_where)->order($this->order_by)->limit($limit)->select();
        //echo $this->db->getSql();
        $this->format_list($list);
        $page=$Page->show();
        $this->assign('list',$list);
        $this->assign('page',$page);
        $this->display();
    }
    //默认内容页
    public function view(){
        $this->edit();
    }
    //默认编辑页
    public function edit(){
        $table=$this->get_table();
        $id=(int)$_GET['id'];
        $vo=$this->db->table($table)->where('id='.$id)->find($id);
        $this->assign('vo',$vo);
        $this->display();
    }
    //默认更新操作
    public function update(){
        $table=$this->get_table();
        $where['id']=(int)$_POST['id'];
        //收集数据
        $this->getPostData();
        //更新之前操作
        $this->_before_update();
        unset($this->db_data['id']);//id是更新条件，不是要更新的字段
        //进行更新
        $result=$this->db->table($table)->where($where)->data($this->db_data)->update();
        if($result>0){
            $this->success('更新成功！');
        }elseif($result===0){
            $this->error('没有变化！');
        }else{
            $this->error('更新失败！');
        }
    }
    //默认插入操作
    public function insert(){
        $table=$this->get_table();
        //收集数据
        $this->getPostData();
        //插入之前操作
        $this->_before_insert();
        //进行插入
        $result=$this->db->table($table)->data($this->db_data)->insert();
        if($result>0){
            $this->success('新增成功！');
        }else{
            $this->error('新增失败！');
        }
    }
    //默认删除操作
    public function delete(){
        $table=$this->get_table();
        $id = $this->get_id();
        $msg = '删除成功！';
        $type = 'refresh';
        $err = 0;
        foreach($id as $v){
            $where['id']=(int)$v;
            $result = $this->db->table($table)->where($where)->delete();
            if($result>0){
                $this->_after_delete($where['id']);
            }else{
                $err++;
                $msg = "删除出错！{$err}条数据无法删除！";
                $type = 'error';
            }
        }
        $this->success($msg,$type);
    }
    //默认设置状态操作
    public function status(){
        $table=$this->get_table();
        $id = $this->get_id();
        $data['status']=$_GET['status'];//==1 ? 1 : 0;
        $msg = '设置成功！';
        $type = 'refresh';
        $err = 0;
        foreach($id as $v){
            $where['id']=(int)$v;
            $where['status'] = 0; //状态为新提交才能审核
            $result = $this->db->table($table)->where($where)->data($data)->update();
            if(!$result>0){
                $err++;
                $msg = "出错！{$err}条数据无法成功设置！";
                $type = 'error';
            }
        }
        $this->success($msg,$type);
    }
}//类定义结束
?>