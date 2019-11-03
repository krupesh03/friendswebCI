<button type="button" class="close-button" id="close-button" title="Close Results"><b>&times</b></button>
<?php
$i=0;
foreach($friends_list as $fl){
    ?>
    <div class="friends_class" data-url='<?php echo site_url();?>'>
        <div class="friend-name">
            <?php echo ucfirst($fl['fname'])." ".ucfirst($fl['lname']);?>
        </div>
        <div class="friend-mail">
            <?php echo $fl['email'];?>
        </div>
        <img class="image-class-list" src="<?php echo base_url().$fl['profile_pic'];?>" alt="<?php echo $fl['fname'].".".$fl['lname'];?>" title="<?php echo $fl['fname'].".".$fl['lname'];?>">
    </div>
    <div class="break-line"></div>
    <?php
    $i++;
}
if($i==5){
?>
    <div class="load-more">
        <a href="#">See More...</a>
    </div>
<?php
}elseif($i==0){
    ?>
    <div class="load-more">No Result</div>
    <?php
}
?>