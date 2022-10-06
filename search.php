<?php
include("header.php");
?>

<div class="top-brands">
	<div class="container">
		<div class="grid_3 grid_5">
			


<?php 


$search = $_GET["q"];

$con = mysqli_connect("localhost","root","","store", 3306);
echo mysqli_connect_error();


$query = "SELECT `prodname` FROM `product` WHERE `prodname` LIKE '%" . $search . "%';";

$products = mysqli_query($con, $query);


$empty_string = '';

while($row = mysqli_fetch_row($products)){

	$empty_string = $empty_string . "   " . $row[0];

}



$sqlproduct= "SELECT * FROM `product` WHERE `prodname` LIKE '%" . $search . "%' AND status='Active' LIMIT 9;";
$qsqlproduct = mysqli_query($con,$sqlproduct);
while($rsproduct = mysqli_fetch_array($qsqlproduct))
{
	$arrimg = unserialize($rsproduct['images']);
	if($arrimg[0] == "")
	{
		$imgname = "images/default_product_image.png";
	}
	else if(file_exists("imgupload/" . $arrimg[0]))
	{
		$imgname = "imgupload/" . $arrimg[0];
	}
	else
	{
		$imgname = "images/default_product_image.png";
	}
?>
			
<div class="col-md-4 top_brand_left">
	<div class="hover14 column">
		<div class="agile_top_brand_left_grid">
			<div class="agile_top_brand_left_grid_pos">
				<img src="images/offer.png" alt=" " class="img-responsive" />
			</div>
			<div class="agile_top_brand_left_grid1">
				<figure>
					<div class="snipcart-item block" >
						<div class="snipcart-thumb">
							<a href="productdetail.php?prodid=<?php echo $rsproduct['prodid']; ?>"><img title=" " alt=" " src="<?php echo $imgname; ?>"  style="width: 150px;height: 175px;"/></a>		
							<p><?php echo $rsproduct['prodname']; ?></p>

									
							<h4>$<?php echo intval($rsproduct['price'] - ($rsproduct['price']*$rsproduct['discount']/100)); ?> <?php echo "<span> $" . intval($rsproduct['price']) . "</span>"; ?></h4>
						</div>
						<div class="snipcart-details top_brand_home_details">
							<form action="#" method="post">
								<fieldset>
									<input type="hidden" name="cmd" value="_cart" />
									<input type="hidden" name="add" value="1" />
									<input type="hidden" name="business" value=" " />
									<input type="hidden" name="item_name" value="Fortune Sunflower Oil" />
									<input type="hidden" name="amount" value="20.99" />
									<input type="hidden" name="discount_amount" value="1.00" />
									<input type="hidden" name="currency_code" value="USD" />
									<input type="hidden" name="return" value=" " />
									<input type="hidden" name="cancel_return" value=" " />
										<?php
										if($rsproduct['stockstatus'] == "Out Of Stock")
										{
										?>
										<input type="button" name="submit" value="Out Of Stock" class="btn btn-danger">
										<?php
										}
										else
										{
										?>
										<a href="productdetail.php?prodid=<?php echo $rsproduct['prodid']; ?>" class="btn btn-info">View More</a>
										<?php
										}
										?>
								</fieldset>
							</form>
						</div>
					</div>
				</figure>
			</div>
		</div>
	</div>
</div>
								
<?php
}
?>

		</div>
	</div>
</div>

<?php
	
	include('footer.php')
?>