<?php
/**
 * 凯拓软件 [临渊羡鱼不如退而结网,凯拓与你一同成长]
 * Project: topphp-pool
 * Date: 2020/2/18 23:37
 * Author: sleep <sleep@kaituocn.com>
 */
declare(strict_types=1);

namespace Topphp\TopphpPool;

use Topphp\TopphpPool\contract\ConnectionInterface;

abstract class BaseConnection implements ConnectionInterface
{
    protected $pool;
    /**
     * @var float
     */
    protected $lastUseTime = 0.0;

    public function __construct(BasePool $pool)
    {
        $this->pool        = $pool;
        $this->lastUseTime = microtime(true);
    }

    public function check(): bool
    {
        $maxIdleTime = $this->pool->config['max_idle_time'];
        $now         = microtime(true);
        var_dump('now:' . $now);
        var_dump('lastUseTime+$maxIdleTime:' . (string)($maxIdleTime + $this->lastUseTime));
        var_dump(!($now > $maxIdleTime + $this->lastUseTime));
        if ($now > $maxIdleTime + $this->lastUseTime) {
            return false;
        }
        $this->lastUseTime = $now;
        return true;
    }

    /**
     * 释放一个连接放回到连接池中
     * @author sleep
     */
    public function release(): void
    {
        $this->pool->release($this);
    }

    public function getConnection()
    {
        return $this->getActiveConnection();
    }

    abstract protected function getActiveConnection();

}
