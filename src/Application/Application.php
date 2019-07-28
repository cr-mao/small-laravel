<?php
// 框架运行的应用  就是整个框架的核心
namespace CrMao\SmallLaravel\Application;

use CrMao\SmallLaravel\Container\Container;
use CrMao\SmallLaravel\Databases\MySql;
use CrMao\SmallLaravel\Databases\Oracle;

// Container提供初始方法
// Application实际对于应用程序注册，启动
class Application extends Container
{
    // 用来启动程序，启动软件
    // 有用户的信息，继承与Container
    // 启动的方法
    public function __construct()
    {
        $this->registerBaseBindings();
        $this->registerBaseService();
    }
    // 注册系统运行所需要的服务
    // 事先注册一些管理员的信息
    public function registerBaseService()
    {
        // 定义系统服务注册
        $bind = [
            // 标识 => 服务类：
            'db'                                              => MySql::class,
            \CrMao\SmallLaravel\Contracts\Databases\DB::class => Oracle::class,
        ];
        foreach ($bind as $key => $value) {
            $this->bind($key, $value);
        }
    }

    // 事先绑定这个 程序需要的共享实例
    // 将自身绑定为共享实例
    public function registerBaseBindings()
    {
        $this->instance('app', $this);
        $this->instance(Container::class, $this);
    }

    // 从容器中解析实例
    // $abstract 标识：一个字符串，一个接口标识
    public function make($abstract, $parameters = [])
    {
        // 先判断是否在这个容器中
        if (!$this->has($abstract)) {
            return $abstract;
        }
        // 存在就去解析
        return parent::make($abstract, $parameters);
    }

}

