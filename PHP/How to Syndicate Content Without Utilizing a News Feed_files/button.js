


(function() {
var write_string="<iframe src=\"http://www.reddit.com/button_content?t=2&width=51&url=";
if (window.reddit_url)  { write_string += encodeURIComponent(reddit_url); }
else { write_string += encodeURIComponent('http://net.tutsplus.com/tutorials/php/how-to-syndicate-content-without-utilizing-a-news-feed/');}
if (window.reddit_title) { write_string += '&title=' + encodeURIComponent(window.reddit_title); }
if (window.reddit_css) { write_string += '&css=' + encodeURIComponent(window.reddit_css); }
if (window.reddit_bgcolor) { write_string += '&bgcolor=' + encodeURIComponent(window.reddit_bgcolor); }
if (window.reddit_bordercolor) { write_string += '&bordercolor=' + encodeURIComponent(window.reddit_bordercolor); }
if (window.reddit_newwindow) { write_string += '&newwindow=' + encodeURIComponent(window.reddit_newwindow);}
write_string += "\" height=\"69\" width=\"51\" scrolling='no' frameborder='0'></iframe>";
document.write(write_string);
})()
