<?php if(!defined('APP_NAME')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>编辑用户</title>
<link rel="stylesheet" href="./template/hoho/css/style.css" type="text/css" />
<script type="text/javascript" src="./template/hoho/js/jquery.js"></script>
<script type="text/javascript" src="./template/hoho/js/jquery.form.js"></script>
<script type="text/javascript" src="./template/hoho/js/ajaxsubmit.js"></script>
</head>

<body>
<div class="wrap">
<form method="post" action="admin.php?a=AdminUser&f=update" class="ajax_form">
  <table cellspacing="1" class="myform">
    <tr>
      <th colspan="2">编辑用户</th>
    </tr>
    <tr>
      <td align="right">用户角色：</td>
      <td>
        <select name="role_id">
         <?php if(is_array($role)){foreach($role as $key=>$v){?>
          <option value="<?php echo $v['id'];?>" <?php if($vo['role_id']==$v['id']){ ?>selected="selected"<?php } ?>><?php echo $v['title'];?></option>
         <?php } } ?>
        </select>
      </td>
    </tr>
    <tr>
      <td align="right">用户名：</td>
      <td><input type="text" name="uname" size="25" value="<?php echo $vo['uname'];?>" disabled="disabled" class="input" /></td>
    </tr>
    <tr>
      <td align="right">密 码：</td>
      <td><input type="password" name="pwd" size="25" class="input" /> <font color="#FF0000"> * 不修改请留空</font></td>
    </tr>
    <tr>
      <td align="right">确认密码：</td>
      <td><input type="password" name="confirm_pwd" size="25" class="input" /></td>
    </tr>
    <tr>
      <td align="right">描 述：</td>
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