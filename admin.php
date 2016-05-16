<?php
$_beginTime = microtime(TRUE);

session_start();


define('APP_TITLE','打印审核管理后台');
define('APP_NAME','admin');//项目名称
define('APP_ROOT','./');//项目路径
define('CACHE_PATH',APP_ROOT.'cache/');//缓存目录
define('DEBUG_MODE',true);//调试模式，生产环境一定要设为false
define('USE_DB',true);//是否使用数据库
define('THEME','hoho');//模板主题
define('TPL_PATH',APP_ROOT.'template/'.THEME.'/');//模板目录
define('SESSION_NAME','admin');//session名称

//不需要自动转义，db类构建的sql语句已自动转义，如果要写原生sql语句，请自行转义
//（放前一点，要不然在它之前的代码就起不到这个作用）
if(get_magic_quotes_gpc()){
    function stripslashes_deep($value){
        $value = is_array($value) ?
             array_map('stripslashes_deep', $value) :
             stripslashes($value);
        return $value;
    }
    $_POST = array_map('stripslashes_deep', $_POST);
    $_GET = array_map('stripslashes_deep', $_GET);
    $_COOKIE = array_map('stripslashes_deep', $_COOKIE);
    $_REQUEST = array_map('stripslashes_deep', $_REQUEST);
}

//包含运行时文件
$runtime_cache_file = CACHE_PATH.APP_NAME.'_runtime.php';//运行时缓存文件
if(DEBUG_MODE||!is_file($runtime_cache_file)){//调试模式下不加载缓存文件
    require(APP_ROOT.'include/runtime.php');
}else{
    require($runtime_cache_file);
}

//获取需要操作的Action名称
$act = empty($_GET['a']) ? 'Home' : $_GET['a'];
//获取需要操作的Action方法
$fun = empty($_GET['f']) ? 'index' : $_GET['f']; //默认执行index方法
//需要在实例化类之前定义这两常量，否则类的__construct方法中无法获取     
define('ACTION_NAME',$act);//定义Action名称
define('FUN_NAME',$fun);//定义方法名称
$action = A($act,'Admin');//实例化Action。如果Action不存在则实例化的是Admin这个基础Action
if(!method_exists($action,$fun)){ //方法不存在，则执行_empty方法
    $fun = '_empty';
}

//执行需要操作的Action中的function
$action->$fun();

$_endTime = microtime(TRUE);
//echo 'Processed in '.($_endTime-$_beginTime).' second(s)';
?>