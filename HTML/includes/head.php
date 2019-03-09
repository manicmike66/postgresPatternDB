<!doctype html>
<html lang="en">
<html>
<head>
<title> <?php echo $title; ?> </title>
<link rel="stylesheet" type="text/css" href="/styles/basic.css" />
<link href="/styles/bootstrap.min.css" rel="stylesheet" />
<script src="/js/jquery-3.3.1.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<script>
$(document).ready(function(){
  $("#pInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#pTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
</head>
<body style="background: url('/images/<?php echo $bg;?>.jpg');">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-info">
<?php 
switch($_SERVER['PHP_SELF']){
    case '/protected/new.php': 
        echo '<li class="breadcrumb-item"><a href="/" class="text-light">Home</a> </li><li class="breadcrumb-item active text-dark">'.$title.'</li>';
        break;
    case '/index.php': 
	echo '<li class="breadcrumb-item active text-dark" aria-current="page">'.$title.'</li><li class="breadcrumb-item active text-light"><a class="text-light" href="protected/new.php">Add new pattern</a></li>';;
	break;
}
?>
  </ol>
</nav>

