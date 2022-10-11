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
