<?php

	include("../functions/presets.php");

	$GETFILEID = $_GET["id"];

	$chat_database_files = json_decode(base64_decode(file_get_contents("../databases/files.json"), true), true);

	$filebody = base64_decode($chat_database_files[$GETFILEID][filebody]);

	$filesize = base64_decode($chat_database_files[$GETFILEID][filesize]);

	$filename = base64_decode($chat_database_files[$GETFILEID][filename]);

	header("Content-Description: File Transfer");

	header("Content-Type: application/octet-stream");

	header("Content-Disposition: attachment; filename=$filename");

	header("Expires: 0");

	header("Cache-Control: must-revalidate");

	header("Pragma: public");

	header("Content-Length: $filesize");

	readfile($filebody);

	exit;

	header("Location: ../attachments/");

?>