<?php
class xxApi {
    //接口层
    public function doSome(){
        //调用防腐层
        $openidOrderDO = $transferAdapter.orderDetail2openidOrderDO($orderDetail);//调用防腐层（适配层，DO转义）
        $openOrderServer.handleOrderMessage($openidOrderDO);//调用  应用服务层 （传领域对象到 应用服务）
    }

    public function signUpAction(Request $request){
        // ...
        $signUpUserRequest = new SignUpUserRequest(//DTO
            $request->get('email'),
            $request->get('password')
        );

        $userRepository = new RedisUserRepository($redisClient);
        $signUp = new SignUpUserService($userRepository);//调用服务层
       /* $signUp->execute(new SignUpUserRequest(
            'user@example.com',
            'password'
        ));*/
        $signUp->execute($signUpUserRequest);//传DTO到 应用服务。 =》应该是要调用防腐层将DTO 转为 DO后转入 应用服务

        // ...
    }
}