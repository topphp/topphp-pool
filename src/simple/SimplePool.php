<?php
/**
 * 凯拓软件 [临渊羡鱼不如退而结网,凯拓与你一同成长]
 * Project: topphp-pool
 * Date: 2020/2/19 00:31
 * Author: sleep <sleep@kaituocn.com>
 */
declare(strict_types=1);

namespace Topphp\TopphpPool\simple;

use think\App;
use Topphp\TopphpPool\BasePool;
use Topphp\TopphpPool\contract\ConnectionInterface;

class SimplePool extends BasePool
{
    public function __construct(App $app, array $config = [])
    {
        $this->config = $config;
        parent::__construct($app);
    }

    protected function createConnection(): ConnectionInterface
    {
        // TODO: Implement create() method.
        var_dump('create');
        return $this->app->make(SimpleConnection::class, ['pool' => $this]);
//        return new SimpleConnection($this);
    }
}
