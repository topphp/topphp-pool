<?php
/**
 * 凯拓软件 [临渊羡鱼不如退而结网,凯拓与你一同成长]
 * Project: topphp-pool
 * Date: 2020/2/19 00:48
 * Author: sleep <sleep@kaituocn.com>
 */
declare(strict_types=1);

namespace Topphp\TopphpPool\simple;

use RuntimeException;
use Topphp\TopphpPool\BaseConnection;

class SimpleConnection extends BaseConnection
{
    public function __construct(SimplePool $pool)
    {
        parent::__construct($pool);
    }

    protected function getActiveConnection(): SimpleConnection
    {
        var_dump('SimpleConnection');
        if (!$this->check()) {
            var_dump('准备reconnect');
            if (!$this->reconnect()) {
                throw new RuntimeException('重新连接失败');
            }
        }
        var_dump('没有reconnect');
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function close(): bool
    {
        // TODO: Implement close() method.
        return true;
    }

    /**
     * @inheritDoc
     */
    public function reconnect(): bool
    {
        $this->lastUseTime = microtime(true);
        var_dump('reconnect:' . $this->lastUseTime);
        // TODO: Implement reconnect() method.
        return true;
    }
}
