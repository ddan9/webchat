<?php

	$charset = "UTF-8";

	$style = "default";

	$favicon = "favicon.svg";

	$favicon_type = "image/svg";

	$use_clear_address = 0;

	$enable_nickname_remembering = 0;

	$databases_files_path = "../databases/files.json";

	$databases_messages_path = "../databases/messages.json";

	$cache_control = "must-revalidate";

	$pragma = "public";

	$content_transfer_encoding = "binary";

	error_reporting(0);

	header("Cache-Control: no-cache, must-revalidate");

	header("Content-type: text/html; charset=utf-8");

	if(preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]))

	{

		$device = "mobile";

	}

	else

	{

		$device = "desktop";

	};

	if ($use_clear_address == 1)

	{

		$address = $_SERVER["REMOTE_ADDR"];

	}

	else

	{

		$address = hash("md5", $_SERVER["REMOTE_ADDR"]);

	};

?>