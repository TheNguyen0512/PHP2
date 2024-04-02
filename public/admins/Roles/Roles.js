/*------- add ------*/

$(function (){
    $('.checkbox_wrapper').on('click', function (){
        $(this).parents('.card').find('.checkbox_childent').prop('checked', $(this).prop('checked'));
    });

    $('.check_all').on('click', function (){
        $(this).parents().find('.checkbox_childent').prop('checked', $(this).prop('checked'))
        $(this).parents().find('.checkbox_wrapper').prop('checked', $(this).prop('checked'))
    });
})

