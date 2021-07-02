<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShowUserdataRequest;
use App\Model\user;
use Illuminate\Http\Request;

class UserdataController extends Controller
{



    /**
     *    显示用户单个数据
     * @param \ShowUserdataRequest
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */

    public  function userdata(ShowUserdataRequest $request)
    {
        $date=User::selectuser($request);
        dd($date);
        return $date?
            json_success('获取成功!',$date,200) :
            json_fail('获取失败!',null,100);
    }



    /**
     *  获取用户所有数据
     * @param
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public  function useralldata()
    {
       $date=User::selectalluser();
        return $date?
            json_success('获取成功!',$date,200) :
            json_fail('获取失败!',null,100);
    }

}
