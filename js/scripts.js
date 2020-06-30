(function ($) {

    $(document).on('change', 'select#categories-select', function(){
        var base_url = $('body').data('base-url'),
            url = base_url+'category/artykuly/';
        
        if($(this).val()!=' ')
        {
            url += $(this).val();
            url += '?wszystkie=1';
        }

        window.location.href = url;
    });
    
    $(document).on('change', 'select#province-select', function(){
        var base_url = $('body').data('base-url'),
            url = base_url+'category/kancelarie';
        
        if($(this).val()!='')
            url += '?wojewodztwo='+$(this).val();
            
        window.location.href = url;
    });
    
    $(document).on('change', 'select#specialization-select', function(){
        var base_url = $('body').data('base-url'),
            url = base_url+'category/kancelarie';
        
        if($(this).val()!='')
            url += '/'+$(this).val();
            
        window.location.href = url;
    });
    
    $(document).on('click', '.goup', function(e){
        e.preventDefault();
        $('html, body').animate({ scrollTop: 0}, 300);
    });
    
    function zwisy()
    {
        $('p, h1, h2, h3, li, .show-contact-form').each(function() {
            var tekst = $(this).html();
            tekst = tekst.replace(/(\s)([\S])[\s]+/g,"$1$2&nbsp;"); //jednoznakowe
            tekst = tekst.replace(/(\s)([^<][\S]{1})[\s]+/g,"$1$2&nbsp;"); //dwuznakowe
            $(this).html(tekst);
        });
    }
    
    $(document).on('click', '.show-contact-form', function(e){
       e.preventDefault();
       $(this).next('.contact-form').toggle();

    });
    
    $(document).ready(function(){

        if($('[name="strona"]').length)
        {
            $('[name="strona"]').val($('.entry-title a').html());
        }

        zwisy();
        
        $('.team').slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            centerMode: false,
            arrows: false,
            responsive: [
                {
                  breakpoint: 1350,
                  settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    arrows: false
                  }
                },
                {
                  breakpoint: 790,
                  settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    arrows: false
                  }
                },
                {
                  breakpoint: 480,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false
                  }
                }
              ]
        });

        $(document).on('click', '.team-wrapper .next-button', function(e){
            $('.team').slick('next');
        });
        
        $(document).on('click', '.team-wrapper .prev-button', function(e){
            $('.team').slick('prev');
        });
        
    });

} )( jQuery );