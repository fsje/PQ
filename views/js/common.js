$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $(this).toggleClass('active');
    });
});

function goBack() {
    window.history.back();
}

$( function() {

    $( "#search" ).autocomplete({
    source: function( request, response ) {
        $.ajax( {
            url: "/app/search.php",
            type: "post",
            dataType: "json",
            data: {
                term: request.term
            },
            success: function( data ) {response( data.packaging || data.food );},
            complete: function(){},
            error: function(error) {},
        
        });
    },
    focus: function( event, ui ) {
        $("#search").val( ui.item.label );
        return false;
    },
    minLength: 2,
    select: function( event, ui ) { window.location.href = ui.item.url;}} );
    
    $( "#search" ).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
    
        var $li     = $('<li class="itemText">'),
            $img    = $('<img class="autocomplete_img">');
            $ri     = $('<span class="riItem">');

        $img.attr({
          src: imageHandler(item.id),
          alt: item.label
        });

        if(item.riItem != 0){
         $ri.append(item.riItem);
        }
        $li.attr('data-value', item.label);
        $li.append('<a href="#">');
        $li.find('a').append($img).append(item.label).append($ri);    
    
        return $li.appendTo(ul);
      };
} );



/**
 * Image handler
 */
function imageHandler(product_id){
     var image = function(){
        var tmp;
        $.ajax( {
        url: "/app/imageHandler.php",
        type: "post",
        dataType: "text",
        async: false,
        data: {product_id: product_id},

        success: function( data ) {tmp = data;},
        complete: function(){},
        error: function(error) {},   
    });
        return tmp;
    }();
    return image;
}

/**
 * Modal.
 */
    var modal       = $('.modal');          // Our modal
    var img         = $('.modalTrigger');   // Image what is pressed.
    var modalImg    = $('#img01');          // Image that should be shown.
    var captionText = $('#caption');        // Caption.
    var span        = $('.close');          // Define our close btn.
    
    // Press the image.
    img.click(function(){
        modal.css('display', 'block');
        captionText.innerHtml = img.attr('alt');
    })

    // Close modal.
    modal.click(function(){modal.css('display', 'none');})
    span.click(function(){modal.css('display', 'block');})


