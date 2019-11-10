<div class="container">
    <div class="row">
        <div class="col-lg-offset-3 col-xs-12 col-lg-6">
            <div class="jumbotron">
                <div class="row text-center">
                    <div class="text-center col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h3>Find your Account</h3>
                </div>
                <div class="text-center col-lg-12">
                    <?php echo form_open('password_reset_link');?>
                        <div class="form-group">
                            <label for="email">Email ID</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?php echo set_value('email');?>" placeholder="Email ID">
                            <?php echo form_error("email", "<div class='error'>", "</div>");?>
                            <?php echo $this->session->flashdata('msg');?>
                        </div>
                        <span class='help-block'><b>Password Reset link will be mailed to you in the above provided mail ID if valid.</b></span>
                        <div class="col-xs-6">
                            <button type="submit" id="fpSubmit" class="btn btn-block btn-primary" name="fpSubmit">Email Password</button>
                        </div>
                        <div class="col-xs-6">
                            <button type="button" id="fpCancel" class="btn btn-block btn-primary" name="fpCancel">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>