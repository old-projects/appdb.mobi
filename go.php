<?php
$url = 'http://appdb.mobi/';
if (isset($_GET['url']))
	$url = $_GET['url'];

$delay = 1;
if (isset($_GET['delay']) && (int)$_GET['delay'] > 0)
	$delay = (int)$_GET['delay'];

header('Refresh: '.$delay.'; url='.$url);
?>
<html>
<head>
<!-- <meta http-equiv="refresh" content="<?= $delay ?>;url=<?= $url ?>"> -->
</head>
<body>
Redirect to <?= htmlspecialchars($url) ?>
</body>
</html>
