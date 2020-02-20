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