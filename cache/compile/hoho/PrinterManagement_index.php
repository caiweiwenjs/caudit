<?php if(!defined('APP_NAME')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>打印机管理</title>
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
  <form action="admin.php?a=PrinterManagement&do=search" method="post">
     用户名：
     <input type="text" name="search_where[uname][like]" size="12" value="<?php echo $search_where['uname']['like'];?>" class="input" />
    打印机名：
	<input type="text" name="search_where[pname][like]" size="12" value="<?php echo $search_where['pname']['like'];?>" class="input" />
    <input type="submit" class="btn_s" value="查 询" />
  </form>
  </div>
  <form action="" method="post" id="form_data_list">
  <table cellspacing="1" class="mylist">
    <thead>
    <tr>
      <th colspan="6"><div class="relative">用户打印机列表
        <div class="buttons">
            <a class="_add blue" href="admin.php?a=PrinterManagement&f=add" title="新增">
                <img src="./template/hoho/images/add.gif" alt="新增" width="16" height="16" /> 新增
            </a>
        </div>
      </div></th>
    </tr>
    <tr class="mylist_title">
      <td width="28"><input type="checkbox" class="checkbox" onclick="InverSelect();" /></td>
      <td>用户名</td>
      <td>打印机名</td>
      <td width="102">操 作</td>
    </tr>
    </thead>
    <tbody>
    <?php if(is_array($list)){foreach($list as $key=>$vo){?>
    <tr class="datalist">
      <td align="center"><input name="id[]" type="checkbox" value="<?php echo $vo['id'];?>" class="checkbox" /></td>
      <td align="center"><?php echo $vo['user_name'];?></td>
      <td align="center"><?php echo $vo['printer_name'];?></td>
      <td align="center" class="action"><a class="_edit" href="<?php echo U(array('f'=>"edit",'id'=>"{$vo['id']}")); ?>" title="编辑"><img src="./template/hoho/images/edit.gif" alt="编辑" width="16" height="16" /></a><a target="_ajax" href="<?php echo U(array('f'=>"delete",'id'=>"{$vo['id']}")); ?>" confirm="确认删除？删除后无法恢复！！" title="删除"><img src="./template/hoho/images/delete.gif" alt="删除" width="16" height="16" /></a></td>
    </tr>
    <?php } } ?>
    </tbody>
  </table>
  <div class="mylist_foot">
    <div class="fl" style="margin-left:10px;_margin-left:5px;"><img src="./template/hoho/images/arrow.gif" width="26" height="30" alt="请选择" />
<a href="javascript:allSelect()"> 全选</a> | <a href="javascript:InverSelect()">反选</a> | <a href="javascript:allUnSelect()">全不选</a> | 对选中项进行
<select onchange="selectSubmit(this,'form_data_list')">
    <option>请选择</option>
    <option title="确认删除？删除后无法恢复！！" value="admin.php?a=PrinterManagement&f=delete">删除</option>
</select>
</div>
    <div class="page fr"><?php echo $page;?></div>
  </div>
  </form>
</div>
</body>
</html>