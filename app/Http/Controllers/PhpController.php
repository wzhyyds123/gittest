<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pdp;
use Illuminate\Http\Request;

class PhpController extends Controller
{
    /***
     * 查看完成pdp的人数
     * wzh
     * @return \Illuminate\Http\JsonResponse
     */
    public function pdpNum(){
    $res = Pdp::wzh_num();//转到model
    return $res ?  //判断
        json_fail("查询失败",NULL,100):
        json_success("查询成功",$res,200);
    }
    /***
     * 录入分数 把分数录入到数据库
     * wzh
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
public function pdpScore(Request $request){
    $res1 = pdp::wzh_score($request);//转到model
    // if(!$re){
    //           return '添加失败';}
    //       return '添加成功';
    return $res1?   //判断
        json_success("添加成功",$res1,200):
        json_fail("添加失败",$res1,100);
}
    /***
     * 查看分数并返回结果
     * wzh
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function pdpResult(Request $request){
        $res2=pdp::wzh_result($request);//转到model

        return $res2?   //判断
            json_success("反馈成功",$res2,200):
            json_fail("反馈失败",$res2,100);
    }
    /***
     * 点击重做将分数归零
     * wzh
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function pdpRemove(Request $request){
        $res3=pdp::wzh_remove($request);//转到model

        return $res3?   //判断
            json_success("更新成功",$res3,200):
            json_fail("更新失败",$res3,100);
    }
}
