# topphp-pool

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

#### 简介
一个基于swoole的通用连接池组件

#### 使用
```php
$rpcConfig = App::make(RpcConfig::class, []);
if (isset($config) && !empty($config)) {
    $rpcConfig
        ->setNode($this->node)
        ->setOptions($config['options'])
        ->setMinConnections($config['pool']['min_connections'])
        ->setMaxConnections($config['pool']['max_connections'])
        ->setConnectTimeout($config['pool']['connect_timeout'])
        ->setMaxIdleTime($config['pool']['max_idle_time'])
        ->setWaitTimeout($config['pool']['wait_timeout']);
}
/** @var RpcPool $pool */
$pool   = App::make(RpcPool::class, [
    $rpcConfig,
    10
]);
$client = $pool->get();
```

#### 注意
现代的PHP组件都使用语义版本方案(http://semver.org), 版本号由三个点(.)分数字组成(例如:1.13.2).第一个数字是主版本号,如果PHP组件更新破坏了向后兼容性,会提升主版本号.
第二个数字是次版本号,如果PHP组件小幅更新了功能,而且没有破坏向后兼容性,会提升次版本号.
第三个数字(即最后一个数字)是修订版本号,如果PHP组件修正了向后兼容的缺陷,会提升修订版本号.

## Structure
> 组件结构

```
bin/        
build/
docs/
config/
src/
tests/
vendor/
```


## Install

Via Composer

``` bash
$ composer require topphp/topphp-pool 你的组件名称
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email sleep@kaituocn.com instead of using the issue tracker.

## Credits

- [topphp][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/topphp/topphp-pool.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/topphp/topphp-pool/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/topphp/topphp-pool.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/topphp/topphp-pool.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/topphp/topphp-pool.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/topphp/topphp-pool
[link-travis]: https://travis-ci.org/topphp/topphp-pool
[link-scrutinizer]: https://scrutinizer-ci.com/g/topphp/topphp-pool/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/topphp/topphp-pool
[link-downloads]: https://packagist.org/packages/topphp/topphp-pool
[link-author]: https://github.com/topphp
[link-contributors]: ../../contributors
