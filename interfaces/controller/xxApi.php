<?php
//接口层
/**
 * 对外提供（Restful）接口   --协议适配层，这种处理方式使得ApplicationService具有普适性，也即无论最终的调用方是HTTP的客户端，还是RPC的客户端，甚至一个Main函数，最终都统一通过ApplicationService才能访问到领域模型。
 * Class xxApi
 */
class xxApi {

    public function doSome(){
        //调用防腐层
        $openidOrderDO = $transferAdapter.orderDetail2openidOrderDO($orderDetail);//调用防腐层（适配层，DO转义）---  数据转换应该挪到 领域服务作更合理（如下面）
        $openOrderServer.handleOrderMessage($openidOrderDO);//调用  应用服务层 （传领域对象DO到 应用服务）
        //接口层这里，应该为 传DTO到 应用服务，而不是DO。把数据转换交给 应用服务层 TODO
    }

    public function signUpAction(Request $request){
        // ...
        $signUpUserRequest = new SignUpUserRequest(//DTO
            $request->get('email'),
            $request->get('password')
        );

        $userRepository = new RedisUserRepository($redisClient);
        $signUp = new SignUpUserService($userRepository);//调用服务层
        $signUp->execute($signUpUserRequest);//---传DTO到 应用服务。 =》应该是要调用防腐层将DTO 转为 DO后转入 应用服务
       /* $signUp->execute(new SignUpUserRequest(
            'user@example.com',
            'password'
        ));*/
        // ...
    }
}