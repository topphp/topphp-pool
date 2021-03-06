<?php
/**
 * 凯拓软件 [临渊羡鱼不如退而结网,凯拓与你一同成长]
 * @package topphp-pool
 * @date 2020/5/24 21:12
 * @author sleep <sleep@kaituocn.com>
 */
declare(strict_types=1);

namespace Topphp\TopphpPool\db;

use Swoole\Coroutine;
use think\db\ConnectionInterface;
use think\facade\App;
use Topphp\TopphpPool\Context;

class Db extends \think\Db
{
    protected $connection;

    /**
     * @var DbConfig
     */
    protected $config;

    protected function instance(string $name = null, bool $force = false): ConnectionInterface
    {
        if (empty($name)) {
            $name = $this->getConfig('default', 'mysql');
        }
        if ($force) {
            return $this->createConnection($name);
        }
        return $this->getPoolConnection($name);
    }

    public function createPoolConnection(string $name): ConnectionInterface
    {
        return $this->createConnection($name);
    }

    protected function getConnectionConfig(string $name): array
    {
        $config = parent::getConnectionConfig($name);
        //打开断线重连
        $config['break_reconnect'] = true;
        return $config;
    }

    public function getPoolConnection($name): ConnectionInterface
    {
        $class = 'db.connection.' . $name;
        if (Context::has($class, Context::cid())) {
            return Context::get($class, Context::cid());
        }
        /** @var DbPool $pool */
        $pool   = App::make(DbPool::class, [$this->config]);
        $client = $pool->get();
        Coroutine::defer(function () use ($pool, $client) {
            $pool->put($client);
        });
        return Context::set($class, $client, Context::cid());
    }
}
