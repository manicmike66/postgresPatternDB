<?php
$config = parse_ini_file('../includes/creds.ini');
// Set up the string using the parsed file
$conn_string = "host=".$config['DBServer']." port=5432 dbname=".$config['DBName']." user=".$config['DBUser']." password=".$config['DBPass'];
// Establish a connection using the string
$dbconn = pg_connect($conn_string);
// check connection
if (!$dbconn) {
//  trigger_error('Database connection failed: '  . $dbconn->connect_error, E_USER_ERROR);
echo "Error: Unable to open database\n";
} else {
echo "<html>\n";
echo "<head>\n";
echo "<title>Pattern edit</title>\n";
echo '<link rel="stylesheet" type="text/css" href="../styles/basic.css" />';
echo "</head>\n";
echo "<body style='background: url(../images/butterickL.jpg);'>\n";
echo "<h2>Edit pattern entry</h2>\n";
echo "<p>Edit the pattern information and click the update button to change it in the database.<br />This directly changes the information and there is no undo";
if(1 == $_GET['delete'])
	{ 
	$deleteSQL = "DELETE FROM pattern WHERE idpattern=".$_GET['ID'].";";
	$ru=pg_query($deleteSQL) or die ('Query failed: ' .pg_last_error());
	echo '<p>Entry deleted. <a href="../index.php">Go back to the index</a></p>';
	echo '</body>\n</html>';
	exit();
	}
elseif(1 == $_POST['update']){
$updateSQL = 'UPDATE pattern SET patternpublisher='.$_POST['publisher'].',patternnum=\''.$_POST['patternnum'].'\',patternsize=\''.$_POST['size'].'\',patternbust=\''.$_POST['bust'].'\',patternwaist=\''.$_POST['waist'].'\',patternhips=\''.$_POST['hips'].'\',patternera=\''.$_POST['era'].'\',patterngender=\''.$_POST['Gender'].'\',patterndesc=\''.pg_escape_string($_POST['desc']).'\',patternnotes=\''.$_POST['notes'].'\' WHERE idpattern='.$_POST['id'];
$rt=pg_query($updateSQL) or die ('Query failed: ' .pg_last_error());
echo "Your pattern has been updated. <br/><a href=\"../index.php\">Go back</a>";
exit();
}
else{
    $Sql='SELECT idpattern,patternpublisher,publishername,patternnum,patternsize,patternbust,patternwaist,patternhips,patternera,patterngender,patterndesc,patternnotes
    FROM pattern,publisher
    WHERE patternpublisher=idpublisher ';
if(isset($_GET['ID'])>0){
    $Sql .= 'AND idpattern='.$_GET['ID'];
    }
    $Sql2="SELECT * FROM publisher";
$rs=pg_query($Sql);
} 
if($rs != false) {
  $rows_returned = pg_num_rows($rs);
}
$thisID="edit.php?ID=".$_GET['ID'];
echo '<form action="'.$thisID.'" method="post">';
echo "<table border width=\"100%\">\n";
echo "<tr><th>DB ID</th><th>Publisher</th><th>Number<br />(image)</th><th>Size</th><th>Bust</th><th>Waist</th><th>Hips</th><th>Era</th><th>Gender</th><th>Description</th><th>Notes</th>\n";
while($row = pg_fetch_assoc($rs)){
$rr=pg_query($Sql2);
$selectPub = '<select name="publisher">';
  while($aRow = pg_fetch_assoc($rr)){
    $selectPub .= $aRow['idpublisher']."<option ";
    if($aRow["idpublisher"] == $row["patternpublisher"]) {$selectPub .= "SELECTED ";}
    $selectPub .= "value=".$aRow['idpublisher'].">".$aRow['publishername']."</option>";
    }
$selectPub .= "</select>";
    echo "<tr><td><input type='hidden' name='id' value='".$row['idpattern']."'></input>" . $row['idpattern'] . '</td>';
    echo "<td>".$selectPub . '</td>';
    echo "<td><a href=\"file_insert.php?ID=".$row['idpattern']."\">upload</a>"."<input type='text' name=\"patternnum\" value=\"".$row['patternnum']. '" ></td>' ;
    echo "<td><input type='text' name=\"size\" value=\"".$row['patternsize'] . '" ></td>';
    echo "<td><input type='text' name=\"bust\" value=\"".$row['patternbust'] . '" ></td>';
    echo "<td><input type='text' name=\"waist\" value=\"".$row['patternwaist'] . '" ></td>';
    echo "<td><input type='text' name=\"hips\" value=\"".$row['patternhips'] . '" ></td>';
    echo "<td><input type='text' name=\"era\" value=\"".$row['patternera'] . '" ></td>';
    echo "<td><input type='text' name=\"Gender\" value=\"".$row['patterngender'] . '" ></td>';
    echo "<td><input type='text' name=\"desc\" value=\"".$row['patterndesc'] . '" ></td>';
    echo "<td><input type='text' name=\"notes\" value=\"".$row['patternnotes'] . '" ></td>';
    echo "</tr>\n";
}
echo "</table>\n";
echo "<input type='hidden' name='update' value='1'></input>";
echo '<input type="submit" Value="Update" />';
echo "</form>\n";
}
echo '<p>Or, <a href="edit.php?ID='.$_GET['ID'].'&delete=1">delete this pattern entry</a>. * There is no undelete or warning.</p>';
echo "</body>\n";
echo "</html>";
pg_close($dbconn);
?>
