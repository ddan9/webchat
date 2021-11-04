<?php

	include("../functions/presets.php");

	$GUESS_WHO = "1";

	include("../functions/post.php");

	$chat_database_files = json_decode(base64_decode(file_get_contents("../databases/files.json"), true), true);

	$total_files = count($chat_database_files);

	$filetype = $_FILES["userfile"]["type"];

	$filetmp = fopen($_FILES['userfile']['tmp_name'], "r");

	$fileraw = base64_encode(fread($filetmp, filesize($_FILES['userfile']['tmp_name'])));

	fclose($filetmp);

	$filename = $_FILES["userfile"]["name"];

	$filesize = $_FILES["userfile"]["size"];

	$filebody = "data:" . $filetype . ";base64," . $fileraw;

	$time =  date("H:i:s d.m.Y");

	if ($time != "" && $time != null && $filename != "" && $filename != null && $filetype != "" && $filetype != null && $filesize != "" && $filesize != null && $filebody != "" && $filebody != null && $address != "" && $address != null)

	{

		$chat_database_files[$total_files][time] = base64_encode($time);

		$chat_database_files[$total_files][filename] = base64_encode($filename);

		$chat_database_files[$total_files][filetype] = base64_encode($filetype);

		$chat_database_files[$total_files][filesize] = base64_encode($filesize);

		$chat_database_files[$total_files][filebody] = base64_encode($filebody);

		$chat_database_files[$total_files][address] = base64_encode($address);

	};

	file_put_contents("../databases/files.json", base64_encode(json_encode($chat_database_files, JSON_PRETTY_PRINT)));

	header("Location: ../attachments/");

?>