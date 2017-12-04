<!-- Sign up/Log in modal-->
<div class="modal fade" id="signup-login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			
			<!-- modal header -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			
			<!-- modal body -->
			<div class="modal-body">
				<!-- tab label -->
				<ul id="signup-login-tabs" class="nav nav-tabs">
					<li role="presentation" class="active"><a href="#login-tab">Login</a></li>
					<li role="presentation"><a href="#register-tab">Register</a></li>
				</ul>
				
				<!-- tab content -->
				<div class="tab-content" id="signup-login-form">
					
					<!-- login form -->
					<div class="tab-pane fade active in" role="tabpanel" id="login-tab" aria-labelledby="login-tab">
						<form class="form-horizontal" id="form-login" method="POST">
							<div class="form-group">
   								<label for="email-login" class="col-sm-3 control-label">Email</label>
   								<div class="col-sm-8">
									<input type="email" class="form-control" id="email-login" name="email" placeholder="Email">
								</div>
							</div>
							<div class="err-msg" id="err-email-login">
							</div>
							<div class="form-group">
								<label for="password" class="col-sm-3 control-label">Password</label>
								<div class="col-sm-8">
									<input type="password" class="form-control" id="password" name="password" placeholder="Password">
								</div>
							</div>
							<div class="err-msg" id="err-password">
							</div>
							<div class="checkbox">
								<label>
							    	<input type="checkbox" id="stay-logged" name="stay-logged"> Stay logged in
								</label>
							</div>
							<div class="form-group clearfix">
								<div class="col-sm-4">
									<a href="#" id="recover-acct">Forgot your password?</a>
								</div>
								<div class="col-sm-7">
									<button type="submit" class="btn btn-primary" id="btn-login" name="submit" value="login">Login</button>
								</div>
							</div>
						</form> <!-- /.form-horizontal -->
					</div> <!-- /#login-tab -->

					<!-- registration form -->
					<div class="tab-pane fade" role="tabpanel" id="register-tab" aria-labelledby="register-tab"> 
						<form class="form-horizontal" id="form-register" action="verify-registration.php" method="POST">
							<div class="form-group">
   								<label for="firstname" class="col-sm-4 control-label">First Name</label>
   								<div class="col-sm-7">
									<input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name">
								</div>
							</div>
							<div class="err-msg" id="err-firstname">
							</div>
							<div class="form-group">
								<label for="lastname" class="col-sm-4 control-label">Last Name</label>
								<div class="col-sm-7">
									<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name">
								</div>
							</div>
							<div class="err-msg" id="err-lastname">
							</div>
							<div class="form-group">
   								<label for="email" class="col-sm-4 control-label">Email</label>
   								<div class="col-sm-7">
									<input type="email" class="form-control" id="email-reg" name="email" placeholder="Email">
								</div>
							</div>
							<div class="err-msg" id="err-email-reg">
							</div>
							<div class="form-group">
								<label for="email-confirm" class="col-sm-4 control-label">Confirm Email</label>
								<div class="col-sm-7">
									<input type="email" class="form-control" id="email-confirm" name="email-confirm" placeholder="Re-enter Email">
								</div>
							</div>
							<div class="err-msg" id="err-email-confirm">
							</div>
							<div class="form-group">
   								<label for="password-new" class="col-sm-4 control-label">Password</label>
   								<div class="col-sm-7">
									<input type="password" class="form-control" id="password-new" name="password" placeholder="Password">
								</div>
							</div>
							<div class="err-msg" id="err-password-new">
							</div>
							<div class="form-group">
								<label for="password-confirm" class="col-sm-4 control-label">Confirm Password</label>
								<div class="col-sm-7">
									<input type="password" class="form-control" id="password-confirm" name="password-confirm" placeholder="Re-enter Password">
								</div>
							</div>
							<div class="err-msg" id="err-password-confirm">
							</div>
							<div class="radio">
								<label for="acct-renter">
									<input type="radio" name="acct-type" id="acct-renter" value="Renter" checked />
									Renter
								</label>
							</div>
							<div class="radio">
								<label for="acct-owner">
									<input type="radio" name="acct-type" id="acct-owner" value="Owner" />
									Property Owner
								</label>
							</div>
							<div class="form-group">
								<div class="col-sm-11">
									<button type="submit" class="btn btn-primary" id="btn-register" name="submit" value="register">Register</button>
								</div>
							</div>
						</form>  <!-- /.form-horizontal -->
					</div> <!-- /#register-tab -->
				</div> <!-- /#signup-login-form -->
			</div> <!-- /.modal-body -->

			<!-- modal footer -->
			<div class="modal-footer">
				<p>Or sign in with:</p>
				<p>
					<button type="button" class="btn btn-default" id="signin-btn-fb">Facebook</button>
					<button type="button" class="btn btn-default" id="signin-btn-gplus">Google +</button>
				</p>
			</div> <!-- /.modal-footer -->

		</div> <!-- /.modal-content -->
	</div> <!-- /.modal-dialog -->
</div> <!-- /#signup-login-modal -->