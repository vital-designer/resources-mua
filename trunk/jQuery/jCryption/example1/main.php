<?php
session_start();
require_once("../jCryption-1.0.php");
$keyLength = 256;
$jCryption = new jCryption();
if(isset($_GET["generateKeypair"])) {
	$keys = $jCryption->generateKeypair($keyLength);
	$_SESSION["e"] = array("int" => $keys["e"], "hex" => $jCryption->dec2string($keys["e"],16));
	$_SESSION["d"] = array("int" => $keys["d"], "hex" => $jCryption->dec2string($keys["d"],16));
	$_SESSION["n"] = array("int" => $keys["n"], "hex" => $jCryption->dec2string($keys["n"],16));
	
	echo '{"e":"'.$_SESSION["e"]["hex"].'","n":"'.$_SESSION["n"]["hex"].'","maxdigits":"'.intval($keyLength*2/16+3).'"}';
} else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Result</title>
<style type="text/css">
html,body {
	margin:0;
	padding:0;
	font-family:Tahoma;
	font-size:12px;
}
</style>
</head>
<body>

<p><strong>orignial POST:</strong> <br/><?php print_r($_POST); ?></p>
<?php
$var = $jCryption->decrypt($_POST['jCryption'], $_SESSION["d"]["int"], $_SESSION["n"]["int"]);
parse_str($var,$result);
?>

<p><strong>decrypted POST:</strong> <br/><?php print_r($result); ?></p>

</body>
</html>

<?php
}
?>