<?php

// In PHP versions earlier than 4.1.0, $HTTP_POST_FILES should be used instead
// of $_FILES.

$uploaddir = '/var/www/html/pattern-pics/';
$uploadfile = $uploaddir . $_GET['id'] . ".".$_FILES['userfile']['type']."";// giving it a new name

	echo "<html>\n";
	echo "<head>\n";
	echo "<title>Successfully uploaded file</title>\n";
	echo "</head>\n";
	echo "<body background=\"../images/butterickL.jpg\n";
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
	echo "<p>File " .$_GET['id']. ".".$_FILES['userfile']['type']." was successfully uploaded.\n";
	echo "<br /><a href=\"../index.php\">Back to index</a>\n";
} else {
    echo "Possible file upload attack!\n";
}

echo "</body>\n";
echo "</html>";

?>
