<?php
//改变订单状态的 领域服务
class ChangeOrderStatusService
{
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function execute($anOrderId, $anOrderStatus)//是不是也可以直接写在 order聚合根，因为都输属于 模型的操作(有两种观点).=》应该是写在聚合根内 反而更好（充血模型）
    {//推荐在调用聚合根的行为方法（是充血模型）之前，使用资源库或领域服务来获取所需要的对象。应用服务可以在此之前做控制分发给聚合。所以聚合根不应引用基础设施。
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
/**
 * https://www.cnblogs.com/firstsaofan/p/16584609.html
 * 聚合的意义
1、为什么聚合可以实现“高内聚，低耦合”。

2、聚合体现的是现实世界中整体和部分的关系，比如订单与订单明细。整体封装了对部分的操作，部分与整体有相同的生命周期。部分不会单独与外部系统单独交互，与外部系统的交互都由整体来负责。

好处就是聚合内部的实体可以紧密的工作，聚合之间可以低耦合的工作

聚合的划分很难
1、系统中很多实体都存在着不同程度的关系，这些关系到底是设计为聚合之间的关系还是聚合之内的关系是很难的。

2、聚合的判断标准：实体是否是整体和部分的关系，是否存在着相同的生命周期。

3、订单与订单明细？用户与订单？

聚合的划分没有标准答案
1、不同的业务流程也就决定了不同的划分方式。

2、新闻和新闻的评论？

例子：
传统的新闻网站可以把新闻和对应的新闻评论设计成一个聚合，但是现在大多数新闻网站都有热评榜，这就导致新闻评论是可以单独与外部系统交互的，这就可以设计成2个聚合了。所以得根据自己的系统来合理的划分。

聚合的划分的原则
1、尽量把聚合设计的小一点，一个聚合只包含一个聚合根实体和密不可分的实体，实体中只包含最小数量的属性。

2、小聚合有助于进行微服务的拆分。

聚合宁愿设计的小一点也不要设计的太大
DDD之领域服务、应用服务
1、聚合中的实体中没有业务逻辑代码，只有对象的创建、对象的初始化、状态管理等个体相关的代码。 TODO

2、对于聚合内的业务逻辑，我们编写领域服务（Domain Service），而对于跨聚合协作以及聚合与外部系统协作的逻辑，我们编写应用服务（Application Service）。

3、应用服务协调多个领域服务、外部系统来完成一个用例。
 */