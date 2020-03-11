<?php
/**
 * 凯拓软件 [临渊羡鱼不如退而结网,凯拓与你一同成长]
 * @package topphp-pool
 * @date 2020/3/11 22:18
 * @author sleep <sleep@kaituocn.com>
 */
declare(strict_types=1);

namespace Topphp\TopphpPool\rpc;

use Swoole\Coroutine\Client;
use Topphp\TopphpPool\exception\ConnectionException;

class RpcConnection
{
    /**
     * @var Client
     */
    protected $connection;

    /**
     * @var RpcConfig
     */
    protected $config;

    /**
     * @var float
     */
    protected $lastUseTime = 0.0;

    /**
     * RpcConnection constructor.
     * @param RpcConfig $config
     * @throws ConnectionException
     */
    public function __construct(RpcConfig $config)
    {
        $this->config = $config;
        $isReconnect  = $this->reconnect();
        if ($this->check()) {
            return $this;
        }
        if (!$isReconnect) {
            throw new ConnectionException("无法获取连接信息");
        }
        return $this;
    }

    public function __call($name, $arguments)
    {
        return $this->connection->{$name}(...$arguments);
    }

    public function __get($name)
    {
        return $this->connection->{$name};
    }

    /**
     * @return bool
     * @throws ConnectionException
     * @author sleep
     */
    public function reconnect(): bool
    {
        if (!$this->config->getNode() || empty($this->config->getNode())) {
            throw new ConnectionException('连接配置信息不存在');
        }
        $client = new Client(SWOOLE_SOCK_TCP);
        $client->set($this->config->getOptions());
        $result = $client->connect(
            $this->config->getNode()['host'],
            $this->config->getNode()['port'],
            $this->config->getConnectTimeout()
        );
        if ($result === false && ($client->errCode === 114 || $client->errCode === 115)) {
            $client->close();
            throw new ConnectionException('Connect to server failed.');
        }
        $this->connection  = $client;
        $this->lastUseTime = microtime(true);
        return true;
    }

    public function check(): bool
    {
        $maxIdleTime = $this->config->getMaxIdleTime();
        $now         = microtime(true);
        if ($now > $maxIdleTime + $this->lastUseTime) {
            return false;
        }
        $this->lastUseTime = $now;
        return true;
    }

    public function close(): bool
    {
        $this->lastUseTime = 0;
        $this->connection->close();
        return true;
    }
}
