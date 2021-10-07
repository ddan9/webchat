<?php

	include("../functions/presets.php");

	$GUESS_WHO = $_GET["guess_who"];

	$use_clear_address = 0;

	if ($GUESS_WHO == "1")

	{

		if ($use_clear_address == 1)

		{

			$address = $_SERVER["REMOTE_ADDR"];

		}

		else

		{

			$address = hash("md5", $_SERVER["REMOTE_ADDR"]);

		};

		echo $address;

	}

	else

	{

		$chat_database = json_decode(base64_decode(file_get_contents("../databases/messages.json"), true));

		$total_messages = count($chat_database);

		$time = date("H:i:s");

		$nickname = $_POST["nickname"];

		$message = $_POST["message"];

		if ($use_clear_address == 1)

		{

			$address = $_SERVER["REMOTE_ADDR"];

		}

		else

		{

			$address = hash("md5", $_SERVER["REMOTE_ADDR"]);

		};

		if ($time != "" && $time != null && $nickname != "" && $nickname != null && $message != "" && $message != null && $address != "" && $address != null)

		{

			$chat_database[$total_messages][time] = base64_encode($time);

			$chat_database[$total_messages][nickname] = base64_encode($nickname);

			$chat_database[$total_messages][message] = base64_encode($message);

			$chat_database[$total_messages][address] = base64_encode($address);

		};

		file_put_contents("../databases/messages.json", base64_encode(json_encode($chat_database, JSON_PRETTY_PRINT)));

		include("../templates/post.html");

	};

?>