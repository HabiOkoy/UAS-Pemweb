<?php

	require_once('dbconfig.php');
	global $con;
	$id = $_POST['id'];

	if(empty($id))
	{
		?><div class="text-center">no records found under this selection <a href="#" onclick="$('#link-add').hide();$('#show-add').show(700);">Hide this</a></div>
		<?php
		die();
	}

	$query = "SELECT * FROM ajax where id='$id'";
	if (!$result = mysqli_query($con, $query)) {
	        exit(mysqli_error($con));
	    }
	while($row = mysqli_fetch_assoc($result))
	{
		?>
		<div class="form-inline" id="edit-data">
			<div class="form-group col-md-3">
				<input type="text" judul="judul" id="judul" value="<?php echo $row['judul']; ?>" placeholder="judul" class="form-control" required />
			</div>
			<div class="form-group col-md-3">
				<input type="text" judul="penulis" id="penulis" placeholder="penulis" class="form-control" value="<?php echo $row['penulis']; ?>" required/>
			</div>
			<div class="form-group col-md-3">
				<input type="text" id="penerbit" judul="penerbit" placeholder="penerbit" class="form-control" value="<?php echo $row['penerbit']; ?>" required />
			</div>
			<div class="form-group col-md-3">
			<button type="button" class="btn btn-primary update" id="<?php echo $row['id']; ?>" judul="update">Update Record</button>
			<button type="button" href="javascript:void(0);" class="btn btn-default" id="cancel" judul="add" onclick="$('#link-add').slideUp(400);$('#show-add').show(700);">Cancel</button>
		</div>
	<?php
	}
	?>

<script type="text/javascript">
	$('.update').click(function() {
		var id = $(this).attr('id');
        var judul = $('#judul').val();
        var penulis = $('#penulis').val();
        var penerbit = $('#penerbit').val();

        $.ajax({
            url: "update.php",
            type: "POST",
            data: { id: id, judul: judul, penulis: penulis, penerbit: penerbit },
            success: function(data, status, xhr) {
                $('#judul').val('');
                $('#penulis').val('');
                $('#penerbit').val('');
                $('#records_content').fadeOut(1100).html(data);
                $.get("view.php", function(html) {
                    $("#table_content").html(html);
                });
                $('#records_content').fadeOut(1100).html(data);
            },
            complete: function() {
                $('#link-add').hide();
                $('#show-add').show(700);
            }
        });
    }); // update close
</script>