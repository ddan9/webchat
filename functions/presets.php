<?php

	header("Cache-Control: no-cache, must-revalidate");

	header("Content-type: text/html; charset=utf-8");

	error_reporting(0);

	$style = "default";

	function isMobile() 

	{

		return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);

	};

	if(isMobile())

	{

		$device = "mobile";

	}

	else

	{

		$device = "desktop";

	};

?>