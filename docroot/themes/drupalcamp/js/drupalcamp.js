(function ($, Drupal) {

    Drupal.behaviors.inputButton = {
        attach: function (context, settings) {
            $('link[href="//cdn-images.mailchimp.com/embedcode/classic-081711.css"]').remove();
        }
    };

    Drupal.behaviors.menuToggleDC = {
        attach: function (context, settings) {
            $('.menu-toggle').click(function () {
                $('#block-drupalcamp-main-menu').find('ul.menu').toggleClass('open');
            });
        }
    };

})(jQuery, Drupal);
