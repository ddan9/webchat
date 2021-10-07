<?php

	function readableBytes($bytes)

	{

		$i = floor(log($bytes) / log(1024));

		$sizes = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');

		return sprintf('%.02F', $bytes / pow(1024, $i)) * 1 . ' ' . $sizes[$i];

	};

	include("../functions/presets.php");

	$chat_database_files = json_decode(file_get_contents("../databases/files.json"), true);

	$total_files = count($chat_database_files);

	include("../templates/attachments.html");

	for ($i = $total_files-1; $i >= 0; $i--)

	{

		$validated_name = preg_replace("/<xmp>|<\/xmp>/i", "<rofl>", $chat_database_files[$i][filename]);

		$date = "<br>" . "Added: " . "<br>" . $chat_database_files[$i][time];

		$header = "<xmp>" . $validated_name . "</xmp>";

		$theme = "<strong> Filesize: </strong>" . readableBytes($chat_database_files[$i][filesize]) . " <br> " . " <strong> Filetype: </strong>" . $chat_database_files[$i][filetype];

		$link = "../functions/download.php?id=$i";

		include("../templates/attachments_list.html");

	};

?>