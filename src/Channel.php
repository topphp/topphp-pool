<?php
/**
 * 凯拓软件 [临渊羡鱼不如退而结网,凯拓与你一同成长]
 * Project: component-builder
 * Date: 2020/2/9 21:45
 * Author: sleep <sleep@kaituocn.com>
 */
declare(strict_types=1);

namespace Topphp\TopphpPool;

use SplQueue;
use Swoole\Coroutine;
use Swoole\Coroutine\Channel as CoChannel;

/**
 * 自动判断基于swoole还是spl的连接池基础类库
 * Class Channel
 * @package Topphp\TopphpPool
 */
class Channel
{
    protected $size;

    /**
     * @var CoChannel
     */
    protected $channel;

    /**
     * @var SplQueue
     */
    protected $queue;

    public function __construct(int $size = 100)
    {
        $this->size    = $size;
        $this->channel = new CoChannel($size);
        $this->queue   = new SplQueue();
    }

    public function pop(float $timeout)
    {
        if ($this->isCoroutine()) {
            return $this->channel->pop($timeout);
        }
        return $this->queue->shift();
    }

    public function push($data)
    {
        if ($this->isCoroutine()) {
            return $this->channel->push($data);
        }
        $this->queue->push($data);
        return true;
    }

    public function length(): int
    {
        if ($this->isCoroutine()) {
            return $this->channel->length();
        }
        return $this->queue->count();
    }

    protected function isCoroutine(): bool
    {
        return Coroutine::getuid() > 0;
    }
}
