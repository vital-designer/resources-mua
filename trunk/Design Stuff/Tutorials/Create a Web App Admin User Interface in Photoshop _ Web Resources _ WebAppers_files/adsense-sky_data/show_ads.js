(function(){
var i=true,l=null,m=false,n=(new Date).getTime();var o=this,aa=function(a,b,c){var d=a.split("."),e=c||o;!(d[0]in e)&&e.execScript&&e.execScript("var "+d[0]);for(var f;d.length&&(f=d.shift());)if(!d.length&&b!==undefined)e[f]=b;else e=e[f]?e[f]:(e[f]={})},p=function(a){var b=typeof a;if(b=="object")if(a){if(a instanceof Array||!(a instanceof Object)&&Object.prototype.toString.call(a)=="[object Array]"||typeof a.length=="number"&&typeof a.splice!="undefined"&&typeof a.propertyIsEnumerable!="undefined"&&!a.propertyIsEnumerable("splice"))return"array";
if(!(a instanceof Object)&&(Object.prototype.toString.call(a)=="[object Function]"||typeof a.call!="undefined"&&typeof a.propertyIsEnumerable!="undefined"&&!a.propertyIsEnumerable("call")))return"function"}else return"null";else if(b=="function"&&typeof a.call=="undefined")return"object";return b},ba=function(a){var b=p(a);return b=="array"||b=="object"&&typeof a.length=="number"},q=function(a){return typeof a=="string"},ca=function(a){var b=p(a);return b=="object"||b=="array"||b=="function"};
Math.floor(Math.random()*2147483648).toString(36);
var da=function(a){var b=p(a);if(b=="object"||b=="array"){if(a.clone)return a.clone.call(a);var c=b=="array"?[]:{};for(var d in a)c[d]=da(a[d]);return c}return a},ea=function(a,b){var c=a.u;if(arguments.length>2){var d=Array.prototype.slice.call(arguments,2);c&&d.unshift.apply(d,c);c=d}b=a.w||b;a=a.v||a;var e,f=b||o;e=c?function(){var h=Array.prototype.slice.call(arguments);h.unshift.apply(h,c);return a.apply(f,h)}:function(){return a.apply(f,arguments)};e.u=c;e.w=b;e.v=a;return e},fa=Date.now||function(){return(new Date).getTime()},
r=function(a,b,c){aa(a,b,c)};function t(a,b){var c=parseFloat(a);return isNaN(c)||c>1||c<0?b:c}function ga(a,b){if(a=="true")return i;if(a=="false")return m;return b}function v(a,b){var c=/^([\w-]+\.)+[\w-]{2,}(\:[0-9]+)?$/;return c.test(a)?a:b};var ha="pagead2.googlesyndication.com",ia="googleads.g.doubleclick.net",ja="pubads.g.doubleclick.net",ka="partner.googleadservices.com",y=v("pagead2.googlesyndication.com",ha),la=v("googleads.g.doubleclick.net",ia),ma=v("pagead2.googlesyndication.com",ha);v("pubads.g.doubleclick.net",ja);v("partner.googleadservices.com",ka);function z(a){return typeof encodeURIComponent=="function"?encodeURIComponent(a):escape(a)}function na(a,b,c){var d=document.createElement("script");d.type="text/javascript";if(b)d.onload=b;if(c)d.id=c;d.src=a;var e=document.getElementsByTagName("head")[0];if(!e)return m;window.setTimeout(function(){e.appendChild(d)},0);return i}function oa(a,b){a.google_image_requests||(a.google_image_requests=[]);var c=new Image;c.src=b;a.google_image_requests.push(c)}
function pa(a){if(a in qa)return qa[a];return qa[a]=navigator.userAgent.toLowerCase().indexOf(a)!=-1}var qa={};
function ra(){if(navigator.plugins&&navigator.mimeTypes.length){var a=navigator.plugins["Shockwave Flash"];if(a&&a.description)return a.description.replace(/([a-zA-Z]|\s)+/,"").replace(/(\s)+r/,".")}else if(navigator.userAgent&&navigator.userAgent.indexOf("Windows CE")>=0){for(var b=3,c=1;c;)try{c=new ActiveXObject("ShockwaveFlash.ShockwaveFlash."+(b+1));b++}catch(d){c=l}return b.toString()}else if(pa("msie")&&!window.opera){c=l;try{c=new ActiveXObject("ShockwaveFlash.ShockwaveFlash.7")}catch(e){b=
0;try{c=new ActiveXObject("ShockwaveFlash.ShockwaveFlash.6");b=6;c.AllowScriptAccess="always"}catch(f){if(b==6)return b.toString()}try{c=new ActiveXObject("ShockwaveFlash.ShockwaveFlash")}catch(h){}}if(c){b=c.GetVariable("$version").split(" ")[1];return b.replace(/,/g,".")}}return"0"}function sa(a){var b=a.google_ad_format;if(b)return b.indexOf("_0ads")>0;return a.google_ad_output!="html"&&a.google_num_radlinks>0}function B(a){return!!a&&a.indexOf("_sdo")!=-1}
function ta(a){return sa(a)||B(a.google_ad_format)}function C(a,b){var c=Math.random();if(c<b){var d=Math.floor(c/b*a.length);return a[d]}return""};var ua={google_ad_channel:"channel",google_ad_host:"host",google_ad_host_channel:"h_ch",google_ad_host_tier_id:"ht_id",google_ad_region:"region",google_ad_section:"region",google_ad_type:"ad_type",google_adtest:"adtest",google_allow_expandable_ads:"ea",google_alternate_ad_url:"alternate_ad_url",google_alternate_color:"alt_color",google_bid:"bid",google_city:"gcs",google_color_bg:"color_bg",google_color_border:"color_border",google_color_line:"color_line",google_color_link:"color_link",google_color_text:"color_text",
google_color_url:"color_url",google_contents:"contents",google_country:"gl",google_cust_age:"cust_age",google_cust_ch:"cust_ch",google_cust_gender:"cust_gender",google_cust_id:"cust_id",google_cust_interests:"cust_interests",google_cust_job:"cust_job",google_cust_l:"cust_l",google_cust_lh:"cust_lh",google_cust_u_url:"cust_u_url",google_disable_video_autoplay:"disable_video_autoplay",google_ed:"ed",google_encoding:"oe",google_feedback:"feedback_link",google_flash_version:"flash",google_font_face:"f",
google_font_size:"fs",google_gl:"gl",google_hints:"hints",google_kw:"kw",google_kw_type:"kw_type",google_language:"hl",google_page_url:"url",google_referrer_url:"ref",google_region:"gr",google_reuse_colors:"reuse_colors",google_safe:"adsafe",google_tag_info:"gut",google_targeting:"targeting",google_ui_features:"ui",google_ui_version:"uiv",google_video_doc_id:"video_doc_id",google_video_product_type:"video_product_type"},ya={google_ad_format:"format",google_ad_output:"output",google_ad_callback:"callback",
google_ad_height:"h",google_ad_override:"google_ad_override",google_ad_slot:"slotname",google_ad_width:"w",google_analytics_uacct:"ga_wpids",google_correlator:"correlator",google_cpa_choice:"cpa_choice",google_ctr_threshold:"ctr_t",google_image_size:"image_size",google_last_modified_time:"lmt",google_max_num_ads:"num_ads",google_max_radlink_len:"max_radlink_len",google_num_radlinks:"num_radlinks",google_num_radlinks_per_unit:"num_radlinks_per_unit",google_only_ads_with_video:"only_ads_with_video",
google_page_location:"loc",google_rl_dest_url:"rl_dest_url",google_rl_filtering:"rl_filtering",google_rl_mode:"rl_mode",google_rt:"rt",google_skip:"skip"},za={google_only_pyv_ads:"pyv"};function Aa(a){return ua[a]||ya[a]||za[a]||l};var Ba=document,Ca=ga("false",m),Da=ga("false",m),Ea=ga("false",m),D=window;document.URL&&(document.URL.indexOf("?google_debug")>0||document.URL.indexOf("&google_debug")>0);var Fa=function(a){return a.replace(/^[\s\xa0]+|[\s\xa0]+$/g,"")},La=function(a,b){if(b)return a.replace(Ga,"&amp;").replace(Ha,"&lt;").replace(Ia,"&gt;").replace(Ja,"&quot;");else{if(!Ka.test(a))return a;if(a.indexOf("&")!=-1)a=a.replace(Ga,"&amp;");if(a.indexOf("<")!=-1)a=a.replace(Ha,"&lt;");if(a.indexOf(">")!=-1)a=a.replace(Ia,"&gt;");if(a.indexOf('"')!=-1)a=a.replace(Ja,"&quot;");return a}},Ga=/&/g,Ha=/</g,Ia=/>/g,Ja=/\"/g,Ka=/[&<>\"]/,Oa=function(a){if(E(a,"&"))return"document"in o&&!E(a,"<")?
Ma(a):Na(a);return a},Ma=function(a){var b=o.document.createElement("a");b.innerHTML=a;b.normalize&&b.normalize();a=b.firstChild.nodeValue;b.innerHTML="";return a},Na=function(a){return a.replace(/&([^;]+);/g,function(b,c){switch(c){case "amp":return"&";case "lt":return"<";case "gt":return">";case "quot":return'"';default:if(c.charAt(0)=="#"){var d=Number("0"+c.substr(1));if(!isNaN(d))return String.fromCharCode(d)}return b}})},Pa=function(a,b){for(var c=b.length,d=0;d<c;d++){var e=c==1?b:b.charAt(d);
if(a.charAt(0)==e&&a.charAt(a.length-1)==e)return a.substring(1,a.length-1)}return a},E=function(a,b){return a.indexOf(b)!=-1},Ra=function(a,b){for(var c=0,d=Fa(String(a)).split("."),e=Fa(String(b)).split("."),f=Math.max(d.length,e.length),h=0;c==0&&h<f;h++){var k=d[h]||"",j=e[h]||"",g=new RegExp("(\\d*)(\\D*)","g"),u=new RegExp("(\\d*)(\\D*)","g");do{var w=g.exec(k)||["","",""],x=u.exec(j)||["","",""];if(w[0].length==0&&x[0].length==0)break;var s=w[1].length==0?0:parseInt(w[1],10),N=x[1].length==
0?0:parseInt(x[1],10);c=Qa(s,N)||Qa(w[2].length==0,x[2].length==0)||Qa(w[2],x[2])}while(c==0)}return c},Qa=function(a,b){if(a<b)return-1;else if(a>b)return 1;return 0};fa();var F=function(a){this.t=a;this.i=[];this.p=this.h=0;this.d=[];this.n=m};F.prototype.s=function(a,b){var c=this.t[b],d=this.i;this.t[b]=function(e){if(e&&e.length>0){var f=e.length>1?e[1].url:l;d.push([a,Oa(e[0].url),f])}c(e)}};F.prototype.r=function(){this.h++};F.prototype.o=function(){if(!this.n){na("http://"+y+"/pagead/osd.js");this.n=i}};F.prototype.j=function(a){if(this.h>0)for(var b=document.getElementsByTagName("iframe"),c=0;c<b.length;c++)b.item(c).name=="google_ads_frame"&&a(b.item(c),b.item(c).src)};
F.prototype.k=function(a){var b=this.i;if(b.length>0)for(var c=document.getElementsByTagName("a"),d=function(g,u){return g.innerHTML.indexOf(u)>0},e=0;e<c.length;e++)for(var f=0;f<b.length;f++)if(c.item(e).href==b[f][1]){var h=c.item(e).parentNode;if(b[f][2])for(var k=h,j=0;j<4;j++){if(d(k,b[f][2])){h=k;break}k=k.parentNode}a(h,b[f][0]);b.splice(f,1);break}};F.prototype.e=function(a){this.k(a);this.j(a)};F.prototype.a=function(a){this.p=a};F.prototype.g=function(){return this.p};
F.prototype.f=function(){return this.i.length+this.h};F.prototype.b=function(a){this.d=a};F.prototype.q=function(a,b){if(this.d.length>0){for(var c=0;c<this.d.length;c++)if(this.d[c]==a)if(a=="js")this.s(b,"google_ad_request_done");else a=="html"&&this.r();this.o()}};var Sa=function(){window.__google_ad_urls||(window.__google_ad_urls=new F(window));return window.__google_ad_urls};r("Goog_AdSense_getAdAdapterInstance",Sa);r("Goog_AdSense_OsdAdapter",F);
r("Goog_AdSense_OsdAdapter.prototype.numBlocks",F.prototype.f);r("Goog_AdSense_OsdAdapter.prototype.findBlocks",F.prototype.e);r("Goog_AdSense_OsdAdapter.prototype.getOsdMode",F.prototype.g);function Ta(a,b){try{return a.top.document.URL==b.URL}catch(c){}return m}function Ua(a,b,c,d){var e=c||a.google_ad_width,f=d||a.google_ad_height;if(Ta(a,b))return m;var h=b.documentElement;if(e&&f){var k=1,j=1;if(a.innerHeight){k=a.innerWidth;j=a.innerHeight}else if(h&&h.clientHeight){k=h.clientWidth;j=h.clientHeight}else if(b.body){k=b.body.clientWidth;j=b.body.clientHeight}if(j>2*f||k>2*e)return m}return i}function Va(a,b){for(var c in b)a["google_"+c]=b[c]}
function Wa(a,b){if(!b)return a.URL;return a.referrer}function Xa(a,b){if(!b&&a.google_referrer_url==l)return"0";else if(b&&a.google_referrer_url==l)return"1";else if(!b&&a.google_referrer_url!=l)return"2";else if(b&&a.google_referrer_url!=l)return"3";return"4"}function Ya(a,b,c,d){a.page_url=Wa(c,d);a.page_location=l}function Za(a,b,c,d){a.page_url=b.google_page_url;a.page_location=Wa(c,d)||"EMPTY"}
function $a(a,b){var c={},d=Ua(a,b,a.google_ad_width,a.google_ad_height);c.iframing=Xa(a,d);a.google_page_url?Za(c,a,b,d):Ya(c,a,b,d);c.last_modified_time=b.URL==c.page_url?Date.parse(b.lastModified)/1000:l;c.referrer_url=d?a.google_referrer_url:a.google_page_url&&a.google_referrer_url?a.google_referrer_url:b.referrer;return c}function ab(a){var b={},c=a.URL.substring(a.URL.lastIndexOf("http"));b.iframing=l;b.page_url=c;b.page_location=a.URL;b.last_modified_time=l;b.referrer_url=c;return b}
function bb(a,b){var c=cb(a,b);Va(a,c)}function cb(a,b){var c;return c=a.google_page_url==l&&db[b.domain]?ab(b):$a(a,b)}var db={};db["ad.yieldmanager.com"]=i;var eb=function(a,b,c){var d=ea(b,o,a),e=window.onerror;window.onerror=d;try{c()}catch(f){var h=f.toString(),k="";if(f.fileName)k=f.fileName;var j=-1;if(f.lineNumber)j=f.lineNumber;var g=d(h,k,j);if(!g)throw f;}window.onerror=e};r("google_protectAndRun",eb);
var gb=function(a,b,c,d){if(Math.random()<0.01){var e=Ba,f=["http://",y,"/pagead/gen_204","?id=jserror","&cb=",Ca?1:0,"&cd=",Da?1:0,"&context=",z(a),"&msg=",z(b),"&file=",z(c),"&line=",z(d.toString()),"&url=",z(e.URL.substring(0,512)),"&ref=",z(e.referrer.substring(0,512))];f.push(fb());oa(D,f.join(""))}return!Ea};r("google_handleError",gb);
var fb=function(){var a=["&client=",z(D.google_ad_client),"&format=",z(D.google_ad_format),"&slotname=",z(D.google_ad_slot),"&output=",z(D.google_ad_output),"&ad_type=",z(D.google_ad_type)];return a.join("")};var hb=function(a,b,c){if(a.forEach)a.forEach(b,c);else if(Array.forEach)Array.forEach(a,b,c);else for(var d=a.length,e=q(a)?a.split(""):a,f=0;f<d;f++)f in e&&b.call(c,e[f],f,a)},ib=function(a){if(p(a)=="array")return a.concat();else{for(var b=[],c=0,d=a.length;c<d;c++)b[c]=a[c];return b}};var G=function(a,b){this.x=a!==undefined?a:0;this.y=b!==undefined?b:0};G.prototype.clone=function(){return new G(this.x,this.y)};G.prototype.toString=function(){return"("+this.x+", "+this.y+")"};var H=function(a,b){this.width=a;this.height=b};H.prototype.clone=function(){return new H(this.width,this.height)};H.prototype.toString=function(){return"("+this.width+" x "+this.height+")"};H.prototype.ceil=function(){this.width=Math.ceil(this.width);this.height=Math.ceil(this.height);return this};H.prototype.floor=function(){this.width=Math.floor(this.width);this.height=Math.floor(this.height);return this};
H.prototype.round=function(){this.width=Math.round(this.width);this.height=Math.round(this.height);return this};H.prototype.scale=function(a){this.width*=a;this.height*=a;return this};var jb=function(a,b,c){for(var d in a)b.call(c,a[d],d,a)};var I,kb,J,lb,mb,nb,ob,pb,qb,sb,wb=function(){return o.navigator?o.navigator.userAgent:l},xb=function(){return o.navigator},yb=function(){nb=mb=lb=J=kb=I=m;var a;if(a=wb()){var b=xb();I=a.indexOf("Opera")==0;kb=!I&&a.indexOf("MSIE")!=-1;lb=(J=!I&&a.indexOf("WebKit")!=-1)&&a.indexOf("Mobile")!=-1;nb=(mb=!I&&!J&&b.product=="Gecko")&&b.vendor=="Camino"}};yb();
var K=I,L=kb,zb=mb,M=J,Ab=lb,Bb=function(){var a=xb();return a&&a.platform||""},Cb=Bb(),Db=function(){ob=E(Cb,"Mac");pb=E(Cb,"Win");qb=E(Cb,"Linux");sb=!!xb()&&E(xb().appVersion||"","X11")};Db();
var Eb=ob,Fb=pb,Gb=qb,Hb=function(){var a="",b;if(K&&o.opera){var c=o.opera.version;a=typeof c=="function"?c():c}else{if(zb)b=/rv\:([^\);]+)(\)|;)/;else if(L)b=/MSIE\s+([^\);]+)(\)|;)/;else if(M)b=/WebKit\/(\S+)/;if(b){var d=b.exec(wb());a=d?d[1]:""}}return a},Ib=Hb(),Jb={},O=function(a){return Jb[a]||(Jb[a]=Ra(Ib,a)>=0)};var Kb;var Lb=function(a){return q(a)?document.getElementById(a):a},Mb=Lb,Ob=function(a,b){jb(b,function(c,d){if(d=="style")a.style.cssText=c;else if(d=="class")a.className=c;else if(d=="for")a.htmlFor=c;else if(d in Nb)a.setAttribute(Nb[d],c);else a[d]=c})},Nb={cellpadding:"cellPadding",cellspacing:"cellSpacing",colspan:"colSpan",rowspan:"rowSpan",valign:"vAlign",height:"height",width:"width",usemap:"useMap",frameborder:"frameBorder",type:"type"},Pb=function(a){var b=a.document;if(M&&!O("500")&&!Ab){if(typeof a.innerHeight==
"undefined")a=window;var c=a.innerHeight,d=a.document.documentElement.scrollHeight;if(a==a.top)if(d<c)c-=15;return new H(a.innerWidth,c)}var e=b.compatMode=="CSS1Compat"&&(!K||K&&O("9.50"))?b.documentElement:b.body;return new H(e.clientWidth,e.clientHeight)},Qb=function(a){var b=!M&&a.compatMode=="CSS1Compat"?a.documentElement:a.body;return new G(b.scrollLeft,b.scrollTop)},Sb=function(){return Rb(document,arguments)},Rb=function(a,b){var c=b[0],d=b[1];if(L&&d&&(d.name||d.type)){var e=["<",c];d.name&&
e.push(' name="',La(d.name),'"');if(d.type){e.push(' type="',La(d.type),'"');d=da(d);delete d.type}e.push(">");c=e.join("")}var f=a.createElement(c);if(d)if(q(d))f.className=d;else Ob(f,d);if(b.length>2){function h(g){if(g)f.appendChild(q(g)?a.createTextNode(g):g)}for(var k=2;k<b.length;k++){var j=b[k];ba(j)&&!(ca(j)&&j.nodeType>0)?hb(Tb(j)?ib(j):j,h):h(j)}}return f},Ub=function(a,b){a.appendChild(b)},Vb=function(a){return a&&a.parentNode?a.parentNode.removeChild(a):l},Wb=function(a,b){var c=b.parentNode;
c&&c.replaceChild(a,b)},Xb=M&&Ra(Ib,"521")<=0,Yb=function(a,b){if(typeof a.contains!="undefined"&&!Xb&&b.nodeType==1)return a==b||a.contains(b);if(typeof a.compareDocumentPosition!="undefined")return a==b||Boolean(a.compareDocumentPosition(b)&16);for(;b&&a!=b;)b=b.parentNode;return b==a},P=function(a){return a.nodeType==9?a:a.ownerDocument||a.document},Tb=function(a){if(a&&typeof a.length=="number")if(ca(a))return typeof a.item=="function"||typeof a.item=="string";else if(p(a)=="function")return typeof a.item==
"function";return m},Q=function(a){this.c=a||o.document||document};Q.prototype.createElement=function(a){return this.c.createElement(a)};Q.prototype.createTextNode=function(a){return this.c.createTextNode(a)};Q.prototype.m=function(){return this.c.compatMode=="CSS1Compat"};Q.prototype.l=function(){return Qb(this.c)};Q.prototype.appendChild=Ub;Q.prototype.removeNode=Vb;Q.prototype.replaceNode=Wb;Q.prototype.contains=Yb;var Zb,$b,ac,bc,cc,dc,ec=function(){dc=cc=bc=ac=$b=Zb=m;var a=wb();if(a)if(a.indexOf("Firefox")!=-1)Zb=i;else if(a.indexOf("Camino")!=-1)$b=i;else if(a.indexOf("iPhone")!=-1||a.indexOf("iPod")!=-1)ac=i;else if(a.indexOf("Android")!=-1)bc=i;else if(a.indexOf("Chrome")!=-1)cc=i;else if(a.indexOf("Safari")!=-1)dc=i};ec();var fc=function(a,b){var c=P(a);if(c.defaultView&&c.defaultView.getComputedStyle){var d=c.defaultView.getComputedStyle(a,"");if(d)return d[b]}return l},R=function(a,b){return fc(a,b)||(a.currentStyle?a.currentStyle[b]:l)||a.style[b]},gc=function(a){var b;b=a?a.nodeType==9?a:P(a):document;if(L&&!(b?new Q(P(b)):Kb||(Kb=new Q)).m())return b.body;return b.documentElement},hc=function(a){var b=a.getBoundingClientRect();if(L){var c=a.ownerDocument;b.left-=c.documentElement.clientLeft+c.body.clientLeft;
b.top-=c.documentElement.clientTop+c.body.clientTop}return b},ic=function(a){if(L)return a.offsetParent;for(var b=P(a),c=R(a,"position"),d=c=="fixed"||c=="absolute",e=a.parentNode;e&&e!=b;e=e.parentNode){c=R(e,"position");d=d&&c=="static"&&e!=b.documentElement&&e!=b.body;if(!d&&(e.scrollWidth>e.clientWidth||e.scrollHeight>e.clientHeight||c=="fixed"||c=="absolute"))return e}return l},jc=function(a){var b,c=P(a),d=R(a,"position"),e=zb&&c.getBoxObjectFor&&!a.getBoundingClientRect&&d=="absolute"&&(b=
c.getBoxObjectFor(a))&&(b.screenX<0||b.screenY<0),f=new G(0,0),h=gc(c);if(a==h)return f;if(a.getBoundingClientRect){b=hc(a);var k=(c?new Q(P(c)):Kb||(Kb=new Q)).l();f.x=b.left+k.x;f.y=b.top+k.y}else if(c.getBoxObjectFor&&!e){b=c.getBoxObjectFor(a);var j=c.getBoxObjectFor(h);f.x=b.screenX-j.screenX;f.y=b.screenY-j.screenY}else{var g=a;do{f.x+=g.offsetLeft;f.y+=g.offsetTop;if(g!=a){f.x+=g.clientLeft||0;f.y+=g.clientTop||0}if(M&&R(g,"position")=="fixed"){f.x+=c.body.scrollLeft;f.y+=c.body.scrollTop;
break}g=g.offsetParent}while(g&&g!=a);if(K||M&&d=="absolute")f.y-=c.body.offsetTop;for(g=a;(g=ic(g))&&g!=c.body&&g!=h;){f.x-=g.scrollLeft;if(!K||g.tagName!="TR")f.y-=g.scrollTop}}return f};zb&&O("1.9");
var kc=function(a,b,c,d){if(/^\d+px?$/.test(b))return parseInt(b,10);else{var e=a.style[c],f=a.runtimeStyle[c];a.runtimeStyle[c]=a.currentStyle[c];a.style[c]=b;var h=a.style[d];a.style[c]=e;a.runtimeStyle[c]=f;return h}},lc=function(a){var b=P(a),c="";if(b.createTextRange){var d=b.body.createTextRange();d.moveToElementText(a);c=d.queryCommandValue("FontName")}if(!c){c=R(a,"fontFamily");if(K&&Gb)c=c.replace(/ \[[^\]]*\]/,"")}var e=c.split(",");if(e.length>1)c=e[0];return Pa(c,"\"'")},mc=function(a){var b=
a.match(/[^\d]+$/);return b&&b[0]||l},nc={cm:1,"in":1,mm:1,pc:1,pt:1},oc={em:1,ex:1},pc=function(a){var b=R(a,"fontSize"),c=mc(b);if(b&&"px"==c)return parseInt(b,10);if(L)if(c in nc)return kc(a,b,"left","pixelLeft");else if(a.parentNode&&a.parentNode.nodeType==1&&c in oc){var d=a.parentNode,e=R(d,"fontSize");return kc(d,b==e?"1em":b,"left","pixelLeft")}var f=Sb("span",{style:"visibility:hidden;position:absolute;line-height:0;padding:0;margin:0;border:0;height:1em;"});Ub(a,f);b=f.offsetHeight;Vb(f);
return b};var S=document,T=navigator,U=window;
function qc(){var a=S.cookie,b=Math.round((new Date).getTime()/1000),c=U.google_analytics_domain_name,d=typeof c=="undefined"?rc("auto"):rc(c),e=a.indexOf("__utma="+d+".")>-1,f=a.indexOf("__utmb="+d)>-1,h=a.indexOf("__utmc="+d)>-1,k,j={},g=!!U&&!!U.gaGlobal;if(e){k=a.split("__utma="+d+".")[1].split(";")[0].split(".");j.sid=f&&h?k[3]+"":g&&U.gaGlobal.sid?U.gaGlobal.sid:b+"";j.vid=k[0]+"."+k[1];j.from_cookie=i}else{j.sid=g&&U.gaGlobal.sid?U.gaGlobal.sid:b+"";j.vid=g&&U.gaGlobal.vid?U.gaGlobal.vid:(Math.round(Math.random()*
2147483647)^sc()&2147483647)+"."+b;j.from_cookie=m}j.dh=d;j.hid=g&&U.gaGlobal.hid?U.gaGlobal.hid:Math.round(Math.random()*2147483647);return U.gaGlobal=j}
function sc(){var a=S.cookie?S.cookie:"",b=U.history.length,c,d,e=[T.appName,T.version,T.language?T.language:T.browserLanguage,T.platform,T.userAgent,T.javaEnabled()?1:0].join("");if(U.screen)e+=U.screen.width+"x"+U.screen.height+U.screen.colorDepth;else if(U.java){d=java.awt.Toolkit.getDefaultToolkit().getScreenSize();e+=d.screen.width+"x"+d.screen.height}e+=a;e+=S.referrer?S.referrer:"";for(c=e.length;b>0;)e+=b--^c++;return tc(e)}
function tc(a){var b=1,c=0,d,e;if(!(a==undefined||a=="")){b=0;for(d=a.length-1;d>=0;d--){e=a.charCodeAt(d);b=(b<<6&268435455)+e+(e<<14);c=b&266338304;b=c!=0?b^c>>21:b}}return b}function rc(a){if(!a||a==""||a=="none")return 1;if("auto"==a){a=S.domain;if("www."==a.substring(0,4))a=a.substring(4,a.length)}return tc(a.toLowerCase())};var uc="";function vc(a){if(a){if(uc!="")uc+=",";uc+=a}}function wc(a){if(a&&a instanceof Array)for(var b=0;b<a.length;b++)a[b]&&typeof a[b]=="string"&&vc(a[b])}var xc=m;
function yc(a,b){var c="script";(xc=zc(a,b))||(a.google_allow_expandable_ads=m);var d=!Ac();xc&&d&&b.write("<"+c+' src="http://'+y+'/pagead/expansion_embed.js"></'+c+">");var e=Bc(a,b,t("1",0.01)),f=d||e;f&&pa("msie")&&!window.opera?b.write("<"+c+' src="http://'+y+'/pagead/render_ads.js"></'+c+">"):b.write("<"+c+'>google_protectAndRun("ads_core.google_render_ad", google_handleError, google_render_ad);</'+c+">")}function V(a){return a!=l?'"'+a+'"':'""'}
function W(a,b){if(a&&b)window.google_ad_url+="&"+a+"="+b}function X(a){var b=window,c=Aa(a),d=b[a];W(c,d)}function Y(a,b){b!=l&&W(a,z(b))}function Z(a){var b=window,c=Aa(a),d=b[a];Y(c,d)}function $(a,b){var c=window,d=Aa(a),e=c[a];if(d&&e&&typeof e=="object")e=e[b%e.length];W(d,e)}
function Cc(a){var b=a.screen,c=navigator.javaEnabled(),d=-(new Date).getTimezoneOffset();if(b){W("u_h",b.height);W("u_w",b.width);W("u_ah",b.availHeight);W("u_aw",b.availWidth);W("u_cd",b.colorDepth)}W("u_tz",d);W("u_his",history.length);W("u_java",c);navigator.plugins&&W("u_nplug",navigator.plugins.length);navigator.mimeTypes&&W("u_nmime",navigator.mimeTypes.length)}function Dc(a){if(a){a=a.toLowerCase();if(a.substring(0,3)!="ca-")a="ca-"+a}return a}
function Ec(a){if(a){a=a.toLowerCase();if(a.substring(0,9)!="dist-aff-")a="dist-aff-"+a}return a}function Fc(a){var b="google_unique_id";if(a[b])++a[b];else a[b]=1;return a[b]}function Gc(){var a=L&&O("6"),b=zb&&O("1.8.1"),c=M&&O("525");if(Fb&&(a||b||c))return i;else if(Eb&&(c||b))return i;else if(Gb&&b)return i;return m}function Ac(){return(typeof ExpandableAdSlotFactory=="function"||typeof ExpandableAdSlotFactory=="object")&&typeof ExpandableAdSlotFactory.createIframe=="function"}
function zc(a,b){if(a.google_allow_expandable_ads===m||!b.body||a.google_ad_output!="html"||Ua(a,b)||ta(a)||isNaN(a.google_ad_height)||isNaN(a.google_ad_width)||!Gc())return m;return i}function Hc(a,b){if((a.google_unique_id||0)==0&&a.google_ad_output=="html"&&document.body&&typeof b.body.getBoundingClientRect=="function")return C(["36812001","36812002"],t("0.01",0));return""}
function Ic(a){var b="";if((a.google_unique_id||0)==0&&(a.google_ad_output=="js"||a.google_ad_output=="html")){ta(a)||(b=C(["36813001","36813002","36813003","36813004"],t("0.008",0)));if(b=="")b=C(["36813005","36813006"],t("0.008",0))}return b}function Jc(a,b){switch(a){case "36813002":b.a(1);b.b(["js"]);break;case "36813003":b.a(1);b.b(["html"]);break;case "36813004":b.a(2);b.b(["html","js"]);break;case "36813006":b.a(0);b.b(["html","js"]);break}}
function Kc(a,b,c,d){var e=Fc(a);c=c.substring(0,1992);c=c.replace(/%\w?$/,"");var f="script";if((a.google_ad_output=="js"||a.google_ad_output=="json_html")&&(a.google_ad_request_done||a.google_radlink_request_done))b.write("<"+f+' language="JavaScript1.1" src='+V(Lc(c))+"></"+f+">");else if(a.google_ad_output=="html")if(xc&&Ac()){var h=a.google_container_id||d||l;a["google_expandable_ad_slot"+e]=ExpandableAdSlotFactory.createIframe("google_ads_frame"+e,Lc(c),a.google_ad_width,a.google_ad_height,
h)}else{var k='<iframe name="google_ads_frame" width='+V(a.google_ad_width)+" height="+V(a.google_ad_height)+" frameborder="+V(a.google_ad_frameborder)+" src="+V(Lc(c))+' marginwidth="0" marginheight="0" vspace="0" hspace="0" allowtransparency="true" scrolling="no"></iframe>';a.google_container_id?Mc(a.google_container_id,b,k):b.write(k)}else a.google_ad_output=="textlink"&&b.write("<"+f+' language="JavaScript1.1" src='+V(Lc(c))+"></"+f+">")}
function Nc(a,b,c){if(!a)return m;if(!b)return i;return c}function Oc(a){for(var b in ua)a[b]=l;for(b in ya)b=="google_correlator"||(a[b]=l);for(b in za)a[b]=l;a.google_allow_expandable_ads=l;a.google_container_id=l;a.google_tag_info=l;a.google_eids=l}
function Pc(a,b){var c=l,d=window,e=document,f=n,h=d.google_ad_format,k=Qc(d),j;if(d.google_cpa_choice!=c){d.google_ad_url=k+"/cpa/ads?";j=escape(Dc(d.google_ad_client));d.google_ad_region="_google_cpa_region_";X("google_cpa_choice");if(typeof e.characterSet!="undefined")Y("oe",e.characterSet);else typeof e.charset!="undefined"&&Y("oe",e.charset)}else if(B(h)){d.google_ad_url=k+"/pagead/sdo?";j=escape(Ec(d.google_ad_client))}else{d.google_ad_url=k+"/pagead/ads?";j=escape(Dc(d.google_ad_client))}d.google_ad_url+=
"client="+j;X("google_ad_host");X("google_ad_host_tier_id");var g=d.google_num_slots_by_client,u=d.google_num_slots_by_channel,w=d.google_prev_ad_formats_by_region,x=d.google_prev_ad_slotnames_by_region;if(d.google_ad_region==c&&d.google_ad_section!=c)d.google_ad_region=d.google_ad_section;var s=d.google_ad_region==c?"":d.google_ad_region;if(B(h)){d.google_num_sdo_slots=d.google_num_sdo_slots?d.google_num_sdo_slots+1:1;if(d.google_num_sdo_slots>4)return m}else if(sa(d)){d.google_num_0ad_slots=d.google_num_0ad_slots?
d.google_num_0ad_slots+1:1;if(d.google_num_0ad_slots>3)return m}else if(d.google_cpa_choice==c){d.google_num_ad_slots=d.google_num_ad_slots?d.google_num_ad_slots+1:1;if(d.google_num_slots_to_rotate){w[s]=c;x[s]=c;if(d.google_num_slot_to_show==c)d.google_num_slot_to_show=f%d.google_num_slots_to_rotate+1;if(d.google_num_slot_to_show!=d.google_num_ad_slots)return m}else if(d.google_num_ad_slots>6&&s=="")return m}W("dt",n);X("google_language");d.google_country?X("google_country"):X("google_gl");X("google_region");
Z("google_city");Z("google_hints");X("google_safe");X("google_encoding");X("google_last_modified_time");Z("google_alternate_ad_url");X("google_alternate_color");X("google_skip");X("google_targeting");var N=d.google_ad_client;if(g[N])g[N]+=1;else{g[N]=1;g.length+=1}if(w[s])if(!B(h)){Y("prev_fmts",w[s].toLowerCase());g.length>1&&W("slot",g[N])}x[s]&&Y("prev_slotnames",x[s].toLowerCase());if(Nc(h,d.google_ad_slot,d.google_override_format)){Y("format",h.toLowerCase());B(h)||(w[s]=w[s]?w[s]+","+h:h)}else if(d.google_ad_slot)x[s]=
x[s]?x[s]+","+d.google_ad_slot:d.google_ad_slot;X("google_max_num_ads");W("output",d.google_ad_output);X("google_adtest");X("google_ad_callback");X("google_ad_slot");Z("google_correlator");d.google_new_domain_checked==1&&d.google_new_domain_enabled==0&&W("dblk",1);if(d.google_ad_channel){Z("google_ad_channel");for(var rb="",tb=d.google_ad_channel.split(Rc),va=0;va<tb.length;va++){var wa=tb[va];if(u[wa])rb+=wa+"+";else u[wa]=1}Y("pv_ch",rb)}if(d.google_ad_host_channel){Z("google_ad_host_channel");
var Wc=Sc(d.google_ad_host_channel,d.google_viewed_host_channels);Y("pv_h_ch",Wc)}Z("google_page_url");$("google_color_bg",f);$("google_color_text",f);$("google_color_link",f);$("google_color_url",f);$("google_color_border",f);$("google_color_line",f);d.google_reuse_colors?W("reuse_colors",1):W("reuse_colors",0);X("google_font_face");X("google_font_size");X("google_kw_type");Z("google_kw");Z("google_contents");X("google_num_radlinks");X("google_max_radlink_len");X("google_rl_filtering");X("google_rl_mode");
X("google_rt");Z("google_rl_dest_url");X("google_num_radlinks_per_unit");X("google_ad_type");X("google_image_size");X("google_ad_region");wc(d.google_eids);Y("eid",uc);var ub=d.google_allow_expandable_ads;if(ub!=l)ub?W("ea","1"):W("ea","0");Ca&&W("cb",1);Da&&W("cd",1);X("google_feedback");Z("google_referrer_url");Z("google_page_location");W("frm",d.google_iframing);X("google_bid");X("google_ctr_threshold");X("google_cust_age");X("google_cust_gender");X("google_cust_interests");X("google_cust_id");
X("google_cust_job");X("google_cust_u_url");X("google_cust_l");X("google_cust_lh");X("google_cust_ch");X("google_ed");X("google_video_doc_id");X("google_video_product_type");Z("google_ui_features");Z("google_ui_version");Z("google_tag_info");Z("google_only_ads_with_video");Z("google_only_pyv_ads");Z("google_disable_video_autoplay");if(a){Y("dff",lc(a));Y("dfs",pc(a));var A;if(b)if(typeof a.getBoundingClientRect=="function"){var vb=a.getBoundingClientRect();A={x:vb.left,y:vb.top}}else{A={};A.x="-252738";
A.y="-252738"}else try{A=jc(a)}catch(kd){A={};A.x="-252738";A.y="-252738"}var xa=Pb(window);if(A&&xa){Y("biw",xa.width);Y("bih",xa.height);Y("adx",A.x);Y("ady",A.y)}}qc();W("ga_vid",d.gaGlobal.vid);W("ga_sid",d.gaGlobal.sid);W("ga_hid",d.gaGlobal.hid);W("ga_fc",d.gaGlobal.from_cookie);Z("google_analytics_uacct");X("google_ad_override");X("google_flash_version");W("w",d.google_ad_width||-1);W("h",d.google_ad_height||-1);Cc(d);return i}
function Sc(a,b){for(var c=a.split("|"),d=-1,e=[],f=0;f<c.length;f++){var h=c[f].split(Rc);b[f]||(b[f]={});for(var k="",j=0;j<h.length;j++){var g=h[j];if(!(g==""))if(b[f][g])k+="+"+g;else b[f][g]=1}k=k.slice(1);e[f]=k;if(k!="")d=f}var u="";if(d>-1){for(f=0;f<d;f++)u+=e[f]+"|";u+=e[d]}return u}
function Tc(){var a=window,b=document,c=Sa(),d=a.google_enable_osd,e="";if(d===i){e="36813006";Jc(e,c)}else if(d!==m){e=C(["68120011","68120021","68120031","68120041"],t("0.04",0));if(e==""){e=Hc(a,b);if(e==""){e=Ic(a);e!=""&&Jc(e,c)}}}vc(e);var f,h=m,k=m,j=m;switch(e){case "68120031":j=i;case "68120021":k=i;case "68120041":h=i;break;case "36812002":if(!window.google_atf_included){window.google_atf_included=i;na("http://"+y+"/pagead/atf.js")}break}if(h){var g="google_temp_span";
f=a.google_container_id&&Mb(a.google_container_id)||Mb(g);if(!f&&!a.google_container_id){b.write("<span id="+g+"></span>");f=Mb(g)}}var u=m;u=k?Pc(f,j):Pc();f&&f.id==g&&Vb(f);if(u){c.q(a.google_ad_output,a.google_ad_url);Kc(a,b,a.google_ad_url);Oc(a)}}function Lc(a){var b=(new Date).getTime()-n,c="&dtd="+(b<1000?b:"M");return a+c}function Uc(a,b,c,d){var e=gb(a,b,c,d);yc(window,document);return e}
function Vc(){var a=window,b=l;if(a.google_ad_frameborder==b)a.google_ad_frameborder=0;if(a.google_ad_output==b)a.google_ad_output="html";if(B(a.google_ad_format)){var c=a.google_ad_format.match(/^(\d+)x(\d+)_.*/);if(c){a.google_ad_width=parseInt(c[1],10);a.google_ad_height=parseInt(c[2],10);a.google_ad_output="html"}}if(a.google_ad_format==b&&a.google_ad_output=="html")a.google_ad_format=a.google_ad_width+"x"+a.google_ad_height;bb(a,document);if(a.google_num_slots_by_channel==b)a.google_num_slots_by_channel=
[];if(a.google_viewed_host_channels==b)a.google_viewed_host_channels=[];if(a.google_num_slots_by_client==b)a.google_num_slots_by_client=[];if(a.google_prev_ad_formats_by_region==b)a.google_prev_ad_formats_by_region=[];if(a.google_prev_ad_slotnames_by_region==b)a.google_prev_ad_slotnames_by_region=[];if(a.google_correlator==b)a.google_correlator=n;if(a.google_adslot_loaded==b)a.google_adslot_loaded={};if(a.google_adContentsBySlot==b)a.google_adContentsBySlot={};if(a.google_flash_version==b)a.google_flash_version=
ra();if(a.google_new_domain_checked==b)a.google_new_domain_checked=0;if(a.google_new_domain_enabled==b)a.google_new_domain_enabled=0}function Xc(a){for(var b={},c=a.split("?"),d=c[c.length-1].split("&"),e=0;e<d.length;e++){var f=d[e].split("=");if(f[0])try{b[f[0].toLowerCase()]=f.length>1?window.decodeURIComponent?decodeURIComponent(f[1].replace(/\+/g," ")):unescape(f[1]):""}catch(h){}}return b}
function Yc(){var a=window,b=Xc(document.URL);if(b.google_ad_override){a.google_ad_override=b.google_ad_override;a.google_adtest="on"}}function Mc(a,b,c){if(a){var d=b.getElementById(a);if(d&&c&&c.length!=""){d.style.visibility="visible";d.innerHTML=c}}}var Rc=/[+, ]/;window.google_render_ad=Tc;var Zc={google:1,googlegroups:1,gmail:1,googlemail:1,googleimages:1,googleprint:1};function $c(a){var b=a.google_page_location||a.google_page_url;if(!b)return m;b=b.toString();if(b.indexOf("http://")==0)b=b.substring(7,b.length);else if(b.indexOf("https://")==0)b=b.substring(8,b.length);var c=b.indexOf("/");if(c==-1)c=b.length;var d=b.substring(0,c),e=d.split("."),f=m;if(e.length>=3)f=e[e.length-3]in Zc;if(e.length>=2)f=f||e[e.length-2]in Zc;return f}
function Bc(a,b,c){if($c(a)){a.google_new_domain_checked=1;return m}if(a.google_new_domain_checked==0){var d=Math.random();if(d<=c){var e="http://"+la+"/pagead/test_domain.js",f="script";b.write("<"+f+' src="'+e+'"></'+f+">");a.google_new_domain_checked=1;return i}}return m}function Qc(a){if(!$c(a)&&a.google_new_domain_enabled==1)return"http://"+la;return"http://"+ma};var ad=["30143070","30143071","30143072","30143073","30143074","30143075"],bd=typeof window.postMessage=="function"||typeof window.postMessage=="object"||typeof document.postMessage=="function",dd=function(a,b){typeof A1_googleCreateSlot=="function"?A1_googleCreateSlot(a.google_ad_client):cd(a,b)},ed=function(){if(!(bd||!M))return m;return i},fd=function(a){if(ta(a))return m;var b=a.google_ad_output;if(b&&b!="html")return m;var c=a.google_ad_client;if(typeof c!="string"||c.substring(0,4)!="pub-"&&
c.substring(0,7)!="ca-pub-")return m;return i},hd=function(a){if(typeof a.google_a1_eid=="string")return a.google_a1_eid;var b=t("0.005",0);a.google_a1_eid=gd(ad,b);return a.google_a1_eid},cd=function(a,b){if(!a.google_included_a1_script){var c="script",d="/pagead/show_ads_sra3.js?v\x3d1";b.write("<"+c+' src="http://'+y+d+'"></'+c+">");a.google_included_a1_script=i}},gd=function(a,b){var c=Math.random();if(c<b){var d=Math.floor(c/b*a.length);return a[d]}return""};function id(){Yc();eb("show_ads.google_init_globals",Uc,Vc);yc(window,document)}function jd(){if(!ed(window)||!fd(window))id();else{var a=hd(window);if(a){vc(a);window.google_allow_expandable_ads=m}!a||a=="30143070"?id():dd(window,document)}}eb("show_ads.main",gb,jd);
})()