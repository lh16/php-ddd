<?php
//在DDD中，聚合根通常不会引用其他服务类
/*
@Component
public class OrderFactory {

private final OrderIdGenerator idGenerator;

public OrderFactory(OrderIdGenerator idGenerator) {
    this.idGenerator = idGenerator;
}

 public Order create(List<OrderItem> items, Address address) {
    OrderId orderId = idGenerator.generate();
    return Order.create(orderId, items, address);
 }

}*/
/**
 * https://maimai.cn/article/detail?fid=1746172043&efid=Uo_TKYGVr74ZP7xOB965Bg
 * 创建Product”所设计到的Factory的确简单，让我们再来看看另外一个例子：“创建Order”：

创建Order，包含用户选择的Product及其数量，OrderId必须调用第三方的OrderIdGenerator获取
这里的OrderIdGenerator是具有服务性质的对象(即下文中的领域服务)，在DDD中，聚合根通常不会引用其他服务类。另外，调用OrderIdGenerator生成ID应该是一个业务细节，如前文所讲，这种细节不应该放在ApplicationService中。此时，可以通过Factory类来完成Order的创建：
 */