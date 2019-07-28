<?php
// 门面类的父类 -》功能laravel来说
// 快速调用
// 便于维护
namespace CrMao\SmallLaravel\Facades;
// 让他可以快速调用数据库操作的实例类
class DB extends Facade
{

    // 子类是必须要重写的
    public static function getFacadeClass(){
        //注册的对应oracle类
        //这个类在binds数组中要先绑定
        return   \CrMao\SmallLaravel\Contracts\Databases\DB::class;
    }
}
