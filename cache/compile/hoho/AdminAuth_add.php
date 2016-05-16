<?php if(!defined('APP_NAME')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新增权限</title>
<link rel="stylesheet" href="./template/hoho/css/style.css" type="text/css" />
<script type="text/javascript" src="./template/hoho/js/jquery.js"></script>
<script type="text/javascript" src="./template/hoho/js/jquery.form.js"></script>
<script type="text/javascript" src="./template/hoho/js/ajaxsubmit.js"></script>
</head>

<body>
<div class="wrap">
<form method="post" action="admin.php?a=AdminAuth&f=insert" class="ajax_form">
  <table cellspacing="1" class="myform">
    <tr>
      <th colspan="2">新增权限</th>
    </tr>
    <tr>
      <td align="right">上级</td>
      <td><select name="pid">
        <option value="0">根目录</option>
         <?php if(is_array($parent_auth)){foreach($parent_auth as $key=>$v){?>
          <option value="<?php echo $v['id'];?>"><?php echo $v['title'];?></option>
         <?php } } ?>
        </select></td>
    </tr>
    <tr>
      <td align="right">标题名称：</td>
      <td><input type="text" name="title" size="25" class="input" dataType="require" title="请输入名称" /></td>
    </tr>
    <tr>
      <td align="right">所属Action名称：</td>
      <td><input type="text" name="auth_action" size="25" class="input" /></td>
    </tr>
    <tr>
      <td align="right">所属Action方法：</td>
      <td><input type="text" name="auth_fun" size="25" class="input" /> <font color="#FF0000">以,分隔且以,结尾（多操作组合成一个权限）</font> </td>
    </tr>
    <tr>
      <td align="right">菜单名称：</td>
      <td><input type="text" name="menu_name" size="25" class="input" /> <font color="#FF0000">非菜单留空</font> </td>
    </tr>
    <tr>
      <td align="right">菜单地址：</td>
      <td><input type="text" name="menu_url" size="48" class="input" /></td>
    </tr>
    <tr>
      <td align="right">排 序：</td>
      <td><input type="text" name="orderid" size="6" class="input" /></td>
    </tr>
    <tr>
      <td align="right">状 态：</td>
      <td>
        <select name="status">
         <?php myselect('启用:1,锁定:0',$vo['status']); ?>
        </select>
        </td>
    </tr>
    <tr>
      <td align="right"></td>
      <td>
        <input type="submit" value="提 交" class="btn ajax_btn" />
      </td>
    </tr>
  </table>
</form>
</div>
</body>
</html>