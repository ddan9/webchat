"use strict";

function scrollDownPermanent()

{

	window.scrollTo({top: document.body.scrollHeight, behavior: "smooth"});

};

function main()

{

	"use strict";

	let i, myIPaddress, messageClass;

	let promise, decodedPromise, data;

	let totalHeight, limitHeight, currentHeight;

	let currentTime, decodedTime, validatedTime;

	let currentNickname, decodedNickname, validatedNickname;

	let currentMessage, decodedMessage, validatedMessage;

	let currentAddress, decodedAddress, validatedAddress;

	let dataCountCurrent = 0, dataToShow = 0, dataCountWas = 0;

	let firstTimeScrollState = 1;

	let dataRequest = new XMLHttpRequest();

	let ipRequest = new XMLHttpRequest();

	let buttonToDown = document.getElementById("buttonToDown");

	function onScrollFunctions() 

	{

		getHeightMetrics();

		if (currentHeight < limitHeight) 

		{

			buttonToDown.style.display = "block";

		}

		else

		{

			buttonToDown.style.display = "none";

		};

	};

	function getIP()

	{

		ipRequest.open('GET', '../functions/post.php?guess_who=1', false);

		ipRequest.send();

		myIPaddress = ipRequest.response;

	};

	function dataGet()

	{

		dataRequest.open('GET', '../databases/messages.json', false);

		dataRequest.send();

		promise = dataRequest.response;

		decodedPromise = decodeURIComponent(escape(window.atob(promise)));

		data = JSON.parse(decodedPromise);

		dataCountCurrent = Object.keys(data).length;

	};

	function validateTime()

	{

		currentTime = data[i].time;

		decodedTime = decodeURIComponent(escape(window.atob(currentTime)));

		validatedTime = decodedTime.replace(/<xmp>|<\/xmp>/gi, "<rofl>");

	};

	function validateNickname()

	{

		currentNickname = data[i].nickname;

		decodedNickname = decodeURIComponent(escape(window.atob(currentNickname)));

		validatedNickname = decodedNickname.replace(/<xmp>|<\/xmp>/gi, "<rofl>");

	};

	function validateMessage()

	{

		currentMessage = data[i].message;

		decodedMessage = decodeURIComponent(escape(window.atob(currentMessage)));

		validatedMessage = decodedMessage.replace(/<xmp>|<\/xmp>/gi, "<rofl>");

	};

	function validateAddress()

	{

		currentAddress = data[i].address;

		decodedAddress = decodeURIComponent(escape(window.atob(currentAddress)));

		validatedAddress = decodedAddress.replace(/<xmp>|<\/xmp>/gi, "<rofl>");

	};

	function dataTemplate()

	{

		if (validatedAddress == myIPaddress)

		{

			messageClass = "myMessageWhole";

		}

		else

		{

			messageClass = "messageWhole";

		};

		chatOutput.insertAdjacentHTML("beforeend", 

			"<div class='" + messageClass + "'>" 

				+ "<div class='messageInfo'>" 

					+ "<div class='messageInfoUser'>"

						+ "<xmp class='messageInfoUser'>" 

							+ validatedNickname 

						+ "</xmp>"

					+ "</div>"

					+ "<div class='messageInfoTime'>"

						+ "<xmp class='messageInfoTime'>" 

							+ validatedTime 

						+ "</xmp>" 

					+ "</div>"

				+ "</div>" 

				+ "<p>" 

					+ "<xmp class='messageBody'>" 

						+ validatedMessage 

					+ "</xmp>" 

				+ "</p>" 

			+ "</div>" 

			+ "<br>");

	};

	function getHeightMetrics()

	{

		totalHeight = document.documentElement.clientHeight;

		limitHeight = totalHeight - 2000;

		currentHeight = window.scrollY;

	};

	function smartScroll()

	{

		getHeightMetrics();

		if (currentHeight > limitHeight)

		{

			window.scrollTo({top: document.body.scrollHeight, behavior: "smooth"});

		};

	};

	function firstTimeScroll()

	{

		getHeightMetrics();

		window.scrollTo(0, document.body.scrollHeight);

		firstTimeScrollState = 0;

	};

	function checkForEmpty(callback)

	{

		if (validatedTime != null && validatedTime != "" && validatedNickname != null && validatedNickname != "" && validatedMessage != null && validatedMessage != "" && validatedAddress != null && validatedAddress != "")

		{

			callback;

		};

	};

	function smartUpdate()

	{

		for (i = dataCountWas; i < dataCountCurrent; i++)

		{

			validateTime();

			validateNickname();

			validateMessage();

			validateAddress();

			checkForEmpty(dataTemplate());

		};

	};

	function smartShow()

	{

		dataToShow = dataCountCurrent - dataCountWas;

		if (dataToShow > 0)

		{

			smartUpdate();

			if (firstTimeScrollState != 0)

			{

				firstTimeScroll();

			};

			smartScroll();

		};

		dataCountWas = dataCountCurrent;

	};

	function dataShow()

	{

		dataGet();

		smartShow();

	};

	getIP();

	document.addEventListener("scroll", onScrollFunctions);

	setInterval(() => dataShow(), 2000); 

};

main();

/*

	TEMPLATES FOR CHECKING

	console.log("");

	console.log("Current document metrics:");

	console.log("	document.documentElement.scrollHeight: " + document.documentElement.scrollHeight);	

	console.log("	document.documentElement.clientHeight: " + document.documentElement.clientHeight);

	console.log("	document.documentElement.offsetHeight: " + document.documentElement.offsetHeight);

	console.log("	document.body.scrollHeight: " + document.body.scrollHeight);

	console.log("	document.body.clientHeight: " + document.body.clientHeight);

	console.log("	document.body.offsetHeight: " + document.body.offsetHeight);

	console.log("	document.getElementById(chatOutput).scrollHeight: " + document.getElementById("chatOutput").scrollHeight);

	console.log("	chatOutput.clientHeight: " + chatOutput.clientHeight);

	console.log("	chatOutput.scrollHeight: " + chatOutput.scrollHeight);

	console.log("	chatOutput.scrollTop: " + chatOutput.scrollTop);

	console.log("	window.innerHeight: " + window.innerHeight);

	console.log("	document.height: " + document.height);

	console.log("Current client metrics:");

	console.log("	document.documentElement.scrollTop: " + document.documentElement.scrollTop);

	console.log("	document.body.scrollTop: " + document.body.scrollTop);

	console.log("	window.pageYOffset: " + window.pageYOffset);

	console.log("	windows.scrollY: " + window.scrollY);

	window.scrollTo(0, document.body.scrollHeight);

	window.scrollTo({top: document.body.scrollHeight, behavior: "smooth"});

	scrollTop();

	window.scrollBy(0, document.body.scrollHeight);

	document.documentElement.scrollTop();

	document.body.scrollTop();

	document.getElementById('chatOutput').scrollIntoView(false);

	console.log("[!] : Scroll!");

*/