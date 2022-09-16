// AJAX function
function ajaxCall(pagination, sort_by, genres, date, datesort) {

    $.ajax({
        type: "POST",
        url: objVars.ajax_url,
        data:{
            action: 'movies_list',
            pagination: pagination,
            sort_by: sort_by,
            genres: genres,
            date: date,
            datesort: datesort
        },
        beforeSend: function (html) {
            // Any action before send...
            $('.movieCards').html(`
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
            $('.movieCards').html(html); // Append movies                 
        },
        error:function(html) {
            $('.movieCards').html('<p class="error">Ops! There was an error. Try again later.</p>');  
        },
        complete:(json) => {
            // Any action after completion (success or error)
        }
    });
}
ajaxCall();

$(document).ready(function() {
    // ON CLICK PAGINATION
    $('body').on('click','.pagination .inactive',function(e){
        var pageNumber = $(this).data('number');        

        // OTHER VALUES
        var sortby = $('select[name="sortby"]').val();
        var date = $('input[name="date"]').val();
        if($('input[name="sortdate"]').is(":checked")) { var datesort = '.gte'; /* Greater than or equal or greater */ } else { var datesort = '.lte'; /* Less than or equal or less */ }
        var searchIDs = $('#genres input[type="checkbox"]:checked').map(function(){ return $(this).val(); });
        var idArray = searchIDs.get(); // [Genres] array
        var idList = idArray.toString(); // [Genres] comma separated

        ajaxCall(pageNumber, sortby, idList, date, datesort);
    });

    // ON SORT BY CHANGE
    $('select[name="sortby"]').on('change', function() {
        var pageNumber = $('.pagination .current').data('number');

        // OTHER VALUES
        var date = $('input[name="date"]').val();
        if($('input[name="sortdate"]').is(":checked")) { var datesort = '.gte'; /* Greater than or equal or greater */ } else { var datesort = '.lte'; /* Less than or equal or less */ }
        var searchIDs = $('#genres input[type="checkbox"]:checked').map(function(){ return $(this).val(); });
        var idArray = searchIDs.get(); // [Genres] array
        var idList = idArray.toString(); // [Genres] comma separated

        ajaxCall(1, this.value, idList, date, datesort); // Goes back to 1 on new requests (change to the 'pageNumber' var to keep the pagination)
    });

    // ON GENRE SELECT
    $('#genres input[type="checkbox"]').change(function() {
        var searchIDs = $('#genres input[type="checkbox"]:checked').map(function(){ return $(this).val(); });
        var idArray = searchIDs.get(); // [Genres] array
        var idList = idArray.toString(); // [Genres] comma separated

        // OTHER VALUES
        var pageNumber = $('.pagination .current').data('number');
        var sortby = $('select[name="sortby"]').val();
        var date = $('input[name="date"]').val();
        if($('input[name="sortdate"]').is(":checked")) { var datesort = '.gte'; /* Greater than or equal or greater */ } else { var datesort = '.lte'; /* Less than or equal or less */ }

        ajaxCall(1, sortby, idList, date, datesort); // Goes back to 1 on new requests (change to the 'pageNumber' var to keep the pagination)
    });

    // ON DATE SELECT
    $('input[name="date"]').change(function() {
        var date = $(this).val(); // YYYY-MM-DD

        console.log(date);
        
        // OTHER VALUES
        var pageNumber = $('.pagination .current').data('number');
        var sortby = $('select[name="sortby"]').val();
        var date = $('input[name="date"]').val();
        if($('input[name="sortdate"]').is(":checked")) { var datesort = '.gte'; /* Greater than or equal or greater */ } else { var datesort = '.lte'; /* Less than or equal or less */ }
        var searchIDs = $('#genres input[type="checkbox"]:checked').map(function(){ return $(this).val(); });
        var idArray = searchIDs.get(); // [Genres] array
        var idList = idArray.toString(); // [Genres] comma separated
        
        ajaxCall(1, sortby, idList, date, datesort); // Goes back to 1 on new requests (change to the 'pageNumber' var to keep the pagination)

    });

    // ON TOGGLE DATE CHANGE
    $('input[name="sortdate"]').change(function() {
        if($('input[name="sortdate"]').is(":checked")) { var datesort = '.gte'; /* Greater than or equal or greater */ } else { var datesort = '.lte'; /* Less than or equal or less */ }     
        
        // OTHER VALUES
        var pageNumber = $('.pagination .current').data('number');
        var sortby = $('select[name="sortby"]').val();
        var date = $('input[name="date"]').val();
        var searchIDs = $('#genres input[type="checkbox"]:checked').map(function(){ return $(this).val(); });
        var idArray = searchIDs.get(); // [Genres] array
        var idList = idArray.toString(); // [Genres] comma separated
        
        ajaxCall(1, sortby, idList, date, datesort); // Goes back to 1 on new requests (change to the 'pageNumber' var to keep the pagination)

    });

    // ON KEYWORD TYPE
    $('input[name="keyword"]').keyup(function() {
        // More than 3 characters
        if(this.value.length >= 3) {
            $.ajax({
                type: "POST",
                url: objVars.ajax_url,
                data:{
                    action: 'movie_title',
                    title: $(this).val()
                },
                beforeSend: function (html) {
                    // Any action before send...
                    $('#keyword .wrap .options').html('<p class="loadText">Loading...</p>');
                    $('#keyword .wrap .options').addClass('open');
                },
                success:function(html) {
                    $('#keyword .wrap .options').html(html); // Append movies                 
                },
                error:function(html) {
                    $('#keyword .wrap .options').html('<p class="loadText">Error.</p>');  
                },
                complete:(json) => {
                    // Any action after completion (success or error)
                }
            });
        }
        else {
            $('#keyword .wrap .options').removeClass('open');
        }
    });

    // CLOSE TITLE SEARCH BAR ON CLICK OUTSIDE
    $(document).click(function(event) {
        var container = $("#keyword .wrap");
        if (!container.is(event.target) && !container.has(event.target).length) {
            $("#keyword .wrap .options").removeClass('open');
        }
    });
    
    // DATEPICKER
    $( function() {
        $( "#datepicker" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            yearRange: "-50:+0"
        });
    } );

    // CLEAR FIELDS ON PAGE LOAD
    $('input[type="text"]').val('');
    $('input[type="date"]').val('');
    $('input[type="checkbox"]').prop('checked',false);
    $('select').val('popularity.desc');

});