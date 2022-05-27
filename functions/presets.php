<?php

	$charset_http = "UTF-8";

	$charset_header = "utf-8";

	$style = "default";

	$favicon = "favicon.svg";

	$favicon_type = "image/svg";

	$html_post_autocomplete = "off";

	$use_clear_address = "false";

	$hashing_algorithm = "md5";

	$time_messages_format = "H:i:s";

	$date_messages_format = "d.m.Y";

	$time_files_format = "H:i:s";

	$time_files_format_short = "H:i";

	$date_files_format = "d.m.Y";

	$date_files_format_short = "D M";

	$validationRegexp = "/<xmp>|<\/xmp>/i";

	$validationReplacement = "<rofl>";

	$enable_nickname_remembering = "false";

	$enable_only_authorized_username = "false";

	$databases_files_path = "../databases/files.json";

	$databases_messages_path = "../databases/messages.json";

	$audio_notify_path = "../sounds/notify.mp3";

	$enable_experimental_remote_client_post_mode = "false";

	$remote_post_url = "http://127.0.0.1/webchat/functions/post.php";

	$cache_control_header = "no-cache, must-revalidate";

	$cache_control_http = "no-cache";

	$cache_control_download = "must-revalidate";

	$expires = "0";

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

		$address = hash($hashing_algorithm, $_SERVER["REMOTE_ADDR"]);

	};

?>