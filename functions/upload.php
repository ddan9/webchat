<?php

	function SendNotifyMessage($databases_messages_path, $time_messages_format)

	{

		$chat_database = json_decode(base64_decode(file_get_contents($databases_messages_path), true));

		$total_messages = count($chat_database);

		$time = date($time_messages_format);

		$nickname = "System";

		$message = "New file has been added!";

		$address = "Notify";

		$chat_database[$total_messages][time] = base64_encode($time);

		$chat_database[$total_messages][nickname] = base64_encode($nickname);

		$chat_database[$total_messages][message] = base64_encode($message);

		$chat_database[$total_messages][address] = base64_encode($address);

		file_put_contents($databases_messages_path, base64_encode(json_encode($chat_database, JSON_PRETTY_PRINT)));

	};

	include("../functions/presets.php");

	$chat_database_files = json_decode(base64_decode(file_get_contents($databases_files_path), true), true);

	$total_files = count($chat_database_files);

	$filetype = $_FILES["userfile"]["type"];

	$filetmp = fopen($_FILES["userfile"]["tmp_name"], "r");

	$fileraw = base64_encode(fread($filetmp, filesize($_FILES["userfile"]["tmp_name"])));

	fclose($filetmp);

	$filename = $_FILES["userfile"]["name"];

	$filesize = $_FILES["userfile"]["size"];

	$filebody = "data:" . $filetype . ";base64," . $fileraw;

	$time =  date($time_files_format);

	if ($time != "" && $time != null && $filename != "" && $filename != null && $filetype != "" && $filetype != null && $filesize != "" && $filesize != null && $filebody != "" && $filebody != null && $address != "" && $address != null)

	{

		$chat_database_files[$total_files][time] = base64_encode($time);

		$chat_database_files[$total_files][filename] = base64_encode($filename);

		$chat_database_files[$total_files][filetype] = base64_encode($filetype);

		$chat_database_files[$total_files][filesize] = base64_encode($filesize);

		$chat_database_files[$total_files][filebody] = base64_encode($filebody);

		$chat_database_files[$total_files][address] = base64_encode($address);

		SendNotifyMessage($databases_messages_path, $time_messages_format);

	};

	file_put_contents($databases_files_path, base64_encode(json_encode($chat_database_files, JSON_PRETTY_PRINT)), LOCK_EX);

	header("Location: ../attachments/");

?>