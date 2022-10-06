<?php
include("header.php");
if(isset($_GET['delid']))
{

	$sqldel = "SELECT status FROM customer WHERE custid='$_GET[delid]'";
	$qsqldel = mysqli_query($con,$sqldel);
	if(mysqli_affected_rows($con) == 1)
	{
		$row = mysqli_fetch_array($qsqldel);
		if($row['status'] == "Active"){
			$sql = "UPDATE `customer` SET status = 'In Active' WHERE custid='$_GET[delid]'";
			$qsql = mysqli_query($con, $sql);
			echo "<script>alert('customer has been Activated again:)');</script>";
			echo "<script>window.location='viewcustomer.php';</script>";
		}else{
			$sql = "UPDATE `customer` SET status = 'Active' WHERE custid='$_GET[delid]'";
			$qsql = mysqli_query($con, $sql);
			echo "<script>alert('customer has been Deactivated :(');</script>";
			echo "<script>window.location='viewcustomer.php';</script>";
		}
		
	}
}
?>
<!-- icons -->
	<div class="">
		<div class="container">
			<div class="">
						<div class="icons">
							<section id="new">
								<h3 class="page-header page-header icon-subheading">View customer </h3>							  

<div class="row">
	<div class="col-md-12 col-sm-12">
		<table id="datatable" class="table table-striped table-bordered ">
			<thead>
				<tr>
					<th>Customer Name</th>
					<th>Email</th>
					<th>Mobile Number</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$sqlcustomer= "SELECT * FROM customer WHERE cust_type='Customer'";
			$qsqlcustomer= mysqli_query($con,$sqlcustomer);
			while($rscustomer= mysqli_fetch_array($qsqlcustomer))
			{	
				$b_code = ($rscustomer['status'] == "Active")? "Block" : "Unblock";
				echo "<tr>
					<td>$rscustomer[custname]</td>
					<td>$rscustomer[email]</td>
					<td>$rscustomer[mob_no]</td>
					<td>$rscustomer[status]</td>
					<td>
					<a href='viewcustomer.php?delid=$rscustomer[0]' class='btn btn-danger' style='color:white;' onclick='return confirmdelete()'>" . $b_code."</a> </td>	
					</tr>";
			}
			?>
			</tbody>
		</table>
	</div>
</div>

								</section>

						</div>
					</div>
		</div>	
	</div>
	<!-- //icons -->

<?php
include("footer.php");
?>
<script>
function confirmdelete()
{
	if(confirm("Are you sure?") == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>