<?php
class Action{
    protected static $tpl;
    public function __construct(){
        $this->tpl = new tpl() ;
        $this->tpl->debug = DEBUG_MODE ;                         //是否开启调试模式
        $this->tpl->tpl_dir = TPL_PATH ;                         //模板目录
        $this->tpl->tpl_cache = CACHE_PATH.'compile/'.THEME ;    //模板编译缓存目录
        //路径替换
        $path_replace = array(
            0=>array('search'=>'./js/','replace'=>TPL_PATH.'js/'),
            1=>array('search'=>'./css/','replace'=>TPL_PATH.'css/'),
            2=>array('search'=>'./images/','replace'=>TPL_PATH.'images/'),
            3=>array('search'=>'./img/','replace'=>TPL_PATH.'img/'),
            4=>array('search'=>'../common/','replace'=>APP_ROOT.'template/common/'),
        );
        $this->tpl->tpl_replace = array_merge($this->tpl->tpl_replace,$path_replace);
    }
    //使用正则验证数据
    protected function regex($value,$rule) {
        $validate = array(
            'require'=> '/.+/',
            'email' => '/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/',
            'url' => '/^http|https:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"\"])*$/',
            'currency' => '/^\d+(\.\d+)?$/',
            'number' => '/^\d+$/',
            'zip' => '/^\d{6}$/',
            'integer' => '/^[-\+]?\d+$/',
            'double' => '/^[-\+]?\d+(\.\d+)?$/',
            'english' => '/^[A-Za-z]+$/',
            'uname' => '/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u',/* /^[".chr(0xa1)."-".chr(0xff)."A-Za-z0-9_]+$/   GB2312汉字字母数字下划线*/
        );
        // 检查是否有内置的正则表达式
        if(isset($validate[strtolower($rule)]))
            $rule = $validate[strtolower($rule)];
        return preg_match($rule,$value)===1;
    }
    protected function assign($name,$value){
        $this->tpl->assign($name,$value);
    }
    protected function display($file='',$ext='.html'){
        if(!$file) $file = ACTION_NAME.'_'.FUN_NAME;
        $this->tpl->display($file,$ext);
        exit();
    }
    //Action中不存在方法时，执行此方法
    public function _empty(){
        $template = ACTION_NAME.'_'.FUN_NAME;
        if(file_exists(TPL_PATH.$template.'.html')){//如果有此模板，渲染此模板
            $this->display($template);
        }else{
            throw_error('请求的方法不存在！');
        }
    }
    //是否ajax请求
    protected function isAjax() {
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) ) {
            if('xmlhttprequest' == strtolower($_SERVER['HTTP_X_REQUESTED_WITH']))
                return true;
        }
        if(!empty($_POST['ajax']) || !empty($_GET['ajax']))
            // 判断Ajax方式提交
            return true;
        return false;
    }
    //Ajax方式返回数据到客户端
    protected function ajaxReturn($result,$type='JSON'){
        if(strtoupper($type)=='JSON') {
            // 返回JSON数据格式到客户端 包含状态信息
            header("Content-type: application/json");
            exit(json_encode($result));
        }else{
            // TODO 增加其它格式
        }
    }
    //操作成功跳转方法
    protected function success($msg,$type='success'){
        if($this->isAjax()){
            $this->ajaxReturn(array('type'=>$type,'msg'=>$msg));
        }else{
            //非ajax提交的代码
            exit($msg);//暂时这样先
        }
    }
    //操作失败跳转方法
    protected function error($msg,$type='error'){
        if($this->isAjax()){
            $this->ajaxReturn(array('type'=>$type,'msg'=>$msg));
        }else{
            //非ajax提交的代码
            exit($msg);//暂时这样先
        }
    }
    //生成验证码
    public function verify(){
        import('Image');
        //Image::buildImageVerify(4,1,'png',52,22,'verify_code');
        Image::buildAnimateVerify(4,1,48,24,'verify_code');
    }
}//类结束
?>