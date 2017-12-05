<?php 
session_start();

// for test only
$testArr = array();

require_once 'core/init.php';
require_once 'includes/acct-details.php';

// redirect to home if not logged
if (!$id) {
    header("Location: http://localhost/Tuloy-Po-Kayo");
}

include 'includes/head.php';
include 'includes/nav.php';

echo "Profile page";



 ?>


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
</body>
</html>