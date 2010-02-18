// --------------------------------------------------------------------------------
// PhpZip Application 1.7.a2 - readme.txt
// --------------------------------------------------------------------------------
// License GNU/GPL - Vincent Blavet - June 2002
// http://www.phpconcept.net
// --------------------------------------------------------------------------------

                                                   

0 - Sommaire
============
    1 - Introduction
    2 - Install
    3 - What's new
    4 - Manual
    5 - Language
    6 - License
    7 - Support
    8 - Warning
    9 - Author

1 - Introduction
================

  PhpZip is a Web/PHP application that manage archives in several formats.
  The application supports GNU TAR archives (.tar) and compressed (gzip) 
  GNU TAR archives (.tar.gz or .tgz), Zip archives (.zip) and a proprietary format
  (.piz).
  The two first formats are "standards" ones, the archives can be read/write
  by most of the application archivers (WinZip, Pkzip, ...). 
  The last one has a unique fonction, which is to be a PHP auto-extract/auto-exec
  archive.


2 - Install
===========

  PhpZip 1.7.a2 is released in a WinZip traditionnal format (phpzip-1-7-a2.zip), a compressed
  GNU TAR format (phpzip-1-7-a2.tar.gz).

a. Winzip archive
-----------------
  Unzip the Winzip file in a folder.
  Download the resulting files and directories in a directory in your web server.
  Launch the application by calling http://mydomain.com/myfolder/phpzip.php3.
  Change the language (if needed) by selecting the 'options' menu.

  NOTE : If you want to use .php extension, you need to rename all the .php3 files
  in .php before downloading them on the web site.
  No internal modifications are needed.

b. GNU TAR archive
------------------
  Unzip the GNU TAR file in a folder.
  Download the resulting files and directories in a directory in your web server.
  Launch the application by calling http://mydomain.com/myfolder/phpzip.php3.
  Change the language (if needed) by selecting the 'options' menu.

  NOTE : If you want to use .php extension, you need to rename all the .php3 files
  in .php before downloading them on the web site.
  No internal modifications are needed.


3 - What's new
==============

. What's new on PhpZip 1.7.a2 application
----------------------------------------

  *** Please note that 1.7.a2 version is still an alpha version ***

  - Bug correction : in the download feature, check that the file is an archive.
    Without this check any files (including .htaccess file) can be downloaded.

. What's new on PhpZip 1.7.a1 application
----------------------------------------

  *** Please note that 1.7.a1 version is still an alpha version ***

  - Bug correction : an infinite loop may occur with certain types of zip archives.
    This is corrected in PhpZip 1.7.a1
  - Bug correction : while trying to open an archive with the popup window, the .zip
    archive are not proposed, due to a baddly configured filter.
    This is corrected in PhpZip 1.7.a1

. What's new on PhpZip 1.7.a application
----------------------------------------

  *** Please note that 1.7.a version is an alpha version ***

  - Support for Zip archive format (using PclZip library)
  - Tree View :
    . The content of the archive can be displayed as a tree view (default ) or as
      a flat view (situation before v.1.7)
    . Ability to configure the tree view / flat view as the default view in the
      configuration menu,
    . Each displayed file/dir in the tree view has a file descriptor while the pointer
      stay on it (filename, path, size, last modification date).
    . Attached on each displayed file/folder is an action menu accessible by a simple 
      click on the item. The action menu permit to extract the file or the folder (and
      its content), delete, update the file or folder (in this case it looks for the 
      folder in the file system for updated files, new files but it does not delete
      files) ... 
    . For update action two "popup" indicates what appen. At the end, when popup is
      closed, the main window is reloaded/updated.
  - While extracting, if you select a folder, all the files in the folder are
    extracted with the folder.
  - While deleting, if you select a folder, all the files in the folder are deleted.
  - Add a field to be able to create an archive in folder different from the default one.
 

. What's new on PhpZip 1.6 application
--------------------------------------

  - Add an update function. PhpZip will add the file only if it is a new one, or if the
    last modification date is newer.
  - Add the ability to remove files from the archive.
  - Add the ability to modify (change/add/remove) the stored directory while adding files.
    This is useful when you don't want to stored the exact physical path (which is
    relative to PhpZip installation directory), but a more usefull path.
  - Add the ability to modify the extracting path. You can extract the files in a specific
    directory, you can also ignore (part of) the stored path.
  - Add the ability to replace an existing archive.
  - Add a color chooser window in the configuration menu. (JavaScript)
  - Add a download feature.

  PhpZip use a new version of PclTar Library (1.1) which allow theses new functions. Most
  of it are therefore not available for archive in the proprietary PhpZip format (.piz).

