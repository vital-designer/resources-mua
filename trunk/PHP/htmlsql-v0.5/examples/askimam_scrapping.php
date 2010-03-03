<?php

    /*
    ** htmlSQL - Example 1
    **
    ** Shows a simple query
    */

    include_once("../snoopy.class.php");
    include_once("../htmlsql.class.php");

    $wsql = new htmlsql();

	if (!isset($_REQUEST['fid']) && !isset($_REQUEST['askid'])) {
		// connect to a URL
		if (!$wsql->connect('url', 'http://www.askimam.org/')){
			print 'Error while connecting: ' . $wsql->error;
			exit;
		}
	} elseif (isset($_REQUEST['fid'])) {
		if (!$wsql->connect('url', 'http://www.askimam.org/fatwa/fatwalist.php?fid=' . $_REQUEST['fid'])){
			print 'Error while connecting: ' . $wsql->error;
			exit;
		}	
	} elseif (isset($_REQUEST['askid'])) {
		if (!$wsql->connect('url', 'http://www.askimam.org/fatwa/fatwa.php?askid=' . $_REQUEST['askid'])){
			print 'Error while connecting: ' . $wsql->error;
			exit;
		}	
	}

    /* execute a query:

       This query extracts all links with the classname = nav_item
    */
	if (!isset($_REQUEST['fid']) && !isset($_REQUEST['askid'])) {
		if (!$wsql->query('SELECT * FROM a Where preg_match("/^aCatLink/", $class)')){
			print "Query error: " . $wsql->error;
			exit;
		} 
	} elseif (isset($_REQUEST['fid'])) {
		if (!$wsql->query('SELECT * FROM a Where $class == "AMenu3"')){
			print "Query error: " . $wsql->error;
			exit;
		} 
	
	} elseif (isset($_REQUEST['askid'])) {
	
		if (!$wsql->query('SELECT * FROM td where $class == "FacetAltDataTD"')){
			print "Query error: " . $wsql->error;
			exit;
		} 
	}
	$cntr = 0;
    // show results:
    foreach($wsql->fetch_array() as $row){
	
	if (isset($_REQUEST['askid'])) {
	
		if ( strpos($row['text'],"aCatLink")==false) {
			
			if ($cntr == 1) 
			{
				echo "Category Name<br><b>";echo $row['text'] . "</b>";
			}
			if ($cntr == 3) 
			{
				echo "Question Summary<br><b>";echo $row['text'] . "</b>";
			}			
			if ($cntr == 6) 
			{
				echo "Question Detail<br><b>";echo $row['text'] . "</b>";
			}			
			if ($cntr == 9) 
			{
				echo "Answer<br>";
				$ansr = substr($row['text'],0,strlen($row['text'])-7858);
				echo $ansr;
				//echo nl2br(strip_tags($ansr));
			}			
			$cntr++;
		}


	} else {
		echo '<a href="' . $PHP_SELF . substr($row['href'],strpos($row['href'],"?"),strlen($row['href']) - strlen(strpos($row['href'],"?"))) .'">' . $row['text'] . '</a>' . "<br>";
	}

    }
	
	echo "<a href='" . $PHP_SELF . "'>Go Back</a><br>";
	

?>