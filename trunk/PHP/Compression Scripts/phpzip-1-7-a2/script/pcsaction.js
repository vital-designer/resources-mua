<!--
// --------------------------------------------------------------------------------
// PhpConcept Script - PhpZip Action Window
// --------------------------------------------------------------------------------
// License GNU/GPL - Vincent Blavet - December 2001
// http://www.phpconcept.net
// --------------------------------------------------------------------------------

  // ----- Global variable identity of the action window
  var v_win_action=0;

  // --------------------------------------------------------------------------------
  // Function :
  // Description :
  // --------------------------------------------------------------------------------
  function PcjsActionWindow(p_url, p_action /*, p_argument, p_argument, ... */)
  {
    // ----- Check the number of arguments
    if (arguments.length < 2)
    {
      alert("Invalid number of arguments for PcjsActionWindow()");
      return false;
    }

    // ----- Compose the basic called URL
    if (p_action != "")
    var v_url = p_url+"?a_action="+escape(p_action);
    else
    var v_url = p_url;

    // ----- Look for optional arguments
    for (i=2; i<arguments.length; i++)
    {
      // ----- Extract the argument name and argument value
      var v_item = arguments[i].split("=", 2);

      // ----- Complete the URL
      v_url = v_url+"&a_"+escape(v_item[0])+"="+escape(v_item[1]);
    }

    // ----- Set & calculate window size
    var v_width=340;
    var v_height=400;
    var v_left = (screen.width-v_width)/2;
    var v_top = (screen.height-v_height)/2;

    // ----- Set window properties
    var v_settings = 'width='+v_width+',height='+v_height+',top='+v_top+',left='+v_left+',scrollbars=no,location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=yes';
//    var v_settings = 'width='+v_width+',height='+v_height+',top='+v_top+',left='+v_left+',scrollbars=yes,location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';

    // ----- Open window
    v_win = window.open(v_url,"PhpZipAction",v_settings);

    // ----- Set name of the main window
    window.name = "PhpZip";

    // ----- Give focus to window
    v_win.focus();
  }
  // --------------------------------------------------------------------------------

// -->

