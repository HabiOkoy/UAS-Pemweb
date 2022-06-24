<?php

	require_once('dbconfig.php');
	global $con;

	$id = $_POST['id'];
	$judul = $_POST['judul'];
	$penulis = $_POST['penulis'];
	$penerbit = $_POST['penerbit'];

	if(!empty($judul) && !empty($penulis) && !empty($penerbit) && !empty($id))
	{
		$query = "UPDATE ajax  SET judul='$judul', penulis='$penulis', penerbit='$penerbit' WHERE id='$id'";
		if (!$result = mysqli_query($con, $query)) {
	        exit(mysqli_error($con));
	    }
	    echo '<div class="col-md-offset-4 col-md-5 text-center alert alert-success">1 Record updated!</div>';
	}
	else
	{
		echo '<div class="col-md-offset-4 col-md-5 text-center alert alert-danger">error while updating record</div>';
	}