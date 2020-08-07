<?php
$config = parse_ini_file('../includes/creds.ini');
// Set up the string using the parsed file
$conn_string = "host=".$config['DBServer']." port=5432 dbname=".$config['DBName']." user=".$config['DBUser']." password=".$config['DBPass'];
// Establish a connection using the string
$dbconn = pg_connect($conn_string);
// check connection
if (!$dbconn) {
echo "Error: Unable to open database\n";
} else {
$title="Add new pattern";
$bg='butterickL';
include('../includes/head.php');
echo '<h2>'.$title.'</h2>
<p>or <a href="../index.php">go back</a>
<p>Fill in the pattern information and click the Add Pattern button to add it to the database.<br />This directly changes the information and there is no undo';
if(1 == $_POST['add']){
$updateSQL = 'INSERT INTO pattern (patternpublisher,patternnum,patternsize,patternbust,patternwaist,patternhips,patternera,patterngender,patterndesc,patternorigprice,patternnotes) VALUES ('.$_POST['publisher'].',\''.$_POST['patternnum'].'\',\''.$_POST['size'].'\',\''.$_POST['bust'].'\',\''.$_POST['waist'].'\',\''.$_POST['hips'].'\',\''.$_POST['era'].'\',\''.$_POST['Gender'].'\',\''.pg_escape_string($_POST['desc']).'\',\''.pg_escape_string($_POST['op']).'\',\''.pg_escape_string($_POST['notes']).'\');';
$rs= pg_query($dbconn, $updateSQL);
echo 'pattern entry updated<br />
	<a href="../index.php">Go back</a><br />
';
}
$Sql2="SELECT * FROM publisher order by puborder";
$thisID="new.php";
echo '<form action="'.$thisID.'" method="post">
<table border width="100%">
<tr><th>Publisher</th><th>Number</th><th>Size</th><th>Bust</th><th>Waist</th><th>Hips</th><th>Era</th><th>Gender</th><th>Description</th><th>Orig Price</th><th>Notes</th>';
$rr = pg_query($Sql2);
$selectPub = '<select name="publisher">
';
  while($aRow = pg_fetch_assoc($rr)){
    $selectPub .= $aRow['idpublisher']."<option ";
    if($aRow["idpublisher"] == 11) {$selectPub .= "SELECTED ";}
    $selectPub .= "value=".$aRow['idpublisher'].">".$aRow['publishername']."</option>";
    }
$selectPub .= '</select>';
echo '<tr><td>'.$selectPub . '</td>
    <td><input type="text" size="4" name="patternnum" /></td>
    <td><input type="text" size="4" name="size" /></td>
    <td><input type="text" size="4" name="bust" /></td>
    <td><input type="text" size="4" name="waist" /></td>
    <td><input type="text" size="4" name="hips" /></td>
    <td><input type="text" name="era" /></td>
    <td><input type="text" size="8" name="Gender" /></td>
    <td><input maxlength="145" type="text" name="desc" /></td>
    <td><input type="text" size="6" name="op" /></td>
    <td><input type="text" name="notes" /></td>
    </tr>
';
echo '</table>
<input type="hidden" name="add" value="1" />
<input type="submit" Value="Add pattern" />
</form>
</body>
</html>';
}
?>
