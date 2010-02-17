<%@ Page Language="VB" AutoEventWireup="true" CodeFile="Default.aspx.vb" Inherits="_Default" %>

<html>
<head>
<title>ASP.NET AJAX EXTENSIONS - FILE UPLOAD WORKAROUND</title>

<script>
function iFrame_OnUploadComplete() { 
	document.form1.btnUploaded.click();	
}
</script>
</head>
<body>
<form id="form1" target="_self" runat="server">
    <asp:ScriptManager ID="ScriptManager1" EnablePartialRendering="true" runat="server" />

	<!-- this label is just to make sure that the page is working without any postback -->
	<asp:Label ID="lblPageLoadTime" runat="server" Text="Label" />

	<!-- an iframe that loads the same page, but just displays file upload panel (pnlFileUpload) -->
	<asp:Panel ID="pnlIFrame" runat="server">
		<iframe src="default.aspx?MODE=IFRAME" style="width:300px;height:100px;border-width:0;" frameborder="0">
			Your browser does not support iframes
		</iframe>
	</asp:Panel>
	
	<asp:UpdatePanel ID="pnlAjax" runat="server">
	
		<ContentTemplate>	
			
			<!-- a button that raises its click event after file upload in iframe is complete -->
			<asp:Button ID="btnUploaded" style="display:none;" UseSubmitBehavior="false" runat="server" OnClick="btnUploaded_Click" />
			
			<!-- a listbox to display all the list of files uploaded in the session -->
			List of files uploaded:<br />			
			<asp:ListBox ID="lstFilesList" style="width:300px;height:150px;" runat="server" />
			
			<p><a href="http://vinayakshrestha.wordpress.com/2007/03/31/ajax-extensions-file-upload-workaround/">Read the full article</a></p>
			<p><a href="http://vinayakshrestha.wordpress.com">Visit my blog homepage</a></p>
			
		</ContentTemplate>
		
		<Triggers>
			<asp:AsyncPostBackTrigger ControlID="btnUploaded" EventName="Click" />
		</Triggers>
	
	</asp:UpdatePanel>


	<!-- a panel for file upload section -->
	<asp:Panel ID="pnlFileUpload" Visible="false" runat="server">
	
		<asp:FileUpload ID="fileTestUpload" runat="server" />
		
		<br /><asp:Button ID="btnUpload" Text="Upload" runat="server" />
		
	</asp:Panel>


</form>


</body>
</html>