. What's new on PhpZip 1.5 application
--------------------------------------
Visible functions in PhpZip 1.5 :
  - Add support of standard GNU TAR and GZIP GNU TAR archive.
  - Automatic reduction of complicated directory path. For example path like
    "../../folder/file.txt" are reduced to "folder/file.txt"

. What's new on PhpZip Library 1.5
----------------------------------
New functions for PhpZip Library 1.5 :
  - Automatic reduction of complicated directory path


. What's new on PhpZip 1.1 application
--------------------------------------
Visible functions in PhpZip 1.1 :
  - Archive to open is selected by an explorer function.
  - Files to add in an archive are selectable by an explorer function.
  - Partial file extrcation from an archive is available.
  - Configuration menu gives the ability to :
    . Select the language, (see chapter 5)
    . Modify font type,
    . Modify colors,
    . Modify font sizes,
    . Include PhpZip in a custom 'header'/'footer' files,
    . Switch on/off trace mode.


. What's new on PhpZip Library 1.1
-----------------------------------
New functions for PhpZip Library 1.1 :

  - Add function IsPhpzipArchive() : Identify if a file is a valid PhpZip archive.
  - Add function PhpzipUnzipListString() : Extract a list of files/folders which are
    in a string separated by ":".
  - Add function PhpzipUnzipList() : Extract a list of files/folders which are
    in an array.
  - Modify functions PhpzipAdd(), PhpzipAddDir() et PhpzipAddList() : Automatic folder
    recognition. The PhpzipAddDir() is not removed for compatibility raison.

4 - Manuel
==========

  The user guide is today available in french in http://www.phpconcept.net
  An english version will be available soon.

5 - Langage
===========

  PhpZip offer multi-language support.
  Today French, English and Italian languages are supported. Italian language is available
  thanks to Piero Mannelli (webmaster@subnet.it).

  For each language a translation file is located in 'lang' directory. The filename
  has the following format : lang-NAME.inc.php3 (or .php) where NAME is the language
  name (french, english, spanish, ...). PhpZip automaticcaly parse this folder to
  find available languages.

  To create a new language file, follow theses instructions :
  1. Do a copy of the lang-template.inc.php3 file, with the name lang-NAME.inc.php3,
     where 'NAME' is the name of the lang (for example: spanish, deutch, ...)
  2. Translate all the english sentences by the wanted language sentences.
     (The english sentences, not he french one).
  3. Save the file.
  4. Launch PhpZip application and in the 'Options' menu select the new
     language.
  5. Send me the translated files. It is the most important step of this
     procedure ;-)) ! (webmaster@phpconcept.net) Thanks !


6 - License
===========

  PhpZip application, and the associated libraries are under GNU/GPL license.

  This library is free, so you can use it at no cost.

  HOWEVER, if you release a script, an application, a library or any kind of
  code including PhpZip, PhpZip Library or PclTar library (or a part of it), YOU MUST :
  - Release your work under GNU/GPL license (free software),
  - You must indicate in the documentation (or a readme file), that your work
    include PhpZip, PhpZip Library or PclTar Library , and make a reference to the
    author and the web site http://www.phpconcept.net

  I will also appreciate that you send me a mail (vincent@blavet.net), just to
  be aware that someone is using PhpZip (but this is not mandatory ;-) ).

  For more information : http://www.gnu.org

  The 'drop down menu link' is under DynamicDrive (www.dynamicdrive.com) license.


7 - Support
===========

  Known bugs can be found in http://www.phpconcept.net

8 - Warning
=================

  This application and the associated files are non commercial, non professional work.
  It should not have unexpected results. However if any damage is caused by this software
  the author can not be responsible.

  This program is distributed in the hope that it will be useful, but 
  WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY 
  or FITNESS FOR A PARTICULAR PURPOSE. 

  The use of this software is at the risk of the user.

9 - Author
==========

  This software was written by Vincent Blavet (vincent@blavet.net) on its leasure times.


