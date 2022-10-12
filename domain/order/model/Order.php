<?php
class Order
{
    const STATUS_CREATED = 10;
    const STATUS_ACCEPTED = 20;
    const STATUS_PAID = 30;
    const STATUS_PROCESSED = 40;
    private $id;
    private $customerId;
    private $amount;
    private $status;
    private $createdAt;
    private $updatedAt;

    public function __construct(
        $customerId,
        $amount,
        $status,
        DateTimeInterface $createdAt,
        DateTimeInterface $updatedAt
    )
    {
        $this->customerId = $customerId;
        $this->amount = $amount;
        $this->status = $status;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
    }

    public function getCustomerId()
    {
        return $this->customerId;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setCreatedAt(DateTimeInterface $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setUpdatedAt(DateTimeInterface $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    //业务逻辑。更新order中product数量
    public function changeProductCount($productId, $count){
        $orderItems;//订单中的商品列表
        $totalPrice;//总价
        //先用$productId 找到orderItems 对象，用 $count 更改orderItems 数量。 之后调用计算总价，输出更新后的总价
        //在本例中，Order中的品项(orderItems)和总价(totalPrice)是密切相关的，orderItems的变化会直接导致totalPrice的变化，因此，这二者自然应该内聚在Order下。此外，totalPrice的变化是orderItems变化的必然结果，这种因果关系是业务驱动出来的，为了保证这种“必然”，我们需要在Order.changeProductCount()方法中同时实现“因”和“果”，也即聚合根应该保证业务上的一致性。在DDD中，业务上的一致性被称为不变条件(Invariants)。
        //总结： $orderItems 和 $totalPrice是紧密相关的，业务驱动的，由order直接控制处理。不应该由控制器来掌握 先调用order.changeProductCount 再调用order.updateTotalPrice。  应该把业务封装在领域内
        //对聚合根的设计需要提防上帝对象(God Object)，也即用一个大而全的领域对象来实现所有的业务功能。上帝对象的背后存在着一种表面上看似合理的逻辑：既然要内聚，那么让我们把所有相关的东西都聚到一起吧，比如用一个Product类来应付所有的业务场景，包括订单、物流、发票等等。这种机械的方式看似内聚，实则恰恰是内聚性的反面。要解决这样的问题依然需要求助于限界上下文，不同限界上下文使用各自的通用语言(Ubiquitous Language)，通用语言要求一个业务概念不应该有二义性，在这样的原则下，不同的限界上下文可能都有自己的Product类，虽然名字相同，却体现着不同的业务。https://maimai.cn/article/detail?fid=1746172043&efid=Uo_TKYGVr74ZP7xOB965Bg
    }
}
/**
 * CREATE TABLE `orders` (
`ID` INTEGER NOT NULL AUTO_INCREMENT,
`CUSTOMER_ID` INTEGER NOT NULL,
`AMOUNT` DECIMAL(17, 2) NOT NULL DEFAULT '0.00',
`STATUS` TINYINT NOT NULL DEFAULT 0,
`CREATED_AT` DATETIME NOT NULL,
`UPDATED_AT` DATETIME NOT NULL,
PRIMARY KEY (`ID`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
 */