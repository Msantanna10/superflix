// AJAX function
function ajaxCall(pagination) {

    $.ajax({
        type: "POST",
        url: objVars.ajax_url,
        data:{
            action: 'people_list',
            pagination: pagination
        },
        beforeSend: function (html) {
            // Any action before send...
            $('.actorCards').html(`
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
            $('.actorCards').html(html); // Append movies                 
        },
        error:function(html) {
            $('.actorCards').html('<p class="error">Ops! There was an error. Try again later.</p>');  
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

        ajaxCall(pageNumber);
    });

    // ON SORT BY CHANGE
    $('select[name="sortby"]').on('change', function() {
        
        var orderName = $(this).val();

        ajaxCall(1); // Goes back to 1 on new requests (change to the 'pageNumber' var to keep the pagination)
    });

    // CLEAR FIELDS ON PAGE LOAD
    $('input[type="text"]').val('');
    $('input[type="date"]').val('');
    $('input[type="checkbox"]').prop('checked',false);
    $('select').val('popularity.desc');

});