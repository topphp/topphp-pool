<?php
/**
 * 凯拓软件 [临渊羡鱼不如退而结网,凯拓与你一同成长]
 * @package topphp-pool
 * @date 2020/3/11 22:42
 * @author sleep <sleep@kaituocn.com>
 */
declare(strict_types=1);

namespace Topphp\TopphpPool\db;

use Psr\SimpleCache\CacheInterface;
use Swoole\ObjectProxy;
use think\db\BaseQuery;
use think\db\ConnectionInterface;
use think\DbManager;

class DbProxy extends ObjectProxy implements ConnectionInterface
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

    public function getQueryClass(): string
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    public function connect(array $config = [], $linkNum = 0)
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    public function setDb(DbManager $db)
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    public function setCache(CacheInterface $cache)
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    public function getConfig(string $config = '')
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    public function close()
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    public function find(BaseQuery $query): array
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    public function select(BaseQuery $query): array
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    public function insert(BaseQuery $query, bool $getLastInsID = false)
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    public function insertAll(BaseQuery $query, array $dataSet = []): int
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    public function update(BaseQuery $query): int
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    public function delete(BaseQuery $query): int
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    public function value(BaseQuery $query, string $field, $default = null)
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    public function column(BaseQuery $query, string $column, string $key = ''): array
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    public function transaction(callable $callback)
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    public function startTrans()
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    public function commit()
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    public function rollback()
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    public function getLastSql(): string
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    public function table($table)
    {
        return $this->__call(__FUNCTION__, func_get_args());
    }

    public function name($name)
    {
        return $this->__call(__FUNCTION__, func_get_args());
     }
}
