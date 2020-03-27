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
        return view('index.shou',['res'=>$res]);
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
//    public function reg()
//    {
//        return view('index/reg');
//    }
//    public function save()
//    {
//        $data = request()->input();
//        $name = $data['uname'];
//        $phone = $data['phone'];
//        $tel = Wd::where('phone','=',$phone)->first();
//        if(empty($phone)) {
//            echo '<p style="color: #f1b0b7">手机号不能为空!</p>';
//            echo '</br>';
//            echo '<a href="/index/reg">点击重新注册</a>';
//            }elseif (strlen($phone)!=11 || !is_numeric($phone)){
//            echo '<p style="color: #f1b0b7">手机号必须为11位数字!</p>';
//            echo '</br>';
//            echo '<a href="/index/reg">点击重新注册</a>';
//        }elseif($tel){
//            echo '<p style="color: #f1b0b7">手机号已存在!</p>';
//            echo '</br>';
//            echo '<a href="/index/reg">点击重新注册</a>';
//        }else{
//            $res = Wd::insert($data);
//            if ($res) {
//                echo '注册成功,正常为你跳转到登录页面';
////            header('refresh:3',"url='/'");
//                return redirect('/');
//            }
//        }
//    }
//    public function sel()
//    {
//        $name = request()->input('name');
//        $pwd = request()->input('pwd');
//     $data = Wd::where('uname','=',$name)->where('pwd','=',$pwd)->first();
//     if($data){
//         session(['s_id'=>$data['uname']]);
//         return redirect('/index/index');
//     }else{
//         echo '<p style="color: #f1b0b7">用户名或密码错误!</p>';
//         echo '</br>';
//
//          echo '<a href="/">点击重新登录</a>';
//
//     }
//    }
//    public function money()
//    {
//        $money=request()->input('money');
//        $name1= session('s_id');
//        $name2 = Ws::where('name','=',$name1)->first();
//        if(empty($name2)){
//            $name = session('s_id');
//            $time = date('Y-m-d');
//            $tt= [
//                'name'=>$name,
//                'money'=>$money,
//                'time'=>$time
//            ];
//            $re = Ws::insert($tt);
//        }else{
//            $name = session('s_id');
//            $money2 = Ws::where('name','=',$name)->value('money');
//            $time = Ws::where('name','=',$name)->value('time');
//            $money = $money+$money2;
//            $res = Ws::where('name','=',$name)->update(['money'=>$money,'time'=>$time]);
//        }
//        return json_encode(['msg'=>'00000','data'=>'00000']);
//    }
//    public function fen()
//    {
//
//        $fen1 =Ws::orderBy('money','desc')->pluck('money');
//
//        return json_encode($fen1);
//    }
//    public  function fens()
//    {
//        $fen =Wd::pluck('uname');
//        return $fen;
//    }
public function rn()
{

}
}
