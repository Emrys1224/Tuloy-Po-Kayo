<?php 
session_start();

// for test only
$testArr = array();

$pageTitle = "Profile Page";

require_once 'core/init.php';
require_once 'includes/acct-details.php';

// redirect to home if not logged
if (!$id) {
    header("Location: http://localhost/Tuloy-Po-Kayo");
}

// retrieve profile info
$acctInfo = $db->query("SELECT * FROM `account` WHERE `id` = '$id'")->fetch();

// retrieve list of properties owned
$propertyList = array();
if ($acctType === "Owner") {
	$properties = $db->query("SELECT `name`, `unit_number`, `street`, `purok`, `barangay`, `municipality`, `province` FROM `rental_unit` WHERE `owner_id` = '$id'");

	while ($property = $properties->fetch()) {
		$temp = array();
		$temp['name'] = $property['name'];
		
		// build address
		$address = "";
		foreach ($property as $key => $value) {
			if ($key !== "name" && isset($value)) {
				$address .= $value.", ";
			}
		}
		$temp['address'] = substr($address, 0, -2); // remove the comma and space at the end

		$propertyList[] = $temp;
	}
}

// retrieve conversations list
$convList = array();
$convSelf = $acctType === "Owner" ? "owner_id" : "tenant_id";
$convWith = $acctType === "Owner" ? "tenant_id" : "owner_id";
$convIds = $db->query("SELECT `id`, `$convWith` FROM `conversation` WHERE `$convSelf` = '$id'");

while ($convId = $convIds->fetch()) {
	$temp = array();
	$temp['convId'] = $convId['id'];
	$temp['convWith'] = $db->query("SELECT CONCAT(`firstname`, ' ', `lastname`) AS `name` FROM `account` WHERE `id` = '".$convId[$convWith]."'")->fetchColumn();

	$convList[] = $temp;
}

include 'includes/head.php';
?>

<!-- costum styles -->
	<link href="css/del-acct-modal.css" rel="stylesheet" type="text/css">
	<link href="css/properties.css" rel="stylesheet" type="text/css">
	<link href="css/profile.css" rel="stylesheet" type="text/css">
	<link href="css/messages.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php
include 'includes/acct-del.php';
if ($acctType === "Owner") {
	include 'includes/del-property.php';
}
include 'includes/nav.php';
 ?>

