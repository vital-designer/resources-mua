<?
// --------------------------------------------------------------------------------
// PhpZip Library 1.5
// --------------------------------------------------------------------------------
// License GNU/GPL - Vincent Blavet - Mars 2001
// http://www.phpconcept.net & http://phpconcept.free.fr
// --------------------------------------------------------------------------------
// Français :
//   La description de l'usage de la librairie PhpZip 1.5 peut être trouvée en
//   partie dans le fichier readme.txt attachée à la distribution de l'application
//   PhpZip 1.5.
//   Une description plus complète sera disponible quelques jours après la
//   publication sur le site http://www.phpconcept.net
//   Le code est entièrement documenté en anglais.
//
// English :
//   A short user guide of PhpZip library 1.5 can be found in the readme.txt file
//   which is attached to the distribution of the PhpZip 1.5 Application.
//   A more complete description will be available soon on http://www.phpconcept.net
//   The following code is fully documented in english.
//
// --------------------------------------------------------------------------------
//
//   * Avertissement :
//
//   Cette librairie a été créée de façon non professionnelle.
//   Son usage est au risque et péril de celui qui l'utilise, en aucun cas l'auteur
//   de ce code ne pourra être tenu pour responsable des éventuels dégats qu'il pourrait
//   engendrer.
//   Il est entendu cependant que l'auteur a réalisé ce code par plaisir et n'y a
//   caché aucun virus, ni malveillance.
//   Cette libairie est distribuée sous la license GNU/GPL (http://www.gnu.org)
//
//   * Auteur :
//
//   Ce code a été écrit par Vincent Blavet (vincent@blavet.net) sur son temps
//   de loisir.
//
// --------------------------------------------------------------------------------

