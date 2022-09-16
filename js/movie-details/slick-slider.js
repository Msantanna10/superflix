// Slick cast
var castCount = $('.slick-cast').children().length;
if(castCount > 4) {
    $('.slick-cast').slick({
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    centerMode: true,
    dots: false,
    arrows: true,
    autoplay: false,
    draggable: false,
    prevArrow:$('.cast .arrows #prev'),
    nextArrow:$('.cast .arrows #next'),
    responsive: [
        {
            breakpoint: 900,
            settings: {
            slidesToShow: 4
            }
        },
        {
            breakpoint: 767,
            settings: {
            slidesToShow: 3,
            slidesToScroll: 1
            }
        },
        {
            breakpoint: 550,
            settings: {
            slidesToShow: 2,
            slidesToScroll: 1
            }
        },        
        {
            breakpoint: 450,
            settings: {
            slidesToShow: 1,
            slidesToScroll: 1
            }
        }
    ]
    });
}

// Slick videos
var videosCount = $('.slick-videos').children().length;
if(videosCount > 2) {
    $('.slick-videos').slick({
    infinite: true,
    slidesToShow: 2,
    slidesToScroll: 1,
    centerMode: true,
    dots: false,
    arrows: true,
    autoplay: false,
    draggable: false,
    prevArrow:$('.videos .arrows #prev'),
    nextArrow:$('.videos .arrows #next'),
    responsive: [
        {
            breakpoint: 900,
            settings: {
            slidesToShow: 4
        }
        },
        {
            breakpoint: 890,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 650,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1
            }
        }
        ,
        {
            breakpoint: 450,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
    });
}
else {
    $('.slick-videos').removeClass('slick-hide');
}

// Before Slick similar movies...
// Force bg posters to be shown (some dont fully load)
$(".recommended .card").each(function(){    
    setTimeout(function(){
        var currentStyle = $(this).find('.bg').attr('style');
        $(this).find('.bg').attr('style',''); // Remove bg style
        $(this).find('.bg').attr('style',currentStyle); // Add it again
    }, 1000);
});

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