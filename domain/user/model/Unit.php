<?php

/**
 * 领域模型   实体，充血的领域模型，如本身的DURD操作写在此处
 * 单位实体
 * Class Unit
 */
class Unit{
    private $id;//int id
    private $name;//str
}
//与以往的仅有getter、setter的业务对象不同，领域对象具有了行为，对象更加丰满。同时，比起将这些逻辑写在服务内（例如**Service），领域功能的内聚性更强，职责更加明确。https://tech.meituan.com/2017/12/22/ddd-in-practice.html

/**
 * https://zhuanlan.zhihu.com/p/503583231
 * 充血模型

面向对象设计的本质是：“一个对象是拥有状态和行为的”，充血模型就是那种即拥有属性、又拥有操作的类。修改一个用户信息，然后保存，在贫血模型的场景中示例代码如下：

user.setXXX();       userManager.save(user);

在充血模型的场景中，代码如下所示：

user.setXXX()       user.save();

实体（Entity），具备唯一ID，能够被持久化，具备业务逻辑，对应现实世界业务对象。
值对象（Value Object），不具有唯一ID，由对象的属性描述，一般为内存中的临时对象，可以用来传递参数或对实体进行补充描述。
领域服务（Domain Service），为上层建筑提供可操作的接口，负责对领域对象进行调度和封装，同时可以对外提供各种形式的服务。
聚合根（Aggregate Root），聚合根属于实体对象，聚合根具有全局唯一ID，而实体只有在聚合内部有唯一的本地ID，值对象没有唯一ID

 */

