"use strict";

function scrollDownPermanent()

{

	window.scrollTo({top: document.body.scrollHeight, behavior: "smooth"});

};

function main()

{

	"use strict";

	let dataRequestPath = "../databases/messages.json";

	let playAudio = 1;

	let audio = new Audio("../sounds/notify.mp3");

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

	function playNotify()

	{

		if (audio != "" && audio != null && playAudio == 1)

		{

			audio.play();

		};

	};

	function getIP()

	{

		ipRequest.open("GET", "../functions/post.php?guess_who=1", false);

		ipRequest.send();

		myIPaddress = ipRequest.response;

	};

	function dataGet()

	{

		dataRequest.open("GET", dataRequestPath, false);

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

	function checkForMessageSender()

	{

		switch (validatedAddress)

		{

			case myIPaddress:
				messageClass = "myMessageWhole";
				break;

			case "Notify":
				messageClass = "messageNotify";
				break;

			default:
				messageClass = "messageWhole";
				break;

		};

	};

	function dataTemplate()

	{

		checkForMessageSender();

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

				+ "<div class='messageBody'>" 

					+ "<xmp class='messageBody'>" 

						+ validatedMessage 

					+ "</xmp>" 

				+ "</div>" 

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

			playNotify();

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
