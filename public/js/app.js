var postId=0;
var postBodyElement=null;
$(document).ready(function(){
    $('.edit').click(function(event){
        // console.log("hello");
        event.preventDefault();
        // console.log(this);
        postBodyElement=event.target.parentNode.parentNode.childNodes[1];
        var postBody=postBodyElement.textContent;
        postId=event.target.parentNode.parentNode.dataset['postid'];
        // console.log(postId);
        // console.log(postBody);
        $('#post-body').val(postBody);
       $('#exampleModal').modal('show');
    });

    $('#modal-save').click(function(e) {
        if(!$('#editmodal').valid()){
            e.preventDefault()
        }

        $.ajax({
            method:'POST',
            url: urlEdit,
            data:{
                body: $('#post-body').val(),
                postId: postId,
                _token: token
            }
        })
        .done(function(msg){
            // if(msg.errors)
            // {
            //     jQuery('.alert-danger').html('');

            //     jQuery.each(msg.errors, function(key, value){
            //         jQuery('.alert-danger').show();
            //         jQuery('.alert-danger').append('<li>'+value+'</li>');
            //     });
            // }
            // else
            // {
            //     jQuery('.alert-danger').hide();
            //     $('#open').hide();
            //     $('#myModal').modal('hide');
            // }
            // console.log(JSON.stringify(msg));
            $(postBodyElement).text(msg['new-body']);
            $('#exampleModal').modal('hide');
        });
    });

    $("[data-bs-toggle='tooltip']").tooltip();
});
