<?php
namespace CrMao\SmallLaravel\Contracts\Databases;
// 方法规范
// 抽象，接口
// 规范为什么会选择与接口，而不选择与抽象
// trait 类中的方法体是是一个实例的，无法启动约束的作用
// 最最最主要的原因是规范它不仅仅只有一种
interface DB
{
    public function connect();// 这就是一个具体规范 弱性
    // public string connect(string type);
}

?>
