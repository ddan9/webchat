"use strict";

function send()

{

	var username = document.getElementById("login").value;

	var password = document.getElementById("password").value;

	var protocol = location.protocol;

	var currentURL = location.href.replace(`${protocol}//`, "");

	var replacedURL = currentURL.replace("/login", "/main");

	var loginRequestResponseCode;

	var loginRequestResponseMessage;

	var loginRequest = new XMLHttpRequest();

	loginRequest.open("GET", "../functions/authentication.php?json_output=true&check_output=true", false);

	loginRequest.setRequestHeader("Authorization", "Basic " + btoa(username + ":" + password));

	loginRequest.onload = function()

	{

		if (loginRequest.status === 200)

		{

			loginRequestResponseCode = JSON.parse(loginRequest.response).response.error;

			loginRequestResponseMessage = JSON.parse(loginRequest.response).response.message;

			if (loginRequestResponseCode != 401)

			{

				window.open(`${protocol}//${username}:${password}@${replacedURL}`, "_top");

			}

			else

			{

				alert(loginRequestResponseMessage);

			};

		}

		else

		{

			alert(loginRequestResponseMessage);

		};

	};

	if (username != null && username != "" && password != null && password != "")

	{

		if (username != "logout")

		{

			loginRequest.send();

		}

		else

		{

			document.getElementById("login").style.animationName="warning";

			alert("If you want to force logout, clean authentication cache below!");

		};

	}

	else

	{

		if (username != "" && username != null)

		{

			document.getElementById("login").style.animationName="none"

		}

		else

		{

			document.getElementById("login").style.animationName="warning";

		};

		if (password != "" && password != null)

		{

			document.getElementById("password").style.animationName="none";

		}

		else

		{

			document.getElementById("password").style.animationName="warning";

		};

		alert("Fill all forms!");

	};

};

function main()

{

	function emptyLoginWarningStop()

	{

		if (document.getElementById("login").value != "" || document.getElementById("login").value != null)

		{

			document.getElementById("login").style.animationName="none";

		};

	};

	function emptyPasswordWarningStop()

	{

		if (document.getElementById("password").value != "" || document.getElementById("password").value != null)

		{

			document.getElementById("password").style.animationName="none";

		};

	};

	document.getElementById("login").addEventListener("keydown", emptyLoginWarningStop);

	document.getElementById("password").addEventListener("keypress", emptyPasswordWarningStop);

};

main();
