<?php

	require_once("../functions/presets.php");

	function SendNotifyMessage($use_databases_encryption, $databases_messages_path, $custom_time_set, $time_messages_format, $custom_date_set, $date_messages_format, $login, $encryption_cipher, $salt_global, $databases_password, $salt_messages, $encryption_options, $encryption_iv)

	{

		if ($use_databases_encryption != "true")

		{

			$chat_database = json_decode(base64_decode(file_get_contents($databases_messages_path), true), true);

		}

		else

		{

			$chat_database = json_decode(base64_decode(openssl_decrypt(file_get_contents($databases_messages_path), $encryption_cipher, $salt_global.$databases_password.$salt_messages, $encryption_options, $encryption_iv), true), true);

		};

		$total_messages = count($chat_database);

		$time = date($time_messages_format, strtotime($custom_time_set));

		$date = date($date_messages_format, strtotime($custom_date_set));

		$device = "Server";

		$nickname = "System";

		$message = "User $login added!";

		$address = "Notify";

		$chat_database[$total_messages][time] = base64_encode($time);

		$chat_database[$total_messages][date] = base64_encode($date);

		$chat_database[$total_messages][device] = base64_encode($device);

		$chat_database[$total_messages][nickname] = base64_encode($nickname);

		$chat_database[$total_messages][message] = base64_encode($message);

		$chat_database[$total_messages][address] = base64_encode($address);

		if ($use_databases_encryption != "true")

		{

			file_put_contents($databases_messages_path, base64_encode(json_encode($chat_database, JSON_PRETTY_PRINT)));

		}

		else

		{

			file_put_contents($databases_messages_path, openssl_encrypt(base64_encode(json_encode($chat_database, JSON_PRETTY_PRINT)), $encryption_cipher, $salt_global.$databases_password.$salt_messages, $encryption_options, $encryption_iv));

		};

	};

	function throwMessage($throw_code, $throw_message, $json_output, $check_output, $dry_run)

	{

		require("../functions/presets.php");

		if ($check_output == true)

		{

			if ($json_output == true)

			{

				$throw_json_message["response"]["error"] = $throw_code;

				$throw_json_message["response"]["message"] = $throw_message;

				$throw_json_message_encoded = json_encode($throw_json_message, JSON_PRETTY_PRINT);

				print($throw_json_message_encoded);

				exit();

			}

			else

			{

				require_once("../templates/throw.html");

				header("refresh:3; url=../registration/");

				exit();

			};

		}

		else

		{

			if ($throw_code != 200)

			{

				require_once("../templates/throw.html");

				header("refresh:3; url=../registration/");

				exit();

			}

			else

			{

				require_once("../templates/throw.html");

				header("refresh:3; url=../login/");

			};

		};

	};

	function allowedUsersLimitStatement($allowed_new_users_count_limit, $total_users)

	{

		if ($allowed_new_users_count_limit != null && $allowed_new_users_count_limit != "" && $allowed_new_users_count_limit != "null" && $allowed_new_users_count_limit >= 1)

		{

			if ($total_users <= $allowed_new_users_count_limit)

			{

				return "true";

			}

			else

			{

				return "false";

			};

		}

		else

		{

			return "true";

		};

	};

	if ($use_php_basic_authentication != "true")

	{

		exit();

	}

	else

	{

		if ($use_databases_encryption != "true")

		{

			$users_database = json_decode(base64_decode(file_get_contents($databases_users_path), true), true);

		}

		else

		{

			$users_database = json_decode(base64_decode(openssl_decrypt(file_get_contents($databases_users_path), $encryption_cipher, $salt_global.$databases_password.$salt_users, $encryption_options, $encryption_iv), true), true);

		};

		$total_users = count($users_database);

		$json_output = $_GET["json_output"];

		$check_output = $_GET["check_output"];

		$dry_run = $_GET["dry_run"];

		$login = $_POST["login"];

		$password_original = $_POST["password"];

		$password_proove = $_POST["password_proove"];

		$allowed_users_limit_state = allowedUsersLimitStatement($allowed_new_users_count_limit, $total_users);

		if ($allow_new_users != "true" || $allowed_users_limit_state != "true")

		{

			$throw_code = 401;

			$throw_message = "New users not allowed to register!";

			throwMessage($throw_code, $throw_message, $json_output, $check_output, $dry_run);

		}

		else

		{

			$founded_users_count = 0;

			if ($login != null && $login != "" && $password_original != null && $password_original != "" && $password_proove != null && $password_proove != "")

			{

				if ($login != "logout")

				{

					for ($i = 0; $i < $total_users; $i++)

					{

						$decoded_login = base64_decode($users_database[$i][login]);

						if ($decoded_login != $login)

						{

							continue;

						}

						else

						{

							$founded_users_count++;

							break;

						};

					};

					if ($founded_users_count != 0)

					{

						$throw_code = 401;

						$throw_message = "This user is already exists!";

						throwMessage($throw_code, $throw_message, $json_output, $check_output, $dry_run);

					}

					else

					{

						if ($password_original != $password_proove)

						{

							$throw_code = 401;

							$throw_message = "Passwords are not the same!";

							throwMessage($throw_code, $throw_message, $json_output, $check_output, $dry_run);

						}

						else

						{

							$password = $password_original;

							$users_database[$total_users][login] = base64_encode($login);

							$users_database[$total_users][password] = base64_encode(hash($user_password_hashing_algorithm, $salt_global.$password.$salt_password));

							$throw_code = 200;

							$throw_message = "Successful registered!";

							throwMessage($throw_code, $throw_message, $json_output, $check_output, $dry_run);

							SendNotifyMessage($use_databases_encryption, $databases_messages_path, $custom_time_set, $time_messages_format, $custom_date_set, $date_messages_format, $login, $encryption_cipher, $salt_global, $databases_password, $salt_messages, $encryption_options, $encryption_iv);

							if ($use_databases_encryption != "true")

							{

								file_put_contents($databases_users_path, base64_encode(json_encode($users_database, JSON_PRETTY_PRINT)));

							}

							else

							{

								file_put_contents($databases_users_path, openssl_encrypt(base64_encode(json_encode($users_database, JSON_PRETTY_PRINT)), $encryption_cipher, $salt_global.$databases_password.$salt_users, $encryption_options, $encryption_iv));

							};

						};

					};

				}

				else

				{

					$throw_code = 401;

					$throw_message = "You can't register this user!";

					throwMessage($throw_code, $throw_message, $json_output, $check_output, $dry_run);

				};

			}

			else

			{

				$throw_code = 401;

				$throw_message = "Fill all forms!";

				throwMessage($throw_code, $throw_message, $json_output, $check_output, $dry_run);

			};

		};

	};

?>
