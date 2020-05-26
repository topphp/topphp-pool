<?php
/**
 * 凯拓软件 [临渊羡鱼不如退而结网,凯拓与你一同成长]
 * @package topphp-pool
 * @date 2020/5/24 21:16
 * @author sleep <sleep@kaituocn.com>
 */

declare(strict_types=1);

namespace Topphp\TopphpPool\db;

class DbConfig
{
    protected $driver      = 'mysql';
    protected $maxActive   = 3;
    protected $maxWaitTime = 5;

    /**
     * @return string
     */
    public function getDriver(): string
    {
        return $this->driver;
    }

    /**
     * @param string $driver
     * @return DbConfig
     */
    public function setDriver(string $driver): self
    {
        $this->driver = $driver;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxActive(): int
    {
        return $this->maxActive;
    }

    /**
     * @param int $maxActive
     * @return DbConfig
     */
    public function setMaxActive(int $maxActive): self
    {
        $this->maxActive = $maxActive;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxWaitTime(): int
    {
        return $this->maxWaitTime;
    }

    /**
     * @param int $maxWaitTime
     * @return DbConfig
     */
    public function setMaxWaitTime(int $maxWaitTime)
    {
        $this->maxWaitTime = $maxWaitTime;
        return $this;
    }
}
