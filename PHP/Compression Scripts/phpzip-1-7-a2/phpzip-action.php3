<?
// --------------------------------------------------------------------------------
// PhpZip Application 1.7
// --------------------------------------------------------------------------------
// License GNU/GPL - Vincent Blavet - December 2001
// http://www.phpconcept.net
// --------------------------------------------------------------------------------
// CVS : $Id: phpzip-action.php3,v 0.0 2001/11/29 22:03:43 vblavet Exp $
// --------------------------------------------------------------------------------


  // --------------------------------------------------------------------------------
  // Function : AppPhpzipHeader()
  // Description :
  //
  // --------------------------------------------------------------------------------
  function AppPhpzipActionHeader($p_archive, $p_title="")
  {
    global $a_action, $PATH_TRANSLATED;
    global $g_phpzip_app_version;
    $v_result = 1;
    global $g_config_file; include ($g_config_file);

    TrFctStart(__FILE__, __LINE__, "AppPhpzipActionHeader", $p_archive);

    // ----- Look for empty
    if ($p_archive == "")
      $p_archive_name = Translate("Aucune archive");
    else
      $p_archive_name = $p_archive;

    // ----- Compose help extension
    if ($a_action == "")
      $v_help_ext = "start";
    else
      $v_help_ext = $a_action;

    // ----- Recuperate the current script name.
    $v_url = basename($PATH_TRANSLATED);

    // ----- Compose the title
    $v_title = "PhpZip $g_phpzip_app_version - $p_archive_name - PHP3 Archiveur";

    // ----- Select the image
    if ($p_archive == "")
      $v_image = $g_images_dir."/file-piz-16.gif";
    else if (($v_archive_type = AppPhpzipArchiveType($p_archive)) == "phpzip")
      $v_image = $g_images_dir."/file-piz-16.gif";
    else if ($v_archive_type = "tar")
      $v_image = $g_images_dir."/file-tar-16.gif";
    else if ($v_archive_type = "tgz")
      $v_image = $g_images_dir."/file-zip-16.gif";
    else
      $v_image = $g_images_dir."/file-piz-16.gif";

    // ----- HTML Header
    echo "<HTML><head>";
    echo "<title>$v_title</title>";

    echo "</head>";
    echo "<body LEFTMARGIN=0 TOPMARGIN=0 bgcolor=$g_text_bg link=$g_text_bg vlink=$g_text_bg alink=$g_text_bg>";

    // ----- Start of PhpZip table
    echo "<table width=100% height=400 border=1 cellspacing=0 cellpadding=0 bordercolorlight=$g_title_bg bordercolordark=$g_title_bg align=center>";
    echo "  <tr bgcolor=$g_title_bg height=20>";
    echo "  <td align=center>";
    echo "    <font face=$g_font size=$g_title_size color=$g_title_color><b>$p_title</b></font>";
    echo "  </td>";
    echo "  </tr>";
    echo "  <tr bgcolor=$g_text_bg >";
    echo "    <td  valign=top>";

    // ----- Return
    TrFctEnd(__FILE__, __LINE__, $v_result);
    return $v_result;
  }
  // --------------------------------------------------------------------------------

  // --------------------------------------------------------------------------------
  // Function : AppPhpzipActionFooter()
  // Description :
  //
  // --------------------------------------------------------------------------------
  function AppPhpzipActionFooter($p_message)
  {
    $v_result = 1;
    global $g_config_file; include ($g_config_file);

    TrFctStart(__FILE__, __LINE__, "AppPhpzipActionFooter", $p_message);

    // ----- Look for empty message
    if ($p_message == "")
      $p_message = "&nbsp;";

    // ----- Include the PhpZip Footer
    echo "</td></tr>";
    echo "<tr height=10><td><table width=100% height=10 border=1 cellspacing=0 cellpadding=0 bordercolorlight=$g_title_bg bordercolordark=$g_title_bg align=center>";
    echo "<tr bgcolor=$g_title_bg>";
    echo "<td><div align=left><font face=$g_font size=$g_footer_size color=$g_title_color>$p_message</font></div></td>";
    echo "<td><div align=right><font face=$g_font size=$g_footer_size color=$g_title_color>by <i><b><a class=foot href=http://www.phpconcept.net>PhpConcept</a></font></i></b></div></td>";
    echo "</tr></table>";
    echo "</tr></table>";

    echo "</BODY></HTML>";

    // ----- Return
    TrFctEnd(__FILE__, __LINE__, $v_result);
    return $v_result;
  }
  // --------------------------------------------------------------------------------

  // ----- End of file
?>