<?php
namespace CrMao\SmallLaravel\Container;

class Container{
    // laravel中的容器有$resolev, $bindings ,$instances ,$aliases
    protected $bind = []; // 存放绑定的功能  这个就是所谓的容器 相当于  $aliases 于$bindings的结合
    protected static $instance; // 用于指定当前的实例  单例的创建
    protected $instances; //保存从容器解析出的实例做到共享 避免重复创建


    // 用于容器的绑定操作
    public function bind($abstract, $object)
    {
        // $this->bind[Illuminate\Contracts\Http\Kernel::class] =   App\Http\Kernel::class;
        // return $this->bind[Illuminate\Contracts\Http\Kernel::class]
        $this->bind[$abstract] = $object;
    }
    // 校验是存在于容器中
    public function has($abstract)
    {
        return isset($this->bind[$abstract]);
    }
    // 将实例作为共享
    public function instance($abstract, $instance)
    {
        // 判断是否存在
        if (isset($this->bind[$abstract])) {
            // 如果说创建成功了就会 移除掉绑定中的容器,有助于内存的释放，想要获得实例 instances中已经有了
            unset($this->bind[$abstract]);
        }
        $this->instances[$abstract] = $instance;
    }
    // 单例模式
    public static function getInstace()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static;
        }
        return static::$instance;
    }

    // public function make($abstract, $parameters = [])
    // {   // 解析出实例
    //     return $this->resolve($abstract, $parameters);
    // }
    ## 这个方法对应与laravel中的 resolve方法
    public function make($abstract, $parameters = [])
    {
        // 判断是否之前已经从容器中解析出,如果存在实例就返回
        // 避免重复的解析
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }
        // 判断是否在容器中是否存在对应的实例
        // 有就会创建出容器实例，并且会计入与 $instances中避免多次创建实例
        // 最好的创建实例的方式使用反射机制,这里简化没有试用
        if (isset($this->bind[$abstract])) {
            $class = $this->bind[$abstract];
            // 这个过程对应于 build方法
            $object = (empty($parameters)) ? new $class() : new $class(...$parameters);
            return $this->instances[$abstract] = $object;
        }
        throw new \Exception('没有找到对应的实例 '.$abstract, 1);
    }

}