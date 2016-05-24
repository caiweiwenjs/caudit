<?php if(!defined('APP_NAME')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台权限列表</title>
<link rel="stylesheet" href="./template/hoho/css/style.css" type="text/css" />
<script type="text/javascript" src="./template/hoho/js/jquery.js"></script>
<script type="text/javascript" src="./template/hoho/js/jquery.form.js"></script>
<script type="text/javascript" src="./template/hoho/js/ajaxsubmit.js"></script>
<script type="text/javascript" src="./template/hoho/js/fun.js"></script>
<script type="text/javascript" src="./template/hoho/js/list.js"></script>
</head>

<body>
<div class="wrap">
  <form action="" method="post" id="form_data_list">
  <table cellspacing="1" class="mylist">
    <thead>
    <tr>
      <th colspan="9">
      <div class="relative">后台权限列表
        <div class="buttons">
            <a class="_add blue" href="admin.php?a=AdminAuth&f=add" title="新增">
                <img src="./template/hoho/images/add.gif" alt="新增" width="16" height="16" /> 新增
            </a>
        </div>
      </div></th>
    </tr>
    <tr class="mylist_title">
      <td width="28"><input type="checkbox" class="checkbox" onclick="InverSelect();" /></td>
      <td width="108">权限名称</td>
      <td>所属Action名称</td>
      <td>所属Action方法</td>
      <td width="82">菜单名称</td>
      <td>菜单地址</td>
      <td width="40">排序</td>
      <td width="42">状 态</td>
      <td width="68">操 作</td>
    </tr>
    </thead>
    <tbody>
    <?php if(is_array($list)){foreach($list as $key=>$vo){?>
    <tr class="datalist">
      <td align="center"><input name="id[]" type="checkbox" value="<?php echo $vo['id'];?>" class="checkbox" /></td>
      <td dataType="require" style="font-weight:bold;" onclick="editNow(<?php echo $vo['id'];?>,'title','admin.php?a=AdminAuth&f=update',this);"> <?php echo $vo['title'];?></td>
      <td onclick="editNow(<?php echo $vo['id'];?>,'auth_action','admin.php?a=AdminAuth&f=update',this);"><?php echo $vo['auth_action'];?></td>
      <td onclick="editNow(<?php echo $vo['id'];?>,'auth_fun','admin.php?a=AdminAuth&f=update',this);"><?php echo $vo['auth_fun'];?></td>
      <td style="font-weight:bold;" onclick="editNow(<?php echo $vo['id'];?>,'menu_name','admin.php?a=AdminAuth&f=update',this);"><?php echo $vo['menu_name'];?></td>
      <td onclick="editNow(<?php echo $vo['id'];?>,'menu_url','admin.php?a=AdminAuth&f=update',this);"><?php echo $vo['menu_url'];?></td>
      <td onclick="editNow(<?php echo $vo['id'];?>,'orderid','admin.php?a=AdminAuth&f=update',this);"><?php echo $vo['orderid'];?></td>
      <td align="center"><?php if($vo['status']==0){ ?>
<a target="_ajax" href="<?php echo U(array('f'=>"status",'id'=>"{$vo['id']}",'status'=>"1")); ?>" confirm="确认通过请求？" title="审核">
    <img src="./template/hoho/images/status_1.gif" width="14" height="14" alt="通过" />
</a>
<a target="_ajax" href="<?php echo U(array('f'=>"status",'id'=>"{$vo['id']}",'status'=>"2")); ?>" confirm="确认回绝请求？" title="审核">
    <img src="./template/hoho/images/status_0.gif" width="14" height="14" alt="回绝" />
</a>
<?php }else{ ?>
<label style="color: gray">
    已审核
</label>
<?php } ?></td>
      <td align="center" class="action"><a class="_edit" href="<?php echo U(array('f'=>"edit",'id'=>"{$vo['id']}")); ?>" title="编辑">
    <img src="./template/hoho/images/edit.gif" alt="编辑" width="16" height="16" />
</a>
<a target="_ajax" href="<?php echo U(array('f'=>"delete",'id'=>"{$vo['id']}")); ?>" confirm="确认删除？删除后无法恢复！！" title="删除">
    <img src="./template/hoho/images/delete.gif" alt="删除" width="16" height="16" />
</a></td>
    </tr>
    <?php if(is_array($vo['_child'])){foreach($vo['_child'] as $key=>$vo){?>
    <tr class="datalist">
      <td align="center"><input name="id[]" type="checkbox" value="<?php echo $vo['id'];?>" class="checkbox" /></td>
      <td dataType="require" style="padding-left:12px;" onclick="editNow(<?php echo $vo['id'];?>,'title','admin.php?a=AdminAuth&f=update',this);"> <?php echo $vo['title'];?></td>
      <td onclick="editNow(<?php echo $vo['id'];?>,'auth_action','admin.php?a=AdminAuth&f=update',this);"><?php echo $vo['auth_action'];?></td>
      <td onclick="editNow(<?php echo $vo['id'];?>,'auth_fun','admin.php?a=AdminAuth&f=update',this);"><?php echo $vo['auth_fun'];?></td>
      <td onclick="editNow(<?php echo $vo['id'];?>,'menu_name','admin.php?a=AdminAuth&f=update',this);"><?php echo $vo['menu_name'];?></td>
      <td onclick="editNow(<?php echo $vo['id'];?>,'menu_url','admin.php?a=AdminAuth&f=update',this);"><?php echo $vo['menu_url'];?></td>
      <td onclick="editNow(<?php echo $vo['id'];?>,'orderid','admin.php?a=AdminAuth&f=update',this);"><?php echo $vo['orderid'];?></td>
      <td align="center"><?php if($vo['status']==0){ ?>
<a target="_ajax" href="<?php echo U(array('f'=>"status",'id'=>"{$vo['id']}",'status'=>"1")); ?>" confirm="确认通过请求？" title="审核">
    <img src="./template/hoho/images/status_1.gif" width="14" height="14" alt="通过" />
</a>
<a target="_ajax" href="<?php echo U(array('f'=>"status",'id'=>"{$vo['id']}",'status'=>"2")); ?>" confirm="确认回绝请求？" title="审核">
    <img src="./template/hoho/images/status_0.gif" width="14" height="14" alt="回绝" />
</a>
<?php }else{ ?>
<label style="color: gray">
    已审核
</label>
<?php } ?></td>
      <td align="center" class="action"><a class="_edit" href="<?php echo U(array('f'=>"edit",'id'=>"{$vo['id']}")); ?>" title="编辑">
    <img src="./template/hoho/images/edit.gif" alt="编辑" width="16" height="16" />
</a>
<a target="_ajax" href="<?php echo U(array('f'=>"delete",'id'=>"{$vo['id']}")); ?>" confirm="确认删除？删除后无法恢复！！" title="删除">
    <img src="./template/hoho/images/delete.gif" alt="删除" width="16" height="16" />
</a></td>
    </tr>
    <?php } } ?>
    <?php } } ?>
    </tbody>
  </table>
  <div class="mylist_foot">
    <div class="fl" style="margin-left:10px;_margin-left:5px;"><img src="./template/hoho/images/arrow.gif" width="26" height="30" alt="请选择" />
<a href="javascript:allSelect()"> 全选</a> | <a href="javascript:InverSelect()">反选</a> | <a href="javascript:allUnSelect()">全不选</a> | 对选中项进行
<select onchange="selectSubmit(this,'form_data_list')">
    <option>请选择</option>
    <option title="确认删除？删除后无法恢复！！" value="admin.php?a=AdminAuth&f=delete">删除</option>
    <option value="admin.php?a=AdminAuth&f=status&status=1">启用</option>
    <option value="admin.php?a=AdminAuth&f=status&status=0">锁定</option>
</select>
</div>
  </div>
  </form>
</div>
</body>
</html>