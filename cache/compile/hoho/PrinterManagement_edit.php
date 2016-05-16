<?php if(!defined('APP_NAME')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>编辑用户打印机</title>
<link rel="stylesheet" href="./template/hoho/css/style.css" type="text/css" />
<script type="text/javascript" src="./template/hoho/js/jquery.js"></script>
<script type="text/javascript" src="./template/hoho/js/jquery.form.js"></script>
<script type="text/javascript" src="./template/hoho/js/ajaxsubmit.js"></script>
</head>

<body>
<div class="wrap">
<form method="post" action="admin.php?a=PrinterManagement&f=update" class="ajax_form">
  <table cellspacing="1" class="myform">
    <tr>
      <th colspan="2">编辑用户打印机</th>
    </tr>
    <tr>
      <td align="right">用户名：</td>
      <td><input type="text" name="uname" size="25" value="<?php echo $vo['user_name'];?>" disabled="disabled" class="input" /></td>
    </tr>
    <tr>
      <td align="right">打印机名：</td>
      <td><input type="text" name="pname" size="25" value="<?php echo $vo['printer_name'];?>" class="input" /></td>
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