<%@ Page Language="C#" AutoEventWireup="true"  CodeFile="WebsiteThumbnailImage.aspx.cs" Inherits="WebsiteThumbnail.WebsiteThumbnailImagePage" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head runat="server">
    <title>Website Thumbnail Image Generator</title>
</head>
<body>
    <form id="form1" runat="server">
    <div>
        <table>
            <tr>
                <td >
                    <asp:TextBox ID="txtWebsiteAddress" runat="server" Width="415px">www.google.com</asp:TextBox>&nbsp;</td>
                <td >
                    &nbsp;<asp:Button ID="btnShowThumbnailImage" runat="server" Text="Show Thumbnail Image" OnClick="btnShowThumbnailImage_Click" /></td>
            </tr>
            <tr>
                <td>
                    Width:
                    <asp:TextBox ID="txtWidth" runat="server">200</asp:TextBox>
                    &nbsp;Height:
                    <asp:TextBox ID="txtHeight" runat="server">200</asp:TextBox></td>
                <td>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="height: 32px">
                    <asp:Image ID="imgWebsiteThumbnailImage" runat="server" Visible="false"/></td>
            </tr>
        </table>    
    </div>
    </form>
</body>
</html>
