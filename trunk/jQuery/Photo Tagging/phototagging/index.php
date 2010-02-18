<?php include 'includes/conn.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Photo Tagging by Neill Horsman</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" title="no title" charset="utf-8"/>
	<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/jquery.imgareaselect-0.7.min.js"></script>
	<script type="text/javascript" src="js/jquery.load.js"></script>
</head>
<body>
<!-- 
Title: Photo Tagging
Author: Neill Horsman
URL: http://www.neillh.com.au
Credits: jQuery, jQuery ImgAreaSelect, www.nodstrum.com (Auto Complete), 
-->
<?php
	// If user has submitted a tag, insert into database
	if(!$db) {
		// Show error if we cannot connect.
		echo 'ERROR: Could not connect to the database.';
	} else {
		if(isset($_REQUEST['form'])) {
			$query = $db->query(" INSERT INTO phototags (id, title, x1, y1, x2, y2, width, height) " .
			" VALUES('', '".$_POST['title']."', '".$_POST['x1']."', '".$_POST['y1']."', '".$_POST['x2']."', '".$_POST['y2']."', '".$_POST['w']."', '".$_POST['h']."') ");
		}
	}
?>
<h1>1. Start typing a name for your tag</h1>
<div>
	<form method="post" action="index.php">
		<!-- Grab the X/Y/Width/Height -->
		<input type="hidden" name="x1" id="x1" value="<?php echo $x1; ?>" />
		<input type="hidden" name="y1" id="y1" value="<?php echo $y1; ?>" />
		<input type="hidden" name="x2" id="x2" value="<?php echo $x2; ?>" />
		<input type="hidden" name="y2" id="y2" value="<?php echo $y2; ?>" />
		<input type="hidden" name="w" id="w" value="<?php echo $w; ?>" />
		<input type="hidden" name="h" id="h" value="<?php echo $h; ?>" />
		<input type="text" name="title" size="30" value="" id="inputString" onkeyup="lookup(this.value);" onblur="fill();" />
		<input type="hidden" name="form" value="submit" />
		<input type="submit" value="Submit" class="send" />
</div>
<!--  Auto complete drop down  -->
<div class="suggestionsBox" id="suggestions" style="display: none;">
	<img src="images/upArrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
	<div class="suggestionList" id="autoSuggestionsList">
		&nbsp;
	</div>
</div>
<div class="clear"></div>
	</form>
<h1>2. Click and drag over the image where you want to tag</h1>
<div style="position:relative;">
	<img src="images/image.jpg" border="0" class="annotated" id="imageid" /><br /><br />
<?php
	$names = array();
	if(!$db) {
		// Show error if we cannot connect.
		echo 'ERROR: Could not connect to the database.';
	} else {
		$query = $db->query(" SELECT id, title, x1, y1, x2, y2, width, height FROM phototags ");
		while ($result = $query ->fetch_object()) {
		$name = str_replace(' ', '-', $result->title);
?>
	<style type="text/css">
		#map a.<?php echo $name; ?> { top:<?php echo $result->y1; ?>px; left:<?php echo $result->x1; ?>px; width:<?php echo $result->width; ?>px; height:<?php echo $result->height; ?>px; }
	</style>
	<ul id="map">
		<li><a class="<?php echo $name; ?>" href="#"><span><b><?php echo $result->title; ?></b></span></a></li>
	</ul>
	<?php $names[] = $name; ?>
	<?php } }?>
</div>
<p>In this photo: <?php foreach ($names as $name) { echo "<a href='$name'>".$name."</a>&nbsp;&nbsp;"; } ?></p>
<br />
<h1>Submit. <span> Submit moved down here so you dont click it after only typing in a name.</span></h1>

<!-- Only Info below  -->
<br /><br />
<h2>Notes.</h2>
<p>Feel free to edit and redistribute this code as you wish, keen to see what people come up with so send me over an email info@neillh.com.au</p>
<p>Working in Firefox, Chrome, Safari. Image select is not working in IE8 currently</p>
<p>Edit includes/conn.php to add your own database connection details</p>
<h2>Credits.</h2>
<p><a href="http://www.jquery.com" target="_blank">jQuery</a><br />
<a href="http://odyniec.net/projects/imgareaselect/" target="_blank">imgAreaSelect</a><br />
<a href="http://www.nodstrum.com" target="_blank">Auto Complete</a><br />
</p>
<h2>Download.</h2>
<p><a href="http://www.neillh.com.au/phototagging/phototagging.rar">Download HERE</a></p>
<h2>Databases.</h2>
<p>CREATE TABLE phototags (<br />
&nbsp;&nbsp;&nbsp;id int(255) NOT NULL AUTO_INCREMENT,<br />
&nbsp;&nbsp;&nbsp;photoid int(11) NOT NULL,<br />
&nbsp;&nbsp;&nbsp;title varchar(255) NOT NULL,<br />
&nbsp;&nbsp;&nbsp;x1 int(11) DEFAULT NULL,<br />
&nbsp;&nbsp;&nbsp;y1 int(11) DEFAULT NULL,<br />
&nbsp;&nbsp;&nbsp;x2 int(11) DEFAULT NULL,<br />
&nbsp;&nbsp;&nbsp;y2 int(11) DEFAULT NULL,<br />
&nbsp;&nbsp;&nbsp;width int(11) DEFAULT NULL,<br />
&nbsp;&nbsp;&nbsp;height int(11) DEFAULT NULL,<br />
&nbsp;&nbsp;&nbsp;PRIMARY KEY (id)<br />
)</p>
<p>CREATE TABLE members (<br />
&nbsp;&nbsp;&nbsp;member_id int(11) NOT NULL AUTO_INCREMENT,<br />
&nbsp;&nbsp;&nbsp;firstname varchar(100) DEFAULT NULL,<br />
&nbsp;&nbsp;&nbsp;lastname varchar(100) DEFAULT NULL,<br />
&nbsp;&nbsp;&nbsp;PRIMARY KEY (member_id)<br />
)</p>
</body>
</html>