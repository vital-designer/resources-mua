<?
// --------------------------------------------------------------------------------
// PhpConcept Script - Explorer
// --------------------------------------------------------------------------------
// License GNU/GPL - Vincent Blavet - July 2001
// http://www.phpconcept.net
// --------------------------------------------------------------------------------
// Overview :
//   PcsExplorer is a Javascript/PHP script that compose a file or directory
//   selection window.
//
// Description :
//   PcsExplorer is composed of a Javascript file 'pcsexplorer.js', a PHP file
//   'pcsexplorer.php3' and a folder 'images'.
//   The PHP calling script must include the javascript file, and call PcsExplorer
//   like this (sample) :
//     <script language="javascript" src="pcsexplorer.js"></script>
//     <FORM  name="formulaire" method="POST">
//     File : <INPUT TYPE="TEXT" size=50 name="file"><br>
//     <INPUT TYPE="button" name="brows_button" value="Browse" onClick='PcjsOpenExplorer("path/pcsexplorer.php3", "forms.formulaire.file.value", "type=file", "calling_dir=>? echo dirname($PATH_INFO); ?<", "start_dir=../..")'>
//     </FORM>
//   The arguments took by PcjsOpenExplorer() are described in pcsexplorer.js file.
//
// Arguments for the PcsExplorer.php3 file :
//   The following arguments are passed to the PHP script :
//   - Arguments coming from the calling script (and updated by PcsExplorer)
//     $a_calling_dir : Calling script path to web site root. This the absolute path
//                      recuperated from the $PATH_INFO.
//     $a_start_dir : Relative path from the calling script of the starting directory
//                    for exploration.
//     $a_type : 'file' or 'dir'
//     $a_target : The javascript component where the result will be set before
//                 closing the window.
//
//   - Arguments added by PcsExplorer while navigating
//     $a_home_dir : PcsExplorer Script absolute path recuperated from the $PATH_INFO.
//     $a_dir : The 'clicked' directory that need to be opened/displayed.
//
// --------------------------------------------------------------------------------
// CVS : $Id: pcsexplorer.php3,v 1.0 2001/12/27 15:49:14 vblavet Exp $
// --------------------------------------------------------------------------------

