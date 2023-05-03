<?php

	function readableBytes($bytes)

	{

		$i = floor(log($bytes) / log(1024));

		$sizes = array("B", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB");

		return sprintf("%.02F", $bytes / pow(1024, $i)) * 1 . " " . $sizes[$i];

	};

	function throwMessageFiles($throw_message)

	{

		require("../functions/presets.php");

		require_once("../templates/throw.html");

		header('Window-target: main-frame');

		header("refresh:3; url=../attachments/");

		exit();

	};

	function searchPreviousNickname($enable_only_authorized_username, $enable_nickname_remembering, $address, $use_databases_encryption, $databases_messages_path, $encryption_cipher, $salt_global, $databases_password, $salt_messages, $encryption_options, $encryption_iv)

	{

		if ($use_databases_encryption != "true")

		{

			$chat_database = json_decode(base64_decode(file_get_contents($databases_messages_path), true), true);

		}

		else

		{

			$chat_database = json_decode(base64_decode(openssl_decrypt(file_get_contents($databases_messages_path), $encryption_cipher, $salt_global.$databases_password.$salt_messages, $encryption_options, $encryption_iv), true), true);

		};

		$total_messages = count($chat_database);

		if ($_SERVER["PHP_AUTH_USER"] && $enable_only_authorized_username == "true")

		{

			$nickname = $_SERVER["PHP_AUTH_USER"];

		}

		else

		{

			if ($enable_nickname_remembering == "true")

			{

				if ($_POST["nickname"] != "" && $_POST["nickname"] != null)

				{

					$nickname = "Anonymous";

				}

				else

				{

					for ($i = $total_messages; $i >= 0; $i--)

					{

						if (base64_decode($chat_database[$i][address]) == $address)

						{

							$nickname = base64_decode($chat_database[$i][nickname]);

							break;

						};

					};

				};

			}

			else

			{

				$nickname = "Anonymous";

			};

		};

		return $nickname;

	};

	function SendNotifyMessage($use_databases_encryption, $databases_messages_path, $custom_time_set, $time_messages_format, $custom_date_set, $date_messages_format, $total_uploaded_files, $encryption_cipher, $salt_global, $databases_password, $salt_messages, $encryption_options, $encryption_iv)

	{

		if ($use_databases_encryption != "true")

		{

			$chat_database = json_decode(base64_decode(file_get_contents($databases_messages_path), true), true);

		}

		else

		{

			$chat_database = json_decode(base64_decode(openssl_decrypt(file_get_contents($databases_messages_path), $encryption_cipher, $salt_global.$databases_password.$salt_messages, $encryption_options, $encryption_iv), true), true);

		};

		$total_messages = count($chat_database);

		$time = date($time_messages_format, strtotime($custom_time_set));

		$date = date($date_messages_format, strtotime($custom_date_set));

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

		$chat_database[$total_messages][date] = base64_encode($date);

		$chat_database[$total_messages][device] = base64_encode($device);

		$chat_database[$total_messages][nickname] = base64_encode($nickname);

		$chat_database[$total_messages][message] = base64_encode($message);

		$chat_database[$total_messages][address] = base64_encode($address);

		if ($use_databases_encryption != "true")

		{

			file_put_contents($databases_messages_path, base64_encode(json_encode($chat_database, JSON_PRETTY_PRINT)));

		}

		else

		{

			file_put_contents($databases_messages_path, openssl_encrypt(base64_encode(json_encode($chat_database, JSON_PRETTY_PRINT)), $encryption_cipher, $salt_global.$databases_password.$salt_messages, $encryption_options, $encryption_iv));

		};

	};

	require_once("../functions/presets.php");

	require_once("../functions/authentication.php");

	if ($use_databases_encryption != "true")

	{

		$chat_database_files = json_decode(base64_decode(file_get_contents($databases_files_path), true), true);

	}

	else

	{

		$chat_database_files = json_decode(base64_decode(openssl_decrypt(file_get_contents($databases_files_path), $encryption_cipher, $salt_global.$databases_password.$salt_files, $encryption_options, $encryption_iv), true), true);

	};

	$total_files = count($chat_database_files);

	$date = date($date_files_format, strtotime($custom_date_set));

	$nickname = searchPreviousNickname($enable_only_authorized_username, $enable_nickname_remembering, $address, $use_databases_encryption, $databases_messages_path, $encryption_cipher, $salt_global, $databases_password, $salt_messages, $encryption_options, $encryption_iv);

	$total_uploading_files = count($_FILES["userfile"]["name"]);

	$upload_max_filesize = ini_get("upload_max_filesize")*1048576;

	for ($i = 0; $i < $total_uploading_files; $i++)

	{

		$filename = $_FILES["userfile"]["name"][$i];

		$filesize = $_FILES["userfile"]["size"][$i];

		if (($filesize < 1) || ($filesize > $upload_max_filesize))

		{

			$throw_message_files = "File $filename is too big!";

			throwMessageFiles($throw_message_files);

		};

	};

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

		$time = date($time_files_format, strtotime($custom_time_set));

		if ($time != "" && $time != null && $date != "" && $date != null && $nickname != "" && $nickname != null && $device != "" && $device != null && $filename != "" && $filename != null && $filetype != "" && $filetype != null && $filesize != "" && $filesize != null && $filebody != "" && $filebody != null && $address != "" && $address != null)

		{

			$chat_database_files[$total_files + $i][time] = base64_encode($time);

			$chat_database_files[$total_files + $i][date] = base64_encode($date);

			$chat_database_files[$total_files + $i][nickname] = base64_encode($nickname);

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

		SendNotifyMessage($use_databases_encryption, $databases_messages_path, $custom_time_set, $time_messages_format, $custom_date_set, $date_messages_format, $total_uploaded_files, $encryption_cipher, $salt_global, $databases_password, $salt_messages, $encryption_options, $encryption_iv);

	};

	if ($use_databases_encryption != "true")

	{

		file_put_contents($databases_files_path, base64_encode(json_encode($chat_database_files, JSON_PRETTY_PRINT)), LOCK_EX);

	}

	else

	{

		file_put_contents($databases_files_path, openssl_encrypt(base64_encode(json_encode($chat_database_files, JSON_PRETTY_PRINT)), $encryption_cipher, $salt_global.$databases_password.$salt_files, $encryption_options, $encryption_iv), LOCK_EX);

	};

	header("Location: ../attachments/");

?>
