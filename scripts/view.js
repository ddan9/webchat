"use strict";

function changeFullscreen()

{

	if (document.getElementById("infoPanel").style.display != "none")

	{

		document.getElementById("infoPanel").style.display = "none";

		document.getElementById("fullscreenButton").style.backgroundImage = "url(../../../images/fullscreenExit.svg)";

		document.getElementById("fullscreenButton").style.opacity = "10%";	

	}

	else

	{

		document.getElementById("infoPanel").style.display = "table";

		document.getElementById("fullscreenButton").style.backgroundImage = "url(../../../images/fullscreen.svg)";

		document.getElementById("fullscreenButton").style.opacity = "80%";

	};

};