<?php
include("header.php");
?>
<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Contact</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
<!-- contact -->
	<div class="about">
		<div class="w3_agileits_contact_grids">
			<div class="col-md-6 w3_agileits_contact_grid_left">
				<div class="agile_map">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3271.3386529502477!2d138.60195461455584!3d-34.92304278037796!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ab0ced474e04f45%3A0x4bbcdba5a6fc11e6!2sInternational%20Institute%20of%20Business%20and%20Information%20Technology%20-%20Federation%20University%20Australia%2C%20Adelaide%20Campus!5e0!3m2!1sen!2sau!4v1654687886683!5m2!1sen!2sau" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></iframe>
				</div>
				<div class="agileits_w3layouts_map_pos">
					<div class="agileits_w3layouts_map_pos1">
						<h3>Contact Info</h3>
						<p>6/127 Rundle Mall, Adelaide SA 5000.</p>
						<ul class="wthree_contact_info_address">
							<li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:info@example.com">info@SriLakshmiGrocery.com</a></li>
							<li><i class="fa fa-phone" aria-hidden="true"></i>(08) 8203 9001</li>
						</ul>
						<div class="w3_agile_social_icons w3_agile_social_icons_contact">
							<ul>
								<li><a href="#" class="icon icon-cube agile_facebook"></a></li>
								<li><a href="#" class="icon icon-cube agile_rss"></a></li>
								<li><a href="#" class="icon icon-cube agile_t"></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 w3_agileits_contact_grid_right">
				<h2 class="w3_agile_header">Leave a<span> Message</span></h2>

				<form action="#" method="post">
					<span class="input input--ichiro">
						<input class="input__field input__field--ichiro" type="text" id="input-25" name="Name" placeholder=" " required="" />
						<label class="input__label input__label--ichiro" for="input-25">
							<span class="input__label-content input__label-content--ichiro">Your Name</span>
						</label>
					</span>
					<span class="input input--ichiro">
						<input class="input__field input__field--ichiro" type="email" id="input-26" name="Email" placeholder=" " required="" />
						<label class="input__label input__label--ichiro" for="input-26">
							<span class="input__label-content input__label-content--ichiro">Your Email</span>
						</label>
					</span>
					<textarea name="Message" placeholder="Your message here..." required=""></textarea>
					<input type="submit" value="Submit">
				</form>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
<!-- contact -->

<?php
include("footer.php");
?>