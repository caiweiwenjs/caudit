<?php if(!defined('APP_NAME')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>清空网站缓存</title>
<link rel="stylesheet" href="./template/hoho/css/style.css" type="text/css" />
<script type="text/javascript" src="./template/hoho/js/jquery.js"></script>
<script type="text/javascript" src="./template/hoho/js/jquery.form.js"></script>
<script type="text/javascript" src="./template/hoho/js/ajaxsubmit.js"></script>
</head>

<body>
<div class="wrap">
<form class="ajax_form" method="post" action="">
<table cellspacing="1" class="myform wrap">
  <tr>
    <th colspan="2">清空网站缓存</th>
  </tr>
  <tr>
    <td width="180"><input type="checkbox"  name="cache[0]" class="checkbox fl" style="margin:6px 20px 0 0;" checked="checked" /><h3 class="fl">数据缓存</h3></td>
    <td><font color="#FF0000">一般情况下，只需要清空数据缓存则可。</font></td>
  </tr>
  <tr>
    <td><input type="checkbox" name="cache[1]" class="checkbox fl" style="margin:6px 20px 0 0;" /><h3 class="fl">编译缓存</h3></td>
    <td>如果你修改了模板文件或者核心函数库、类库等，则需要清空编译缓存</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="cache[2]" class="checkbox fl" style="margin:6px 20px 0 0;" /><h3 class="fl">数据库结构缓存</h3></td>
    <td>如果你修改了数据库表的结构，则需要清空数据库结构缓存</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="cache[3]" class="checkbox fl" style="margin:6px 20px 0 0;" /><h3 class="fl">缩略图缓存</h3></td>
    <td>缩略图缓存基本上极少需要清空。</td>
  </tr>
  <tr>
      <td colspan="2" align="center"><input type="submit" value="提 交" class="btn" /></td>
  </tr>
</table> 
</form>
</div>
</body>
</html>