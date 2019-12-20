<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
use DB;
use App\Http\Middleware\IndexLogin;


class LoginController extends Controller
{
   
     public function login(){
		
		return view('index.login.login'); 
    }

public function reg(){

	return view('index.login.reg'); 
	}

	public function doreg(){
		 request()->validate([
  'email' => 'required|unique:user',
  'tel' => 'required',
  'pwd'=>'required',
 ],[
    'email.required'=>'邮箱必填',
    'email.unique'=>'邮箱已存在',
    'tel.required'=>'验证码必填',
    'pwd.required'=>'密码必填',
 ]);
		$post=request()->except('_token');
		//dd($post);
	$res=User::insert($post);
	//dd($res);
	if($res){
		echo "<script>alert('注册成功');location.href='/login'</script>";
	}
}

public function dologin(){
		$post=request()->except('_token');
		//dd($post);
	$user=User::where($post)->first();
	  cache(['user' => $user], 10);
	//dd($user);
   if($user){
            session(['index'=>$user]);
            return redirect('/index')->with('msg','登录成功');
        }else{
            return redirect('/login')->with('msg','账号或密码错误');
        }
	}
	public function send(){
		$email =  request()->email;
        $reg='/^\w+@\w+\.com$/';
        if(empty($email)){
            echo json_encode(['font'=>'邮箱必填','code'=>2]);die;
        }else if(!preg_match($reg,$email)){
            echo json_encode(['font'=>'邮箱格式有误','code'=>2]);die;
        }else{
            $res=User::where('email',$email)->first();
            if($res){
                echo json_encode(['font'=>'邮箱已存在','code'=>2]);die;
            }
		}
	}
}