<?php
session_start();
$uid=$_SESSION['uid'];
//session_destroy();
$_SESSION['logout']=0;
$_SESSION['login']=1;
$logintime=$_SESSION['alogin'];

include("includes/dbgrad.php");

date_default_timezone_set("Asia/Kolkata");
$cdate=date('d-m-Y H:m:s');
$sql="UPDATE userlog set logoutTime=:cdate,status=0 where loginTime=:logintime";
$query = $dbh->prepare($sql);
$query->bindParam(':cdate',$cdate,PDO::PARAM_STR);
$query->bindParam(':logintime',$logintime,PDO::PARAM_STR);
if($query->execute())
{
	unset($_SESSION['alogin']);
	unset($_SESSION['alogged']);
	session_destroy();
	session_unset();
	header('location: /'); 
} 
?>