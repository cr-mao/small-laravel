<?php
namespace CrMao\SmallLaravel\Databases;
use CrMao\SmallLaravel\Contracts\Databases\Db as Contracts;

//实现契约， db类必须有connect 方法
class Oracle implements Contracts
{
    public function connect()
    {
        return 'oracle connect ready';
    }
}