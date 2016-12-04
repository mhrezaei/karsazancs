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
        var panel = $(this).closest('section.panel');
        $(panel).closest('section.panel').toggleClass('closed');
    });
    $('.panel.faq:not(:first-child)').each(function (index, value) {
        $(this).addClass('faq-close').find('article').hide();
    });
    $('.panel.faq header').on('click', function (e) {
        e.preventDefault();
        var panel = $(this).closest('section.panel');
        $(panel).toggleClass('faq-close').find('article').slideToggle();
    });

});