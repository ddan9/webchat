"use strict";

function send()

{

	"use strict";

	function checkForMaxFileSize()

	{

		for (i = 0; i < inputFilesCount; i++)

		{

			filename = input.files[i].name;

			if (input.files[i].size > maxFileSize)

			{

				rejectedFilesCount++;

				alert(`File ${filename} is too big!`);

			};

		};

	};

	var i, filename;

	var uploadFileForm = document.forms.uploadFileForm;

	var chooseFileButton = document.getElementById("chooseFileButton");

	var uploadFilesCount = chooseFileButton.files.length;

	var maxFileSize = document.getElementById("maxFileSizeValue").value;

	var input = chooseFileButton;

	var inputFilesCount = uploadFilesCount;

	var rejectedFilesCount = 0;

	if (inputFilesCount > 0)

	{

		checkForMaxFileSize();

		if (rejectedFilesCount < 1)

		{

			uploadFileForm.submit();

		};

	}

	else

	{

		alert("There is nothing to upload!");

	};

};

function uploadFile(input)

{

	"use strict";

	function showSelectedFiles()

	{

		if (useSimpleShow == "true")

		{

			if (inputFilesCount > 1)

			{

				inputFileName = "Selected " + inputFilesCount + " files";

			}

			else

			{

				inputFileName = input.files[0].name;

			};

		}

		else

		{

			inputFileName = "";

			for (i = 0; i < inputFilesCount; i++)

			{

				inputFileName += input.files[i].name + " | ";

			};

		};

	};

	function checkForMaxFileSize()

	{

		document.getElementById("maxFileSize").style.animationName="none";

		for (i = 0; i < inputFilesCount; i++)

		{

			if (input.files[i].size > maxFileSize)

			{

				document.getElementById("maxFileSize").style.animationName="maxFileSizeExceeded";

			};

		};

	};

	var useSimpleShow = "true";

	var validationRegexp = /<xmp>|<\/xmp>/gi;

	var validationReplacement = "<rofl>";

	var inputFilesCount = input.files.length;

	var i, inputFileName;

	var maxFileSize = document.getElementById("maxFileSizeValue").value;

	checkForMaxFileSize();

	showSelectedFiles();

	var validatedFileName = inputFileName.replace(validationRegexp, validationReplacement);

	document.getElementById("chooseFileButtonLabel").innerHTML = validatedFileName;

};

function scrollTopPermanent()

{

	window.scrollTo({top: 0, behavior: "smooth"});

};

function main()

{

	"use strict";

	let heightThreshold = 500;

	let buttonToTop = document.getElementById("buttonToTop");

	let totalHeight, limitHeight, currentHeight;

	function getHeightMetrics()

	{

		totalHeight = 0;

		limitHeight = totalHeight + heightThreshold;

		currentHeight = window.scrollY;

	};

	function onScrollFunctions()

	{

		getHeightMetrics();

		if (currentHeight > limitHeight)

		{

			buttonToTop.style.display = "block";

		}

		else

		{

			buttonToTop.style.display = "none";

		};

	};

	document.addEventListener("scroll", onScrollFunctions);

};

main();
