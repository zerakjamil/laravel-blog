// resources/js/app.js

require('./bootstrap');

$(document).ready(function() {
    $('.like-btn').on('click', function() {
        var commentId = $(this).data('comment-id');

        $.ajax({
            url: 'posts/comments/' + commentId + '/like',
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.liked) {
                    alert('You liked the comment.');
                } else {
                    alert('You unliked the comment.');
                }
            }
        });
    });
});
