<%
response.buffer = true
server.ScriptTimeout = 900

for i = 1 to 10
Set objWinHttp = server.CreateObject("WinHttp.WinHttpRequest.5.1")
objWinHttp.Open "GET", "http://xactscripts.com/webthumb.php?url=xactscripts" & i & ".com"
'objWinHttp.Open "GET", "http://www.islamicport.com/cgi-bin/links/in.cgi?id=9676"
objWinHttp.SetProxy 2,"ISA:8080"
objWinHttp.Send
response.write objWinHttp.ResponseText
response.flush()
Set objWinHttp = Nothing 

next

'For i = 1 to 100

'Set objWinHttp = server.CreateObject("WinHttp.WinHttpRequest.5.1")
'objWinHttp.Open "GET", "http://www.islamicport.com/cgi-bin/links/out.cgi?id=9676"
'objWinHttp.SetProxy 2,"ISA:8080"
'objWinHttp.Send
'strHTML = objWinHttp.ResponseText
'response.write objWinHttp.Status
'response.flush()
'Set objWinHttp = Nothing 

'next


%>