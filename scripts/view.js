"use strict";

function changeFullscreen()

{

	var infoPanel = document.getElementById("infoPanel");

	var fullscreenButton = document.getElementById("fullscreenButton");

	var contentContainer = document.getElementById("contentContainer");

	if (infoPanel.style.display != "none")

	{

		infoPanel.style.display = "none";

		fullscreenButton.style.backgroundImage = "url(../../../images/fullscreen-exit.svg)";

		fullscreenButton.style.opacity = "10%";

		if (contentContainer)

		{

			contentContainer.style.height = "92%";

		};

	}

	else

	{

		infoPanel.style.display = "table";

		fullscreenButton.style.backgroundImage = "url(../../../images/fullscreen.svg)";

		fullscreenButton.style.opacity = "80%";

		if (contentContainer)

		{

			contentContainer.style.height = "80%";

		};

	};

};
