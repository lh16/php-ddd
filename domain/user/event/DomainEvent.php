<?php
interface DomainEvent
{
    /**
     * @return DateTimeImmutable
     */
    public function occurredOn();//正如你所见，最小的必要信息就是DateTimeImmutable，这是为了知道事件是什么时候发生的。
}