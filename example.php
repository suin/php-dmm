<?php

$apiId = 'あなたのAPI ID';
$affiliateId = 'あなたのアフィリエイトID';

// Load test target classes
spl_autoload_register(function($c) { @include_once strtr($c, '\\_', '//').'.php'; });
set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__.'/Source');

$client = new \DMM\Client($apiId, $affiliateId);
$result = $client->request(array(
	'keyword' => 'ハリーポッター',
));

print_r($result);