<?php

	require_once("../functions/presets.php");

	function throwMessage($throw_code, $throw_message, $json_output, $check_output)

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

				header("refresh:3; url=../login/");

				exit();

			};

		}

		else

		{

			if ($throw_code != 200)

			{

				require_once("../templates/throw.html");

				header("refresh:3; url=../login/");

				exit();

			};

		};

	};

	if ($use_php_basic_authentication == "true")

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

		if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']))

		{

			header('WWW-Authenticate: Basic realm="Webchat Restricted Area"');

			header('${protocol} 401 Unauthorized');

			$throw_code = 401;

			$throw_message = "You need to be authorized!";

			throwMessage($throw_code, $throw_message, $json_output, $check_output);

		}

		else

		{

			$login = $_SERVER['PHP_AUTH_USER'];

			$password = $_SERVER['PHP_AUTH_PW'];

			$json_output = $_GET['json_output'];

			$check_output = $_GET['check_output'];

			$founded_users_count = 0;

			if ($login != null && $login != "" && $password != null && $password != "")

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

							$founded_user_id = $i;

							break;

						};

					};

					if ($founded_users_count == 0 || !isset($founded_user_id))

					{

						$throw_code = 401;

						$throw_message = "This user doesn't exists!";

						throwMessage($throw_code, $throw_message, $json_output, $check_output);

					}

					else

					{

						$hashed_password_input = hash($user_password_hashing_algorithm, $salt_global.$password.$salt_password);

						$hashed_password_etalon = base64_decode($users_database[$founded_user_id][password]);

						if ($hashed_password_input != $hashed_password_etalon)

						{

							$throw_code = 401;

							$throw_message = "Wrong password!";

							throwMessage($throw_code, $throw_message, $json_output, $check_output);

						}

						else

						{

							$throw_code = 200;

							$throw_message = "Successful login!";

							throwMessage($throw_code, $throw_message, $json_output, $check_output);

						};

					};

				}

				else

				{

					$throw_code = 401;

					$throw_message = "Logging out!";

					throwMessage($throw_code, $throw_message, $json_output, $check_output);

				};

			}

			else

			{

				$throw_code = 401;

				$throw_message = "Fill all forms!";

				throwMessage($throw_code, $throw_message, $json_output, $check_output);

			};

		};

	};

?>
