<script type="text/javascript" src="js/sidebar-filter.js"></script>
<?php
if((isset($_GET['pcat']))&&(isset($_GET['scat'])))
{       
    $pcatid=$_GET['pcat'];
    $subcatid=$_GET['scat'];
    $sql="SELECT * from products where parentcategoryid=:pcatid and subcategoryid=:subcatid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':pcatid',$pcatid,PDO::PARAM_STR);        
    $query->bindParam(':subcatid',$subcatid,PDO::PARAM_STR);    
    $query->execute();  
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    {
        foreach($results as $result)
        {
?>
            <div id="mySidebar" class="sidebar">
              	<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
              	<article class="filter-group">
                    <header class="card-header"> 
                    	<a href="#" data-toggle="collapse" data-target="#collapse_aside1" data-abc="true" aria-expanded="false" class="collapsed"> <i class="icon-control fa fa-chevron-down"></i>
                        	<h6 class="title">Categories </h6>
                        </a> 
                   	</header>
                    <div class="filter-content collapse" id="collapse_aside1" style="">
                        <div class="card-body">
                            <ul class="list-menu">
                        <?php
                            $sql="SELECT categoryName from category";
                            $query = $dbh->prepare($sql);     
                            $query->execute();  
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            if($query->rowCount() > 0)
                            {
                                foreach($results as $result)
                                {
                        ?>
                                    <label class="checkbox-btn"> 
                                        <input type="checkbox"> 
                                        <span class="btn btn-light"> <?php echo $result->categoryName; ?></span> 
                                    </label>
                        <?php
                                }
                            }
                        ?>
                            </ul>
                        </div>
                    </div>
                </article>
                <article class="filter-group">
                    <header class="card-header"> 
                    	<a href="#" data-toggle="collapse" data-target="#collapse_aside2" data-abc="true" aria-expanded="false" class="collapsed"> <i class="icon-control fa fa-chevron-down"></i>
                            <h6 class="title">Price </h6>
                        </a> 
                    </header>
                    <div class="filter-content collapse" id="collapse_aside2" style="">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div id="slider-range"></div>
                                </div>
                            </div>
                            <div class="row slider-labels">
                                <div class="col-xs-6 caption">
                                    <strong>Min:</strong> <span id="slider-range-value1"></span>
                                </div>
                                <div class="col-xs-6 text-right caption">
                                    <strong>Max:</strong> <span id="slider-range-value2"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <form>
                                        <input type="hidden" name="min-value" value="">
                                        <input type="hidden" name="max-value" value="">
                                    </form>
                                </div>
                            </div>
                        	<div id="price_range"></div>
                        </div>
                    </div>
                </article>
                <article class="filter-group">
                    <header class="card-header"> 
                    	<a href="#" data-toggle="collapse" data-target="#collapse_aside3" data-abc="true" aria-expanded="false" class="collapsed"> <i class="icon-control fa fa-chevron-down"></i>
                        	<h6 class="title">Size </h6>
                        </a> 
                    </header>
                    <div class="filter-content collapse" id="collapse_aside3" style="">
                        <div class="card-body"> 
                        	<label class="checkbox-btn"> 
                        		<input type="checkbox"> 
                        		<span class="btn btn-light"> XS </span> 
                        	</label> 
                        	<label class="checkbox-btn"> 
                        		<input type="checkbox"> 
                        		<span class="btn btn-light"> SM </span> 
                        	</label> 
                        	<label class="checkbox-btn"> 
                        		<input type="checkbox"> 
                        		<span class="btn btn-light"> LG </span> 
                        	</label> 
                        	<label class="checkbox-btn"> 
                        		<input type="checkbox"> 
                        		<span class="btn btn-light"> XXL </span> 
                        	</label>
                        	<label class="checkbox-btn"> 
                        		<input type="checkbox"> 
                        		<span class="btn btn-light"> XXXL </span> 
                        	</label> 
                        </div>
                    </div>
                </article>
                <article class="filter-group">
                    <header class="card-header"> 
                    	<a href="#" data-toggle="collapse" data-target="#collapse_aside4" data-abc="true" class="collapsed" aria-expanded="false"> <i class="icon-control fa fa-chevron-down"></i>
                            <h6 class="title">Rating </h6>
                        </a> 
                    </header>
                    <div class="filter-content collapse" id="collapse_aside4" style="">
                        <div class="card-body"> 
                        	<label class="custom-control"> 
                        		<input type="checkbox" checked="" class="custom-control-input">
                                <div class="custom-control-label">Better </div>
                            </label> 
                            <label class="custom-control"> 
                            	<input type="checkbox" checked="" class="custom-control-input">
                                <div class="custom-control-label">Best </div>
                            </label>
                            <label class="custom-control"> 
                            	<input type="checkbox" checked="" class="custom-control-input">
                                <div class="custom-control-label">Good</div>
                            </label> 
                            <label class="custom-control"> 
                            	<input type="checkbox" checked="" class="custom-control-input">
                                <div class="custom-control-label">Not good</div>
                            </label> 
                        </div>
                    </div>
                </article>
            </div>
            <script>
                $(document).ready(function(){

                    filter_data();

                    function filter_data()
                    {
                        $('.filter_data').html('<div id="loading" style="" ></div>');
                        var action = 'fetch_data';
                        var minimum_price = $('#hidden_minimum_price').val();
                        var maximum_price = $('#hidden_maximum_price').val();
                        var brand = get_filter('brand');
                        var ram = get_filter('ram');
                        var storage = get_filter('storage');
                        $.ajax({
                            url:"fetch_data.php",
                            method:"POST",
                            data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, brand:brand, ram:ram, storage:storage},
                            success:function(data){
                                $('.filter_data').html(data);
                            }
                        });
                    }

                    function get_filter(class_name)
                    {
                        var filter = [];
                        $('.'+class_name+':checked').each(function(){
                            filter.push($(this).val());
                        });
                        return filter;
                    }

                    $('.common_selector').click(function(){
                        filter_data();
                    });

                    $('#price_range').slider({
                        range:true,
                        min:1000,
                        max:65000,
                        values:[1000, 65000],
                        step:500,
                        stop:function(event, ui)
                        {
                            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
                            $('#hidden_minimum_price').val(ui.values[0]);
                            $('#hidden_maximum_price').val(ui.values[1]);
                            filter_data();
                        }
                    });

                });
            </script>
<?php
        }
    }
}
?>