<div class="col-md-6 news-feed">
    <p class="text-center">What's in your mind?!</p>
    <?php echo form_open_multipart('new_story');?>
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <textarea type="text" class="form-control" name="story_post" id="story_post" placeholder="Post a status update!"></textarea>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <input type="file" class="form-control" name="story_file" id="story_file">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <button type="submit" name="submit_post" id="submit_post" class="btn btn-primary" disabled>POST</button>
                </div>
            </div>
        </div>
    </form>
    <?php echo $this->session->flashdata('storymsg');?>

    <?php 
    global $site_title;
    if ( date('m', strtotime($this->session->userdata('dob'))) == date('m') && date('d', strtotime($this->session->userdata('dob'))) == date('d') ){
        $rand = rand(1,6);
        $image_path = base_url().'assets/images/dob/hbd'.$rand.'.jpg';
        ?>
        <div class="wish-birthday">
            <p>On behalf of <?php echo $site_title;?> team... We wish you a</p>
            <img src="<?php echo $image_path;?>" width="90px" height="90px">
        </div>
    <?php
    }
    ?>
    
    <div class="news-feed-title">News Feed!</div>
    <div class="story-div">
    </div>
    <div align='center' id='pagination' class="my-pagination"></div>
</div>