// ----- Look for double include
if (!defined("PCSEXPLORER"))
{
  define( "PCSEXPLORER", 1 );

  // ----- Application description
  $g_pcsexplorer_name = "PcsExplorer";
  $g_pcsexplorer_version = "0.2-alpha";
  $g_script_dir = dirname($PATH_INFO);

  // ----- Trace initialisation
  // 0 means no trace, 5 means full trace
  include("lib/pcltrace.lib.php3");
  $g_trace = 0;
  $g_trace_mode = "memory";
  $g_trace_filename = "";
  TrOn($g_trace, $g_trace_mode, $g_trace_filename);

  // ----- Look for default value
  if (!isset($a_type))
    $a_type = "file";

  // ----- Look for default value
  if (!isset($a_home_dir))
    $a_home_dir = ".";

  // ----- Look for default value
  if (!isset($a_calling_dir))
    $a_calling_dir = ".";

  // ----- Check that a target is defined
  if ((!isset($a_target)) || ($a_target == ""))
  {
    // ----- Abort message
?>
<script language="javascript" type="text/javascript">
<!--
alert("A javascript target must be set !");
window.close();
// -->
</script>
<?
    // ----- Abort the script
    die("PcsExplorer Error !");
    exit;
  }

  // --------------------------------------------------------------------------------
  // Function : PcsExplorerStart()
  // Description :
  // Parameters :
  // Return Values :
  // --------------------------------------------------------------------------------
  function PcsExplorerStart()
  {
    TrFctStart(__FILE__, __LINE__, "PcsExplorerStart", "");
    $v_result = 1;
    global $a_calling_dir;
    global $a_start_dir;
    global $a_home_dir;
    global $g_script_dir;

    // ----- Calculate the absolute start path ($PATH_INFO as 'root' reference)
    //       The absolute start path is composed by the absolute path of the
    //       calling script + the relative start path from that calling script.
    //       The result is reduced.
    $v_abs_start_path = PcsExplorerPathReduction($a_calling_dir."/".$a_start_dir);

    TrFctMessage(__FILE__, __LINE__, 2, "Absolute calling path='$a_calling_dir'");
    TrFctMessage(__FILE__, __LINE__, 2, "Relative start path='$a_start_dir'");
    TrFctMessage(__FILE__, __LINE__, 2, "Absolute start path='$v_abs_start_path'");

    // ----- Calculate the relative start path for PcsExplorer
    //       The relative path of the start path is needed to navigate
    //       from the PcsExplorer script.
    $a_home_dir = PcsExplorerPathRelative($g_script_dir, $v_abs_start_path);

    TrFctMessage(__FILE__, __LINE__, 2, "Home directory='$a_home_dir'");

    // ----- Call the explorer
    $v_result = PcsExplorer($a_home_dir);

    // ----- Return
    TrFctEnd(__FILE__, __LINE__, $v_result);
    return $v_result;
  }
  // --------------------------------------------------------------------------------


  // --------------------------------------------------------------------------------
  // Function : PcsExplorer()
  // Description :
  // Parameters :
  // Return Values :
  // --------------------------------------------------------------------------------
  function PcsExplorer($p_dir="")
  {
    TrFctStart(__FILE__, __LINE__, "PcsExplorer", "dir='$p_dir'");
    $v_result = 1;
    $v_dir_new = 0;
    global $a_target;
    global $a_type;
    global $g_pcsexplorer_name;
    global $g_pcsexplorer_version;
    global $a_home_dir;
    global $a_calling_dir;
    global $g_script_dir;
    global $a_target_argument_name;
    global $a_filter_extension;

    global $a_target_type;

    // ----- Calculate the absolute start path ($PATH_INFO as 'root' reference)
    $v_abs_dir = PcsExplorerPathReduction($g_script_dir."/".$p_dir);

    // ----- Calculate the relative start path the calling script
    $v_relative_dir = PcsExplorerPathRelative($a_calling_dir, $v_abs_dir."/");

?>
<HTML>
<title><? echo $g_pcsexplorer_name." - ".$p_dir; ?></title>

<script language="javascript" type="text/javascript">
<!--
function PcjsExplorerSelect(p_value)
{
  pceformulaire.a_dir.value = p_value;
}
function PcjsExplorerOpendir(p_value)
{
  document.all["message"].style.visibility="visible";
  pceformulaire.a_dir.value = p_value;
  pceformulaire.submit();
}
function PcjsExplorerSelectDir()
{
<?
  if ($a_target_type == 'opener')
  {
?>
    // ----- Compose the 'virtual post' in order to give the action parameters to pcsexplorer PHP code
    window.opener.document.write('<FORM  name="pcjsexplorerformulaire" method="POST" action="<? echo $a_target; ?>">');
    window.opener.document.write('<input type="hidden" name="<? echo (isset($a_target_argument_name)?$a_target_argument_name:"a_selection"); ?>" value="<? echo $v_relative_dir; ?>'+pceformulaire.a_dir.value+'">');
    window.opener.document.write('</FORM>');
    window.opener.document.forms.pcjsexplorerformulaire.submit();

    // ----- Give focus to window
    window.opener.focus();
    window.close();
<?
  }

  // ----- Put the result directly in the text field
  else // if ($a_target_type == 'input_text')
  {
?>
    window.opener.document.<? echo $a_target; ?> = "<? echo $v_relative_dir; ?>"+pceformulaire.a_dir.value;
    window.close();
<?
  }
?>
}
function PcjsExplorerClose()
{
  window.close();
}
// -->
</script>

<body bgcolor="#FFFFFF" text="#0000CC" link="#993300" vlink="#FF0000">

<p align="center"><font face="Verdana, Arial, Helvetica, sans-serif"><b><font size="3">
  Web Explorer </font></b></font></p>

<form name="pceformulaire" method="post" action="?">
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
<div id="message" style="position:absolute; width:200px; height:20px; z-index:2; visibility:hidden; overflow: auto; left: 70px; top: 140px; background-color: #0000CC; layer-background-color: #0000CC; border: 1px none #000000">
<p align=center>
<font face='Verdana, Arial, Helvetica, sans-serif' size=3 color=white>
<b><blink>
Loading ...
</b></blink>
</font>
</p>
</div>

<div id="Layer1" style="position:absolute; width:300px; height:200px; z-index:1; overflow: auto; left: 20px; top: 50px; background-color: #CCCCCC; layer-background-color: #CCCCCC; border: 1px none #000000">


<?

    // ----- Look for empty directory
    if ($p_dir == "")
    {
      $p_dir = ".";

      // ----- Flag to indicate that the directory was not set
      $v_dir_new = 1;
    }

    // ----- File / directory table
    echo "<table border=0 cellspacing=0 cellpadding=0 width=100%>";
    echo "<tr bgcolor=#0000CC>";
    echo "<td width=10></td>";
    //echo "<td></td>";
    echo "<td colspan=2><div><font face='Verdana, Arial, Helvetica, sans-serif' size=3 color=white>Folder</font></div></td>";
    echo "<td><div><font face='Verdana, Arial, Helvetica, sans-serif' size=3 color=white>Size</font></div></td>";
    echo "<td width=10></td></tr>";

    // ----- Scan the current directory
    $v_hdir = opendir($p_dir);
    $v_file = readdir($v_hdir); // '.' directory

    // ----- Look for each entry in the directory
    for ($i=0; $v_file = readdir($v_hdir); $i++)
    {
      // ----- Look for parent directory
      if ($v_file == "..")
      {
        TrFctMessage(__FILE__, __LINE__, 4, "Parent directory");

        // ----- Look for first parent
        if (($p_dir == "..") || ((substr($p_dir, 0,2) == "..") && (substr($p_dir, -2) == "..")))
        {
          TrFctMessage(__FILE__, __LINE__, 4, "First parent found");
          $v_file_full = "../".$p_dir;
        }
        // ----- Look for the current dir
        else if ($p_dir == ".")
        {
          TrFctMessage(__FILE__, __LINE__, 4, "Current dir found");
          $v_file_full = "..";
        }
        // ----- Look for other path
        else
        {
          TrFctMessage(__FILE__, __LINE__, 4, "Remove last part of the path '$p_dir'");

          // ----- Remove the last part of the path
          $temp = strrchr($p_dir, "/");
          $v_file_full = substr($p_dir, 0, strlen($p_dir)-strlen($temp));
          unset($temp);
        }

        TrFctMessage(__FILE__, __LINE__, 4, "Calculated path for parent is : '$v_file_full'");

        // ----- Look if the file is a file parent directory (indirect check of open_basedir restriction)
        if ($v_test_hdir = @opendir($v_file_full))
        {
          TrFctMessage(__FILE__, __LINE__, 4, "'$v_file_full' can be opened");

          // ----- Close the temporary handle
          closedir($v_test_hdir);

          // ----- Display the name in the table without checkbox
          echo "<tr><td width=10></td>";
          //echo "<td></td>";
          echo "<td colspan=2><font face='Verdana, Arial, Helvetica, sans-serif' size=2><A ";
          if ($a_type=="dir")
            //echo "onClick='PcjsExplorerSelect(\"$v_file_full\");' ";
            echo "onClick='PcjsExplorerSelect(\"$v_file\");' ";
          echo "onDblClick='PcjsExplorerOpendir(\"$v_file_full\");'><img src='images/folder02-16.gif' border='0' hspace='0' vspace='0'> [Parent folder]</A></td><td></td>";
          echo "<td></td></font></tr>";
        }
        else
        {
          TrFctMessage(__FILE__, __LINE__, 4, "'$v_file_full' can not be opened");

          // ----- Display the name in the table without checkbox
          echo "<tr bgcolor=$g_text_bg><td width=10></td>";
          //echo "<td></td>";
          echo "<td colspan=2><font face='Verdana, Arial, Helvetica, sans-serif' size=2><img src='images/folder02-16.gif' border='0' hspace='0' vspace='0'> [No parent folder]</td><td></td><td></td>";
          echo "</font></tr>";
        }
      }

      // ----- Look for normal file or directory
      else
      {
        // ----- Compose the full name
        $v_file_full = $p_dir."/".$v_file;

        TrFctMessage(__FILE__, __LINE__, 4, "Calculated full path is : '$v_file_full'");

        // ----- Look for directory
        if (is_dir($v_file_full))
        {
          TrFctMessage(__FILE__, __LINE__, 4, "'$v_file_full' is a directory");

          // ----- Display
          echo "<tr><td width=10></td>";

          if (is_readable($v_file_full))
          {
            TrFctMessage(__FILE__, __LINE__, 4, "is readable");

            echo "<td width=10></td>";
            echo "<td><font face='Verdana, Arial, Helvetica, sans-serif' size=2>";
            echo "<A ";
            if ($a_type == "dir")
              //echo "onClick='PcjsExplorerSelect(\"$v_file_full\");' ";
              echo "onClick='PcjsExplorerSelect(\"$v_file\");' ";
            echo "onDblClick='PcjsExplorerOpendir(\"$v_file_full\");'";
            echo "><img src='images/folder01-16.gif' border='0' hspace='0' vspace='0'> $v_file</A></font></td>";
            echo "<td>-</td><td></td>";
          }
          else
          {
            TrFctMessage(__FILE__, __LINE__, 4, "is not readable");

            echo "<td width=10></td>";
            echo "<td><font face='Verdana, Arial, Helvetica, sans-serif' size=2><img src='images/folder01-16.gif' border='0' hspace='0' vspace='0'>$v_file</font></td>";
            echo "<td>-</td><td></td>";
          }
          echo "</tr>";
        }

        // ----- Look for files
        else if ($a_type == "file")
        {
          TrFctMessage(__FILE__, __LINE__, 4, "'$v_file_full' is a file");

          $v_display = 1;

          if ($a_filter_extension != "")
          {
            TrFctMessage(__FILE__, __LINE__, 3, "look for extensions");

            // ----- Get the file extension
            $v_extension = substr(strrchr($v_file_full, '.'), 1);

            // ----- Look if in the list of filtered extensions
            $v_item = explode(' ', $a_filter_extension);
            for ($i=0, $v_display=0; $i<sizeof($v_item) && !$v_display; $i++)
            {
              if ($v_item[$i] == $v_extension)
              {
                $v_display=1;
              }
            }
          }

          // ----- Display only if respect filters
          if ($v_display)
          {
          // ----- Display
          echo "<tr><td width=10></td>";

          // ----- Select icon depending on file extension
          $v_icon = PcsExplorerImageFromExtension($v_file_full);

          if (is_readable($v_file_full))
          {
            TrFctMessage(__FILE__, __LINE__, 4, "is readable");
            echo "<td width=10></td>";
          }
          else
          {
            TrFctMessage(__FILE__, __LINE__, 4, "is not readable");
            echo "<td width=10></td>";
          }
          echo "<td><font face='Verdana, Arial, Helvetica, sans-serif' size=2><A onClick='PcjsExplorerSelect(\"$v_file\");' onDblClick='PcjsExplorerSelectDir();'><img src='images/$v_icon' border='0' hspace='0' vspace='0'> $v_file</a></font></td>";
          echo "<td>".filesize($v_file_full)."</td><td></td>";
          echo "</tr>";
          }
        }
      }

?>

<?
    }

    echo "</table>";

    // ----- Close the directory handle
    closedir($v_hdir);

?>
</div>

<table width=100% border=0  cellspacing=0 cellpadding=0>
<tr>
<td width=20></td>
<td>
<font face="Verdana, Arial, Helvetica, sans-serif" size=2>
<? echo ($a_type=="file"?"File":"Directory")." :"; ?>
<INPUT TYPE="TEXT"  name="a_dir" value="<? /*echo $p_dir;*/ ?>" align="middle" size="30" maxlength="255"   title="Selected directory">
</font>
</td>
<td width=20></td>
</tr>
</table>

<p align=center>
<INPUT TYPE="SUBMIT" value="Select" onclick="PcjsExplorerSelectDir(); return false;"> <INPUT TYPE="SUBMIT" value="Cancel"  onclick="PcjsExplorerClose(); return false;">
</p>

  <input type=hidden name=a_action value=explorer>
  <input type=hidden name=a_target value="<? echo $a_target; ?>">
  <input type=hidden name=a_type value="<? echo $a_type; ?>">
  <input type=hidden name=a_home_dir value="<? echo $a_home_dir; ?>">
  <input type=hidden name=a_calling_dir value="<? echo $a_calling_dir; ?>">
  <input type=hidden name=a_target_type value="<? echo $a_target_type; ?>">
  <input type=hidden name=a_target_argument_name value="<? echo $a_target_argument_name; ?>">
  <input type=hidden name=a_filter_extension value="<? echo $a_filter_extension; ?>">

</form>
<p align=right><font face="Verdana, Arial, Helvetica, sans-serif" size=1>
Powered by <a href="http://www.phpconcept.net" target=_blank><? echo $g_pcsexplorer_name." ".$g_pcsexplorer_version; ?></a>
</font></p>

</HTML>

<?

    // ----- Return
    TrFctEnd(__FILE__, __LINE__, $v_result);
    return $v_result;
  }
  // --------------------------------------------------------------------------------

  // --------------------------------------------------------------------------------
  // Function : PcsExplorerPathReduction()
  // Description :
  // Parameters :
  // Return Values :
  // --------------------------------------------------------------------------------
  function PcsExplorerPathReduction($p_dir)
  {
    TrFctStart(__FILE__, __LINE__, "PcsExplorerPathReduction", "dir='$p_dir'");
    $v_result = "";

    // ----- Look for not empty path
    if ($p_dir != "")
    {
      // ----- Explode path by directory names
      $v_list = explode("/", $p_dir);
      $v_path = array();

      // ----- Study directories from last to first
      for ($i=0, $j=0; $i<sizeof($v_list); $i++)
      {
        TrFctMessage(__FILE__, __LINE__, 4, "Looking for path i=$i '".$v_list[$i]."', j=$j");

        // ----- Look for current path
        if (($v_list[$i] == ".") && ($i != 0))
        {
          // ----- Ignore this directory only if not the first
        }
        else if ($v_list[$i] == "..")
        {
          // ----- Ignore the last entry in the path (if at least one entry)
          $j = ($j>0?$j-1:0);
          TrFctMessage(__FILE__, __LINE__, 4, ".. found j=$j");
        }
        else if (($v_list[$i] == "") && ($i!=(sizeof($v_list)-1)) && ($i!=0))
        {
          // ----- Ignore only the double '//' in path,
          // but not the first and last '/'
        }
        else
        {
          TrFctMessage(__FILE__, __LINE__, 4, "Set j=$j to '".$v_list[$i]."'");
          $v_path[$j++] = $v_list[$i];
        }
      }
    }

    // ----- Compose the full path
    if ($j>0)
    {
      $v_result = $v_path[0];
      for ($i=1; $i<$j; $i++)
        $v_result = $v_result."/".$v_path[$i];
    }
    else
      $v_result = "";

    // ----- Return
    TrFctEnd(__FILE__, __LINE__, $v_result);
    return $v_result;
  }
  // --------------------------------------------------------------------------------

  // --------------------------------------------------------------------------------
  // Function : PcsExplorerPathRelative()
  // Description :
  // Parameters :
  // Return Values :
  // --------------------------------------------------------------------------------
  function PcsExplorerPathRelative($p_from_dir, $p_path)
  {
    TrFctStart(__FILE__, __LINE__, "PcsExplorerPathReduction", "from_dir='$p_from_dir', path='$p_path'");
    $v_result = "";

    // ----- Explode the paths
    $v_from = explode("/", $p_from_dir);
    $v_path = explode("/", $p_path);

    // ----- Look for common part of the path
    $i=0;
    while (($i < sizeof($v_from)) && ($i < sizeof($v_path)) && ($v_from[$i] == $v_path[$i]))
    {
      TrFctMessage(__FILE__, __LINE__, 4, "Same Item $i '".$v_from[$i]."'");
      $i++;
    }

    // ----- Look for path to remove
    for ($j=$i; $j< sizeof($v_from); $j++)
    {
      TrFctMessage(__FILE__, __LINE__, 4, "Remove Item $j '".$v_from[$j]."'");
      if (($v_from[$j] != "") && ($v_from[$j] != "."))
        $v_result = $v_result."../";
    }

    // ----- Look for path to add
    for ($j=$i; $j<sizeof($v_path); $j++)
    {
      TrFctMessage(__FILE__, __LINE__, 4, "Add Item $j '".$v_path[$j]."'");
      if (($v_path[$j] != "") && ($v_path[$j] != "."))
        $v_result = $v_result.$v_path[$j]."/";
    }

    // ----- Return
    TrFctEnd(__FILE__, __LINE__, $v_result);
    return $v_result;
  }
  // --------------------------------------------------------------------------------

  // --------------------------------------------------------------------------------
  // Function : PcsExplorerImageFromExtension()
  // Description :
  //
  // --------------------------------------------------------------------------------
  function PcsExplorerImageFromExtension($p_file)
  {
    $v_image = "file01-16.gif";
    TrFctStart(__FILE__, __LINE__, "PcsExplorerImageFromExtension", "file='$p_file'");

    // ----- Get extension
    $v_extension = substr(strrchr($p_file, '.'), 1);

    // ----- Look for image
    if (is_file("images/file-".$v_extension."-16.gif"))
      $v_image = "file-".$v_extension."-16.gif";

    // ----- Return
    TrFctEnd(__FILE__, __LINE__, $v_image);
    return $v_image;
  }
  // --------------------------------------------------------------------------------

  // --------------------------------------------------------------------------------
  // State Engine
  // --------------------------------------------------------------------------------

  // ----- Trace
  TrMessage(__FILE__, __LINE__, 2, "action='$a_action', type='$a_type'");
  TrMessage(__FILE__, __LINE__, 2, "start_dir='$a_start_dir'");
  TrMessage(__FILE__, __LINE__, 2, "calling_dir='$a_calling_dir', home_dir='$a_home_dir'");

  // ----- Main loop
  switch ($a_action) {
    // ----- Explorer navigation
    case "explorer" :
      PcsExplorer($a_dir);
    break;

    default :
      // ----- Look for optional parameters
      if (isset($a_calling_dir) && isset($a_start_dir))
        PcsExplorerStart();

      // ----- Look for default
      else
        PcsExplorer(".");
  }

  // ----- End of trace
  TrDisplay();

// ----- End of double include check
}
?>