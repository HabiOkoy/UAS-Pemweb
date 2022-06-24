$(document).ready(function() {

    $.get("view.php", function(data) {
        $("#table_content").html(data);
    });

    $('#link-add').hide();

    $('#show-add').click(function() {
        $('#link-add').slideDown(500);
        $('#show-add').hide();
    });

    $('#add').click(function() {
        var judul = $('#judul').val();
        var penulis = $('#penulis').val();
        var penerbit = $('#penerbit').val();

        $.ajax({
            url: "add.php",
            type: "POST",
            data: { judul: judul, penulis: penulis, penerbit: penerbit },
            success: function(data, status, xhr) {
                $('#judul').val('');
                $('#penulis').val('');
                $('#penerbit').val('');
                $.get("view.php", function(html) {
                    $("#table_content").html(html);
                });
                $('#records_content').fadeOut(1100).html(data);
            },
            error: function() {
                $('#records_content').fadeIn(3000).html('<div class="text-center">error here</div>');
            },
            beforeSend: function() {
                $('#records_content').fadeOut(700).html('<div class="text-center">Loading...</div>');
            },
            complete: function() {
                $('#link-add').hide();
                $('#show-add').show(700);
            }
        });
    }); // add close

}); // document ready close
