
$(document).ready(function(){
    $(document).on('click', '#fpCancel', function(){
        window.location.href = site_url;
    });

    $(document).on('keyup', '#search_friends', function(){
        $('.friend_list').html('');
        $('.loader-div').show();
        var search_term = $(this).val();
        $.ajax({
            url: site_url+'getfriendlist/',
            type: 'post',
            data: {
                search_term : search_term
            },
            success: function(response){
                setTimeout(function(){
                    $('.loader-div').hide();
                    if(search_term==''){
                        $('.friend_list').html('');
                    }else{
                        $('.friend_list').html(response);
                    }
                },2000);
            }
        });
    });

    $(document).on('click', '#close-button', function(){
        $('.friend_list').html('');
        $('#search_friends').val('');
    });

    $(document).on('click', '.friends_class', function(){
        window.location.href = $(this).attr('data-url');
    });

    $(document).on('keyup', '#story_post', function(){
        if($(this).val()=="" && $('#story_file').val()==""){
            $('#submit_post').prop('disabled', true);
        } else {
            $('#submit_post').prop('disabled', false);
        }
    });

    $(document).on('change', '#story_file', function(){
        if($(this).val()=="" && $('#story_post').val()==""){
            $('#submit_post').prop('disabled', true);
        } else {
            $('#submit_post').prop('disabled', false);
        }
    });

    if(current_id!='') {
        loadPagination(0);
    }

    $('#pagination').on('click', 'a', function(e){
        e.preventDefault();
        var pageno = $(this).attr('data-ci-pagination-page');
        loadPagination(pageno);
    });

    setTimeout(function(){
        $('.success_msg').fadeOut();
    }, 5000);

    $(document).on('click', '.image-expand', function(e){
        e.preventDefault();
        $('#imagepreview').attr('src', $(this).find('img').attr('src'));
        $('#imagemodal').modal();
    });

    $(document).on('click', '.profile-pic-div', function(e){
        e.preventDefault();
        fileid = 'profile';
        saveid = 'upro_button';
        cancelid = 'upro_cancel';
        head_msg = 'NEW PROFILE PICTURE';
        flagValue = 1;
        $.when(generate_modal(fileid, saveid, cancelid, head_msg, flagValue)).done(function(){
            $('#formmodal').modal();
        });
    });

    $(document).on('click', '#cover-pic', function(e){
        e.preventDefault();
        fileid = 'cover';
        saveid = 'ucov_button';
        cancelid = 'ucov_cancel';
        head_msg = 'NEW COVER PICTURE';
        flagValue = 2;
        $.when(generate_modal(fileid, saveid, cancelid, head_msg, flagValue)).done(function(){
            $('#formmodal').modal();
        });
    });

    $(document).on('hidden.bs.modal', '#formmodal', function(){
        $('#formmodal .modal-body form').find('input[type=file]').attr('id','');
        $('#formmodal .modal-body form').find('input[type=file]').attr('name', '');
        $('#formmodal .modal-body form').find('button[type=submit]').attr('id', '');
        $('#formmodal .modal-body form').find('button[type=submit]').attr('name', '');
        $('#formmodal .modal-body form').find('button[type=button]').attr('id', '');
        $('#formmodal .modal-body form').find('button[type=button]').attr('name', '');
        $('#formmodal .modal-header').find('h4').text('');
        $('#formmodal .modal-body form #uflag').val('');
    });

    $(document).on('click', '.like-button', function(event){
        event.preventDefault();
        var cur_count = Number($(this).find('.like-cnt').attr('data-id'));alert(cur_count);
        if(!$(this).hasClass('make-bold')) {
            $(this).addClass('make-bold');
            var counter = 1;
            $(this).find('.like-cnt').attr('data-id',cur_count++);
            $(this).find('.like-cnt').text(cur_count++);
        } else {
            $(this).removeClass('make-bold');
            var counter = 0;
            $(this).find('.like-cnt').attr('data-id',cur_count--);
            $(this).find('.like-cnt').text(cur_count--);
        }
        $.ajax({
            url: site_url+'/Insertcontrol/update_like_counts',
            type: 'post',
            data: {
                counter: counter,
                sid: $(this).attr('data-id')
            },
            success: function(r) {
                alert(r);
            }
        });
    });
});
