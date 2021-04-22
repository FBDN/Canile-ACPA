$(function () {
    $('input[type=radio]').change(function (e) {
        var that = $(this);
        $.ajax({
            url: './filter.php',
            type: 'POST',
            data: 'filter=' + that.val()+'&table='+that.data("table"),
            success: function (data) {
                $('.' + that.data("table")+'_table').html(data);
            }
        })
    });

    
})