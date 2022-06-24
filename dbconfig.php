<?php

	global $con;

	$con = mysqli_connect('localhost','root','','pemweb2');

	if(!$con)
	{
		echo 'unable to connect with db';
		die();
	}