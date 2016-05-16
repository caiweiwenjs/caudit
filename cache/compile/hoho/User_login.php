<?php if(!defined('APP_NAME')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo APP_TITLE;?></title>
<link rel="stylesheet" href="./template/hoho/css/login.css" type="text/css" />
<script type="text/javascript" src="./template/hoho/js/jquery.js"></script>
<script type="text/javascript" src="./template/hoho/js/jquery.form.js"></script>
<script type="text/javascript" src="./template/hoho/js/ajaxsubmit.js"></script>
<script type="text/javascript">
function setInputTips(){
    $('#uname_txt').click(function(){
        $('#uname').focus();
    });
    $('#uname').focus(function(){
        $('#uname_txt').css({'visibility':'hidden'});
    });
    $('#uname').blur(function(){
        if( $(this).val() == '' ){
            $('#uname_txt').css({'visibility':'visible'});
        }
    });
    $('#pwd_txt').click(function(){
        $('#pwd').focus();
    });
    $('#pwd').focus(function(){
        $('#pwd_txt').css({'visibility':'hidden'});
    });
    $('#pwd').blur(function(){
        if( $(this).val() == '' ){
            $('#pwd_txt').css({'visibility':'visible'});
        }
    });
    $('#verify_txt,#verify').click(function(){
        $('#verify').focus();
    });
    $('#verify').focus(function(){
        $('#verify_txt').css({'visibility':'hidden'});
    });
    $('#verify').blur(function(){
        if( $(this).val() == '' ){
            $('#verify_txt').css({'visibility':'visible'});
        }
    });
}

$(document).ready(function(){
    setInputTips();
});
</script>
</head>

<body>
<div id="header">
    <a href="http://www.uadmin.cn"><img src="./template/hoho/images/log_logo.gif" width="200" height="80" alt="uadmin.cn" /></a>
</div>
<div id="main">
    <div class="content">
        <form class="ajax_form" method="post" action="admin.php?a=User&f=check">
            <input id="uname" name="uname" type="text" class="input" dataType="require" title="请输入帐号" tabindex="1" />
            <label id="uname_txt">帐 号</label>
            <input id="pwd" name="pwd" type="password" class="input" dataType="require" title="请输入密码" tabindex="2" />
            <label id="pwd_txt">密 码</label>
            <input id="verify" name="verify_code" type="text" class="input" dataType="require" title="请输入验证码" tabindex="3" style="width:92px;" />
            <label id="verify_txt">验证码</label>
            <img src="admin.php?a=User&f=verify" width="48" height="24" onclick="this.src='admin.php?a=User&f=verify&'+Math.random()" id="verify_img" />
            <p class="remember"><input type="checkbox" name="remember" value="1" checked="checked" />记住登录状态</p>
            <input class="submit ajax_btn" type="image" src="./template/hoho/images/login.jpg" tabindex="4" />
        </form>
    </div>
</div>
<div id="footer">
    uadmin.cn版权所有 &copy 2013-<?php echo date('Y'); ?>
</div>
</body>
</html>