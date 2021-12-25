<?php

	include("../functions/presets.php");

	header("Cache-Control: no-store, no-cache, must-revalidate");

	$TYPE = $_GET["type"];

	switch ($TYPE)

	{

		case "messages":

			echo file_get_contents($databases_messages_path);

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