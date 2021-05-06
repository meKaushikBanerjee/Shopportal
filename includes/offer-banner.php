<div id="offer-banner-carousel" class="carousel slide carousel-fade" data-ride="carousel">
    <div class="container">
        <div class="carousel-inner">

<?php
    $sql="SELECT * from offers";
    $query = $dbh->prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    {
        $i=1;
        foreach($results as $result)
        {

            if($i==1)
            {
?>
                <div class="carousel-item active">
                    <div class="mask flex-center">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-md-7 col-12 order-md-1 order-2">
                                    <h4><?php echo $result->offerDetails; ?></h4>
                                    <p>Lorem ipsum dolor sit amet. Reprehenderit, qui blanditiis quidem rerum necessitatibus praesentium voluptatum deleniti atque corrupti.</p>
                                    <a href="#">BUY NOW</a> 
                                </div>
                                <div class="col-md-5 col-12 order-md-2 order-1">
                                    <img src="admin/offerbannerimages/<?php echo $result->offerid; ?>/<?php echo $result->offerImage; ?>" class="mx-auto" alt="slide">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?php
                ++$i;
            }
            else
            {
?>
                <div class="carousel-item">
                    <div class="mask flex-center">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-md-7 col-12 order-md-1 order-2">
                                    <h4><?php echo $result->offerDetails; ?></h4>
                                    <p>Lorem ipsum dolor sit amet. Reprehenderit, qui blanditiis quidem rerum necessitatibus praesentium voluptatum deleniti atque corrupti.</p>
                                    <a href="#">BUY NOW</a> 
                                </div>
                                <div class="col-md-5 col-12 order-md-2 order-1">
                                    <img src="admin/offerbannerimages/<?php echo $result->offerid; ?>/<?php echo $result->offerImage; ?>" class="mx-auto" alt="slide">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?php
            }
        }
    }
?>
        </div>
    </div>
    <a class="carousel-control left carousel-control-prev" href="#offer-banner-carousel" data-slide="prev">
        <i class="fa fa-angle-left"></i>
    </a>
    <a class="carousel-control right carousel-control-next" href="#offer-banner-carousel" data-slide="next">
        <i class="fa fa-angle-right"></i>
    </a> 
</div>
<!--slide end--> 