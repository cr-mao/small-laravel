<?php
namespace CrMao\SmallLaravel\Databases;

use CrMao\SmallLaravel\Contracts\Databases\Db as Contracts;


class Mysql implements Contracts
{
    public function connect()
    {
        return 'mysql connect ready';
    }
}