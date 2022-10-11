<?php
class UserQueryRepositoryImpl implements UserQueryRepository{
/*@Autowired
private UserMapper userMapper;*/


public function userPage($KeywordQueryquery){//return Page  数据模型
/*Page<UserPO> userPos = userMapper.userPage(query); //注意是userPos  不是 userPo
return UserConverter.serializeUserPage(userPos);*/
}
/*
 * 查询不需要切合领域模型，自己组合想要的数据，不在仓储中做过多的逻辑处理即可。认为它只是一个没有感情的仓库，无法理解你的业务展示逻辑。

查询的应用服务直接调用查询仓储提供的接口获取数据，然后在应用服务内组装单个查询仓储或者多个查询仓储的数据返回给用户交互层。

当然，如果你可以预知你的查询逻辑不会进行存储介质的变更，你也可以直接在查询应用服务内直接操作 Mapper 组装你想要的数据，不为了走 DDD 的形式，而凭空多出一层数据转发。

但是如果你的数据源需要操作多个存储介质（Redis、DB、MySQL 等），那就必须抽离出原子的取数逻辑放置在仓储层，由查询应用服务来处理业务和组装数据。否则在查询应用服务层洋洋洒洒的一大堆代码就是为了从各个存储介质中取数，反而查询、组装业务数据逻辑变得不够清晰了。
 */
}
