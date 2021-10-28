"use strict";

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

		if (insert.key == "Enter")

		{

			document.getElementById("submitMessage").focus();

			document.getElementById("formContainer").submit();

		};

	};

	document.getElementById("inputMessage").focus();

	document.getElementById("inputMessage").addEventListener("keydown", insertHook);

	document.getElementById("inputMessage").addEventListener("keypress", submitOnEnter);

};

main();