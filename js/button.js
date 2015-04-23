jQuery(document).ready(function($){
	document.querySelector('.tb-megamenu .btn-navbar').style.display ="none";
	$('.collapse').addClass('hack');
	$('.hack').css('visibility', 'visible !important');
	$('.tb-megamenu .collapse').css('visibility', 'visible !important');
	$('.nav-collapse').removeClass('collapse');
	//$("#navbar ul'").addClass('LOL');
	//$(".ASD").css("visibility", "visible");
	var oldButton = document.querySelector('.navbar-toggle');
	var element = document.querySelector('.nav-collapse');
	test1();
	$(oldButton).click(function(e){
		$('.nav-collapse.other.classes').removeClass('collapse').addClass('in');
		$('.nav-collapse.always-show').removeClass('collapse').addClass('in');
		document.querySelector('.nav-collapse .always-show').style.height = "auto";
		document.querySelector('.nav-collapse .always-show').style.overflow = "visible";
		document.querySelector('.tb-megamenu .nav-collapse').style.position = "relative !important";
		document.querySelector('.tb-megamenu').style.position = "absolute";

		document.querySelector('.nav-collapse.always-show.in').style.height = "auto";
		test();
		$('.nav-collapse').removeClass('collapse').addClass('in');
		e.preventDefault();
	});
})
function test1() {
	console.log("Hej og velkommen til Ocita.dk! ");
}

//document.querySelector('.tb-megamenu .btn-navbar').style.display ="none";

// closed
// <div class="nav-collapse always-show collapse" style="height: 0px; overflow: hidden;">
// open 
// <div class="nav-collapse always-show in" style="height: auto; overflow: visible;">