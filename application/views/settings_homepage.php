<div class="col-md-6 settings-list">
    <p class="text-center">Settings</p>
    <div class="settings-tile"><b>General Settings</b></div>
    <li><a href="#" class="profile-update">Update Profile</a></li>
    <form role="form" id="updateform" class="updateform">
        <div class="form-group">
            <label for="fname1">Unique ID</label>
            <input type="text" class="form-control" id="uniqueid" name="unique_id" placeholder="Unique ID" value="<?php echo $this->session->userdata('unique_id');?>" readonly>
        </div>
        <div class="form-group">
            <label for="fname1">First Name</label>
            <input type="text" class="form-control" id="fname1" name="fname" placeholder="First Name" value="<?php echo $userdata['fname'];?>">
        </div>
        <div class="form-group">
            <label for="lname">Last Name</label>
            <input type="text" class="form-control" id="lname1" name="lname" placeholder="Last Name" value="<?php echo $userdata['lname'];?>">
        </div>
        <div class="form-group">
            <label for="dob">D.O.B.</label>
            <input type="text" class="form-control" id="dob1" name="dob" placeholder="Date Of Birth" value="<?php echo $userdata['dob'];?>" readonly>
        </div>
        <div class="form-group">
            <label for="gender">Gender</label>
            <?php 
            $valueG = $userdata['gender'];
            $checkedM=$checkedF=$checkedO='';
            if($valueG=='M'){
              $checkedM = "checked";
            }
            if($valueG=='F'){
              $checkedF = "checked";
            }
            if($valueG=='O'){
              $checkedO = "checked";
            }
            ?>
            <div class="form-control">
                <input type="radio" name="gender" value="M" <?php echo $checkedM;?> >&nbsp;Male&nbsp;
                <input type="radio" name="gender" value="F" <?php echo $checkedF;?> >&nbsp;Female&nbsp;
                <input type="radio" name="gender" value="O" <?php echo $checkedO;?> >&nbsp;Others
            </div>
        </div>
        <div class="form-group">
            <label for="rel_status">Relationship Status</label>
            <select class="form-control" id="rel_status" name="rel_status">
                <option value="">Select</option>
                <?php
                foreach ($rs as $relation) {
                  $selected = '';
                  if($userdata['rel_status'] == $relation['id']){
                    $selected = 'selected';
                  }
                  echo "<option value='".$relation['id']."' ".$selected.">".$relation['type']."</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="edu_status">Educational Status</label>
            <input type="text" class="form-control" id="edu_status" name="edu_status" placeholder="Educational Status" value="<?php echo $userdata['edu_status'];?>">
        </div>
        <div class="form-group">
            <label for="interests">Interests</label>
            <textarea type="text" class="form-control" id="interests" name="interests" placeholder="Write something about your interests..."><?php echo $userdata['interests'];?></textarea>
        </div>
        <div class="form-group">
            <label for="acd">Account Created Date</label>
            <input type="text" class="form-control" id="acd1" name="creation_date" placeholder="Account Created Date" value="<?php echo date('M d, Y', strtotime($this->session->userdata('creation_date')));?>" readonly>
        </div>
        <div class="form-group">
            <button type="button" name="update_account" id="update_account" class="btn btn-primary"> Update</button>
            <button type="button" name="cancel_account" id="cancel_account" class="btn btn-primary"> Cancel</button>
        </div>
        <div class="form-group">
            <div for="msg" id="output_msg"></div>
        </div>
    </form>
</div>
