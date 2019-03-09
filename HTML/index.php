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
    $Sql .= ' AND patternbust=\''.$_GET['bust'].'\'';
    }
if(isset($_GET['waist'])>0){
    $Sql .= ' AND patternwaist=\''.$_GET['waist'].'\'';
    }
if(isset($_GET['hips'])>0){
    $Sql .= '
	    AND patternhips=\''.$_GET['hips'].'\'';
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
$title="Home";
$bg='butterickL';
include('includes/head.php');
echo '<h2>Results from the database: '.$rows_returned.' </h2>
<h3><a href="'.$_SERVER['PHP_SELF'].'">Display all results</a> or <a href="protected/new.php?add=1">add a new pattern</a></h3>
<div><span class="h2 text-success bg-secondary">To edit an entry, select its ID in the first column.</span></div>
<!--<form action="'.$_SERVER['PHP_SELF'].'" method="get">
  Search word/s in description: <input type="text" name="desc"><br />
  Search word/s in notes: <input type="text" name="notes"><br />
  <input type="submit" value="Submit">
</form>-->
<input id="pInput" type="text" placeholder="Search all cells">';
echo "<table class=\"table table-sm table-hover\" border width=\"100%\">\n";
echo '<thead class="thead-light"><tr><th class="text-center">DB ID</th><th class="text-center">Publisher</th><th class="text-center">Number<br />(image)</th><th class="text-center">Size</th><th class="text-center">Bust<br/>(Chest)</th><th class="text-center">Waist</th><th class="text-center">Hips</th><th class="text-center">Era</th><th class="text-center">Gender</th><th class="text-center">Description</th><th class="text-center">Notes</th></tr></thead>
	<tbody id="pTable">';
while($row = pg_fetch_assoc($rs)){
	$pub=$row['patterngender'];
	$td='<td>';
	switch($pub){
	case "Male":
		$td='<td style="background-color:#ccccff;opacity:0.7">';
		break;
	case "Child":
		$td='<td style="background-color:#ffccff;opacity:0.7">';
		break;
	case "Baby":
		$td='<td style="background-color:#ffcccc;opacity:0.7">';
		break;
	case "Female":
		$td='<td style="background-color:pink;opacity:0.7">';
		break;
	case "Girl":
		$td='<td style="background-color:#C7EF8A;opacity:0.7">';
		break;
	case "Decor":
		$td='<td style="background-color:#FFFF66;opacity:0.7">';
		break;
	case "Doll":
		$td='<td style="background-color:#FF66FF;opacity:0.7">';
		break;
	case "Either":
		$td='<td style="background-color:#ffffcc;opacity:0.7">';
		break;
	}
    echo "<tr>".$td."<a href='protected/edit.php?ID=" . $row['idpattern'] . "'>".$row['idpattern'].'</a></td>';
    echo $td."<a href='".$_SERVER['PHP_SELF']."?pubID=" . $row['patternpublisher'] ."'>" . $row['publishername'] . '</a></td>';
    $filename = 'pattern-pics/'.$row['idpattern'].'.jpg';
    if (!file_exists($filename)) echo $td."<a href=\"protected/file_insert.php?ID=".$row['idpattern']."\">upload</a>".$row['patternnum'].'</td>' ;
    else echo $td."<a href='display_image.php?id=" . $row['idpattern'] ."'>" . $row['patternnum'] .'</a></td>';
    echo $td."<a href='".$_SERVER['PHP_SELF']."?size=" . $row['patternsize'] ."'>" . $row['patternsize'] . '</td>';
    $bust = str_replace("NULL","",$row['patternbust']);
    echo $td."<a href='".$_SERVER['PHP_SELF']."?bust=" . $bust ."'>" . $bust . '</a></td>';
    $waist = str_replace("NULL","",$row['patternwaist']);
    echo $td."<a href='".$_SERVER['PHP_SELF']."?waist=" . $waist ."'>" . $waist . '</a></td>';
    $hips = str_replace("NULL","",$row['patternhips']);
    echo $td."<a href='".$_SERVER['PHP_SELF']."?hips=" . $hips ."'>" . $hips . '</a></td>';
    echo $td."<a href='".$_SERVER['PHP_SELF']."?era=" . $row['patternera'] ."'>" . $row['patternera'] . '</td>';
    echo $td."<a href='".$_SERVER['PHP_SELF']."?gender=" . $row['patterngender'] ."'>" . $row['patterngender'] . '</a></td>';
    echo $td."" . $row['patterndesc'] . '</td>';
    echo $td."" . $row['patternnotes'] . "</td></tr>\n";
}
echo "</tbody>\n</table>";
echo '<script src="/js/jquery-3.3.1.min.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>';
pg_close($dbconn);
}
?>
