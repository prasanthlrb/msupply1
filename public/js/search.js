$('#search_box').on('keyup', function () {
    let search = $(this).val();
    if (search.length > 3) {
        $.ajax({
            url: '/searchbox',
            type: "GET",
            data: { search: search },
            success: function (data) {
                //console.log(data)
                //var html =
                $('#search_result').html(data)
            }
        });
    }
})