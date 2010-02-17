/*WP Ajax Edit Script
--Created by Ronald Huereca
--Created on: 03/28/2007
--Last modified on: 10/25/2008
--Relies on jQuery, wp-ajax-response, thickbox
	Copyright 2007,2008  Ronald Huereca  (email : ron alfy [a t ] g m ail DOT com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/
jQuery(document).ready(function() {
var $ = jQuery;
$.ajaxeditcomments = {
	init: function() { $.extend($.ajaxeditcomments.vars, { timers: {}, timerObjs: {}}); initialize_links(); },
	delink: function(obj) { _delink($(obj));},
	edit: function(obj) { _edit($(obj));},
	approve: function(obj) { _approve($(obj));},
	spam: function(obj) { _spam($(obj));},
	moderate: function(obj) { _moderate($(obj));},
	delete_comment: function(obj) { _delete_comment($(obj));},
	update_comment: function(id, content) {
  	$("#" + id).html(content);
	},
	update_author: function(id, author, url) {
		if ( url == '' || 'http://' == url ) {
			if (author == '') { $("#" + id).html(wpajaxeditcomments.AEC_Anon); return; }
			$("#" + id).html(author);
		} else if (author == '') {
			$("#" + id).html(wpajaxeditcomments.AEC_Anon);
		} else {
			$("#" + id).html("<a href='" + url + "'>" + author + "</a>");
		}
	},
	vars: {}
};
	var vars = $.ajaxeditcomments.vars;
	//Initializes the edit links
	function initialize_links() {
  	//Leave the style in for Safari
  	$(".edit-comment-admin-links").attr("style", "display: block");
    $(".edit-comment-user-link").attr("style", "display: block");
    /* For Crappy IE */
    $(".edit-comment-admin-links").show();
    $(".edit-comment-user-link").show();
    if (wpajaxeditcomments.AEC_CanScroll == "1") {
      var location = "" + window.location;
      var pattern = /(#[^-]*\-[^&]*)/;
      if (pattern.test(location)) {
        location = $("" + window.location.hash);
        var targetOffset = location.offset().top;
        $('html,body').animate({scrollTop: targetOffset}, 1000);
      }
    }
   get_time_left();
  }
	//Finds an area (if applicable) and displays the time left to comment
  function get_time_left() {
  	$("." + 'ajax-edit-time-left').each(function() { 
    	data = pre_process($(this).prev());
    	data.data = $.extend({ action: 'gettimeleft', cid: data.cid,pid:data.pid, _ajax_nonce: data.nonce },'');
    	data.action = 'gettimeleft';
    	data.success = function(r) {
      	var res = wpAjax.parseAjaxResponse(r, data.response,data.element);
        jQuery.each( res.responses, function() {
        	if (this.what == "error" || this.what == "success") {
          	return;
          }
        	if (this.what == "minutes") {
          	minutes = parseInt(this.data);
          }
          if (this.what == "seconds") {
          	seconds = parseInt(this.data);
          }
        });
        cid = data.cid;
        element = $("#ajax-edit-time-left-" + data.cid);
        data.timer = $.extend({minutes: minutes, seconds: seconds, cid: data.cid, element: element},'');
        vars.timerObjs[data.cid] = data;
        vars.timers[data.cid] = setTimeout(function() {get_time_left_timer(data.timer) }, 1000);
      }
			$.ajax(data);
    	return;
    })
  }
	//Updates the UI with the correct time left to edit
  //Parameters - timer (obj with timer data)
  function get_time_left_timer(timer) {
  	clearTimeout(vars.timers[timer.cid]);
    seconds = timer.seconds - 1;
    minutes = timer.minutes;
    element = timer.element;
    //Check to see if the time has run out
		if (minutes <=0 && seconds <= 0) { 
			$("#edit" + timer.cid).unbind();
      element.remove();
      $("#edit-comment-user-link-" + timer.cid).remove();
      tb_remove(); //for iframe
      clearTimeout(vars.timers[timer.cid]);
			return;
		} 
		if (seconds < 0) { minutes -= 1; seconds = 59; }
    //Create timer text
		var text = "";
		if (minutes >= 1) {
			if (minutes >= 2) { text = minutes + " " + wpajaxeditcomments.AEC_Minutes; } else { text = minutes + " " + wpajaxeditcomments.AEC_Minute; }
			if (seconds > 0) { text += " " + wpajaxeditcomments.AEC_And + " "; }
		}
		if (seconds > 0) {
			if (seconds >= 2) { text += seconds + " " + wpajaxeditcomments.AEC_Seconds; } else { text += seconds + " " + wpajaxeditcomments.AEC_Second; }
		}
    //Output the timer to the user
    try {
    	//This try statement is for the iFrame
      //Iframe code from:  http://xkr.us/articles/dom/iframe-document/
      if (document.getElementById('TB_iframeContent') != undefined) {
      	var oIframe = document.getElementById('TB_iframeContent');
        var oDoc = (oIframe.contentWindow || oIframe.contentDocument);
        if (oDoc.document) oDoc = oDoc.document;
        $("#timer" + timer.cid, oDoc).html("&nbsp;(" + text + ")");
      }
    } catch(err) { }
    $("#ajax-edit-time-left-" + timer.cid).html("&nbsp;(" + text + ")");
    timer.minutes = minutes;
    timer.seconds = seconds;
    vars.timerObjs[timer.cid] = timer;
    vars.timers[timer.cid] = setTimeout(function() { get_time_left_timer(timer) }, 1000);
  }
  //Returns a data object for ajax calls
  function pre_process(element) {
  	var s = {};
    s.element = element.attr("id");
    s.response = 'ajax-response';
    var url = wpAjax.unserialize(element.attr('href'));
    s.nonce = url._wpnonce;
    s.cid = url.c;
    s.pid = url.p;
    s.action = url.action;
    s.type = "POST";
    s.url = wpajaxeditcomments.AEC_PluginUrl + "/php/AjaxEditComments.php";
    s.data = $.extend(s.data, { action: s.action, cid: s.cid,pid:s.pid, _ajax_nonce: s.nonce });
    s.global = false;
    s.timeout = 30000;
    return s;
  }
	function _delink(obj) {
		var data = pre_process($(obj));
		data.success = function(r) {
    	if (r == 1) { 
				$(".aec-delink-" + data.cid).fadeOut(500);
				$("#edit-author" + data.cid).html($("#edit-author" + data.cid + " A").html()) //for on a post
				return;
     	}
      //Delinking wasn't a success, display error
      alert(r);
    }
		$.ajax(data);
	}
	function _edit(obj) {
		obj = $(obj);
		var data = pre_process(obj);
		//For the Thickbox
		obj.addClass("thickbox");
		var t = obj.attr("title")|| obj.attr("name") || null;
		var a = obj.attr("href") || obj.attr("alt");
		var g = obj.attr("rel") || false;
		if (!window.tb_show) {
			jQuery.tb_show(t,a,g); //NextGen Compatibility
		} else {
			tb_show(t,a,g);
		}
		obj.blur();
	}
	function _approve(obj) {
		var data = pre_process($(obj));
		data.success = function(r) {
    	if (r == 1) { 
      	//Yay, comment is approved - Show visual
        var li = $("#" + "comment-" + data.cid);
        if (li.is("li") || li.is("div") ) {
          li.addClass("ajax-approve");
          li.slideUp(1000, function() { li.remove(); });
      	}
        return;
     	}
      //Approval wasn't a success, display error
      alert(r);
    }
    if (confirm(wpajaxeditcomments.AEC_Approve)) {
    	$.ajax(data);
    }
	}
	function _spam(obj) {
		var data = pre_process($(obj));
		data.success = function(r) {
    	if (r == 1) { 
      	//Yay, comment was marked as spam.  Try to show a visual
        var li = $("#" + "comment-" + data.cid);
        if (li.is("li") || li.is("div") ) {
          li.addClass("ajax-delete");
          li.slideUp(1000, function() { li.remove(); });
      	}
        return;
     	}
      //Spamation wasn't a success, display error
      alert(r);
    }
    if (confirm(wpajaxeditcomments.AEC_Spam)) {
    	$.ajax(data);
    }
	}
	function _moderate(obj) {
		var data = pre_process($(obj));
		data.success = function(r) {
    	if (r == 1) { 
      	//Yay, comment is unapproved - Show visual
        var li = $("#" + "comment-" + data.cid);
        if (li.is("li") || li.is("div") ) {
          li.addClass("ajax-unapprove");
          li.slideUp(1000, function() { li.remove(); });
      	}
        return;
     	}
      //Unapproval wasn't a success, display error
      alert(r);
    }
    if (confirm(wpajaxeditcomments.AEC_Moderation)) {
    	$.ajax(data);
    }
	}
	function _delete_comment(obj) {
		var data = pre_process($(obj));
		data.success = function(r) {
    	if (r == 1) { 
      	//Yay, comment was deleted.  Try to show a visual
        var li = $("#" + "comment-" + data.cid);
        if (li.is("li") || li.is("div") ) {
          li.addClass("ajax-delete");
          li.slideUp(1000, function() { li.remove(); });
      	}
        return;
     	}
      //Deletion wasn't a success, display error
      alert(r);
    }
    if (confirm(wpajaxeditcomments.AEC_Delete)) {
    	$.ajax(data);
    }
	}
	$.ajaxeditcomments.init();
});
//For legacy purposes
var AjaxEditComments = function() {
	return {
			init : function() { 
      	jQuery.ajaxeditcomments.init();
      }
	};
}();