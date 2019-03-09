<?php

// In PHP versions earlier than 4.1.0, $HTTP_POST_FILES should be used instead
// of $_FILES.

$uploaddir = '/var/www/html/pattern-pics/';
$uploadfile = $uploaddir . $_GET['id'] . ".jpg";
//.$_FILES['userfile']['type']."";// giving it a new name
	echo '<html>
	<head>
	<title>Successfully uploaded file</title>
	</head>
	<body background="../images/butterickL.jpg"';
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
	echo "<p>File " .$_GET['id']. ".jpg was successfully uploaded.\n";
	echo "<br /><a href=\"../index.php\">Back to index</a>\n";
} else {
    echo "Possible file upload attack!\n";
}

echo "</body>\n";
echo "</html>";

?>
