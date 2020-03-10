<?php
/**
 * 凯拓软件 [临渊羡鱼不如退而结网,凯拓与你一同成长]
 * Project: topphp-pool
 * Date: 2020/2/18 22:37
 * Author: sleep <sleep@kaituocn.com>
 */
declare(strict_types=1);

namespace Topphp\TopphpPool;

use RuntimeException;
use think\App;
use Throwable;
use Topphp\TopphpPool\contract\ConnectionInterface;

abstract class BasePool
{
    /**
     * @var array
     */
    public $config = [
        'min_connections' => 1,
        'max_connections' => 100,
        'wait_timeout'    => 10,
        'connect_timeout' => 10,
        'max_idle_time'   => 60.0
    ];
    /**
     * @var int 当前连接数
     */
    protected $current = 0;
    /**
     * @var Channel
     */
    protected $channel;

    /** @var App */
    protected $app;

    public function __construct()
    {
        $this->app     = App::getInstance();
        $this->channel = $this->app->make(Channel::class, ['size' => $this->config['max_connections']]);
    }

    public function getInstance(): ConnectionInterface
    {
        $length = $this->channel->length();
        try {
            if ($length === 0 && $this->current < $this->config['max_connections']) {
                ++$this->current;
                return $this->createConnection();
            }
        } catch (Throwable $e) {
            --$this->current;
            throw new RuntimeException($e->getMessage(), $e->getCode());
        }
        $connection = $this->channel->pop($this->config['wait_timeout']);
        if (!$connection instanceof ConnectionInterface) {
            throw new RuntimeException('连接池已耗尽。在等待超时之前无法建立新连接。');
        }
        return $connection;
    }

    /**
     * 释放一个连接放回到连接池中
     * @param ConnectionInterface $connection
     * @author sleep
     */
    public function release(ConnectionInterface $connection): void
    {
        $this->channel->push($connection);
    }

    public function flush()
    {
        var_dump('flush');
    }

    abstract protected function createConnection(): ConnectionInterface;

    /**
     * @return int
     */
    public function getCurrent(): int
    {
        return $this->current;
    }
}
