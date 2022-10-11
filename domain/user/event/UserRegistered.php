<?php
class UserRegistered implements DomainEvent
{
    private $userId;//通知订阅者新用户建立所必需的最少许信息就是 UserId。有了这个信息，任何过程，命令，或者应用服务 - 无论是是否来自同一限界上下文 - 均可能都此事件作出反应。
    private $userEmail;

    public function __construct(UserId $userId, $userEmail) //还需要一个Handler  事件执行操作
    {
        $this->userId = $userId;
        $this->userEmail = $userEmail;
        $this->occurredOn = new DateTimeImmutable();
    }

    public function userId()
    {
        return $this->userId;
    }

    public function userEmail()
    {
        return $this->userEmail;
    }

    public function occurredOn()
    {
        return $this->occurredOn;
    }
}

/**
 * @test
 */
/*
public function itShouldPublishUserRegisteredEvent()
{
    $subscriber = new SpySubscriber();
    $id = DomainEventPublisher::instance()->subscribe($subscriber); //订阅事件
    $userId = new UserId();
    new User($userId, 'valid@email.com', 'password');
    DomainEventPublisher::instance()->unsubscribe($id);
    $this->assertUserRegisteredEventPublished($subscriber, $userId);
}
 private function assertUserRegisteredEventPublished(
        $subscriber, $userId
    )
    {
        $this->assertInstanceOf(
            'UserRegistered', $subscriber->domainEvent
        );
        $this->assertTrue(
            $subscriber->domainEvent->serId()->equals($userId)
        );
    }
*/