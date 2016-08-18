/**
 * Created by Богдан on 15.06.2016.
 */

$(document).ready(function() {
    $('.add-to-cart').click(addToCart);
    $('.minus').click(function(e){
        e.preventDefault();
        quantity(-1, this);
    });
    $('.plus').click(function(e){
        e.preventDefault();
        quantity(1, this);
    });
    $('a.remove-product').click(dellOfCart);
    $('label.status').click(changeStatus);
    $('label.status').click(changeStatus);
});

function addToCart(e) {
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: $(this).attr('href'),
        dataType: "json",
        success: function (data) {
            var options = {
                "backdrop" : "true"
            }
            if (data.success == 1) {
                $('.count-item').text(data.count);
                $('#modal-item').modal(options);
            } else if (data.success == 2) {
                $('.login button').click();
            } else {
                alert(data.message);
            }
        },
        error: function (data) {
            alert('Error');
        }
    })
}

function quantity(val, th) {
    var $input = $(th).parent().find('.quantity');
    var count = parseInt($input.val()) + val;
    count = count < 1 ? 1 : count;
    $.ajax({
        type: "POST",
        url: $(th).attr('href'),
        data: {quantity: count},
        dataType: "json",
        success: function (data) {
            if (data.success==1) {
                $input.val(count);
                $('span.amount').text(data.amount);
                return false;
            } else {
                alert(data.message);
            }
        },
        error: function (data) {
            alert('Error');
        }
    })
}

function dellOfCart(e) {
    e.preventDefault();
    var $this = $(this);
    $.ajax({
        type: "GET",
        url: $(this).attr('href'),
        dataType: "json",
        success: function (data) {
            if (data.count == 0){
                document.location.href = document.location.href;
            } else if (data.success == 1) {
                $this.parents('tr.remove-product').fadeOut(700);
                $('span.amount').text(data.amount);
                $('p.count-item').text(data.count);
                return false;
            } else {
                alert(data.message);
            }
        },
        error: function (data) {
            alert('Error');
        }
    })
}

function changeStatus(e) {
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: $(this).attr('href'),
        dataType: "json",
        success: function (data) {
            if (data.success == 1) {
                $('label.status').text(data.amount);
                return false;
            } else {
                alert(data.message);
            }
        },
        error: function (data) {
            alert('Error');
        }
    })
}
