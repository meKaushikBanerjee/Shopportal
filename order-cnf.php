<?php 
$page=0;
include("includes/main.php"); 
if(isset($_SESSION['alogin'],$_SESSION['alogged']) && (time() - $_SESSION['alogged'] > 60*60))
{
  session_unset(); // unset $_SESSION variable for the run-time
  session_destroy(); // destroy session data in storage
  header('Location: logout.php');
}
else
{
  session_regenerate_id(true);
  $_SESSION['alogged'] = time();
}
if(isset($_SESSION['logout']))
{
	if($_SESSION['logout'] == 1)
	{
		include("includes/topheader.php");
	}
}
include("includes/searchbar.php");
include("includes/navbar.php"); 

//whether ip is from share internet
if (!empty($_SERVER['HTTP_CLIENT_IP']))   
{
    $ip_address = $_SERVER['HTTP_CLIENT_IP'];
}
//whether ip is from proxy
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
{
	$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
}
//whether ip is from remote address
else
{
    $ip_address = $_SERVER['REMOTE_ADDR'];
}

if(isset($_SESSION['orderid'])&&($_SESSION['uid']))
{
	$userid=strtoupper($_SESSION['uid']);
	$orderid=strtoupper($_SESSION['orderid']);
	$sql="SELECT * from customerorders where orderid=:orderid and userid=:userid";
	$query = $dbh->prepare($sql);
	$query->bindParam(':userid',$userid,PDO::PARAM_STR);
	$query->bindParam(':orderid',$orderid,PDO::PARAM_STR);
	$query->execute();	
	$results=$query->fetchAll(PDO::FETCH_OBJ);
	if($query->rowCount() > 0)
	{
		foreach($results as $result)
		{
?>
		<style type="text/css">
			@media screen and (min-width: 992px){
				img.thank-you {
					width: 20%;
					height: 20%;
					margin-left: 40%;
				}
			}
			@media screen and (max-width: 600px){
				img.thank-you {
					width: 50%;
					height: 50%;
					margin-left: 25%;
				}
			}
		</style>
			<img src="images/0060_edited.jpg" class="thank-you">
			<h2 class="display-5" style="text-align: center;">Thank You! for ordering with us</h2>
			<h5 style="text-align: center;">Having trouble? <a href="">Contact us</a></h5>
			<p class="lead" style="text-align: center;">
				<a class="btn btn-primary btn-sm" href="/" role="button">Continue to homepage</a>
			</p>
<?php
		}
	}
}
else
{
	echo '<script>window.location.replace("/");</script>';
}
include ("includes/footer.php");

?>