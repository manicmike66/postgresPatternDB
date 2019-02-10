<html>
<head><title>File Insert</title></head>
<body background="../images/butterickL.jpg">
<h3>Please Choose a File and click Submit</h3>
<h2><a href="../index.php">or Return to index</a></h2>
<p>Your file must be a jpeg. It will be renamed <?php echo $_GET['id'].".jpg";?> and uploaded to the folder /var/www/html/pattern-pics.</p>
<form enctype="multipart/form-data" action="file_insert_2.php?id=<?php echo $_GET['id']?>" method="post">
<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
<input name="userfile" type="file" />
<input type="submit" value="Submit" />
</form>
</body>
</html>
