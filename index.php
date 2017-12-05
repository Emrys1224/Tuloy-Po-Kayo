<?php
session_start();

// for test only
$testArr = array();

require_once 'core/init.php';
require_once 'includes/acct-details.php';

include 'includes/head.php';

if (!$id) {
	include 'includes/signup-login-modal.php';
}

include 'includes/nav.php';

?>

<!-- Content -->
<main class="row">
	<section class="col-sm-9">
		<div id="content">

			<h2>Helping you find your new home away from home</h2>
			
			<!-- Search field form -->
			<form method="GET" action="search-result.php">
				<div class="form-group">
					<label for="location" class="label-lg">Location</label>
					<input type="text" class="form-control" id="location" name="location" placeholder="Enter a city, town, province....">
				</div>
				<label class="label-lg">Price</label>
				<div class="form-group row">
					<label for="price-from" class="col-sm-1 col-sm-offset-1 control-label">From</label>
					<div class="col-sm-4">
						<div class="input-group">
							<div class="input-group-addon">&#8369;</div>
							<select id="price-from" name="price-from" class="form-control">
								<option>Any</option>
								<option>500.00</option>
								<option>1,000.00</option>
								<option>2,000.00</option>
								<option>5,000.00</option>
							</select>
						</div>
					</div>
					<label for="price-to" class="col-sm-1 col-sm-offset-1 control-label">To</label>
					<div class="col-sm-4">
						<div class="input-group">
							<div class="input-group-addon">&#8369;</div>
							<select id="price-to" name="price-to" class="form-control">
								<option>Any</option>
								<option>500.00</option>
								<option>1,000.00</option>
								<option>2,000.00</option>
								<option>5,000.00</option>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="property-type" class="label-lg">Property Type</label>
					<div class="row">
						<div class="col-sm-8">
							<select id="property-type" name="property-type" class="form-control">
								<option>Any</option>
								<option>Apartment</option>
								<option>Dormitory</option>
								<option>House for Rent</option>
								<option>Room for Rent</option>
								<option>Bed Space</option>
							</select>
						</div>
						<div class="col-sm-4">
							<button type="submit" class="btn btn-primary btn-lg" id="btn-search">Search</button>
						</div>
					</div>
				</div>
			</form>
			
			<hr>
			
			<div id="reg-owner">
				<button type="button" class="btn btn-info btn-lg" id="btn-reg-owner" data-toggle="modal" data-target="#signup-login-modal">Advertise Your Property Here!!!</button>
			</div>

		</div> <!-- #content -->
	</section>
	<aside class="col-sm-3">
		<div class="ad"><h3>AD</h3></div>
		<div class="ad"><h3>AD</h3></div>
	</aside>
</main>

<?php include 'includes/footer.php'; ?>

<!-- for test oonly -->
<script type="text/javascript">
	// select a tab (signup-login-modal)
	// $('#signup-login-tabs a').click(function (e) {
	// 	e.preventDefault()
	// 	$(this).tab('show');
	// });
	
    var testArr = new Array();
    <?php foreach($testArr as $key => $val){ ?>
        testArr.push(<?php echo "{'$key':'$val'}"; ?>);
    <?php } ?>

	console.log(testArr)
</script>

<script src="js/common.js" type="text/javascript"></script>
<script src="js/signup-login-modal.js" type="text/javascript"></script>
<script src="js/index.js" type="text/javascript"></script>
</body>
</html>

