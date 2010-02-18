<?
// --------------------------------------------------------------------------------
// PhpZip Application 1.1 - Configuration file
// --------------------------------------------------------------------------------
// License GNU/GPL - Vincent Blavet - Janvier 2001
// http://www.phpconcept.net & http://phpconcept.free.fr
// --------------------------------------------------------------------------------
//                ***** DO NOT EDIT BY HAND *****
//
// Or do it carefully at your own risks ... ;-)
// --------------------------------------------------------------------------------

  // ----------------------------------------
  // Installation Configuration Variables
  // ----------------------------------------

  // ----- Language directory (without '/' at the end)
  $g_language_dir = "./lang";
  $g_lib_dir = "./lib";
  $g_images_dir = "./images";

  // ----------------------------------------
  // User Configuration Variables
  // ----------------------------------------

  // ----- Default language
  $g_language = "english";

  // ----- Default language
  $g_home_dir = "";

  // ----- Font name
  $g_font_type = "Verdana, Arial, Helvetica, sans-serif";

  // ----- Colors for normal text
  $g_text_bg = "white";
  $g_text_color = "#000000";
  $g_text_link = "blue";
  $g_text_size = 2;

  // ----- Colors for title & footer
  $g_title_bg = "blue";
  $g_title_color = "white";
  $g_title_size = 2;
  $g_footer_size = 1;
  $g_subtitle_size = 2;

  // ----- Error color and background
  $g_error_bg = "red";
  $g_error_color = "white";
  $g_error_size = 2;

  // ---- View
  $g_view_archive = 0;

  // ----- Header and Footer file
  $g_header_file = "include/header.inc.php3";
  $g_footer_file = "include/footer.inc.php3";

  // ---- Trace level
  $g_trace = 0;
  $g_trace_mode = "memory";
  $g_trace_filename = "";

  // ----------------------------------------
  // Specific adaptations
  // ----------------------------------------

  // ----- Add cotes '"' in font name.
  $g_font = "\"".$g_font_type."\"";

?>
