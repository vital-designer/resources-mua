using System;
using System.Configuration;
using System.Data;
using System.Web;
using System.Web.Security;
using System.Web.UI;
using System.Web.UI.HtmlControls;
using System.Web.UI.WebControls;
using System.Web.UI.WebControls.WebParts;

public partial class _Default : System.Web.UI.Page 
{
    public Random r = new Random();
    public int percentage = 0; 
    public int width = 0;

    protected void Page_Load(object sender, EventArgs e)
    {
        String BlogId;
        String PostId;
        String UserId;
        String vote;

        
        BlogId = Request.QueryString["blogid"] != null ? Request.QueryString["blogid"] : String.Empty;
        PostId = Request.QueryString["postid"] != null ? Request.QueryString["postid"] : String.Empty;
        UserId = Request.QueryString["userid"] != null ? Request.QueryString["userid"] : String.Empty;
        vote = Request.QueryString["vote"] != null ? Request.QueryString["vote"] : String.Empty ;

        if (vote != String.Empty)
        {
            // here we will update record , blogid, postid and user id , we will also update database
            // with total votes (adding current vote to db value) and total number of votes casted
            // 
            percentage = int.Parse(vote);
            width = (int)(percentage * 0.84);
            Response.Write(BlogId + " " + PostId + " " + UserId + " " + vote);
            Response.End();
        }
        else
        {
            // retrive from database number of votes cast and total of votes then use forumula
            // percentage = (int)(totalVotes / number_of_votes);
            // for now I have placed random number for you to show how it will work
           percentage = r.Next(100);
           width = (int)(percentage * 0.84);
        }

        
    }
}
