"use strict";

function changeFullscreen()

{

	if (document.getElementById("infoPanel").style.display != "none")

	{

		document.getElementById("infoPanel").style.display = "none";

		document.getElementById("fullscreenButton").style.backgroundImage = "url(../../../images/fullscreen-exit.svg)";

		document.getElementById("fullscreenButton").style.opacity = "10%";

		document.getElementById("contentContainer").style.height = "92%";		

	}

	else

	{

		document.getElementById("infoPanel").style.display = "table";

		document.getElementById("fullscreenButton").style.backgroundImage = "url(../../../images/fullscreen.svg)";

		document.getElementById("fullscreenButton").style.opacity = "80%";

		document.getElementById("contentContainer").style.height = "80%";

	};

};