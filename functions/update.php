<?php

	function searchPreviousNickname($enable_only_authorized_username, $enable_nickname_remembering, $chat_database, $address, $total_messages)

	{

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

	function connectionCooldown($use_user_connection_message_sending, $use_user_connection_cooldown, $user_connection_cooldown, $custom_time_set, $time_messages_format, $chat_database, $total_messages, $nickname)

	{

		if ($use_user_connection_message_sending == "true" && $use_user_connection_cooldown == "true")

		{

			$time = strtotime($custom_time_set);

			for ($i = $total_messages; $i >= 0; $i--)

			{

				if (base64_decode($chat_database[$i][nickname]) == $nickname)

				{

					$currentTime = strtotime(base64_decode($chat_database[$i][time]));

					$cooldownTime = strtotime($user_connection_cooldown, $currentTime);

					if ($cooldownTime > $time)

					{

						$isCooldown = "true";

					}

					else

					{

						$isCooldown = "false";

					};

					break;

				};

			};

			return $isCooldown;

		};

	};

	function SendNotifyMessage($use_user_connection_message_sending, $connectionCooldown, $use_databases_encryption, $userNickname, $databases_messages_path, $custom_time_set, $time_messages_format, $custom_date_set, $date_messages_format, $encryption_cipher, $salt_global, $databases_password, $salt_messages, $encryption_options, $encryption_iv)

	{

		if ($use_user_connection_message_sending == "true" && $connectionCooldown != "true")

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

			$nickname = $userNickname;

			$message = "$userNickname connected!";

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

	};

	include("../functions/presets.php");

	include("../templates/update.html");

	if ($use_databases_encryption != "true")

	{

		$chat_database = json_decode(base64_decode(file_get_contents($databases_messages_path), true), true);

	}

	else

	{

		$chat_database = json_decode(base64_decode(openssl_decrypt(file_get_contents($databases_messages_path), $encryption_cipher, $salt_global.$databases_password.$salt_messages, $encryption_options, $encryption_iv), true), true);

	};

	$total_messages = count($chat_database);

	$nickname = searchPreviousNickname($enable_only_authorized_username, $enable_nickname_remembering, $chat_database, $address, $total_messages);

	$connectionCooldown = connectionCooldown($use_user_connection_message_sending, $use_user_connection_cooldown, $user_connection_cooldown, $custom_time_set, $time_messages_format, $chat_database, $total_messages, $nickname);

	SendNotifyMessage($use_user_connection_message_sending, $connectionCooldown, $use_databases_encryption, $nickname, $databases_messages_path, $custom_time_set, $time_messages_format, $custom_date_set, $date_messages_format, $encryption_cipher, $salt_global, $databases_password, $salt_messages, $encryption_options, $encryption_iv);

?>