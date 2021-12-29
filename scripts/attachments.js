"use strict";

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

				inputFileName += input.files[i].name + " ";

			};

		};

	};

	var useSimpleShow = "true";

	var validationRegexp = /<xmp>|<\/xmp>/gi;

	var validationReplacement = "<rofl>";

	var inputFilesCount = input.files.length;

	var i, inputFileName;

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