// RELOAD PAGE ON RESIZE
$(function () {
    var i = 0;
    $(window).on("resize", function () {
        var windowsize = $(this).width();
        if (windowsize > 991 && i === 0) {
            i = 1;
        } else if (windowsize <= 991 && i == 1) {
            location.reload();
            i = 0;
        }
    });
});

// ADD SCROLLED CLASS TO BODY
$(window).scroll(function() {    
    var scroll = $(window).scrollTop();

    if (scroll >= 5) {
        $("body").addClass("scrolled");
    } else {
        $("body").removeClass("scrolled");
    }
});

// MENU HAMBURGER
$(document).ready(function(){
	$('#menuToggle').click(function(){
		$(this).toggleClass('open');
        $('.navHeader .menuLinks').slideToggle(800);
        $('body').toggleClass('menuOpen');
	});
});