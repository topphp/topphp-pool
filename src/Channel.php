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
    /**
     * @var CoChannel
     */
    protected $channel;

    /**
     * @var SplQueue
     */
    protected $queue;

    /**
     * Channel constructor.
     * @param int $size 设置通道最大容量
     */
    public function __construct(int $size = 100)
    {
        $this->channel = new CoChannel($size);
        $this->queue   = new SplQueue();
    }

    /**
     * 从通道中读取数据。
     * @param float $timeout 设置超时时间,值单位: 秒【支持浮点型，如 1.5 表示 1s+500ms】,默认值：-1 永不超时
     * @return mixed 返回值可以是任意类型的 PHP 变量，包括匿名函数和资源,通道被关闭时，执行失败返回 false
     * @author sleep
     */
    public function pop(float $timeout = 60)
    {
        if ($this->isCoroutine()) {
            return $this->channel->pop($timeout);
        }
        return $this->queue->shift();
    }

    /**
     * 向通道中写入数据。
     * @param mixed $data 任意类型数据,为避免产生歧义，请勿向通道中写入空数据，如 0、false、空字符串、null
     * @return bool|mixed
     * @author sleep
     */
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
