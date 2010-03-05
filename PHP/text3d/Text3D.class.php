<?php
/*
+-------------------------------------------------+
+                                                 +
+    Text3D.class.php ver. 1.0 by László Zsidi    +
+      CGI binary version on http://gifs.hu       +
+                                                 +
+    This class can be used and distributed       +
+    free of charge, but cannot be modified       +
+        without permission of author.            +
+                                                 +
+-------------------------------------------------+
*/
class text3d {
    /*
    :::::::::::::::::::::::::::::::::::::::::::::
    ::                                         ::
    ::        Class variables - integers       ::
    ::                                         ::
    :::::::::::::::::::::::::::::::::::::::::::::
    */
	var $_193;
	var $_584;
	var $_479;
	var $_350;
	var $_895;
	var $_822;
	var $_746;
	var $_601;
	var $_607;
	var $_166;
	var $_531;
	var $_377;
	var $_571;
	var $_450;
	var $_710;
	var $_663;
	var $_174;
	var $_858;
	var $_988;
	var $_445;
	var $_999;
	var $_008;
	var $_004;
	var $_111;
	var $_112;
	var $_113;
	var $_114;
	var $_115;
	var $_116;
    /*
    :::::::::::::::::::::::::::::::::::::::::::::
    ::                                         ::
    ::         Class variables - arrays        ::
    ::                                         ::
    :::::::::::::::::::::::::::::::::::::::::::::
    */
	var $_014 = Array();
	var $_147 = Array();
	var $_364 = Array();
	var $_091 = Array();
	var $_303 = Array();
	var $_513 = Array();
	var $_352 = Array();
	var $_726 = Array();
	var $_165 = Array();
	var $_057 = Array();
    /*
    :::::::::::::::::::::::::::::::::::::::::::::
    ::                                         ::
    ::           Class variables - PI          ::
    ::                                         ::
    :::::::::::::::::::::::::::::::::::::::::::::
    */
	var $PI = 3.1415926535897931;
    /*
    :::::::::::::::::::::::::::::::::::::::::::::
    ::                                         ::
    ::            Class Constructor            ::
    ::                                         ::
    :::::::::::::::::::::::::::::::::::::::::::::
    */
	function text3d($j, $k, $p, $q, $r, $rgb1, $rgb2, $font, $fontsize, $text)
	{
		$this->_116 = ($j / 10) + 2.0;
		$this->_350 = $j <= 0 ? 128	 : $j << 4;
		$this->_822 = $k <= 0 ? 15   : $k;
		$this->_746 = 45500;
		$this->_895 = 2;
		$this->_584 = 1;
		$this->_479 = 0;
		$this->_111 = $font;
		$this->_112 = $fontsize;
		$this->_113 = $text;

		$i = $p * 256;
		if($i < 0)
			$i += 0x16800;
		$this->_601 = $i;						// ROTX

		$i = $q * 256;
		if($i < 0)
			$i += 0x16800;
		$this->_607 = $i;						// ROTY

		$i = $r * 256;
		if($i < 0)
			$i += 0x16800;
		$this->_166 = $i;						// ROTZ

		$i = 0 * 256;
		if($i < 0)
			$i += 0x16800;
		$this->_531 = $i;

		$i = 0 * 256;
		if($i < 0)
			$i += 0x16800;
		$this->_377 = $i;

		$i = 0 * 256;
		if($i < 0)
			$i += 0x16800;
		$this->_571 = $i;

		for($i = 0; $i < 181; $i++)
			$this->_726[$i] = floor(sin(((double)$i / 180) * $this->PI) * 256);
		$this->_450 = $this->rgb2int($rgb1);
		$this->_352[0] = $this->rgb2int($rgb2);
		$ad[0] = $rgb2[r];
		$ad[1] = $rgb2[g];
		$ad[2] = $rgb2[b];
		$ad1[0] = ((double)$rgb1[r] - $ad[0]) / 110;
		$ad1[1] = ((double)$rgb1[g] - $ad[1]) / 110;
		$ad1[2] = ((double)$rgb1[b] - $ad[2]) / 110;
		for($i = 0; $i < 64; $i++)
			$this->_352[$i] = $this->rgb2int(Array(r=>floor($ad[0] += $ad1[0]), g=>floor($ad[1] += $ad1[1]), b=>floor($ad[2] += $ad1[2])));
		switch($this->_479)
		{
			case 1:
				$this->_663 = 51;
				break;
			case 0:
				$this->_663 = 40;
				break;
		}
		switch($this->_584)
		{
			case 2:
				$this->_174 = $this->_350 * $this->_663;
				break;
			case 1:
				$this->_174 = $this->_822 << 8;
				break;
		}
		$this->_858 = $this->_746 - $this->_174;
        $this->_174 /= 32;
        $this->_555();
        $this->_888();
	}

