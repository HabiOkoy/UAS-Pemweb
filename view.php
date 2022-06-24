<?php

	require_once('dbconfig.php');
	global $con;

	$query = $con->prepare("SELECT * FROM ajax order by id DESC");
	$query->execute();
	mysqli_stmt_bind_result($query, $id, $judul, $penulis, $penerbit);
	
	?>
	<table class="table table-bordered">
		<tr class="info">
			<th>Judul</th>
			<th>Penulis</th>
			<th>Penerbit</th>
			<th>Aksi</th>
		</tr>
	<?php

	while(mysqli_stmt_fetch($query))
	{
		echo '
		<tr>
			<td>'.$judul.'</td>
			<td>'.$penulis.'</td>
			<td>'.$penerbit.'</td>
			<td><button id="'.$id.'" class="edit btn btn-info">Edit</button> <button class="del btn btn-danger" id="'.$id.'">Delete</button></td>
		</tr>';
	}
		echo '</table>';
	
?>
<script type="text/javascript">
	$('.del').click(function() {
		var id = $(this).attr('id');
		$.ajax({
	    url : "delete.php",
	    type: "POST",
	    data : { id: id },
	    success: function(data)
	    {
	    	$('#records_content').fadeOut(1100).html(data);
	    	$.get("view.php", function(data)
	    	{	
	    		$("#table_content").html(data); 
	    	});
	    }
	});
}); // delete close

	$('.edit').click(function() {
		var id = $(this).attr('id');
		$('#show-add').hide();
		$.ajax({
	    url : 'edit.php',
	    type: 'POST',
	    data : { id: id },
	    success: function(data)
	    {
    		$("#link-add").html(data);
    		$('#link-add').show();
	    }
	});
}); // edit close

</script>