<?php
define('BUFSIZ', 32768);
$url = @urldecode($_REQUEST['url']);
$dir = 'downloads/';
$rfile = @fopen($url, 'r');
if (!$rfile)
{
	echo "Error occurred.";
} else {
if (!file_exists($dir))
	mkdir($dir);
$lfile = fopen($dir . basename($url), 'w');
$fsize = remotefsize($url);
while(!feof($rfile))
{
	fwrite($lfile, fread($rfile, BUFSIZ), BUFSIZ);
}
fclose($rfile);
fclose($lfile);
exit();
}

function remotefsize($url) 
{
$sch = parse_url($url, PHP_URL_SCHEME);
if (($sch != "http") && ($sch != "https") && ($sch != "ftp") && ($sch != "ftps")) {
	return false;
}
if (($sch == "http") || ($sch == "https")) {
	$headers = get_headers($url, 1);
	if ((!array_key_exists("Content-Length", $headers))) { return false; }
	return $headers["Content-Length"];
}
if (($sch == "ftp") || ($sch == "ftps")) {
	$server = parse_url($url, PHP_URL_HOST);
	$port = parse_url($url, PHP_URL_PORT);
	$path = parse_url($url, PHP_URL_PATH);
	$user = parse_url($url, PHP_URL_USER);
	$pass = parse_url($url, PHP_URL_PASS);
	if ((!$server) || (!$path)) { return false; }
	if (!$port) { $port = 21; }
	if (!$user) { $user = "anonymous"; }
	if (!$pass) { $pass = ""; }
	switch ($sch) {
		case "ftp":
			$ftpid = ftp_connect($server, $port);
			break;
		case "ftps":
			$ftpid = ftp_ssl_connect($server, $port);
			break;
	}
	if (!$ftpid) { return false; }
	$login = ftp_login($ftpid, $user, $pass);
	if (!$login) { return false; }
	$ftpsize = ftp_size($ftpid, $path);
	ftp_close($ftpid);
	if ($ftpsize == -1) { return false; }
	return $ftpsize;
}
}

?>

