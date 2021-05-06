<?php 
session_start();
include("includes/dbgrad.php"); 
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>

<!---------  CSS Files ----->
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-reboot.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-grid.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-reboot.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-grid.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="../css/myaccount.css">
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href='https://fonts.googleapis.com/css?family=Amita' rel='stylesheet'>
<link rel="stylesheet" type="text/css" href="css/offer-banner.css"> 

<!---------  JS files ------>
<script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.slim.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/bootstrap.bundle.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>

<?php 
if($page==1)
{
?>
<body onload="createCaptcha();">
<?php
}
else
{
?>
<body>
<?php
}
?>