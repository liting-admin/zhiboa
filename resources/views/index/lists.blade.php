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
            <strong><h1 style="color: #0f0f0f">...先关注测试号...</h1><img src="{{url('/storage/ceshi.png')}}"></strong>
            <strong><h1 style="color: #0f0f0f">...请扫码登录...</h1><img src="{{url('/storage/1.png')}}"></strong>
            <h2 style="color: red"><a href="tel"><h1 style="color:darkred">点击去登录</h1></a></h2>
        </dt>

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