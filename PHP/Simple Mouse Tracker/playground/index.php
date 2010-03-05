<?php
// load required files
require_once('config.php'); 
require_once('functions.php');

// print the DOCTYPE and head
include_once('head.html');
?>

<body>

<div id="main">

<?php 
if ($_POST['admin'] && is_correct($admin)) {
?>
<form id="manage" method="post" action="manage.php">
<?php
}

// read dir contents
$xml  = read_dir(LOGS_XML);
$html = read_dir(LOGS_HTML);

// count logs number
$total = count($xml);

// notify user if there are not the same number of HTML and XML logs
if ($total != count($html)) { 
  $warning = true;
  echo "<p><strong>Warning: XML and HTML logs do not match.</strong><br />There are missing log files.</p>\r\n";
}
?>

<table border="0" cellpadding="10" cellspacing="1">

<caption>(smt) playground logs</caption>

<thead>
  <tr>
    <th>&#35;</th>
    <th>timestamp<a href="#note1"><sup>1</sup></a></th>
    <th>mouse tracking</th>
    <th>details</th>
    <th>XML log</th>
    <?php if ($_POST['admin'] && is_correct($admin)) echo "<th>select logs</th>" ?>
  </tr>
</thead>

<?php 
if (!$_POST['admin'] || !is_correct($admin)) {
?>
<tfoot>
  <tr>
    <td colspan="7">
      <form id="adminform" method="post" action="<?=$_SERVER['SCRIPT_NAME']?>">
        <div>
          <label for="admin">enter <strong>admin</strong> password:</label>
          <input type="password" id="admin" name="admin" size="45" maxlength="80" />
        </div>
      </form>
    </td>
  </tr>
</tfoot>
<?php
} else {
?>
<tfoot>
  <tr>
    <td colspan="8">
      For selected logs: 
      <input type="submit" id="compare"  name="compare"  value="compare" />
      <input type="submit" id="download" name="download" value="download" />
      <input type="submit" id="delete"   name="delete"   value="delete" onclick="return confirmation()" />
    </td>
  </tr>
</tfoot>
<?php
}
?>

<tbody>
<?php
// begin computing table time generation
$time_start = microtime_float();

// loop to write each table row
for ($i=0; $i<$total; $i++) {

  // get date and time from XML log
  $xml_attrib = get_log_filename($xml[$i]);
  $xmlFile    = LOGS_XML."/".$xml[$i];
  // use only XML files, if there were missing HTML logs. Otherwise, use also HTML files
  $htmlName = ($warning) ? get_htmllog_fromxml($xml[$i]) : $html[$i];
  $htmlFile    = LOGS_HTML."/".$htmlName;
  
  // format date
  $date       = $xml_attrib[0];
  $year       = substr($date, 0, 4);
  $month      = substr($date, 4, 2);
  $day        = substr($date, 6, 2);
  
  // format time
  $time       = $xml_attrib[1];
  $hours      = substr($time, 0, 2);
  $minutes    = substr($time, 2, 2);
  $seconds    = substr($time, 4, 2);
  
  // write new row
  $entry  = "<tr>";
  $entry .= "<td>".($i+1)."</td>"; 
  $entry .= "<td>".$year."/".$month."/".$day." ".$hours.":".$minutes.":".$seconds."</td>";
  $entry .= "<td><a href=\"$htmlFile\" title=\"view mouse tracking\">replay</a></td>";
  $entry .= "<td><a href=\"details.php?f=".$xml[$i]."\" title=\"view log details\">view details</a></td>";
  $entry .= "<td><a href=\"".$xmlFile."\" title=\"view XML log file\">view log</a></td>";
  
  if ($_POST['admin'] && is_correct($admin)) 
    $entry .= "<td><input type=\"checkbox\" id=\"log$i\" name=\"log$i\" value=\"".$date."-".$time."\" /></td>";
  $entry .= "</tr>\r\n";
  
  echo $entry;
}

// end computing table time generation
$time_end = microtime_float();
$time     = $time_end - $time_start;
?> 
</tbody>

</table>
<?php 
if ($_POST['admin'] && is_correct($admin)) {
?>
</form>
<?php
}
?>


<p>_____________________________</p>

<?php echo "<p>This table was generated in $time seconds.</p>"; ?>

<p id="note1">
  <sup>1</sup> Format is YYYY/MM/DD HH:MM:SS, where Y is year, M is month, D is day of week, H are hours, M are minutes and S are seconds.
</p>

<noscript>
  <p>
    <strong>It seems that you have JavaScript disabled.</strong>
    <br />
    Please enable your JavaScript console in order to watch users' mouse tracking.
  </p>
</noscript>

</div>

</body>
</html>
