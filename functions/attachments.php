<?php

	function readableBytes($bytes)

	{

		$i = floor(log($bytes) / log(1024));

		$sizes = array("B", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB");

		return sprintf("%.02F", $bytes / pow(1024, $i)) * 1 . " " . $sizes[$i];

	};

	include("../functions/presets.php");

	$chat_database_files = json_decode(base64_decode(file_get_contents($databases_files_path), true), true);

	$total_files = count($chat_database_files);

	$upload_max_filesize = ini_get("upload_max_filesize")*1048576;

	$readable_max_file_size = ini_get("upload_max_filesize");

	include("../templates/attachments.html");

	for ($i = $total_files-1; $i >= 0; $i--)

	{

		$decoded_date = base64_decode($chat_database_files[$i][time]);

		$decoded_name = base64_decode($chat_database_files[$i][filename]);

		$decoded_filesize = base64_decode($chat_database_files[$i][filesize]);

		$decoded_filetype = base64_decode($chat_database_files[$i][filetype]);

		$decoded_address = base64_decode($chat_database_files[$i][address]);

		$validated_date = preg_replace("/<xmp>|<\/xmp>/i", "<rofl>", $decoded_date);

		$validated_name = preg_replace("/<xmp>|<\/xmp>/i", "<rofl>", $decoded_name);

		$validated_filesize = preg_replace("/<xmp>|<\/xmp>/i", "<rofl>", $decoded_filesize);

		$validated_filetype = preg_replace("/<xmp>|<\/xmp>/i", "<rofl>", $decoded_filetype);

		$validated_address = preg_replace("/<xmp>|<\/xmp>/i", "<rofl>", $decoded_address);

		if ($validated_date != "" && $validated_date != null && $validated_name != "" && $validated_name != null && $validated_filesize != "" && $validated_filesize != null && $validated_filetype != "" && $validated_filetype != null && $validated_address != "" && $validated_address != null)

		{

			$date = "<strong> Added: </strong>" . "<br>" . $validated_date;

			$header = "<strong>" . "<xmp>" . $validated_name . "</xmp>" . "</strong>";

			$theme = "<strong> Filesize: </strong>" . readableBytes($validated_filesize) . " <br> " . " <strong> Filetype: </strong>" . $validated_filetype;

			$view = "../functions/view.php?id=$i";

			$link = "../functions/download.php?id=$i";

			include("../templates/attachments_list.html");

		};

	};

?>
