<?php
/**
 * 凯拓软件 [临渊羡鱼不如退而结网,凯拓与你一同成长]
 * Project: topphp-pool
 * Date: 2020/2/19 19:08
 * Author: sleep <sleep@kaituocn.com>
 */
declare(strict_types=1);

namespace Topphp\Test;

use Swoole\Coroutine\Client;
use Topphp\TopphpPool\rpc\RpcConfig;
use Topphp\TopphpPool\rpc\RpcPool;
use Topphp\TopphpPool\simple\SimpleConnection;
use Topphp\TopphpPool\simple\SimplePool;
use Topphp\TopphpTesting\TestCase;

class ExampleTest extends TestCase
{
    public function testTrueIsTrue()
    {
        /**@var SimplePool $sp */
        $sp = $this->app->make(SimplePool::class, [
            'config' => [
                'min_connections' => 1111,
                'max_connections' => 111,
                'wait_timeout' > 111,
                'connect_timeout' > 111,
                'max_idle_time'   => 610.0
            ]
        ]);
        /**@var SimpleConnection $sc */
        $sc = $sp->getInstance()->getConnection();
        $this->assertTrue(true);
    }

    public function testRpcPool()
    {
        /** @var RpcConfig $config */
        $config = $this->app->make(RpcConfig::class);
        $config
            ->setConnectTimeout(1)
            ->setNode([
                'host' => '127.0.0.1',
                'port' => 9502
            ])
            ->setMaxConnections(100);
        /** @var RpcPool $pool */
        $pool = $this->app->make(RpcPool::class, [$config, $config->getMaxConnections()]);
        $client = $pool->get();
//        $client = new Client(SWOOLE_SOCK_TCP);
//        $client->connect('127.0.0.1', 9502);
        $client->send('{"jsonrpc":"2.0","method":"film-server@filmService@test","params":[9,"11"],"id":123}');
        $recv = $client->recv($config->getWaitTimeout());
        var_dump($recv);
    }
}
