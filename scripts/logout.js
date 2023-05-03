"use strict";

var username = "logout";

var password = "logout";

var protocol = location.protocol;

var currentURL = location.href.replace(`${protocol}//`, "");

var replacedURL = currentURL.replace("/logout", "/main");

var logoutRequest = new XMLHttpRequest();

logoutRequest.open('GET', '../main/', false);

logoutRequest.setRequestHeader('Authorization', 'Basic ' + btoa(username + ':' + password));

logoutRequest.onload = function()

{

	if (logoutRequest.status === 200)

	{

		window.open(`${protocol}//${username}:${password}@${replacedURL}`, '_top');

	}

	else

	{

		alert("Something went wrong!");

	};

};

logoutRequest.send();
