<?php
/*
public void save(Order order) {
    String sql = "INSERT INTO ORDERS (ID, JSON_CONTENT) VALUES (:id, :json) " +
        "ON DUPLICATE KEY UPDATE JSON_CONTENT=:json;";
 Map<String, String> paramMap = of("id", order.getId().toString(), "json", objectMapper.writeValueAsString(order));
 jdbcTemplate.update(sql, paramMap);
}
public Order byId(OrderId id) {
    try {
        String sql = "SELECT JSON_CONTENT FROM ORDERS WHERE ID=:id;";
 return jdbcTemplate.queryForObject(sql, of("id", id.toString()), mapper());
 } catch (EmptyResultDataAccessException e) {
        throw new OrderNotFoundException(id);
    }
}
*/

/**
 * https://maimai.cn/article/detail?fid=1746172043&efid=Uo_TKYGVr74ZP7xOB965Bg
 * 通俗点讲，资源库(Repository)就是用来持久化聚合根的。从技术上讲，Repository和DAO所扮演的角色相似，不过DAO的设计初衷只是对数据库的一层很薄的封装，而Repository是更偏向于领域模型。另外，在所有的领域对象中，只有聚合根才“配得上”拥有Repository，而DAO没有这种约束。
 * 在OrderRepository中，我们只定义了save()和byId()方法，分别用于保存/更新聚合根和通过ID获取聚合根。这两个方法是Repository中最常见的方法，有的DDD实践者甚至认为一个纯粹的Repository只应该包含这两个方法。
读到这里，你可能会有些疑问：为什么OrderRepository中没有更新和查询等方法？事实上，Repository所扮演的角色只是向领域模型提供聚合根而已，就像一个聚合根的“容器”一样，这个“容器”本身并不关心客户端对聚合根的操作到底是新增还是更新，你给一个聚合根对象，Repository只是负责将其状态从计算机的内存同步到持久化机制中，从这个角度讲，Repository只需要一个类似save()的方法便可完成同步操作。当然，这个是从概念的出发点得出的设计结果，在技术层面，新增和更新还是需要区别对待，比如SQL语句有insert和update之分，只是我们将这样的技术细节隐藏在了save()方法中，客户方并无需知道这些细节。在本例中，我们通过MySQL的ON DUPLICATE KEY UPDATE特性同时处理对数据库的新增和更新操作。当然，我们也可以通过编程判断聚合根在数据库中是否已经存在，如果存在则update，否则insert。另外，诸如Hibernate这样的持久化框架自动提供saveOrUpate()方法可以直接用于对聚合根的持久化。

对于查询功能来说，在Repository中实现查询本无不合理之处，然而项目的演进可能导致Repository中充斥着大量的查询代码“喧宾夺主”似的掩盖了Repository原本的目的。事实上，DDD中读操作和写操作是两种很不一样的过程，笔者的建议是尽量将此二者分开实现，由此查询功能将从Repository中分离出去，在下文中我将详细讲到。

在本例中，我们在技术实现上使用到了Spring的JdbcTemplate和JSON格式持久化Order聚合根，其实Repository并不与某种持久化机制绑定，一个被抽象出来的Repository向外暴露的功能“接口”始终是向领域模型提供聚合根对象，就像“聚合根的家”一样。
 */