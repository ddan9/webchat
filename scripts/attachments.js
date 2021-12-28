"use strict";

function uploadFile(input) 

{

	var validationRegexp = /<xmp>|<\/xmp>/gi;

	var validationReplacement = "<rofl>";

	var inputFilesCount = input.files.length;

	if (inputFilesCount > 1)

	{

		var inputFileName = "Selected " + inputFilesCount + " files";

	}

	else

	{

		var inputFileName = input.files[0].name;

	};

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