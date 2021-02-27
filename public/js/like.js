function likeRestaurant(id) {

    $.ajax({
        url: actionLike,
        type: "POST",
        data: {
            "_token": csrf,
            'id': id
        },
        dataType: 'json',
        success: function (data) {
            $( "#likes-count" ).text(data.count_likes)
        },
        error: function (msg) {
            alert('Error');
        }
    });
}
