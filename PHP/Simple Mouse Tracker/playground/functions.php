<?php

function read_dir($dir) 
{
  if ($handle = opendir($dir)) {
      // this is te correct way to read a directory
      while (false !== ($file = readdir($handle))) {
          // append results in array
          if ($file != "." && $file != "..") 
            $res[] = $file;
      }
      closedir($handle);
  }
  return $res;
}


function get_log_filename($file) 
{
  // split filename
  $removeDash = explode("-", $file);
  // date is $removeDash[0]
  $removeDot  = explode(".", $removeDash[1]);
  // time is $removeDot[0]
  
  // append results to array
  $result     = array($removeDash[0], $removeDot[0]);
  return $result;
}

function get_htmllog_fromxml($file) 
{
  $removeDot  = explode(".", $file);
  // file is $removeDot[0]
  return $removeDot[0].".html";
}

function is_correct($password) 
{
  return ($password == PASSWORD);
}


function parse_xml($file) 
{
  // this function is defined if PHP 4 is used instead of version 5
  require_once('DOMit/xml_domit_lite_parser.php');
  $file     = file_get_contents($file);
  $xmlDoc   =& new DOMIT_Lite_Document();
  $xmlDoc->parseXML($file, true);
  $rootNode =& $xmlDoc->documentElement;
  
  // traverse XML document and generate result array
  $result = array('year'         => $rootNode->childNodes[0]->getAttribute('year'),
                  'month'        => $rootNode->childNodes[0]->getAttribute('month'),
                  'day'          => $rootNode->childNodes[0]->getAttribute('day'),
                  'hours'        => $rootNode->childNodes[0]->getAttribute('hours'),
                  'minutes'      => $rootNode->childNodes[0]->getAttribute('minutes'),
                  'seconds'      => $rootNode->childNodes[0]->getAttribute('seconds'),
                  'fullDate'     => $rootNode->childNodes[0]->firstChild->nodeValue,
                  'url'          => $rootNode->childNodes[1]->firstChild->nodeValue, 
                  'title'        => $rootNode->childNodes[2]->firstChild->nodeValue, 
                  'browser'      => $rootNode->childNodes[3]->getAttribute('browser'), 
                  'version'      => $rootNode->childNodes[3]->getAttribute('version'), 
                  'os'           => $rootNode->childNodes[3]->getAttribute('os'), 
                  'screenX'      => $rootNode->childNodes[4]->getAttribute('width'), 
                  'screenY'      => $rootNode->childNodes[4]->getAttribute('height'), 
                  'windowX'      => $rootNode->childNodes[5]->getAttribute('width'), 
                  'windowY'      => $rootNode->childNodes[5]->getAttribute('height'), 
                  'trackingTime' => $rootNode->childNodes[6]->firstChild->nodeValue, 
                  'fps'          => $rootNode->childNodes[7]->firstChild->nodeValue,
                  'coordsX'      => $rootNode->childNodes[8]->firstChild->nodeValue,
                  'coordsY'      => $rootNode->childNodes[9]->firstChild->nodeValue,
                  'clicksX'      => $rootNode->childNodes[10]->firstChild->nodeValue,
                  'clicksY'      => $rootNode->childNodes[11]->firstChild->nodeValue,
                  'clicksTime'   => $rootNode->childNodes[12]->firstChild->nodeValue);
                  
  return $result;
}

function microtime_float()
{
  list($usec, $sec) = explode(" ", microtime());
  return ((float)$usec + (float)$sec);
}

function array_avg($array)
{
  $n = count($array);
  return round(array_sum($array)/$n);
}

function array_sdev($array,$avg)
{
  $n = count($array) - 1; // Bessel's correction for population inferencing
  $sum = array_map("sum_squares", $array);
  $sum = array_sum($sum);
  return round(sqrt(($sum - $avg*$avg)/$n));
}

function sum_squares($x)
{
  return($x*$x);
}

?>
