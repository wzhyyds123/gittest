<?php

namespace App\Http\Controllers\Login;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * 登录
     * @param Request $loginRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $loginRequest)
    {
        try {
            $credentials = self::credentials($loginRequest);
            if (!$token = auth('api')->attempt($credentials)) {
                return json_fail(100, '账号或者用户名错误!', null);
            }
            return self::respondWithToken($token, '登陆成功!');
        } catch (\Exception $e) {
            echo $e->getMessage();
            return json_fail(500, '登陆失败!', null, 500);
        }
    }

    /**
     * 注销登录
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try {
            auth()->logout();
        } catch (\Exception $e) {

        }
        return auth()->check() ?
            json_fail('注销登陆失败!',null, 100 ) :
            json_success('注销登陆成功!',null,  200);
    }



    protected function credentials($request)
    {
        return ['user_email' => $request['user_email'], 'user_pwd' => $request['user_pwd']];
    }

    protected function respondWithToken($token, $msg)
    {
        return json_success( $msg, array(
            'token' => $token,
            //设置权限 'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ),200);
    }

    /**
     * 注册
     * @param Request $registeredRequest
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function registered(Request $registeredRequest)
    {
        return Admin::createUser(self::userHandle($registeredRequest)) ?
            json_success('注册成功!',null,200  ) :
            json_success('注册失败!',null,100  ) ;

    }

    protected function userHandle($request)
    {
        $registeredInfo = $request->except('password_confirmation');
        $registeredInfo['password'] = bcrypt($registeredInfo['password']);
        $registeredInfo['admin_id'] = $registeredInfo['admin_id'];
        return $registeredInfo;
    }


    /**
     * 保存
     * @param Request $registeredRequest
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function Baocun(Request $request){
        $openid = $request['openid'];
        $address = $request['address'];
        $data = User::tg_updateAddress($openid,$address);
        if ($data!=null){
            return json_success("查找成功",$data,200);
        }
        return json_fail("查找失败",$data,100);
    }

}
