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

	include("../functions/presets.php");

	$chat_database = json_decode(base64_decode(file_get_contents($databases_messages_path), true), true);

	$total_messages = count($chat_database);

	$time = date($time_messages_format);

	$nickname = searchPreviousNickname($enable_only_authorized_username, $enable_nickname_remembering, $chat_database, $address, $total_messages);

	$message = $_POST["message"];

	if ($enable_experimental_remote_client_post_mode == "false")

	{

		if ($time != "" && $time != null && $nickname != "" && $nickname != null && $message != "" && $message != null && $address != "" && $address != null)

		{

			$chat_database[$total_messages][time] = base64_encode($time);

			$chat_database[$total_messages][nickname] = base64_encode($nickname);

			$chat_database[$total_messages][message] = base64_encode($message);

			$chat_database[$total_messages][address] = base64_encode($address);

		};

		file_put_contents($databases_messages_path, base64_encode(json_encode($chat_database, JSON_PRETTY_PRINT)));

	}

	else

	{

		sendRemotePostMessage($remote_post_url, $nickname, $message);

	};

	include("../templates/post.html");

?>