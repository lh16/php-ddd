<?php
//应用层不包含业务逻辑。对外为展现层提供各种应用功能（包括查询或命令），对内调用领域层（领域对象或领域服务）
class SignUpUserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    //用邮箱新注册用户
    public function execute(SignUpUserRequest $request)//接收  数据传输对象（ DTO）
    {
       /* $user = $this->userRepository->userOfEmail($request->email);//不能含业务逻辑
        if ($user) {
            throw new UserAlreadyExistsException();
        }*/
        $user = new User(//接口层应该直接 调用适配层 转完 为DO 后传到 应用服务层
            $this->userRepository->nextIdentity(),
            $request->email,
            $request->password
        );
        $this->userRepository->add($user);//其实这里是不是就是应该传 领域模型参数?  对的，因为仓储实现层 统一 为接收领域模型对象或者参数
        return new SignUpUserResponse($user);
    }
}
