<?php

	$charset_http = "UTF-8";

	$charset_header = "utf-8";

	$style = "default";

	$favicon = "favicon.svg";

	$favicon_type = "image/svg";

	$use_clear_address = "false";

	$enable_nickname_remembering = "false";

	$databases_files_path = "../databases/files.json";

	$databases_messages_path = "../databases/messages.json";

	$cache_control_header = "no-cache, must-revalidate";

	$cache_control_http = "no-cache";

	$cache_control_download = "must-revalidate";

	$pragma = "public";

	$content_transfer_encoding = "binary";

	error_reporting(0);

	header("Cache-Control: $cache_control_header");

	header("Content-type: text/html; charset=$charset_header");

	if(preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]))

	{

		$device = "mobile";

	}

	else

	{

		$device = "desktop";

	};

	if ($use_clear_address == "true")

	{

		$address = $_SERVER["REMOTE_ADDR"];

	}

	else

	{

		$address = hash("md5", $_SERVER["REMOTE_ADDR"]);

	};

?>