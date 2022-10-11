<?php
class ChangeOrderStatusService
{
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function execute($anOrderId, $anOrderStatus)
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