    /*
    :::::::::::::::::::::::::::::::::::::::::::::
    ::                                         ::
    ::          Main Image Constructor         ::
    ::                                         ::
    :::::::::::::::::::::::::::::::::::::::::::::
    */

	function _888()
	{
        $w = $this->_114 + $this->_822;
        $h = $this->_115 + $this->_822;
        $this->_988 = $w / 2;
        $this->_445 = $h / 2;
        $this->_999 = imageCreateTrueColor($w, $h);
        imageFill($this->_999, 0, 0, imageColorAllocate($this->_999, ($this->_450 >> 16) & 0xFF, ($this->_450 >> 8) & 0x00FF, $this->_450 & 0x0000FF));
		$this->_266();
		$this->_457();
	}

    /*
    :::::::::::::::::::::::::::::::::::::::::::::
    ::                                         ::
    ::               Init block                ::
    ::                                         ::
    :::::::::::::::::::::::::::::::::::::::::::::
    */

	function _266()
	{
		$this->_837();
		$this->_377 += $this->_607;
		if($this->_377 > 0x16800)
			$this->_377 -= 0x16800;
		$this->_531 += $this->_601;
		if($this->_531 > 0x16800)
			$this->_531 -= 0x16800;
		$this->_571 += $this->_166;
		if($this->_571 > 0x16800)
			$this->_571 -= 0x16800;
		$i = $this->_377 >> 8;
		$l = $this->_531 >> 8;
		$j1 = $this->_571 >> 8;
		$l1 = ($this->_925($i) * $this->_925($j1) >> 8) + ($this->_955($i) * $this->_955($l) * $this->_955($j1) >> 16);
		$i2 = $this->_925($l) * $this->_955($j1) >> 8;
		$j2 = ($this->_925($i) * $this->_955($l) * $this->_955($j1) >> 16) - ($this->_955($i) * $this->_925($j1) >> 8);
		$k2 = ($this->_955($i) * $this->_955($l) * $this->_925($j1) >> 16) - ($this->_955($j1) * $this->_925($i) >> 8);
		$l2 = $this->_925($l) * $this->_925($j1) >> 8;
		$i3 = ($this->_955($i) * $this->_955($j1) >> 8) + ($this->_925($i) * $this->_955($l) * $this->_925($j1) >> 16);
		$j3 = $this->_955($i) * $this->_925($l) >> 8;
		$k3 = -$this->_955($l);
		$l3 = $this->_925($i) * $this->_925($l) >> 8;
		for($j = 0; $j < $this->_563; $j++)
		{
			$this->_014[$j] = $this->_147[$j] * $l1 + $this->_364[$j] * $i2 + $this->_091[$j] * $j2 >> 8;
			$this->_303[$j] = $this->_147[$j] * $k2 + $this->_364[$j] * $l2 + $this->_091[$j] * $i3 >> 8;
			$this->_513[$j] = ($this->_147[$j] * $j3 + $this->_364[$j] * $k3 + $this->_091[$j] * $l3 >> 8) + $this->_746;
		}
		for($k = 0; $k < $this->_563 - 1; $k++)
		{
			for($i1 = $k + 1; $i1 < $this->_563; $i1++)
				if($this->_513[$this->_165[$i1]] > $this->_513[$this->_165[$k]])
				{
					$k1 = $this->_165[$i1];
					$this->_165[$i1] = $this->_165[$k];
					$this->_165[$k] = $k1;
				}
		}
	}

    /*
    :::::::::::::::::::::::::::::::::::::::::::::
    ::                                         ::
    ::            Points Constructor           ::
    ::                                         ::
    :::::::::::::::::::::::::::::::::::::::::::::
    */