<!-- Content -->
<main class="row">
	<section class="col-sm-9">
		<div id="content">

			<!-- content tabs -->
			<ul class="nav nav-tabs" id="renter-page-tabs" role="tablist">

				<!-- properties-tab -->
				<?php if ($acctType === "Owner"): ?>
					<li role="presentation" class="active"><a href="#properties" id="properties-tab" role="tab" data-toggle="tab" aria-controls="properties" aria-expanded="true">Properties</a></li>
				<?php endif; ?>

				<li role="presentation" class="<?= $acctType !== 'Owner' ? 'active' : '' ?>"><a href="#profile" id="profile-tab" role="tab" data-toggle="tab" aria-controls="profile" aria-expanded="true">Profile</a></li> 
				<li role="presentation"><a href="#messages" role="tab" id="messages-tab" data-toggle="tab" aria-controls="messages">Messages</a></li>
			</ul>

			<div class="tab-content"> 
				
				<!-- properties-tab contents -->
				<?php if ($acctType === "Owner"): ?>
					<div class="tab-pane fade in active" role="tabpanel" id="properties" aria-labelledby="properties-tab">
						<div id="properties-list">

							<?php if (empty($propertyList)): ?>
								<h3>No listed property to display.</h3>
							<?php else: ?>
								<?php foreach ($propertyList as $property): ?>
									<div class="list-item row">
										<div class="col-sm-10">
											<h4>
												<a href="rental-unit-mngt-page.php"><?= $property['name'] ?></a>
											</h4>
											<p><?= $property['address'] ?></p>
										</div>
										<div class="btn-group-property col-sm-2">
											<button type="button" class="btn btn-warning btn-xs btn-del-property" data-toggle="modal" data-target="#del-property-modal">Delete</button>
											<a href="rental-unit-mngt-page.php" class="btn btn-info btn-xs btn-edit-property">Edit</a>
										</div>
									</div>
								<?php endforeach; ?>
							<?php endif; ?>

						</div>
						<!-- <button type="button" class="btn btn-primary" id="btn-add-property">Add Property</button> -->
						<a href="rental-unit-mngt-page.php" class="btn btn-primary" id="btn-add-property">Add Property</a>
					</div> <!-- #properties -->
				<?php endif; ?>
				
				<!-- profile-tab contents -->
				<div class="tab-pane fade <?= $acctType !== 'Owner' ? 'in active': '' ?>" role="tabpanel" id="profile" aria-labelledby="profile-tab">
					
					<!-- acct settings view mode -->
					<div id="acct-settings-view">
						<h4 class="info-group">Account Settings</h4>
						<div class="row info-group">
							<label class="col-xs-3" for="acct-name">Name</label>
							<div class="col-xs-9" id="acct-name">
								<span id="name-first"><?= $acctInfo['firstname'] ?></span>  
								<span id="name-last"><?= $acctInfo['lastname'] ?></span>
							</div>
						</div>
						<div class="row info-group">
							<label class="col-xs-3" for="email">Email</label>
							<div class="col-xs-9">
								<span id="email"><?= $acctInfo['email'] ?></span>
							</div>
						</div>
						<div class="row info-group">
							<label class="col-xs-3" for="linked-acct">Linked Account</label>
							<div class="col-xs-9">
								<span id="linked-acct"><?= isset($acctInfo['linked_acct']) ? $acctInfo['linked_acct'] : "No account linked" ?></span>
							</div>
						</div>
						<div class="row info-group">
							<label class="col-xs-3" for="phone">Phone Number</label>
							<div class="col-xs-9">
								<span id="phone"><?= isset($acctInfo['contact_number']) ? $acctInfo['contact_number'] : "No contact number provided" ?></span>
							</div>
						</div>

						<?php if ($acctType !== "Owner"): ?>
							<div class="row info-group">
								<label class="col-xs-3" for="status">Status</label>
								<div class="col-xs-9">
									<span id="status"><?= $acctInfo['status'] ?></span>
								</div>
							</div>
						<?php endif; ?>

						<div class="row info-group">
							<label class="col-xs-3" for="password">Password</label>
							<div class="col-xs-9">
								<span id="password"></span>
							</div>
						</div>
						<div id="btn-group" class="clearfix">
							<button type="button" class="btn btn-warning btn-sm" id="btn-del-acct" data-toggle="modal" data-target="#del-acct-modal">Delete Account</button>
							<button type="button" class="btn btn-info btn-sm" id="btn-edit-settings">Edit</button>
						</div>
					</div> <!-- #acct-settings-view -->
					
					<!-- acct setting edit mode -->
					<div id="acct-settings-edit">
						<h4 class="info-group">Account Settings</h4>
						<div class="row input-group">
							<label class="col-sm-3" for="edit-acct-name">Name</label>
							<div class="col-sm-4" id="edit-acct-name">
								<input type="text" class="form-control" id="edit-1st-name" name="firstName" value="<?= $acctInfo['firstname'] ?>">
							</div>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="edit-lst-name" name="lastName" value="<?= $acctInfo['lastname'] ?>">
							</div>
						</div>
						<div class="row input-group">
							<label class="col-sm-3" for="edit-email">Email</label>
							<div class="col-sm-6">
								<input type="email" class="form-control" id="edit-email" name="email" value="<?= $acctInfo['email'] ?>">
							</div>
						</div>
						<div class="row input-group">
							<label class="col-sm-3" for="edit-linked-acct">Linked Account</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="edit-linked-acct" name="linkedAcct" placeholder="Link to your social media acct" value="<?= $acctInfo['linked_acct'] ?>">
							</div>
						</div>
						<div class="row input-group">
							<label class="col-sm-3" for="edit-phone">Phone Number</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="edit-phone" name="phone" placeholder="Phone number e.g. +63912-345-6789" value="<?= $acctInfo['contact_number'] ?>">
							</div>
						</div>

						<?php if ($acctType !== "Owner"): ?>
							<div class="row input-group">
								<label class="col-sm-3" for="edit-status">Status</label>
								<div class="col-sm-6">
									<select id="price-from" class="form-control" name="status">

										<?php
										$options = array("Anonymous", "Student", "Worker");
										foreach($options as $option): ?>
											<option <?= $acctInfo['status'] === $option ? 'selected="selected"' : '' ?>><?= $option ?></option>
										<?php endforeach; ?>

									</select>
								</div>
							</div>
						<?php endif; ?>

						<div class="row input-group">
							<label class="col-sm-3" for="edit-password">Password</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="edit-password" name="password">
							</div>
						</div>
						<div class="row input-group">
							<label class="col-sm-3" for="confirm-password">Confirm Password</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="confirm-password" name="password">
							</div>
						</div>
						<div id="btn-group">
							<button type="button" class="btn btn-primary btn-sm" id="btn-save">Save</button>
						</div>
					</div> <!-- #acct-settings-edit -->

				</div> <!-- #profile -->
				
				<!-- messages tab content -->
				<div class="tab-pane fade" role="tabpanel" id="messages" aria-labelledby="messages-tab">
					<div id="messages-list">
						<?php if (empty($convList)): ?>
							<h3>You currently have no message to be displayed.</h3>
						<?php else: ?>
							<?php foreach ($convList as $conversation): ?>
								<div class="list-item" data-conv_id="<?= $conversation['convId'] ?>"><h4><?= $conversation['convWith'] ?></h4></div>	<!-- data-convId cannot be used in jquery .data() method -->
							<?php endforeach; ?>
						<?php endif; ?>
					</div>

					<div id="messages-view">
						<div class="clearfix" id="msgs-header">
							<i class="fa fa-window-close-o" id="close-btn"></i>
							<h4></h4>
							<p></p>
						</div>
						<div id="msgs-body"></div>
						<div id="msgs-footer">
							<textarea rows="2" placeholder="Write message..."></textarea>
							<button class="btn btn-primary btn-sm" id="btn-msg-send"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
						</div>
					</div> <!-- #messages-view -->
				</div>

			</div> <!-- .tab-content -->

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
    var testArr = new Array();
    <?php foreach($testArr as $key => $val): ?>
        testArr.push(<?php echo "{'$key':'$val'}"; ?>);
    <?php endforeach; ?>

	console.log(testArr)
</script>

<script src="js/common.js" type="text/javascript"></script>
<script src="js/del-acct-modal.js" type="text/javascript"></script>
<script src="js/properties.js" type="text/javascript"></script>
<script src="js/profile.js" type="text/javascript"></script>
<script src="js/messages.js" type="text/javascript"></script>
</body>
</html>