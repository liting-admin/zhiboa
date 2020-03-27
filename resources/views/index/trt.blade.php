<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登录</title>
    <link rel="stylesheet" href="https://g.alicdn.com/de/prismplayer/2.8.7/skins/default/aliplayer-min.css" />
    <script type="text/javascript" charset="utf-8" src="https://g.alicdn.com/de/prismplayer/2.8.7/aliplayer-min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.js"></script>
    <script src="/static/js/jquery-1.11.1.js"></script>

</head>
<body>

<form action="/index/insert" method="post">
    <h2><a href="tel">去登录</a> </h2>
    @csrf
    <table>
        <tr>
            <td>手机号：</td>
            <td>
                <input type="tel" name="phonenum" id="yu">
            </td>
        </tr>
        <tr>
            <td>验证码：</td>
            <td>
                <input type="text" name="zheng">
                <span style="color: red" id="fa">获取验证码</span>
            </td>
        </tr>
        <tr>
            <td>密码：</td>
            <td>
                <input type="password" name="pwd">
            </td>
        </tr>
        <tr>
            <td>确认密码：</td>
            <td>
                <input type="password" name="pwds" class="aa">
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="注册">
            </td>
        </tr>
    </table>
</form>
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
</body>
