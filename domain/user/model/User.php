<?php

/**
 * Class User
 * 领域模型
 * 被转换器依赖，比如  用于数据模型  转换为领域模型时调用下面的函数进行组合为集合根实体 的操作
 */
class User {//聚合根
  private $id;//int 用户id
  private $userName;//str
  private $phone;//str
  private $unit;//用户单位实体
  private $address;//vo
  private $roles;//角色实体Arr


    //__get()
    //__set()
    /**
     * 根据角色id设置角色信息
     *
     * @param $roleIds_intArr 角色id
     */
    public function bindRole($roleIds_intArr){
        $this->roles = '';
       /* this.roles = roleIds.stream()
            .map(Role::new)
            .collect(Collectors.toList());*/
    }
    /**
     * 设置用户单位信息
     *
     * @param $unitId
     */
    public function bindUnit($unitId){
        $this->unit = new Unit($unitId);//实体  因为有单位ID来进行关联（转换器往往只处理到ID映射）
    }

    /**
     * 设置用户地址信息
     *
     * @param $province 省
     * @param $city 市
     * @param $county 区
     */
    public function bindAddress($province,$city,$county){
        $this->address = new Address($province,$city,$county);//vo
    }

    protected function publishEvent()//发布新用户注册事件
    {
        DomainEventPublisher::instance()->publish(
            new UserRegistered($this->userId)
        );
    }
}
