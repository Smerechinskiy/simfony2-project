/**
 * Created by Богдан on 15.06.2016.
 */

$(document).ready(function() {
     $('input.status').change(changeStatus);
});

function changeStatus() {
    $.ajax({
        type: "POST",
        url: $(this).parents('.radio').data('href'),
        data: {
            status: $(this).val()
        },
        dataType: "json",
        success: function (data) {
            if (data.success) {
                if (data.message){
                    $('.status .glyphicon-ok-sign').addClass('active');
                } else {
                    $('.status .glyphicon-ok-sign').removeClass('active');
                }
            } else {
                alert(data.message);
            }
        },
        error: function (data) {
            alert('Error');
        }
    })
}