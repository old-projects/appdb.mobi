Yii Logofon Ip list Extension
==================
This extension helps you use logofon database of mobile operators.
Database: http://www.logofon.ru/xml/ips.xml

How to setup
==================
1. Put files in protected/extensions/LogofonIpList/
2. In config/console.php put following lines
```php
	'commandMap' => array(
		'logofon' => 'ext.LogofonIpList.LogofonCommand',
	),
```

3. Run ```yiic logofon initDb``` to create database tables
4. Run ```yiic logofon``` to fill local database


How to use
==================
```php
$ip = '31.13.144.28';
// or
$ip = ip2long('31.13.144.28');
Yii::import('ext.LogofonIpList.LogofonOperators');
$operator = LogofonOperators::model()->findByIp($ip);
if ($operator !== null) {
	echo 'Operator: '.$operator->name.' ('.$operator->country.')';
}
```

How to update database
==================
Run ```yiic logofon```. You can pass ```--quiet``` to disable output.
