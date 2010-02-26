<?php
require("face_detector.php");
$detector = new Face_Detector('detection.dat');
$detector->face_detect('usman.jpg');
$detector->toJpeg();
//$arr = $detector->getFace();
//foreach($arr as $k=>$v)
//{
//	echo $k . " => " . $v . "<br>";
//}
?>