	function _837()
	{
		$l3 = 0;
		$l7 = 0;
		for($l1 = 1; $l1 <= $this->_057[0]; $l1 += 2)
		{
			$this->_364[$l3] = $this->_057[$l1 + 1] * $this->_350;
			$this->_147[$l3] = $this->_822 * $this->_955($l7 + $this->_057[$l1] * $this->_895);
			$this->_091[$l3] = -$this->_822 * $this->_925($l7 + $this->_057[$l1] * $this->_895);
			$l3++;
		}
		$this->_563 = $l3;
		for($k3 = 0; $k3 < $this->_563; $k3++)
			$this->_165[$k3] = $k3;
	}

    /*
    :::::::::::::::::::::::::::::::::::::::::::::
    ::                                         ::
    ::            Points draw block            ::
    ::                                         ::
    :::::::::::::::::::::::::::::::::::::::::::::
    */

	function _457()
	{
		for($i1 = 0; $i1 < $this->_563; $i1++)
		{
			$k = $this->_165[$i1];
			$l = $this->_710 / $this->_513[$k];
			if($l < 2)
				$l = 2;
			$i = ($this->_988 + ($this->_014[$k] << 7) / $this->_513[$k]) - ($l >> 1);
			$j = ($this->_445 + ($this->_303[$k] << 7) / $this->_513[$k]) - ($l >> 1);
			$c = $this->_352[($this->_513[$k] - $this->_858) / $this->_174];
            imagefilledellipse($this->_999, $i, $j, $l, $l, imageColorAllocate($this->_999, ($c >> 16) & 0xFF, ($c >> 8) & 0x00FF, $c & 0x0000FF));
		}
	}

    /*
    :::::::::::::::::::::::::::::::::::::::::::::
    ::                                         ::
    ::   Truetype font to array points block   ::
    ::                                         ::
    :::::::::::::::::::::::::::::::::::::::::::::
    */

	function _555()
	{
    	$b1 = imageTTFBbox($this->_112, 0, $this->_111, $this->_113);
		$b2 = $b1[4];
		$b3 = abs($b1[5]);
		$im = imageCreateTrueColor($b1[4], abs($b1[5]) + 2);
		imageFill($im, 0, 0, imageColorAllocate($im, 255, 255, 255));
		imagettftext($im, $this->_112, 0, 0, $b3, imageColorAllocate($im, 0, 0, 0), $this->_111, $this->_113);
		$this->_114 = $x = imageSX($im);
		$this->_115 = $y = imageSY($im);
		$c = 0;
		$q = 1;
		$this->_057[0] = 0;
		for($i = 0; $i < $x; $i++)
		{
			for($j = 0; $j < $y; $j++)
			{
				$p = imageColorsForIndex($im, imageColorAt($im, $i, $j));
				if($p['red'] < 128 && $p['green'] < 128 && $p['blue'] < 128)
				{
					$this->_057[$q] = $i;
					$this->_057[$q + 1] = $j;
					$q += 2;
					$c += 2;
				}
			}
		}
		$this->_057[0] = $c;
        $this->_435($this->_116);
	}

	/* :::::::::::::::::::::::::::::::::::::::::: */

	function _435($i)
	{
		for($j = 2; $j <= $this->_057[0]; $j += 2)
			$this->_057[$j] -= $i;
	}

	/* :::::::::::::::::::::::::::::::::::::::::: */

	function _955($i)
	{
		$j = $this->_726[$i % 180];
		if($i > 180)
			$j *= -1;
		return $j;
	}

	/* :::::::::::::::::::::::::::::::::::::::::: */

	function _925($i)
	{
		$j = $this->_726[($i + 90) % 180];
		if($i > 90 && $i < 270)
			$j *= -1;
		return $j;
	}

	/* :::::::::::::::::::::::::::::::::::::::::: */

	function rgb2int($rgb)
	{
		return ($rgb[r] << 16 | $rgb[g] << 8 | $rgb[b]);
	}

	/* :::::::::::::::::::::::::::::::::::::::::: */

	function getImage()
	{
		return $this->_999;
	}
}
?>
