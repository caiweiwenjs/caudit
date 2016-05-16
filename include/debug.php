<?php
//调试模式下包含的文件

//打开错误提示
ini_set('display_errors','On');
error_reporting(E_ERROR | E_WARNING | E_PARSE);

// 浏览器友好的变量输出（调试用）
function dump($var) {
    ob_start();
    var_dump($var);
    $output = ob_get_clean();
    if (!extension_loaded('xdebug')) {
        $output = preg_replace("/\]\=\>\n(\s+)/m", '] => ', $output);
        $output = '<pre>' . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
    }
    echo $output;
}
?>