<?php
/**  
 *  Path to (smt) JavaScript files
 *  -------------- 
 *   This path must be the same as the one used in your (x)html pages;
 *   i.e: If you included the (smt) record file as 
 *   <script type="text/javascript" src="http://my.server.com/smt/smt_record.js"></script>,
 *   the path to (smt) JavaScript files would be http://my.server.com/smt
 *
 *   Note: Do NOT place a final slash (/)
 */
define ('JS_PATH',        '/smt');

/**  
 *  Your head tag
 *  -------------- 
 *   Usually you may not change this unless you use something special like 
 *   <HEAD profile="http://www.acme.com/profiles/core">; for example WordPress 
 *   uses <head profile="http://gmpg.org/xfn/11"> by default.
 *   
 *   Note that 'HEAD' and 'head' are different words: check sensitive case (PHP 4).
 */
define ('HEAD_TAG',       '<head>');

// That's all.
?>
