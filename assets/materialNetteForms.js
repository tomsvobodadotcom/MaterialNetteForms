/**
 * MaterialNetteForms javascript file
 * Depends on NetteForms, Nette and jQuery javascritp libraries
 * @author Tom Svoboda <tsvob94@gmail.com>
 */

$(function() {
    
    /** 
     * Nette forms .addError by javascript better (do the same thing as server-side validation) 
     * @param element elem input with error
     * @param string message error message
    */
    Nette.addError = function(elem, message) {

       /* Get form element */
       form = elem.closest('form');

       /* Remove all errors from before */
           /* 1) remove all inline errors*/
       $('div.row.inline-error' ,form).remove();
           /* 2) remove all invalid classes*/
       $('div.input-field.invalid').removeClass('invalid');

       /* Get pair container && add invalid class*/
       pair = elem.closest('div.input-field, div.input-field-checkbox');
       $(pair).addClass('invalid');

       if(message) {
           /* Create wrapper and div with message */
           errorElem = $('<div>').html(message).addClass('col s12 right-align');
           errorWrap = $('<div>').addClass('row inline-error').append(errorElem);

           /* Add error message after input element */
           if( $(elem).attr('type') === 'checkbox' ) {
               $(errorWrap).insertAfter($(elem).siblings('label'));
           } else {
               $(errorWrap).insertAfter(elem);
           }
       }

       if(elem.focus) {
           elem.focus();
       }

       return;
    };

});