<?php
include("header.php");

if(isset($_POST['btnpayment']))
{
	echo '<script>alert("Work")</script>';
	$sqlbilling = "SELECT max(bill_no) as bill_no FROM billing";
	$qsqlbilling = mysqli_query($con,$sqlbilling);
	$rsbilling = mysqli_fetch_array($qsqlbilling);
	?><script type="text/javascript">console.log(<?php $qsqlbilling ?>, <?php mysqli_num_rows($qsqlbilling) ?>)</script><?php

	$billno = $rsbilling['bill_no']+1;

	//addressid cardholder cardno expdate cardno  btnpayment cardno  cvvno

	$delivdate= date_create(date('Y-m-d'));
	date_add($delivdate,date_interval_create_from_date_string("3 days"));
	$delivdate = date_format($delivdate, "Y-m-d");
	$sqldel = "INSERT INTO billing(`custid`, `addressid`, `city_id`, `staffid`, `bill_no`, `entry_type`, `purchdate`, `delivdate`, `total_amt`, `cardtype`, `cardno`, `expirydate`, `comment`, `status`) values('$_SESSION[custid]', '$_POST[addressid]', '$_SESSION[locationid]', '0', '$billno', 'Invoice', '$dt', '$delivdate', '$_POST[tprice]','$_POST[card_type]',  '$_POST[cardno]', '$_POST[expdate]','', 'Active')";
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
}elseif(isset($_POST["tprice"])){

}
$sqlbilling = "SELECT * FROM billing where bilid='$_GET[bilid]'";
$qsqlbilling = mysqli_query($con,$sqlbilling);
$rsbilling = mysqli_fetch_array($qsqlbilling);
?>
<!-- icons -->
	<div class="">
		<div class="container">
			<div class="">
						<div class="icons">
							<section id="new">
<center><h3 class="page-header page-header icon-subheading">Payment Panel</h3></center>							  
<form method="post" action="" id="printarea" onsubmit="return validateform()">
 	  
<div class="row panel panel-default">
	<div class="col-md-12"><br></div>
	<div class="col-md-12">
		<table class="table table-bordered" id="tblstockentry">
			<thead>
				<tr>
					<th>Product Detail</th>
					<th>Cost per Quantity</th>
					<th>Total Quantity</th>
					<th>Total Cost</th>
				</tr>
			</thead>
			<tbody>
<?php
$tprice = 0;
$sqlpurchase = "SELECT purchase.*,product.*,type.*,ROUND(purchase.price - (purchase.price * purchase.discount_price / 100)) as purchaseprice,product.unit as prounit FROM `purchase` LEFT JOIN product ON purchase.prodid=product.prodid LEFT JOIN type ON type.typeid=purchase.typeid WHERE purchase.purchasestatus='Pending' AND purchase.entry_type='Invoice' AND purchase.custid='$_SESSION[custid]'";
$qsqlpurchase = mysqli_query($con,$sqlpurchase);
while($rspurchase = mysqli_fetch_array($qsqlpurchase))
{
	$sqltype = "SELECT * FROM type WHERE status='Active' AND prodid='$rspurchase[prodid]'  AND typeid='$rspurchase[typeid]'";
	$qsq1type = mysqli_query($con,$sqltype);
	$rstype = mysqli_fetch_array($qsq1type);
	echo "<tr>
	<td>$rspurchase[prodname] | ";
	if(mysqli_num_rows($qsq1type) >= 1)
	{
	echo "" . $rstype['unit'] . " " .  $rstype['color']  . " | " . " $" . $rstype['cost'];
	}
	else
	{
	echo "$". $rspurchase['price'];
	echo "| " . $rspurchase['unit'];
	}
	echo "</td>";
	echo "<td style='text-align: right;'>$$rspurchase[purchaseprice]</td>
	<td>$rspurchase[qty]</td>
	<td style='text-align: right;'>$" . $rspurchase['qty'] * $rspurchase['purchaseprice'] ."</td>
	</tr>";
	$tprice = $tprice + ($rspurchase['qty'] * $rspurchase['purchaseprice']);
}
?>			
			</tbody>
			<thead>
				<tr>
					<th></th>
					<th></th>
					<th>Grand Total</th>
					<th id="grand-total" style='text-align: right;'>$<?php echo $tprice; ?></th>
				</tr>
			</thead>
		</table>
	</div>
