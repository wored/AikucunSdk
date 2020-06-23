<h1 align="center"> 爱库存sdk</h1>

## 安装

```shell
$ composer require wored/aikucunsdk-sdk -vvv
```

## 使用
```php
<?php
use \Wored\AikucunSdk\AikucunSdk;

$config = [
    'appid'     => '***************',
    'version'   => '3.0',
    'format'    => 'json',
    'appsecret' => '**********************',
    'rootUrl'   => 'https://openapi.aikucun.com',
];
// 海带sdk
$haidai = new AikucunSdk($config);
//拉取订单
$aikucun->request('delivery.haitao.order.list', [
    'adOrderId' => '***************',
    'fields'    => '*',
    "page"      => 1,
    "pageSize"  => 10,
    "status"    => 0
]);
//
```
## License

MIT