<?php

	function searchPreviousNickname($enable_nickname_remembering, $chat_database, $address, $total_messages)

	{

		if ($enable_nickname_remembering == 1)

		{

			if ($_POST["nickname"] != "" || $_POST["nickname"] != null)

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

		return $nickname;

	};

	include("../functions/presets.php");

	$GUESS_WHO = $_GET["guess_who"];

	if ($GUESS_WHO == "1")

	{

		echo $address;

	}

	else

	{

		$chat_database = json_decode(base64_decode(file_get_contents($databases_messages_path), true), true);

		$total_messages = count($chat_database);

		$time = date("H:i:s");

		$nickname = searchPreviousNickname($enable_nickname_remembering, $chat_database, $address, $total_messages);

		$message = $_POST["message"];

		if ($time != "" && $time != null && $nickname != "" && $nickname != null && $message != "" && $message != null && $address != "" && $address != null)

		{

			$chat_database[$total_messages][time] = base64_encode($time);

			$chat_database[$total_messages][nickname] = base64_encode($nickname);

			$chat_database[$total_messages][message] = base64_encode($message);

			$chat_database[$total_messages][address] = base64_encode($address);

		};

		file_put_contents($databases_messages_path, base64_encode(json_encode($chat_database, JSON_PRETTY_PRINT)));

		include("../templates/post.html");

	};

?>