// ----- Look for double include
if (!defined("PHPZIP_LIB"))
{
  define( "PHPZIP_LIB", 1 );

  // ----- Global variables
  $g_phpzip_tag = "#PhpZip";
  $g_phpzip_version = "1.5";
  $g_phpzip_ext = ".gif,.jpg,.piz";
  $g_phpzip_autounzip = "phpunzip.lib.php3";

  // ----- Include other libraries
  // This library should be called by each script before the include of PhpZip
  // Library in order to limit the potential 'lib' directory path.
  if (!defined("PCLTRACE_LIB"))
  {
    include("pcltrace.lib.php3");
  }

  // --------------------------------------------------------------------------------
  // Function : PhpzipCreate()
  // Description :
  //   This function creates a PHPzip archive file with name ($p_filename).
  //   If a list of files to archive is specified ($p_files) they are added in the
  //   archive in auto-compression mode.
  //   The type of PHPzip archive is set by $p_type, the default is normal archive
  //   with no autounzip function ("phpzip").
  //   A auto-start file may be set by $p_startfile. It must be any kind of URI with
  //   a valid path from the position of the archive.
  // Parameters :
  //   $p_filename : Name of the futur PHPzip archive.
  //   $p_files : List of the filenames to phpzip.
  //   $p_type : Type of PHPzip archive.
  //             "phpzip" : Create a PHPzip archive and add the files found in
  //                        $p_files if any.
  //             "phpautounzip" :Create a PHPzip archive with auto unzip
  //                             capabilities and add the files found in
  //                             $p_files if any.
  //   $p_startfile : A PHP file to start just after the unzip.
  // Return Values :
  //    1 : OK
  //   -1 : Invalid filename.
  //   -2 : Error while opening file in write mode
  //   -3 : Invalid archive type ($p_type) value.
  //   -4 : Error while opening autounzip include file in binary read mode
  //   -5 : Directory does not exists
  //   -6 : Directory is write protected
  // --------------------------------------------------------------------------------
  function PhpzipCreate($p_filename, $p_files=0, $p_startfile="", $p_type = "phpzip")
  {
    global $g_phpzip_version, $g_phpzip_autounzip;
    global $g_phpzip_tag;
    $v_result = 1;

    TrFctStart(__FILE__, __LINE__, "PhpzipCreate", "$p_filename, $p_files, $p_startfile, $p_type");

    // ----- Check the type
    if (($p_type != "phpzip") && ($p_type != "phpautounzip"))
    {
      // ----- Error message
      echo "ERROR : Unknown PHPzip archive type [$p_type]<br>";

      // ----- return error code
      TrFctEnd(__FILE__, __LINE__, -3, "ERROR : Unknown PHPzip archive type [$p_type]");
      return -3;
    }

    // ----- Look for invalid filename
    if ($p_filename == "")
    {
      // ----- Error message
      echo "ERROR : Invalid filename for PHPzip archive [$p_filename]<br>";

      // ----- return error code
      TrFctEnd(__FILE__, __LINE__, -1, "ERROR : Invalid filename for PHPzip archive [$p_filename]");
      return -1;
    }

    // ----- Open the phpzip file
    if (($v_file = @fopen($p_filename, "w")) == 0)
    {
      // TBC echo "ERROR : While write opening PHPzip archive [".$p_filename."]<br>";

      // ----- Set error
      $v_result = -2;
      $v_message = "ERROR : While write opening PHPzip archive [$p_filename]";

      // ----- Look for invalid directory
      if (($v_dir = dirname($p_filename)) != "")
      {
        if (!is_dir($v_dir))
        {
          $v_result = -5;
          $v_message = "ERROR : Directory [$v_dir] does not exists";
        }
        else if (!is_writeable($v_dir))
        {
          $v_result = -6;
          $v_message = "ERROR : Directory [$v_dir] is not writable";
        }
      }

      // ----- Error return code
      TrFctEnd(__FILE__, __LINE__, $v_result, $v_message);
      return $v_result;
    }

    // ----- Trace
    TrFctMessage(__FILE__, __LINE__, 2, "Zip type = ".$p_type);

    // ----- Look for AutoUnZip archive
    if ($p_type == "phpautounzip")
    {
      // ----- Write the first preambule code
      fputs($v_file, $g_phpzip_tag.":".$g_phpzip_version.":".$p_type."\n");

      // ----- Write the auto unzip PHP3 code
      if (($v_engine = @fopen($g_phpzip_autounzip, "rb")) == 0)
      {
        echo "ERROR : While write opening autounzip file [".$g_phpzip_autounzip."]<br>";
        TrFctEnd(__FILE__, __LINE__, -4, "ERROR : While write opening autounzip file [$g_phpzip_autounzip]");
        return -4;
      }

      // ----- Size of the engine file
      $v_size_engine = filesize($g_phpzip_autounzip);

      // ----- Read/Write the file as a block
      $v_content = fread($v_engine, $v_size_engine);
      fwrite($v_file, $v_content, $v_size_engine);
      unset($v_content);

      // ----- Close the file
      fclose($v_engine);

      // ----- Add a new line
      fputs($v_file, "\n");
    }

    // ----- Write the preambule code
    fputs($v_file, $g_phpzip_tag.":".$g_phpzip_version.":phpzip");

    // ----- Write the specific properties
    if ($p_startfile != "")
    {
      // ----- Write the property separated by ':'
      fputs($v_file, ":start=".$p_startfile);
    }

    // ----- Write the end of line
    fputs($v_file, ":\n");

    // ----- Add the files by calling the add handler function
    if (is_array($p_files))
    {
      $v_result = PhpzipHandlerAdd($v_file, $p_files);
    }

    // ----- Close the file
    fclose($v_file);

    // ----- Return
    TrFctEnd(__FILE__, __LINE__, $v_result);
    return $v_result;
  }
  // --------------------------------------------------------------------------------


  // --------------------------------------------------------------------------------
  // Function : IsPhpzipArchive()
  // Description :
  //   This function checks if a file is a PhpZip archive.
  //   To do so the function checks if the name is a valid file name, checks if the
  //   file exists and is a readable file. Then it tries to open it and check
  //   the PhpZip file tag which must be the first bytes in the file.
  // Parameters :
  //   $p_filename : File name of the PHPzip archive.
  // Return Values :
  //   True or False
  // See also :
  //   PhpzipHandlerOpenRead()
  // --------------------------------------------------------------------------------
  function IsPhpzipArchive($p_filename)
  {
    TrFctStart(__FILE__, __LINE__, "IsPhpzipArchive", $p_filename);
    $v_result = FALSE;
    $v_message = "";

    // ----- Check if it is a file
    if (file_exists($p_filename))
    {
      // ----- Check if it is a file and not a directory
      if (is_file($p_filename))
      {
        // ----- Check if the file is readable
        if (is_readable($p_filename))
        {
          // ----- Try to open the file
          if (PhpzipHandlerOpenRead($p_filename, $v_file, $v_temp) == 1)
          {
            // ----- Set valid result
            $v_result = TRUE;

            // ----- Close the file
            fclose($v_file);
          }
          // ----- File is not a valid archive
          else
          {
            $v_message = "File [$p_filename] is not a valid archive file.";
          }

          // ----- Unset variables
          unset($v_file);
          unset($v_temp);
        }
        // ----- File canot be read
        else
        {
          $v_message = "File [$p_filename] can not be read.";
        }
      }
      // ----- Filename is not a file (so a link or directory)
      else
      {
        $v_message = "Filename [$p_filename] is not a valid file name.";
      }
    }
    // ----- File does not exists
    else
    {
      $v_message = "Filename [$p_filename] does not exists";
    }

    // ----- Do the action
    TrFctEnd(__FILE__, __LINE__, $v_result, $v_message);
    return($v_result);
  }
  // --------------------------------------------------------------------------------


  // --------------------------------------------------------------------------------
  // Function : PhpzipAdd()
  // Description :
  //   This function adds a single file ($p_filename) in the PHPzip archive
  //   ($p_phpzip_file).
  //   See PhpzipAddList() for more details.
  // Parameters :
  //   $p_phpzip_file : File name of the PHPzip archive.
  //   $p_filename : Name of the file to add.
  //   $p_mode : Compression mode for the files (see PhpzipAddList())
  // Return Values :
  //   Same as PhpzipAddList()
  // See also :
  //   PhpzipAddList()
  // --------------------------------------------------------------------------------
  function PhpzipAdd($p_phpzip_file, $p_filename, $p_mode="A")
  {
    TrFctStart(__FILE__, __LINE__, "PhpzipAdd", "$p_phpzip_file, $p_filename, $p_mode");

    // ----- Create an array with only one entry
    $v_list[0] = $p_filename;

    // ----- Do the action
    $v_result = PhpzipAddList($p_phpzip_file, $v_list, $p_mode);

    TrFctEnd(__FILE__, __LINE__, $v_result);
    return $v_result;
  }
  // --------------------------------------------------------------------------------

  // --------------------------------------------------------------------------------
  // Function : PhpzipAddDir()
  // Description :
  //   PLEASE DO NOT USE THIS FUNCTION ANY MORE.
  //   This function is now handled directly by PhpzipAdd() or PhpzipAddList().
  //   This function is still present only for compatibility reason with version 1.0.
  // --------------------------------------------------------------------------------
  function PhpzipAddDir($p_phpzip_file, $p_dir, $p_mode="A")
  {
    TrFctStart(__FILE__, __LINE__, "PhpzipAddDir", "$p_phpzip_file, $p_dir, $p_mode");

    // ----- Create an array with only one entry
    $v_list[0] = $p_dir;

    // ----- Do the action
    $v_result = PhpzipAddList($p_phpzip_file, $v_list, $p_mode);

    TrFctEnd(__FILE__, __LINE__, $v_result);
    return $v_result;
  }
  // --------------------------------------------------------------------------------

  // --------------------------------------------------------------------------------
  // Function : PhpzipAddList()
  // Description :
  //   This function adds a list of files ($p_list) in the PHPzip archive
  //   ($p_phpzip_file).
  //   A specific compression method may be specified (see $p_mode bellow), by
  //   default it's auto-compression.
  //   It should be noted that any file which is less than 20 bytes will not be
  //   compressed because the compressed file takes at least 20 bytes, so there is
  //   no gain.
  // Parameters :
  //   $p_phpzip_file : Name of the PHPzip archive.
  //   $p_list : An array containing the files to adds in the archive.
  //   $p_mode : Compression mode for the files :
  //             "N" normal (no compression),
  //             "C" compression,
  //             "A" automatic (means files with extensions defined in $g_phpzip_ext
  //                 will not be compressed) - default
  // Return Values :
  //    1 : OK
  //   -1 : Invalid PHPzip archive filename
  //   -2 : Invalid argument for file list
  //   -3 : Error while opening archive in append mode.
  // See also :
  //   PhpzipHandlerAdd(), PhpzipAdd(), PhpzipAddDir()
  // --------------------------------------------------------------------------------
  function PhpzipAddList($p_phpzip_file, $p_list, $p_mode="A")
  {
    $v_result = 1;

    TrFctStart(__FILE__, __LINE__, "PhpzipAddList", "$p_phpzip_file, $p_list, $p_mode");

    // ----- Check for invalid filename
    if ($p_phpzip_file == "")
    {
      // ----- Error message
      echo "ERROR : Invalid PHPzip archive filename [$p_phpzip_file]<br>";

      // ----- return error code
      TrFctEnd(__FILE__, __LINE__, -1, "Error Invalid PHPzip archive filename [$p_phpzip_file]");
      return -1;
    }

    // ----- Check the arguments
    if (sizeof($p_list) == 0)
    {
      echo "ERROR : Invalid argument for file list to zip<br>";
      TrFctEnd(__FILE__, __LINE__, -2, "ERROR : Invalid argument for file list to zip");
      return -2;
    }

    // ----- Append the phpzip file
    if (($v_file = @fopen($p_phpzip_file, "a")) == 0)
    {
      echo "ERROR : While opening in append mode PHPzip archive [".$p_phpzip_file."]<br>";
      TrFctEnd(__FILE__, __LINE__, -3, "ERROR : While opening in append mode PHPzip archive [".$p_phpzip_file."]");
      return -3;
    }

    // ----- Call the handler function
    $v_result = PhpzipHandlerAdd($v_file, $p_list, $p_mode);

    // ----- Close the file
    fclose($v_file);

    // ----- Return
    TrFctEnd(__FILE__, __LINE__, $v_result);
    return $v_result;
  }
  // --------------------------------------------------------------------------------

  // --------------------------------------------------------------------------------
  // Function : PhpzipUnzip()
  // Description :
  //   See PhpzipUnzipStart()
  // --------------------------------------------------------------------------------
  function PhpzipUnzip($p_phpzip_file, $p_path="./")
  {
    TrFctStart(__FILE__, __LINE__, "PhpzipUnzip", "$p_phpzip_file, $p_path");
    $v_result = PhpzipUnzipStart($p_phpzip_file, $v_temp, $p_path);
    unset($v_temp);
    TrFctEnd(__FILE__, __LINE__, $v_result);
    return $v_result;
  }
  // --------------------------------------------------------------------------------

  // --------------------------------------------------------------------------------
  // Function : PhpzipUnzipListString()
  // Description :
  //   This function extract all the files indicated in the string $p_string_list.
  //   The string must be a valid list of files separated by ':'.
  //   If possible the function PhpzipUnzipList() should be prefered.
  // See also :
  //   PhpzipHandlerUnzip()
  // --------------------------------------------------------------------------------
  function PhpzipUnzipListString($p_phpzip_file, $p_string_list="", $p_path="./")
  {
    // ----- Trace
    TrFctStart(__FILE__, __LINE__, "PhpzipUnzipListString", "$p_phpzip_file, $p_string_list, $p_path");

    // ----- Look for a list of files
    if ($p_string_list != "")
    {
      // ----- Explode the list
      $v_file_list = explode(":", $p_string_list);

      if (IsTrOn())
      {
        for ($i=0; $i<sizeof($v_file_list); $i++)
          TrFctMessage(__FILE__, __LINE__, 4, "v_file_list[$i] = $v_file_list[$i]");
      }
    }

    // ----- Call the generic Unzip function
    //       $v_start_file will be set with info, but we don't care
    //       $v_list_detail will be set with info, but we don't care
    $v_result = PhpzipHandlerUnzipList($p_phpzip_file, $v_start_file, $v_file_list, $v_list_detail, $p_path);

    // ----- Destroy the temporary var
    unset($v_list_detail);
    unset($v_start_file);
    unset($v_file_list);

    // ----- Return status
    TrFctEnd(__FILE__, __LINE__, $v_result);
    return $v_result;
 }
  // --------------------------------------------------------------------------------

  // --------------------------------------------------------------------------------
  // Function : PhpzipUnzipList()
  // Description :
  //   This function extract all the files which names are in $p_file_list in the
  //   directory indicated in $p_path. The directory structure of the file is
  //   maintained. If a $p_path is indicated, the directory structure of the extracted
  //   files is maintained and appended to the $p_path directory.
  //   If the resulting directory is no present it is created.
  // Parameters :
  //   $p_phpzip_file : Filename of the PhpZip archive.
  //   $p_file_list : An array which containts a list of files to extract.
  //   $p_path : A directory where the files are to be extracted. The path of the
  //             files is append to that directory.
  // Return values :
  //   See PhpzipHandlerUnzipList()
  // See also :
  //   PhpzipHandlerUnzip()
  // --------------------------------------------------------------------------------
  function PhpzipUnzipList($p_phpzip_file, $p_file_list, $p_path="./")
  {
    // ----- Trace
    TrFctStart(__FILE__, __LINE__, "PhpzipUnzipList", "$p_phpzip_file, p_file_list(0..".sizeof($p_file_list)."), $p_path");

    // ----- Call the generic Unzip function
    //       $v_start_file will be set with info, but we don't care
    //       $v_list_detail will be set with info, but we don't care
    $v_result = PhpzipHandlerUnzipList($p_phpzip_file, $v_start_file, $p_file_list, $v_list_detail, $p_path);

    // ----- Destroy the temporary var
    unset($v_list_detail);
    unset($v_start_file);

    // ----- Return status
    TrFctEnd(__FILE__, __LINE__, $v_result);
    return $v_result;
 }
  // --------------------------------------------------------------------------------

  // --------------------------------------------------------------------------------
  // Function : PhpzipUnzipStart()
  // Description :
  //   This function unzip the PHPzip archive ($p_phpzip_file) in the directory
  //   specified by ($p_path).
  //   If an auto-start file is defined in the archive, the URI of this file is
  //   given back in the $p_startfile parameter.
  //   Please note that the directory tree structure is normaly maintained relative
  //   to the 'current path'. The $p_path is used to change this 'current path'. It
  //   must be a 'child' directory from the path where the PHP script is running.
  //   If the $p_path or the path of the extracted files does not exist the directory
  //   is created.
  //   If a file already exists with the same name it will be replaced (without
  //   warning).
  // Parameters :
  //   $p_phpzip_file : PHPzip archive filename.
  //   $p_startfile : Return the start filename URI if any ("" elsewhere).
  //   $p_path : Set the directory where the file is to be unziped.
  // Return Values :
  //    see PhpzipHandlerUnzip()
  // See also :
  //   PhpzipHandlerUnzip()
  // --------------------------------------------------------------------------------
  function PhpzipUnzipStart($p_phpzip_file, &$p_startfile, $p_path="./")
  {
    // ----- Trace
    TrFctStart(__FILE__, __LINE__, "PhpzipUnzipStart", "$p_phpzip_file, $p_path");

    // ----- Call the generic Unzip function
    //       $v_file_list is unset, so all the files will be unzipped
    //       $v_list_detail will be set with info, but we don't care
    $v_result = PhpzipHandlerUnzip($p_phpzip_file, $p_startfile, $v_file_list, $v_list_detail, "complete", $p_path);

    // ----- Unset unused
    unset($v_list_detail);
    unset($v_file_list);

    // ----- Return status
    TrFctEnd(__FILE__, __LINE__, $v_result);
    return $v_result;
  }
  // --------------------------------------------------------------------------------

  // --------------------------------------------------------------------------------
  // Function : PhpzipList()
  // Description :
  //   This function reads the PHPzip archive and returns the filenames and
  //   properties.
  //   The first list ($p_list) contains only the filenames (with full path), the
  //   second list ($p_list_detail) contains the files names and properties in the
  //   following format : "filename:size:compressedsize:directory:type",
  //   where 'filename' is the filename with no path, 'directory' the file path and
  //   'type' is 'C' for gzip Compression and 'N' for Normal (No compression).
  // Parameters :
  //   $p_phpzip_file : PHPzip archive filename.
  //   $p_list : List to fill with the full path filenames.
  //   $p_list_detail : List to fill with the details of files.
  // Return Values :
  //    1 : OK
  //   -1 to -5 : See PhpzipHandlerOpenRead()
  // See also :
  //   PhpzipHandlerOpenRead()
  // --------------------------------------------------------------------------------
  function PhpzipList($p_phpzip_file, &$p_list, &$p_list_detail)
  {
    // ----- Trace
    TrFctStart(__FILE__, __LINE__, "PhpzipList", "$p_phpzip_file");

    // ----- Call the generic Unzip function
    //       $v_startfile will be set with info, but we don't care
    //       $v_file_list is unset but will ot be used
    if (($v_result = PhpzipHandlerUnzip($p_phpzip_file, $v_startfile, $v_file_list, $p_list_detail, "list")) == 1)
    {
      // ----- Compose the short listing (for compatibility with version 1.0)
      for ($i=0; $i<sizeof($p_list_detail); $i++)
      {
        // ----- Trace
        TrFctMessage(__FILE__, __LINE__, 3, "p_list_detail[$i] = $p_list_detail[$i]");

        // ----- Explode the line
        $v_token = explode(":", $p_list_detail[$i]);

        // ----- Compose the full name
        if ($v_token[3] != "")
          $p_list[$i] = $v_token[3]."/".$v_token[0];
        else
          $p_list[$i] = $v_token[0];

        // ----- Trace
        TrFctMessage(__FILE__, __LINE__, 3, "p_list[$i] = $p_list[$i]");
      }
    }

    // ----- Unset unused
    unset($v_startfile);

    // ----- Return status
    TrFctEnd(__FILE__, __LINE__, $v_result);
    return $v_result;
  }
  // --------------------------------------------------------------------------------




  // ----- Start of internal functions

  // --------------------------------------------------------------------------------
  // Function : PhpzipHandlerUnzip()
  // Description :
  // Parameters :
  //   $p_phpzip_file : PHPzip archive filename.
  //   $p_startfile : Return the start filename URI if any ("" elsewhere).
  //   $p_mode : Unzipping mode : "complete", "partial" or "list"
  //   $p_path : Set the directory where the file is to be unziped.
  // Return Values :
  //    1 : OK
  //   -1 to -5 :  (see PhpzipHandlerOpenRead())
  //   -6 : Error in unzipped file size
  // See also :
  //   PhpzipHandlerOpenRead(), PhpzipHandlerDirCheck()
  // --------------------------------------------------------------------------------
  function PhpzipHandlerUnzip($p_phpzip_file, &$p_startfile, $p_file_list, &$p_list_detail, $p_mode="complete", $p_path="./")
  {
    $v_result = 1;
    $v_nb = 0;
    $v_unzip_all = TRUE;
    $v_listing = FALSE;

    // ----- Trace
    TrFctStart(__FILE__, __LINE__, "PhpzipHandlerUnzip", "$p_phpzip_file, , p_file_list(0..".sizeof($p_file_list)."), , $p_mode, $p_path");

    // ----- Check the path
    if ($p_path == "")
      $p_path = "./";

    // ----- Study unzipping mode
    switch ($p_mode) {
      case "complete" :
        // ----- Flag unzip of all files
        $v_unzip_all = TRUE;
        $v_listing = FALSE;
      break;
      case "partial" :
          // ----- Flag unzip of specific files
          $v_unzip_all = FALSE;
          $v_listing = FALSE;
      break;
      case "list" :
          // ----- Flag unzip of specific files
          $v_unzip_all = FALSE;
          $v_listing = TRUE;
      break;
      default :
          echo "ERROR : Unknown unzip mode [$p_mode] in PhpzipHandlerUnzip() (file ".__FILE__.", line ".__LINE__.")<br>";
          TrFctEnd(__FILE__, __LINE__, -7, "Unknown unzip mode [$p_mode]");
          return -7;
    }

    // ----- Open the file and read the header, types and properties
    if (($v_result = PhpzipHandlerOpenRead($p_phpzip_file, $v_file, $p_startfile)) != 1)
    {
      TrFctEnd(__FILE__, __LINE__, $v_result);
      return $v_result;
    }

    // ----- Run the Unzip loop
    while (!feof($v_file))
    {
      TrFctMessage(__FILE__, __LINE__, 4, "Position avant nouveau fichier [".ftell($v_file)."]");

      // ----- Read the file name and properties
      $v_line = fgets($v_file, 4096);

      TrFctMessage(__FILE__, __LINE__, 3, "Reading line : [$v_line]");

      // ----- Check for end of file
      if (feof($v_file))
      {
        TrFctMessage(__FILE__, __LINE__, 3, "End of file found");
        break;
      }

      // ----- Extract filename, size (unzipped), size (zipped) and filetype
      $v_token = explode(":", $v_line);
      $v_filename = $v_token[0];
      $v_size = $v_token[1];
      $v_gz_size = $v_token[2];
      $v_filetype = $v_token[3];
      unset($v_token);

      // ----- Look for beginning './' path
      if (substr($v_filename, 0, 2) == './')
        // ----- Remove the beginning current path
        $v_filename = substr($v_filename, 2);

      // ----- Trace
      TrFctMessage(__FILE__, __LINE__, 2, "Unzipping file [$v_filename], size [$v_size], type [$v_filetype]");
      TrFctMessage(__FILE__, __LINE__, 4, "Position après entete [".ftell($v_file)."]");

      // ----- Look for specific files to be unzipped
      if (!$v_unzip_all)
      {
        TrFctMessage(__FILE__, __LINE__, 2, "Look if the file [$v_filename] need to be unzipped");

        // ----- By default no unzip if the file is not found
        $v_unzip_file = FALSE;

        // ----- Look into the file list
        for ($i=0; $i<sizeof($p_file_list); $i++)
        {
          TrFctMessage(__FILE__, __LINE__, 2, "Compare archived file [$v_filename] from asked list file [".$p_file_list[$i]."]");

          // ----- Look if it is a directory
          if (substr($p_file_list[$i], -1) == "/")
          {
            TrFctMessage(__FILE__, __LINE__, 3, "Compare file [$v_filename] with directory [$p_file_list[$i]]");

            // ----- Look if the directory is in the filename path
            if ((strlen($v_filename) > strlen($p_file_list[$i])) && (substr($v_filename, 0, strlen($p_file_list[$i])) == $p_file_list[$i]))
            {
              // ----- The file is in the directory, so unzip it
              TrFctMessage(__FILE__, __LINE__, 2, "File [$v_filename] is in directory [$p_file_list[$i]] : unzip it");
              $v_unzip_file = TRUE;

              // ----- End of loop
              break;
            }
          }

          // ----- It is a file, so compare the file names
          else if ($p_file_list[$i] == $v_filename)
          {
            // ----- File found
            TrFctMessage(__FILE__, __LINE__, 2, "File [$v_filename] should be unzipped");
            $v_unzip_file = TRUE;

            // ----- End of loop
            break;
          }
        }

        // ----- Trace
        if (!$v_unzip_file)
          TrFctMessage(__FILE__, __LINE__, 2, "File [$v_filename] should not be unzipped");
      }
      else
      {
        // ----- All files need to be unzipped
        $v_unzip_file = TRUE;
      }

      // ----- File name and properties are logged if it is a listing mode or the file is unzipped
      if ($v_listing || ($v_unzip_file))
      {

        // ----- Log unzipped files
        if (($v_file_dir = dirname($v_filename)) == $v_filename)
          $v_file_dir = "";
        if ((substr($v_filename, 0, 1) == "/") && ($v_file_dir == ""))
          $v_file_dir = "/";
        $p_list_detail[$v_nb] = basename($v_filename).":".$v_size.":".$v_gz_size.":".$v_file_dir.":".$v_filetype;

        // ----- Increment
        $v_nb++;
      }

      // ----- Look if this file need to be unzipped
      if ($v_unzip_file)
      {
        // ----- Add the path to the file
        if (($p_path != "./") && ($p_path != "/"))
        {
          // ----- Look for the path end '/'
          if (substr($p_path, -1) == "/")
          {
            TrFctMessage(__FILE__, __LINE__, 3, "Destination path [$p_path] ends by '/'");
            $p_path = substr($p_path, 0, strlen($p_path)-1);
            TrFctMessage(__FILE__, __LINE__, 3, "Modified to [$p_path]");
          }

          // ----- Add the path
          if (substr($v_filename, 0, 1) == "/")
          {
            if ($p_path != "/")
              $v_filename = $p_path.$v_filename;
          }
          else
            $v_filename = $p_path."/".$v_filename;
        }

        TrFctMessage(__FILE__, __LINE__, 2, "Unzipping file (with path) [$v_filename], size [$v_size], type [$v_filetype]");

        // ----- Check the directory availability and create it if necessary
        if (($v_result = PhpzipHandlerDirCheck(dirname($v_filename))) != 1)
        {
          TrFctEnd(__FILE__, __LINE__, $v_result);
          return $v_result;
        }

        // ----- Look for unzip mode
        if ($v_filetype == "N")
        {
          $v_result = PhpzipHandlerUnzipNormal($v_file, $v_filename, $v_size);
        }
        else
        {
          $v_result = PhpzipHandlerUnzipCompress($v_file, $v_filename, $v_size, $v_gz_size);
        }

        // ----- Check the file size
        clearstatcache();
        if (filesize($v_filename) != $v_size)
        {
          echo "ERROR : Unzipped file [$v_filename] does not have the correct file size ".filesize($v_filename)." ($v_size expected). PHPunzip file may be corrupted<br>";
          TrFctEnd(__FILE__, __LINE__, -6, "Unzipped file [$v_filename] does not have the correct file size [".filesize($v_filename)."] ([$v_size] expected). PhpZip file may be corrupted");
          return -6;
        }

        // ----- Trace
        TrFctMessage(__FILE__, __LINE__, 2, "PHPUnzip done");
        TrFctMessage(__FILE__, __LINE__, 4, "Position après done [".ftell($v_file)."]");
      }

      // ----- Look for file that is not to be unzipped
      else
      {
        // ----- Trace
        TrFctMessage(__FILE__, __LINE__, 2, "Jump file [$v_file]");
        TrFctMessage(__FILE__, __LINE__, 4, "Position avant jump [".ftell($v_file)."]");

        // ----- Jump to next file
        fseek($v_file, ftell($v_file)+(integer)$v_gz_size);

        TrFctMessage(__FILE__, __LINE__, 4, "Position après jump [".ftell($v_file)."]");
      }

      // ----- Get the new line that should be there for file separation
      $v_line = fgets($v_file, 4096);

      TrFctMessage(__FILE__, __LINE__, 4, "Reading separation line [$v_line]");
    }

    // ----- Close the file
    PhpzipHandlerClose($v_file);

    // ----- Return
    TrFctEnd(__FILE__, __LINE__, $v_result);
    return $v_result;
  }
  // --------------------------------------------------------------------------------

  // --------------------------------------------------------------------------------
  // Function : PhpzipHandlerUnzipNormal()
  // Description :
  //   PHPunzip the file $p_filename which was PHPzipped with no compression.
  //   This function just extract the $p_size bytes from the archive to the
  //   destination file $p_filename.
  //   Note that the $p_file id a file handler. The current position must be at
  //   the right place.
  //   Please do not use this function directly.
  // Parameters :
  //   $p_file : File handler of the PHPzip archive
  //   $p_filename : File name of the file to unzip in normal mode.
  //   $p_size : Size of the file to unzip.
  // Return Values :
  //    1 : OK
  //   -1 : Unable to open the destination file in binary write mode.
  //   -4 : A write protected file with this name already exists or is a directory.
  // See also :
  //   PhpzipHandlerUnzipCompress()
  // --------------------------------------------------------------------------------
  function PhpzipHandlerUnzipNormal($p_file, $p_filename, $p_size)
  {
    // ----- Trace
    TrFctStart(__FILE__, __LINE__, "PhpzipHandlerUnzipNormal", "$p_file, $p_filename, $p_size");

    // ----- Check that the file does not exists
    if ((file_exists($p_filename)) && (is_dir($p_filename) || (!is_writeable($p_filename))))
    {
      TrFctEnd(__FILE__, __LINE__, -2, "[$p_filename] already exists and is write protected or is directory");
      return -4;
    }

    // ----- Open the destination file in write mode
    if (($v_dest_file = @fopen($p_filename, "wb")) == 0)
    {
      // TBC echo "ERROR : Unable to open in write mode file [$p_filename]<br>";
      TrFctEnd(__FILE__, __LINE__, -1, "Unable to open [$p_filename] in write mode");
      return -1;
    }

    // ----- Read/Write as a block
    $v_content = fread($p_file, $p_size);
    fwrite($v_dest_file, $v_content, $p_size);
    unset($v_content);

    // ----- Close the temp file
    fclose($v_dest_file);

    // ----- Return
    TrFctEnd(__FILE__, __LINE__, 1);
    return 1;
  }
  // --------------------------------------------------------------------------------

  // --------------------------------------------------------------------------------
  // Function : PhpzipHandlerUnzipCompress()
  // Description :
  //   PHPunzip the file $p_filename which was PHPzipped with gzip compression.
  //   The function extract the $p_gz_size bytes of the compressed file in a
  //   temporary file. It then uncompress the gzip file and remove the temporary file.
  //   Please do not use this function directly.
  // Parameters :
  //   $p_file : File handler of the PHPzip archive
  //   $p_filename : File name of the file to unzip.
  //   $p_size : Size of the file to unzip.
  //   $p_gz_size : Size of the compressed file.
  // Return Values :
  //    1 : OK
  //   -1 : Unable to open the temporary file in write mode.
  //   -2 : Unable to open the temporary file in read mode.
  //   -3 : Unable to open the destination file in write mode.
  //   -4 : A write protected file with this name already exists or is a directory.
  // See also :
  //   PhpzipHandlerUnzipNormal()
  // --------------------------------------------------------------------------------
  function PhpzipHandlerUnzipCompress($p_file, $p_filename, $p_size, $p_gz_size)
  {
    // ----- Trace
    TrFctStart(__FILE__, __LINE__, "PhpzipHandlerUnzipCompress", "$p_file, $p_filename, $p_size, $p_gz_size");

    // ----- Check that the file does not exists
    if ((file_exists($p_filename)) && (is_dir($p_filename) || (!is_writeable($p_filename))))
    {
      TrFctEnd(__FILE__, __LINE__, -4, "[$p_filename] already exists and is write protected or is directory");
      return -4;
    }

    // ----- Write a temporary gz file
    if (($v_gz_file = @fopen($p_filename.".tmp", "wb")) == 0)
    {
      echo "ERROR : Unable to open in write mode file [$p_filename.tmp]<br>";
      TrFctEnd(__FILE__, __LINE__, -1, "Unable to open in write mode file [$p_filename.tmp]");
      return -1;
    }

    // ----- Trace
    TrFctMessage(__FILE__, __LINE__, 3, "Open temporary gz file : OK");

    // ----- Read/Write as a block
    $v_content = fread($p_file, $p_gz_size);
    fwrite($v_gz_file, $v_content, $p_gz_size);
    unset($v_content);

    // ----- Trace
    TrFctMessage(__FILE__, __LINE__, 3, "Copy of file to temporary gz file : OK");
    TrFctMessage(__FILE__, __LINE__, 4, "Position après lecture/ecriture ds fichier temp [".ftell($p_file)."]");

    // ----- Close the temp gz file
    fclose($v_gz_file);

    // ----- Open the destination file
    if (($v_dest_file = @fopen($p_filename, "wb")) == 0)
    {
      echo "ERROR : Unable to open in write mode file [$p_filename]<br>";
      TrFctEnd(__FILE__, __LINE__, -3, "Unable to open in write mode file [$p_filename]");
      return -3;
    }

    // ----- Open the gz file
    if (($v_gz_file = @gzopen($p_filename.".tmp", "rb")) == 0)
    {
      // ----- Close and unlink the file
      fclose($v_dest_file);
      @unlink($p_filename);

      // ----- Return error
      // echo "ERROR : Unable to open in read mode file [$p_filename.tmp]<br>";
      TrFctEnd(__FILE__, __LINE__, -2, "Unable to open in read mode file [$p_filename.tmp]");
      return -2;
    }

    // ----- Trace
    TrFctMessage(__FILE__, __LINE__, 3, "Size of [$p_filename] = ".filesize($p_filename));

    // ----- Read/Write the file
    $v_content = gzread($v_gz_file, $p_size);
    fwrite($v_dest_file, $v_content, $p_size);
    unset($v_content);

    // ----- Close the files
    gzclose($v_gz_file);
    fclose($v_dest_file);

    TrFctMessage(__FILE__, __LINE__, 3, "Uncompressing temporary gz file : OK");

    // ----- Destroy the temporary files
    @unlink($p_filename.".tmp");

    // ----- Return
    TrFctEnd(__FILE__, __LINE__, 1);
    return 1;
  }
  // --------------------------------------------------------------------------------

  // --------------------------------------------------------------------------------
  // Function : PhpzipHandlerUnzipList()
  // Description :
  //   This function should be removed and directly replaced by PhpzipHandlerUnzip()
  // See also :
  //   PhpzipHandlerUnzip()
  // --------------------------------------------------------------------------------
  function PhpzipHandlerUnzipList($p_phpzip_file, &$p_start_file, $p_file_list, &$p_list_detail, $p_path="./")
  {
    // ----- Trace
    TrFctStart(__FILE__, __LINE__, "PhpzipHandlerUnzipList", "$p_phpzip_file, , p_file_list(0..".sizeof($p_file_list)."), , $p_path");

    // ----- Sort the files and look for duplicates or imbedded files in directories
    // TBC To Be Completed :
    // The sort does not improve anything, only the check for duplicates between directory and files
    // improve performance
    //sort($p_file_list);

    // ----- Trace
    if (IsTrOn())
    {
      for ($i=0; $i<sizeof($p_file_list); $i++)
        TrFctMessage(__FILE__, __LINE__, 2, "p_file_list[$i] = $p_file_list[$i]");
    }

    // ----- Call the generic Unzip function
    $v_result = PhpzipHandlerUnzip($p_phpzip_file, $p_start_file, $p_file_list, $p_list_detail, "partial", $p_path);

    // ----- Return status
    TrFctEnd(__FILE__, __LINE__, $v_result);
    return $v_result;
 }
  // --------------------------------------------------------------------------------

  // --------------------------------------------------------------------------------
  // Function : PhpzipHandlerAdd()
  // Description :
  //   This function adds a list of files or directories ($p_list) in the opened
  //   PhpZip archive ($p_file) in the right position.
  //   A specific compression method may be specified (see $p_mode bellow), by
  //   default it's auto-compression.
  //   It should be noted that any file which is less than 20 bytes will not be
  //   compressed because the compressed file takes at least 20 bytes, so there is
  //   no gain.
  //   Please do not use this function directly.
  // Parameters :
  //   $p_file : File handler of the PHPzip archive.
  //   $p_list : An array containing the files or directories to adds in the archive.
  //   $p_mode : Compression mode for the files :
  //             "N" normal (no compression),
  //             "C" compression,
  //             "A" automatic (means files with extensions defined in $g_phpzip_ext
  //                 will not be compressed) - default
  // Return Values :
  //    1 : OK
  //   -1 : Invalid file handler passed to function
  //   -2 : Invalid file list passed to function
  //   -3 : Error while opening temporary gzip file in binary write mode.
  //   -4 : Error while opening source file in read mode.
  //   -5 : Error while opening temporary file in read mode.
  // See also :
  //   PhpzipAddList()
  // --------------------------------------------------------------------------------
  function PhpzipHandlerAdd($p_file, $p_list, $p_mode="A")
  {
    global $g_phpzip_ext;
    $v_result = 1;

    TrFctStart(__FILE__, __LINE__, "PhpzipHandlerAdd", "$p_file, p_list(0..".sizeof($p_list)."), $p_mode");

    // ----- Look invalid file handler
    if ($p_file == 0)
    {
      // ----- Error message
      echo "ERROR : Invalid file handler passed to function PhpzipHandlerAdd()<br>";

      // ----- return error code
      TrFctEnd(__FILE__, __LINE__, -1, "Invalid file handler");
      return -1;
    }

    // ----- Check the file list
    if (sizeof($p_list) == 0)
    {
      echo "ERROR : Invalid file list passed to function PhpzipHandlerAdd()<br>";
      TrFctEnd(__FILE__, __LINE__, -2, "Invalid file list");
      return -2;
    }

    // ----- Loop on the files
    for ($j=0; $j<count($p_list); $j++)
    {
      // ----- Recuperate the filename
      $p_filename = $p_list[$j];

      TrFctMessage(__FILE__, __LINE__, 2, "PhpZipping file [$p_filename]");

      // ----- Check the filename
      if (!file_exists($p_filename))
      {
        echo "ERROR : File [$p_filename] does not exists<br>";
        TrFctEnd(__FILE__, __LINE__, -4, "File [$p_filename] does not exists");
        return -4;
      }

      // ----- Look for directory
      if (is_dir($p_filename))
      {
        TrFctMessage(__FILE__, __LINE__, 2, "$p_filename is a directory");

        $p_hdir = opendir($p_filename);
        $p_hitem = readdir($p_hdir); // '.' directory
        $p_hitem = readdir($p_hdir); // '..' directory
        while ($p_hitem = readdir($p_hdir))
        {
          if ($p_filename != ".")
            $p_temp_list[0] = $p_filename."/".$p_hitem;
          else
            $p_temp_list[0] = "./".$p_hitem;
          PhpzipHandlerAdd($p_file, $p_temp_list, $p_mode);
        }
        unset($p_temp_list);
        unset($p_hdir);
        unset($p_hitem);

        continue;
      }

      // ----- Get file size
      $v_size =  filesize($p_filename);

      // ----- Look for automatic zip mode
      $v_local_mode = $p_mode;
      if ($v_local_mode == "A")
      {
        // ----- Extract the extension
        $v_extension = strrchr($p_filename, ".");

        TrFctMessage(__FILE__, __LINE__, 2, "$p_filename : extension [$v_extension]");

        // ----- Search for the extension in the list
        if (($v_extension != "") && (strstr($g_phpzip_ext, "$v_extension")))
        {
          $v_local_mode = "N";
        }
        else
        {
          $v_local_mode = "C";
        }
      }

      // ----- Look for files less than 20 octets
      if ($v_size < 20)
      {
        // ----- Change the compression mode to "N"
        $v_local_mode = "N";
      }

      TrFctMessage(__FILE__, __LINE__, 2, "mode = $v_local_mode");

      // ----- Look for compression zip mode
      if ($v_local_mode == "C")
      {
        // ----- Create the temporary gzip file
        $v_temp_filename = $p_filename.".gz";
        if (($v_gz_file = @gzopen($v_temp_filename, "wb")) == 0)
        {
          echo "ERROR : Error while opening $v_temp_filename in gzip binary write mode<br>";
          TrFctEnd(__FILE__, __LINE__, -3, "Error while opening \"$v_temp_filename\" in gzip binary write mode");
          return -3;
        }

        // ----- Read the file and compress it
        if (($v_src_file = @fopen($p_filename, "r")) == 0)
        {
          echo "ERROR : Error while opening $p_filename in read mode<br>";
          TrFctEnd(__FILE__, __LINE__, -4, "Error while opening \"$p_filename\" in read mode");
          return -4;
        }

        // ----- Read/Compress the file
        $v_content = fread($v_src_file, $v_size);
        gzwrite($v_gz_file, $v_content, $v_size);
        unset($v_content);

        // ----- Close the source file
        fclose($v_src_file);

        // ----- Close the gzip temporary file.
        gzclose($v_gz_file);

        // ----- Recuperate the size of the zipped file
        clearstatcache();
        $v_file_size = filesize($v_temp_filename);

        // ----- Write the filename and properties (size, zipped size and type - C means compressed)
        $v_reduce_filename = PhpzipHandlerPathReduction($p_filename);
        $v_line = "$v_reduce_filename:".$v_size.":".$v_file_size.":C:\n";
        fputs($p_file, $v_line);

        // ----- Read the file and copy it
        if (($v_src_file = @fopen($v_temp_filename, "r")) == 0)
        {
          echo "ERROR : Error while opening $v_temp_filename in read mode<br>";
          TrFctEnd(__FILE__, __LINE__, -5, "Error while opening \"$v_temp_filename\" in read mode");
          return -5;
        }

        // ----- Read/write file as a block
        $v_content = fread($v_src_file, $v_file_size);
        fwrite($p_file, $v_content, $v_file_size);
        unset($v_content);

        // ----- Close the source file
        fclose($v_src_file);

        // ----- Delete the temporary file
        unlink($v_temp_filename);
      }

      // ----- Look for normal zip mode (no compression)
      else if ($v_local_mode == "N")
      {
        // ----- Write the filename and properties (size, zipped size and type - C means compressed)
        $v_reduce_filename = PhpzipHandlerPathReduction($p_filename);
        $v_line = "$v_reduce_filename:".$v_size.":".$v_size.":N:\n";
        fputs($p_file, $v_line);

        // ----- Open the source file in read mode
        if (($v_src_file = @fopen($p_filename, "r")) == 0)
        {
          echo "ERROR : Error while opening $p_filename in read mode<br>";
          TrFctEnd(__FILE__, __LINE__, -4, "Error while opening \"$p_filename\" in read mode");
          return -4;
        }

        // ----- Read/Compress the file
        $v_content = fread($v_src_file, $v_size);
        fwrite($p_file, $v_content, $v_size);
        unset($v_content);

        // ----- Close the source file
        fclose($v_src_file);
      }

      // ----- Add a new line for separation raison
      fputs($p_file, "\n");
    }

    // ----- Return
    TrFctEnd(__FILE__, __LINE__, $v_result);
    return $v_result;
  }
  // --------------------------------------------------------------------------------

  // --------------------------------------------------------------------------------
  // Function : PhpzipHandlerAddDirCompose()
  // Description :
  //   This function creates a table with all the names of the files found in it and
  //   its sub-directories.
  //   It is a recursive function.
  //   Note that the directories '.' and '..' are ignored.
  // Parameters :
  //   $p_dir : Directory to start with.
  //   $p_list : List where the filenames are to be added.
  // Return Values :
  //    None.
  // --------------------------------------------------------------------------------
  function PhpzipHandlerAddDirCompose($p_dir, &$p_list)
  {
    TrFctStart(__FILE__, __LINE__, "PhpzipHandlerAddDirCompose", "$p_dir, ");

    // ----- Check if the directory is valid
    if (!is_dir($p_dir))
    {
      TrFctEnd(__FILE__, __LINE__, 1, "[$p_dir] is not a directory");
      return;
    }

    // ----- Look for all the files and subdirectories in the directory.
    if (($v_handler = opendir($p_dir)) == 0)
    {
      TrFctEnd(__FILE__, __LINE__, 1, "unable to open directory [$p_dir]");
      return;
    }
    $v_filename = readdir($v_handler); // ----- This is for '.' directory
    $v_filename = readdir($v_handler); // ----- This is for '..' directory
    while ($v_filename = readdir($v_handler))
    {
      // ----- Look if it is a sub-directory
      if (is_dir($p_dir."/".$v_filename))
        PhpzipHandlerAddDirCompose($p_dir."/".$v_filename, $p_list);

      // ----- Look for files
      else if ($p_dir == "/")
        $p_list[count($p_list)] = $p_dir.$v_filename;
      else
        $p_list[count($p_list)] = $p_dir."/".$v_filename;
    }

    TrFctEnd(__FILE__, __LINE__);
  }
  // --------------------------------------------------------------------------------

  // --------------------------------------------------------------------------------
  // Function : PhpzipHandlerOpenRead()
  // Description :
  //   This function opens a PHPzip archive and checks its properties. A handler
  //   to the open file is returned ($p_file). The auto-start filename is returned
  //   if any.
  //   The file handler opened ($p_file) must be closed by PhpzipHandlerClose().
  //   The function checks that $p_phpzip_file is a valid PHPzip archive by checking
  //   the filename, checking if file exists, checking that the file has the right
  //   tags at the beginning.
  //   Note that the version of the archive look only on the first digit of the
  //   version indicated in the tag. This is to be able to update the PHPzip
  //   library with no impact on installing application using it as soon as the
  //   archive file format stay the same. As soon as the file format will change,
  //   the version must change the first digit in order to be detected by older
  //   PHPzip library version.
  // Parameters :
  //   $p_phpzip_file : Filename of the PHPzip archive.
  //   $p_file : Variable where the opened file handler will be set.
  //   $p_startfile : Variable where the auto-start filename willbe set if any.
  //                  Else it will be set to "".
  // Return Values :
  //    1 : OK
  //   -1 : Invalid string for PHPzip filename.
  //   -2 : Error while opening file in read mode.
  //   -3 : Invalid file type : not a valid PHPZip archive file (bad preambule tag).
  //   -4 : Invalid version of the PHPZip archive file.
  //   -5 : Invalid autounzip PHPZip archive file. Archive content not found.
  // See also :
  //   PhpzipUnzipStart(), PhpzipList()
  // --------------------------------------------------------------------------------
  function PhpzipHandlerOpenRead($p_phpzip_file, &$p_file, &$p_startfile)
  {
    global $g_phpzip_version;
    global $g_phpzip_tag;
    $v_result = 1;

    TrFctStart(__FILE__, __LINE__, "PhpzipHandlerOpenRead", "$p_phpzip_file, , ");

    // ----- Reset value for v_file
    $p_file = 0;

    // ----- Look unset name (missing call to constructor)
    if ($p_phpzip_file == "")
    {
      // ----- return error code
      TrFctEnd(__FILE__, __LINE__, -1, "Invalid PHPzip archive filename [$p_phpzip_file]");
      return -1;
    }

    // ----- Open the phpzip file
    if (($v_file = @fopen($p_phpzip_file, "r+")) == 0)
    {
      TrFctEnd(__FILE__, __LINE__, -2, "Unable to read PhpZip archive [$p_phpzip_file]");
      return -2;
    }

    // ----- Read the first line (or 1024 bytes)
    $v_line = fgets($v_file, 1024);

    // ----- Check the phpzip preamble type
    if (substr($v_line, 0, strlen($g_phpzip_tag)) != $g_phpzip_tag)
    {
      TrFctMessage(__FILE__, __LINE__, 4, "First line in file [$v_line]");
      TrFctMessage(__FILE__, __LINE__, 3, "PhpZip tag [$g_phpzip_tag), lenght=".strlen($g_phpzip_tag));
      fclose($v_file);

      TrFctEnd(__FILE__, __LINE__, -3, "File [$p_phpzip_file] is not a valid PHPzip archive");
      return -3;
    }

    // ----- Extract version and archive type
    $v_properties = explode(":", $v_line);
    $v_version = trim($v_properties[1]);
    $v_type = trim($v_properties[2]);

    // ----- Check the file version which follow the phpzip tag
    // Looks only for the first part of the version (ie looks for 1 in version 1.0
    // It is assumed that if the file format change the version will be increment in the first digit
    if (substr($v_version, 0, strpos($v_version, ".")) != substr($g_phpzip_version, 0, strpos($g_phpzip_version, ".")))
    {
      fclose($v_file);
      TrFctEnd(__FILE__, __LINE__, -4, "Unsupported PhpZip version for the file [".$p_phpzip_file."]");
      return -4;
    }

    // ----- Look for autounzip files
    TrFctMessage(__FILE__, __LINE__, 2, "PHPunzip file type : [$v_type]");
    if ($v_type == "phpautounzip")
    {
      TrFctMessage(__FILE__, __LINE__, 2, "Autounzip archive");

      // ----- Read each line until the token $g_phpzip_tag is found at the beginning
      while ((!feof($v_file)) && ($v_type != "phpzip"))
      {
        // ----- Get the next line
        $v_line = fgets($v_file, 4096);
        TrFctMessage(__FILE__, __LINE__, 3, "Reading line : [$v_line]");

        // ----- Look for preambule of the zipped part
        if (substr($v_line, 0, strlen($g_phpzip_tag)) == $g_phpzip_tag)
        {
          unset($v_properties);
          $v_properties = explode(":", $v_line);
          $v_type = $v_properties[2];
          TrFctMessage(__FILE__, __LINE__, 3, "Start of zipped section found");
        }
      }
    }

    if (IsTrOn())
    {
      TrFctMessage(__FILE__, __LINE__, 3, "PHPunzip file type : [$v_type]");
      for ($i=2; $i<count($v_properties); $i++)
        TrFctMessage(__FILE__, __LINE__, 3, "PHPunzip file property[$i] : [$v_properties[$i]]");
    }

    // ----- Look if it is really a PHPZip archive
    if ($v_type != "phpzip")
    {
      fclose($v_file);
      TrFctEnd(__FILE__, __LINE__, -5, "Invalid archive type [$v_type] for [$p_phpzip_file]");
      return -5;
    }

    // ----- Look for startfile
    if ($v_properties[3] != "")
    {
      // ----- Check for "start="
      $v_token = explode("=", $v_properties[3]);
      TrFctMessage(__FILE__, __LINE__, 3, "token[0] = $v_token[0], token[1] = $v_token[1]");
      if ($v_token[0] == "start")
        $p_startfile = $v_token[1];

      TrFctMessage(__FILE__, __LINE__, 2, "Found an auto-startup file [$p_startfile]");
     }

    // ----- Set the file handler
    $p_file = $v_file;

    // ----- Return
    TrFctEnd(__FILE__, __LINE__, $v_result);
    return $v_result;
  }
  // --------------------------------------------------------------------------------

  // --------------------------------------------------------------------------------
  // Function : PhpzipHandlerClose()
  // Description :
  //   Close the PHPzip archive file handler opened by PhpzipHandlerOpenRead()
  // --------------------------------------------------------------------------------
  function PhpzipHandlerClose($p_file)
  {
    TrFctStart(__FILE__, __LINE__, "PhpzipHandlerClose", "$p_file");
    $v_result =  fclose($p_file);
    TrFctEnd(__FILE__, __LINE__, $v_result);
    return $v_result;
  }
  // --------------------------------------------------------------------------------

  // --------------------------------------------------------------------------------
  // Function : PhpzipHandlerDirCheck()
  // Description :
  //   Check if a directory exists, if not it creates it and all the parents directory
  //   which may be useful.
  // Parameters :
  //   $p_dir : Directory path to check (without / at the end).
  // Return Values :
  //    1 : OK
  //   -1 : Unable to create directory
  // --------------------------------------------------------------------------------
  function PhpzipHandlerDirCheck($p_dir)
  {
    $v_result = 1;

    TrFctStart(__FILE__, __LINE__, "PhpzipHandlerDirCheck", "$p_dir");

    // ----- Check the directory availability
    if ((is_dir($p_dir)) || ($p_dir == ""))
    {
      TrFctEnd(__FILE__, __LINE__, 1, "[$p_dir] is a directory");
      return 1;
    }

    // ----- Look for file alone
    if (!strstr("$p_dir", "/"))
    {
      TrFctEnd(__FILE__, __LINE__, 1, "[$p_dir] is a file with no directory");
      return 1;
    }

    // ----- Extract parent directory
    $p_parent_dir = dirname($p_dir);
    TrFctMessage(__FILE__, __LINE__, 3, "Parent directory is [$p_parent_dir]");

    // ----- Just a check
    if ($p_parent_dir != $p_dir)
    {
      // ----- Look for parent directory
      if ($p_parent_dir != "")
      {
        if (($v_result = PhpzipHandlerDirCheck($p_parent_dir)) != 1)
        {
          TrFctEnd(__FILE__, __LINE__, $v_result);
          return $v_result;
        }
      }
    }

    // ----- Create the directory
    if (!@mkdir($p_dir, 0777))
    {
      echo "ERROR : Unable to create directory [$p_dir]<br>";
      TrFctEnd(__FILE__, __LINE__, -1, "Unable to create directory [$p_dir]");
      return -1;
    }

    // ----- Return
    TrFctEnd(__FILE__, __LINE__, $v_result, "Directory [$p_dir] created");
    return $v_result;
  }
  // --------------------------------------------------------------------------------

  // --------------------------------------------------------------------------------
  // Function : PhpzipHandlerPathReduction()
  // Description :
  // Parameters :
  // Return Values :
  // --------------------------------------------------------------------------------
  function PhpzipHandlerPathReduction($p_dir)
  {
    TrFctStart(__FILE__, __LINE__, "PhpzipHandlerPathReduction", "dir='$p_dir'");
    $v_result = "";

    // ----- Look for not empty path
    if ($p_dir != "")
    {
      // ----- Explode path by directory names
      $v_list = explode("/", $p_dir);

      // ----- Study directories from last to first
      for ($i=sizeof($v_list)-1; $i>=0; $i--)
      {
        // ----- Look for current path
        if ($v_list[$i] == ".")
        {
          // ----- Ignore this directory
          // Should be the first $i=0, but no check is done
        }
        else if ($v_list[$i] == "..")
        {
          // ----- Ignore it and ignore the $i-1
          $i--;
        }
        else if (($v_list[$i] == "") && ($i!=(sizeof($v_list)-1)) && ($i!=0))
        {
          // ----- Ignore only the double '//' in path,
          // but not the first and last '/'
        }
        else
        {
          $v_result = $v_list[$i].($i!=(sizeof($v_list)-1)?"/".$v_result:"");
        }
      }
    }

    // ----- Return
    TrFctEnd(__FILE__, __LINE__, $v_result);
    return $v_result;
  }
  // --------------------------------------------------------------------------------

// ----- End of double include loop
}
?>