</div>
<input type="hidden" name="tprice" id="tprice" value="<?php echo $tprice; ?>" >
<div class="row panel panel-default">
	<div class="col-md-12"><br></div>
	<div class="col-md-6">
	    <div class="form-group"> 
			<label>Select Address ( If you not registred the address then click on Delivery address below) <li><a href="viewaddress.php">Delivery Address</a></li></label> <span id="id_addressid" class="err_msg"></span>
	        <select class="form-control" name='addressid' id="addressid" onchange="fun_loadaddress(this.value)"> 
				<option value="">Select Address</option>
			<?php
			$sqladdress= "SELECT * FROM address LEFT JOIN city ON address.city_id=city.city_id WHERE address.custid='$_SESSION[custid]'";
			$qsqladdress= mysqli_query($con,$sqladdress);
			echo mysqli_error($con);
			while($rsaddress= mysqli_fetch_array($qsqladdress))
			{
				echo "<option value='$rsaddress[0]'>$rsaddress[address], $rsaddress[city] - $rsaddress[pincode] | Ph. No. $rsaddress[contactno] </option>";
			}
			?>
							</select>
                        </div>
						<div id="divaddr"><?php include("js_address.php");?></div>

	</div>
	<div class="col-md-6">
	<div class="form-group"> 
	<div id="paypal-button"></div>
			<label>Card Type.</label> <span id="id_card_type" class="err_msg"></span>
			<div class="">
			<select class="form-control" name="card_type" id="card_type">
				<?php
				$arr = array("Debit/Credit Card");
				foreach($arr as $val)
				{
					echo "<option value='$val' >$val</option>";
				}
				?>
			</select>
			</div> 
		</div>
	<div id="paypal-button"></div>
		<div class="form-group"> 
			<input type="hidden" id="cardtype" name="card_type" value="credit/debit">
		</div>        
		<div class="form-group"> 
			<label>Card Holder.</label> <span id="id_cardholder" class="err_msg"></span>
			<div class=""> <input type="text" class="form-control coupon" name="cardholder" id="cardholder" placeholder="Enter Card Holder detail"  >
			</div>
		</div>
		<div class="form-group"> 
			<label>Card No.</label> <span id="id_cardno" class="err_msg"></span>
			<div class=""> <input type="text" class="form-control coupon" name="cardno" id="cardno" placeholder="Enter Card No."  >
			</div>
		</div>
		<div class="form-group"> 
			<label>Expiry Date</label> <span id="id_expdate" class="err_msg"></span>
			<div class=""> <input type="month" class="form-control coupon" name="expdate" id="expdate" placeholder="Enter Expiry Date" min="<?php echo date("Y-m"); ?>" >
			</div>
		</div>
		<div class="form-group"> 
			<label>CVV No.</label> <span id="id_cvvno" class="err_msg"></span>
			<div class=""> <input type="number" class="form-control coupon" name="cvvno" id="cvvno" placeholder="Enter Card No." min="101" max="999"  >
			</div>
		</div>
	</div>
</div>
<div class="row panel panel-default">
	<div class="col-md-12">
		<hr>
		<center><input type="submit" name="btnpayment" id="btnpayment"  class="btn btn-primary btn-lg" value="Click here to Make Payment" ></center>
		<br>
	</div>
</div>


</form>
 
 
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
function fun_loadaddress(addressid)
{
	$.post("js_address.php",
	{
		addressid: addressid
	},
	function(data){
		$("#divaddr").html(data);
	});
}
</script>           
<script>


function validateform()
{
	//###########
	var numericExpression = /^[0-9]+$/;
	var alphaExp = /^[a-zA-Z]+$/;
	var alphaspaceExp = /^[a-zA-Z\s]+$/;
	var alphanumbericExp = /^[0-9a-zA-Z]+$/;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	//###########
	$(".err_msg").html('');
	var validate = "true";
	//###############################################
	if($("#addressid").val() == "")
	{
		$('#id_addressid').html("Kindly select address...");
		validate = "false";
	}     
	//###############################################
	if($("#card_type").val() == "")
	{
		$('#id_card_type').html("Kindly select card type...");
		validate = "false";
	}
	//###############################################
	if($("#cardholder").val() == "")
	{
		$('#id_cardholder').html("Card holder should not be empty...");
		validate = "false";
	}     
	//###############################################
	if($("#cardno").val().length != 16)
	{
		$('#id_cardno').html("Entered Card Number should contain 16 digits...");
		validate = "false";
	}
	// console.log(["1234567812345678", "0000123456789012"].include($("#cardno").val()), $("#cardno").val());
	//###############################################
	if(["1234567812345678", "0000123456789012"].includes($("#cardno").val()))
    {
    	console.log(($("#cardno").val() in ["1234567812345678", "0000123456789012"]), $("#cardno").val());
	    $('#id_cardno').html("Card Number is not valid..."); 
		validate = "false";
	}
	//###############################################
	if($("#cardno").val() == "")
	{
		$('#id_cardno').html("Card number should not be empty...");
		validate = "false";
	}    
	//###############################################
	if($("#expdate").val() == "")
	{
		$('#id_expdate').html("Kindly select expiry date...");
		validate = "false";
	}	
	//###############################################
	if($("#cvvno").val() == "")
	{
		$('#id_cvvno').html("CVV number should not be empty...");
		validate = "false";
	}    
	//###############################################
	if(validate == "true")
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>
<script src="https://www.paypal.com/sdk/js?client-id=ARo2mHcK6jeAYZ-VMD2DYCjIeJBDizz0wkRYrVQ8aTt04sM3bWXjYVveBv_SWzvZZYtF6r3cNmGuIVyD&disable-funding=credit,card"></script>
<script type="text/javascript" >
	paypal.Buttons({
  style: {
    color: "blue"
  },

  createOrder: function(data, actions){
    return actions.order.create({
      purchase_units: [{
        amount: {
          value: document.querySelector('#grand-total').innerText.replace("$", "")
        }
      }]
    })
  },

  onApprove: function (data, actions){
    return actions.order.capture().then(function(details){
      	console.log(details.payer.name.given_name);

      	let form = printarea;

      	form.onsubmit = () => {return true};

      	form.cardno.value = "";
      	form.cardtype.value = "Pay-pal";
      	form.cardholder.value = details.payer.name.given_name;

      	form.btnpayment.click();
    });
  }

}).render('#paypal-button');
</script>