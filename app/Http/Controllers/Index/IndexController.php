<?php

namespace App\Http\Controllers\Index;
use App\Http\Controllers\Controller;
use App\Reg as Wd;
use App\Log as Ws;
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
        return view('index.shou');
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
        $tt = Wd::insert(['uid' => $uid]);
        $phonenum = Wd::where('uid', '=', $uid)->value('phonenum');
        if (empty($phonenum)) {
            echo '你还没有绑定手机号<a href="tel"><h2 style="color: red">点击去绑定</h2></a>';
            die;
        } else {
            $url_s = "http://www.litingstudio.top/image?uid=" . $uid;
            return redirect('index/ing');
//        $obj->png($url_s,storage_path('app/public/1.png'));
        }
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
        $res = Ws::where('openid', '=', $openid)->first();
        if (empty($res)) {
            $re = Ws::insert($arr);
        } else {
            $arr = [
                'nickname' => $nickname,
                'headimgurl' => $headimgurl,
                'token' => $token,
                'openid' => $openid,
                'u_id' => $u_id
            ];
            $res = Ws::where('openid', '=', $openid)->update($arr);
        }

        echo '<h1 style="color: red">扫码登录成功</h1>';

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
        }else{
            echo '</br>';
          $uid = Wd::value('uid');
            $arr = [
                'phonenum' => $phonenum,
                'pwd' => $pwd,
                'uid'=>$uid,
            ];
            $res = Wd::where('uid','=',$uid)->update($arr);
            echo '绑定手机号成功';
            echo '<a href="index/ing">点击返回扫码登录</a>';
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
}
