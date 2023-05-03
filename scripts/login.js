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

	loginRequest.open('GET', '../functions/authentication.php?json_output=true&check_output=true', false);

	loginRequest.setRequestHeader('Authorization', 'Basic ' + btoa(username + ':' + password));

	loginRequest.onload = function()

	{

		if (loginRequest.status === 200)

		{

			loginRequestResponseCode = JSON.parse(loginRequest.response).response.error;

			loginRequestResponseMessage = JSON.parse(loginRequest.response).response.message;

			if (loginRequestResponseCode != 401)

			{

				window.open(`${protocol}//${username}:${password}@${replacedURL}`, '_top');

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

	loginRequest.send();

};
