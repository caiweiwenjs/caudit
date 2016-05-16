<?php if(!defined('APP_NAME')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo APP_TITLE;?></title>
<link rel="stylesheet" href="./template/hoho/css/panel.css" type="text/css" />
<link rel="stylesheet" path="./template/hoho/css/" type="text/css" id="skinCss" />
<link rel="stylesheet" path="./template/hoho/js/artDialog/skins/" type="text/css" id="artDialogCss" />
<script type="text/javascript" src="./template/hoho/js/jquery.js"></script>
<script type="text/javascript" src="./template/hoho/js/panel.js"></script>
<script type="text/javascript" src="./template/hoho/js/artDialog/jquery.artDialog.js"></script>
<script type="text/javascript" src="./template/hoho/js/artDialog/plugins/iframeTools.js"></script>
</head>

<body>
<div id="left">
    <div class="logo"></div>
    <div class="menu">
        <ul class="main">
            <?php if(is_array($menu)){foreach($menu as $key=>$parent){?>
            <li class="main">
                <a href="javascript:void(0);" class="main"><i class="iconfont"><?php echo $icon[$parent[id]];?></i><?php echo $parent['menu_name'];?></a>
                <?php if(!empty($parent['_child'])){ ?>
                <ul class="sub">
                    <?php if(is_array($parent['_child'])){foreach($parent['_child'] as $key=>$child){?>
                    <li class="sub"><a target="_tab" rel="menu_<?php echo $child['id'];?>" href="<?php echo U($child['menu_url']); ?>" class="sub"><?php echo $child['menu_name'];?></a></li>
                    <?php } } ?>
                </ul>
                <?php } ?>
            </li>
            <?php } } ?>
         </ul>
    </div>
</div>
<div id="right">
    <div id="top">
        <p class="sideBarSwitch"><a href="javascript:void(0);" onclick="sideBarSwitch(this);"><i class="ico icon-arrow-left"></i>隐藏左栏菜单</a></p>
        <ul class="topLinks">
            <li><a target="_dialog" rel="cache" width="680" height="380" href="admin.php?a=Home&f=cache" title="清空缓存"><i class="iconfont">&#xf028b;</i>清空缓存</a></li>
            <li>｜</li>
            <li><a target="_dialog" width="480" height="280" rel="pwd" href="admin.php?a=AdminUser&f=changePwd" title="修改密码"><i class="iconfont">&#xf00ee;</i>修改密码</a></li>
            <li>｜</li>
            <li><a href="javascript:void(0);"><i class="iconfont fl">&#xf00ec;</i><?php echo $session['uname'];?></a></li>
            <li>｜</li>
            <li><a href="admin.php?a=User&f=logout"><i class="iconfont">&#xf017c;</i>退出</a></li>
        </ul>
        <p class="skin">
            <span>选择风格：</span>
            <a class="blue" href="javascript:void(0);" onclick="setSkin('blue');">blue</a>
            <a class="red" href="javascript:void(0);" onclick="setSkin('red');">red</a>
            <a class="black" href="javascript:void(0);" onclick="setSkin('black');">black</a>
        </p>
    </div>
    <div id="tab">
        <span id="tab_home" class="on" onclick="changeTab('home');"><i class="iconfont">&#x344c;</i>我的主页</span>
    </div>
    <div id="content">
        <iframe id="content_home" frameborder="0" allowtransparency="true" src="admin.php?a=Home&f=right"></iframe>
    </div>
</div>
</body>
</html>