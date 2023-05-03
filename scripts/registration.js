"use strict";

function send()

{

	var registrationForm = document.forms.registrationForm;

	var username = document.getElementById("login").value;

	var password = document.getElementById("password").value;

	var password_proove = document.getElementById("passwordProove").value;

	if (username != null && username != "" && password != null && password != "" && password_proove != null && password_proove != "")

	{

		if (username != "logout")

		{

			if (password != password_proove)

			{

				alert("Passwords are not the same!");

			}

			else

			{

				registrationForm.submit();

			};

		}

		else

		{

			alert("You can't register this user!");

		};

	}

	else

	{

		alert("Fill all forms!");

	};

};
