<?php
/**
 * 用户转换器   也叫适配器、防腐层 --  防腐层 主要是将 外部系统DO转义成本系统DO，避免外部系统DO一旦发生变化，本系统的改动范围过大的情况，收敛影响面
 * 依赖 用户领域模型（里的函数）
 * 两个都被   【仓储接口实现层】 依赖， 实现层接收领域模型或参数，然后将 领域模型转为数据模型 来操作dao，然后将dao处理完的数据模型转回领域模型返回。 领域模型->数据模型->dao->数据模型->领域模型
 *
 */
public class UserConverter {
    /**
     * 数据模型转领域模型    领域对象(DO)
     *
     * @param po
     * @return User  DO
     */
public static function  deserialize($UserPOpo) {//聚合根设置好 领域模型需要的字段（Vo 实体等），并暴露set方法， 交给转换器进行 转换调用
/*User user = User.builder()
.id(po.getId())
.userName(po.getUserName())
.realName(po.getRealName())
.phone(po.getPhone())
.password(po.getPassword())
.gmtCreate(po.getGmtCreate())
.gmtModified(po.getGmtModified())
.build();
user.bindUnit(po.getUnitId());
user.bindRole(po.getRoleIds());
user.bindAddress(po.getProvince(),po.getCity(),po.getCounty());
return user;*/
}

    /**
     * 领域模型转数据模型
     *
     * @param user  DO
     * @return UserPO
     */
public static function serializeUser($Useruser){
/*UserPO po = new UserPO();
BeanUtils.copyProperties(user,po);
po.setCity(user.getAddress().getCity());
po.setCounty(user.getAddress().getCounty());
po.setProvince(user.getAddress().getProvince());
po.setUnitId(user.getUnit().getId());
    //设置角色id
String roleIds = user.getRoles().stream().map(Role::getId).map(String::valueOf).collect(Collectors.joining(","));
po.setRoleIds(roleIds);
return po;*/
}


}

/**
 * 防腐层
亦称适配层。在一个上下文中，有时需要对外部上下文进行访问，通常会引入防腐层的概念来对外部上下文的访问进行一次转义。

有以下几种情况会考虑引入防腐层：

需要将外部上下文中的模型翻译成本上下文理解的模型。
不同上下文之间的团队协作关系，如果是供奉者关系，建议引入防腐层，避免外部上下文变化对本上下文的侵蚀。
该访问本上下文使用广泛，为了避免改动影响范围过大。
如果内部多个上下文对外部上下文需要访问，那么可以考虑将其放到通用上下文中。

在抽奖平台中，我们定义了用户城市信息防腐层(UserCityInfoFacade)，用于外部的用户城市信息上下文（微服务架构下表现为用户城市信息服务）。

以用户信息防腐层举例，它以抽奖请求参数(LotteryContext)为入参，以城市信息(MtCityInfo)为输出。

package com.company.team.bussiness.lottery.facade;
import ...;

@Component
public class UserCityInfoFacade {
@Autowired
private LbsService lbsService;//外部用户城市信息RPC服务

public MtCityInfo getMtCityInfo(LotteryContext context) {
LbsReq lbsReq = new LbsReq();
lbsReq.setLat(context.getLat());
lbsReq.setLng(context.getLng());
LbsResponse resp = lbsService.getLbsCityInfo(lbsReq);
return buildMtCifyInfo(resp);
}

private MtCityInfo buildMtCityInfo(LbsResponse resp) {...}
}
 */
