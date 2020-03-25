<?php

namespace App\Http\Controllers\Index;
use App\Http\Controllers\Controller;
use App\Reg as Wd;
use App\Log as Ws;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $name = session('name');
        $data = Wd::where('uname','=',$name)->first();
        return view('index/index',['data'=>$data['id']]);
    }
    public function login()
    {
        echo '23';
    }
    public function reg()
    {
        return view('index/reg');
    }
    public function save()
    {
        $data = request()->input();
        $name = $data['uname'];
        $phone = $data['phone'];
        $tel = Wd::where('phone','=',$phone)->first();
        if(empty($phone)) {
            echo '<p style="color: #f1b0b7">手机号不能为空!</p>';
            echo '</br>';
            echo '<a href="/index/reg">点击重新注册</a>';
            }elseif (strlen($phone)!=11 || !is_numeric($phone)){
            echo '<p style="color: #f1b0b7">手机号必须为11位数字!</p>';
            echo '</br>';
            echo '<a href="/index/reg">点击重新注册</a>';
        }elseif($tel){
            echo '<p style="color: #f1b0b7">手机号已存在!</p>';
            echo '</br>';
            echo '<a href="/index/reg">点击重新注册</a>';
        }else{
            $res = Wd::insert($data);
            if ($res) {
                echo '注册成功,正常为你跳转到登录页面';
//            header('refresh:3',"url='/'");
                return redirect('/');
            }
        }
    }
    public function sel()
    {
        $name = request()->input('name');
        $pwd = request()->input('pwd');
     $data = Wd::where('uname','=',$name)->where('pwd','=',$pwd)->first();
     if($data){
         session(['s_id'=>$data['uname']]);
         return redirect('/index/index');
     }else{
         echo '<p style="color: #f1b0b7">用户名或密码错误!</p>';
         echo '</br>';

          echo '<a href="/">点击重新登录</a>';

     }
    }
    public function money()
    {
        $money=request()->input('money');
        $name1= session('s_id');
        $name2 = Ws::where('name','=',$name1)->first();
        if(empty($name2)){
            $name = session('s_id');
            $time = date('Y-m-d');
            $tt= [
                'name'=>$name,
                'money'=>$money,
                'time'=>$time
            ];
            $re = Ws::insert($tt);
        }else{
            $name = session('s_id');
            $money2 = Ws::where('name','=',$name)->value('money');
            $time = Ws::where('name','=',$name)->value('time');
            $money = $money+$money2;
            $res = Ws::where('name','=',$name)->update(['money'=>$money,'time'=>$time]);
        }
        return json_encode(['msg'=>'00000','data'=>'00000']);
    }
    public function fen()
    {

        $fen1 =Ws::orderBy('money','desc')->pluck('money');

        return json_encode($fen1);
    }
    public  function fens()
    {
        $fen =Wd::pluck('uname');
        return $fen;
    }
}
