<?php
include("includes/dbgrad.php");
if(!empty($_POST['cat_id'])) 
{
 	$id=$_POST['cat_id'];
	$sql="SELECT * from subcategory where parentcategoryid=:id";
 	$query = $dbh->prepare($sql);
 	$query->bindParam(':id',$id,PDO::PARAM_STR); 
 	$query->execute();
  	$results=$query->fetchAll(PDO::FETCH_OBJ);
  	if($query->rowCount() > 0)
    {
?>
		<option value="">Select Subcategory</option>
<?php
        foreach($results as $result)
        {
?>
  			<option value="<?php echo $result->subcategoryid; ?>"><?php echo $result->subcategoryName; ?></option>
<?php
	 	}
	}
}
?>