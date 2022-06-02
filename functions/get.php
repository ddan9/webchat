<?php

	function send_messages_database($use_databases_encryption, $recieve_client_password, $client_password_to_send_database, $PASSWORD, $databases_messages_path, $encryption_cipher, $salt_global, $databases_password, $salt_messages, $encryption_options, $encryption_iv)

	{

		if ($recieve_client_password == "true")

		{

			if ($PASSWORD == $client_password_to_send_database)

			{

				if ($use_databases_encryption != "true")

				{

					$chat_database = file_get_contents($databases_messages_path);

				}

				else

				{

					$chat_database = openssl_decrypt(file_get_contents($databases_messages_path), $encryption_cipher, $salt_global.$databases_password.$salt_messages, $encryption_options, $encryption_iv);

				};

			}

			else

			{

				$chat_database = null;

			};

		}

		else

		{

			if ($use_databases_encryption != "true")

			{

				$chat_database = file_get_contents($databases_messages_path);

			}

			else

			{

				$chat_database = openssl_decrypt(file_get_contents($databases_messages_path), $encryption_cipher, $salt_global.$databases_password.$salt_messages, $encryption_options, $encryption_iv);

			};

		};

		return $chat_database;

	};

	include("../functions/presets.php");

	header("Cache-Control: no-store, no-cache, must-revalidate");

	$TYPE = $_GET["type"];

	$PASSWORD = $_GET["password"];

	switch ($TYPE)

	{

		case "messages":

			echo send_messages_database($use_databases_encryption, $recieve_client_password, $client_password_to_send_database, $PASSWORD, $databases_messages_path, $encryption_cipher, $salt_global, $databases_password, $salt_messages, $encryption_options, $encryption_iv);

			break;

		case "files":

			echo file_get_contents($databases_files_path);

			break;

		case "audio":

			echo file_get_contents($audio_notify_path);

			break;

		case "address":

			echo $address;

			break;

		default:

			break;

	};

?>