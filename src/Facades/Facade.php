<?php
// 门面类的父类 -》功能laravel来说
// 快速调用
// 便于维护
namespace CrMao\SmallLaravel\Facades;

use CrMao\SmallLaravel\Application\Application;

abstract class Facade
{
    protected static $resolvedInstance = [];

    // 子类是必须要重写的
    public static function getFacadeClass()
    {
        throw new \Exception("你没有指定代理的门面类 ", 1);
        // return new Oracle::class;
    }

    // 获取这个要调用的这个类
    public static function createFacade()
    {
        // 1. 找到这个类
        $class = static::getFacadeClass();
        if (is_object($class)) {
            return $class;
        }
        // 2. 判断是否之前存在
        if (isset(static::$resolvedInstance[$class])) {
            return static::$resolvedInstance[$class];
        }
        // 3. 创建这个类
        // return static::$resolvedInstance[$class] = $app[$class]
        return static::$resolvedInstance[$class] = Application::getInstace()->make($class);
    }
    // 最为核心的因素就是
    // 通过__CallStatic实现
    public static function __CallStatic($method, $args)
    {
        // ... 新特性解释 http://php.net/manual/zh/migration56.new-features.php
        // 1. 获取这个要调用的这个类
        $class = static::createFacade();
        //  var_dump($class);
        if (!$class) {
            throw new \Exception("类没有找到 " . $class, 1);
        }
        // 2. 执行这个类了吗
        return $class->{$method}(...$args);
    }
}
