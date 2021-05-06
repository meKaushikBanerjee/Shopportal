<?php
session_start();
include("includes/dbgrad.php");
$sql="SELECT * from customerorders where orderStatus=4";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
    foreach($results as $result)
    {
        $pid=unserialize($result->productid); 
        $userid=$result->userid;
        $prid=count($pid);                    
        $i=0;
        while(!empty($pid[$i]))
       	{
            $prodid=$pid[$i];
            $mysql="SELECT productName,productImage1,productid from products where productid=:prodid";
            $query = $dbh->prepare($mysql);
            $query->bindParam(':prodid',$prodid,PDO::PARAM_STR);
            $query->execute();
            $data=$query->fetchAll(PDO::FETCH_OBJ);
            if($query->rowCount() > 0)
            {
                foreach($data as $dt)
                {                            
                    $pname=$dt->productName;
                    $pimg=$dt->productImage1;
                    $id=$dt->productid;
                    $sql="SELECT * from productreviews";
				    $query = $dbh->prepare($sql);
				    $query->execute();
				    $row=$query->rowCount();
				    if($row>=0)
				    {
				    	$row+=1;
				        $rid="REV_".$row;
				    }
                    $sql="INSERT into productreviews(reviewid,userid,productid,productName,productImage,status) VALUES(:rid,:userid,:id,:pname,:pimg,0)";
				  	$query = $dbh->prepare($sql);
				  	$query->bindParam(':userid',$userid,PDO::PARAM_STR);
				  	$query->bindParam(':rid',$rid,PDO::PARAM_STR);
				  	$query->bindParam(':id',$id,PDO::PARAM_STR);
				  	$query->bindParam(':pname',$pname,PDO::PARAM_STR);  
				 	$query->bindParam(':pimg',$pimg,PDO::PARAM_STR);
				  	$query->execute();
				}
			}
			++$i;
		}
	}
}

?>