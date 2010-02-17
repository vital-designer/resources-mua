
Partial Class _Default
    Inherits System.Web.UI.Page

	Protected Sub Page_Load(ByVal sender As Object, ByVal e As System.EventArgs) Handles Me.Load
		lblPageLoadTime.Text = "This page was loaded at: " & Now.ToString
		GenerateUploadForm()
	End Sub

	Protected Sub GenerateUploadForm()
		' if querystring parameter "MODE" is set to "IFRAME" 
		'then just display file upload panel (pnlFileUpload) and hide everything else
		Dim mode As String = Request.QueryString("MODE")
		If Not mode = "IFRAME" Then Return
		pnlAjax.Visible = False
		pnlIFrame.Visible = False
		lblPageLoadTime.Visible = False
		pnlFileUpload.Visible = True
		If Not IsPostBack Then Session("UploadedDocumentsList") = Nothing
	End Sub

	Protected Sub btnUploaded_Click(ByVal sender As Object, ByVal e As System.EventArgs)
		If Session("UploadedDocumentsList") Is Nothing Then Return
		' display list of files uploaded in the listbox
		Dim filesArray As ArrayList = CType(Session("UploadedDocumentsList"), ArrayList)
		lstFilesList.DataSource = filesArray
		lstFilesList.DataBind()
	End Sub

	Protected Sub btnUpload_Click(ByVal sender As Object, ByVal e As System.EventArgs) Handles btnUpload.Click
		' when upload button is clicked, save the filename to the session
		If Not fileTestUpload.HasFile Then Return
		Dim filesArray As ArrayList
		' create new arrayList for storing filenames if it does not already exist
		If Session("UploadedDocumentsList") Is Nothing Then
			filesArray = New ArrayList
		Else
			filesArray = CType(Session("UploadedDocumentsList"), ArrayList)
		End If
		filesArray.Add(fileTestUpload.FileName)
		Session("UploadedDocumentsList") = filesArray
		' the following code triggers upload completion event in client side
		ClientScript.RegisterStartupScript(Page.GetType, "Upload Completed", "window.parent.iFrame_OnUploadComplete();", True)
	End Sub

End Class