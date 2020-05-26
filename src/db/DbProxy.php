<?php
/**
 * 凯拓软件 [临渊羡鱼不如退而结网,凯拓与你一同成长]
 * @package topphp-pool
 * @date 2020/3/11 22:42
 * @author sleep <sleep@kaituocn.com>
 */
declare(strict_types=1);

namespace Topphp\TopphpPool\db;

use Swoole\ObjectProxy;

class DbProxy extends ObjectProxy
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection();
        parent::__construct($this->connection);
    }

    public function __call(string $name, array $arguments)
    {
        return $this->connection->{$name}(...$arguments);
    }

}
