<?php
/*
+-------------------------------------------------+
+                                                 +
+                 Example.php                     +
+                                                 +
+    Text3D.class.php ver. 1.0 by László Zsidi    +
+      CGI binary version on http://gifs.hu       +
+                                                 +
+-------------------------------------------------+
*/
set_time_limit(0);
header('Content-type: image/gif');
require('Text3D.class.php');
require('GifMerge.class.php');
$j = 0;
$k = 0;
for($i = 360; $i > 0; $i--)
{
	if($j++ == 10)
	{
		$txt3d = new text3d(16, 96, 0, $i, 0, Array(r=>22, g=>22, b=>22), Array(r=>255, g=>255, b=>0), "fonts/arial.ttf", 16, "phpclasses");
		ob_start();
		imageGif($txt3d->getImage());
		$frame[$k] = ob_get_contents();
		$delay[$k] = 10;
		ob_end_clean();
		$j = 0;
		$k++;
	}
}
$anim = new GifMerge($frame, 0, 0, 0, -10, $delay, 0, 0, 'C_MEMORY');
echo $anim->getAnimation();
?>
