<?php global $site_title;?>
	<div class="jumbotron">
		<div class="container">
			<div class="row">
				<div class="col-xs-6">
					<h1 class="text-center">Welcome to <?php echo $site_title;?></h1>
					<p class="text-center">No more <b>Boring</b> time!! No more <b>Sleeping</b> time!! Just <b>signup</b> and enjoy unlimited fun!!</p>
				</div>
				<div class="col-xs-6">
					<div class="text-center col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<h2>CREATE AN ACCOUNT!</h2>
						<p>It's free and always will be.</p>
					</div>
					<div class="text-center col-lg-12"> 
						<?php echo form_open('Signup');?>
							<div class="form-group">
								<label for="fname">First Name</label>
								<?php echo form_error('fname', '<div class="error">', '</div>');?>
								<input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" value="<?php echo set_value('fname');?>">
							</div>
							<div class="form-group">
								<label for="lname">Last Name</label>
								<?php echo form_error('lname', '<div class="error">', '</div>');?>
								<input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value="<?php echo set_value('lname');?>">
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<label for="dob">D.O.B.</label>
								</div>
								<div class="row">
									<div class="col-xs-4">
									<?php echo form_error('date', '<div class="error">', '</div>');?>
										<select class="form-control" id="date" name="date">
											<option value="">--Date--</option>
											<?php
											for($date=1;$date<=31;$date++){
												if($date<10){
													$d='0'.$date;
												}else{
													$d=$date;
												}
												$dselected='';
												if($d==set_value('date')){
													$dselected='selected';
												}
												?>
												<option value="<?php echo $d;?>"<?php echo $dselected;?>><?php echo $d;?></option>
											<?php
											}
											?>
										</select>
									</div>
									<div class="col-xs-4">
									<?php echo form_error('month', '<div class="error">', '</div>');?>
										<select class="form-control" id="month" name="month">
											<option value="">--Month--</option>
											<?php
											for($m=1;$m<=12;$m++){
												$month = date('F',strtotime(date('Y-'.$m.'-d')));
												$mselected='';
												if($m==set_value('month')){
													$mselected='selected';
												}
												?>
												<option value="<?php echo $m;?>"<?php echo $mselected;?>><?php echo $month;?></option>
												<?php
											}
											?>
										</select>
									</div>
									<div class="col-sm-4">
									<?php echo form_error('year', '<div class="error">', '</div>');?>
										<select class="form-control" id="year" name="year">
											<option value="">--Year--</option>
											<?php
											for($y=1995;$y<=date('Y');$y++){
												$yselected='';
												if($y==set_value('year')){
													$yselected='selected';
												}
											?>
												<option value="<?php echo $y;?>"<?php echo $yselected;?>><?php echo $y;?></option>
											<?php
											}
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="email">Email ID</label>
								<?php echo form_error('email', '<div class="error">', '</div>');?>
								<input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo set_value('email');?>">
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<?php echo form_error('password', '<div class="error">', '</div>');?>
								<input type="password" class="form-control" id="password" name="password" placeholder="Password">
							</div>
							<div class="form-group">
								<label for="cpassword">Confirm-Password</label>
								<?php echo form_error('cpassword', '<div class="error">', '</div>');?>
								<input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm-Password">
							</div>
							<div class="form-group">
								<label for="gender">Gender</label>
								<?php echo form_error('gender', '<div class="error">', '</div>');?>
								<div class="form-control">
									<input type="radio" name="gender" value="M" <?php if(set_value('gender')=='M') echo 'checked';?>>&nbsp;Male&nbsp;
									<input type="radio" name="gender" value="F" <?php if(set_value('gender')=='F') echo 'checked';?>>&nbsp;Female&nbsp;
									<input type="radio" name="gender" value="O" <?php if(set_value('gender')=='O') echo 'checked';?>>&nbsp;Others</div>
								</div>
							</div>
							<div class="form-group">
								<span class='help-block'>By clicking Create an account, you agree to our <a href="#">Terms</a> and that you have read our <a href="#">Data Policy</a>, including our <a href="#">Cookie Use.</a>
								</span>
							</div>
							<div class="form-group">
								<button type="submit" name="create_account" id="create_account" class="btn btn-block btn-primary"> Create an account</button>
							</div>
						</form>
						<?php echo $this->session->flashdata('success');?>
					</div>
				</div>
			</div>
		</div>
	</div>