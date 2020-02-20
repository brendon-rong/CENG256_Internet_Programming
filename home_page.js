//nav bar functions
function menuButton() {
	var list = document.getElementsByClassName("nav_ul")[0]; //[0] first element with classname
	//the default is none because you can't change list.display only list.style.display which is really stupid
	if (list.style.display === "none") {
		list.style.display = "block";
	}
	else {
		list.style.display = "none";
	}
}

function showNav() {
	var windowWidth = window.outerWidth;
	var list = document.getElementsByClassName("nav_ul")[0];
	if (windowWidth > 650) {
		list.li.style.display = "inline-block";
	}
}

//homepage functions
function displayNextImage() {
	x = (x === images.length - 1) ? 0 : x + 1;
	document.getElementById("homepage_img").src = images[x];
	}

	function displayPreviousImage() {
	x = (x <= 0) ? images.length - 1 : x - 1;
	document.getElementById("homepage_img").src = images[x];
	}

	function startTimer() {
	setInterval(displayNextImage, 3000);
	}

	var images = [], x = -1;
	images[0] = "images/image1.png";
	images[1] = "images/image2.png";
	images[2] = "images/image3.png";
	images[3] = "images/image4.png";