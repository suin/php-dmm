# DMM.com 商品検索情報API ライブラリ

[DMM.com](http://www.dmm.com/)の商品情報検索APIをたたくためのPHPライブラリ。

```php
<?php
$client = new \DMM\Client($apiId, $affiliateId);
$result = $client->request(array(
	'keyword' => 'ハリーポッター',
));

print_r($result);
```

## 要件

* PHP 5.3以上

## インストール

Composer経由でインストールします。

まず `composer.json` ファイルに下記を記述します:

```json
{
	"require": {
		"suin/php-dmm": "1"
	}
}
```

composerを走らせてインストールします:

```
$ composer install
```

最後に、あなたのプロダクトで `vendor/autoload.php` をインクルードします:

```
require_once 'vendor/autoload.php';
```


## License

MIT license