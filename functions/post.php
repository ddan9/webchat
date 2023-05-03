<?php

	function sendRemotePostMessage($remote_post_url, $nickname, $message)

	{

		$data = array("nickname" => $nickname, "message" => $message);

		$content = http_build_query($data);

		$options = array(

				"http" => array(

						"header"  => "Content-type: application/x-www-form-urlencoded",

						"method"  => "POST",

						"content" => "$content",

						),

				);

		$context  = stream_context_create($options);

		file_get_contents($remote_post_url, false, $context);

	};

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

					$nickname = $_POST["nickname"];

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

				$nickname = $_POST["nickname"];

			};

		};

		return $nickname;

	};

	function nicknameFormStatement($enable_only_authorized_username)

	{

		if ($_SERVER["PHP_AUTH_USER"] && $enable_only_authorized_username == "true")

		{

			$nicknameFormState = "disabled";

		}

		else

		{

			$nicknameFormState = "enabled";

		};

		return $nicknameFormState;

	};

	function fullscreenButtonStatement($enable_fullscreen_button)

	{

		if ($enable_fullscreen_button != "true")

		{

			$fullscreenButtonState = "hidden";

		}

		else

		{

			$fullscreenButtonState = "enabled";

		};

		return $fullscreenButtonState;

	};

	function helpButtonStatement($enable_help_button)

	{

		if ($enable_help_button != "true")

		{

			$helpButtonState = "hidden";

		}

		else

		{

			$helpButtonState = "enabled";

		};

		return $helpButtonState;

	};

	function logoutButtonStatement($use_php_basic_authentication, $enable_only_authorized_username)

	{

		if (isset($_SERVER["PHP_AUTH_USER"]) && ($use_php_basic_authentication == "true" || $enable_only_authorized_username == "true"))

		{

			$logoutButtonState = "enabled";

		}

		else

		{

			$logoutButtonState = "hidden";

		};

		return $logoutButtonState;

	};

	require_once("../functions/presets.php");

	require_once("../functions/authentication.php");

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

	$nickname = searchPreviousNickname($enable_only_authorized_username, $enable_nickname_remembering, $chat_database, $address, $total_messages);

	$nicknameFormState = nicknameFormStatement($enable_only_authorized_username);

	$fullscreenButtonState = fullscreenButtonStatement($enable_fullscreen_button);

	$helpButtonState = helpButtonStatement($enable_help_button);

	$logoutButtonState = logoutButtonStatement($use_php_basic_authentication, $enable_only_authorized_username);

	$message = $_POST["message"];

	if ($enable_experimental_remote_client_post_mode == "false")

	{

		if ($time != "" && $time != null && $date != "" && $date != null && $device != "" && $device != null && $nickname != "" && $nickname != null && $message != "" && $message != null && $address != "" && $address != null)

		{

			$chat_database[$total_messages][time] = base64_encode($time);

			$chat_database[$total_messages][date] = base64_encode($date);

			$chat_database[$total_messages][device] = base64_encode($device);

			$chat_database[$total_messages][nickname] = base64_encode($nickname);

			$chat_database[$total_messages][message] = base64_encode($message);

			$chat_database[$total_messages][address] = base64_encode($address);

		};

		if ($use_databases_encryption != "true")

		{

			file_put_contents($databases_messages_path, base64_encode(json_encode($chat_database, JSON_PRETTY_PRINT)));

		}

		else

		{

			file_put_contents($databases_messages_path, openssl_encrypt(base64_encode(json_encode($chat_database, JSON_PRETTY_PRINT)), $encryption_cipher, $salt_global.$databases_password.$salt_messages, $encryption_options, $encryption_iv));

		};

	}

	else

	{

		sendRemotePostMessage($remote_post_url, $nickname, $message);

	};

	require_once("../templates/post.html");

?>
