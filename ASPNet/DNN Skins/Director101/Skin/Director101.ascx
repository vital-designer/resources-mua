<%@ Control language="vb" CodeBehind="~/admin/Skins/skin.vb" AutoEventWireup="false" Explicit="True" Inherits="DotNetNuke.UI.Skins.Skin" %>
<%@ Register TagPrefix="dnn" TagName="LOGO" Src="~/Admin/Skins/Logo.ascx" %>
<%@ Register TagPrefix="dnn" TagName="MENU" Src="~/Admin/Skins/SolPartMenu.ascx" %>
<%@ Register TagPrefix="dnn" TagName="LOGIN" Src="~/Admin/Skins/Login.ascx" %>
<%@ Register TagPrefix="dnn" TagName="USER" Src="~/Admin/Skins/User.ascx" %>
<%@ Register TagPrefix="dnn" TagName="CURRENTDATE" Src="~/Admin/Skins/CurrentDate.ascx" %>
<%@ Register TagPrefix="dnn" TagName="LINKS" Src="~/Admin/Skins/Links.ascx" %>
<%@ Register TagPrefix="dnn" TagName="TERMS" Src="~/Admin/Skins/Terms.ascx" %>
<%@ Register TagPrefix="dnn" TagName="PRIVACY" Src="~/Admin/Skins/Privacy.ascx" %>
<%@ Register TagPrefix="dnn" TagName="COPYRIGHT" Src="~/Admin/Skins/Copyright.ascx" %>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
<html>
<head>
    <link href="skin.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <table cellspacing="0" cellpadding="0" width="780" height="100% "border="0" align="center">
        <tbody>
            <tr>
                <td class="r1TD1" valign="bottom" nowrap="nowrap"> </td>
                <td class="r1TD2" valign="bottom" align="right">
                    <table cellspacing="0" cellpadding="0" width="100%" border="0">
                        <tbody>
                            <tr>
                                <td valign="middle" align="left" width="250" height="130">
                                    <dnn:LOGO runat="server" id="dnnLOGO" /> 
                                </td>
                                <td id="HeaderPane" valign="middle" align="center" visible="false" runat="server" width="100%">
                                </td>
                                <td class="date" valign="bottom" align="right">
                                     
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td class="r1TD3" valign="bottom" nowrap="nowrap">
                </td>
            </tr>
            <tr>
                <td class="r2TD1" valign="top">
                </td>
                <td class="r2TD2" valign="middle" nowrap="nowrap">
                    <table cellspacing="0" cellpadding="0" width="100%" border="0">
                        <tbody>
                            <tr>
                                <td class="r2TD2a noadbriteinline" valign="middle" nowrap="nowrap">
                                    <dnn:MENU runat="server" id="dnnMENU" userootbreadcrumbarrow="false" /> 
                                </td>
                                <td class="r2TD2b" valign="middle" nowrap="nowrap" align="right">
                                    <dnn:LOGIN runat="server" id="dnnLOGIN" cssclass="one" class="NormalBold"/> 
                                    <strong> | </strong> <dnn:USER runat="server" id="dnnUSER" cssclass="one" class="NormalBold" /> 
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td class="r2TD3" valign="top">
                </td>
            </tr>
            <tr>
                <td class="r3TD1" valign="top">
                </td>
                <td class="r3TD2" valign="top" height="24">
                    <table cellspacing="0" cellpadding="0" width="100%" height="24" border="0">
                        <tbody>
                            <tr>
                                <td height="24" align="left" valign="middle"  id="QuotePane" visible="false" runat="server">
                                </td>
                                <td valign="middle" height="24">
                                </td>
                                <td align="right" valign="middle" height="24"> <dnn:CURRENTDATE runat="server" id="dnnCURRENTDATE" /> </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td class="r3TD3" valign="top">
                </td>
            </tr>
            <tr>
                <td class="r4TD1" valign="top">&nbsp;
                </td>
                <td class="r4TD2" valign="top"><table cellspacing="0" cellpadding="0" width="100%" border="0">
                        <tbody>
                            <tr>
                                <td id="TopPane" valign="top" align="center" visible="false" runat="server" style="padding-bottom:8px;">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td id="LeftPane" valign="top" align="left" visible="false" runat="server" >
                                </td>
                                <td class="r4TD2a" id="ContentPane" valign="top" align="left" visible="false" runat="server">
                                </td>
                                <td id="RightPane" valign="top" align="left" visible="false" runat="server" >
                                </td>
                            </tr>
                        </tbody>
                  </table><img src="<%= SkinPath %>spacer.gif">
                    <table cellspacing="0" cellpadding="0" width="100%" border="0">
                        <tbody>
                            <tr>
                                <td id="BottomPane" valign="top" align="center" visible="false" runat="server">
                                </td>
                            </tr>
                        </tbody>
                    </table><img src="<%= SkinPath %>spacer.gif">
                </td>
                <td class="r4TD3" valign="top">
                </td>
            </tr>
            <tr>
                <td class="r5TD1" valign="top">
                </td>
                <td class="r5TD2" valign="bottom" nowrap="nowrap">
                    <table cellspacing="0" cellpadding="0" width="100%" border="0">
                        <tbody>
                            <tr>
                                <td class="r5TD2a">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td class="r5TD3" valign="top">
                </td>
            </tr>
            <tr>
                <td class="r6TD1" valign="top">
                </td>
                <td class="r6TD2" valign="top">
                    <table cellspacing="0" cellpadding="0" width="100%" border="0">
                        <tbody>
                            <tr>
                              <td class="r6TD2a">
                                    <br />
                                    <span class="NormalBold">&nbsp; 
                                    <dnn:LINKS runat="server" id="dnnLINKS" cssclass="one" Separator="&nbsp;&nbsp;|&nbsp;&nbsp;" />                                
                                  </span></td>
                            </tr>
                            <tr>
                                <td class="r6TD2b" align="left">
                                    <span class="NormalBold">&nbsp; 
                                    <dnn:TERMS runat="server" id="dnnTERMS" cssclass="one"/> 
                                    <strong> | </strong> 
                                    <dnn:PRIVACY runat="server" id="dnnPRIVACY" cssclass="one"/> 
                                    </span><br />                              </td>
                            </tr>
                            <tr>
                                <td class="r6TD2c" valign="middle" align="left">
                                    &nbsp;&nbsp;<dnn:COPYRIGHT runat="server" id="dnnCOPYRIGHT" /> 
                                    <br />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td class="r6TD3" valign="top">
                </td>
            </tr>
            <tr>
                <td class="r7TD1" valign="top" nowrap="nowrap">
                </td>
                <td class="r7TD2" valign="top">
                </td>
                <td class="r7TD3" valign="top" nowrap="nowrap">
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>

