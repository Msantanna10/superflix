// Slick people (var)
var slickOptionsPeople = {
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    centerMode: true,
    dots: false,
    arrows: true,
    autoplay: false,
    draggable: true,
    mobileFirst: true,
    prevArrow:$('.popularActors .arrows #prev'),
    nextArrow:$('.popularActors .arrows #next'),
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

$.ajax({
    type: "POST",
    url: objVars.ajax_url,
    data:{action:'popular_people'},
    beforeSend: function (html) {
        // Any action before send...
    },
    success:function(html) {
        $('.actorCards').html(html);          
        $('.slick-people').slick(slickOptionsPeople); // Triggers slick    
    },
    error:function(html) {
        $('.actorCards').html('<p class="error">Ops! There was an error. Try again later.</p>');  
    },
    complete:(json) => {
        // Any action after completion (success or error)
    }
});