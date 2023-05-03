<?php

	require_once("../functions/presets.php");

	if ($use_login_permanent_redirection == "true")

	{

		if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']))

		{

			header("Location: ../login/");

			exit();

		}

		else

		{

			header("Location: ../main/");

			exit();

		};

	}

	else

	{

		header("Location: ../main/");

		exit();

	};

?>
