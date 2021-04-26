<?php
require_once '.env';

$host = $_SERVER['HTTP_HOST'];
$server = $_SERVER['SERVER_NAME'];
$doc = $_SERVER['DOCUMENT_ROOT'];
$saddr = $_SERVER['SERVER_ADDR'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'mypage.php';


echo '<br>';
echo "Host: " . $host;
echo '<br>';
echo "Server: " . $server;
echo '<br>';
echo "Doc Root: " . $doc;
echo '<br>';
echo "Server Addr: " . $saddr;
echo '<br>';
echo "URI: " . $uri;
echo '<br>';
echo "Extra: " . $extra;
echo '<br>';
echo "ENV: " . PROJ;
echo '<br>';
echo "ENV: " . $_ENV['PROJ'];
echo '<br>';
echo "SERV: " . $_SERVER['PROJ'];