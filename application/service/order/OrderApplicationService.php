<?php
class OrderApplicationService{
    function changeProductCount($id,$command){//外部接口层传 命令 参数进来
        $order  = $orderRepository.byId($orderId);//聚合根 对象  ---- 从仓储取对象     参数$orderId 是原始数据类型，int或str.进入领域模型的工厂时才被封装为对象
        $order.changeProductCount($productId($command.getProductId()),$command.getCount());//业务 计算后的聚合根
        $orderRepository.save($order);// ---- 将对象保存到仓储  持久化
    }

/*@Transactional
public void pay(String id, PayOrderCommand command) {
Order order = orderRepository.byId(orderId(id));
orderPaymentService.pay(order, command.getPaidPrice());//在OrderApplicationService中，直接调用领域服务OrderPaymentService：
//在OrderApplicationService中，我们并没有直接调用Order中的业务方法，而是先调用OrderPaymentService.pay()，然后在OrderPaymentService.pay()中完成调用支付网关PaymentProxy.pay()这样的业务细节
orderRepository.save(order);
}*/


/*
public OrderId createOrder(CreateOrderCommand command) ;
public void changeProductCount(String id, ChangeProductCountCommand command) ;
public void pay(String id, PayOrderCommand command) ;
public void changeAddressDetail(String id, String detail) ;
通常来说，DDD中的写操作并不需要向客户端返回数据，在某些情况下(比如新建聚合根)可以返回一个聚合根的ID，这意味着ApplicationService或者聚合根中的写操作方法通常返回void即可。比如，对于OrderApplicationService，各个方法签名如下：
可以看到，在多数情况下我们使用了后缀为Command的对象传给ApplicationService，比如CreateOrderCommand和ChangeProductCountCommand。Command即命令的意思，也即写操作表示的是外部向领域模型发起的一次命令操作。事实上，从技术上讲，Command对象只是一种类型的DTO对象，它封装了客户端发过来的请求数据。在Controller中所接收的所有写操作都需要通过Command进行包装，在Command比较简单(比如只有1-2个字段)的情况下Controller可以将Command解开之后，将其中的数据直接传递给ApplicationService，比如changeAddressDetail()便是如此；而在Command中数据字段比较多时，可以直接将Command对象传递给ApplicationService。当然，这并不是DDD中需要严格遵循的一个原则，比如无论Command的简繁程度，统一将所有Command从Controller传递给ApplicationService，也不存在太大的问题，更多的只是一个编码习惯上的选择。不过有一点需要强调，即前文提到的“ApplicationService需要接受原始数据类型而不是领域模型中的对象”，在这里意味着Command对象中也应该包含原始的数据类型。

统一使用Command对象还有个好处是，我们通过查找所有后缀为Command的对象，便可以概览性地了解软件系统向外提供的业务功能。
*/


/*https://maimai.cn/article/detail?fid=1746172043&efid=Uo_TKYGVr74ZP7xOB965Bg
 * CQRS

首先，无论哪种读操作方式，都需要遵循一个原则：领域模型中的对象不能直接返回给客户端，因为这样领域模型的内部便暴露给了外界，而对领域模型的修改将直接影响到客户端。因此，在DDD中我们通常为读操作专门创建相应的模型用于数据展现。在写操作中，我们通过Command后缀进行请求数据的统一，在读操作中，我们通过Representation后缀进行展现数据的统一，这里的Representation也即REST中的“R”。

基于领域模型的读操作

这种方式将读模型和写模型糅合到一起，先通过资源库获取到领域模型，然后将其转换为Representation对象，这也是当前被大量使用的方式，比如对于“获取Order详情的接口”，OrderApplicationService实现如下：
@Transactional(readOnly = true)
public OrderRepresentation byId(String id) {
Order order = orderRepository.byId(orderId(id));
return orderRepresentationService.toRepresentation(order);
}
基于数据模型的读操作
这种方式绕开了资源库和聚合，直接从数据库中读取客户端所需要的数据，此时写操作和读操作共享的只是数据库。比如，对于“获取Product列表”接口，通过一个专门的
ProductRepresentationService直接从数据库中读取数据：

 @Transactional(readOnly = true)
public PagedResource<ProductSummaryRepresentation> listProducts(int pageIndex, int pageSize) {
 MapSqlParameterSource parameters = new MapSqlParameterSource();
 parameters.addValue("limit", pageSize);
 parameters.addValue("offset", (pageIndex - 1) * pageSize);
 List<ProductSummaryRepresentation> products = jdbcTemplate.query(SELECT_SQL, parameters,
 (rs, rowNum) -> new ProductSummaryRepresentation(rs.getString("ID"),
 rs.getString("NAME"),
 rs.getBigDecimal("PRICE")));
 int total = jdbcTemplate.queryForObject(COUNT_SQL, newHashMap(), Integer.class);
 return PagedResource.of(total, pageIndex, products);
}
*/
}

/**
 * ApplicationService需要遵循以下原则：

业务方法与业务用例一一对应：前面已经讲到，不再赘述。

业务方法与事务一一对应：也即每一个业务方法均构成了独立的事务边界，在本例中，OrderApplicationService.changeProductCount()方法标记有Spring的@Transactional注解，表示整个方法被封装到了一个事务中。

本身不应该包含业务逻辑：业务逻辑应该放在领域模型中实现，更准确的说是放在聚合根中实现，在本例中，order.changeProductCount()方法才是真正实现业务逻辑的地方，而ApplicationService只是作为代理调用order.changeProductCount()方法，因此，ApplicationService应该是很薄的一层。

与UI或通信协议无关：ApplicationService的定位并不是整个软件系统的门面，而是领域模型的门面，这意味着ApplicationService不应该处理诸如UI交互或者通信协议之类的技术细节。在本例中，Controller作为ApplicationService的调用者负责处理通信协议(HTTP)以及与客户端的直接交互。这种处理方式使得ApplicationService具有普适性，也即无论最终的调用方是HTTP的客户端，还是RPC的客户端，甚至一个Main函数，最终都统一通过ApplicationService才能访问到领域模型。

接受原始数据类型：ApplicationService作为领域模型的调用方，领域模型的实现细节对其来说应该是个黑盒子，因此ApplicationService不应该引用领域模型中的对象。此外，ApplicationService接受的请求对象中的数据仅仅用于描述本次业务请求本身，在能够满足业务需求的条件下应该尽量的简单。因此，ApplicationService通常处理一些比较原始的数据类型。在本例中，OrderApplicationService所接受的Order ID是Java原始的String类型，在调用领域模型中的Repository时，才被封装为OrderId对象。
 */