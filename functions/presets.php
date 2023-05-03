<?php

	$version = "20230503";

	$charset_http = "UTF-8";

	$charset_header = "utf-8";

	$language_http = "en-US";

	$language_header = "en-US";

	$style = "default";

	$favicon = "favicon.svg";

	$favicon_type = "image/svg";

	$html_post_autocomplete = "off";

	$use_clear_address = "false";

	$use_databases_encryption = "true";

	$encryption_cipher = "AES256";

	$encryption_options = OPENSSL_RAW_DATA;

	$encryption_iv = 1024102410241024;

	$hashing_algorithm = "md5";

	$user_password_hashing_algorithm = "sha512";

	$databases_password = "default";

	$salt_global = "default";

	$salt_address = "default";

	$salt_messages = "default";

	$salt_files = "default";

	$salt_users = "default";

	$salt_password = "default";

	$enable_fullscreen_button = "true";

	$enable_help_button = "true";

	$recieve_client_password = "true";

	$client_password_to_send_database = "default";

	$custom_time_set = "+0 hour +0 minutes +0 seconds";

	$custom_date_set = "+0 year +0 months +0 days";

	$time_messages_format = "H:i:s";

	$date_messages_format = "d.m.Y";

	$time_files_format = "H:i:s";

	$time_files_format_short = "H:i";

	$date_files_format = "d.m.Y";

	$date_files_format_short = "D M";

	$validationRegexp = "/<xmp>|<\/xmp>/i";

	$validationReplacement = "<rofl>";

	$use_user_connection_message_sending = "true";

	$use_user_connection_cooldown = "true";

	$user_connection_cooldown = "+0 hour +10 minutes +0 seconds";

	$use_user_connection_login_message_sending = "true";

	$enable_nickname_remembering = "true";

	$enable_only_authorized_username = "true";

	$use_php_basic_authentication = "true";

	$use_login_permanent_redirection = "true";

	$allow_new_users = "true";

	$allowed_new_users_count_limit = 2;

	$databases_files_path = "../databases/files.json";

	$databases_messages_path = "../databases/messages.json";

	$databases_users_path = "../databases/users.json";

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

	header("Content-Language: $language_header");

	header('Window-target: _top');

	if(preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]))

	{

		$device = "mobile";

	}

	else

	{

		$device = "desktop";

	};

	if ($use_clear_address != "true")

	{

		if (isset($_SERVER["PHP_AUTH_USER"]) && ($use_php_basic_authentication == "true" || $enable_only_authorized_username == "true"))

		{

			$address = hash($hashing_algorithm, $salt_global.$_SERVER["PHP_AUTH_USER"].$salt_address);

		}

		else

		{

			$address = hash($hashing_algorithm, $salt_global.$_SERVER["REMOTE_ADDR"].$salt_address.$device.$_SERVER['HTTP_USER_AGENT']);

		};

	}

	else

	{

		$address = $_SERVER["REMOTE_ADDR"];

	};

?>
