// Slick movies
var moviesCount = $('.slick-movies').children().length;
if(moviesCount > 4) {
    $('.slick-movies').slick({
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    centerMode: true,
    dots: false,
    arrows: true,
    autoplay: false,
    draggable: true,
    prevArrow:$('.recommended .arrows #prev'),
    nextArrow:$('.recommended .arrows #next'),
    responsive: [
        {
            breakpoint: 850,
            settings: {
            slidesToShow: 3
            }
        },
        {
            breakpoint: 650,
            settings: {
            slidesToShow: 2
            }
        },
        {
            breakpoint: 450,
            settings: {
            slidesToShow: 1
            }
        },
    ]
    });
}
else {
    $('.slick-movies').removeClass('slick-hide');
}

// OPEN GALLERY
$('.gallery .single img').on('click',function(){
    // $('.modal img').attr('src','');
    var image = $(this).attr('data-image');
    $('.modal img').attr('src',image);
    $('.modal').fadeIn('500');
});

// CLOSES MODAL
$('.modal .close').on('click',function(){
    $(this).closest('.modal').fadeOut(500);
});