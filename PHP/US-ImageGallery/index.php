<?
	include_once("classes/ImageGallery.php");
	set_time_limit(200);
	$ig = new ImageGallery();
	$ig->filefilters = "jpg,JPG,JPEG,jpeg,png,PNG";
	$ig->thumbprefix = "t_";
	$ig->thumbprefix2 = "tp_";
	$ig->zoomstyle = "lightbox";
    $ig->galleriesfolder = "gallery/";
	$html = $ig->GetHeaderHtml();

	if (!empty($_REQUEST['gallery']))
	{
		$return_link = "<a href=\"$PHP_SELF\">Go Back</a>";
		$body_on_load = "";
		if ($ig->zoomstyle == "fancyzoom")
		{
			 $body_on_load = "onload=\"setupZoom();\"";
		}

		$html .= "<body class=\"gallery\" $body_on_load><div id=\"content\"><ul class=\"slideset\">";
		$gallery = urldecode($_REQUEST['gallery']);
		$ig->imagefolder=$gallery;
		$html .= $ig->GetGalleryImages();
		$html .= '</ul></div>';
		$html .= "<p id=\"path\"><a href='index.php'>Books</a> > <strong>" . substr($gallery,strlen($ig->galleriesfolder)) . "</strong></p>";
		$html .= $ig->GetFooter() . '</body></html>';
	}
	else
	{

		$gals = $ig->GetAllGalleries();

		$html  .= "<body class=\"index\"><div id=\"content\">";
		$html .= "<h1>Image Gallery By Usman</h1><div class=\"galleries useslides\"><h2>Recently Updated Galleries</h2><ul>";

		foreach($gals as $gallery)
		{
			$html .= $ig->GetRandomImage($gallery, FALSE);
		}

		$html .= "</ul></div>". $ig->Getfooter();
		
		$html .= "</body></html>";


	}

	echo $html;

?>
