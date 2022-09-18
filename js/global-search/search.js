// AJAX FUNCTION
function ajaxCall(keyword) {
    $.ajax({
        type: "POST",
        url: objVars.ajax_url,
        data:{
            action: 'global_search',
            keyword: keyword
        },
        beforeSend: function (html) {
            // Any action before send...
            $('.searchPage .results > .in').html(`
            <div id="loading">
                <div class="bulletouter">
                    <div class="bulletinner"></div>
                    <div class="mask"></div>
                    <div class="dot"></div>
                </div>
            </div>
            `);
        },
        success:function(html) {
            $('.searchPage .results > .in').html(html); // Append movies                 
        },
        error:function(response, error) {
            $('.searchPage .results > .in').html('<p class="error">There was an error.</p>');  
            console.log(JSON.stringify(response));
        },
        complete:(json) => {
            // Any action after completion (success or error)
        }
    });
}

// ON KEYWORD TYPE
$('input[name="keyword"]').keyup(function() {
    // More than 3 characters
    // Allows search
    if(this.value.length >= 3) {
        $('.searchPage .body .head .field').removeClass('blockSearch');        
    }
    // Blocks search
    else {
        $('.searchPage .body .head .field').addClass('blockSearch');
    }
});

// CLICKING ON "FIND"
$('input[type="submit"]').on('click',function() {
    var keyword = $('input[name="keyword"]').val();
    ajaxCall(keyword);
});

// ClEARS FIELD ON PAGE LOAD
$('input[name="keyword"]').val('');