(function ($) {

    $(document).on('change', 'select#id_kancelarii', function(){
        $('select#id_pracownika').find('option').removeClass('hidden');
        
        if($(this).val()!='')
        {
            $('select#id_pracownika').find('option[data-id-kancelarii!="'+$(this).val()+'"]').addClass('hidden')
            $('select#id_pracownika').find('option:first').removeClass('hidden');
        }
    });
    
    
    $(document).ready(function(){
        $('#postimagediv .inside').prepend('<p>- artykuł: 485x405px<br>- wyróżniony artykuł duży: 742x560px<br>- wyróżniony artykuł mały: 338x338px</p>');

        if(!$("#id_kancelarii").find('[selected]').length)
        {
            $("#id_kancelarii").append($("#id_kancelarii option").remove().sort(function(a, b) {
                var at = $(a).text(), bt = $(b).text();
                return (at > bt)?1:((at < bt)?-1:0);
            }));
        }

        if(!$("#id_pracownika").find('[selected]').length)
        {
            $("#id_pracownika").append($("#id_pracownika option").remove().sort(function(a, b) {
                var at = $(a).text(), bt = $(b).text();
                return (at > bt)?1:((at < bt)?-1:0);
            }));
        }
    });




} )( jQuery );