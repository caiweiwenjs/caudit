<?php if(!defined('APP_NAME')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>审核管理</title>
<link rel="stylesheet" href="./template/hoho/css/style.css" type="text/css" />
<script type="text/javascript" src="./template/hoho/js/jquery.js"></script>
<script type="text/javascript" src="./template/hoho/js/jquery.form.js"></script>
<script type="text/javascript" src="./template/hoho/js/ajaxsubmit.js"></script>
<script type="text/javascript" src="./template/hoho/js/fun.js"></script>
<script type="text/javascript" src="./template/hoho/js/list.js"></script>
</head>

<body>
<div class="wrap">
  <div class="search">
  <form action="admin.php?a=AuditManagement&do=search" method="post">
     状态：
     <input type="text" name="search_where[status][like]" size="12" value="<?php echo $search_where['status']['like'];?>" class="input" />  
     用户名：
     <input type="text" name="search_where[user_name][like]" size="12" value="<?php echo $search_where['user_name']['like'];?>" class="input" />
    打印机名：
	<input type="text" name="search_where[printer_name][like]" size="12" value="<?php echo $search_where['printer_name']['like'];?>" class="input" />
	标题：
	<input type="text" name="search_where[title][like]" size="12" value="<?php echo $search_where['title']['like'];?>" class="input" />
	份数：
	<input type="text" name="search_where[copies][like]" size="12" value="<?php echo $search_where['copies']['like'];?>" class="input" />
	提交时间：
	<input type="text" name="search_where[submit_time][like]" size="12" value="<?php echo $search_where['submit_time']['like'];?>" class="input" />
    <input type="submit" class="btn_s" value="查 询" />
  </form>
  </div>
  <form action="" method="post" id="form_data_list">
  <table cellspacing="1" class="mylist">
    <thead>
    <tr>
      <th colspan="9"><div class="relative">打印请求列表
	  </div></th>
    </tr>
    <tr class="mylist_title">
      <td width="28" ><input type="checkbox" class="checkbox" onclick="InverSelect();" /></td>
	  <td width="80" >状 态</td>
      <td>用户名</td>
      <td>打印机名</td>
	  <td>标 题</td>
      <td width="50">份 数</td>
	  <td width="140">提交时间</td>
	  <td width="80">审 核</td>
      <td width="102">操 作</td>
    </tr>
    </thead>
    <tbody>
    <?php if(is_array($list)){foreach($list as $key=>$vo){?>
    <tr class="datalist">
      <td align="center"><input name="id[]" type="checkbox" value="<?php echo $vo['id'];?>" class="checkbox" /></td>
      <td align="center"><?php echo $vo['status'];?></td>
      <td align="center"><?php echo $vo['user_name'];?></td>
	  <td align="center"><?php echo $vo['printer_name'];?></td>
	  <td align="center"><?php echo $vo['title'];?></td>
	  <td align="center"><?php echo $vo['copies'];?></td>
	  <td align="center"><?php echo $vo['submit_time'];?></td>
	  <td align="center"><?php if($vo['status']==1){ ?>
<a target="_ajax" title="点击锁定" href="<?php echo U(array('f'=>"status",'id'=>"{$vo['id']}",'status'=>"0")); ?>"><img src="./template/hoho/images/status_1.gif" width="14" height="14" alt="启用" /></a>
<?php }else{ ?>
<a target="_ajax" title="点击启用" href="<?php echo U(array('f'=>"status",'id'=>"{$vo['id']}",'status'=>"1")); ?>"><img src="./template/hoho/images/status_0.gif" width="14" height="14" alt="锁定" /></a>
<?php } ?></td>
      <td align="center" class="action"><a class="win_big" href="<?php echo U(array('f'=>"view",'id'=>"{$vo['id']}")); ?>" title="查看PDF文件"><img src="./template/hoho/images/view.gif" alt="查看PDF文件" width="16" height="16" /></a></td>
    </tr>
    <?php } } ?>
    </tbody>
  </table>
  <div class="mylist_foot">
    <div class="fl" style="margin-left:10px;_margin-left:5px;"><img src="./template/hoho/images/arrow.gif" width="26" height="30" alt="请选择" />
<a href="javascript:allSelect()"> 全选</a> | <a href="javascript:InverSelect()">反选</a> | <a href="javascript:allUnSelect()">全不选</a> | 对选中项进行
<select onchange="selectSubmit(this,'form_data_list')">
    <option>请选择</option>
    <option value="admin.php?a=AuditManagement&f=status&status=1">通过</option>
    <option value="admin.php?a=AuditManagement&f=status&status=0">回绝</option>
</select>
</div>
    <div class="page fr"><?php echo $page;?></div>
  </div>
  </form>
</div>
</body>
</html>