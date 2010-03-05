<?php
if (empty($_POST['compare'])) die ("There are no files to compare.");

require_once('config.php');
require_once('functions.php');

include_once('head.html');
?>

<body>

<div id="main">

<table border="0" cellpadding="10" cellspacing="1">

<caption>log comparative</caption>

<thead>
  <tr>
    <th>log url</th>
    <th>title</th>
    <th>browser</th>
    <th>version</th>
    <th>OS</th>
    <th colspan="2">screen<a href="#note2"><sup>2</sup></a></th>
    <th colspan="2">window<a href="#note3"><sup>3</sup></a></th>
    <th>session<a href="#note4"><sup>4</sup></a></th>
    <th>fps</th>
  </tr>
</thead>

<tbody>
<?php
// begin computing table time generation
$time_start = microtime();

$total = count($xml_logs);

for ($i=0; $i<$total; $i++) {
  // load XML
  $file    = LOGS_XML."/".$xml_logs[$i].".xml";
  $xmlData = parse_xml($file);
  
  // write table row
  $entry  = "<tr>\r\n"; 
  $entry .= "<td>".$xmlData['url']."</td>\r\n";
  $entry .= "<td>".utf8_decode($xmlData['title'])."</td>\r\n";
  $entry .= "<td>".$xmlData['browser']."</td>\r\n";
  $entry .= "<td>".$xmlData['version']."</td>\r\n";
  $entry .= "<td>".$xmlData['os']."</td>\r\n";
  $entry .= "<td>".$xmlData['screenX']."</td>\r\n";
  $entry .= "<td>".$xmlData['screenY']."</td>\r\n";
  $entry .= "<td>".$xmlData['windowX']."</td>\r\n";
  $entry .= "<td>".$xmlData['windowY']."</td>\r\n";
  $entry .= "<td>".$xmlData['trackingTime']."</td>\r\n";
  $entry .= "<td>".$xmlData['fps']."</td>\r\n";
  $entry .= "</tr>\r\n";
  echo $entry;
}

// end computing table time generation
$time_end = microtime();
$time     = $time_end - $time_start; 
?>

</tbody>

</table>

<p>_____________________________</p>

<?php echo "<p>This table was generated in $time seconds.</p>"; ?>

<p id="note2">
  <sup>2</sup> Screen resolution (width and height), in pixels.
</p>

<p id="note3">
  <sup>3</sup> Browser window size (width and height), in pixels.
</p>

<p id="note4">
  <sup>4</sup> Total tracking time, in seconds.
</p>

</div>

</body>
</html>
