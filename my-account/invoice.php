<?php
include("includes/dbgrad.php");
include("fpdf/fpdf.php");
include("fpdf/fpdf_protection.php");
$uid=$_GET['uid'];
$id=$_GET['oid'];

$data=$dbh->prepare("SELECT * FROM customerorders where orderid='$id' and userid='$uid'");
$data->execute();
$results=$data->fetchAll(PDO::FETCH_OBJ);
if($data->rowCount() > 0)
{

	//A4 width : 219mm
	//default margin : 10mm each side
	//writable horizontal : 219-(10*2)=189mm

	$pdf = new FPDF('P','mm','A4');
	$pdf = new FPDF_Protection();
	$pdf->SetProtection(array('print'));
	$pdf->AddPage();
	foreach($results as $result)
	{
		$pdf->Image('../images/0060_edited.jpg', 86, 2, 30, 30);
		$pdf->Ln(20);
		$pdf->addSociete( "Kaushik's",
                  "173/1P\n" .
                  "PICNIC PARK\n".
                  "KOLKATA, WEST BENGAL, INDIA\n" .
                  "PINCODE : 700001 ");
		$pdf->fact_dev($result->userName);
		$pdf->temporaire( "Kaushik's Billing Invoice" );
		$pdf->deliverystatus($result->orderStatus);
		$pdf->addDate($result->dateorder);
		$pdf->addClient($result->orderid);
		$pdf->addPageNumber("1");
		$pdf->addClientBillingAdresse("BILLING DETAILS : \n".$result->billingAddress.",\n".$result->billingCity.", ".$result->billingState.", ".$result->billingCountry."\n".$result->billingPincode);
		$pdf->addClientShippingAdresse("SHIPPING DETAILS:\n".$result->shippingAddress.",\n".$result->shippingCity.", ".$result->shippingState.", ".$result->shippingCountry."\n".$result->shippingPincode);
		$pdf->addReglement($result->paymentMethod);
		$pdf->addEcheance($result->orderDate);
		$pdf->addNumTVA("FR888777666");
		$pdf->addReference("");

		$cols=array( "SL.NO" => 12,
		             "PRODUCT NAME" => 78,
		             "QUANTITY" => 20,
		             "PRODUCT PRICE" => 30,
		             "DISCOUNT" => 22,
		             "FINAL AMOUNT" => 28 );
		$pdf->addCols( $cols);
		$cols=array( "SL.NO" => "L",
		             "PRODUCT NAME" => "L",
		             "QUANTITY" => "C",
		             "PRODUCT PRICE" => "R",
		             "DISCOUNT" => "R",
		             "FINAL AMOUNT" => "C" );

		$pdf->addLineFormat( $cols);
		$pdf->addLineFormat($cols);

		$pid=unserialize($result->productid);
        $pquant=unserialize($result->quantity);
        $pprice=unserialize($result->productPrice);
        $ptprice=unserialize($result->productTotalPrice);
        $pdiscount=unserialize($result->productDiscount); 
        $prid=count($pid);                    
        $i=0;
        $y=110;
        while(!empty($pid[$i]) && ($pquant[$i]))
        {
            $prodid=$pid[$i];
            $prodquant=$pquant[$i];
            $prodprice=$pprice[$i];
            $prodtotprice=$ptprice[$i];
            $proddis=$pdiscount[$i];
            $mysql="SELECT productName,productImage1,productid from products where productid=:prodid";
            $query = $dbh->prepare($mysql);
            $query->bindParam(':prodid',$prodid,PDO::PARAM_STR);
            $query->execute();
            $data=$query->fetchAll(PDO::FETCH_OBJ);
            if($query->rowCount() > 0)
            {
                foreach($data as $dt)
                {                  
					$line = array( "SL.NO" => $i+1,
						           "PRODUCT NAME" => $dt->productName,
						           "QUANTITY" => $prodquant,
						           "PRODUCT PRICE" => $prodprice,
						           "DISCOUNT" => $proddis,
						           "FINAL AMOUNT" => $prodtotprice );
					$size = $pdf->addLine( $y, $line );
					$y   += $size + 2;
				}
			}
			++$i;
		}
		$pdf->SetXY(132,177);
		$pdf->SetFillColor(255,255,0);
		$pdf->Cell(40	,10,'Shipping Charge',1,0, "C");
		$pdf->Cell(28	,10,$result->shippingCharge,1,0, "C");
		$pdf->SetXY(132,187);
		$pdf->SetFillColor(255,255,0);
		$pdf->Cell(40	,10,'Coupon Discount',1,0, "C");
		$pdf->Cell(28	,10,$result->couponDiscount,1,0, "C");
		$pdf->SetXY(132,197);
		$pdf->SetFillColor(255,255,0);
		$pdf->Cell(40	,10,'Net Payable Amount',1,0, "C");//end of line
		$pdf->Cell(28	,10,$result->totalPrice,1,0, "C");//end of line

		$pdf->SetXY(80,227);
		$pdf->SetFont('Arial','B',20);
		$pdf->SetFillColor(255,255,0);
	    // Title
	    $pdf->Cell(50,10,"Kaushik's",1,0,'C');
	    // Line break
	    $pdf->Ln(20);
	    $pdf->SetFont('Arial',"",12);
		$pdf->SetXY(80,237);
		$pdf->SetFillColor(192);
		$pdf->Cell(40	,10,"Address:",0,0, "C");
		$pdf->Cell(28	,10,"",0,0, "C");
		$pdf->SetXY(80,247);
		$pdf->SetFillColor(192);
		$pdf->Cell(40	,10,"Email:",0,0, "C");
		$pdf->Cell(28	,10,"",0,0, "C");
		$pdf->SetXY(80,257);
		$pdf->Cell(40	,10,"Mobile:",0,0, "C");//end of line
		$pdf->Cell(28	,10,"",0,0, "C");//end of line

		$pdf->Output();
	}
}

?>