<div class="container">
    <div class="row">
        <div class="col-lg-offset-3 col-xs-12 col-lg-6">
            <div class="jumbotron">
                <div class="row text-center">
                    <div class="text-center col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h3>Reset Password</h3>
                    </div>
                    <div class="text-center col-lg-12">
                        <?php echo form_open('reset_your_password');?>
                            <div class="form-group">
                                <label for="email">Email ID</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email ID" value="<?php echo set_value('email');?>">
                                <?php echo form_error('email','<div class="error">','</div>');?>
                            </div>
                            <div class="form-group">
                                <label for="password">Enter New Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                <?php echo form_error('password','<div class="error">','</div>');?>
                            </div>
                            <div class="form-group">
                                <label for="password">Confirm-Password</label>
                                <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm-Password">
                                <?php echo form_error('cpassword','<div class="error">','</div>');?>
                            </div>
                            <button type="submit" id="fpreset" class="btn btn-block btn-primary" name="fpreset">Reset Password</button>
                        </form>
                        <?php echo $this->session->flashdata('msg');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>