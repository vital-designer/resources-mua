function applyOnSubmitToForms() {
if (document.getElementById("commentform") == null )
	return;
	var cform = document.getElementById("commentform"); 
	cform.onsubmit = function () {
		var blnvalidate = true;
		var oElement = document.getElementById("author");
    	if ( oElement.value == "" ) {
				alert("Please input your name");
     				return false;     				
    			}
    	var oElement2 = document.getElementById("email");
    	var emailFilter=/^.+@.+\..{2,3}$/;
    	if (!emailFilter.test(oElement2.value)) {
     				alert("Please input a valid email");
				return false;
    			}
    	var oElement3 = document.getElementById("spamq");
    	if ( oElement3.value == "" ) {
     				alert("Please answer the anti-spam question");
				return false;
    			}		
    	var oElement4 = document.getElementById("comment");
    	var formcontent = oElement4.value;
    	if ( formcontent.length < 1 ) {
     				alert("Please input a comment");
				return false;
    			}			
    	return true;
	}		
}		

function addLoadEvent(func) {
 	var oldonload = window.onload;
	if (typeof window.onload != 'function') {
		window.onload = func;
	} else {
		window.onload = function() 
		{
	      		oldonload();
	      		func();
	    	}
	}
}
addLoadEvent(applyOnSubmitToForms);
