<?php

if(isset($_POST['btnpayment']))
{
	echo '<script>alert("Works")</script>';
	$sqlbilling = "SELECT max(bill_no) as bill_no FROM billing";
	$qsqlbilling = mysqli_query($con,$sqlbilling);
	$rsbilling = mysqli_fetch_array($qsqlbilling);
	?><script type="text/javascript">console.log(<?php $qsqlbilling ?>, <?php mysqli_num_rows($qsqlbilling) ?>)</script><?php

	$billno = $rsbilling['bill_no']+1;

	//addressid cardholder cardno expdate cardno  btnpayment cardno  cvvno

	$delivdate= date_create(date('Y-m-d'));
	date_add($delivdate,date_interval_create_from_date_string("3 days"));
	$delivdate = date_format($delivdate, "Y-m-d");
	$sqldel = "INSERT INTO billing(`custid`, `addressid`, `city_id`, `staffid`, `bill_no`, `entry_type`, `purchdate`, `delivdate`, `total_amt`, `cardtype`, `cardno`, `cvvno`, `expirydate`, `comment`, `status`) values('$_SESSION[custid]', '$_POST[addressid]', '$_SESSION[locationid]', '0', '$billno', 'Invoice', '$dt', '$delivdate', '$_POST[tprice]','$_POST[card_type]',  '$_POST[cardno]', '$_POST[cvvno]', '$_POST[expdate]','', 'Active')";
	$qsqldel = mysqli_query($con,$sqldel);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		$insid = mysqli_insert_id($con);
			$sqlpurchase = "UPDATE purchase SET purchasestatus='Active',bilid='$insid' WHERE custid='$_SESSION[custid]' and purchasestatus='Pending'";
			$qsqlpurchase = mysqli_query($con,$sqlpurchase);
		echo "<script>alert('Billing Receipt generated successfully..');</script>";
		echo "<script>window.location='orderreceipt.php?bilid=$insid';</script>";
	}
}
$sqlbilling = "SELECT * FROM billing where bilid='$_GET[bilid]'";
$qsqlbilling = mysqli_query($con,$sqlbilling);
$rsbilling = mysqli_fetch_array($qsqlbilling);
?>