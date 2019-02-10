<?php
$id=$_GET['id'];
$config = parse_ini_file('includes/creds.ini');
// Set up the string using the parsed file
$conn_string = "host=".$config['DBServer']." port=5432 dbname=".$config['DBName']." user=".$config['DBUser']." password=".$config['DBPass'];
// Establish a connection using the string
$dbconn = pg_connect($conn_string);
// check connection
if (!$dbconn) {
//  trigger_error('Database connection failed: '  . $dbconn->connect_error, E_USER_ERROR);
echo "Error: Unable to open database\n";
} else {
//echo "Opened database successfully\n";

#$sql="SELECT encode(patternpicture, 'base64') AS picture FROM pattern WHERE idpattern=$id";
$sql="SELECT publishername,patternpublisher,patternnum FROM pattern,publisher WHERE idpattern=$id AND idpublisher=patternpublisher";
$resRow=pg_query($sql) or die('Query failed: ' .pg_last_error());
$res = pg_fetch_assoc($resRow);
$title=$res['publishername']." ".$res['patternnum'];
echo '<html>
<head>
<title> '.$title.' </title>
</head>
<body background="images/sewingBG.jpg">

<script>
function goBack() {
  window.history.back();
}
</script>
<h2 style="text-align:center">'.$title.'</h2>
<p style="text-align:center">
<button onclick="goBack()">Go Back</button><br /><br />
<img src="pattern-pics/'.$id.'.jpg"/></p>';
echo '</body>
</html>';
}
?>
