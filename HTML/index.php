<?php
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

    $Sql='SELECT idpattern,patternpublisher,publishername,patternnum,patternsize,patternbust,patternwaist,patternhips,patternera,patterngender,patterndesc,patternnotes
    FROM pattern,publisher
    WHERE patternpublisher=idpublisher ';
if(isset($_GET['pubID'])>0){
    $Sql .= 'AND patternpublisher='.$_GET['pubID'];
    }
if(isset($_GET['bust'])>0){
    $Sql .= ' AND patternbust='.$_GET['bust'];
    }
if(isset($_GET['waist'])>0){
    $Sql .= ' AND patternwaist='.$_GET['waist'];
    }
if(isset($_GET['hips'])>0){
    $Sql .= '
	    AND patternhips='.$_GET['hips'];
    }
if(isset($_GET['desc']) != '' ){
    $Sql .= ' AND patterndesc LIKE \'%'.$_GET['desc'].'%\'
    AND patternnotes LIKE \'%'.$_GET['notes'].'%\'';
    }
if(isset($_GET['gender']) != '' ){
    $Sql .= ' AND patterngender=\''.$_GET['gender'].'\'';
    }
if(isset($_GET['era']) != '' ){
    $Sql .= ' AND patternera=\''.$_GET['era'].'\'';
    }
if(isset($_GET['size'])>0){
    $Sql .= ' AND patternsize=\''.$_GET['size'].'\'';
    }
 
$Sql .= '
    ORDER BY patternpublisher,patternnum';
$rs = pg_query($Sql) or die('Query failed: ' .pg_last_error());
 
$rows_returned = pg_num_rows($rs);
echo "<html>\n";
echo "<head>\n";
echo "<title>All Patterns</title>\n";
echo '<link rel="stylesheet" type="text/css" href="styles/basic.css" />';
echo "</head>\n";
echo "<body style='background: url(images/butterickL.jpg);'>\n";
echo "<h2>Results from the database: $rows_returned </h2>";
echo '<h3><a href="'.$_SERVER['PHP_SELF'].'">Display all results</a> or <a href="protected/new.php?add=1">add a new pattern</a></h3>';
echo '<form action="'.$_SERVER['PHP_SELF'].'" method="get">
  Search word/s in description: <input type="text" name="desc"><br />
  Search word/s in notes: <input type="text" name="notes"><br />
  <input type="submit" value="Submit">
</form>';
echo "<table border width=\"100%\">\n";
echo "<tr><th>DB ID</th><th>Publisher</th><th>Number<br />(image)</th><th>Size</th><th>Bust</th><th>Waist</th><th>Hips</th><th>Era</th><th>Gender</th><th>Description</th><th>Notes</th>\n";
while($row = pg_fetch_assoc($rs)){
    echo "<tr><td><a href='protected/edit.php?ID=" . $row['idpattern'] . "'>".$row['idpattern'].'</a></td>';
    echo "<td><a href='".$_SERVER['PHP_SELF']."?pubID=" . $row['patternpublisher'] ."'>" . $row['publishername'] . '</a></td>';
    $filename = 'pattern-pics/'.$row['idpattern'].'.jpg';
    if (!file_exists($filename)) echo "<td><a href=\"protected/file_insert2.php?ID=".$row['idpattern']."\">upload</a>".$row['patternnum'].'</td>' ;
    else echo "<td><a href='display_image2.php?id=" . $row['idpattern'] ."'>" . $row['patternnum'] .'</a></td>';
    echo "<td><a href='".$_SERVER['PHP_SELF']."?size=" . $row['patternsize'] ."'>" . $row['patternsize'] . '</td>';
    $bust = str_replace("NULL","",$row['patternbust']);
    echo "<td><a href='".$_SERVER['PHP_SELF']."?bust=" . $bust ."'>" . $bust . '</a></td>';
    $waist = str_replace("NULL","",$row['patternwaist']);
    echo "<td><a href='".$_SERVER['PHP_SELF']."?waist=" . $waist ."'>" . $waist . '</a></td>';
    $hips = str_replace("NULL","",$row['patternhips']);
    echo "<td><a href='".$_SERVER['PHP_SELF']."?hips=" . $hips ."'>" . $hips . '</a></td>';
    echo "<td><a href='".$_SERVER['PHP_SELF']."?era=" . $row['patternera'] ."'>" . $row['patternera'] . '</td>';
    echo "<td><a href='".$_SERVER['PHP_SELF']."?gender=" . $row['patterngender'] ."'>" . $row['patterngender'] . '</a></td>';
    echo "<td>" . $row['patterndesc'] . '</td>';
    echo "<td>" . $row['patternnotes'] . "</td></tr>\n";
}
echo "</table>";
echo "</body>";
echo "</html>";
pg_close($dbconn);
}
?>
