<?
function Unzip($arch,&$fstart,&$lst){
$fstart="";
if (($f=fopen($arch,"r+"))==0) return -1;
$line=fgets($f,1024);
if (substr($line,0,7)!="#PhpZip") return -2;
$prop=explode(":",$line);
$version=$prop[1];
$type=trim($prop[2]);
if ($type=="phpautounzip"){
 while ((!feof($f))&&($type!="phpzip")){
  $line=fgets($f,4096);
  if (substr($line,0,7)=="#PhpZip"){
   unset($prop);
   $prop=explode(":",$line);
   $type=$prop[2];
  }
 }
}
if ($type!="phpzip") return -3;
if ($prop[3]!=""){
 $tk = explode("=",$prop[3]);
 if ($tk[0]=="start")
  $fstart=$tk[1];
}
$i=0;
while (!feof($f)){
 $line=fgets($f,4096);
 if (feof($f)) break;
 $tk=explode(":",$line);
 if ((($fname=$tk[0])=="")||($fname=="/n")) break;
 $size=$tk[1];
 $gz_size=$tk[2];
 $ftype=$tk[3];
 unset($tk);
 $lst[$i++]=$fname;
 if (strrchr($fname,"/"))
  if (!DirCheck(dirname($fname))) return -8;
 if ($ftype=="N"){
  if (($dest_file=fopen($fname,"wb"))==0) return -4;
   $ct=fread($f,$size);
 fwrite($dest_file,$ct,$size);
 unset($ct);
 fclose($dest_file);
 }else{
  if (($gz_file=fopen($fname.".tmp","wb"))==0) return -5;
  $ct = fread($f,$gz_size);
  fwrite($gz_file,$ct,$gz_size);
  unset($ct);
  fclose($gz_file);
  if (($gz_file=gzopen($fname.".tmp","rb"))==0) return -6;
  if (($dest_file=fopen($fname,"wb"))==0) return -4;
  $ct = gzread($gz_file,$size);
  fwrite($dest_file,$ct,$size);
  unset($ct);
  gzclose($gz_file);
  fclose($dest_file);
  unlink($fname.".tmp");
 }
 clearstatcache();
 if (filesize($fname)!=$size) return -7;
 $line=fgets($f,4096);
}
fclose($f);
return 1;
}

function DirCheck($d){
if (is_dir($d)) return 1;
if ((($pd=dirname($d))!="")&&($pd!=$d)&&(!DirCheck($pd))) return 0;
if (!mkdir($d,0777)) return 0;
return 1;}

$c1="#FFFFFF";
$c2="#0000CC";
$s1="{ color: #FFFFFF; font-weight: bold; text-decoration:";
$ft="\"Verdana, Arial, Helvetica, sans-serif\"";
function he($n1,$sf="") {
global $c1,$c2,$ft,$s1;
echo "<HTML><head>";
echo "<style type=text/css><!--";
echo "A.p:link $s1 none }";
echo "A.p:visited $s1 none }";
echo "A.p:hover $s1 underline }";
echo "//--></style>";
echo "<title>PhpZip 1.1 - Unzip $n1</title>";
if ($sf!="") echo "<meta http-equiv=refresh content=\"1;url=$sf\">";
echo "</head><body bgcolor=$c1 link=$c2 vlink=$c2 alink=$c2>";
echo "<table width=90% border=1 cellspacing=0 cellpadding=0 bordercolorlight=$c2 bordercolordark=$c2 align=center>";
echo "<tr bgcolor=$c2><td><font face=$ft size=2 color=$c1><b>PhpZip 1.1 - </b>Unzip $n1</font></td></tr>";
}
function foo() {
global $c1,$c2,$ft;
echo "<tr bgcolor=$c2>";
echo "<td><div align=right><font face=$ft size=1 color=$c1>by <i><b><a class=p href=http://www.phpconcept.net>PhpConcept</a></font></i></b></div></td>";
echo "</tr></table></HTML>";
}

if (!($n=strrchr($REDIRECT_URL,"/")))
$n=$REDIRECT_URL;
else
$n=substr($n,1);

if (!isset($a)) $a=1;
if ($a==1)
{
he($n);
echo "<tr><td><p><br><div align=center><font face=$ft size=2 color=$c2>Lancer la décompression de $n ?</font></div></p>";
echo "<p><div align=center><font face=$ft size=2 color=$c2><a href=".basename($REDIRECT_URL)."?a=2>Lancer</a></font></div></p></td></tr>";
foo();
}
else if ($a=2)
{
$r=Unzip($n, $sf, $lst);
if ($r!=1){
he($n);
echo "<tr><td>";
echo "<p><div align=center><font face=$ft size=2 color=$c2>PhpUnzip Erreur [$r] lors unzip de \"".$lst[count($lst)-1]."\"</font></div></p>";
echo "</td></tr>";
foo();
}else{
he($n,$sf);
echo "<tr><td><p><br>";
for ($i=0;$i<sizeof($lst);$i++) echo "<div align=center><font face=$ft size=2 color=$c2>$lst[$i]</font></div>";
echo "</p><p><div align=center><font face=$ft size=2 color=$c2>PhpUnzip OK</font></div></p>";
if ($sf!="") echo "<p><div align=center><font face=$ft size=2 color=$c2>Lancement de <a href=$sf>$sf</a> en cours ...</font></div></p>";
echo "</td></tr>";
foo();
}
}
exit;
?>