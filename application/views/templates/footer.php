<?php global $site_title;?>
<footer class="text-center">
    <div class="container">
        <div class="row">
            <div class="col-xs-12" style="padding: 10px;">
                <p>Copyright © <?php echo strtolower($site_title);?>. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>

<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="" id="imagepreview" width="100%" height="100%">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="formmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4></h4>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('update_profile_image');?>
                    <div class="form-group">
                        <input type="file" class="form-control" id="" name="" required>
                        <input type="hidden" id="uflag" name="uflag" value="">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="" id="" class="btn btn-primary">Upload</button>
                        <button type="button" name="" id="" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
var site_url = '<?php echo site_url();?>';
var current_id = '';
</script>

<?php 
if ( $this->session->has_userdata('logged_in') ) {?>
    <script>
        current_id = '<?php echo $this->session->userdata('id');?>';
    </script>
<?php
}
?>

<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
<script src="<?php echo base_url();?>assets/js/customjs.js"></script>  
<script src="<?php echo base_url();?>assets/js/declarations.js"></script> 
</body>
</html>