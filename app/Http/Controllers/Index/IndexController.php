<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Goods;
use App\Model\Cate;
use DB;
class IndexController extends Controller
{
	//前台首页
    public function index(){
		$goodsInfo=Goods::get();
		  $data = Cate::get();
        $cateInfo = $this->get_cate($data);
		return view('index.index.index',['goodsInfo'=>$goodsInfo,'cateInfo'=>$cateInfo]); 
    }
       //无限级分类
    function get_cate($res,$parent_id=0,$lv=1){
static  $array =[];
        foreach($res as $v){
            if($v['parent_id']==$parent_id){
                $v['lv'] =$lv;
                $array[]=$v;    
                $this->get_cate($res,$v['cate_id'],$v['lv']+1);
            }
        }
        return $array;
    }
//用户
 public function user(){
		return view('index.index.user'); 
    }
//商品展示页面
    public function proinfo(){
    	return view('index.index.proinfo'); 
    }
    public function car(){
        return view('index.index.public.car');
    }
}
