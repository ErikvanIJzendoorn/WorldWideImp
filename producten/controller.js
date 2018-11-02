$( document ).ready(function() {
    console.log( "document loaded" );
	

window.onscroll = function() {myFunction()};

var navbar = document.getElementsByClassName("navbar")[0];
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
  	console.log("1");
    navbar.classList.add("sticky");
  } else {
  	console.log("2", window.pageYOffset);
    navbar.classList.remove("sticky");
  }
}


});