<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>投票</title>
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


    <dl class="admin_login">
        <dt>
            <em> <h2 ><a href="/" style="color: #0f0f0f">点击返回首页-></a> </h2></em>
            <em> <h2 ><a  style="color: #00a0e9">送出月票支持</a> </h2></em>
        </dt>

        <dd class="user_icon">
            1张<input type="radio"  name="phonenum"  value="100" class="login_txtbx"/>
        </dd>
        <dd class="pwd_icon">
                2张<input type="radio"  name="phonenum"  value="200" id="yu" class="login_txtbx"/>
        </dd>
        <dd class="pwd_icon">
            3张<input type="radio"  name="phonenum" value="300" id="yu" class="login_txtbx"/>
        </dd>
        <dd class="pwd_icon">
            4张<input type="radio"  name="phonenum" value="400" id="yu" class="login_txtbx"/>
        </dd>
        <dd class="pwd_icon">
            5张<input type="radio"  name="phonenum" value="500" id="yu" class="login_txtbx"/>
        </dd>
        <dd>
            <input type="submit" value="确认投票" class="submit_btn"/>
        </dd>
        <dd>
            <p>© 2015-2016 DeathGhost 版权所有</p>
            <p>陕B2-20080224-1</p>
        </dd>
    </dl>
</body>
<script>

    $("document").ready(function(){


    $(document).ready(function(){
        $(".submit_btn").click(function(){
            var r = $("input[name='phonenum']:checked").val();
            if(r==100){
                alert('投票：获取100点粉丝值');
            }else if(r==200){
                alert('投票：获取200点粉丝值');
            }else if(r==300){
                alert('投票：获取300点粉丝值');
            }else if(r==400){
                alert('投票：获取400点粉丝值');
            }else if(r==500){
                alert('投票：获取500点粉丝值');
            }
            $.ajax({
                url:"{{url('index/ci')}}",
                data:{'r':r},
                type:'post',
                dataType:'json',
                success:function (res) {
                    if(res.code=='00000'){
                        alert('1');
                    }
                }
            })
        })

    });
    })
</script>
</html>
<!--
本代码由js代码网网友上传，js代码网收集并编辑整理;
尊重他人劳动成果;
转载请保留js代码链接 - www.jsdaima.com
-->