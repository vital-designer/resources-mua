<?php
require 'smt_config.php';
// check POST vars
if (empty($_POST)) exit;

/**  
 *   (smt) simple mouse tracking stuff. 
 *    DO NOT CHANGE the code if you don't really understand it 
 */
define ('XML_PATH',       'logs_xml');
define ('HTML_PATH',      'logs_html');

define ('SMT_RECORD',     'smt_record.js');
define ('SMT_REPLAY',     'smt_replay.js');
define ('WZ_JSGRAPHICS',  'wz_jsgraphics.min.js');

// random seed, if needed, to avoid duplicated files
$rand       = mt_rand();
// generate new filename, making easy later chronological classification 
$smt_date   = date("Ymd-His");
// if date is "March 10, 2006 @ 15h 16m 08s", log file names will be 20060310-151608 (.xml and .html)
$xml_file   = (!file_exists(XML_PATH."/".$smt_date.".xml")) ? 
              XML_PATH."/".$smt_date.".xml" : 
              XML_PATH."/".$smt_date."-".$rand.".xml";
$html_file  = (!file_exists(HTML_PATH."/".$smt_date.".html")) ? 
              HTML_PATH."/".$smt_date.".html" : 
              HTML_PATH."/".$smt_date."-".$rand.".html";

// create the XML log file -----------------------------------------------------
$smt_entry  = '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL;
$smt_entry .= '<log>'.PHP_EOL;
// RFC 2822 formatted date
$smt_entry .= '<date year="'.date("Y").'" month="'.date("m").'" day="'.date("d").'" hours="'.date("H").'" minutes="'.date("i").'" seconds="'.date("s").'">'.date("r").'</date>'.PHP_EOL;
$smt_entry .= '<url>'.$_POST['url'].'</url>'.PHP_EOL;
$smt_entry .= '<title>'.$_POST['title'].'</title>'.PHP_EOL;
$smt_entry .= '<client browser="'.$_POST['browser'].'" version="'.$_POST['version'].'" os="'.$_POST['OS'].'"></client>'.PHP_EOL;
$smt_entry .= '<screen width="'.$_POST['sW'].'" height="'.$_POST['sH'].'"></screen>'.PHP_EOL;
$smt_entry .= '<document width="'.$_POST['dW'].'" height="'.$_POST['dH'].'"></document>'.PHP_EOL;
$smt_entry .= '<trackingTime>'.$_POST['t'].'</trackingTime>'.PHP_EOL;
$smt_entry .= '<fps>'.$_POST['fps'].'</fps>'.PHP_EOL;
// CDATA notations are not needed, but they make the XML log more human-readable.
$smt_entry .= '<coordsX><![CDATA['.$_POST['cX'].']]></coordsX>'.PHP_EOL;
$smt_entry .= '<coordsY><![CDATA['.$_POST['cY'].']]></coordsY>'.PHP_EOL;
$smt_entry .= '<clicksX><![CDATA['.$_POST['clX'].']]></clicksX>'.PHP_EOL;
$smt_entry .= '<clicksY><![CDATA['.$_POST['clY'].']]></clicksY>'.PHP_EOL;
$smt_entry .= '<clicksTime><![CDATA['.$_POST['clT'].']]></clicksTime>'.PHP_EOL;
$smt_entry .= '</log>'.PHP_EOL;

// write XML log file
$fp = fopen($xml_file, "w"); 
fwrite($fp, utf8_encode($smt_entry));
fclose($fp);


// check the allow_url_fopen directive
if (!@file_get_contents($_POST['url'])) {
  $ch = curl_init();
  $timeout = 3;
  curl_setopt ($ch, CURLOPT_URL, $_POST['url']);
  curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  // output buffer to get file contents
  ob_start();
  curl_exec($ch);
  curl_close($ch);
  $parse_url = ob_get_contents();
  ob_end_clean();  
} else {
  $parse_url = file_get_contents($_POST['url']);
}

// create HTML log file file ---------------------------------------------------
$play_mark  = '<script type="text/javascript" src="'.JS_PATH.'/'.WZ_JSGRAPHICS.'"></script>'.PHP_EOL;
$play_mark .= '<script type="text/javascript" src="'.JS_PATH.'/'.SMT_REPLAY.'"></script>'   .PHP_EOL;
$play_mark .= '<script type="text/javascript">'         .PHP_EOL;
$play_mark .= '//<![CDATA['                             .PHP_EOL;
$play_mark .= 'var smt_data = {'                        .PHP_EOL;
$play_mark .= '    previousWidth:  '.$_POST['dW'] .','  .PHP_EOL;
$play_mark .= '    previousHeight: '.$_POST['dH'] .','  .PHP_EOL;
$play_mark .= '    coordsX: ['.$_POST['cX']       .'],' .PHP_EOL;
$play_mark .= '    coordsY: ['.$_POST['cY']       .'],' .PHP_EOL;
$play_mark .= '    clicksX: ['.$_POST['clX']      .'],' .PHP_EOL;
$play_mark .= '    clicksY: ['.$_POST['clY']      .'],' .PHP_EOL;
$play_mark .= '    fps: '.$_POST['fps']                 .PHP_EOL;
$play_mark .= '};'                                      .PHP_EOL;
$play_mark .= '//]]>'                                   .PHP_EOL;
$play_mark .= '</script>'                               .PHP_EOL;
// search string pattern
$rec_mark   = '<script type="text/javascript" src="'.JS_PATH.'/'.SMT_RECORD.'"></script>';
// replacement action 
$parse_url = str_replace($rec_mark, $play_mark, $parse_url);

// also add a BASE element for linking external files, such as CSS or images
$head_fix  = HEAD_TAG.PHP_EOL.'<base href="'.$_POST['base'].'" />';
$parse_url = str_replace(HEAD_TAG, $head_fix, $parse_url);

// update file
$fp = fopen($html_file, "w");
fwrite($fp, $parse_url, strlen($parse_url));
fclose($fp);
?>