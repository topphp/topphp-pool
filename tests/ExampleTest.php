<?php
/**
 * 凯拓软件 [临渊羡鱼不如退而结网,凯拓与你一同成长]
 * Project: topphp-pool
 * Date: 2020/2/19 19:08
 * Author: sleep <sleep@kaituocn.com>
 */
declare(strict_types=1);

namespace Topphp\Test;

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
}
