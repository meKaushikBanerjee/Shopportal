<?php
session_start();
include("includes/dbgrad.php");
if(isset($_SESSION['uid']))
{
    $userid=strtoupper($_SESSION['uid']);
    $sql="SELECT * from orders where userid='$userid'";    
    $query = $dbh->prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);    
    if($query->rowcount()==0)
    {
        if(!empty($_GET['total']))
        {
            $totalprice=strtoupper($_GET['total']);            
            $sql="SELECT * from cart where userid='$userid'";
            $query = $dbh->prepare($sql);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);    
            if($query->rowcount()>0)
            {
                $prid=array();
                $prname=array();
                $prquant=array();
                $prprice=array();
                $prfprice=array();
                $prtprice=array();
                $prdiscount=array();
                foreach($results as $result)
                {
                    $pid=array();
                    $pname=array();
                    $pquant=array();
                    $pprice=array();
                    $pfprice=array();
                    $ptprice=array();
                    $pdiscount=array();
                    $uid=$result->userid;
                    $pid=$result->productid;
                    $pname=$result->productName;
                    $pquant=$result->productQuantity;
                    $pprice=$result->productPrice;
                    $pfprice=$result->productFinalPrice;
                    $ptprice=$result->productTotalPrice;
                    $c=$result->coupon;
                    $ct=$result->couponTag;
                    $cd=$result->couponDiscount;
                    $scharge=$result->shippingCharge;
                    $pdiscount=$result->discountPrice;
                    array_push($prid, $pid); 
                    array_push($prname, $pname);
                    array_push($prquant, $pquant);
                    array_push($prprice, $pprice); 
                    array_push($prfprice, $pfprice); 
                    array_push($prtprice, $ptprice);                     
                    array_push($prdiscount, $pdiscount);                    
                    /*$dataid=json_encode($prid);
                    $dataname=json_encode($prname);
                    $dataquant=json_encode($prquant);
                    $dataprice=json_encode($prprice);
                    $datadiscount=json_encode($prdiscount);*/
                }
                $dataid=serialize($prid);
                $dataname=serialize($prname);
                $dataquant=serialize($prquant);
                $dataprice=serialize($prprice);
                $datafprice=serialize($prfprice);
                $datatprice=serialize($prtprice);
                $datadiscount=serialize($prdiscount);
            }
            $sql="SELECT * from users where id='$userid'";
            $query = $dbh->prepare($sql);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);    
            if($query->rowcount()>0)
            {
                foreach($results as $result)
                {
                    $uname=$result->name;
                    $umobile=$result->contactno;
                }
            }
            $sql="INSERT INTO orders(userid,userName,mobileNo,productid,productName,quantity,productPrice,productDiscountedPrice,productTotalPrice,shippingCharge,productDiscount,coupon,couponTag,couponDiscount,totalPrice) VALUES(:userid,:uname,:umobile,:dataid,:dataname,:dataquant,:dataprice,:datafprice,:datatprice,:scharge,:datadiscount,:c,:ct,:cd,:totalprice)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':userid',$userid,PDO::PARAM_STR);    
            $query->bindParam(':uname',$uname,PDO::PARAM_STR); 
            $query->bindParam(':umobile',$umobile,PDO::PARAM_STR);  
            $query->bindParam(':dataid',$dataid,PDO::PARAM_STR);   
            $query->bindParam(':dataname',$dataname,PDO::PARAM_STR);    
            $query->bindParam(':dataprice',$dataprice,PDO::PARAM_STR);   
            $query->bindParam(':datafprice',$datafprice,PDO::PARAM_STR);   
            $query->bindParam(':datatprice',$datatprice,PDO::PARAM_STR);
            $query->bindParam(':dataquant',$dataquant,PDO::PARAM_STR); 
            $query->bindParam(':scharge',$scharge,PDO::PARAM_STR); 
            $query->bindParam(':datadiscount',$datadiscount,PDO::PARAM_STR);
            $query->bindParam(':c',$c,PDO::PARAM_STR);
            $query->bindParam(':ct',$ct,PDO::PARAM_STR);    
            $query->bindParam(':cd',$cd,PDO::PARAM_STR);    
            $query->bindParam(':totalprice',$totalprice,PDO::PARAM_STR);
            if($query->execute())
            {
                $id=substr(bin2hex(random_bytes(10)),0, 10); 
                echo $id;   
            }
        }
    }
    else
    {
        if(!empty($_GET['total']))
        {
            $totalprice=strtoupper($_GET['total']);
            $sql="SELECT * from cart where userid='$userid'";
            $query = $dbh->prepare($sql);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);    
            if($query->rowcount()>0)
            {
                $prid=array();
                $prname=array();
                $prquant=array();
                $prprice=array();
                $prfprice=array();
                $prtprice=array();
                $prdiscount=array();
                foreach($results as $result)
                {
                    $pid=array();
                    $pname=array();
                    $pquant=array();
                    $pprice=array();
                    $pfprice=array();
                    $ptprice=array();
                    $pdiscount=array();
                    $uid=$result->userid;
                    $pid=$result->productid;
                    $pname=$result->productName;
                    $pquant=$result->productQuantity;
                    $pprice=$result->productPrice;
                    $pfprice=$result->productFinalPrice;
                    $ptprice=$result->productTotalPrice;
                    $c=$result->coupon;
                    $ct=$result->couponTag;
                    $cd=$result->couponDiscount;
                    $scharge=$result->shippingCharge;
                    $pdiscount=$result->discountPrice;
                    array_push($prid, $pid); 
                    array_push($prname, $pname);
                    array_push($prquant, $pquant);
                    array_push($prprice, $pprice); 
                    array_push($prfprice, $pfprice); 
                    array_push($prtprice, $ptprice);                     
                    array_push($prdiscount, $pdiscount);                    
                    /*$dataid=json_encode($prid);
                    $dataname=json_encode($prname);
                    $dataquant=json_encode($prquant);
                    $dataprice=json_encode($prprice);
                    $datadiscount=json_encode($prdiscount);*/
                }
                $dataid=serialize($prid);
                $dataname=serialize($prname);
                $dataquant=serialize($prquant);
                $dataprice=serialize($prprice);
                $datafprice=serialize($prfprice);
                $datatprice=serialize($prtprice);
                $datadiscount=serialize($prdiscount);
            }
            $sql="SELECT * from users where id='$userid'";
            $query = $dbh->prepare($sql);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);    
            if($query->rowcount()>0)
            {
                foreach($results as $result)
                {
                    $uname=$result->name;
                    $umobile=$result->contactno;
                }
            }
            $sql="UPDATE orders set userid=:userid,userName=:uname,mobileNo=:umobile,productid=:dataid,productName=:dataname,quantity=:dataquant,productPrice=:dataprice,productDiscountedPrice=:datafprice,productTotalPrice=:datatprice,shippingCharge=:scharge,productDiscount=:datadiscount,coupon=:c,couponTag=:ct,couponDiscount=:cd,totalPrice=:totalprice where userid=:userid";
            $query = $dbh->prepare($sql); 
            $query->bindParam(':userid',$userid,PDO::PARAM_STR);    
            $query->bindParam(':uname',$uname,PDO::PARAM_STR); 
            $query->bindParam(':umobile',$umobile,PDO::PARAM_STR);  
            $query->bindParam(':dataid',$dataid,PDO::PARAM_STR);   
            $query->bindParam(':dataname',$dataname,PDO::PARAM_STR);    
            $query->bindParam(':dataprice',$dataprice,PDO::PARAM_STR);  
            $query->bindParam(':datafprice',$datafprice,PDO::PARAM_STR);   
            $query->bindParam(':datatprice',$datatprice,PDO::PARAM_STR);
            $query->bindParam(':dataquant',$dataquant,PDO::PARAM_STR); 
            $query->bindParam(':scharge',$scharge,PDO::PARAM_STR); 
            $query->bindParam(':datadiscount',$datadiscount,PDO::PARAM_STR);
            $query->bindParam(':c',$c,PDO::PARAM_STR);
            $query->bindParam(':ct',$ct,PDO::PARAM_STR);    
            $query->bindParam(':cd',$cd,PDO::PARAM_STR);    
            $query->bindParam(':totalprice',$totalprice,PDO::PARAM_STR);
            if($query->execute())
            {
                $id=substr(bin2hex(random_bytes(10)),0, 10); 
                echo $id;
            }
        }
    }
}
else
{
    echo '<script>window.location.replace("404-error.php");</script>';
}

?>