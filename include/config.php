<?php
header("Content-Type:text/html; charset=utf-8");
error_reporting(0);
date_default_timezone_set('PRC');//时区
define('AUTH_KEY','@@uadmin@@');//记住登录加密KEY
define('AUTH_NAME','uadminAuth');//记住登录COOKIE名称
?>