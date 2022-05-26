<?php

	function readableBytes($bytes)

	{

		$i = floor(log($bytes) / log(1024));

		$sizes = array("B", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB");

		return sprintf("%.02F", $bytes / pow(1024, $i)) * 1 . " " . $sizes[$i];

	};

	function view_text_file($filebody)

	{

		echo "<plaintext class='view'>" . file_get_contents($filebody);

	};

	function view_image_file($filebody)

	{

		echo "<a href='$filebody' class='view' target='_blank' title='Turn on fullscreen'> <img class='view' src='$filebody'></img> </a>";

	};

	function view_audio_file($filebody)

	{

		echo "<audio class='view' controls preload src='$filebody'></audio>";

	};

	function view_video_file($filebody)

	{

		echo "<video class='view' controls preload src='$filebody'></video>";

	};

	function view_default_file($filetype, $filebody)

	{

		echo "<embed class='view' type='$filetype' src='$filebody'></embed>";

	};

	include("../functions/presets.php");

	$GETFILEID = $_GET["id"];

	$chat_database_files = json_decode(base64_decode(file_get_contents($databases_files_path), true), true);

	$filename = base64_decode($chat_database_files[$GETFILEID][filename]);

	$filetype = base64_decode($chat_database_files[$GETFILEID][filetype]);

	$filesize = base64_decode($chat_database_files[$GETFILEID][filesize]);

	$filebody = base64_decode($chat_database_files[$GETFILEID][filebody]);

	$date = base64_decode($chat_database_files[$GETFILEID][time]);

	$filetype_parent = explode("/", $filetype)[0];

	$filesize_readable = readableBytes($filesize);

	include("../templates/view.html");

	switch ($filetype_parent)

	{

		case "text":

			view_text_file($filebody);

			break;

		case "image":

			view_image_file($filebody);

			break;

		case "audio":
		case "music":

			view_audio_file($filebody);

			break;

		case "video":

			view_video_file($filebody);

			break;

		default:

			view_default_file($filetype, $filebody);

			break;

	};

?>