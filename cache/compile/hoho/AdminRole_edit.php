<?php if(!defined('APP_NAME')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>编辑用户角色</title>
<link rel="stylesheet" href="./template/hoho/css/style.css" type="text/css" />
<script type="text/javascript" src="./template/hoho/js/jquery.js"></script>
<script type="text/javascript" src="./template/hoho/js/jquery.form.js"></script>
<script type="text/javascript" src="./template/hoho/js/ajaxsubmit.js"></script>
</head>

<body>
<div class="wrap">
<form method="post" action="admin.php?a=AdminRole&f=update" class="ajax_form">
  <table cellspacing="1" class="myform">
    <tr>
      <th colspan="2">编辑用户角色</th>
    </tr>
    <tr>
      <td align="right">名 称：</td>
      <td><input type="text" name="title" size="25" value="<?php echo $vo['title'];?>" class="input" dataType="require" title="请输入角色名" /></td>
    </tr>
    <tr>
      <td align="right">内 容：</td>
      <td>
          <textarea name="description" cols="68" rows="6" class="input"><?php echo $vo['description'];?></textarea>
      </td>
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
      <td align="right"><input type="hidden" name="id" value="<?php echo $vo['id'];?>" /></td>
      <td>
        <input type="submit" value="提 交" class="btn ajax_btn" />
      </td>
    </tr>
  </table>
</form>
</div>
</body>
</html>