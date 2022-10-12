<?php
//改变订单状态的 领域服务
class ChangeOrderStatusService
{
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function execute($anOrderId, $anOrderStatus)//是不是也可以直接写在 order聚合根，因为都输属于 模型的操作.=》应该是写在聚合根内 反而更好
    {
        // Fetch an order from the database
        $anOrder = $this->orderRepository->find($anOrderId);
        // Update order status
        $anOrder->setStatus($anOrderStatus);
        // Update updatedAt field
        $anOrder->setUpdatedAt(new DateTimeImmutable());
        // Save the order to the database
        $this->orderRepository->save($anOrder);
    }
}