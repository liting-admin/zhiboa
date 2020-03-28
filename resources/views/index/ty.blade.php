<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>后台登录</title>
    <meta name="author" content="DeathGhost" />
    <link rel="stylesheet" type="text/css" href="/static/css/style.css" />
    <style>
        body{height:100%;background:#16a085;overflow:hidden;}
        canvas{z-index:-1;position:absolute;}
    </style>
    <script src="/static/Scripts/jquery.js"></script>
    <script src="/static/Scripts/verificationnumbers.js"></script>
    <script src="/static/Scripts/particleground.js"></script>
    <script src="/static/js/jquery-1.11.1.js"></script>
    <script>

    </script>
</head>
<body>
<form action="/index/insert" method="post">
    @csrf
<dl class="admin_login">
    <dt>
        <strong>站点后台管理系统</strong>
        <em>Management System</em>
    </dt>
    <dd class="user_icon">
        <input type="text" placeholder="手机号" name="phonenum"  id="yu" class="login_txtbx"/>
    </dd>
    <dd class="val_icon">
        <div class="checkcode">
            <input type="text" placeholder="验证码" name="zheng" maxlength="4" class="login_txtbx">
        </div>
        <input type="button" value="验证码核验" class="ver_btn"  id="fa" >
    </dd>
    <dd class="pwd_icon">
        <input type="password" placeholder="密码" name="pwd" class="login_txtbx"/>
    </dd>
    <dd class="pwd_icon">
        <input type="password" placeholder="确认密码" name="pwds" class="login_txtbx"/>
    </dd>

    <dd>
        <input type="submit" value="立即注册" class="submit_btn"/>
    </dd>
    <dd>
        <p>© 2015-2016 DeathGhost 版权所有</p>
        <p>陕B2-20080224-1</p>
    </dd>
</dl>
</form>
</body>
<script>
    $("document").ready(function(){
        $('#fa').click(function(){
            var tel = $('#yu').val();
            if(!(/^1[3456789]\d{9}$/.test(tel))){
                alert("手机格式不正确");
                return;
            }
            $.ajax({
                url:"{{url('index/ma')}}",
                data:{tel:tel},
                type:'post',
                dataType:'json',
                success:function () {
                    if(res.code=='00000'){
                        alert('1');
                    }
                }
            })
        })
    })
</script>
</html>
<!--
本代码由js代码网网友上传，js代码网收集并编辑整理;
尊重他人劳动成果;
转载请保留js代码链接 - www.jsdaima.com
-->