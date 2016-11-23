$(document).ready(function(){

    $('a.res-menu-toggle').on('click', function (e) {
        e.preventDefault();
        $('body').addClass('open');
        $('ul.menu').addClass('open');
        $('.overlay').addClass('open');
    })

    $('.overlay').on('click', function (e) {
        e.preventDefault();
        $('body').removeClass('open');
        $('ul.menu').removeClass('open');
        $('.overlay').removeClass('open');
    });

    /*-----------------------------------------------------------------
     - Panel Toggle
     -----------------------------------------------------------------*/
    $(document).on('click', '.panel-toggle', function(e) {
        e.preventDefault();
        $(this).closest('section.panel').toggleClass('closed');
    });

});