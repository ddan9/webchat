"use strict";

function send()

{

	"use strict";

	var nickname = document.getElementById("inputNickname").value;

	var message = document.getElementById("inputMessage").value;

	var nicknameEncoded = window.btoa(unescape(encodeURIComponent(nickname)));

	var messageEncoded = window.btoa(unescape(encodeURIComponent(message)));

	var postMessageRequest = new XMLHttpRequest();

	postMessageRequest.open("POST", "../functions/post.php", false);

	postMessageRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	if (nickname != "" && nickname != null && message != "" && message != null)

	{

		postMessageRequest.send(`nickname=${nicknameEncoded}&message=${messageEncoded}`);

		document.getElementById("inputMessage").value = "";

		document.getElementById("inputMessage").focus();

	}

	else

	{

		if (message != "" && message != null)

		{

			document.getElementById("inputMessage").style.animationName="none"

		}

		else

		{

			document.getElementById("inputMessage").focus();

			document.getElementById("inputMessage").style.animationName="warning";

		};

		if (nickname != "" && nickname != null)

		{

			document.getElementById("inputNickname").style.animationName="none";

		}

		else

		{

			document.getElementById("inputNickname").style.animationName="warning";

		};

		alert("You need to fill all forms firstly!");

	};

};

function main()

{

	"use strict";

	function insertHook(insert)

	{

		if (insert.key == "Tab")

		{

			insert.preventDefault();

			var start = this.selectionStart;

			var end = this.selectionEnd;

			this.value = this.value.substring(0, start) + "\t" + this.value.substring(end);

			this.selectionStart = this.selectionEnd = start + 1;

		};

		if (insert.shiftKey && insert.key == "Enter")

		{

			insert.preventDefault();

			var start = this.selectionStart;

			var end = this.selectionEnd;

			this.value = this.value.substring(0, start) + "\n" + this.value.substring(end);

			this.selectionStart = this.selectionEnd = start + 1;

		};

	};

	function submitOnEnter(insert)

	{

		if (insert.key == "Enter" && !insert.shiftKey)

		{

			insert.preventDefault();

			document.getElementById("submitMessage").click();

		};

	};

	function nullMessageWarningStop()

	{

		if (document.getElementById("inputMessage").value != "" || document.getElementById("inputMessage").value != null)

		{

			document.getElementById("inputMessage").style.animationName="none";

		};

	};

	function nullNicknameWarning()

	{

		if (document.getElementById("inputNickname").value == "" || document.getElementById("inputNickname").value == null)

		{

			document.getElementById("inputNickname").style.animationName="warning";

		};

	};

	function nullNicknameWarningStop()

	{

		if (document.getElementById("inputNickname").value != "" || document.getElementById("inputNickname").value != null)

		{

			document.getElementById("inputNickname").style.animationName="none";

		};

	};

	document.getElementById("inputMessage").focus();

	document.getElementById("inputMessage").addEventListener("keydown", insertHook);

	document.getElementById("inputMessage").addEventListener("keypress", submitOnEnter);

	document.getElementById("inputMessage").addEventListener("keypress", nullMessageWarningStop);

	document.getElementById("inputMessage").addEventListener("keypress", nullNicknameWarning);

	document.getElementById("inputNickname").addEventListener("keypress", nullNicknameWarningStop);

};

main();
