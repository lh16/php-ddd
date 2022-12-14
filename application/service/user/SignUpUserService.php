<?php
/**
 * 应用服务，非核心服务
 * Class SignUpUserService
 */
//应用层不包含业务逻辑（比如 价格加一减一，价格计算啥的）。对外为展现层提供各种应用功能（包括查询或命令），对内调用领域层（领域对象或领域服务）
class SignUpUserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;//仓储部分可以考虑IOC，  比如这里ioc系统启动时就注册   IocCore.Instance.Register({'Repository','userRepository'})进行Register bind 来实现解耦 https://zhuanlan.zhihu.com/p/503583231
    }
    //用邮箱新注册用户
    public function execute(SignUpUserRequest $request)//接收  数据传输对象（ DTO）
    {
       /* $user = $this->userRepository->userOfEmail($request->email);//不能含业务逻辑
        if ($user) {
            throw new UserAlreadyExistsException();
        }*/
        $user = new User(
            $this->userRepository->nextIdentity(),
            $request->email,
            $request->password
        ); //---- 这是一个 聚合根 领域对象DO，这里使用  防腐层 对DTO数据 进行一次转换为 DO 是不是更合理，类似如下更改：
        //$openidOrderDO = $transferAdapter.orderDetail2openidOrderDO($orderDetail);//调用防腐层（适配层，DO转义）---  数据转换应该挪到 领域服务作更合理（如下面）
        //$this->orderRepository->save($openidOrderDO);


        $this->userRepository->save($user);//其实这里是不是就是应该传 领域模型参数?  对的，因为仓储实现层 统一 为接收领域模型对象（save）或者参数（byId）
        return new SignUpUserResponse($user);
    }
}
/**
 * 随着业务发展，业务系统快速膨胀，我们的系统属于核心时：

应用服务虽然没有领域逻辑，但涉及到了对多个领域服务的编排。当业务规模庞大到一定程度，编排本身就富含了业务逻辑（除此之外，应用服务在稳定性、性能上所做的措施也希望统一起来，而非散落各处），那么此时应用服务对于外部来说是一个领域服务，整体看起来则是一个独立的限界上下文。

此时应用服务对内还属于应用服务，对外已是领域服务的概念，需要将其暴露为微服务。
 */
