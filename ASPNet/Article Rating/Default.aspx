<%@ Page Language="C#" AutoEventWireup="true"  CodeFile="Default.aspx.cs" Inherits="_Default" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>AJAX Star Rating</title>
<style type="text/css">
#star ul.star { LIST-STYLE: none; MARGIN: 0; PADDING: 0; WIDTH: 85px; HEIGHT: 20px; LEFT: 10px; TOP: -5px; POSITION: relative; FLOAT: left; BACKGROUND: url('media/stars.gif') repeat-x; CURSOR: pointer; }
#star li { PADDING: 0; MARGIN: 0; FLOAT: left; DISPLAY: block; WIDTH: 85px; HEIGHT: 20px; TEXT-DECORATION: none; text-indent: -9000px; Z-INDEX: 20; POSITION: absolute; PADDING: 0; }
#star li.curr { BACKGROUND: url('media/stars.gif') left 25px; FONT-SIZE: 1px; }
#star div.user { LEFT: 15px; POSITION: relative; FLOAT: left; FONT-SIZE: 13px; FONT-FAMILY: Arial; COLOR: #888; }
</style>
<script type="text/javascript">

/* AJAX Star Rating : v1.0.3 : 2008/05/06 */
/* http://www.nofunc.com/AJAX_Star_Rating/ */

var already_voted = 0;

function $(v,o) { return((typeof(o)=='object'?o:document).getElementById(v)); }
function $S(o) { return((typeof(o)=='object'?o:$(o)).style); }
function agent(v) { return(Math.max(navigator.userAgent.toLowerCase().indexOf(v),0)); }
function abPos(o) { var o=(typeof(o)=='object'?o:$(o)), z={X:0,Y:0}; while(o!=null) { z.X+=o.offsetLeft; z.Y+=o.offsetTop; o=o.offsetParent; }; return(z); }
function XY(e,v) { var o=agent('msie')?{'X':event.clientX+document.body.scrollLeft,'Y':event.clientY+document.body.scrollTop}:{'X':e.pageX,'Y':e.pageY}; return(v?o[v]:o); }

star={};

star.mouse=function(e,o) {
    if (star.already_voted == 0)
    { 
        if(star.stop || isNaN(star.stop)) 
        { 
            star.stop=0;
	        document.onmousemove=function(e) 
	        { 
	            var n=star.num;
	    	    var p=abPos($('star'+n)), x=XY(e), oX=x.X-p.X, oY=x.Y-p.Y; star.num=o.id.substr(4);
    		    if(oX<1 || oX>84 || oY<0 || oY>19) 
    		    { 
    		        star.stop=1; 
    		        star.revert();  	
    		    } else {

			        $S('starCur'+n).width=oX+'px';
			        $S('starUser'+n).color='#111';
			        $('starUser'+n).innerHTML=Math.round(oX/84*100)+'%';
		        }
	        };
        }
    } else {
        document.onmousemove=function(e) {};
    } 
};

star.update=function(e,o) { 
if (star.already_voted == 0) {
var n=star.num;
alert(parseInt($('starUser'+n).innerHTML));
                            var v=parseInt($('starUser'+n).innerHTML);

	n=o.id.substr(4); $('starCur'+n).title=v;
	req=new XMLHttpRequest(); req.open('GET','/ajaxrating/default.aspx?blogid=123&postid=999&userid=234&vote='+(v),false); req.send(null);
	alert("Thankyou for your vote");
	star.already_voted = 1;
}};

star.revert=function() { if (star.already_voted == 0) { var n=star.num, v=parseInt($('starCur'+n).title);

	$S('starCur'+n).width=Math.round(v*84/100)+'px';
	$('starUser'+n).innerHTML=(v>0?Math.round(v)+'%':'');
	$('starUser'+n).style.color='#888';
	
	document.onmousemove='';

}};

star.num=0;
star.already_voted = 0;

</script>
</head>
<body>
<div id="star">
 <ul id="star0" class="star" onmousedown="star.update(event,this)" onmousemove="star.mouse(event,this)" title="Rate This!">
  <li id="starCur0" class="curr" title="<%=percentage %>" style="width: <%=width %>px;"></li>
 </ul>
 <div style="color: rgb(136, 136, 136);" id="starUser0" class="user"><%=percentage %>%</div>

</body>
</html>