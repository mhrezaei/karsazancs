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
        $('.panel.faq').each(function (index, value) {
            $(this).addClass('faq-close').find('article').slideUp();
        });
        $(panel).removeClass('faq-close').find('article').slideToggle();
    });

    /*-----------------------------------------------------------------
    - Slider
    -----------------------------------------------------------------*/
    $(".slides").responsiveSlides({
        pager: true,
    });

    /*-----------------------------------------------------------------
    - File input label
    -----------------------------------------------------------------*/
    var inputs = document.querySelectorAll( '.inputfile' );
    Array.prototype.forEach.call( inputs, function( input )
    {
        var label	 = input.nextElementSibling,
            labelVal = label.innerHTML;

        input.addEventListener( 'change', function( e )
        {
            var fileName = '';
            if( this.files && this.files.length > 1 )
                fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
            else
                fileName = e.target.value.split( '\\' ).pop();

            if( fileName )
                label.querySelector( 'span' ).innerHTML = fileName;
            else
                label.innerHTML = labelVal;
        });
    });

    /*-----------------------------------------------------------------
    - Black and white
    -----------------------------------------------------------------*/
    $('#services-image a.service').mouseenter(function(){
        $('#services-image a.service').not(this).addClass('service-hover');
    });
    $('#services-image a.service').mouseleave(function(){
        $('#services-image a.service').removeClass('service-hover');
    });

});