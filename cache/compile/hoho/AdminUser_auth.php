<?php if(!defined('APP_NAME')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户受权</title>
<link rel="stylesheet" href="./template/hoho/css/style.css" type="text/css" />
<script type="text/javascript" src="./template/hoho/js/jquery.js"></script>
<script type="text/javascript" src="./template/hoho/js/jquery.form.js"></script>
<script type="text/javascript" src="./template/hoho/js/ajaxsubmit.js"></script>
<script type="text/javascript" src="./template/hoho/js/fun.js"></script>
</head>

<body>
<div class="wrap">
<form method="post" action="" class="ajax_form">
  <table cellspacing="1" class="myform">
    <tr>
      <th>用户授权</th>
    </tr>
    <tr class="mylist_title">
      <td style="text-align:left;"><a href="javascript:allSelect('auth_id[]')"> 全选</a> | <a href="javascript:InverSelect('auth_id[]')">反选</a> | <a href="javascript:allUnSelect('auth_id[]')">全不选</a></td>
    </tr>
    <tr>
      <td>
      <?php if(is_array($auth_list)){foreach($auth_list as $key=>$vo){?>
          <h3 style="clear:both;"><?php echo $vo['title'];?></h3>
        <?php if(is_array($vo['_child'])){foreach($vo['_child'] as $key=>$child){?>
            <label style="white-space:nowrap;float:left;">
            <input type="checkbox" name="auth_id[]" class="checkbox" value="<?php echo $child['id'];?>" <?php if(in_array($child['id'],$user_auth)){ ?>checked="checked"<?php } ?> /> <?php echo $child['title'];?>
            </label>
        <?php } } ?>
      <?php } } ?>
      </td>
    </tr>
    <tr>
      <td align="center"><input type="submit" value="提 交" class="btn ajax_btn" /><input type="hidden" name="update" value="1" /></td>
    </tr>
  </table>
</form>
</div>
</body>
</html>