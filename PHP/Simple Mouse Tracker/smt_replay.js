/** 
 * simple mouse tracking v. 1.1.7 replay mode (smt_replay.js)
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
    realTime: true,                    // static or dynamic mouse replay
    entryPt:  "#690",                  // entry point color
    exitPt:   "#C66",                  // exit point color
    regPt:    "#AAA",                  // registration points color 
    regLn:    "#888",                  // lines color
    regClick: "maroon",                // clicks color
    varCir:   "teal",                  // time-depending circles
    cenPt:    "#DDD",                  // centroid
    zIndex:   10,                      // depth of (smt) system layer
    bgLayer:  true,                    // draw background layer
    dirVect:  false                    // show direction vector (useful if realTime: false)
  };
  
  /* (smt) replay system definition ----------------------------------------- */
  var smtRep = {
    i: 0,                               // mouse tracking global counter var
    j: 1,                               // registration points size global counter var
    j_max: 200,                         // registration points size limit in pixels (diameter * 2)
    play: null,                         // mouse tracking identifier
    jg:   null,                         // canvas area for drawing
  
    getWindowSize: function(dim) {
      var w,h;
    	if (self.innerHeight) {	
  			w = self.innerWidth;
  			h = self.innerHeight;
  		} else if (document.documentElement.clientHeight) {
        // Explorer 6 Strict Mode 
  			w = document.documentElement.clientWidth;
  			h = document.documentElement.clientHeight;
  		} else if (document.body) { 
  		  // other Explorers
  			w = document.body.clientWidth;
  			h = document.body.clientHeight;
  		}
      
      return (dim == "width") ? w : h;
    },
  
    getDocumentSize: function(dim) {
      var w,h;
    	if (window.innerHeight && window.scrollMaxY) {	
    		w = window.innerWidth  + window.scrollMaxX;
    		h = window.innerHeight + window.scrollMaxY;
    	} else if (document.body.scrollHeight > document.body.offsetHeight) {
        // all but Explorer Mac
    		w = document.body.scrollWidth;
    		h = document.body.scrollHeight;
    	} else { 
        // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari
    		w = document.body.offsetWidth;
    		h = document.body.offsetHeight;
    	}
  
      return (dim == "width") ? w : h;
    },
  
    createCanvas: function(layer) {
      var jg    = document.createElement("div");
          jg.id                     = layer;
          jg.style.position         = "absolute";
          jg.style.top              = 0;
          jg.style.left             = 0;
          jg.style.width            = 0 + '%';
          jg.style.height           = 0 + '%';
          jg.style.zIndex           = smtOpt.zIndex;
          
      var body  = document.getElementsByTagName("body")[0];
          body.appendChild(jg);
      // set the canvas area for drawing
      smtRep.jg = new jsGraphics(layer);
    },
    
    setBgCanvas: function(layer) {
      // background layer color
      var bgColor = "#666";
      // background layer opacity (%)
      var opacity = 60;
      // layer size (get max value from this group)  
      var dw = smtRep.getWindowSize("width");
      var dh = smtRep.getWindowSize("height");
      var ww = smtRep.getDocumentSize("width");
      var wh = smtRep.getDocumentSize("height");
      
      var jg    = document.getElementById(layer);
      var depth = jg.style.zIndex;
      
      var bg    = document.createElement("div");
          bg.id                     = layer + "Bg";
          bg.style.position         = "absolute";
          bg.style.top              = 0;
          bg.style.left             = 0;
          bg.style.width            = Math.max(ww,dw) + 'px';
          bg.style.height           = Math.max(wh,dh) + 'px';
          bg.style.overflow         = "hidden";
          bg.style.backgroundColor  = bgColor;
          bg.style.opacity          = opacity/100; // for W3C browsers
          bg.style.filter           = "alpha(opacity="+opacity+")"; // only for IE
          bg.style.zIndex           = depth - 1;
      
      var body  = document.getElementsByTagName("body")[0];
          body.appendChild(bg);
    },
  
    addEvent: function(obj, type, fn) { 
      // thanks to John Resig
    	if (obj.addEventListener)
    		obj.addEventListener(type, fn, false);
    	else if (obj.attachEvent)	{
    		obj["e"+type+fn] = fn;
    		obj[type+fn] = function() { obj["e"+type+fn](window.event); }
    		obj.attachEvent("on"+type, obj[type+fn]);
    	}
    },
  
    reloadPage: function() {
      // clear previous timer
      window.clearTimeout(resizeDelay);
      // timeout handler to fire after the resize event (for IE)
      var resizeDelay = setTimeout(function(){
        this.location.href = window.location.href;
      }, 10);
      // Note: window.location.reload(); does not reload the tracking layer
    },
    
    arraySum: function(array) {
    	for (var i=0,sum=0,t=array.length; i<t; sum+=array[i++]);
    	return sum;
    },
    
    /* (smt) realtime drawing algorithm ------------------------------------- */
    playMouse: function() {
      // draw entry point
      var p = smt_data.coordsX[smtRep.i] * smtRep.dr_h;
      var q = smt_data.coordsY[smtRep.i] * smtRep.dr_v;
      if (smtRep.i == 0) { 
        smtRep.jg.setColor(smtOpt.entryPt);
        smtRep.jg.fillPolygon([p,p,   p+4, p+6, p+9, p+7, p+15], 
                              [q,q+15,q+15,q+23,q+23,q+15,q+15]);
        smtRep.jg.paint();
      }
    
      // main loop to draw mouse trail
      if (smtRep.i < smt_data.coordsX.length)  {
        // X coords normalization
        var cXa = p;
        var cXb = smt_data.coordsX[smtRep.i+1] * smtRep.dr_h;
        var clX = smt_data.clicksX[smtRep.i]   * smtRep.dr_h;
        // Y coords normalization
        var cYa = q;
        var cYb = smt_data.coordsY[smtRep.i+1] * smtRep.dr_v;
        var clY = smt_data.clicksY[smtRep.i]   * smtRep.dr_v;
        // draw registration points   
        if (cXa == cXb && cYa == cYb) {
          // store variable size (circles)
          if (smtRep.j < smtRep.j_max) 
            smtRep.j++;
        } else {
          smtRep.jg.setColor(smtOpt.regPt);
          if (!smtOpt.dirVect)
            // static squares
            smtRep.jg.fillRect(cXa-1, cYa-1, 3, 3);
          else {
            // direction pseudo-arrows
            var a = cXa-cXb;
            var b = cYa-cYb;
            if(a>0 && b>0)
              smtRep.jg.drawPolyline([cXb-4,cXb,cXb+4], [cYb+4,cYb,cYb+4]);
            else if(a<0 && b>0)
              smtRep.jg.drawPolyline([cXb-4,cXb,cXb-4], [cYb-4,cYb,cYb+4]);
            else if(a<0 && b<0)
              smtRep.jg.drawPolyline([cXb-4,cXb,cXb+4], [cYb-4,cYb,cYb-4]);
            else if(a>0 && b<0)
              smtRep.jg.drawPolyline([cXb+4,cXb,cXb+4], [cYb-4,cYb,cYb+4]);
          }
          // variable circles
          if (smtRep.j != 1) {
            smtRep.jg.setColor(smtOpt.varCir);
            smtRep.jg.drawEllipse(cXa-smtRep.j/4, cYa-smtRep.j/4, smtRep.j/2, smtRep.j/2);
          }
          // reset variable circles size
          smtRep.j = 1;
        }
        
        // draw lines
        smtRep.jg.setColor(smtOpt.regLn);
        smtRep.jg.drawLine(cXa, cYa, cXb, cYb);
        smtRep.jg.paint();
        
        // draw clicks
        if (cXa == clX && cYa == clY) {
          smtRep.jg.setColor(smtOpt.regClick);
          smtRep.jg.drawRect(clX-5,clY-5,10,10);
          smtRep.jg.paint();
        }
        // update mouse coordinates
        smtRep.i++;
        
    	} else {
    	  // draw exit point
    	  var p = smt_data.coordsX[smtRep.i-1] * smtRep.dr_h;
        var q = smt_data.coordsY[smtRep.i-1] * smtRep.dr_v;
    	  smtRep.jg.setColor(smtOpt.exitPt);
        smtRep.jg.fillPolygon([p,p,   p+4, p+6, p+9, p+7, p+15], 
                              [q,q+15,q+15,q+23,q+23,q+15,q+15]);
        smtRep.jg.paint();
        // draw centroid (average mouse position) 
        smtRep.jg.setColor(smtOpt.cenPt);
        var u = Math.round(smtRep.arraySum(smt_data.coordsX)*smtRep.dr_h / smt_data.coordsX.length);
        var v = Math.round(smtRep.arraySum(smt_data.coordsY)*smtRep.dr_v / smt_data.coordsY.length);
        var l = 10; // centroid line length
        smtRep.jg.setStroke(3);
    		smtRep.jg.drawLine(u, v, u+l, v-l); // 1st quadrant
    		smtRep.jg.drawLine(u, v, u-l, v-l); // 2nd quadrant
    		smtRep.jg.drawLine(u, v, u-l, v+l); // 3rd quadrant
    		smtRep.jg.drawLine(u, v, u+l, v+l); // 4th quadrant
    		smtRep.jg.paint();
    
        // clear mouse tracking
        clearInterval(smtRep.play);
        smtRep.play = null;
    	}
    	
    },
    
    /* system initialization ------------------------------------------------ */
    init: function() {
      var smt = "smtCanvas";
      // set the canvas layer
      smtRep.createCanvas(smt);
  
      // draw the background layer if needed
      if (smtOpt.bgLayer) smtRep.setBgCanvas(smt);
      
      // get the document size
      var w = smtRep.getWindowSize("width");
      var h = smtRep.getWindowSize("height");
      // compute the discrepance ratio
      smtRep.dr_h = Math.round(w / smt_data.previousWidth);
      smtRep.dr_v = Math.round(h / smt_data.previousHeight);
      
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
       embed[i].setAttribute('wmode','transparent');
      
      if (smtOpt.realTime) {
        // fps are stored in smt_data object, so we can use that value here
        var interval = Math.round(1000/smt_data.fps);
        smtRep.play = setInterval(smtRep.playMouse, interval);
      } else {
        // static mouse tracking visualization 
        for (var i=0,total=smt_data.coordsX.length; i<=total; ++i)
          smtRep.playMouse();
      }
    }    
  };
  
  // in this replay case it's not required to begin when the DOM content is loaded 
  smtRep.addEvent(window, "load",   smtRep.init);
  /** 
   * Note that reloading a page if it is resized has some side-effect,
   * such as adding entries to a database or sending off e-mail messages. 
   * Thus, comment/uncomment the next addEvent line below at your own will. 
   */
  //smtRep.addEvent(window, "resize", smtRep.reloadPage);
})();