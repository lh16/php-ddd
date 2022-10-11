<?php
/**
 *
 * 用户领域仓储 -- 主要解决   存储介质的变更，万一不用 Mapper呢,如要用ES  ---- 其实仓储就是有点像Dao层，但dao层又可以作为仓储层的调用来实现DB操作。
 * 我们可以说DAO和存储库的实现看起来非常相似，因为User类是贫血领域模型。而且，存储库只是数据访问层（DAO）之上的另一层。但是，DAO似乎是访问数据的理想选择，而存储库是实现业务用例的理想方式。 --- 几乎可以认为是概念层定义的不同而已
 *
 * 【处理模型转换和调用Mapper操作  -- Mapper层要另外写】
 *仓储的实现类通过依赖反转的方式来提供对存储介质的操作，因此它应该被定义在基础设施层，属于资源的提供方，对领域层屏蔽内部实现。
 *
 */
public class UserRepositoryImpl implements UserRepository {

function delete($id){
//userMapper.deleteById(id);
}

    function  byId($id){//
   /* UserPO user = userMapper.selectById(id);//Mapper接口（相当于Dao接口）https://www.kancloud.cn/java-jdxia/java/741353
        if(Objects.isNull(user)){
            return null;
        }
        return UserConverter.deserialize(user);*/
    }


    function save($user){// $user DO
   /* UserPO userPo = UserConverter.serializeUser(user);
        if(Objects.isNull(user.getId())){
            userMapper.insert(userPo);
        }else {
            userMapper.updateById(userPo);
        }
        return UserConverter.deserialize(userPo);*/
    }
//前三个方法是对仓储的增删改操作，事务由应用服务调用方自己来控制事务
//第四个方法为只要应用服务调用，通过 Spring 的事务传播机制，直接刷库保存。这种要看特定的业务场景，比如我一个方法逻辑链路很长，每一步都会有一个节点状态，成功一个节点应该刷一个节点的数据入库，而不是全部成功或者全部失败。
    function saveAndFlush($aggregate){

    }
}