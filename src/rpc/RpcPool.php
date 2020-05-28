<?php
/**
 * 凯拓软件 [临渊羡鱼不如退而结网,凯拓与你一同成长]
 * @package topphp-pool
 * @date 2020/3/11 21:57
 * @author sleep <sleep@kaituocn.com>
 */
declare(strict_types=1);

namespace Topphp\TopphpPool\rpc;

use Swoole\ConnectionPool;

class RpcPool extends ConnectionPool
{
    protected $config;

    public function __construct(RpcConfig $rpcConfig, int $size = self::DEFAULT_SIZE)
    {
        $this->config = $rpcConfig;
        parent::__construct(function () {
            return new RpcConnection($this->config);
        }, $size, RpcProxy::class);
    }
}
