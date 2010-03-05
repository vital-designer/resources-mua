<?php

/*
 * Created by Muhammad Usman Arshad, usmanarshad.blogpsot.com
 * email : sh_muhammad@hotmail.com
 * Feel free to contact
 * Version : 1.0
 */

class ImageGallery
{
	var $imagefolder;
	var $thumbsfolder;
	var $thumbprefix;
	var $thumbprefix2;
	var $filefilters;
	var $images;
	var $galleriesfolder;
	var $twidth;
	var $theight;
	var $twidth2;
	var $theight2;
	var $zoomstyle;
	
	function ImageGallery() 
	{
		$this->imagefolder = "";
		$this->thumbsfolder = "";
		$this->thumbprefix = "";
		$this->thumbprefix2 = "";
		$this->images = array();
		$this->galleriesfolder = "";
		$this->filefilters = "";
		$this->twidth = 105;
		$this->theight = 105;
		$this->twidth2 = 800;
		$this->theight2 = 800;
		$this->zoomstyle = 'lightbox';
		
	}
	
	function GetAllGalleries()
	{
		$handle=opendir($this->galleriesfolder);
		$galleries=array();
		while(($gallery = readdir($handle))!== false)
		{
			if (is_dir($this->galleriesfolder.$gallery) && $gallery != ".." && $gallery != ".") 
			{
				$galleries[] = $this->galleriesfolder.$gallery;
			}
		}
		return $galleries;
	}
	
	function ditchtn($arr)
	{
		foreach ($arr as $item)
		{
			if (stripos(strtolower($item),$this->thumbprefix) === false)
			{ 
				if (!file_exists($this->imagefolder."/".$this->thumbprefix . $item))
				{
					if (!preg_match("/^".$this->thumbprefix."/",$item))
					{
						$this->createthumb($item,$this->thumbprefix.$item,$this->twidth,$this->theight);
						$this->createthumb($item,$this->thumbprefix2.$item,$this->twidth2,$this->theight2);
						$this->images[$item]=array ( "thumb" => $this->thumbprefix.$item, 
													 "thumb2" => $this->thumbprefix2.$item);
					}
				} else {
					$this->images[$item] = array ( "thumb" => $this->thumbprefix.$item, 
												   "thumb2" => $this->thumbprefix2.$item);
				}				
			}
			
		}
		ksort($this->images);
	}

	function createthumb($name,$filename,$new_w,$new_h)
	{
		$extension=explode(".",$name);
		$imgname = $this->imagefolder . "/" . $name;
		if (preg_match("/jpg|jpeg/",$extension[1]))
		{
			$src_img=imagecreatefromjpeg($imgname);
		}
		if (preg_match("/png/",$extension[1]))
		{
			$src_img=imagecreatefrompng($imgname);
		}

		$old_x=imageSX($src_img);
		$old_y=imageSY($src_img);
		
		if ($old_x > $old_y) 
		{
			$thumb_w=$new_w;
			$thumb_h=$old_y*($new_h/$old_x);
		}
		if ($old_x < $old_y) 
		{
			$thumb_w=$old_x*($new_w/$old_y);
			$thumb_h=$new_h;
		}
		if ($old_x == $old_y) 
		{
			$thumb_w=$new_w;
			$thumb_h=$new_h;
		}
	
		$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
		imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 

		if (preg_match("/png/",$extension[1]))
		{
			imagepng($dst_img,$this->thumbsfolder."/".$filename); 
		} else {
			imagejpeg($dst_img,$this->thumbsfolder."/".$filename); 
		}
		imagedestroy($dst_img); 
		imagedestroy($src_img);
	}

	function getAllfilesInDirectory($folder, $onlyThumb = FALSE)
	{
		$handle=opendir($folder);
		$tfiles=array();
		$ofiles=array();
		if ($this->filefilters == "all")
		{
				while(($file = readdir($handle))!== false)
				{
					$files[] = $file;
				}
		}
		if ($this->filefilters != "all")
		{
			$filters_arr = explode(",",$this->filefilters);
			
			while (($file = readdir($handle))!==false)
			{
				for ($f=0;$f<sizeof($filters_arr);$f++)
				{
					$extension=explode(".",$file);
					if ($extension[1] == $filters_arr[$f])
					{
						if ($onlyThumb == TRUE)
						{ 
							if (!(stripos(strtolower($file),strtolower($this->thumbprefix)) === false) &&
								(stripos(strtolower($file),strtolower($this->thumbprefix2)) === false))
							{
									$tfiles[] = $file;
							} else {
								if (stripos(strtolower($file),strtolower($this->thumbprefix2)) === false)
								{
									$ofiles[] = $file;	
								}
							}
						} else {
							if (stripos(strtolower($file),strtolower($this->thumbprefix)) === false &&
								stripos(strtolower($file),strtolower($this->thumbprefix2)) === false)
							{
							
								$ofiles[] = $file;
							}	
						}
					}
				}
			}
		}
		closedir($handle);
		if ($onlyThumb)
		{  
			if (count($tfiles) == 0 && !count($ofiles) == 0) {
				$this->imagefolder=$folder;
				$this->thumbsfolder=$folder;
				$this->ditchtn($ofiles);
				$tfiles = $this->getAllfilesInDirectory($folder,TRUE);
			}
			return $tfiles;
		} else {
			return $ofiles;
		}
		
	}
	
