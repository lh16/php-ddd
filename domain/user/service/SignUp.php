<?php
/**
 *  领域服务  不能归与上述模型，如分页查询等写在此处  还有校验？
 * Class SignUp 签约校验
 */
class SignUp
{
    private $userRepository;
    private $passwordHashing;

    public function __construct(
        UserRepository $userRepository, PasswordHashing $passwordHashing
    )
    {
        $this->userRepository = $userRepository;
        $this->passwordHashing = $passwordHashing;
    }

    public function execute($aUsername, $aPassword)//校验用户名和密码是否合法
    {
        if (!$this->userRepository->has($aUsername)) {
            throw new InvalidArgumentException(
                sprintf('The user "%s" does not exist.', $aUsername)
            );
        }
        $aUser = $this->userRepository->byUsername($aUsername);
        if ($this->isPasswordInvalidFor($aUser, $aPassword)) {
            throw new BadCredentialsException($aUser, $aPassword);
        }
        return $aUser;
    }

    private function isPasswordInvalidFor(User $aUser, $plainPassword)
    {
        return !$this->passwordHashing->verify(
            $plainPassword,
            $aUser->hash()
        );
    }
}

interface PasswordHashing
{
    /**
     * @param $plainPassword
     * @param string $hash
     * @return boolean
     */
    public function verify($plainPassword, $hash);
}