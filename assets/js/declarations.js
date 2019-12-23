function loadPagination(pageno) {
    $.ajax({
        url: site_url+'user_stories/'+pageno,
        type: 'get',
        dataType: 'json',
        success: function(r) {
            $('#pagination').html(r.pagination);
            createTable(r.result, r.row);
        }
    });
}

function createTable(result, row) {
    row = Number(row);
    $('.news-feed .story-div').empty();
    for(i in result){
        var pp = "<img class='n-profile-pic' src='"+site_url+result[i].profile_pic+"' height='50px' width='50px' alt='/'>";
        var name = result[i].fname+' '+result[i].lname;
        var story = result[i].story;
        var image = "<img src='"+site_url+result[i].file+"' height='250px' width='100%' alt='/'></img>";
        var time = result[i].elapsed_time;
        var sid = result[i].sid;
        var likes = result[i].likes;
        var ldata = result[i].ldata;
        var dynamic_class = '';
        if (InObject(current_id,ldata)) {
            dynamic_class = 'make-bold';
        }
        var post = '';
        if(story!='' && story!=undefined) {
            post = story;
        }
        if(result[i].file!='' && result[i].file!=undefined) {
            post = image;
        }
        if(story!='' && story!=undefined && result[i].file!='' && result[i].file!=undefined){
            post = story+"<br><br>"+image;
        }
        var html = "<div class='story-count'>"+ pp +"<span class='user-name'>"+ name +"</span><span class='elapsed-time'>"+ time +"</span><a class='like-button "+dynamic_class+"' data-id='"+ sid +"'><i class='fa fa-thumbs-o-up' aria-hidden='true'></i><span class='like-cnt' data-id='"+ likes +"'>"+ likes +"</span></a>";
        html += "<div class='story-file'>"+ post +"</div>";
        html += "</div><hr>";
        $('.news-feed .story-div').append(html);
    }
}

function generate_modal(fileid, saveid, cancelid, head_msg, flagValue) {
    if(fileid!='') {
        $('.modal-body').find('input[type=file]').attr('id', fileid);
        $('.modal-body').find('input[type=file]').attr('name', fileid);
    }
    if(saveid!='') {
        $('.modal-body').find('button[type=submit]').attr('id', saveid);
        $('.modal-body').find('button[type=submit]').attr('name', saveid);
    }
    if(cancelid!='') {
        $('.modal-body').find('button[type=button]').attr('id', cancelid);
        $('.modal-body').find('button[type=button]').attr('name', cancelid);
    }
    if(head_msg!=''){
        $('.modal-header').find('h4').text(head_msg);
    }
    if(flagValue!=''){
        $('.modal-body form #uflag').val(flagValue);
    }
    return 'done';
}

function InObject(needle, object) {
    for (k in object) {
        if(needle == object[needle]) {
            return true;
        }
    }
    return false;
}

function ajax_search_friends(search_term) {

    $.ajax({
        url: site_url+'getfriendlist/',
        type: 'post',
        data: {
            search_term : search_term
        },
        success: function(response){
            $('.loader-div').hide();
            if(search_term==''){
                $('.friend_list').html('');
            }else{
                $('.friend_list').html(response);
            }
        }
    });

}