	function GetGalleryImages()
	{
		$this->ditchtn($this->getAllfilesInDirectory($this->imagefolder));
		$this->thumbsfolder = $this->imagefolder;
		$str = "";
		$counter = 1;
		foreach ($this->images as $original=>$thumbnails)
		{
			$str .= '<li class="thumb"><span class=""><em style="background-image:url(\'';
			$str .= $this->thumbsfolder ."/" . $thumbnails['thumb'] . "');\">";
			$str .= "<a href=\"" . $this->thumbsfolder."/".$thumbnails['thumb2']."\" style=\"background:#fff;\"";
			if ($this->zoomstyle == "lightbox")
			{
				$str .= " rel=lightbox";	
			}
			$str .= ">" . $thumbnails['thumb']."</a></em></span>";
			$str .= "<ul class=original><li class=original>$counter&nbsp;<a href=\"$this->thumbsfolder/$original\"";
			if ($this->zoomstyle == "fancyzoom") { $str .= "rel=nozoom "; }
			$str .=  "target=_blank><img src=\"images/zoom-in.png\" height=15 width=15 align=absmiddle>&nbsp;Full Size</a></li></ul>";
			$str .= "</li>";
			$counter++;
		}
		
		return $str;
									   
	}
	

	function GetRandomImage($gallery, $include_subs = FALSE) 
	{
		
		$html_gals = "";		
		$all_my_files = $this->getAllfilesInDirectory($gallery,TRUE);
		srand((float) microtime() * 10000000);
		if ($all_my_files) 
			$random_image = $gallery."/".$all_my_files[array_rand($all_my_files, 1)];
		else 
			$random_image = 'images/noimage.jpg';


		$html_gals .= "<li><h3><a href=\"$PHP_SELF?gallery=" . urlencode($gallery) ."\">". substr($gallery,strlen($this->galleriesfolder)) . "</a></h3>";
		$html_gals .= "<span class=\"thumb\"><span><em style=\"background-image: url('". $random_image . "');\">";
		$html_gals .= "<a href=\"$PHP_SELF?gallery=" . urlencode($gallery) ."\" style=\"background:#fff;\">";
		$html_gals .= "</a></em></span></span><p>&nbsp;</p></li>";

		return $html_gals;
		
	}
	
	
	function GetHeaderHtml()
	{
		$header = "";
		$header .= '<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">';
		$header .= '<head><title>Photos</title><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
		$header .= '<link rel="stylesheet" type="text/css" media="screen, projection" href="style/master.css">';
		if ($this->zoomstyle == "lightbox")
		{
			$header .= '<link rel="stylesheet" href="js/lightbox/css/lightbox.css" type="text/css" media="screen" />';
			$header .= '<script src="js/lightbox/js/prototype.js" type="text/javascript"></script>';
			$header .= '<script src="js/lightbox/js/scriptaculous.js?load=effects,builder" type="text/javascript"></script>';
			$header .= '<script src="js/lightbox/js/lightbox.js" type="text/javascript"></script>';
		} else {
			$header .= '<script type="text/javascript" src="js/FancyZoom.js"></script>';
			$header .= '<script type="text/javascript" src="js/FancyZoomHTML.js"></script>';
		}
		$header .= '<script type="text/javascript" src="js/jquery-1.3.2.js"></script>';
		//$header .= '<script type="text/javascript" src="js/jquery.mousewheel.js"></script>';
		//$header .= '<script type="text/javascript" src="js/jquery.scrollable-1.0.2.js"></script>';
		$header .= '</head>';
		return $header;
	}
	
	function GetFooter()
	{
		$footer = "";
		$footer = "<div id=\"footer\"><hr><p>Image Gallery &copy; 2009<br>Created by <strong>Muhammad Usman Arshad</strong><br>Email :<a href=\"mailto:sh_muhammad@hotmail.com\">sh_muhammad@hotmail.com</a></p></div>";
		return $footer;
	}

	
}
	

?>
