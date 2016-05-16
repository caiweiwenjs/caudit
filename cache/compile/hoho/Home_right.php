<?php if(!defined('APP_NAME')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>内容首页</title>
<link rel="stylesheet" href="./template/hoho/css/style.css" type="text/css" />
</head>

<body>
<div class="wrap" style="width:94%;">
<div class="list_title">
    <p>服务器相关信息</p>
</div>
<ul class="list">
    <?php if(is_array($info)){foreach($info as $key=>$val){?>
    <li><font class="title"><?php echo $key;?>：</font><font><?php echo $val;?></font></li>
    <?php } } ?>
</ul>
</div>
</body>
</html>