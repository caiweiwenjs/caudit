<?php if(!defined('APP_NAME')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户角色列表</title>
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
  <form action="admin.php?a=AdminRole&do=search" method="post">
     角色名称：
     <input type="text" name="search_where[title][like]" size="12" value="<?php echo $search_where['title']['like'];?>" class="input" />
     状态：
    <select name="search_where[status][eq]">
     <?php myselect('请选择,启用:1,锁定:0',$search_where['status']['eq']); ?>
    </select>
    <input type="submit" class="btn_s" value="查 询" />
  </form>
  </div>
  <form action="" method="post" id="form_data_list">
  <table cellspacing="1" class="mylist">
    <thead>
    <tr>
      <th colspan="6">
      <div class="relative">用户角色列表
        <div class="buttons">
            <a class="_add blue" href="admin.php?a=AdminRole&f=add" title="新增">
                <img src="./template/hoho/images/add.gif" alt="详情" width="16" height="16" /> 新增
            </a>
        </div>
      </div>
      </th>
    </tr>
    <tr class="mylist_title">
      <td width="28"><input type="checkbox" class="checkbox" onclick="InverSelect();" /></td>
      <td width="108">角色名称</td>
      <td>角色说明</td>
      <td width="52">状 态</td>
      <td width="102">操 作</td>
    </tr>
    </thead>
    <tbody>
    <?php if(is_array($list)){foreach($list as $key=>$vo){?>
    <tr class="datalist">
      <td align="center"><input name="id[]" type="checkbox" value="<?php echo $vo['id'];?>" class="checkbox" /></td>
      <td dataType="require" onclick="editNow(<?php echo $vo['id'];?>,'title','admin.php?a=AdminRole&f=update',this);"><?php echo $vo['title'];?></td>
      <td onclick="editNow(<?php echo $vo['id'];?>,'description','admin.php?a=AdminRole&f=update',this);"><?php echo $vo['description'];?></td>
      <td align="center"><?php if($vo['status']==1){ ?>
<a target="_ajax" title="点击锁定" href="<?php echo U(array('f'=>"status",'id'=>"{$vo['id']}",'status'=>"0")); ?>"><img src="./template/hoho/images/status_1.gif" width="14" height="14" alt="启用" /></a>
<?php }else{ ?>
<a target="_ajax" title="点击启用" href="<?php echo U(array('f'=>"status",'id'=>"{$vo['id']}",'status'=>"1")); ?>"><img src="./template/hoho/images/status_0.gif" width="14" height="14" alt="锁定" /></a>
<?php } ?></td>
      <td align="center" class="action"><a class="win_normal" href="<?php echo U(array('f'=>"auth",'role_id'=>"{$vo['id']}")); ?>" title="授权"><img src="./template/hoho/images/auth.gif" alt="授权" width="16" height="16" /></a><a class="_edit" href="<?php echo U(array('f'=>"edit",'id'=>"{$vo['id']}")); ?>" title="编辑"><img src="./template/hoho/images/edit.gif" alt="编辑" width="16" height="16" /></a><a target="_ajax" href="<?php echo U(array('f'=>"delete",'id'=>"{$vo['id']}")); ?>" confirm="确认删除？删除后无法恢复！！" title="删除"><img src="./template/hoho/images/delete.gif" alt="删除" width="16" height="16" /></a></td>
    </tr>
    <?php } } ?>
    </tbody>
  </table>
  <div class="mylist_foot">
    <div class="fl" style="margin-left:10px;_margin-left:5px;"><img src="./template/hoho/images/arrow.gif" width="26" height="30" alt="请选择" />
<a href="javascript:allSelect()"> 全选</a> | <a href="javascript:InverSelect()">反选</a> | <a href="javascript:allUnSelect()">全不选</a> | 对选中项进行
<select onchange="selectSubmit(this,'form_data_list')">
    <option>请选择</option>
    <option title="确认删除？删除后无法恢复！！" value="admin.php?a=AdminRole&f=delete">删除</option>
    <option value="admin.php?a=AdminRole&f=status&status=1">启用</option>
    <option value="admin.php?a=AdminRole&f=status&status=0">锁定</option>
</select>
</div>
    <div class="page fr"><?php echo $page;?></div>
  </div>
  </form>
</div>
</body>
</html>