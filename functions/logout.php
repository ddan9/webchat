<?php

	function SendNotifyMessage($use_databases_encryption, $databases_messages_path, $custom_time_set, $time_messages_format, $custom_date_set, $date_messages_format, $login, $encryption_cipher, $salt_global, $databases_password, $salt_messages, $encryption_options, $encryption_iv)

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

		$message = "User $login disconnected!";

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

	if ($use_user_disconnection_message_sending == "true")

	{

		if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']))

		{

			$login = $_SERVER['PHP_AUTH_USER'];

			if ($login != "logout")

			{

				SendNotifyMessage($use_databases_encryption, $databases_messages_path, $custom_time_set, $time_messages_format, $custom_date_set, $date_messages_format, $login, $encryption_cipher, $salt_global, $databases_password, $salt_messages, $encryption_options, $encryption_iv);

			};

		};

	};

	require_once("../templates/logout.html");

	if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')

	{

		$protocol = 'https://';

	}

	else

	{

		$protocol = 'http://';

	};

	$host = $_SERVER['HTTP_HOST'];

	$URL = $_SERVER['REQUEST_URI'];

//	header("Location: ${protocol}logout:logout@${host}${URL}/../lobby");

?>
