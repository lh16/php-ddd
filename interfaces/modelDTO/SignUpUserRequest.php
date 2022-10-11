<?php
//一个含有应用服务所含数据的 DTO 实现,SignUpUserRequest 没有行为，只有数据。这可能来自于一个 HTML 表单或者一个 API 端点，尽管咱们不关心这些。
/*
 * 视图模型，数据模型定义 vo/dto （大多数情况是一样的）
 */
class SignUpUserRequest
{
    private $email;
    private $password;

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function email()
    {
        return $this->email;
    }

    public function password()
    {
        return $this->password;
    }
}