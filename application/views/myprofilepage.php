<div class="col-md-9 profile-page">
	<?php echo $this->session->flashdata('upload_error');?>
    <div class="cover-pic-div">
        <img src="<?php echo base_url().$userdata['cover_pic'];?>" width="100%" height="100%">
        <div class="profile-pic-div">
            <img src="<?php echo base_url().$userdata['profile_pic'];?>" width="100%" height="100%">
        </div>
        <div class="cover-pic-button">
            <button id="cover-pic" name="cover-pic" class="btn btn-primary" title="Change your cover picture">Change Cover Picture</button>
        </div>
    </div>
</div>