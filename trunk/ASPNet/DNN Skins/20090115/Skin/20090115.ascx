<%@ Control language="vb" CodeBehind="~/admin/Skins/skin.vb" AutoEventWireup="false" Explicit="True" Inherits="DotNetNuke.UI.Skins.Skin" %>
<%@ Register TagPrefix="dnn" TagName="CURRENTDATE" Src="~/Admin/Skins/CurrentDate.ascx" %>
<%@ Register TagPrefix="dnn" TagName="USER" Src="~/Admin/Skins/User.ascx" %>
<%@ Register TagPrefix="dnn" TagName="LOGIN" Src="~/Admin/Skins/Login.ascx" %>
<%@ Register TagPrefix="dnn" TagName="LOGO" Src="~/Admin/Skins/Logo.ascx" %>
<%@ Register TagPrefix="dnn" TagName="SOLPARTMENU" Src="~/Admin/Skins/SolPartMenu.ascx" %>
<%@ Register TagPrefix="dnn" TagName="BREADCRUMB" Src="~/Admin/Skins/BreadCrumb.ascx" %>
<%@ Register TagPrefix="dnn" TagName="SEARCH" Src="~/Admin/Skins/Search.ascx" %>
<%@ Register TagPrefix="dnn" TagName="LINKS" Src="~/Admin/Skins/Links.ascx" %>
<%@ Register TagPrefix="dnn" TagName="TERMS" Src="~/Admin/Skins/Terms.ascx" %>
<%@ Register TagPrefix="dnn" TagName="PRIVACY" Src="~/Admin/Skins/Privacy.ascx" %>
<%@ Register TagPrefix="dnn" TagName="COPYRIGHT" Src="~/Admin/Skins/Copyright.ascx" %>
<table class="body">
  <tr>
    <td><table border="0" cellpadding="0" cellspacing="0" align="center" class="wraptable">
        <!-- User and Search -->
        <tr>
          <td colspan="3" class="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" >
              <tr>
              	<td width="50%" class="user" align="left"><dnn:USER runat="server" id="dnnUSER" CssClass="user" />&nbsp;&bull;&nbsp;<dnn:LOGIN runat="server" id="dnnLOGIN" CssClass="user" /></td>
                <td width="50%" class="user" align="right" nowrap="nowrap"><dnn:SEARCH runat="server" id="dnnSEARCH" CssClass="search" Submit="" /></td>
              </tr>
             </table
          ></td>
        </tr>
        <!-- Header -->
        <tr>
          <td colspan="3"><table width="100%" border="0" cellpadding="0" cellspacing="0" style="padding:10px 0px 10px 0px;">
              <tr height="96">
                <td width="19" nowrap>&nbsp;</td>
                <td ><dnn:LOGO runat="server" id="dnnLOGO" /></td>
                <td nowrap id="HeaderPane" runat="server" class="headerpane" visible="false"></td>
              </tr>
            </table></td>
        </tr>
        <!-- Solpart Menu -->
        <tr height="38">
          <td colspan="3" class="menubg noadbriteinline"><dnn:SOLPARTMENU
				runat="server"
				id="dnnSOLPARTMENU"
				usearrows="true"
				userootbreadcrumbarrow="false"
				usesubmenubreadcrumbarrow="false"
				rootmenuitemcssclass="rootmenuitem"
				rootmenuitemselectedcssclass="rootmenuitemselected"
				rootmenuitembreadcrumbcssclass="rootmenuitembreadcrumb"
				submenucssclass="submenu noadbriteinline"
				submenuitembreadcrumbcssclass="submenuitembreadcrumb"
				submenuitemselectedcssclass="submenuitemselected"
				delaysubmenuload="true"
			/>
          </td>
        </tr>
        <!-- Panes -->
        <tr valign="top" height="100%">
          <td colspan="3" width="100%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr valign="top">
                <td id="TopPane" runat="server" class="toppane" visible="false"></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr valign="top">
                <td width="190px" nowrap id="LeftPane" runat="server" class="leftpane" visible="false"></td>
                <td width="100%" id="ContentPane" runat="server" class="contentpane" visible="false"></td>
                <td width="190px" nowrap id="RightPane" runat="server" class="rightpane" visible="false"></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr valign="top">
                <td id="BottomPane" runat="server" class="bottompane" visible="false">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <!-- Footer -->
        <tr>
          <td colspan="3" class="bottom footer"><dnn:LINKS runat="server" id="dnnLINKS" Separator="&nbsp;&nbsp;&bull;&nbsp;&nbsp;" CssClass="footer" />
            <br>
            <dnn:PRIVACY runat="server" id="dnnPRIVACY" CssClass="footer" />
            &nbsp;&bull;&nbsp;
            <dnn:TERMS runat="server" id="dnnTERMS" CssClass="footer" />
            &nbsp;&bull;&nbsp;
            <dnn:COPYRIGHT runat="server" id="dnnCOPYRIGHT" CssClass="footer" />
            <br>
            &nbsp; </td>
        </tr>
      </table></td>
  </tr>
</table>