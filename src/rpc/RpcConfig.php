<?php
/**
 * 凯拓软件 [临渊羡鱼不如退而结网,凯拓与你一同成长]
 * @package topphp-pool
 * @date 2020/3/11 22:00
 * @author sleep <sleep@kaituocn.com>
 */
declare(strict_types=1);

namespace Topphp\TopphpPool\rpc;

class RpcConfig
{
    /**
     * @var int
     */
    protected $minConnections = 1;
    /**
     * @var int
     */
    protected $maxConnections = 10;
    /**
     * @var float
     */
    protected $waitTimeout = 10.0;
    /**
     * @var float
     */
    protected $connect_timeout = 10.0;
    /**
     * 最大空闲时间
     * @var float
     */
    protected $maxIdleTime = 60.0;

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @var array
     */
    protected $node = [];

    /**
     * @return int
     */
    public function getMinConnections(): int
    {
        return $this->minConnections;
    }

    /**
     * @param int $minConnections
     * @return RpcConfig
     */
    public function setMinConnections(int $minConnections): self
    {
        $this->minConnections = $minConnections;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxConnections(): int
    {
        return $this->maxConnections;
    }

    /**
     * @param int $maxConnections
     * @return RpcConfig
     */
    public function setMaxConnections(int $maxConnections): self
    {
        $this->maxConnections = $maxConnections;
        return $this;
    }

    /**
     * @return float
     */
    public function getWaitTimeout(): float
    {
        return $this->waitTimeout;
    }

    /**
     * @param float $waitTimeout
     * @return RpcConfig
     */
    public function setWaitTimeout(float $waitTimeout): self
    {
        $this->waitTimeout = $waitTimeout;
        return $this;
    }

    /**
     * @return float
     */
    public function getConnectTimeout(): float
    {
        return $this->connect_timeout;
    }

    /**
     * @param float $connect_timeout
     * @return RpcConfig
     */
    public function setConnectTimeout(float $connect_timeout): self
    {
        $this->connect_timeout = $connect_timeout;
        return $this;
    }

    /**
     * @return float
     */
    public function getMaxIdleTime(): float
    {
        return $this->maxIdleTime;
    }

    /**
     * @param float $maxIdleTime
     * @return RpcConfig
     */
    public function setMaxIdleTime(float $maxIdleTime): self
    {
        $this->maxIdleTime = $maxIdleTime;
        return $this;
    }

    /**
     * @return array
     */
    public function getNode(): array
    {
        return $this->node;
    }

    /**
     * @param array $node
     * @return RpcConfig
     */
    public function setNode(array $node = []): self
    {
        $this->node = $node;
        return $this;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array $options
     * @return RpcConfig
     */
    public function setOptions(array $options = []): self
    {
        $this->options = $options;
        return $this;
    }
}
