<?php
/*
//代表保险单的 Aggregate
public class Policy {
    //创建 ClaimApplication 的工厂方法
public ClaimApplication applyClaimWith(Accident accident) {

}
}
上面的方法很好理解，在 Policy 上有个方法，applyClaimWith，它接受一个事故信息 Accident 对象，返回另一个 Aggregate ClaimApplication 。当采用这种解决方案时，我们需要更多的分析领域对象之间的关系，在合理的对象上定义工厂方法，切忌在一个 Aggregate 上定义过多的工厂方法，这样也就丢失了相关的领域知识。
*/

