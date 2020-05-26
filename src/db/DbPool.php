<?php
/**
 * 凯拓软件 [临渊羡鱼不如退而结网,凯拓与你一同成长]
 * @package topphp-pool
 * @date 2020/5/22 21:39
 * @author sleep <sleep@kaituocn.com>
 */
declare(strict_types=1);

namespace Topphp\TopphpPool\db;

use Swoole\ConnectionPool;

class DbPool extends ConnectionPool
{
    protected $config = [];

    public function __construct(DbConfig $dbConfig)
    {
        $this->config = $dbConfig;
        parent::__construct(function () {
            /** @var Db $db */
            $db = app(Db::class);
            return $db->createPoolConnection($this->config->getDriver());
        }, $this->config->getMaxActive(), DbProxy::class);
    }
}
