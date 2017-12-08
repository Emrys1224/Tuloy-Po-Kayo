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
$testArr = $acctInfo;


include 'includes/head.php';
?>

<!-- costum styles -->
	<link href="css/profile.css" rel="stylesheet" type="text/css">
	<link href="css/del-acct-modal.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php
include 'includes/acct-del.php';
include 'includes/nav.php';
 ?>

<!-- Content -->
<main class="row">
	<section class="col-sm-9">
		<div id="content">

			<!-- content tabs -->
			<ul class="nav nav-tabs" id="renter-page-tabs" role="tablist">
				<?php if ($acctType === "Owner"): ?>
					<li role="presentation" class="active"><a href="#properties" id="properties-tab" role="tab" data-toggle="tab" aria-controls="properties" aria-expanded="true">Properties</a></li>
				<?php endif; ?>
				<li role="presentation" class="<?php if ($acctType !== 'Owner') echo 'active'; ?>"><a href="#profile" id="profile-tab" role="tab" data-toggle="tab" aria-controls="profile" aria-expanded="true">Profile</a></li> 
				<li role="presentation"><a href="#messages" role="tab" id="messages-tab" data-toggle="tab" aria-controls="messages">Messages</a></li>
			</ul>

			<div class="tab-content"> 
				
				<?php if ($acctType === "Owner"): ?>
				<!-- properties-tab contents -->
				<div class="tab-pane fade in active" role="tabpanel" id="properties" aria-labelledby="properties-tab">
					<div id="properties-list">
						<h3>No listed property to display.</h3>
					</div>
					<!-- <button type="button" class="btn btn-primary" id="btn-add-property">Add Property</button> -->
					<a href="rental-unit-mngt-page(JuanNew).html" class="btn btn-primary" id="btn-add-property">Add Property</a>
				</div> <!-- #properties -->
				<?php endif; ?>
				
				<!-- profile-tab contents -->
				<div class="tab-pane fade <?php if ($acctType !== 'Owner') echo 'in active'; ?>" role="tabpanel" id="profile" aria-labelledby="profile-tab">
					
					<!-- acct settings view mode -->
					<div id="acct-settings-view">
						<h4 class="info-group">Account Settings</h4>
						<div class="row info-group">
							<label class="col-xs-3" for="acct-name">Name</label>
							<div class="col-xs-9" id="acct-name">
								<span id="name-first"><?php echo $acctInfo['firstname']; ?></span>  
								<span id="name-last"><?php echo $acctInfo['lastname']; ?></span>
							</div>
						</div>
						<div class="row info-group">
							<label class="col-xs-3" for="email">Email</label>
							<div class="col-xs-9">
								<span id="email"><?php echo $acctInfo['email']; ?></span>
							</div>
						</div>
						<div class="row info-group">
							<label class="col-xs-3" for="linked-acct">Linked Account</label>
							<div class="col-xs-9">
								<span id="linked-acct"><?php echo isset($acctInfo['linked_acct']) ? $acctInfo['linked_acct'] : "No account linked"; ?></span>
							</div>
						</div>
						<div class="row info-group">
							<label class="col-xs-3" for="phone">Phone Number</label>
							<div class="col-xs-9">
								<span id="phone"><?php echo isset($acctInfo['contact_number']) ? $acctInfo['contact_number'] : "No contact number provided"; ?></span>
							</div>
						</div>

						<?php if ($acctInfo['status'] !== "Owner"): ?>
							<div class="row info-group">
								<label class="col-xs-3" for="status">Status</label>
								<div class="col-xs-9">
									<span id="status"><?php echo $acctInfo['status']; ?></span>
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
								<input type="text" class="form-control" id="edit-1st-name" name="firstName" value="<?php echo $acctInfo['firstname']; ?>">
							</div>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="edit-lst-name" name="lastName" value="<?php echo $acctInfo['lastname']; ?>">
							</div>
						</div>
						<div class="row input-group">
							<label class="col-sm-3" for="edit-email">Email</label>
							<div class="col-sm-6">
								<input type="email" class="form-control" id="edit-email" name="email" value="<?php echo $acctInfo['email']; ?>">
							</div>
						</div>
						<div class="row input-group">
							<label class="col-sm-3" for="edit-linked-acct">Linked Account</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="edit-linked-acct" name="linkedAcct" placeholder="Link to your social media acct" value="<?php echo $acctInfo['linked_acct']; ?>">
							</div>
						</div>
						<div class="row input-group">
							<label class="col-sm-3" for="edit-phone">Phone Number</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="edit-phone" name="phone" placeholder="Phone number e.g. +63912-345-6789" value="<?php echo $acctInfo['contact_number']; ?>">
							</div>
						</div>

						<?php if ($acctInfo['status'] !== "Owner"): ?>
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
					<h3>You currently have no message to be displayed.</h3>
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
<script src="js/profile.js" type="text/javascript"></script>
<script src="js/del-acct-modal.js" type="text/javascript"></script>
</body>
</html>