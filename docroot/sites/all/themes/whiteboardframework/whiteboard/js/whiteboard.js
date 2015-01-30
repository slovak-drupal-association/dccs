(function ($) { /* required to use the $ in jQuery */
        $('.featured-wrapper').hide(); /* hide the ul list first */
        alert('sdfsdf');
        $(document).ready(function () { 
         
            $(window).load(function () {
              
               addFlexSlider();
            });
   
        }); // end of $(document).ready()
   
        /** FlexSlider */
        function addFlexSlider(){
            $('.featured-wrapper').show().flexslider({
                animation: "slide",
                controlNav: false
            });
        }
    
    
     $('#donate_button').click(function () {
        var donation = parseInt($('#donation').val());
        
        donation += 10;
        
        if(donation > 20)
            $('#decrease_button').css({display : 'block'});
            
        $('#donation').val(donation);
        $('#donation_disp').html(donation);
    });

    $('#decrease_button').click(function () {
        var donation = parseInt($('#donation').val());
        
        donation -= 10;
        
        if(donation == 20)
            $('#decrease_button').css({display : 'none'});
        
        $('#donation').val(donation);
        $('#donation_disp').html(donation);
    });
   
    }(jQuery));
