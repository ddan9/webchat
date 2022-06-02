<?php

	include("../functions/presets.php");

	$GETFILEID = $_GET["id"];

	if ($use_databases_encryption != "true")

	{

		$chat_database_files = json_decode(base64_decode(file_get_contents($databases_files_path), true), true);

	}

	else

	{

		$chat_database_files = json_decode(base64_decode(openssl_decrypt(file_get_contents($databases_files_path), $encryption_cipher, $salt_global.$databases_password.$salt_files, $encryption_options, $encryption_iv), true), true);

	};

	$filebody = base64_decode($chat_database_files[$GETFILEID][filebody]);

	$filesize = base64_decode($chat_database_files[$GETFILEID][filesize]);

	$filename = base64_decode($chat_database_files[$GETFILEID][filename]);

	header("Content-Description: File Transfer");

	header("Content-Type: application/octet-stream");

	header("Content-Disposition: attachment; filename=$filename");

	header("Expires: $expires");

	header("Cache-Control: $cache_control_download");

	header("Pragma: $pragma");

	header("Content-Length: $filesize");

	header("Content-Transfer-Encoding: $content_transfer_encoding");

	readfile($filebody);

	exit;

	header("Location: ../attachments/");

?>