<?php

namespace App\Http\Controllers\Index;
use App\Http\Controllers\Controller;
use App\Reg as Wd;
use App\Log as Ws;
use App\Brand as Wr;
use App\Da as We;
use App\Login as Wv;
use Illuminate\Http\Request;
use QRcode;
use think\response\Jsonp;
use think\Session;

class IndexController extends Controller
{
//    public function index(){
//        $name = session('name');
//        $data = Wd::where('uname','=',$name)->first();
//        return view('index/index',['data'=>$data['id']]);
//    }
    public function shou()
    {
        $res = Wv::get();

        return view('index/shou',['res'=>$res]);
    }

    public function tel()
    {
        return view('index/tel');
    }

    public function index()
    {
        echo $_GET['echostr'];
    }

    public function login()
    {
        $url = storage_path('app/public/phpqrcode.php');
        include($url);
        $obj = new QRcode();
        $uid = uniqid();
//        echo $uid;die;
            $url_s = "http://www.litingstudio.top/image?uid=" . $uid;
            return redirect('index/ing');
//        $obj->png($url_s,storage_path('app/public/1.png'));

    }

    public function image()
    {
        $uid = $_GET['uid'];
        session(['u_id' => $uid]);
        $appid = 'wx9e2acea263c04928';
        $uri = urlencode("http://www.litingstudio.top/log");
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$uri&response_type=code&scope=snsapi_userinfo&state=$uid#wechat_redirect";
        return redirect($url);
    }

    public function logs()
    {
        $code = $_GET['code'];

        $id = "wx9e2acea263c04928";
        $u_id = session('u_id');
        $secret = "9b2e20f705ff4c29b18c02f5de8058d3";
        $tokenurl = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$id&secret=$secret&code=$code&grant_type=authorization_code";
        $res = file_get_contents($tokenurl);
        $token = json_decode($res, true)['access_token'];
        $openid = json_decode($res, true)['openid'];
        session(['openid'=>$openid]);
        $userurl = "https://api.weixin.qq.com/sns/userinfo?access_token=$token&openid=$openid&lang=zh_CN";
        $userinfo = file_get_contents($userurl);
        $user = json_decode($userinfo, true);
        print_r($user);
        echo '<hr>';
        echo '</br>';
        echo '微信昵称：' . $user['nickname'];
        echo '<hr>';
        echo '</br>';
        echo '微信头像：' . "<img src=" . $user['headimgurl'] . " />";
        echo '<hr>';
        echo '</br>';

        $nickname = $user['nickname'];
        $headimgurl = $user['headimgurl'];
        $arr = [
            'nickname' => $nickname,
            'headimgurl' => $headimgurl,
            'token' => $token,
            'openid' => $openid,
            'u_id' => $u_id
        ];
        $phonenum = Ws::where('openid', '=', $openid)->value('phonenum');
        $res = Ws::where('openid', '=', $openid)->first();
        if (empty($res)) {
            $re = Ws::insert($arr);
        } else{
            $arr = [
                'nickname' => $nickname,
                'headimgurl' => $headimgurl,
                'token' => $token,
                'openid' => $openid,
                'u_id' => $u_id
            ];
            $res = Ws::where('openid', '=', $openid)->update($arr);

        }
        if(empty($phonenum)){
            echo '你还没有绑定手机号<a href="tel"><h2 style="color: red">点击去绑定</h2></a>';
            die;
        }else{
            echo '<h1 style="color: red">扫码登录成功</h1>';
            return redirect('/');
        }
    }

    public function ing()
    {
        return view('index/image');
    }

    public function save()
    {
        $phonenum = request()->input('phonenum');
        $pwd = request()->input('pwd');
        if (empty($phonenum)) {
            echo '<p style="color: #f1b0b7">手机号不能为空!</p>';
            echo '</br>';
            echo '<a href="tel">点击重新绑定</a>';
        } elseif (strlen($phonenum) != 11 || !is_numeric($phonenum)) {
            echo '<p style="color: #f1b0b7">手机号必须为11位数字!</p>';
            echo '</br>';
            echo '<a href="tel">点击重新绑定</a>';
        }
        $r = Wr::where('phonenum', '=', $phonenum)->where('pwd', '=', $pwd)->first();
        if ($r) {
            $openid = session('openid');
            $arr = [
                'phonenum' => $phonenum,
                'pwd' => $pwd,
            ];
            $res = Ws::where('openid', '=', $openid)->update($arr);
            echo '绑定手机号成功';
            echo '</br>';
            echo '正在为你跳转到首页....';
            return redirect('/');
//            echo '<a href="index/ing">点击</a>';
        }else{
            echo '<a href="zhu">点击重新登录</a>';
            echo '</br>';
            echo '登录失败';
        }
    }
    public function zhu()
    {
        return view('index/trt');
    }

    //发送手机号验证码
    public function ma()
    {
        $tel = request()->input('tel');
        $str = rand(1000,9999);
        session(['str'=>$str]);
        $host = "http://dingxin.market.alicloudapi.com";
        $path = "/dx/sendSms";
        $method = "POST";
        $appcode = "1df873ffc5074ca3a3e19dadb16e48ed";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "mobile=$tel&param=code%3A$str&tpl_id=TP1711063";
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
       echo curl_exec($curl);

    }
public function insert()
{
    $phonenum = request()->input('phonenum');
    $zheng = request()->input('zheng');
    $pwd = request()->input('pwd');
    $pwds = request()->input('pwds');
    $tr = session('str');
    $tt = Wr::where('phonenum','=',$phonenum)->first();
    if($tt){
        echo '手机号已存在';
        echo '</br>';
        echo '<a href="zhu">点击重新注册</a>';
        die;
    }
    if($tr!=$zheng) {
        echo '验证码错误';
        echo '</br>';
        echo '<a href="zhu">点击重新注册</a>';
        die;

    }
    if(empty($phonenum)){
        echo '<a href="zhu">点击重新注册</a>';
        echo '</br>';
        exit('手机号不能为空');

    }
    if(empty($zheng)){
        echo '<a href="zhu">点击重新注册</a>';
        echo '</br>';
        exit('验证码不能为空');

    }
    if(empty($pwd)){
        echo '<a href="zhu">点击重新注册</a>';
        echo '</br>';
        exit('密码不能为空');

    }
    if(empty($pwds)){
        echo '<a href="zhu">点击重新注册</a>';
        echo '</br>';
        exit('确认密码不能为空');

    }
    if($pwd!=$pwds){
        echo '两次密码不一致';
        echo '</br>';
        echo '<a href="zhu">点击重新注册</a>';
        die;
}
$arr = [
    'phonenum'=>$phonenum,
    'pwd'=>$pwd,
    'zheng'=>$zheng,
    'pwds'=>$pwds
];
$res = Wr::insert($arr);
if($res){
    echo '注册成功！';
    echo '</br>';
    echo '<a href="tel">点击到手机号登录页面</a>';

}
}

public function rn()
{
    $fen = request()->input('fen');
    $name = request()->input('name');
    $where=[];
    if($name){
        $where[] =['weixin.name','like',"%$name%"];
    }
    if($fen){
        $where[] = ['weixin.r_id','like',"%$fen%"];
    }
    $data = We::where($where)->first();
if(!$data){
    echo '此书不存在';
    echo '</br>';
    echo '<a href="/">点击返回</a>';
}
    return view('index/lists',['data'=>$data]);
}
}
