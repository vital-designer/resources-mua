/** 
 * simple mouse tracking v. 1.1.7 record mode (smt_record.js)
 * Release date:  November 7th 2008
 * 
 * Copyleft (cc) 2006-2008 Luis Leiva.
 * see http://smt.speedzinemedia.com for more details
 *  
 * License LGPL: http://www.opensource.org/licenses/lgpl-2.1.php
 * 
 * This script is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License (LGPL) as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 */
(function(){  

  /* (smt) default options -------------------------------------------------- */
  var smtOpt = {
    fps:      24,                         // tracking frequency, in frames per second
    recTime:  120,                        // tracking timeout, in seconds
    smtPath:  "/smt",                     // Do NOT place a final slash (/)
    warn:     false,                      // advice users or not                                 
    warnText: "Your mouse movements are going to be logged.\nDo you agree?",
    disabled: Math.round(Math.random())   // random user selection: if true, (smt) in not initialized
  };
  
  /* (smt) auxiliar functions ----------------------------------------------- */
  var aux = {
    w3cDOM: (typeof document.getElementById !== "undefined" && 
             typeof document.getElementsByTagName !== "undefined" && 
             typeof document.createElement !== "undefined"),
    
    addEvent: function(obj, type, fn) { 
      // thanks to John Resig
    	if (obj.addEventListener)
    		obj.addEventListener(type, fn, false);
    	else if (obj.attachEvent)	{
    		obj["e"+type+fn] = fn;
    		obj[type+fn] = function(){ obj["e"+type+fn](window.event) };
    		obj.attachEvent("on"+type, obj[type+fn]);
    	}
    },
    
    getWindowSize: function(dim) {
      var w = document.documentElement.clientWidth  || document.body.clientWidth;   
      var h = document.documentElement.clientHeight || document.body.clientHeight;
      return (dim == "width") ? w : h;
    },
    
    getBase: function(url) {
      // split url in dirs
      var paths = url.split("/");
      // remove last element, so we do not have to worry about the query string (?var1=value1&var2=value2#anchor...)
      delete paths[(paths.length-1)];
      // and we have the BASE href
      return paths.join("/");
    },
    
    roundTo: function(number,digits) {
      var exp = 100;                      // faster computation
      //var exp = Math.pow(10,digits);    // this would be the correct way (slower)
      return Math.round(exp*number)/exp; 
    }
  };
  
  /* (smt) record system definition ----------------------------------------- */
  var smtRec = {
    posX: 0,                              // init global aux vars
    posY: 0,
    i: 0,
    
    dr_h: 1,                              // data normalization
    dr_v: 1,
    w: aux.getWindowSize("width"),
    h: aux.getWindowSize("height"),
    
    coordsX: [],                          // store mouse X coords
    coordsY: [],                          // store mouse Y coords
    clicksX: [],                          // store click X coords
    clicksY: [],                          // store click Y coords
    clicksT: [],                          // store click time
  
    url:      null,                       // document URI
    base:     null,                       // document base path
    rec:      null,                       // recording identifier
    pause:    false,                      // check active window
    clicked:  false,                      // no mouse click yet
    
    timeout: smtOpt.fps*smtOpt.recTime,   // session timeout
  
    /* METHODS */
    pauseRecording: function() {
      smtRec.pause = true;
    },
    
    continueRecording: function() {
      smtRec.pause = false;
    },
    
    normalizeData: function() {
      var w = aux.getWindowSize("width");
      var h = aux.getWindowSize("height");
      // compute discrepace ratio
      smtRec.dr_h = Math.round(w / smtRec.w);
      smtRec.dr_v = Math.round(h / smtRec.h);
      // update new values
      smtRec.w = w;
      smtRec.h = h;
    },
    
    getMousePos: function(e) { 
      // thanks to Peter-Paul Koch
      if (!e) var e = window.event;
    	if (e.pageX || e.pageY) {
    		smtRec.posX = e.pageX;
    		smtRec.posY = e.pageY;
    	}	else if (e.clientX || e.clientY) {
    		smtRec.posX = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
    		smtRec.posY = e.clientY + document.body.scrollTop  + document.documentElement.scrollTop;
    	}
    },
    
    setClick: function() {
      /**
       * Double clicks are considered as single clicks (it's simpler and faster), because
       * the rate of the double click depends upon the settings of the operating system.
       */
      smtRec.clicked = true;
      // time is computed in seconds
      smtRec.clicksT.push(aux.roundTo(smtRec.i/smtOpt.fps, 2));
      //smtRec.clicksT.push(smtRec.i/smtOpt.fps);
    },
    
    releaseClick: function() {
      smtRec.clicked = false; 
    },
    
    recMouse: function() {
      // track mouse only if window is active (has focus)
      if (smtRec.pause) return;
      // get mouse coords until timeout is reached 
      if (smtRec.i < smtRec.timeout) {
        // get normalized coords
        var x = smtRec.dr_h * smtRec.posX;
        var y = smtRec.dr_v * smtRec.posY;
        // track mouse coords when they're inside the client window
        if (smtRec.posX && smtRec.posY) {
          smtRec.coordsX.push(x);
          smtRec.coordsY.push(y);
          // get mouse clicks
          if (!smtRec.clicked) {
            smtRec.clicksX.push(0); 
            smtRec.clicksY.push(0); 
          } else { 
            smtRec.clicksX.push(x); 
            smtRec.clicksY.push(y); 
          }
        }
    	} else {
    	  // timeout reached
    	  clearInterval(smtRec.rec);
    	  smtRec.rec = null;
    	}
    	smtRec.i++;
    },
  
    sendData: function() {
      // compute total time session
      var time = aux.roundTo(smtRec.i/smtOpt.fps, 2);  
      // exit if the user expended less than 1 second on the page, or there is not enough mouse data
      if (time < 1 || smtRec.coordsX.length < 2) { return; }
        
      // create AJAX object
      var ajax_obj = false;
      // current AJAX flavours
      var flavours = [
        function() {return new XMLHttpRequest()},
        function() {return new ActiveXObject("Msxml2.XMLHTTP")},
        function() {return new ActiveXObject("Msxml3.XMLHTTP")},
        function() {return new ActiveXObject("Microsoft.XMLHTTP")}
      ];
      // check AJAX flavour
      for (var i=0; i<flavours.length; i++) {
        try {
          ajax_obj = flavours[i]();
        } catch(e) {
          continue;
        }
        break;
      }
      // set type accordingly to anticipated content type
      if (ajax_obj.overrideMimeType) 
          ajax_obj.overrideMimeType('text/html');
      // send data using AJAX to the server via POST
    	ajax_obj.open("POST", smtOpt.smtPath+"/smt_storeData.php", true);
      ajax_obj.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      ajax_obj.setRequestHeader("Connection",   "close");
  
      var data  = "url="      + smtRec.url;
          data += "&base="    + smtRec.base;
          data += "&title="   + document.title;
          data += "&browser=" + browserDetect.browser;
          data += "&version=" + browserDetect.version;
          data += "&OS="      + browserDetect.OS;
          data += "&sW="      + screen.width;
          data += "&sH="      + screen.height;
          data += "&dW="      + smtRec.w;
          data += "&dH="      + smtRec.h;
          data += "&t="       + time;
          data += "&cX="      + smtRec.coordsX;
          data += "&cY="      + smtRec.coordsY;
          data += "&clX="     + smtRec.clicksX;
          data += "&clY="     + smtRec.clicksY;
          data += "&clT="     + smtRec.clicksT;
          data += "&fps="     + smtOpt.fps;
          
      ajax_obj.send(data);
    },
    
    init: function() {
      // thanks to  Dean Edwards/Matthias Miller/John Resig
      if (arguments.callee.done) return;
      // flag this function so we don't do the same thing twice
      arguments.callee.done = true;
      // kill the Webkit timer
      if (_timer) {
        clearInterval(_timer);
        _timer = null;
      }
      
      // get this locations BEFORE making the AJAX request
      smtRec.url  = window.location.href;
      smtRec.base = aux.getBase(smtRec.url);
      
      // set main function: the (smt) recording interval
      var interval = Math.round(1000/smtOpt.fps);
      smtRec.rec   = setInterval(smtRec.recMouse, interval);
      
      // add unobstrusive events
      aux.addEvent(document, "mousemove", smtRec.getMousePos);      // get mouse coords (X, Y)
      aux.addEvent(document, "mousedown", smtRec.setClick);         // mouse is clicked        
      aux.addEvent(document, "mouseup",   smtRec.releaseClick);     // mouse is released
      aux.addEvent(window,   "resize",    smtRec.normalizeData);    // make easy data interpretation
      aux.addEvent(window,   "blur",      smtRec.pauseRecording);   // only record mouse when window is active
      aux.addEvent(window,   "focus",     smtRec.continueRecording);
      
      if (typeof window.onbeforeunload == 'function')
        aux.addEvent(window, "beforeunload", smtRec.sendData);      // user closes the brower window
      else 
        aux.addEvent(window, "unload",       smtRec.sendData);      // page is unloaded (for old browsers)
      
      // allow mouse tracking over Flash animations
      var obj = document.getElementsByTagName("object");
      for (var i=0,t=obj.length; i<t; ++i) {
        var param = document.createElement("param");
        param.setAttribute('name', 'wmode');
        param.setAttribute('value','transparent');
        obj[i].appendChild(param);
      }
      var embed = document.getElementsByTagName("embed");
      for (var i=0,t=embed.length; i<t; ++i)
        embed[i].setAttribute('wmode', 'transparent');
       
    }
  };
  /* Browser detection ------------------------------------------------------ */
  var browserDetect = {
    // script by Peter-Paul Koch @ QuirksMode.org
  	init: function () {
  		this.browser = this.searchString(this.dataBrowser) || "Other"; // other browser
  		this.version = this.searchVersion(navigator.userAgent)
  			|| this.searchVersion(navigator.appVersion)
  			|| "Unknown"; // unknown browser version
  		this.OS = this.searchString(this.dataOS) || "Other"; // other OS
  	},
  	searchString: function (data) {
  		for (var i=0;i<data.length;++i)	{
  			var dataString = data[i].string;
  			var dataProp = data[i].prop;
  			this.versionSearchString = data[i].versionSearch || data[i].identity;
  			if (dataString) {
  				if (dataString.indexOf(data[i].subString) != -1)
  					return data[i].identity;
  			} else if (dataProp)
  				  return data[i].identity;
  		}
  	},
  	searchVersion: function (dataString) {
  		var index = dataString.indexOf(this.versionSearchString);
  		if (index == -1) return;
  		return parseFloat(dataString.substring(index + this.versionSearchString.length+1));
  	},
  	dataBrowser: [
  	  { string: navigator.userAgent,  subString: "Chrome",  identity: "Chrome" },
  		{ string: navigator.userAgent, subString: "Flock", identity: "Flock" },
  		{ string: navigator.userAgent, subString: "OmniWeb", versionSearch: "OmniWeb/", identity: "OmniWeb" },
  		{ string: navigator.vendor, subString: "Apple", identity: "Safari" },
  		{ prop: window.opera, identity: "Opera" },
  		{ string: navigator.vendor, subString: "iCab", identity: "iCab" },
  		{ string: navigator.vendor, subString: "KDE", identity: "Konqueror" },
  		{ string: navigator.userAgent, subString: "Firefox", identity: "Firefox" },
  		{ string: navigator.vendor, subString: "Camino", identity: "Camino" },
  		{	string: navigator.userAgent, subString: "Netscape", identity: "Netscape" },
  		{ string: navigator.userAgent, subString: "MSIE", identity: "IExplorer", versionSearch: "MSIE" },
  		{ string: navigator.userAgent, subString: "Gecko", identity: "Mozilla", versionSearch: "rv" },
  		{ string: navigator.userAgent, subString: "Mozilla", identity: "Netscape", versionSearch: "Mozilla" }
  	],
  	dataOS: [
  		{ string: navigator.platform, subString: "Win", identity: "Windows" },
  		{ string: navigator.platform, subString: "Mac", identity: "Mac" },
  		{ string: navigator.platform, subString: "Linux", identity: "Linux" }
  	]
  };
  
  /* (smt) initialization --------------------------------------------------- */
  var agree = (smtOpt.warn) ? confirm(smtOpt.warnText) : true;
  if (!agree || smtOpt.disabled) return;
  
  // launch browser detection script (for statistical/debugging purposes)
  browserDetect.init();
  
  // now try each method of dom-ready initialization in modern browsers
  if (!aux.w3cDOM) {
    // old browsers use the window.onload event
    aux.addEvent(window, "load", smtRec.init); 
    return; 
  }
  // Internet Explorer
  if (aux.browserDetect.browser == "IExplorer") {
    try {
      document.write("<scr"+"ipt id=__ie_onload defer=true src=//:><\/scr"+"ipt>");
    	var script = document.getElementById("__ie_onload");
    	script.onreadystatechange = function() {
        if (this.readyState == "complete") { smtRec.init(); }
    	}
   } catch(e) {}
  }
  // Webkit-based browsers (Chrome, Safari)
  if (/WebKit/i.test(navigator.userAgent)) {
  	try {
      _timer = setInterval(function(){
      	if (/loaded|complete/.test(document.readyState)) { smtRec.init(); }
    	}, 10);
    } catch(e) {}
  }
  // Firefox, Opera...
  if (document.addEventListener) {
    document.addEventListener('DOMContentLoaded', smtRec.init, false);
  }

})();