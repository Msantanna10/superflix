// Slick movie (var)
var slickOptions = {
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    centerMode: true,
    dots: false,
    arrows: true,
    autoplay: false,
    draggable: true,
    mobileFirst: true,
    prevArrow:$('.upComing .arrows #prev'),
    nextArrow:$('.upComing .arrows #next'),
    responsive: [
        {
            breakpoint: 991, // Min screen
            settings: 'unslick'
            // settings: {}
        },
        {
            breakpoint: 850, // Min screen
            settings: {
                slidesToShow: 4,
            }
        },
        {
            breakpoint: 650, // Min screen
            settings: {
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 450, // Min screen
            settings: {
                slidesToShow: 2,
            }
        },
        {
            breakpoint: 300, // Min screen
            settings: {
                slidesToShow: 1,
            }
        }
    ]
}

// Show movies on page load
$.ajax({
    type: "POST",
    url: objVars.ajax_url,
    data:{action:'upcoming_movies'},
    beforeSend: function (html) {
        // Any action before send...
    },
    success:function(html) {
        $('.movieCards').html(html); // Append movies              
        $('.slick-movies').slick(slickOptions); // Triggers slick    
    },
    error:function(html) {
        $('.movieCards').html('<p class="error">Ops! There was an error. Try again later.</p>');  
    },
    complete:(json) => {
        // Any action after completion (success or error)
    }
});