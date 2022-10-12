<?php//实体或聚合根
/*
public static Product create(String name, String description, BigDecimal price) {
    return new Product(name, description, price);//new 一个类
}

private Product(String name, String description, BigDecimal price) {//类
    this.id = ProductId.newProductId();
    this.name = name;
    this.description = description;
    this.price = price;
    this.createdAt = Instant.now();
}*/
/**
 * https://maimai.cn/article/detail?fid=1746172043&efid=Uo_TKYGVr74ZP7xOB965Bg
 * 让我们先演示一下简单的Factory方法，在示例订单系统中，有个业务用例是“创建Product”：

创建Product，属性包括名称(name)，描述(description)和单价(price)，ProductId为UUID
在Product类中实现工厂方法create()：
 *
 * 这里，Product中的create()方法并不包含创建逻辑，而是将创建过程直接代理给了Product的构造函数。你可能觉得这个create()方法有些多此一举，然而这种做法的初衷依然是：我们希望将聚合根的创建逻辑突显出来。构造函数本身是一个非常技术的东西，任何地方只要涉及到在计算机内存中新建对象都需要使用构造函数，无论创建的初始原因是业务需要，还是从数据库加载，亦或是从JSON数据反序列化。因此程序中往往存在多个构造函数用于不同的场景，而为了将业务上的创建与技术上的创建区别开来，我们引入了create()方法用于表示业务上的创建过程。
 *
 */