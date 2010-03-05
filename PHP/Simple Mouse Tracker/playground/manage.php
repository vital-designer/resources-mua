<?php

require_once('config.php');

// store each log marked previously
foreach($_POST as $name => $value) {
  if (preg_match("/log/", $name))
    $log[] = $value;
}

$total = count($log);


/*
 * Compare case 
 */
 
if (isset($_POST['compare'])) {

  if ($total == 0) {
    die("You have not selected a log to compare.");
  } else if ($total == 1) {
    die("You have to selected at least 2 logs to compare.");
  }
  
  for ($i=0; $i<$total; $i++)
    $xml_logs[] = $log[$i];
  
  include_once('compare.php');
}




/*
 * Download case 
 */
 
if (isset($_POST['download'])) {

  if ($total == 0)
    die("You have not selected a log to download.");

  include('pclzip.lib.php');
  $zip_name = "smt_logs" . date("Ymd-His") . ".zip";
  $zip_file = new PclZip($zip_name);
  
  for ($i=0; $i<$total; $i++) {
    $xml_log = LOGS_XML . "/" . $log[$i] . ".xml";
    // append the XML log
    $v_list  = $zip_file->add($xml_log, PCLZIP_OPT_ADD_PATH, 'logs_xml');
  }

  if ($v_list == 0) 
    die("Error : " . $zip_file->errorInfo(true));

  // force download
  header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Cache-Control: private", false);
	header("Content-Type: application/zip");
	header("Content-Disposition: attachment; filename=" . basename($zip_name).";" );
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: " . filesize($zip_name));
	readfile($zip_name);
	// delete file
	@unlink($zip_name);
}




/*
 * Delete case 
 */
 
if (isset($_POST['delete'])) {

  if ($total == 0)
    die("You have not selected a log to delete.");

  $warning  = "<p>\r\n";
  $warning .= "<strong>Satus:</strong> " . $total;
  $warning .= ($total > 1) ? " logs have" : " log has";
  $warning .= " been deleted successfully.\r\n";
  $warning .= "</p>\r\n";
  // print warning
  echo $warning;

  for ($i=0; $i<$total; $i++) {
    $html = $log[$i] . ".html";
    $xml  = $log[$i] . ".xml";
    // delete logs 
    @unlink(LOGS_HTML . "/" . $html);
    @unlink(LOGS_XML .  "/" . $xml);
    // print results
    echo $log[$i] . "<br />\r\n";
  }

}

?>
