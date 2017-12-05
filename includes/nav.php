<!-- Navigation/Header -->
<nav class="navbar navbar-default">
  <div class="container-fluid">

    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-group" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Tuloy Po Kayo</a>
    </div><!-- /.navbar-header -->
    
    <div id="nav-group" class="collapse in navbar-collapse">
		<div id="nav-links" class="navbar-right">

			<!-- site navigation -->
		    <ul id="site-nav1" class="nav navbar-nav">
				<li class="active"><a href="#">Home</a></li>

				<!-- modify nav for login -->
				<?php if (!$id): ?>
					<li><a href="#" id="signin-nav-link" data-toggle="modal" data-target="#signup-login-modal">Register/Login</a></li>
				<?php else: ?>
					<li id="acct-nav-link" class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span id="username"><?php echo $username; ?></span><span class="caret"></span></a>
						<!-- profile links dropdown-->
						<ul class="dropdown-menu">
							<!-- modify according to account type -->
							<?php if ($acctType === "Owner"): ?>
								<li><a href="#" id="link-properties">Properties</a></li>
							<?php  endif; ?>
							<li><a href="profile.php" id="link-profile">Profile</a></li>
							<li><a href="#" id="link-message">Messages</a></li>
							<li><a href="?logout=1" id="logout">Logout</a></li>
						</ul>
					</li>
				<?php endif; ?>

				<li role="separator" class="nav-separator divider"></li>
		    </ul>
		    
		    <!-- social media links -->
		    <ul id="social-links1" class="social-links nav navbar-nav">
				<li><a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i><span class="sr-only">Toggle navigation</span></a></li>
				<li><a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i><span class="sr-only">Toggle navigation</span></a></li>
				<li><a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i><span class="sr-only">Toggle navigation</span></a></li>
		    </ul>

		</div> <!-- /#nav-links -->
    </div><!-- /.navbar-collapse -->

  </div><!-- /.container-fluid -->
</nav>