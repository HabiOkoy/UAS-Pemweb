<?php

	require_once('dbconfig.php');
	global $con;

	$judul = $_POST['judul'];
	$penulis = $_POST['penulis'];
	$penerbit = $_POST['penerbit'];

	if(!empty($judul) && !empty($penulis) && !empty($penerbit))
	{
		$query = $con->prepare("INSERT into ajax (judul, penulis, penerbit) VALUES (?,?,?)");

		$query->bind_param('sss',$judul,$penulis,$penerbit);

		$result = $query->execute();

		if($result) 
		{
	        echo '<div class="col-md-offset-4 col-md-5 text-center alert alert-success">1 Record Added!</div>';
	    }
	    else
	    	exit(mysqli_error($con));    
	}