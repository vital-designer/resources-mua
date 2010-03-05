<?php
// Send header to client browser
header("Content-type: image/jpeg");
// Includes the requested class
include_once('classPhpPsdReader.php');
// Finally display the PSD on the screen
imagejpeg(imagecreatefrompsd('admininterface.psd'));

?>