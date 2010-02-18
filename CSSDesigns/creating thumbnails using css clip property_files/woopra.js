function WoopraKeyValue(_k,_v){
    this.k=_k;
    this.v=_v;
}

function WoopraEvent(){
    var trkr=false;
    var entries=new Array();

    this.setTracker=function(_trkr){
        trkr=_trkr;
    }

    this.addProperty=function(key,value){
        entries[entries.length]=new WoopraKeyValue(key,value);
    }

    this.fire=function(){
        var buffer='';

        for (var i=0;i<entries.length;i++){
            buffer+='&'+encodeURIComponent(entries[i].k)+'='+encodeURIComponent(entries[i].v);
        }

        if(buffer!=''){
            var _mod = ((document.location.protocol=="https:")?'/woopras/customevent.jsp?':'/customevent/');
            var _url= trkr.getEngine() + _mod +'cookie=' +trkr.readcookie('wooTracker') + '&type=' + encodeURIComponent('custom')+ buffer + '&ra='+trkr.randomstring();
            trkr.request(_url);
        }
    }
}

function WoopraTracker(){

    var pntr=false;
    var chat=false;

    var wx_static=false;
    var wx_engine=false;

    var visitor_data=false;

    this.initialize=function(){

        pntr=this;

        visitor_data=new Array();

        if(!this.readcookie('wooTracker')){
            this.createcookie('wooTracker', this.randomstring(), 10*1000);
        }
        if(!this.readcookie('sessionCookie')){
            this.createcookie('sessionCookie', this.randomstring(), -1);
        }

        if(document.location.protocol=="https:"){
            wx_static="https://sec1.woopra.com";
            wx_engine="https://sec1.woopra.com";
        }else{
            wx_static="http://static.woopra.com";
            wx_engine='http://'+((location.hostname.indexOf('www.')<0)?location.hostname:location.hostname.substring(4))+'.woopra-ns.com';
        }
        //
        if(document.addEventListener){
            document.addEventListener("mousedown",this.clicked,false);
        }
        else{
            document.attachEvent("onmousedown",this.clicked);
        }
  
        setTimeout(function(){
          pntr.ping();
        },10*1000);

        if(document.addEventListener){
            document.addEventListener("mousemove",this.moved,false);
        }
        else{
            document.attachEvent("onmousemove",this.moved);
        }

    }

    this.addVisitorProperty=function(key,value){
        var cursor=visitor_data.length;
        visitor_data[cursor]=new WoopraKeyValue(key,value);
    }
    this.getStatic=function(){
        return wx_static;
    }
    this.getEngine=function(){
        return wx_engine;
    }
    this.setEngine=function(e){
        wx_engine=e;
    }

    this.sleep=function(millis){
        var date = new Date();
        var curDate = new Date();
        while(curDate-date < millis){
            curDate=new Date();
        }
    }

    this.randomstring=function(){
        var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        var s = '';
        for (i = 0; i < 32; i++) {
            var rnum = Math.floor(Math.random() * chars.length);
            s += chars.substring(rnum, rnum + 1);
        }
        return s;
    }

    this.getnavigatortoken=function(){
        if(window.opera || window.Opera){
            return 'O';
        }
        if(navigator.userAgent){
            return 'U';
        }
        return "X";
    }

    this.getlantoken=function(){
        return (navigator.browserLanguage || navigator.language || "");
    }

    this.readcookie=function(k) {
        var c=""+document.cookie;
        var ind=c.indexOf(k);
        if (ind==-1 || k==""){
            return "";
        }
        var ind1=c.indexOf(';',ind);
        if (ind1==-1){
            ind1=c.length;
        }
        return unescape(c.substring(ind+k.length+1,ind1));
    }

    this.createcookie=function(k,v,days){
        var exp='';
        if(days>0){
            var expires = new Date();
            expires.setDate(expires.getDate() + days);
            exp = expires.toGMTString();
        }
        cookieval = k + '=' + v + '; ' + ((exp)?('expires=' + exp + ' ;'):'') + 'path=/';
        document.cookie = cookieval;
    }

    this.request=function(url){
        var script=document.createElement('script');
        script.type="text/javascript";
        script.src = url;
        document.getElementsByTagName('head')[0].appendChild(script);
    }

    this.track=function(){

        var date=new Date();

        var woopra_request=new Array();

        woopra_request[woopra_request.length]=new WoopraKeyValue('sessioncookie', this.readcookie('sessionCookie'));
        woopra_request[woopra_request.length]=new WoopraKeyValue('cookie', this.readcookie('wooTracker'));
        woopra_request[woopra_request.length]=new WoopraKeyValue('browsertoken',this.getnavigatortoken());
        woopra_request[woopra_request.length]=new WoopraKeyValue('platformtoken',navigator.platform);
        woopra_request[woopra_request.length]=new WoopraKeyValue('language',this.getlantoken());
        woopra_request[woopra_request.length]=new WoopraKeyValue('pagetitle',document.title);
        woopra_request[woopra_request.length]=new WoopraKeyValue('referer',document.referrer);
        woopra_request[woopra_request.length]=new WoopraKeyValue('screen',screen.width + 'x' + screen.height);
        woopra_request[woopra_request.length]=new WoopraKeyValue('localtime',date.getHours()+':'+date.getMinutes());
        

        var i=0;

        for (i=0;i<visitor_data.length;i++){
            visitor_data[i].k='cv_'+visitor_data[i].k;
            woopra_request[woopra_request.length]=visitor_data[i];
        }

        var req_url='';
        for (i=0;i<woopra_request.length;i++){
            req_url+="&"+encodeURIComponent(woopra_request[i].k)+"="+encodeURIComponent(woopra_request[i].v);
        }

        var _mod = ((document.location.protocol=="https:")?'/woopras/visit.jsp?':'/visit/');
        this.request(wx_engine + _mod +'ra='+this.randomstring()+req_url);
    }


    this.pingServer=function(){
        var _mod = ((document.location.protocol=="https:")?'/woopras/ping.jsp?':'/ping/');
        var _url = wx_engine + _mod + 'cookie='+this.readcookie('wooTracker')+'&idle='+parseInt(idle/1000)+'&ra='+this.randomstring();
        this.request(_url);
    }

    this.clicked=function(e) {

        var cElem = (e.srcElement) ? e.srcElement : e.target;
        if(cElem.tagName == "A"){
            var link=cElem;
            var _download = link.pathname.match(/(?:doc|eps|jpg|png|svg|xls|ppt|pdf|xls|zip|txt|vsd|vxd|js|css|rar|exe|wma|mov|avi|wmv|mp3)($|\&)/);
            var ev=new WoopraEvent();
            ev.setTracker(pntr);
            //
            if(_download){
                ev.addProperty('type','download');
                ev.addProperty('name',link.href);
                ev.fire();
                pntr.sleep(100);
            }
            if (!_download&&link.hostname != location.host && link.hostname.indexOf('javascript')==-1 && link.hostname!=''){
                ev.addProperty('type','exit');
                ev.addProperty('name',link.href);
                ev.fire();
                pntr.sleep(400);
            }
        }
    }

    var last_activity=new Date();
    var idle=0;

    this.moved=function(){
      last_activity=new Date();       
      idle=0;
    }

    this.ping=function(){
       this.pingServer();
       var now=new Date();
       if(now-last_activity>10000){
         idle=now-last_activity;;
       }
    }

    this.startConversation=function(arr){
        if(!chat){
            chat='loading';
            var fcn=function(){
                chat=new WoopraChat();
                chat.load(pntr,arr);
                chat.showNotification();
            }
            var src=wx_static+'/js/woopra-chat.js'+'?a='+Math.random();
            this.loadScript(src,fcn);
        }
    }
    
    this.loadScript=function(src,hook){
            var script=document.createElement('script');
            script.type='text/javascript';
            script.src=src;
            document.getElementsByTagName('head')[0].appendChild(script);

            script.onload=function(){
                hook.apply();
            };
            script.onreadystatechange = function() {
                if (this.readyState == 'complete'|| this.readyState=='loaded') {
                   hook.apply();
                }
            }

    }
}


var woopraTracker=new WoopraTracker();
woopraTracker.initialize();


var __k=false;
var __v=false;

if(typeof woopra_array!='undefined'){
    for (__k in woopra_array){
        __v=woopra_array[__k];
        try{
            if(__v && (typeof __v != 'function') && __v.toString().length<128){
                woopraTracker.addVisitorProperty(__k,__v);
            }
        }catch(e){}
    }
}

if(typeof woopra_visitor!='undefined'){
    for (__k in woopra_visitor){
        __v=woopra_visitor[__k];
        try{
            if(__v && (typeof __v != 'function') && __v.toString().length<128){
                woopraTracker.addVisitorProperty(__k,__v);
            }
        }catch(e){}
    }
}

woopraTracker.track();

if(typeof woopra_event!='undefined'){
    var ev=new WoopraEvent();
    ev.setTracker(woopraTracker);
//
    for (__k in woopra_event){
        __v=woopra_event[__k];
        try{
            if(__v && (typeof __v != 'function') && __v.toString().length<128){
                ev.addProperty(__k,__v);
            }
        }catch(e){}
    }
//
    ev.fire();
}

