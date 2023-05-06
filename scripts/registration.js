"use strict";

function send()

{

	var registrationForm = document.forms.registrationForm;

	var username = document.getElementById("login").value;

	var password = document.getElementById("password").value;

	var passwordProove = document.getElementById("passwordProove").value;

	if (username != null && username != "" && password != null && password != "" && passwordProove != null && passwordProove != "")

	{

		if (username != "logout")

		{

			if (password != passwordProove)

			{

				document.getElementById("password").style.animationName="warning";

				document.getElementById("passwordProove").style.animationName="warning";

				alert("Passwords are not the same!");

			}

			else

			{

				registrationForm.submit();

			};

		}

		else

		{

			document.getElementById("login").style.animationName="warning";

			alert("You can't register that user!");

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

		if (passwordProove != "" && passwordProove != null)

		{

			document.getElementById("passwordProove").style.animationName="none";

		}

		else

		{

			document.getElementById("passwordProove").style.animationName="warning";

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

	function emptyPasswordProoveWarningStop()

	{

		if (document.getElementById("passwordProove").value != "" || document.getElementById("passwordProove").value != null)

		{

			document.getElementById("passwordProove").style.animationName="none";

		};

	};

	document.getElementById("login").addEventListener("keydown", emptyLoginWarningStop);

	document.getElementById("password").addEventListener("keypress", emptyPasswordWarningStop);

	document.getElementById("passwordProove").addEventListener("keypress", emptyPasswordProoveWarningStop);

};

main();
