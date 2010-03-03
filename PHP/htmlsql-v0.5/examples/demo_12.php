<?php

if (isset($_GET['url']))
{

    /*
    ** htmlSQL - Example 12
    **
    ** Shows how to replace the user agent and the referer with
    ** custom values
    */
?>

<?php

/*************************************************

Snoopy - the PHP net client
Author: Monte Ohrt <monte@ispi.net>
Copyright (c): 1999-2000 ispi, all rights reserved
Version: 1.01

 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

You may contact the author of Snoopy by e-mail at:
monte@ispi.net

Or, write to:
Monte Ohrt
CTO, ispi
237 S. 70th suite 220
Lincoln, NE 68510

The latest version of Snoopy can be obtained from:
http://snoopy.sourceforge.net/

*************************************************/

class Snoopy
{
	/**** Public variables ****/
	
	/* user definable vars */

	var $host			=	"";		// host name we are connecting to
	var $port			=	80;					// port we are connecting to
	var $proxy_host		=	"ISA";					// proxy host to use
	var $proxy_port		=	"8080";					// proxy port to use
	var $proxy_user		=	"";					// proxy user to use
	var $proxy_pass		=	"";					// proxy password to use
	
	var $agent			=	"Snoopy v1.2.3";	// agent we masquerade as
	var	$referer		=	"";					// referer info to pass
	var $cookies		=	array();			// array of cookies to pass
												// $cookies["username"]="joe";
	var	$rawheaders		=	array();			// array of raw headers to send
												// $rawheaders["Content-type"]="text/html";

	var $maxredirs		=	5;					// http redirection depth maximum. 0 = disallow
	var $lastredirectaddr	=	"";				// contains address of last redirected address
	var	$offsiteok		=	true;				// allows redirection off-site
	var $maxframes		=	0;					// frame content depth maximum. 0 = disallow
	var $expandlinks	=	true;				// expand links to fully qualified URLs.
												// this only applies to fetchlinks()
												// submitlinks(), and submittext()
	var $passcookies	=	true;				// pass set cookies back through redirects
												// NOTE: this currently does not respect
												// dates, domains or paths.
	
	var	$user			=	"";					// user for http authentication
	var	$pass			=	"";					// password for http authentication
	
	// http accept types
	var $accept			=	"image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, */*";
	
	var $results		=	"";					// where the content is put
		
	var $error			=	"";					// error messages sent here
	var	$response_code	=	"";					// response code returned from server
	var	$headers		=	array();			// headers returned from server sent here
	var	$maxlength		=	500000;				// max return data length (body)
	var $read_timeout	=	0;					// timeout on read operations, in seconds
												// supported only since PHP 4 Beta 4
												// set to 0 to disallow timeouts
	var $timed_out		=	false;				// if a read operation timed out
	var	$status			=	0;					// http request status

	var $temp_dir		=	"/tmp";				// temporary directory that the webserver
												// has permission to write to.
												// under Windows, this should be C:\temp

	var	$curl_path		=	"/usr/local/bin/curl";
												// Snoopy will use cURL for fetching
												// SSL content if a full system path to
												// the cURL binary is supplied here.
												// set to false if you do not have
												// cURL installed. See http://curl.haxx.se
												// for details on installing cURL.
												// Snoopy does *not* use the cURL
												// library functions built into php,
												// as these functions are not stable
												// as of this Snoopy release.
	
	/**** Private variables ****/	
	
	var	$_maxlinelen	=	4096;				// max line length (headers)
	
	var $_httpmethod	=	"GET";				// default http request method
	var $_httpversion	=	"HTTP/1.0";			// default http request version
	var $_submit_method	=	"POST";				// default submit method
	var $_submit_type	=	"application/x-www-form-urlencoded";	// default submit type
	var $_mime_boundary	=   "";					// MIME boundary for multipart/form-data submit type
	var $_redirectaddr	=	false;				// will be set if page fetched is a redirect
	var $_redirectdepth	=	0;					// increments on an http redirect
	var $_frameurls		= 	array();			// frame src urls
	var $_framedepth	=	0;					// increments on frame depth
	
	var $_isproxy		=	false;				// set if using a proxy server
	var $_fp_timeout	=	30;					// timeout for socket connection

/*======================================================================*\
	Function:	fetch
	Purpose:	fetch the contents of a web page
				(and possibly other protocols in the
				future like ftp, nntp, gopher, etc.)
	Input:		$URI	the location of the page to fetch
	Output:		$this->results	the output text from the fetch
\*======================================================================*/

	function fetch($URI)
	{
	
		//preg_match("|^([^:]+)://([^:/]+)(:[\d]+)*(.*)|",$URI,$URI_PARTS);
		$URI_PARTS = parse_url($URI);
		if (!empty($URI_PARTS["user"]))
			$this->user = $URI_PARTS["user"];
		if (!empty($URI_PARTS["pass"]))
			$this->pass = $URI_PARTS["pass"];
		if (empty($URI_PARTS["query"]))
			$URI_PARTS["query"] = '';
		if (empty($URI_PARTS["path"]))
			$URI_PARTS["path"] = '';
				
		switch(strtolower($URI_PARTS["scheme"]))
		{
			case "http":
				$this->host = $URI_PARTS["host"];
				if(!empty($URI_PARTS["port"]))
					$this->port = $URI_PARTS["port"];
				if($this->_connect($fp))
				{
					if($this->_isproxy)
					{
						// using proxy, send entire URI
						$this->_httprequest($URI,$fp,$URI,$this->_httpmethod);
					}
					else
					{
						$path = $URI_PARTS["path"].($URI_PARTS["query"] ? "?".$URI_PARTS["query"] : "");
						// no proxy, send only the path
						$this->_httprequest($path, $fp, $URI, $this->_httpmethod);
					}
					
					$this->_disconnect($fp);

					if($this->_redirectaddr)
					{
						/* url was redirected, check if we've hit the max depth */
						if($this->maxredirs > $this->_redirectdepth)
						{
							// only follow redirect if it's on this site, or offsiteok is true
							if(preg_match("|^http://".preg_quote($this->host)."|i",$this->_redirectaddr) || $this->offsiteok)
							{
								/* follow the redirect */
								$this->_redirectdepth++;
								$this->lastredirectaddr=$this->_redirectaddr;
								$this->fetch($this->_redirectaddr);
							}
						}
					}

					if($this->_framedepth < $this->maxframes && count($this->_frameurls) > 0)
					{
						$frameurls = $this->_frameurls;
						$this->_frameurls = array();
						
						while(list(,$frameurl) = each($frameurls))
						{
							if($this->_framedepth < $this->maxframes)
							{
								$this->fetch($frameurl);
								$this->_framedepth++;
							}
							else
								break;
						}
					}					
				}
				else
				{
					return false;
				}
				return true;					
				break;
			case "https":
				if(!$this->curl_path)
					return false;
				if(function_exists("is_executable"))
				    if (!is_executable($this->curl_path))
				        return false;
				$this->host = $URI_PARTS["host"];
				if(!empty($URI_PARTS["port"]))
					$this->port = $URI_PARTS["port"];
				if($this->_isproxy)
				{
					// using proxy, send entire URI
					$this->_httpsrequest($URI,$URI,$this->_httpmethod);
				}
				else
				{
					$path = $URI_PARTS["path"].($URI_PARTS["query"] ? "?".$URI_PARTS["query"] : "");
					// no proxy, send only the path
					$this->_httpsrequest($path, $URI, $this->_httpmethod);
				}

				if($this->_redirectaddr)
				{
					/* url was redirected, check if we've hit the max depth */
					if($this->maxredirs > $this->_redirectdepth)
					{
						// only follow redirect if it's on this site, or offsiteok is true
						if(preg_match("|^http://".preg_quote($this->host)."|i",$this->_redirectaddr) || $this->offsiteok)
						{
							/* follow the redirect */
							$this->_redirectdepth++;
							$this->lastredirectaddr=$this->_redirectaddr;
							$this->fetch($this->_redirectaddr);
						}
					}
				}

				if($this->_framedepth < $this->maxframes && count($this->_frameurls) > 0)
				{
					$frameurls = $this->_frameurls;
					$this->_frameurls = array();

					while(list(,$frameurl) = each($frameurls))
					{
						if($this->_framedepth < $this->maxframes)
						{
							$this->fetch($frameurl);
							$this->_framedepth++;
						}
						else
							break;
					}
				}					
				return true;					
				break;
			default:
				// not a valid protocol
				$this->error	=	'Invalid protocol "'.$URI_PARTS["scheme"].'"\n';
				return false;
				break;
		}		
		return true;
	}

/*======================================================================*\
	Function:	submit
	Purpose:	submit an http form
	Input:		$URI	the location to post the data
				$formvars	the formvars to use.
					format: $formvars["var"] = "val";
				$formfiles  an array of files to submit
					format: $formfiles["var"] = "/dir/filename.ext";
	Output:		$this->results	the text output from the post
\*======================================================================*/

	function submit($URI, $formvars="", $formfiles="")
	{
		unset($postdata);
		
		$postdata = $this->_prepare_post_body($formvars, $formfiles);
			
		$URI_PARTS = parse_url($URI);
		if (!empty($URI_PARTS["user"]))
			$this->user = $URI_PARTS["user"];
		if (!empty($URI_PARTS["pass"]))
			$this->pass = $URI_PARTS["pass"];
		if (empty($URI_PARTS["query"]))
			$URI_PARTS["query"] = '';
		if (empty($URI_PARTS["path"]))
			$URI_PARTS["path"] = '';

		switch(strtolower($URI_PARTS["scheme"]))
		{
			case "http":
				$this->host = $URI_PARTS["host"];
				if(!empty($URI_PARTS["port"]))
					$this->port = $URI_PARTS["port"];
				if($this->_connect($fp))
				{
					if($this->_isproxy)
					{
						// using proxy, send entire URI
						$this->_httprequest($URI,$fp,$URI,$this->_submit_method,$this->_submit_type,$postdata);
					}
					else
					{
						$path = $URI_PARTS["path"].($URI_PARTS["query"] ? "?".$URI_PARTS["query"] : "");
						// no proxy, send only the path
						$this->_httprequest($path, $fp, $URI, $this->_submit_method, $this->_submit_type, $postdata);
					}
					
					$this->_disconnect($fp);

					if($this->_redirectaddr)
					{
						/* url was redirected, check if we've hit the max depth */
						if($this->maxredirs > $this->_redirectdepth)
						{						
							if(!preg_match("|^".$URI_PARTS["scheme"]."://|", $this->_redirectaddr))
								$this->_redirectaddr = $this->_expandlinks($this->_redirectaddr,$URI_PARTS["scheme"]."://".$URI_PARTS["host"]);						
							
							// only follow redirect if it's on this site, or offsiteok is true
							if(preg_match("|^http://".preg_quote($this->host)."|i",$this->_redirectaddr) || $this->offsiteok)
							{
								/* follow the redirect */
								$this->_redirectdepth++;
								$this->lastredirectaddr=$this->_redirectaddr;
								if( strpos( $this->_redirectaddr, "?" ) > 0 )
									$this->fetch($this->_redirectaddr); // the redirect has changed the request method from post to get
								else
									$this->submit($this->_redirectaddr,$formvars, $formfiles);
							}
						}
					}

					if($this->_framedepth < $this->maxframes && count($this->_frameurls) > 0)
					{
						$frameurls = $this->_frameurls;
						$this->_frameurls = array();
						
						while(list(,$frameurl) = each($frameurls))
						{														
							if($this->_framedepth < $this->maxframes)
							{
								$this->fetch($frameurl);
								$this->_framedepth++;
							}
							else
								break;
						}
					}					
					
				}
				else
				{
					return false;
				}
				return true;					
				break;
			case "https":
				if(!$this->curl_path)
					return false;
				if(function_exists("is_executable"))
				    if (!is_executable($this->curl_path))
				        return false;
				$this->host = $URI_PARTS["host"];
				if(!empty($URI_PARTS["port"]))
					$this->port = $URI_PARTS["port"];
				if($this->_isproxy)
				{
					// using proxy, send entire URI
					$this->_httpsrequest($URI, $URI, $this->_submit_method, $this->_submit_type, $postdata);
				}
				else
				{
					$path = $URI_PARTS["path"].($URI_PARTS["query"] ? "?".$URI_PARTS["query"] : "");
					// no proxy, send only the path
					$this->_httpsrequest($path, $URI, $this->_submit_method, $this->_submit_type, $postdata);
				}

				if($this->_redirectaddr)
				{
					/* url was redirected, check if we've hit the max depth */
					if($this->maxredirs > $this->_redirectdepth)
					{						
						if(!preg_match("|^".$URI_PARTS["scheme"]."://|", $this->_redirectaddr))
							$this->_redirectaddr = $this->_expandlinks($this->_redirectaddr,$URI_PARTS["scheme"]."://".$URI_PARTS["host"]);						

						// only follow redirect if it's on this site, or offsiteok is true
						if(preg_match("|^http://".preg_quote($this->host)."|i",$this->_redirectaddr) || $this->offsiteok)
						{
							/* follow the redirect */
							$this->_redirectdepth++;
							$this->lastredirectaddr=$this->_redirectaddr;
							if( strpos( $this->_redirectaddr, "?" ) > 0 )
								$this->fetch($this->_redirectaddr); // the redirect has changed the request method from post to get
							else
								$this->submit($this->_redirectaddr,$formvars, $formfiles);
						}
					}
				}

				if($this->_framedepth < $this->maxframes && count($this->_frameurls) > 0)
				{
					$frameurls = $this->_frameurls;
					$this->_frameurls = array();

					while(list(,$frameurl) = each($frameurls))
					{														
						if($this->_framedepth < $this->maxframes)
						{
							$this->fetch($frameurl);
							$this->_framedepth++;
						}
						else
							break;
					}
				}					
				return true;					
				break;
				
			default:
				// not a valid protocol
				$this->error	=	'Invalid protocol "'.$URI_PARTS["scheme"].'"\n';
				return false;
				break;
		}		
		return true;
	}

/*======================================================================*\
	Function:	fetchlinks
	Purpose:	fetch the links from a web page
	Input:		$URI	where you are fetching from
	Output:		$this->results	an array of the URLs
\*======================================================================*/

	function fetchlinks($URI)
	{
		if ($this->fetch($URI))
		{			
			if($this->lastredirectaddr)
				$URI = $this->lastredirectaddr;
			if(is_array($this->results))
			{
				for($x=0;$x<count($this->results);$x++)
					$this->results[$x] = $this->_striplinks($this->results[$x]);
			}
			else
				$this->results = $this->_striplinks($this->results);

			if($this->expandlinks)
				$this->results = $this->_expandlinks($this->results, $URI);
			return true;
		}
		else
			return false;
	}

/*======================================================================*\
	Function:	fetchform
	Purpose:	fetch the form elements from a web page
	Input:		$URI	where you are fetching from
	Output:		$this->results	the resulting html form
\*======================================================================*/

	function fetchform($URI)
	{
		
		if ($this->fetch($URI))
		{			

			if(is_array($this->results))
			{
				for($x=0;$x<count($this->results);$x++)
					$this->results[$x] = $this->_stripform($this->results[$x]);
			}
			else
				$this->results = $this->_stripform($this->results);
			
			return true;
		}
		else
			return false;
	}
	
	
/*======================================================================*\
	Function:	fetchtext
	Purpose:	fetch the text from a web page, stripping the links
	Input:		$URI	where you are fetching from
	Output:		$this->results	the text from the web page
\*======================================================================*/

	function fetchtext($URI)
	{
		if($this->fetch($URI))
		{			
			if(is_array($this->results))
			{
				for($x=0;$x<count($this->results);$x++)
					$this->results[$x] = $this->_striptext($this->results[$x]);
			}
			else
				$this->results = $this->_striptext($this->results);
			return true;
		}
		else
			return false;
	}

/*======================================================================*\
	Function:	submitlinks
	Purpose:	grab links from a form submission
	Input:		$URI	where you are submitting from
	Output:		$this->results	an array of the links from the post
\*======================================================================*/

	function submitlinks($URI, $formvars="", $formfiles="")
	{
		if($this->submit($URI,$formvars, $formfiles))
		{			
			if($this->lastredirectaddr)
				$URI = $this->lastredirectaddr;
			if(is_array($this->results))
			{
				for($x=0;$x<count($this->results);$x++)
				{
					$this->results[$x] = $this->_striplinks($this->results[$x]);
					if($this->expandlinks)
						$this->results[$x] = $this->_expandlinks($this->results[$x],$URI);
				}
			}
			else
			{
				$this->results = $this->_striplinks($this->results);
				if($this->expandlinks)
					$this->results = $this->_expandlinks($this->results,$URI);
			}
			return true;
		}
		else
			return false;
	}

/*======================================================================*\
	Function:	submittext
	Purpose:	grab text from a form submission
	Input:		$URI	where you are submitting from
	Output:		$this->results	the text from the web page
\*======================================================================*/

	function submittext($URI, $formvars = "", $formfiles = "")
	{
		if($this->submit($URI,$formvars, $formfiles))
		{			
			if($this->lastredirectaddr)
				$URI = $this->lastredirectaddr;
			if(is_array($this->results))
			{
				for($x=0;$x<count($this->results);$x++)
				{
					$this->results[$x] = $this->_striptext($this->results[$x]);
					if($this->expandlinks)
						$this->results[$x] = $this->_expandlinks($this->results[$x],$URI);
				}
			}
			else
			{
				$this->results = $this->_striptext($this->results);
				if($this->expandlinks)
					$this->results = $this->_expandlinks($this->results,$URI);
			}
			return true;
		}
		else
			return false;
	}

	

/*======================================================================*\
	Function:	set_submit_multipart
	Purpose:	Set the form submission content type to
				multipart/form-data
\*======================================================================*/
	function set_submit_multipart()
	{
		$this->_submit_type = "multipart/form-data";
	}

	
/*======================================================================*\
	Function:	set_submit_normal
	Purpose:	Set the form submission content type to
				application/x-www-form-urlencoded
\*======================================================================*/
	function set_submit_normal()
	{
		$this->_submit_type = "application/x-www-form-urlencoded";
	}

	
	

/*======================================================================*\
	Private functions
\*======================================================================*/
	
	
/*======================================================================*\
	Function:	_striplinks
	Purpose:	strip the hyperlinks from an html document
	Input:		$document	document to strip.
	Output:		$match		an array of the links
\*======================================================================*/

	function _striplinks($document)
	{	
		preg_match_all("'<\s*a\s.*?href\s*=\s*			# find <a href=
						([\"\'])?					# find single or double quote
						(?(1) (.*?)\\1 | ([^\s\>]+))		# if quote found, match up to next matching
													# quote, otherwise match up to next space
						'isx",$document,$links);
						

		// catenate the non-empty matches from the conditional subpattern

		while(list($key,$val) = each($links[2]))
		{
			if(!empty($val))
				$match[] = $val;
		}				
		
		while(list($key,$val) = each($links[3]))
		{
			if(!empty($val))
				$match[] = $val;
		}		
		
		// return the links
		return $match;
	}

/*======================================================================*\
	Function:	_stripform
	Purpose:	strip the form elements from an html document
	Input:		$document	document to strip.
	Output:		$match		an array of the links
\*======================================================================*/

	function _stripform($document)
	{	
		preg_match_all("'<\/?(FORM|INPUT|SELECT|TEXTAREA|(OPTION))[^<>]*>(?(2)(.*(?=<\/?(option|select)[^<>]*>[\r\n]*)|(?=[\r\n]*))|(?=[\r\n]*))'Usi",$document,$elements);
		
		// catenate the matches
		$match = implode("\r\n",$elements[0]);
				
		// return the links
		return $match;
	}

	
	
/*======================================================================*\
	Function:	_striptext
	Purpose:	strip the text from an html document
	Input:		$document	document to strip.
	Output:		$text		the resulting text
\*======================================================================*/

	function _striptext($document)
	{
		
		// I didn't use preg eval (//e) since that is only available in PHP 4.0.
		// so, list your entities one by one here. I included some of the
		// more common ones.
								
		$search = array("'<script[^>]*?>.*?</script>'si",	// strip out javascript
						"'<[\/\!]*?[^<>]*?>'si",			// strip out html tags
						"'([\r\n])[\s]+'",					// strip out white space
						"'&(quot|#34|#034|#x22);'i",		// replace html entities
						"'&(amp|#38|#038|#x26);'i",			// added hexadecimal values
						"'&(lt|#60|#060|#x3c);'i",
						"'&(gt|#62|#062|#x3e);'i",
						"'&(nbsp|#160|#xa0);'i",
						"'&(iexcl|#161);'i",
						"'&(cent|#162);'i",
						"'&(pound|#163);'i",
						"'&(copy|#169);'i",
						"'&(reg|#174);'i",
						"'&(deg|#176);'i",
						"'&(#39|#039|#x27);'",
						"'&(euro|#8364);'i",				// europe
						"'&a(uml|UML);'",					// german
						"'&o(uml|UML);'",
						"'&u(uml|UML);'",
						"'&A(uml|UML);'",
						"'&O(uml|UML);'",
						"'&U(uml|UML);'",
						"'&szlig;'i",
						);
		$replace = array(	"",
							"",
							"\\1",
							"\"",
							"&",
							"<",
							">",
							" ",
							chr(161),
							chr(162),
							chr(163),
							chr(169),
							chr(174),
							chr(176),
							chr(39),
							chr(128),
							"ä",
							"ö",
							"ü",
							"Ä",
							"Ö",
							"Ü",
							"ß",
						);
					
		$text = preg_replace($search,$replace,$document);
								
		return $text;
	}

/*======================================================================*\
	Function:	_expandlinks
	Purpose:	expand each link into a fully qualified URL
	Input:		$links			the links to qualify
				$URI			the full URI to get the base from
	Output:		$expandedLinks	the expanded links
\*======================================================================*/

	function _expandlinks($links,$URI)
	{
		
		preg_match("/^[^\?]+/",$URI,$match);

		$match = preg_replace("|/[^\/\.]+\.[^\/\.]+$|","",$match[0]);
		$match = preg_replace("|/$|","",$match);
		$match_part = parse_url($match);
		$match_root =
		$match_part["scheme"]."://".$match_part["host"];
				
		$search = array( 	"|^http://".preg_quote($this->host)."|i",
							"|^(\/)|i",
							"|^(?!http://)(?!mailto:)|i",
							"|/\./|",
							"|/[^\/]+/\.\./|"
						);
						
		$replace = array(	"",
							$match_root."/",
							$match."/",
							"/",
							"/"
						);			
				
		$expandedLinks = preg_replace($search,$replace,$links);

		return $expandedLinks;
	}

/*======================================================================*\
	Function:	_httprequest
	Purpose:	go get the http data from the server
	Input:		$url		the url to fetch
				$fp			the current open file pointer
				$URI		the full URI
				$body		body contents to send if any (POST)
	Output:		
\*======================================================================*/
	
	function _httprequest($url,$fp,$URI,$http_method,$content_type="",$body="")
	{
		$cookie_headers = '';
		if($this->passcookies && $this->_redirectaddr)
			$this->setcookies();
			
		$URI_PARTS = parse_url($URI);
		if(empty($url))
			$url = "/";
		$headers = $http_method." ".$url." ".$this->_httpversion."\r\n";		
		if(!empty($this->agent))
			$headers .= "User-Agent: ".$this->agent."\r\n";
		if(!empty($this->host) && !isset($this->rawheaders['Host'])) {
			$headers .= "Host: ".$this->host;
			if(!empty($this->port))
				$headers .= ":".$this->port;
			$headers .= "\r\n";
		}
		if(!empty($this->accept))
			$headers .= "Accept: ".$this->accept."\r\n";
		if(!empty($this->referer))
			$headers .= "Referer: ".$this->referer."\r\n";
		if(!empty($this->cookies))
		{			
			if(!is_array($this->cookies))
				$this->cookies = (array)$this->cookies;
	
			reset($this->cookies);
			if ( count($this->cookies) > 0 ) {
				$cookie_headers .= 'Cookie: ';
				foreach ( $this->cookies as $cookieKey => $cookieVal ) {
				$cookie_headers .= $cookieKey."=".urlencode($cookieVal)."; ";
				}
				$headers .= substr($cookie_headers,0,-2) . "\r\n";
			} 
		}
		if(!empty($this->rawheaders))
		{
			if(!is_array($this->rawheaders))
				$this->rawheaders = (array)$this->rawheaders;
			while(list($headerKey,$headerVal) = each($this->rawheaders))
				$headers .= $headerKey.": ".$headerVal."\r\n";
		}
		if(!empty($content_type)) {
			$headers .= "Content-type: $content_type";
			if ($content_type == "multipart/form-data")
				$headers .= "; boundary=".$this->_mime_boundary;
			$headers .= "\r\n";
		}
		if(!empty($body))	
			$headers .= "Content-length: ".strlen($body)."\r\n";
		if(!empty($this->user) || !empty($this->pass))	
			$headers .= "Authorization: Basic ".base64_encode($this->user.":".$this->pass)."\r\n";
		
		//add proxy auth headers
		if(!empty($this->proxy_user))	
			$headers .= 'Proxy-Authorization: ' . 'Basic ' . base64_encode($this->proxy_user . ':' . $this->proxy_pass)."\r\n";


		$headers .= "\r\n";
		
		// set the read timeout if needed
		if ($this->read_timeout > 0)
			socket_set_timeout($fp, $this->read_timeout);
		$this->timed_out = false;
		
		fwrite($fp,$headers.$body,strlen($headers.$body));
		
		$this->_redirectaddr = false;
		unset($this->headers);
						
		while($currentHeader = fgets($fp,$this->_maxlinelen))
		{
			if ($this->read_timeout > 0 && $this->_check_timeout($fp))
			{
				$this->status=-100;
				return false;
			}
				
			if($currentHeader == "\r\n")
				break;
						
			// if a header begins with Location: or URI:, set the redirect
			if(preg_match("/^(Location:|URI:)/i",$currentHeader))
			{
				// get URL portion of the redirect
				preg_match("/^(Location:|URI:)[ ]+(.*)/i",chop($currentHeader),$matches);
				// look for :// in the Location header to see if hostname is included
				if(!preg_match("|\:\/\/|",$matches[2]))
				{
					// no host in the path, so prepend
					$this->_redirectaddr = $URI_PARTS["scheme"]."://".$this->host.":".$this->port;
					// eliminate double slash
					if(!preg_match("|^/|",$matches[2]))
							$this->_redirectaddr .= "/".$matches[2];
					else
							$this->_redirectaddr .= $matches[2];
				}
				else
					$this->_redirectaddr = $matches[2];
			}
		
			if(preg_match("|^HTTP/|",$currentHeader))
			{
                if(preg_match("|^HTTP/[^\s]*\s(.*?)\s|",$currentHeader, $status))
				{
					$this->status= $status[1];
                }				
				$this->response_code = $currentHeader;
			}
				
			$this->headers[] = $currentHeader;
		}

		$results = '';
		do {
    		$_data = fread($fp, $this->maxlength);
    		if (strlen($_data) == 0) {
        		break;
    		}
    		$results .= $_data;
		} while(true);

		if ($this->read_timeout > 0 && $this->_check_timeout($fp))
		{
			$this->status=-100;
			return false;
		}
		
		// check if there is a a redirect meta tag

		
		if(preg_match("'<meta[\s]*http-equiv[^>]*?content[\s]*=[\s]*[\"\']?\d+;[\s]*URL[\s]*=[\s]*([^\"\']*?)[\"\']?>'i",$results,$match))

		{
			$this->_redirectaddr = $this->_expandlinks($match[1],$URI);	
		}

		// have we hit our frame depth and is there frame src to fetch?
		if(($this->_framedepth < $this->maxframes) && preg_match_all("'<frame\s+.*src[\s]*=[\'\"]?([^\'\"\>]+)'i",$results,$match))
		{
			$this->results[] = $results;
			for($x=0; $x<count($match[1]); $x++)
				$this->_frameurls[] = $this->_expandlinks($match[1][$x],$URI_PARTS["scheme"]."://".$this->host);
		}
		// have we already fetched framed content?
		elseif(is_array($this->results))
			$this->results[] = $results;
		// no framed content
		else
			$this->results = $results;
		
		return true;
	}

/*======================================================================*\
	Function:	_httpsrequest
	Purpose:	go get the https data from the server using curl
	Input:		$url		the url to fetch
				$URI		the full URI
				$body		body contents to send if any (POST)
	Output:		
\*======================================================================*/
	
	function _httpsrequest($url,$URI,$http_method,$content_type="",$body="")
	{
		if($this->passcookies && $this->_redirectaddr)
			$this->setcookies();

		$headers = array();		
					
		$URI_PARTS = parse_url($URI);
		if(empty($url))
			$url = "/";
		// GET ... header not needed for curl
		//$headers[] = $http_method." ".$url." ".$this->_httpversion;		
		if(!empty($this->agent))
			$headers[] = "User-Agent: ".$this->agent;
		if(!empty($this->host))
			if(!empty($this->port))
				$headers[] = "Host: ".$this->host.":".$this->port;
			else
				$headers[] = "Host: ".$this->host;
		if(!empty($this->accept))
			$headers[] = "Accept: ".$this->accept;
		if(!empty($this->referer))
			$headers[] = "Referer: ".$this->referer;
		if(!empty($this->cookies))
		{			
			if(!is_array($this->cookies))
				$this->cookies = (array)$this->cookies;
	
			reset($this->cookies);
			if ( count($this->cookies) > 0 ) {
				$cookie_str = 'Cookie: ';
				foreach ( $this->cookies as $cookieKey => $cookieVal ) {
				$cookie_str .= $cookieKey."=".urlencode($cookieVal)."; ";
				}
				$headers[] = substr($cookie_str,0,-2);
			}
		}
		if(!empty($this->rawheaders))
		{
			if(!is_array($this->rawheaders))
				$this->rawheaders = (array)$this->rawheaders;
			while(list($headerKey,$headerVal) = each($this->rawheaders))
				$headers[] = $headerKey.": ".$headerVal;
		}
		if(!empty($content_type)) {
			if ($content_type == "multipart/form-data")
				$headers[] = "Content-type: $content_type; boundary=".$this->_mime_boundary;
			else
				$headers[] = "Content-type: $content_type";
		}
		if(!empty($body))	
			$headers[] = "Content-length: ".strlen($body);
		if(!empty($this->user) || !empty($this->pass))	
			$headers[] = "Authorization: BASIC ".base64_encode($this->user.":".$this->pass);
			
		for($curr_header = 0; $curr_header < count($headers); $curr_header++) {
			$safer_header = strtr( $headers[$curr_header], "\"", " " );
			$cmdline_params .= " -H \"".$safer_header."\"";
		}
		
		if(!empty($body))
			$cmdline_params .= " -d \"$body\"";
		
		if($this->read_timeout > 0)
			$cmdline_params .= " -m ".$this->read_timeout;
		
		$headerfile = tempnam($temp_dir, "sno");

		$safer_URI = strtr( $URI, "\"", " " ); // strip quotes from the URI to avoid shell access
		exec($this->curl_path." -D \"$headerfile\"".$cmdline_params." \"".$safer_URI."\"",$results,$return);
		
		if($return)
		{
			$this->error = "Error: cURL could not retrieve the document, error $return.";
			return false;
		}
			
			
		$results = implode("\r\n",$results);
		
		$result_headers = file("$headerfile");
						
		$this->_redirectaddr = false;
		unset($this->headers);
						
		for($currentHeader = 0; $currentHeader < count($result_headers); $currentHeader++)
		{
			
			// if a header begins with Location: or URI:, set the redirect
			if(preg_match("/^(Location: |URI: )/i",$result_headers[$currentHeader]))
			{
				// get URL portion of the redirect
				preg_match("/^(Location: |URI:)\s+(.*)/",chop($result_headers[$currentHeader]),$matches);
				// look for :// in the Location header to see if hostname is included
				if(!preg_match("|\:\/\/|",$matches[2]))
				{
					// no host in the path, so prepend
					$this->_redirectaddr = $URI_PARTS["scheme"]."://".$this->host.":".$this->port;
					// eliminate double slash
					if(!preg_match("|^/|",$matches[2]))
							$this->_redirectaddr .= "/".$matches[2];
					else
							$this->_redirectaddr .= $matches[2];
				}
				else
					$this->_redirectaddr = $matches[2];
			}
		
			if(preg_match("|^HTTP/|",$result_headers[$currentHeader]))
				$this->response_code = $result_headers[$currentHeader];

			$this->headers[] = $result_headers[$currentHeader];
		}

		// check if there is a a redirect meta tag
		
		if(preg_match("'<meta[\s]*http-equiv[^>]*?content[\s]*=[\s]*[\"\']?\d+;[\s]*URL[\s]*=[\s]*([^\"\']*?)[\"\']?>'i",$results,$match))
		{
			$this->_redirectaddr = $this->_expandlinks($match[1],$URI);	
		}

		// have we hit our frame depth and is there frame src to fetch?
		if(($this->_framedepth < $this->maxframes) && preg_match_all("'<frame\s+.*src[\s]*=[\'\"]?([^\'\"\>]+)'i",$results,$match))
		{
			$this->results[] = $results;
			for($x=0; $x<count($match[1]); $x++)
				$this->_frameurls[] = $this->_expandlinks($match[1][$x],$URI_PARTS["scheme"]."://".$this->host);
		}
		// have we already fetched framed content?
		elseif(is_array($this->results))
			$this->results[] = $results;
		// no framed content
		else
			$this->results = $results;

		unlink("$headerfile");
		
		return true;
	}

/*======================================================================*\
	Function:	setcookies()
	Purpose:	set cookies for a redirection
\*======================================================================*/
	
	function setcookies()
	{
		for($x=0; $x<count($this->headers); $x++)
		{
		if(preg_match('/^set-cookie:[\s]+([^=]+)=([^;]+)/i', $this->headers[$x],$match))
			$this->cookies[$match[1]] = urldecode($match[2]);
		}
	}

	
/*======================================================================*\
	Function:	_check_timeout
	Purpose:	checks whether timeout has occurred
	Input:		$fp	file pointer
\*======================================================================*/

	function _check_timeout($fp)
	{
		if ($this->read_timeout > 0) {
			$fp_status = socket_get_status($fp);
			if ($fp_status["timed_out"]) {
				$this->timed_out = true;
				return true;
			}
		}
		return false;
	}

/*======================================================================*\
	Function:	_connect
	Purpose:	make a socket connection
	Input:		$fp	file pointer
\*======================================================================*/
	
	function _connect(&$fp)
	{
		if(!empty($this->proxy_host) && !empty($this->proxy_port))
			{
				$this->_isproxy = true;
				
				$host = $this->proxy_host;
				$port = $this->proxy_port;
			}
		else
		{
			$host = $this->host;
			$port = $this->port;
		}
	
		$this->status = 0;
		
		if($fp = fsockopen(
					$host,
					$port,
					$errno,
					$errstr,
					$this->_fp_timeout
					))
		{
			// socket connection succeeded

			return true;
		}
		else
		{
			// socket connection failed
			$this->status = $errno;
			switch($errno)
			{
				case -3:
					$this->error="socket creation failed (-3)";
				case -4:
					$this->error="dns lookup failure (-4)";
				case -5:
					$this->error="connection refused or timed out (-5)";
				default:
					$this->error="connection failed (".$errno.")";
			}
			return false;
		}
	}
/*======================================================================*\
	Function:	_disconnect
	Purpose:	disconnect a socket connection
	Input:		$fp	file pointer
\*======================================================================*/
	
	function _disconnect($fp)
	{
		return(fclose($fp));
	}

	
/*======================================================================*\
	Function:	_prepare_post_body
	Purpose:	Prepare post body according to encoding type
	Input:		$formvars  - form variables
				$formfiles - form upload files
	Output:		post body
\*======================================================================*/
	
	function _prepare_post_body($formvars, $formfiles)
	{
		settype($formvars, "array");
		settype($formfiles, "array");
		$postdata = '';

		if (count($formvars) == 0 && count($formfiles) == 0)
			return;
		
		switch ($this->_submit_type) {
			case "application/x-www-form-urlencoded":
				reset($formvars);
				while(list($key,$val) = each($formvars)) {
					if (is_array($val) || is_object($val)) {
						while (list($cur_key, $cur_val) = each($val)) {
							$postdata .= urlencode($key)."[]=".urlencode($cur_val)."&";
						}
					} else
						$postdata .= urlencode($key)."=".urlencode($val)."&";
				}
				break;

			case "multipart/form-data":
				$this->_mime_boundary = "Snoopy".md5(uniqid(microtime()));
				
				reset($formvars);
				while(list($key,$val) = each($formvars)) {
					if (is_array($val) || is_object($val)) {
						while (list($cur_key, $cur_val) = each($val)) {
							$postdata .= "--".$this->_mime_boundary."\r\n";
							$postdata .= "Content-Disposition: form-data; name=\"$key\[\]\"\r\n\r\n";
							$postdata .= "$cur_val\r\n";
						}
					} else {
						$postdata .= "--".$this->_mime_boundary."\r\n";
						$postdata .= "Content-Disposition: form-data; name=\"$key\"\r\n\r\n";
						$postdata .= "$val\r\n";
					}
				}
				
				reset($formfiles);
				while (list($field_name, $file_names) = each($formfiles)) {
					settype($file_names, "array");
					while (list(, $file_name) = each($file_names)) {
						if (!is_readable($file_name)) continue;

						$fp = fopen($file_name, "r");
						$file_content = fread($fp, filesize($file_name));
						fclose($fp);
						$base_name = basename($file_name);

						$postdata .= "--".$this->_mime_boundary."\r\n";
						$postdata .= "Content-Disposition: form-data; name=\"$field_name\"; filename=\"$base_name\"\r\n\r\n";
						$postdata .= "$file_content\r\n";
					}
				}
				$postdata .= "--".$this->_mime_boundary."--\r\n";
				break;
		}

		return $postdata;
	}
}

?>

<?php

/*
htmlSQL - version 0.5
--------------------------------------------------------------------
htmlSQL is a experimental class to query websites or HTML code with 
an SQL-like language.

AUTHOR: Jonas John (http://www.jonasjohn.de/)

The latest version of htmlSQL can be obtained from:
http://www.jonasjohn.de/lab/htmlsql.htm

LICENSE:
--------------------------------------------------------------------
Copyright (c) 2006 Jonas John. All rights reserved.
--------------------------------------------------------------------
Redistribution and use in source and binary forms, with or without 
modification, are permitted provided that the following conditions 
are met:

- Redistributions of source code must retain the above copyright 
  notice, this list of conditions and the following disclaimer.
- Redistributions in binary form must reproduce the above copyright 
  notice, this list of conditions and the following disclaimer in 
  the documentation and/or other materials provided with the distribution.
- Neither the name of Jonas John nor the names of its contributors 
  may be used to endorse or promote products derived from this 
  software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS 
"AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS 
FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE 
COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, 
INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, 
BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS 
OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND 
ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR 
TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE 
USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
    
--------------------------------------------------------------------

CHANGELOG:

0.4 -> 0.5 (May 07, 2006):
- Renamed the project from webSQL to htmlSQL, because webSQL
  is already existing... :-(
- Added some error checks and error messages 
- Added the convert_tagname_to_key function and
  fixed a few issues

0.1 -> 0.4 (April 2006):
- Created main parts of the class
    
*/

class htmlsql {

    // configuration:

    // htmlSQL version:
    var $version = '0.5';

    // referer and user agent:
    var $referer = '';
    var $user_agent = 'htmlSQL/0.5';
    
    
    
    // these are filled on runtime:
    // (don't touch them)
    
    // holds snoopy object:
    var $snoopy = NULL;
    
    // the results array is stored in here:
    var $results = array();
    
    // the results objects are stored in here:
    var $results_objects = NULL;

    // the error message gets stored in here:
    var $error = '';
    
    // the downloaded page is stored in here:
    var $page = '';
    
    
    /*
    ** init_snoopy
    **
    ** initializes the snoopy class
    */
    
    function init_snoopy(){
        $this->snoopy = new Snoopy();
        $this->snoopy->agent = $this->user_agent;
        $this->snoopy->referer = $this->referer;
    }
    
    
    /*
    ** set_user_agent
    **
    ** set a custom user agent
    */
    
    function set_user_agent($u){ 
        $this->user_agent = $u;
    }
    
    
    
    /*
    ** set_referer
    **
    ** sets the referer
    */
    
    function set_referer($r){ 
        $this->referer = $r;
    }
    
    
    /*
    ** _get_between
    **
    ** returns the content between $start and $end
    */
    
    function _get_between($content,$start,$end){
        $r = explode($start, $content);
        if (isset($r[1])){
            $r = explode($end, $r[1]);
            return $r[0];
        }
        return '';
    }
    
    
    /*
    ** connect
    **
    ** connects to a data source (url, file or string)
    */
    
    function connect($type, $resource){        
        if ($type == 'url'){ 
            return $this->_fetch_url($resource);
        }
        else if ($type == 'file') { 
            if (!file_exists($resource)){ 
                $this->error = 'The given file "'.$resource.' does not exist!';
                return false;
            }
            $this->page = file_get_contents($resource); return true;
        }
        else if ($type == 'string') { $this->page = $resource; return true; }
        
        return false;
    }
    
    
    /*
    ** _fetch_url
    **
    ** downloads the given URL with snoopy
    */
    
    function _fetch_url($url){
    
        $parsed_url = parse_url($url);
        
        if (!isset($parsed_url['scheme']) or $parsed_url['scheme'] != 'http'){ 
            $this->error = 'Unsupported URL sheme given, please just use "HTTP".';
            return false;
        }
        if (!isset($parsed_url['host']) or $parsed_url['host'] == ''){ 
            $this->error = 'Invalid URL given!';
            return false;
        }
        
        $host = $parsed_url['host'];
        $host .= (isset($parsed_url['port']) and  !empty($parsed_url['port'])) ? ':'.$parsed_url['port'] : '';
        $path = (isset($parsed_url['path']) and  !empty($parsed_url['path'])) ? $parsed_url['path'] : '/';
        $path .= (isset($parsed_url['query']) and  !empty($parsed_url['query'])) ? '?'.$parsed_url['query'] : '';
        
        $url = 'http://' . $host . $path;
    
        $this->init_snoopy();
        
        if($this->snoopy->fetch($url)){
        
            $this->page = $this->snoopy->results;
            
            // empty buffer:
            $this->snoopy->results = '';                
        }
        else {
            $this->error = 'Could not establish a connection to the given URL!';
            return false;
        }            
        return true;        
    }
    
    
    /*
    ** _extract_all_tags
    **
    ** 
    */
    
    function _extract_all_tags($html, &$tag_names, &$tag_attributes, &$tag_values, $depth=0){
        
        // stop endless loops:
        if ($depth > 99999){ return; }
        
        preg_match_all('/<([a-z0-9\-]+)(.*?)>((.*?)<\/\1>)?/is', $html, $m);
        if (count($m[0]) != 0){
            for ($t=0; $t < count($m[0]); $t++){
            
                $tag_names[] = trim($m[1][$t]);
                $tag_attributes[] = trim($m[2][$t]);
                $tag_values[] = trim($m[4][$t]);
                
                // go deeper:
                if (trim($m[4][$t]) != '' and preg_match('/<[a-z0-9\-]+.*?>/is', $m[4][$t])){
                    $this->_extract_all_tags($m[4][$t], $tag_names, $tag_attributes, $tag_values, $depth+1);
                }
                
            }
        }
        
    }
    
    
    /*
    ** isolate_content
    **
    ** isolates the content to a specific part
    */
    
    function isolate_content($start,$end){
    
        $this->page = $this->_get_between($this->page, $start, $end);
    
    }
    

    /*
    ** select
    **
    ** restricts the content of a specific tag
    */
    
    function select($tagname, $num=0){        
        $num++;
    
        if ($tagname != ''){
        
            preg_match('/<'.$tagname.'.*?>(.*?)<\/'.$tagname.'>/is', $this->page, $m);
        
            if (isset($m[$num]) and !empty($m[$num])){ 
                $this->page = $m[$num];
            } 
            else {
                $this->error = 'Could not select tag: "'.$tagname.'('.$num.')"!';
                return false;
            }                
        }
        return true;        
    }
    
    
    /*
    ** get_content
    **
    ** returns the content of an request
    */
    
    function get_content(){ 
        return $this->page;
    }
    
    
    /*
    ** _clean_array
    **
    ** 
    */
    
    function _clean_array($arr){
        $new = array();
        for ($x=0; $x < count($arr); $x++){
            $arr[$x] = trim($arr[$x]);
            if ($arr[$x] != ''){ $new[] = $arr[$x]; }
        }
        return $new;
    }
    
    
     /*
    ** _test_tag
    **
    ** 
    */
    
    function _test_tag($tag_attributes, $if_term){
    
        preg_match_all('/\$([a-z0-9_\-]+)/i', $if_term, $m);
        if (isset($m[1])){
            for ($x=0; $x < count($m[1]); $x++){
                $varname = $m[1][$x];
                $$varname = '';
            }
        }
        
        $new_list = array();
        while (list($k,$v) = each($tag_attributes)){
            $k = preg_replace('/[^a-z0-9_\-]/i', '', $k);
            if ($k != ''){ $new_list[$k] = $v; }
        }
        unset($tag_attributes);
        
        extract($new_list);    
        
        $r = false;            
        if (@eval('$r = ('.$if_term.');') === false){
            $this->error = 'The WHERE statement is invalid (eval() failed)!';
            return false;
        }
        
        return $r;
    
    }
    
    
    /*
    ** _match_tags
    **
    ** 
    */
    
    function _match_tags(&$results, &$return_values, &$where_term, &$tag_attributes, &$tag_values, &$tag_names){
    
        $search_mode = ''; $search_attribute = ''; $search_term = '';
        
        /*
        ** parse:
        ** 
        ** href LIKE ".htm"
        ** class = "foo"
        */
        
        $where_term = trim($where_term);

        $search_mode = ($where_term == '') ? 'match_all' : 'eval';

        for ($x=0; $x < count($tag_attributes); $x++){
        
            $tag_attributes[$x] = $this->parse_attributes($tag_attributes[$x]);
            
            if (is_array($tag_names)){ 
                $tag_attributes[$x]['tagname'] = isset($tag_names[$x]) ? $tag_names[$x] : '';
            } 
            else { $tag_attributes[$x]['tagname'] = $tag_names; } // string
            
            $tag_attributes[$x]['text'] = isset($tag_values[$x]) ? $tag_values[$x] : '';

            if ($search_mode == 'eval'){
            
                if ($this->_test_tag($tag_attributes[$x], $where_term)){
                    $this->_add_result($results, $return_values, $tag_attributes[$x]);
                }                   
            
            }
            else if ($search_mode == 'match_all'){
                $this->_add_result($results, $return_values, $tag_attributes[$x]);
            }
        }
    }
    
    
    /*
    ** query
    **
    ** performs a query
    */
    
    function query($term){
    
        // query results are stored in here:
        $results = array();
        $this->results = NULL;
        $this->results_objects = NULL;
    
        $term = trim($term);
        if ($term == ''){
            $this->error = 'Empty query given!';
            return false;
        }
        
        // match query:
        preg_match('/^SELECT (.*?) FROM (.*)$/i', $term, $m);
        
        // parse returns values
        // SELECT * FROM ...
        // SELECT foo,bar FROM ...
        $return_values = isset($m[1]) ? trim($m[1]) : '*';
        if ($return_values != '*'){ 
            $return_values = explode(',', strtolower($return_values));
            $return_values = $this->_clean_array($return_values);                
        }
        
        // match from and where part:
        //
        // ... FROM * WHERE $id=="one"
        // ... FROM a WHERE $class=="red"
        // ... FROM a 
        // ... FROM *
        $last = isset($m[2]) ? trim($m[2]) : '';
        
        $search_term = '';
        $where_term = '';
        
        if (preg_match('/^(.*?) WHERE (.*?)$/i', $last, $m)){
            $search_term = trim($m[1]);
            $where_term = trim($m[2]);
        }
        else {
            $search_term = $last;
        }
        
        /*
        ** find tags:
        */

        if ($search_term == '*'){

            // search all

            $tag_names = array();
            $tag_attributes = array();
            $tag_values = array();

            $html = $this->page;
            
            $this->_extract_all_tags($html, $tag_names, $tag_attributes, $tag_values);
            
            $this->_match_tags($results, $return_values, $where_term, $tag_attributes, $tag_values, $tag_names);
            
        }
        else {
        
            // search term is a tag
                        
            $tagname = trim($search_term);
        
            $tag_attributes = array();
            $tag_values = array();

            $regexp = '<'.$tagname.'([ \t].*?|)>((.*?)<\/'.$tagname.'>)?';
            preg_match_all('/'.$regexp.'/is', $this->page, $m);
            
            if (count($m[0]) != 0){
                $tag_attributes = $m[1];
                $tag_values = $m[3];
            }
            
            $this->_match_tags($results, $return_values, $where_term, $tag_attributes, $tag_values, $tagname);
        }
       
        $this->results = $results;
        
        // was there a error during the search process?
        if ($this->error != ''){
            return false;
        }
                    
        return true;
    
    }
    
    /*
    ** convert_tagname_to_key
    **
    ** converts the tagname to the array key
    */
    
    function convert_tagname_to_key(){
            
        $new_array = array();
    
        while(list($key,$val) = each($this->results)){
            
            if (isset($val['tagname'])){
                $tag_name = $val['tagname'];
                unset($val['tagname']);
            } 
            else { $tag_name = '(empty)'; }
           
            $new_array[$tag_name] = $val;
                
        }
    
        $this->results = $new_array;
    }
    
    
    /*
    ** fetch_array
    **
    ** returns the results as an array
    */
    
    function fetch_array(){
        return $this->results;
    }
    
    
    /*
    ** _array2object
    **
    ** converts an array to an object
    */
    
    function _array2object($array) {

        if (is_array($array)) {
        
            $obj = new StdClass();
        
            foreach ($array as $key => $val){        
                $obj->$key = $val;
            }
        
        }
        else { $obj = $array; }
        
        return $obj;
    }
    
    
    /*
    ** fetch_objects
    **
    ** returns the results as objects
    */
    
    function fetch_objects(){
        
        if ($this->results_objects == NULL){
        
            $results = array();
            
            reset($this->results);
            while(list($key,$val) = each($this->results)){
                $results[$key] = $this->_array2object($val);
            }
        
            $this->results_objects = $results;
            
            return $this->results_objects;
        }
        else {
            return $this->results_objects;
        }
    }
    
    /*
    ** get_result_count
    **
    ** returns the number of results
    */
    
    function get_result_count(){
        return count($this->results);
    }
    
    
    /*
    ** _add_result
    **
    ** 
    */
    
    function _add_result(&$results, $return_values, $tag_attributes){

        if ($return_values == '*'){
            $results[] = $tag_attributes;
        }
        else if (is_array($return_values)){
        
            $new_result = array(); 
            
            reset($return_values);
            for ($t=0; $t < count($return_values); $t++){
            
                $_tagname = explode(' as ', $return_values[$t]);
                $_caption = $return_values[$t];
                
                if (count($_tagname) != 1){ 
                    $_caption = trim($_tagname[1]);
                    $_tagname = trim($_tagname[0]);
                }
                else { $_tagname = $_caption; }

                $new_result[$_caption] = isset($tag_attributes[$_tagname]) ? $tag_attributes[$_tagname] : '';
            }
            $results[] = $new_result;
        }
    }
    
    
    /*
    ** parse_attributes
    **
    ** parses HTML attributes and returns an array
    */
    
    function parse_attributes($attrib){
        
        $attrib .= '>';
        
        $mode = 'search_key';
        $tmp = ''; 
        $current_key = '';
        
        $attributes = array();
        
        for ($x=0; $x < strlen($attrib); $x++){
        
            $char = $attrib[$x];
            
            if ($char == '=' and $mode == 'search_key'){
                $current_key = trim($tmp);
                $tmp = '';
                $mode = 'value';
            }
            else if ($mode == 'search_key' and preg_match('/[ \t\s\r\n>]/', $char)){ 
                $current_key = strtolower(trim($tmp));
                if ($current_key != ''){ $attributes[$current_key] = ''; }
                $tmp = ''; $current_key = '';
            }
            else if ($mode == 'value' and $char == '"'){ $mode = 'find_value_ending_a'; }
            else if ($mode == 'value' and $char == '\''){ $mode = 'find_value_ending_b'; }
            else if ($mode == 'value'){ $tmp .= $char; $mode = 'find_value_ending_c'; }
            else if (
                ($mode == 'find_value_ending_a' and $char == '"') or 
                ($mode == 'find_value_ending_b' and $char == '\'') or 
                ($mode == 'find_value_ending_c' and preg_match('/[ \t\s\r\n>]/', $char))
            ){ 
                
                $mode = 'search_key';
                
                if ($current_key != ''){
                    $current_key = strtolower($current_key);
                    $attributes[$current_key] = $tmp;
                }
                $tmp = '';
            }
            else { $tmp .= $char; }                
        }
        
        if ($mode != 'search_key' and $current_key != ''){ 
            $current_key = strtolower($current_key);
            $attributes[$current_key] = trim(preg_replace('/>+$/', '', $tmp));
        }
    
        return $attributes;
    
    }

}
    
?>


<?php


    $wsql = new htmlsql();

    // set a individual agent:
    //$wsql->set_user_agent('MyAgentName/0.9');

    // set a new referer:
    $wsql->set_referer('ya-mujeeb.com');


    // connect to a URL
    if (!$wsql->connect('url', $_GET['url'])){
        print 'Error while connecting: ' . $wsql->error;
        exit;
    }

    /* execute a query:

       This query returns all links:
    */
    if (!$wsql->query('SELECT src FROM img')){
        print "Query error: " . $wsql->error;
        exit;
    }
	echo count($wsql->fetch_array());
    // fetch results as array
    foreach($wsql->fetch_array() as $row){

        print_r($row);

    }
}
?>
<form method="post" action="getimages.php">
<input type="text" name="url" size="100" />
<input type="submit" value="submit" />
</form>
