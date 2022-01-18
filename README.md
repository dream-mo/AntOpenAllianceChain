# AntOpenAllianceChain
蚂蚁链开放联盟链 HTTP接入方式 PHP SDK

# 使用

```shell
composer require dreammo/ant-open-alliance-chain
```

```php
<?php

require_once "../vendor/autoload.php";

$request = \Dreammo\AntOpenAllianceChain\Request::getInstance('accessId', 'accessKeyContent');
// 开启握手获取通信token
$isOk = $request->shakeHand();
if (!$isOk) {
    die("握手失败");
}
// 查看token值
var_dump($request->getShakeHandToken());
$client = new \Dreammo\AntOpenAllianceChain\Client($request);
// 查看最新区块信息
var_dump($client->queryLastBlock());

```