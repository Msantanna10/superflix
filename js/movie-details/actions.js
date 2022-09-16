// Opens video
$('.pageDetails .videoCard').on('click',function(){
    var key = $(this).data('video');
    $('.modal .body iframe').attr('src','https://www.youtube.com/embed/'+key+'?rel=0&controls=1&autoplay=0&enablejsapi=1');
    $('.modal').fadeIn('500');
});

// Closes video
$('.modal .close').on('click',function(){
    $(this).closest('.modal').fadeOut(500);
    $(this).closest('.modal').find('iframe').attr('src','');
});

// Loads more titles
$('.titles span#show').on('click',function(){
    $('.titles').addClass('open');
});

// Adds to favorite (Logged In)
$('.logged-in .favBar').on('click',function(){
    var id = $(this).data('movie');
    var doIt = $(this).attr('data-action');
    console.log(doIt);

    $.ajax({
        type: "POST",
        url: objVars.ajax_url,
        data:{
            action: 'add_favorites',
            id: id,
            doIt: doIt
        },
        beforeSend: function (html) {
            // Any action before send...
            $('.favBar').addClass('off');
        },
        success:function(html) {           
            if(doIt == 'add') { $('.favBar').attr('data-action','remove'); $('.favBar span').text('Remove from favorites'); }
            else if (doIt == 'remove') { $('.favBar').attr('data-action','add'); $('.favBar span').text('Add to favorites'); }
        },
        error:function(html) {
            // Any action for error
        },
        complete:(json) => {
            // Any action after completion (success or error)
            $('.favBar').removeClass('off');            
        }
    });
});

// Adds to favorite (Logged In)
$('body:not(.logged-in) .favBar').on('click',function(){
    $('.navHeader ul li#signin a')[0].click();
});