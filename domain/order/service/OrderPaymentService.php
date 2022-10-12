<?php//领域服务
/*
public void pay(Order order, BigDecimal paidPrice) {
    order.pay(paidPrice);
    paymentProxy.pay(order.getId(), paidPrice);//调用支付网关
}*/

/*https://maimai.cn/article/detail?fid=1746172043&efid=Uo_TKYGVr74ZP7xOB965Bg
 * 这里的PaymentProxy与OrderIdGenerator相似，并不适合于放在Order中。可以看到，在OrderApplicationService中，我们并没有直接调用Order中的业务方法，而是先调用OrderPaymentService.pay()，然后在OrderPaymentService.pay()中完成调用支付网关PaymentProxy.pay()这样的业务细节。

到此，再来反观在通常的实践中我们编写的Service类，事实上这些Servcie类将DDD中的ApplicationService和DomainService糅合在了一起，比如在”基于Service + 贫血模型”的实现“小节中的OrderService便是如此。在DDD中，ApplicationService和DomainService是两个很不一样的概念，前者是必须有的DDD组件，而后者只是一种妥协的结果，因此程序中的DomainService应该越少越好。
 */