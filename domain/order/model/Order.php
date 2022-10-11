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