<%@ Import Namespace = "System.Data" %>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" >
<html>
	<head>
		<title>TestRepeater</title>
	</head>
	<body>
		<form id="frmTest" method="post" runat="server">
			<table width="100%" border="0">
				<tr>
					<td>&nbsp;&nbsp;Repeater control with Paging functionality</td>
				</tr>
				<tr>
					<td>&nbsp;&nbsp;<asp:label id="lblCurrentPage" runat="server"></asp:label></td>
				</tr>
				<tr>
					<td>&nbsp;&nbsp;<asp:button id="cmdPrev" runat="server" text=" << " onclick="cmdPrev_Click"></asp:button>
						&nbsp;<asp:button id="cmdNext" runat="server" text=" >> " onclick="cmdNext_Click"></asp:button></td>
				</tr>
			</table>
			<table border="1">
				<asp:repeater id="repeaterItems" runat="server">
					<itemtemplate>
						<tr>
							<td>&nbsp;&nbsp;<b><%# DataBinder.Eval(Container.DataItem, "ItemName") %></b></td>
							<td>&nbsp;&nbsp;<b><%# DataBinder.Eval(Container.DataItem, "ItemDescription") %></b></td>
							<td>&nbsp;&nbsp;<b><%# DataBinder.Eval(Container.DataItem, "ItemPrice") %></b></td>
							<td>&nbsp;&nbsp;<b><%# DataBinder.Eval(Container.DataItem, "ItemInStock") %></b></td>
						</tr>
					</itemtemplate>
				</asp:repeater>
			</table>
		</form>
	</body>
</html>

<script runat="server" language="C#">

		public int CurrentPage
		{
			get
			{
				// look for current page in ViewState
				object o = this.ViewState["_CurrentPage"];
				if (o == null)
					return 0;	// default to showing the first page
				else
					return (int) o;
			}

			set
			{
				this.ViewState["_CurrentPage"] = value;
			}
		}

		private void Page_Load(object sender, System.EventArgs e)
		{
			// Call the ItemsGet method to populate control,
			// passing in the sample data.
			ItemsGet();
		}

		private void ItemsGet()
		{
			// Read sample item info from XML document into a DataSet
			DataSet Items = new DataSet();
			Items.ReadXml(MapPath("Items.xml"));

			// Populate the repeater control with the Items DataSet
			PagedDataSource objPds = new PagedDataSource();
			objPds.DataSource = Items.Tables[0].DefaultView;
			objPds.AllowPaging = true;
			objPds.PageSize = 3;

			objPds.CurrentPageIndex = CurrentPage; 

			lblCurrentPage.Text = "Page: " + (CurrentPage + 1).ToString() + " of " 
				+ objPds.PageCount.ToString();

			// Disable Prev or Next buttons if necessary
			cmdPrev.Enabled = !objPds.IsFirstPage;
			cmdNext.Enabled = !objPds.IsLastPage;

			repeaterItems.DataSource=objPds;
			repeaterItems.DataBind();
		}

		private void cmdPrev_Click(object sender, System.EventArgs e)
		{
			// Set viewstate variable to the previous page
			CurrentPage -= 1;

			// Reload control
			ItemsGet();
		}

		private void cmdNext_Click(object sender, System.EventArgs e)
		{
			// Set viewstate variable to the next page
			CurrentPage += 1;

			// Reload control
			ItemsGet();
		}
</script>