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

