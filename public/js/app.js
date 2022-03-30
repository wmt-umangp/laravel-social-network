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
    $('#modal-save').click(function() {
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
            // console.log(JSON.stringify(msg));
            $(postBodyElement).text(msg['new-body']);
            $('#exampleModal').modal('hide');
        });
    });

    $('.like').click(function(event){
        event.preventDefault();
        var isLike=event.target.previousElementSibling==null;
        postId=event.target.parentNode.parentNode.dataset['postid'];
        // console.log(isLike);
        $.ajax({
            method:'POST',
            url: urlLike,
            data:{
                isLike: isLike,
                postId: postId,
                _token: token,
            }
        })
        .done(function (){
            event.target.innerText = isLike ? event.target.innerText == 'Like' ? 'You like this post' : 'Like' : event.target.innerText == 'Dislike' ? 'You don\'t like this post' : 'Dislike';
            if (isLike) {
                event.target.nextElementSibling.innerText = 'Dislike';
            } else {
                event.target.previousElementSibling.innerText = 'Like';
            }
        });
    });
});
