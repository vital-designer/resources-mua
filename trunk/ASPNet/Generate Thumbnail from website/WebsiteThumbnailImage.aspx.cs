using System;
using System.Data;
using System.Configuration;
using System.Web;
using System.Web.Security;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Web.UI.WebControls.WebParts;
using System.Web.UI.HtmlControls;
using System.Drawing;

namespace WebsiteThumbnail
{
    public partial class WebsiteThumbnailImagePage : System.Web.UI.Page
    {        
        protected void btnShowThumbnailImage_Click(object sender, EventArgs e)
        {
            string address = "http://" + txtWebsiteAddress.Text;
            int width = Int32.Parse(txtWidth.Text);
            int height = Int32.Parse(txtHeight.Text);
            Bitmap bmp = WebsiteThumbnailImageGenerator.GetWebSiteThumbnail(address, 800, 600, width, height);
            bmp.Save(Server.MapPath("~") + "/" + Session.SessionID + "_img.bmp");
            imgWebsiteThumbnailImage.ImageUrl = Session.SessionID + "_img.bmp";
            imgWebsiteThumbnailImage.Visible = true;
        }
    }
}