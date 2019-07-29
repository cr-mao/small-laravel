<?php
require __DIR__.'/vendor/autoload.php';
use CrMao\SmallLaravel\Application\Application;
use  CrMao\SmallLaravel\Facades\DB;
$app=new Application();
//// 方法的参数可能不一致
//// 假设oracle -> mysql
 $app->bind(
     CrMao\SmallLaravel\Contracts\Databases\DB::class,
     CrMao\SmallLaravel\Databases\Oracle::class
 );
 /*
  var_dump($app);
 * class CrMao\SmallLaravel\Application\Application#3 (2) {
  protected $bind =>
  array(2) {
    'db' =>
    string(34) "CrMao\SmallLaravel\Databases\MySql"
    'CrMao\SmallLaravel\Contracts\Databases\DB' =>
    string(35) "CrMao\SmallLaravel\Databases\Oracle"
  }

  protected $instances =>
  array(2) {
    'app' =>
          ...

    'CrMao\SmallLaravel\Container\Container' =>
          ...

  }
}

  * */
// 在一个类中，如果调用某一个类中不存在的方法的时候 那会执行那个魔术
// 如果是静态方式
echo DB::connect(); //oracle connect ready
echo PHP_EOL;
// 契约 -》为了约束我们的服务
$db = $app->make(CrMao\SmallLaravel\Contracts\Databases\DB::class);
 echo $db->connect();//oracle connect ready
echo PHP_EOL;
var_dump($app);

