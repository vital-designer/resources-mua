<?php
$f = $_GET['f'];
if (empty($f)) die ("There is no file to read.");

require_once('config.php');
require_once('functions.php');

include_once('head.html');
?>

<body>

<div id="main">

<table border="0" cellpadding="10" cellspacing="1">

<caption>log details for '<?=$f?>'</caption>

<thead>
  <tr>
    <th>url</th>
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
$time_start = microtime_float();

// load XML
$file    = LOGS_XML."/".$f;
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

// end computing table time generation
$time_end = microtime_float();
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

<h1>report analysis for '<?=$f?>'</h1>

<div id="report">
  
  <?php
  // begin computing table time generation
  $time_start = microtime_float();
  
  // position analysis
  $xcoord = explode(",", $xmlData['coordsX']);
  $xc     = count($xcoord);
  $ycoord = explode(",", $xmlData['coordsY']);
  $yc     = count($ycoord);
  
  $xm = array_avg($xcoord);
  $ym = array_avg($ycoord);
  $xs = array_sdev($xcoord,$xm);
  $ys = array_sdev($ycoord,$ym);
  
  $minX = min($xcoord);
  $minY = min($ycoord);
  $maxX = max($xcoord);
  $maxY = max($ycoord);
  
  // mouse trail analysis
  for ($i=0,$j=1; $i<$xc; $i++) {
    $x1 = $xcoord[$i];
    $x2 = $xcoord[$i+1];
    $y1 = $ycoord[$i];
    $y2 = $ycoord[$i+1];    
    // Euclidean distance
    $d[]  = round(sqrt(($x2-$x1)*($x2-$x1) + ($y2-$y1)*($y2-$y1)), 2);
    // its interesting also to study both the vertical and horizonal distance independently
    $dv[] = round(sqrt(($y2-$y1)*($y2-$y1)), 2);
    $dh[] = round(sqrt(($x2-$x1)*($x2-$x1)), 2);

    // user rest 
    if ($d[$i] == 0) {
      $att[] = $x2;
      $j++;
    } else {
      $time = round($j/$xmlData['fps'],2);
      if ($j!=1) {
        $restRaw[]        = "<strong>".$time."</strong>@(".$xcoord[$i].",".$ycoord[$i].")";
        if (round($time) >= 1)
          $restLoose[] = "<strong>".$time."</strong>@(".$xcoord[$i].",".$ycoord[$i].")";
      }
      $j = 1; 
    }
  }
  // the last element from both distances arrays must be deleted to provide real, precise results
  array_pop($d);
  array_pop($dv);

  $da    = array_avg($d);
  $ds    = array_sdev($d,$da);
  $dmax  = max($d);
  $dmin  = min($d);
  $dhmax = max($dh);
  $dhmin = min($dh); // 99.9% of chance to be 0
  $dvmax = max($dv);
  $dvmin = min($dv); // 99.9% of chance to be 0
  
  // the static points are related and based on user attention
  $static      = count($att);
  $staticIndex = round($static/$xc,3);
  
  //    / ($xmlData['trackingTime']*$xmlData['fps']
  
  // user rest index
  $uid = ($restRaw != NULL) ?
    round(count($restLoose)/count($restRaw),3) :
    "Not Applicable";
  
  // number of clicks and time
  // note that displaying average clicks does not make sense, because in text selection the mouse is pressed multiple times
  if (!empty($xmlData['clicksTime'])) {
    $clicksTime = explode(",", $xmlData['clicksTime']);
    $countClick = count($clicksTime);
  } else
    $countClick = 0;

  ?>
   
  <fieldset>
  <legend>Attention</legend>
    <em>Session Time</em>: <?=$xmlData['trackingTime']?> seconds
    <br /><em>Registration points</em>: <?=$xc?> @ <?=$xmlData['fps']?>fps, <?=$static?> were static and <?=$xc - $static?> were in motion 
    <br /><em>Static Activity</em>: <?=$staticIndex?> (<?=100*$staticIndex?>% of the time)
    <br /><em>Motion Activity</em>: <?=1-$staticIndex?> (<?=100*(1-$staticIndex)?>% of the time)

    <br /><br /><em>User Rest (seconds@coord)</em>: 
    <?php
    if ($restLoose != NULL)
      echo implode(", ", $restLoose);
    else
      echo "Void - not applicable";
    ?>
    <br /><em>Raw User Rest (seconds@coord)</em>: 
    <?php
    if ($restRaw != NULL)
      echo implode(", ", $restRaw);
    else
      echo "Void - not applicable";
    ?>
    <br /><em>User Rest Activity Index</em>: <?=$uid?>
    
    <br /><br /><em>Compensated Static Activity</em>: <?=round($staticIndex*$uid,3)?>
    <br /><em>Compensated Motion Activity</em>: <?=round(1-$staticIndex*$uid,3)?>
    
    <br /><br /><em>Number of clicks</em>: <?=$countClick?>
    <?php
      if (!empty($xmlData['clicksTime'])) 
        echo " [" . $xmlData['clicksTime']. "]"; 
    ?>
  </fieldset>

  <fieldset>
  <legend>Distances</legend>
    <em>Distance Average</em>: <?=$da?>px
    <br /><em>Distance Standard Deviation</em>: <?=$ds?>px
  
    <br /><br /><em>Minimun Distance</em>: <?=$dmin?>px
    <br /><em>Maximun Distance</em>: <?=$dmax?>px
    
    <br /><br /><em>Minimun X Distance</em>: <?=$dhmin?>px
    <br /><em>Maximun X Distance</em>: <?=$dhmax?>px
    <br /><em>Minimun Y Distance</em>: <?=$dvmin?>px
    <br /><em>Maximun Y Distance</em>: <?=$dvmax?>px
    
    <br /><br /><em>Total Distance Amplitude</em>: <?=$dmax-$dmin?>px
    <br /><em>X Distance Amplitude</em>: <?=$dhmax-$dhmin?>px
    <br /><em>Y Distance Amplitude</em>: <?=$dvmax-$dvmin?>px
  <!--
  <br /><br /><em>Vertical Distance Vector</em>: [<?=implode(", ", $dv)?>]
  <br /><br /><em>Horizontal Distance Vector</em>: [<?=implode(", ", $dh)?>]
  <br /><br /><em>Total Distance Vector</em>: [<?=implode(", ", $d)?>]
  -->
  </fieldset>
  
  <fieldset>
  <legend>Position</legend>
    <em>Entry Point</em>: (<?=$xcoord[0]?>, <?=$ycoord[0]?>)
    <br /><em>Exit Point</em>: (<?=$xcoord[$xc-1]?>, <?=$ycoord[$yc-1]?>)
    
    <br /><br /><em>Minimun X coord</em>: <?=$minX?>px
    <br /><em>Minimun Y coord</em>: <?=$minY?>px
    <br /><em>Maximun X coord</em>: <?=$maxX?>px
    <br /><em>Maximun Y coord</em>: <?=$maxY?>px

    <br /><br /><em>Total X Amplitude</em>: <?=$maxX-$minX?>px
    <br /><em>Total Y Amplitude</em>: <?=$maxY-$minY?>px
        
    <br /><br /><em>Relative X scroll reach</em>: <?=round($maxX/$xmlData['windowX'],4)*100?>% of the horizontal fold
    <br /><em>Relative Y scroll reach</em>: <?=round($maxY/$xmlData['windowY'],4)*100?>% of the vertical fold

    
    <br /><br /><em>Centroid Average</em>: (<?=$xm?>, <?=$ym?>)
    <br /><em>Centroid Standard Deviation</em>: (<?=$xs?>, <?=$ys?>)
  </fieldset>
  
</div>

<p>_____________________________</p>

<?php 
  // end computing table time generation
  $time_end = microtime_float();
  $time     = $time_end - $time_start; 
  echo "<p>This report analysis was generated in $time seconds.</p>"; 
?>

</body>
</html>
