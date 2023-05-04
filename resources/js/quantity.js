$(document).ready(function() {
    $('.pls.altera').click(function() {
        var curr_quantity = $(this).prev().val();
        curr_quantity = parseInt(curr_quantity)+1;
        $(this).prev().val(curr_quantity);
        //alert('Product Name : '+$(this).parent().parent().parent().prev().text());
    });
    $('.pls.minus').click(function() {
        var curr_quantity = $(this).next().val();
        if(curr_quantity != 0) {
            curr_quantity = parseInt(curr_quantity)-1;
            $(this).next().val(curr_quantity);
            //alert('Product Name : '+$(this).parent().parent().parent().prev().text());
        }
    });
 });