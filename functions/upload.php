<?php

	function SendNotifyMessage($databases_messages_path, $time_messages_format, $total_uploaded_files)

	{

		$chat_database = json_decode(base64_decode(file_get_contents($databases_messages_path), true));

		$total_messages = count($chat_database);

		$time = date($time_messages_format);

		$device = "Server";

		$nickname = "System";

		if ($total_uploaded_files > 1)

		{

			$message = "New $total_uploaded_files files has been added!";

		}

		else

		{

			$message = "New file has been added!";

		};

		$address = "Notify";

		$chat_database[$total_messages][time] = base64_encode($time);

		$chat_database[$total_messages][device] = base64_encode($device);

		$chat_database[$total_messages][nickname] = base64_encode($nickname);

		$chat_database[$total_messages][message] = base64_encode($message);

		$chat_database[$total_messages][address] = base64_encode($address);

		file_put_contents($databases_messages_path, base64_encode(json_encode($chat_database, JSON_PRETTY_PRINT)));

	};

	include("../functions/presets.php");

	$chat_database_files = json_decode(base64_decode(file_get_contents($databases_files_path), true), true);

	$total_files = count($chat_database_files);

	$total_uploading_files = count($_FILES["userfile"]["name"]);

	$total_uploaded_files = 0;

	for ($i = 0; $i < $total_uploading_files; $i++)

	{

		$filetype = $_FILES["userfile"]["type"][$i];

		$filetmp = fopen($_FILES["userfile"]["tmp_name"][$i], "r");

		$fileraw = base64_encode(fread($filetmp, filesize($_FILES["userfile"]["tmp_name"][$i])));

		fclose($filetmp);

		$filename = $_FILES["userfile"]["name"][$i];

		$filesize = $_FILES["userfile"]["size"][$i];

		$filebody = "data:" . $filetype . ";base64," . $fileraw;

		$time =  date($time_files_format);

		if ($time != "" && $time != null && $device != "" && $device != null && $filename != "" && $filename != null && $filetype != "" && $filetype != null && $filesize != "" && $filesize != null && $filebody != "" && $filebody != null && $address != "" && $address != null)

		{

			$chat_database_files[$total_files + $i][time] = base64_encode($time);

			$chat_database_files[$total_files + $i][device] = base64_encode($device);

			$chat_database_files[$total_files + $i][filename] = base64_encode($filename);

			$chat_database_files[$total_files + $i][filetype] = base64_encode($filetype);

			$chat_database_files[$total_files + $i][filesize] = base64_encode($filesize);

			$chat_database_files[$total_files + $i][filebody] = base64_encode($filebody);

			$chat_database_files[$total_files + $i][address] = base64_encode($address);

			$total_uploaded_files++;

		};

	};

	if ($total_uploaded_files > 0)

	{

		SendNotifyMessage($databases_messages_path, $time_messages_format, $total_uploaded_files);

	};

	file_put_contents($databases_files_path, base64_encode(json_encode($chat_database_files, JSON_PRETTY_PRINT)), LOCK_EX);

	header("Location: ../attachments/");

?>