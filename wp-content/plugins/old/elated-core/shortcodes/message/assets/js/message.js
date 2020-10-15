(function($) {
    'use strict';

    $(document).ready(function(){
        eltdfInitMessages();
        eltdfInitMessageHeight();
    });

/*
 **	Function to close message shortcode
 */
function eltdfInitMessages(){
    var message = $('.eltdf-message');
    if(message.length){
        message.each(function(){
            var thisMessage = $(this);
            thisMessage.find('.eltdf-close').click(function(e){
                e.preventDefault();
                $(this).parent().parent().fadeOut(500);
            });
        });
    }
}

/*
 **	Init message height
 */
function eltdfInitMessageHeight(){
    var message = $('.eltdf-message.eltdf-with-icon');
    if(message.length){
        message.each(function(){
            var thisMessage = $(this);
            var textHolderHeight = thisMessage.find('.eltdf-message-text-holder').height();
            var iconHolderHeight = thisMessage.find('.eltdf-message-icon-holder').height();

            if(textHolderHeight > iconHolderHeight) {
                thisMessage.find('.eltdf-message-icon-holder').height(textHolderHeight);
            } else {
                thisMessage.find('.eltdf-message-text-holder').height(iconHolderHeight);
            }
        });
    }
}

})(jQuery);