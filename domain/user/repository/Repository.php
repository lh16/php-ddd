<?php
/**
 * 基础仓储接口     仓储层也称领域资源库
 *
 * 在六边形架构中这个叫 暴露 端口，端口适配器就是指  具体的实现类 xxRepositoryImpl,这样能够经过依赖注入（Dependency Injection）轻松实现Service层的 操作
 */
public interface Repository{

    /**
     * 删除
     *
     * @param id
     */
    function  delete($id);

    /**
     * 按id查找
     *
     * @param id
     * @return  AGGREGATE
     */
    function byId($id);

    /**
     * 保存或更新聚合根
     *
     * @param aggregate
     * @param <S>
     * @return
     */
    function  save($aggregate);


    /**
     * 保存或更新聚合根【直接刷表】
     *
     * @param aggregate
     * @param <S>
     * @return
     */
    function saveAndFlush($aggregate);//{
    //return $aggregate;
    //}

}