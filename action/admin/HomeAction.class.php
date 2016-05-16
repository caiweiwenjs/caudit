<?php
import('Admin','action');
class HomeAction extends AdminAction{

    protected function checkAuth(){//无需验证权限
    }
    public function index(){
        $this->left();
        $this->display();
    }
    public function left(){
        if($_SESSION[SESSION_NAME]['role_id']==1){//role id 为1是系统管理员，显示所有菜单
            $where='menu_name!=""';
        }else{//其他角色根据权限查询菜单列表
            $ids=implode(',',$_SESSION[SESSION_NAME]['auth']);
            if(!$ids) $this->display();//什么权限都没有的情况。
            $where='(id in('.$ids.') or pid=0) AND menu_name!=""';
        }
        $list=$this->db->table('admin_auth')->where($where)->order('orderid')->select();
        $list=list_to_tree($list);//转换成Tree
        foreach($list as $key=>$val){//过滤子菜单为空的一级菜单
            if(!$val['_child']) unset($list[$key]);
        }
        $this->assign('menu',$list);
        $this->display();  
    }
    public function right(){
        $info = array(
            '操作系统'=>PHP_OS,
            '运行环境'=>$_SERVER["SERVER_SOFTWARE"],
            'PHP运行方式'=>php_sapi_name(),
            '上传附件限制'=>ini_get('upload_max_filesize'),
            '执行时间限制'=>ini_get('max_execution_time').'秒',
            '内存使用限制'=>ini_get('memory_limit'),
            '脚本时间'=>date("Y年n月j日 H:i:s"),
            //'北京时间'=>gmdate("Y年n月j日 H:i:s",time()+8*3600),
            //'服务器域名/IP'=>$_SERVER['SERVER_NAME'].' [ '.gethostbyname($_SERVER['SERVER_NAME']).' ]',
            'safe_mode'=>(1===get_cfg_var('safe_mode'))?'Off':'On',
            'register_globals'=>get_cfg_var("register_globals")=="1" ? "On" : "Off",
            'magic_quotes_gpc'=>(1===get_magic_quotes_gpc())?'YES':'NO',
            'magic_quotes_runtime'=>(1===get_magic_quotes_runtime())?'YES':'NO',
            'phpinfo()'=>'<a target="_blank" href="'.U(array('m'=>'Home','f'=>'myphpinfo')).'">查看</a>',
        );
        $this->assign('info',$info);
        $this->display();
    }
    public function myphpinfo(){
        phpinfo();
    }
    public function cache(){ //清空缓存
        if($_POST['cache']){
            $path = array(0=>'data',1=>'compile',2=>'fields',3=>'images');
            foreach($_POST['cache'] as $k=>$v){
                $this->_cache(CACHE_PATH.$path[$k]);
                if($k==1) $this->_cache(CACHE_PATH,false);
            }
            $this->success('清理缓存完毕！');
        }else{
            $this->display();
        }
    }
    private function _cache($directory=CACHE_PATH,$child=true){
        $handle = opendir($directory);
        while (($file = readdir($handle)) !== false){
            if ($file != "." && $file != ".."){
                if(is_dir("$directory/$file")){
                    if($child == false) continue;
                    $this->_cache("$directory/$file");
                }else{
                    unlink("$directory/$file");
                }
            }
        }
        closedir($handle);
    }
}
?>